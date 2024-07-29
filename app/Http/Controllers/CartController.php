<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.ifNotLoggedIn')->only(['store', 'create', 'index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', '=', $user_id)->get();
        // $uniqueProducts = [];
        // foreach ($cart as $item) {
        //     $productId = $item->product_id;
        //     // Kiểm tra xem sản phẩm đã tồn tại trong mảng chưa
        //     if (!isset($uniqueProducts[$productId])) {
        //         $uniqueProducts[$productId] = [
        //             'product_id' => $item->product_id,
        //             'code' => $item->code,
        //             'name' => $item->name,
        //             'price' => $item->price,
        //             'pricesale' => $item->pricesale,
        //             'image' => $item->image,
        //             'quantity' => 0,
        //             'color_size_combinations' => [],
        //         ];
        //     }
        //     // Thêm thông tin màu sắc, kích thước, số lượng vào mảng
        //     $uniqueProducts[$productId]['color_size_combinations'][] = [
        //         'color' => $item->color,
        //         'size' => $item->size,
        //         'quantity' => $item->quantity
        //     ];
        //     // Cập nhật giá trị quantity cho mỗi sản phẩm
        //     $uniqueProducts[$productId]['quantity'] += $item->quantity;
        // }
        $count = count($cart);
        $voucher = Voucher::all();
        return view('cart', compact('cart', 'count', 'voucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'pricesale' => 'required',
            'image' => 'required',
            
            'size' => 'required',
            'quantity' => 'required',
        ]);

        $cart = new Cart($request->all());
        $existingCart = Cart::where('user_id', $cart->user_id)
            ->where('product_id', $cart->product_id)
            //  ->where('color', $cart->color)
            ->where('size', $cart->size)
            ->first();

        // Nếu tồn tại sản phẩm đó trong giỏ hàng của user thì cộng số lượng
        if ($existingCart) {
            $existingCart->quantity += (int)$cart->quantity;
            $existingCart->save();
            return response()->json(['message' => 'Số lượng sản phẩm trong giỏ hàng đã được cập nhật!']);
        } else {
            $cart->user_id = (int)$cart->user_id;
            $cart->product_id = (int) $cart->product_id;
            $cart->price = (int) $cart->price;
            $cart->pricesale = (int)$cart->pricesale;
            $cart->quantity = (int)$cart->quantity;
            $cart->save();
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $split = explode("-", $id);;
        $str = "Hzof9AqytlK5NXfeS6bxO6sWnLUgj5lU7X9PZXbFOkq4jWolzlBGYTm633xRKg0jxY3b7WSqjom7hG1VBhg9lrWFMZZCcJDfROX5cCClSP8fHsio7CKtQczZeIazBFVaGMdO3RTc";
        $userId = str_replace($str, "", $split[1]);
        $cart = Cart::where("user_id", '=', $userId)->get();
        // dd($cart);
        return view('payment', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function voucher(Request $request)
    {
        $voucherCode = $request->input('voucherCode');
        $totalCartCheck = $request->input('totalCartCheck');
        $coin = $request->input('coin');

        // Lấy ra giỏ hàng theo user_id để xem giỏ hàng đã áp dụng voucher chưa
        $cart = Cart::where('user_id', Auth::user()->id)->first();

        if ($cart) {
            $cart->update(['coin' => $coin]);
        }
        if ($voucherCode) {
            // Kiểm tra xem có tồn tại voucher không hoặc voucher còn hợp lệ không
            $voucher = Voucher::where('code', $voucherCode)->first();

            if (!$voucher || !$voucher->is_valid) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mã giảm giá không hợp lệ',
                ]);
            }

            // Kiểm tra xem voucher đã được áp dụng trước đó cho giỏ hàng chưa
            if ($cart && $cart->applied_voucher === $voucherCode) {
                return response()->json([
                    'success' => "warning",
                    'message' => 'Mã giảm giá đã được áp dụng trước đó cho giỏ hàng của bạn',
                    'discount' => $voucher->discount_amount,
                    'totalCartCheck' => $totalCartCheck,
                    'coin' => $cart->coin,
                ]);
            }
            // Kiểm tra xem tổng giá giỏ hàng có đủ điều kiện để áp dụng voucher không
            if ($totalCartCheck < $voucher->query) {
                $minus = $voucher->query - $totalCartCheck;
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn cần mua thêm ' . number_format($minus) . ' đ mới đủ điều kiện để sử dụng mã giảm giá này',
                ]);
            }

            // Nếu chưa thì cập nhật giỏ hàng với voucher mới
            if ($cart) {
                $cart->update([
                    'applied_voucher' => $voucherCode,
                    'discount_amount' => $voucher->discount_amount,
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => 'Áp dụng mã giảm giá ' . number_format($voucher->discount_amount) . ' đ thành công',
                'discount' => $voucher->discount_amount,
                'voucherCode' => $voucherCode,
                'totalCartCheck' => $totalCartCheck,
                'coin' => $coin,
            ]);
        } else {
            $cart->update([
                'applied_voucher' => "",
                'discount_amount' => 0,
            ]);
        }
        return response()->json([
            'success' => 'null',
            'totalCartCheck' => $totalCartCheck,
            'coin' => $cart->coin,
        ]);
    }
    public function changequantitycart(Request $request)
    {
        $id = $request->input('id');
        $quantity = $request->input('quantity');
        $cart = Cart::find($id);

        if ($cart) {
            $cart->update(['quantity' => $quantity]);
            $cartByIdAll = Cart::where('user_id', '=', $cart->user_id)->get();
            $priceNew = 0;
            $priceNewDiscount = 0;

            foreach ($cartByIdAll as $item) {
                $priceNew += $item->pricesale * $item->quantity;
            }

            $priceNewDiscount = $priceNew;

            if ($cartByIdAll[0]->coin > 0) {
                $priceNewDiscount -= $cartByIdAll[0]->coin;
            }

            $voucher = Voucher::where('code', '=', $cartByIdAll[0]->applied_voucher)->first();

            if ($voucher) {
                // Kiểm tra nếu tổng giá trị đơn hàng nhỏ hơn giá trị yêu cầu của voucher
                if ($priceNew < $voucher->query) {
                    $cartByIdAll[0]->update(['discount_amount' => 0, 'applied_voucher' => ""]);
                }
                if ($cartByIdAll[0]->discount_amount > 0) {
                    $priceNewDiscount -= $cartByIdAll[0]->discount_amount;
                }
            }

            if ($cart->quantity >= 1) {
                return response()->json(
                    [
                        "success" => true,
                        "message" => "Cập nhật số lượng của sản phẩm thành công",
                        'priceNew' => $priceNew,
                        'priceNewDiscount' => $priceNewDiscount,
                        'discount_amount' => $cartByIdAll[0]->discount_amount,
                        'coin' => $cartByIdAll[0]->coin,
                        'voucher' => $voucher
                    ]
                );
            } else {
                return response()->json(["success" => true, "message" => "Xoá sản phẩm khỏi giỏ hàng thành công", 'priceNew' => $priceNew, 'priceNewDiscount' => $priceNewDiscount, 'discount_amount' => $cartByIdAll[0]->discount_amount, 'coin' => $cartByIdAll[0]->coin]);
            }
        }

        return response()->json(["success" => false, "message" => "ID giỏ hàng không tồn tại"]);
    }
    // public function changequantitycart(Request $request)
    // {
    //     $id = $request->input('id');
    //     $quantity = $request->input('quantity');
    //     $cart = Cart::find($id);

    //     if ($cart) {
    //         $cart->update(['quantity' => $quantity]);
    //         $cartByIdAll = Cart::where('user_id', '=', $cart->user_id)->get();
    //         $priceNew = 0;
    //         $priceNewDiscount = 0;
    //         foreach ($cartByIdAll as $item) {
    //             $priceNew += $item->pricesale * $item->quantity;
    //         }
    //         $priceNewDiscount = $priceNew;
    //         if ($cartByIdAll[0]->discount_amount > 0) {
    //             $priceNewDiscount -= $cartByIdAll[0]->discount_amount;
    //         }
    //         if ($cartByIdAll[0]->coin > 0) {
    //             $priceNewDiscount -= $cartByIdAll[0]->coin;
    //         }
    //         $voucher = Voucher::where('code', '=', $cartByIdAll[0]->applied_voucher)->get();
    //         if ($voucher) {
    //             if ($priceNew < $voucher->query) {
    //                 $cart->update(['discount_amount' => 0, 'applied_voucher' => ""]);
    //             }
    //         }
    //         if ($cart->quantity > 1) {
    //             return response()->json(["success" => true, "message" => "Cập nhật số lượng của sản phẩm thành công", 'priceNew' => $priceNew, 'priceNewDiscount' => $priceNewDiscount, 'discount_amount' => $cartByIdAll[0]->discount_amount, 'coin' => $cartByIdAll[0]->coin]);
    //         } else {
    //             return response()->json(["success" => true, "message" => "Xoá sản phẩm khỏi giỏ hàng thành công", 'priceNew' => $priceNew, 'priceNewDiscount' => $priceNewDiscount, 'discount_amount' => $cartByIdAll[0]->discount_amount, 'coin' => $cartByIdAll[0]->coin]);
    //         }
    //     }
    //     return response()->json(["success" => false, "message" => "id giỏ hàng không tồn tại"]);
    // }
    public function deletecart(Request $request)
    {
        $id = $request->input('id');
        $cart = Cart::find($id);
        $user_id = $cart->user_id;
        if ($cart) {
            $cart->delete();
            $cartByIdAll = Cart::where('user_id', '=', $user_id)->get();
            $priceNew = 0;
            $priceNewDiscount = 0;
            if ($cartByIdAll && isset($cartByIdAll[0])) {
                $countcart = count($cartByIdAll);
                foreach ($cartByIdAll as $item) {
                    $priceNew += $item->pricesale * $item->quantity;
                }
                $priceNewDiscount = $priceNew;
                if ($cartByIdAll[0]->coin > 0) {
                    $priceNewDiscount -= $cartByIdAll[0]->coin;
                }
                $voucher = Voucher::where('code', '=', $cartByIdAll[0]->applied_voucher)->first();

                if ($voucher) {
                    // Kiểm tra nếu tổng giá trị đơn hàng nhỏ hơn giá trị yêu cầu của voucher
                    if ($priceNew < $voucher->query) {
                        $cartByIdAll[0]->update(['discount_amount' => 0, 'applied_voucher' => ""]);
                    }
                    if ($cartByIdAll[0]->discount_amount > 0) {
                        $priceNewDiscount -= $cartByIdAll[0]->discount_amount;
                    }
                }
                return response()->json([
                    "success" => true,
                    "message" => "Xoá sản phẩm khỏi giỏ hàng thành công",
                    'priceNew' => $priceNew,
                    'priceNewDiscount' => $priceNewDiscount,
                    'discount_amount' => $cartByIdAll[0]->discount_amount || 0,
                    'count' => $countcart
                ]);
            } else {
                return response()->json([
                    "success" => true,
                    "message" => "Giỏ hàng trống hãy mua thêm sản phẩm",
                    'count' => 0
                ]);
            }
        }
        return response()->json(["success" => false, "message" => "id giỏ hàng không tồn tại"]);
    }
}
