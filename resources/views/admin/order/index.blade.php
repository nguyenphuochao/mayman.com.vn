@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Đơn hàng</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container table-responsive">
        @if (session('type'))
            <div class="btn btn-{{ session('type') }} w-100 text-start"> {{ session('mess') }}</div>
        @endif
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tỉnh/thành phố</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th width="15%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>{{$order->code}}</td>
                        <td>
                            {{-- Fullname --}}
                            {{ $order->customer->fullname }}
                            {{-- First name & Last name --}}
                            {{ $order->customer->last_name . ' ' . $order->customer->first_name }}

                        </td>
                        <td>{{ $order->customer->address }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->customer->province ?? 'Trống' }}</td>
                        <td>{{ $order->customer->phone }}</td>
                        <td>{{ $order->customer->email ?? 'Trống' }}</td>
                        <td>
                            @if ($order->status == 0)
                                <span class="badge bg-dark">Chờ xác nhận</span>
                            @elseif ($order->status == 1)
                                <span class="badge bg-primary">Đã xác nhận</span>
                            @elseif($order->status == 2)
                                <span class="badge bg-warning text-dark">Đang giao hàng</span>
                            @elseif($order->status == 3)
                                <span class="badge bg-success">Đã giao hàng</span>
                            @else
                                <span class="badge bg-danger">Đã hủy đơn</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('order.edit', ['order' => $order->id]) }}" class="btn btn-warning">Xem chi
                                tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
