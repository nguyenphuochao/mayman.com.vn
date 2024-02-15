@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Đơn hàng</span></li>
            <li class="breadcrumb-item active"><span>Chi tiết đơn hàng</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <h3>Chi tiết đơn hàng</h3>
        <div class="info-customer">
            <div class="row">
                <div class="col-md-12">
                    <div class="container123 col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-md-4">Thông tin khách hàng</th>
                                    <th class="col-md-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Thông tin người đặt hàng</td>
                                    <td>
                                        {{ $order->customer->fullname }}
                                        {{ $order->customer->last_name . ' ' . $order->customer->first_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ngày đặt hàng</td>
                                    <td>{{ $order->order_date }}</td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td>{{ $order->customer->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td>{{ $order->customer->address }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $order->customer->email }}</td>
                                </tr>
                                <tr>
                                    <td>Ghi chú</td>
                                    <td>{{ $order->note }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered table-hover dataTable" role="grid"
                        aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting col-md-1">STT</th>
                                <th class="sorting_asc col-md-4">Tên sản phẩm</th>
                                <th class="sorting col-md-2">Số lượng</th>
                                <th class="sorting col-md-2">Giá tiền</th>
                        </thead>
                        <tbody>
                            @foreach ($order->order_details as $key => $order_detail)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $order_detail->product->name }}</td>
                                    <td>{{ $order_detail->qty }}</td>
                                    <td>{{ number_format($order_detail->price) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"><b>Tổng tiền</b></td>
                                <td colspan="1"><b class="text-danger"> {{ number_format($order_detail->order->total) }}
                                        VNĐ</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 mt-2">
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form action="{{ route('order.update', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label><strong>Trạng thái giao hàng</strong></label>
                                        <select name="status" class="status">
                                            <option value="0" {{$order->status == 0 ? 'selected' : ''}}>Chờ xác nhận</option>
                                            <option value="1" {{$order->status == 1 ? 'selected' : ''}}>Đã xác nhận</option>
                                            <option value="2" {{$order->status == 2 ? 'selected' : ''}}>Đang giao hàng</option>
                                            <option value="3" {{$order->status == 3 ? 'selected' : ''}}>Đã giao hàng</option>
                                            <option value="4" {{$order->status == 4 ? 'selected' : ''}}>Hủy đơn hàng</option>
                                        </select>
                                        <button class="btn btn-primary">Xử lý</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
