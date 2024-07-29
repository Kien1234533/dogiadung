<div id="sendmailorder">
    <h1 class="title" style="font-size: 30px;font-weight:600;color:#000">Thank you for ordering from Shop.CO</h1>
    <div class="content" style="font-size: 16px; line-height:20px;margin-bottom:20px">
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Mã đơn hàng:</span>
            {{ $orderData['ordercode'] }}
        </p>
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Tên khách hàng:</span>
            {{ $orderData['name'] }}
        </p>
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Số điện thoại:</span>
            {{ $orderData['phone'] }}
        </p>
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Địa chỉ:</span>
            {{ $orderData['address'] }}
        </p>
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Phương thức thanh toán:</span>
            {{ $orderData['payment_method'] }}
        </p>
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Tổng cộng:</span>
            {{ number_format($orderData['total'], 0) }}đ
        </p>
        @if ($orderData['note'])
            <p style="margin:0;padding:0;color:#888">
                <span style="font-weight:600;color:#000">Ghi chú:</span>
                {{ $orderData['note'] }}
            </p>
        @endif
        <p style="margin:0;padding:0;color:#888">
            <span style="font-weight:600;color:#000">Ngày đặt hàng:</span>
            {{ $orderData['created_at'] }}
        </p>
    </div>
    <table class="product"
        style="width:100%; border-collapse: collapse; margin-bottom: 20px;overflow-x: scroll; border-bottom: 1px solid #000;">
        <thead>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Mã sản phẩm</th>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Tên sản phẩm</th>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Số lượng</th>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Màu sắc</th>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Kích thước</th>
            <th
                style="border-bottom:1px solid #000;padding:10px;text-align:center;color:#fff;text-transform:uppercase;font-weight:600;font-size:14px;background:#000;padding:8px">
                Giá tiền</th>
        </thead>
        <tbody>
            @foreach (json_decode($orderData['cartlist']) as $item)
                <tr>
                    <td class="code"
                        style="font-size: 14px;min-width:70px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ $item->code }}</td>
                    <td class="name"
                        style="font-size: 14px;min-width:150px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ $item->name }}</td>
                    <td class="quantity"
                        style="font-size: 14px;min-width:50px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ $item->quantity }}</td>
                    {{-- <td class="color"
                        style="font-size: 14px;min-width:50px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ $item->color }}</td> --}}
                    <td class="size"
                        style="font-size: 14px;min-width:50px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ $item->size }}</td>
                    <td class="price"
                        style="font-size: 14px;min-width:50px; vertical-align: middle; border-bottom: 1px solid #000; padding: 10px;  text-align: center;">
                        {{ number_format($item->pricesale) }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
