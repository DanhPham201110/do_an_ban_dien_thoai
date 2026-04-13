<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
        }
    </style>
</head>
<body>
<h2>HÓA ĐƠN ĐIỆN TỬ</h2>
<p>Mã đơn hàng: {{ $order->id }}</p>
<p>Tên khách hàng: {{ $order->name }}</p>
<p>Số điện thoại: {{ $order->number_phone }}</p>
<p>Địa chỉ: {{ $order->address }}</p>

<table class="table ">
    <thead class="table-light sticky-top top-0">
    <tr>
        <th scope="col" width="5%">ID</th>
        <th scope="col" width="25%">Sản phẩm</th>
        <th scope="col" width="25%">Giá</th>
        <th scope="col" width="25%">Số lượng</th>
        <th scope="col" width="25%">Tổng</th>
    </tr>
    </thead>
    <tbody>
    @php
        $items = json_decode($order->product_json);
    @endphp
    @if(count($items) > 0)
        @foreach($items as $item)
            <tr>
                <th scope="row">{{ $item->id }}</th>
                <td>
                    {{ $item->name }}
                </td>
                <td>
                    {{ number_format((int) $item->price) }} VNĐ
                </td>
                <td style="text-align: center">
                    {{ number_format($item->amount) }}
                </td>
                <td>
                    {{ number_format((int) $item->price * $item->amount) }} VNĐ
                </td>
            </tr>
        @endforeach
        <tr>
            <td style="font-weight: bold; color: red" colspan="4">Tổng thanh toán</td>
            <td style="font-weight: bold; color: red">{{ number_format($order->total) }} VNĐ</td>
        </tr>
    @else
        <tr>
            <td colspan="7">Không có dữ liệu</td>
        </tr>
    @endif
    </tbody>
</table>
</body>
</html>
