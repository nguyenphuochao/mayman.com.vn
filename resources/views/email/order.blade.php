<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h2>Thông tin khách hàng</h2>
        <div>Khách hàng:{{ $name }}</div>
        <div>Email: {{ $email }}</div>
        <div>Điện thoại: {{ $phone }}</div>
        <div>Địa chỉ: {{ $address }}</div>
        <h2>Hóa đơn mua hàng</h2>
        <table border="1">
            <thead>
                <tr>
                    <th width="20%">Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach (Cart::content() as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            {{ number_format($item->price) }}
                        </td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->price * $item->qty) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>Tổng tiền:</td>
                    <td colspan="3" style="text-align: right;color:red">
                        {{Cart::total() }}
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>Quý khách đặt hàng thành công!</h2>
        <div>Sản phẩm của quý khách sẽ được chuyển đến địa chỉ có trong phần thông tin khách hàng của chúng tôi sau thời
            gian 2 đến 3 ngày, tính từ
            thời điểm này
        </div>
        <div>Nhân viên giao hàng sẽ liên hệ với Quý khách qua số điện thoại trước khi giao hàng 24 tiếng</div>
        <div style="font-weight: bold">Cảm ơn quý khách đã sử dụng sản phẩm của chúng tôi</div>

    </div>
</body>

</html>
