@extends('layout.app')
@section('content')
    @if (Cart::count() > 0)
        <!-- Cart -->
        <div class="container mt-4 mb-2 cart">
            <div class="row">
                <div class="col-md-8">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">SẢN PHẨM</th>
                                <th scope="col">GIÁ</th>
                                <th scope="col">SỐ LƯỢNG</th>
                                <th scope="col">TỔNG</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            @include('cart.cart_item')
                        </tbody>
                    </table>
                    <span><a href="{{ route('fe.home') }}" class="border border-danger btn btn-light rounded-0"><i
                                class="fa-solid fa-arrow-left"></i> TIẾP TỤC XEM SẢN PHẨM</a></span>
                    <span><a onclick="updateProductInCart()" href="javascript:void(0)" class="btn btn-danger rounded-0">CẬP
                            NHẬT GIỎ HÀNG</a></span>
                </div>
                <div class="col-md-4">
                    <div class="payment">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">CỘNG GIỎ HÀNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <div>Tạm tính</div>
                                            <div id="subtotal">{{ Cart::subtotal() }} đ</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <div>Tổng</div>
                                            <div id="total">{{ Cart::total() }} đ</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="{{ route('fe.payment') }}" class="btn btn-danger rounded-0 w-100">TIẾN HÀNH
                                            THANH TOÁN</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center mt-5">Chưa có sản phẩm nào trong giỏ hàng.</div>
        <div class="text-center mt-2 mb-3"><a href="{{ route('fe.home') }}" class="btn btn-danger text-light rounded-0">QUAY
                TRỞ LẠI CỬA HÀNG</a></div>
    @endif
@endsection
