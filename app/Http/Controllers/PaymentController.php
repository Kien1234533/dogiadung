<?php

namespace App\Http\Controllers;

use App\Mail\SendMailOrder;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // vnpay
    public function vnpay_payment(Request $request)
    {
        // Lưu tạm dữ liệu vào order nếu thanh toán không thành công thì sẽ xoá dữ liệu đi
        $data = $request->all();
        $request->validate([
            'ordercode' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'cartlist' => 'required',
            'total' => 'required',
        ]);
        $checkOrder = Order::where('ordercode', '=', $data['ordercode'])->first();
        if (!$checkOrder) {
            $order = new Order($data);
            $order->address = $data['street'] . ',' . $data['ward'] . ',' . $data['district'] . ',' . $data['city'];
            $order->payment_method = 'Thanh Toán VNPAY';
            $order->is_processed = 'wait';
            $order->save();
            // Xoá giỏ hàng
            // Cart::where('user_id', '=', $data['user_id'])->delete();
        }


        // Xử lý vnpay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/shopco/public/thankorder.html?";
        $vnp_TmnCode = "V5KC9JWA"; //Mã website tại VNPAY 
        $vnp_HashSecret = "GIJXYBLHMKDZJBUHCTJITLTKOYPYEEVK"; //Chuỗi bí mật
        $vnp_TxnRef = $data['ordercode']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hoá đơn";
        $vnp_OrderType = "Shop.CO";
        $vnp_Amount = $data['total'] * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
        //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        // }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function thank_order()
    {
        $statusPayment = request('vnp_ResponseCode');
        $order = Order::where('user_id', Auth::user()->id)
            ->where("is_processed", '=', 'wait')
            ->orderBy('created_at', 'desc')
            ->first();
        $mes = "";
        if ($statusPayment === "00") {
            $order->update(['is_processed' => "done"]);
            $mail = new SendMailOrder($order->toArray());
            Mail::to($order['email'])->send($mail);
            $mes = "Thanh Toán Thành Công";
            // Nếu thanh toán thành công thì lấy ra tất cả order bị huỷ giao dịch hoặc người dùng lui lại trang rồi reload dẫn đến bị dư đơn hàng vì mỗi lần load lại thì mã đơn random 1 mã khác
            // Lấy giỏ hàng theo user_id để xoá tất cả sản phẩm nếu thanh toán thành công
            Order::where('user_id', '=', Auth::user()->id)->where('is_processed', '=', 'wait')->delete();
            Cart::where('user_id', '=', Auth::user()->id)->delete();
            return view('thankorder', compact('mes', 'order'));
        } else {
            if ($order) {
                $order->delete();
            }
            if ($statusPayment === "01") {
                $mes = "Giao dịch đã tồn tại.";
            } else if ($statusPayment === "02") {
                $mes = "Ngân hàng từ chối thanh toán.";
            } else if ($statusPayment === "24") {
                $mes = "Khách hàng đã huỷ giao dịch";
            }
        }
        return view('thankorder', compact('mes'));
    }

    // momo
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    // public function momo_payment(Request $request)
    // {
    //     $all = $request->all();

    //     $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    //     $partnerCode = 'MOMOBKUN20180529';
    //     $accessKey = 'klm05TvNBzhg7h7j';
    //     $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    //     $orderInfo = "Thanh toán qua ATM MoMo";
    //     $amount = "10000";
    //     $orderId = time() . "";
    //     $redirectUrl = "http://localhost/shopco/public/thankordermomo.html";
    //     $ipnUrl = "http://localhost/shopco/public/thankordermomo.html";
    //     $extraData = "";
    //     $requestId = time() . "";
    //     $requestType = "PaywithATM";

    //     $rawHash =  "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&ipnUrl=" . $ipnUrl . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&redirectUrl=" . $redirectUrl .  "&extraData=" . $extraData . "&requestType=" . $requestType;
    //     $signature = hash_hmac("sha256", $rawHash, $secretKey);

    //     $data =  array(
    //         'partnerCode' => $partnerCode,
    //         'partnerName' => "Test",
    //         'storeId' => "Momoteststore",
    //         'requestId' => $requestId,
    //         'amount' => $amount,
    //         'orderId' => $orderId,
    //         'orderInfo' => $orderInfo,
    //         'redirectUrl' => $redirectUrl,
    //         'ipnUrl' => $ipnUrl,
    //         'lang' => "vi",
    //         'extraData' => $extraData,
    //         'requestType' => $requestType,
    //         'signature' => $signature
    //     );

    //     $result = $this->execPostRequest($endpoint, json_encode($data));
    //     dd($result);
    //     $jsonResult = json_decode($result, true);

    //     // return redirect()->to($jsonResult['payUrl']);
    //     header('Location: ' . $jsonResult['payUrl']);
    // }


    public function momo_payment(Request $request)
    {

        // Lưu tạm dữ liệu vào order nếu thanh toán không thành công thì sẽ xoá dữ liệu đi
        $data = $request->all();
        $request->validate([
            'ordercode' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'cartlist' => 'required',
            'total' => 'required',
        ]);
        $checkOrder = Order::where('ordercode', '=', $data['ordercode'])->first();
        if (!$checkOrder) {
            $order = new Order($data);
            $order->address = $data['street'] . ',' . $data['ward'] . ',' . $data['district'] . ',' . $data['city'];
            $order->payment_method = 'Thanh Toán Momo';
            $order->is_processed = 'wait';
            $order->save();
            // Xoá giỏ hàng
            // Cart::where('user_id', '=', $data['user_id'])->delete();
        }

        // xử lý thanh toán momo
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = "MOMOBKUN20180529";
        $accessKey = "klm05TvNBzhg7h7j";
        $secretKey = "at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa";
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $data['total'];
        $returnUrl = "http://localhost/shopco/public/thankordermomo.html";
        $notifyurl = "http://localhost/shopco/public/thankordermomo.html";
        $bankCode = "SML";
        $orderid = $data['ordercode'];
        $requestId = time() . "";
        $requestType = "payWithMoMoATM";
        $extraData = "";

        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&bankCode=" . $bankCode . "&amount=" . $amount . "&orderId=" . $orderid . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data =  array(
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderid,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'bankCode' => $bankCode,
            'notifyUrl' => $notifyurl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json

        error_log(print_r($jsonResult, true));
        return redirect()->to($jsonResult['payUrl']);
    }


    public function thank_order_momo()
    {
        $errCode = request('errorCode');

        $order = Order::where('user_id', Auth::user()->id)
            ->where("is_processed", '=', 'wait')
            ->orderBy('created_at', 'desc')
            ->first();
        $mes = "";
        if ($errCode === "0") {
            if ($order) {
                $order->update(['is_processed' => "done"]);
                $mail = new SendMailOrder($order->toArray());
                Mail::to($order['email'])->send($mail);
                // Nếu thanh toán thành công thì lấy ra tất cả order bị huỷ giao dịch hoặc người dùng lui lại trang rồi reload dẫn đến bị dư đơn hàng vì mỗi lần load lại thì mã đơn random 1 mã khác
                // Lấy giỏ hàng theo user_id để xoá tất cả sản phẩm nếu thanh toán thành công
                Order::where('user_id', '=', Auth::user()->id)->where('is_processed', '=', 'wait')->delete();
                Cart::where('user_id', '=', Auth::user()->id)->delete();
            }
            $mes = "Thanh Toán Thành Công";

            return view('thankmomo', compact('mes', 'order'));
        } else {
            if ($order) {
                $order->delete();
            }
            if ($errCode === "22") {
                $mes = "Số tiền giao dịch không hợp lệ.";
            } else if ($errCode === "10") {
                $mes = "Hệ thống đang được bảo trì.	";
            } else if ($errCode === "1003") {
                $mes = "Giao dịch đã bị huỷ";
            } else {
                $mes = "Giao dịch thất bại";
            }
        }
        return view('thankmomo', compact('mes'));
    }
    // order
    public function order(Request $request)
    {
        $all = $request->all();
        $request->validate([
            'ordercode' => 'required',
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
            'cartlist' => 'required',
            'total' => 'required',
        ]);

        $checkOrder = Order::where('ordercode', '=', $all['ordercode'])->first();
        if ($checkOrder) {
            return view('thanks');
        }
        $order = new Order($all);
        $order->address = $all['street'] . ',' . $all['ward'] . ',' . $all['district'] . ',' . $all['city'];
        $order->payment_method = 'Thanh toán khi nhận hàng';
        $order->save();
        // Delete cart by user
        Cart::where('user_id', '=', $all['user_id'])->delete();
        // send Mail order
        $mail = new SendMailOrder($order->toArray());
        Mail::to($all['email'])->send($mail);

        return view('thanks');
    }
}
