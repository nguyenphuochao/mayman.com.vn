@extends('layout.app')
@section('title', $product->name)
@section('content')
    <!-- Detail -->
    <div class="detail mt-md-4 mb-2 container">
        <div class="row pt-3">
            <div class="col-md-4">
                <div class="big-img"><img width="100%" height="350"
                        src="{{ asset('') }}admin/image/product/{{ $product->image }}" alt="{{ $product->name }}"></div>
                <div class="thumbnail-image mt-2">
                    <div class="multiple-items">
                        @foreach ($product->product_images as $key => $product_image)
                            <div><img class="{{ $key == 0 ? 'active' : '' }}" width="85" height="85"
                                    src="{{ asset('') }}admin/image/product-thumbnail/{{ $product_image->image }}"
                                    alt=""></div>
                        @endforeach
                    </div>
                </div>
                @if ($product->discount != 0)
                    <div class="discount">{{ $product->discount }}%</div>
                @endif

            </div>
            <div class="col-md-5">
                <!-- breadcrum -->
                <div class="breadcrum">
                    <span><a class="text-danger" href="{{ route('fe.home') }}">Trang chủ</a></span> /
                    <span><a class="text-danger" href="#">{{ $product->category->name }}</a></span> /
                    <span><a class="text-dark" href="#">{{ $product->name }}</a></span>
                </div>
                <div class="title mt-2">
                    <h4>{{ $product->name }}</h4>
                </div>
                <div class="d-flex align-items-center">
                    @if ($product->discount == 0)
                        <div class="price text-left">
                            <h4 class="fw-500 text-danger">{{ number_format($product->price_sale) }}₫</h4>
                        </div>
                    @else
                        <div class="price-sale">
                            <h5 class="text-decoration-line-through text-grey">{{ number_format($product->price) }}đ</h5>
                        </div>
                        <div class="price ml-3">
                            <h4 class="fw-500 text-danger">{{ number_format($product->price_sale) }}₫</h4>
                        </div>
                    @endif
                </div>
                <div class="content">
                    {!! $product->summary !!}
                </div>
                <div class="mt-1">
                    <input type="number" id="qty" value="1" min="1" style="width: 50px;height: 38px;">
                    <input type="hidden" id="qty_product" value="{{ $product->qty }}">
                    <a href="javascript:void(0)" class="btn btn-danger rounded-0 mb-1" product-id={{ $product->id }}
                        id="add-to-cart">Mua ngay</a>
                </div>
                <div class="buy-now mt-1 mb-1">
                    <button onclick="buyNow()" class="btn btn-danger rounded-0 w-100" data-toggle="modal" data-target="#exampleModalCenter">
                        ĐẶT MUA NGAY <br>
                        Nhân viên sẽ xác nhận đơn hàng sớm nhất
                    </button>
                    <!-- Modal payment-->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="z-index: 100000">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Đặt hàng sản phẩm này
                                        {{ $product->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img class="img-fluid"
                                                        src="{{ asset('') }}admin/image/product/{{ $product->image }}"
                                                        alt="">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="name font-weight-bold fs-18">{{ $product->name }}</div>
                                                    <div class="price font-weight-bold text-danger fs-16">
                                                        {{ number_format($product->price_sale) }}<u>đ</u></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="fs-15">Bạn vui lòng nhập đúng số điện thoại để chúng tôi sẽ
                                                        gọi xác nhận đơn hàng trước khi giao hàng. Xin cảm ơn!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('fe.payment.buy_now') }}" id="form_buy_now">
                                                <input type="hidden" name="_token" id="token"
                                                    value="{{ csrf_token() }}">
                                                <input type="hidden" name="price" id="price" value="{{ $product->price_sale }}">
                                                <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                                <div class="fs-16 font-weight-bold title-info">Thông tin người mua</div>
                                                <label><input type="radio" checked name="genger">Nam</label>
                                                <label class="ml-3"><input type="radio" name="genger">Nữ</label>
                                                <input type="text" placeholder="Họ và tên" class="form-control"
                                                    name="name">
                                                <input type="text" placeholder="Số điện thoại"
                                                    class="form-control mt-1" name="phone">
                                                <input type="text" placeholder="Địa chỉ email(Không bắt buộc)"
                                                    class="form-control mt-1" name="email">
                                                <textarea name="address" class="form-control mt-1" cols="30" rows="3" placeholder="Địa chỉ nhận hàng"></textarea>
                                                <textarea name="note" class="form-control mt-1" cols="30" rows="3"
                                                    placeholder="Ghi chú đơn hàng(Không bắt buộc)"></textarea>
                                                <div class="mt-1">Tổng: <span
                                                        class="font-weight-bold" id="subtotal">{{ number_format($product->price_sale) }}đ</span>
                                                </div>
                                                <button id="buy-now" type="button"
                                                    class="btn btn-danger rounded-0 mt-1 w-100 buy-now">ĐẶT HÀNG
                                                    NGAY</button>
                                                <div class="buy-now-error text-danger">
                                                    <div id="error_name"></div>
                                                    <div id="error_phone"></div>
                                                    <div id="error_address"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--- Model đặt hàng thành công---->
                    <div class="modal fade" id="order_received" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Đặt hàng sản phẩm
                                        này
                                        {{ $product->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="fs-22">Đặt hàng thành công!</h5>
                                    <div>Chúng tôi sẽ liên hệ với bạn trong 12h tới. Cám ơn bạn đã cho chúng tôi cơ hội được
                                        phục vụ. Hotline: 028.62966189</div>
                                    <div>Ghi chú: Đơn hàng chỉ có hiệu lực trong vòng 48h</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layout.sidebar')
            <div class="col-md-10">
                <hr>
                <!-- Description -->
                <div class="description">
                    <h5>Mô tả chi tiết</h5>
                    {!! $product->description !!}
                </div>
                <hr>
                <!-- Comment -->
                <div class="comment">
                    <form action="#">
                        <textarea class="form-control" placeholder="Mời bạn tham gia bình luận, vui lòng nhập tiếng việt có dấu"
                            name="content" id="" cols="30" rows="10"></textarea>
                        <div class="row p-3">
                            <div class="col-md-3 text-center my-auto">
                                <input type="radio" name="gender" checked> <strong>Anh</strong>
                                <input type="radio" name="gender"> <strong>Chị</strong>
                            </div>
                            <div class="col-md-4 mt-1">
                                <input type="text" name="fullname" placeholder="Họ tên (Bắt buộc)"
                                    class="form-control">
                            </div>
                            <div class="col-md-4 mt-1">
                                <input type="text" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="col-md-1 mt-1">
                                <button class="btn btn-primary">Gửi</button>
                            </div>
                        </div>
                    </form>
                    <div class="list-comment mt-2">
                        <h6>Chưa có bình luận nào</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
