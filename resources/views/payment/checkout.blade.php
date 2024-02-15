@extends('layout.app')
@section('content')
    <!-- Checkout -->
    <div class="checkout container">
        <form action="{{ route('fe.payment.store') }}" method="POST">
            @csrf
            <div class="row pt-4">
                <div class="col-md-7">
                    <h5><strong>Thông tin thanh toán</strong></h5>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name"><strong>Tên*</strong></label>
                            <input type="text" class="form-control" name="first_name" id="first_name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name"><strong>Họ*</strong></label>
                            <input type="text" class="form-control" name="last_name" id="last_name" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address"><strong>Địa chỉ*</strong></label>
                            <input type="text" class="form-control" placeholder="Địa chỉ" name="address" id="address" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="province"><strong>Tỉnh/thành phố*</strong></label>
                            <input type="text" class="form-control" name="province" id="province" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="phone"><strong>Số điện thoại*</strong></label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="email"><strong>Email*</strong></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <h5><strong>Thông tin bổ sung</strong></h5>
                            <label for="note"><strong>Ghi chú đơn hàng (tuỳ chọn)</strong></label>
                            <textarea name="note" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bills">
                        <h5>Đơn hàng của bạn</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex justify-content-between">
                                            <div>SẢN PHẨM</div>
                                            <div>TẠM TÍNH</div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::content() as $item)
                                    <tr>
                                        <td scope="row">
                                            <div class="d-flex justify-content-between">
                                                <div>{{ $item->name }} × {{ $item->qty }}</div>
                                                <div class="font-weight-bold text-danger">
                                                    {{ number_format($item->price * $item->qty) }}₫</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex justify-content-between">
                                            <div>Tạm tính</div>
                                            <div class="text-danger">{{ Cart::subtotal() }}₫</div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex justify-content-between">
                                            <div>Tổng</div>
                                            <div class="text-danger">{{ Cart::total() }}₫</div>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <td scope="row">
                                        <label class="font-weight-bold"><input type="radio" name="payment"
                                                value="Chuyển khoản ngân hàng"> Chuyển khoản ngân hàng</label>
                                        <div style="display: none;" class="payment-sumary">Chờ cập nhật...</div>
                                        <label class="font-weight-bold"><input type="radio" name="payment"
                                                value="Trả tiền mặt khi nhận hàng" checked> Trả tiền mặt khi nhận hàng</label>
                                        <div style="display: block;" class="payment-sumary">Trả tiền mặt khi giao hàng</div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <button class="btn btn-danger rounded-0 font-weight-bold">ĐẶT HÀNG</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
