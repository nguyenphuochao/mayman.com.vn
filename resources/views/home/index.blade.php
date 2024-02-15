@extends('layout.app')
@section('title', 'Mayman.com.vn | Chuyên bán đồ phong thủy')
@section('content')
    <!-- Banner -->
    {{-- <div class="owl-carousel owl-theme">
    <div class="item"><img src="{{ asset('assets/image/slider/SLIDER-01.jpg') }}" alt=""></div>
    <div class="item"><img src="{{ asset('assets/image/slider/SLIDER-02.jpg') }}" alt=""></div>
</div> --}}
    <!-- Sổ số kiến thiết -->
    <div class="container kqxs mt-5">
        <div class="row">
            <div class="col-md-3 d-none d-md-block">
                <h6 class="text-center text-uppercase p-1 title" style="border: 2px solid #9f9b9b;padding: 5px;">Sản phẩm
                    mới
                </h6>
                <div class="row">
                    @foreach ($new_product_left as $key => $item)
                        <div class="col-md-6 mb-2">
                            <div class="product text-center">
                                <a href="{{ route('fe.product.show', ['slug' => $item->alias]) }}"><img
                                        src="{{ asset('') }}admin/image/product/{{ $item->image }}"
                                        alt="{{ $item->name }}"></a>
                                <h6 class="text-truncate mt-2 fs-12 text-uppercase">{{ $item->name }}</h6>
                                <div class="price">
                                    @if ($item->discount == 0)
                                        <div class="text-red font-weight-bold pt-4 text-truncate">
                                            {{ number_format($item->price_sale) }}<u>đ</u></div>
                                    @else
                                        <div class="text-decoration-line-through text-muted text-truncate">
                                            {{ number_format($item->price) }}đ</div>
                                        <div class="text-red font-weight-bold text-truncate">
                                            {{ number_format($item->price_sale) }}<u>đ</u></div>
                                    @endif
                                </div>
                                <a href="javascript:void(0)"
                                    class="bg-red p-1 add-to-cart text-light fs-13 text-decoration-none text-truncate"
                                    product-id="{{ $item->id }}">Mua ngay</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!----Start Kết quả sổ số nằm ở đây -->
            <div class="col-12 col-md-6">
                <iframe src="https://www.xoso.net/free/index.php" width="100%" frameborder="0" scrolling="auto"
                    id="iframe_xosominhngoc" name="iframe_xosominhngoc"></iframe>
            </div>
            <!--- End Kết quả sổ số nằm ở đây -->
            <div class="col-md-3 d-none d-md-block">
                <h6 class="text-center text-uppercase p-1 title" style="border: 2px solid #9f9b9b;padding: 5px;">Sản phẩm
                    nổi bật</h6>
                <div class="row">
                    @foreach ($new_product_right as $key => $item)
                        <div class="col-md-6 mb-2">
                            <div class="product text-center">
                                <a href="{{ route('fe.product.show', ['slug' => $item->alias]) }}"><img
                                        src="{{ asset('') }}admin/image/product/{{ $item->image }}"
                                        alt="{{ $item->name }}"></a>
                                <h6 class="text-truncate mt-2 fs-12 text-uppercase">{{ $item->name }}</h6>
                                <div class="price">
                                    @if ($item->discount == 0)
                                        <div class="text-red font-weight-bold pt-4 text-truncate">
                                            {{ number_format($item->price_sale) }}<u>đ</u></div>
                                    @else
                                        <div class="text-decoration-line-through text-muted text-truncate">
                                            {{ number_format($item->price) }}đ</div>
                                        <div class="text-red font-weight-bold text-truncate">
                                            {{ number_format($item->price_sale) }}<u>đ</u></div>
                                    @endif
                                </div>
                                <a href="javascript:void(0)"
                                    class="bg-red p-1 add-to-cart text-light fs-13 text-decoration-none text-truncate"
                                    product-id="{{ $item->id }}">Mua ngay</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <!-- Info Company -->
    <section class="info-company mb-4 mt-4" style="background: #F4F4F4">
        <div class="container p-3" style="background: white">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2">
                            <i class="text-red fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10">
                            <h6 class="text-red">SALE KHỦNG ĐẾN 50%</h6>
                            <h6>SALE MẠNH, SALE SẬP SÀN</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2">
                            <i class="text-red fa-solid fa-truck"></i>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10">
                            <h6 class="text-red">GIAO NHANH 1-2H</h6>
                            <h6>THEO YÊU CẦU</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2">
                            <i class="text-red fa-solid fa-headphones-simple"></i>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10">
                            <h6 class="text-red">MIỄN PHÍ ĐỔI HÀNG</h6>
                            <h6>TRONG 30 NGÀY LỖI NSX</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2">
                            <i class="text-red fa-solid fa-arrow-rotate-left"></i>
                        </div>
                        <div class="col-10 col-sm-10 col-md-10">
                            <h6 class="text-red">BẢO HÀNH 3 THÁNG</h6>
                            <h6>ĐÔNG CƠ VẪY TAY</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- List Product -->
    @php
        $index = 0;
    @endphp
    @foreach ($productCate as $cate_name => $products)
        @if (count($products) > 0)
            @if ($index == 0)
                <div class="banner-full mt-3 mb-1 container">
                    <img width="100%" src="{{ asset('') }}admin/image/home-image/{{ $home_image[0]['image'] }}"
                        alt="">
                </div>
            @endif
            {{-- List Product for category --}}
            <section class="list-product mb-4">
                <div class="title pt-2">
                    <div class="d-flex align-items-center justify-content-around">
                        <div class="d-none d-md-block"></div>
                        <h3>{{ $cate_name }}</h3>
                        @php
                            $slug = Str::slug($cate_name);
                        @endphp
                        <h6><a class="text-dark" href="{{ route('fe.category.show', ['slug' => $slug]) }}">Xem tất cả <i
                                    class="fa-solid fa-chevron-right"></i></a></h6>
                    </div>
                </div>
                <div class="products container">
                    <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-5">
                        @foreach ($products as $product)
                            <div class="col mt-2">
                                <div class="product text-center">
                                    @if ($product->discount != 0)
                                        <div class="discount">{{ $product->discount }}%</div>
                                    @endif

                                    <a href="{{ route('fe.product.show', ['slug' => $product->alias]) }}"><img
                                            width="100%"
                                            src="{{ asset('') }}admin/image/product/{{ $product->image }}"
                                            alt="{{ $product->name }}"></a>
                                    <a class="text-dark"
                                        href="{{ route('fe.product.show', ['slug' => $product->alias]) }}">
                                        <h6 class="text-truncate mt-2">{{ $product->name }}</h6>
                                    </a>
                                    <div class="price mb-2">
                                        @if ($product->discount == 0)
                                            <span
                                                class="text-red font-weight-bold d-block home-price-mobile">{{ number_format($product->price) }}<u>đ</u></span>
                                        @else
                                            <span
                                                class="text-decoration-line-through text-muted">{{ number_format($product->price) }}đ</span>
                                            <span
                                                class="text-red font-weight-bold">{{ number_format($product->price_sale) }}<u>đ</u></span>
                                        @endif

                                    </div>
                                    <a href="javascript:void(0)" class="bg-red p-1 add-to-cart"
                                        product-id="{{ $product->id }}">Mua
                                        ngay</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="banner-full mt-3 container">
                    <img width="100%"
                        src="{{ asset('') }}admin/image/home-image/{{ $home_image[++$index]['image'] }}"
                        alt="">
                </div>
            </section>
        @endif
    @endforeach
    <!-- List News -->
    <section class="list-news">
        <div class="title">
            <div class="d-flex align-items-center justify-content-around">
                <div class="d-none d-md-block"></div>
                <h3>TIN TỨC, VIDEO</h3>
                <h6>Xem tất cả <i class="fa-solid fa-chevron-right"></i></h6>
            </div>
        </div>
        <div class="news container">
            <div class="row">
                @foreach ($news as $new)
                    <div class="col-md-3">
                        <a href="#"><img class="mb-2" width="100%" height="165" src="{{ asset('') }}admin/image/news/{{ $new->image }}" alt="{{ $new->name }}"></a><br>
                        <span><i class="fa-solid fa-folder"></i> Tin tức</span>
                        <span class="ml-2"><i class="fa-solid fa-user"></i> Admin</span>
                        <h6 class="mt-2"><a href="#" class="text-dark text-decoration-none">{{ $new->name }}</a></h6>
                        @php
                            $content = strip_tags($new->description);
                            $limitedWords = Str::words($content, 13, '...');
                        @endphp
                        <p class="text-truncate">{!! $limitedWords !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
