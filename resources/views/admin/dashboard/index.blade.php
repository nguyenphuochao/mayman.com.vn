@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-primary">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold">{{ count($products) }} <span class="fs-6 fw-normal"></span>
                                </div>
                                <div>
                                    <h4>Sản phẩm</h4>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-info">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold">{{ count($categories) }} <span class="fs-6 fw-normal"></span>
                                </div>
                                <div>
                                    <h4>Danh mục</h4>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-warning">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold">{{ count($orders) }} <span class="fs-6 fw-normal"></span>
                                </div>
                                <div>
                                    <h4>Đơn hàng</h4>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3" style="height:50px;">

                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-danger">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal"></span></div>
                                <div>
                                    <h4>Đang cập nhật...</h4>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- Table -->
            <h5>Đơn hàng</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
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
                                <td>{{ $order->code }}</td>
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
                                    <a href="{{ route('order.edit', ['order' => $order->id]) }}"
                                        class="btn btn-warning">Xem chi
                                        tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row-->
        </div>
    </div>
@endsection
