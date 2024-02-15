<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Mayman.com.vn')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Trực tiếp kết quả xổ số kiến thiết toàn quốc | Phong Thủy Và Đời Sống - Bán Hàng Uy Tín Nhất Việt Nam">
    <meta property="og:site_name" content="Mayman.com.vn | Chuyên bán đồ phong thủy" />
    <meta property="og:title" content="Mayman.com.vn | Chuyên bán đồ phong thủy">
    <meta property="og:description"
        content="Trực tiếp kết quả xổ số kiến thiết toàn quốc | Phong Thủy Và Đời Sống - Bán Hàng Uy Tín Nhất Việt Nam">
    <meta name="keywords" content="Đồ phong thủy">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1080">
    <meta property="og:image:height" content="400">
    <meta property="og:image" content="{{ asset('assets/image/logo.png') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Owl caurosel -->
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owlcarousel/owl.theme.default.min.css') }}">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/slick/slick-theme.css') }}" />
    {{-- SweetAlert2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Link css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/detail.css') }}">

</head>

<body>
    <!-- Top menu -->
    <div class="bg-purple">
        <div class="container top-menu justify-content-between align-items-center top-menu-desktop">
            <div class="p-2">
                <a href="{{ route('fe.home') }}"><img height="140" src="{{ asset('assets/image/logo.png') }}"
                        width="150px" alt="LOGO"></a>
            </div>
            <div class="position-relative">
                <form action="{{ route('fe.product.search_post') }}" method="GET" id="search_form">
                    <input type="text" placeholder="Tìm kiếm sản phẩm..." class="form-control" name="search"
                        value="{{ request('search') }}">
                    <i class="fa-solid fa-magnifying-glass" id="fa-magnifying-glass"></i>
                </form>
                <div class="list-search-product d-none">
                    <div class="row" id="products">
                        @php
                            $products = []; // Khởi tạo rỗng để tránh bị undefined  $products
                        @endphp
                        @include('layout.search')
                    </div>
                </div>
            </div>
            <div class="contact-phone fw-500 text-light">
                <i class="fa-solid fa-phone"></i> 028.62966189
            </div>
        </div>
    </div>
    <!-- Navigation desktop -->
    <nav class="menu bg-red nav-desktop">
        <ul class="d-flex justify-content-center container">
            <li><a href="{{ route('fe.home') }}">Trang chủ</a></li>
            @foreach ($categories as $category)
                <li class="dropdown-menu-parent">
                    <a href="{{ route('fe.category.show', ['slug' => $category->slug]) }}">{{ $category->name }}
                        @if (count($category->children) > 0)
                            <i class="fa-solid fa-caret-down"></i>
                        @endif
                    </a>
                    @if (count($category->children) > 0)
                        <ul>
                            @foreach ($category->children as $item)
                                <li><a
                                        href="{{ route('fe.category.show', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
            {{-- Cart --}}
            <li class="ml-3">
                <div class="dropdown-cart">
                    <span type="button" data-toggle="dropdown" aria-expanded="false"
                        class="fw-500 fs-14 text-light text-uppercase"><i class="fa-solid fa-cart-shopping"></i>
                        (<span id="count">{{ Cart::count() }}</span>)
                        Giỏ hàng
                    </span>
                    <div class="list-cart" id="cart-items"
                        style="display: {{ (request()->segment(1) == 'gio-hang' ? 'none' : '' || request()->segment(1) == 'thanh-toan') ? 'none' : '' }}">
                        @include('layout.cart_item')
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    <!-- Navigation mobile -->
    <nav class="nav-mobile p-2 bg-purple">
        <div class="d-flex justify-content-between align-items-center">
            <div class="menu-mobile">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="#"><i class="fa-solid fa-phone fs-18"></i> <span
                            class="fs-15 fw-500">&nbsp;&nbsp;028.62966189</span></a>
                    {{-- Search form mobile --}}
                    <a href="#">
                        <form action="{{ route('fe.product.search_post') }}" method="GET" id="search_form">
                            <input type="text" placeholder="Tìm kiếm sản phẩm" name="search"
                                value="{{ request('search') }}" class="form-control">
                        </form>
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('fe.home') }}">TRANG CHỦ </a>
                    </div>
                    @foreach ($categories as $key => $category)
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('fe.category.show', ['slug' => $category->slug]) }}"
                                class="text-uppercase">{{ $category->name }} </a>
                            @if (count($category->children) > 0)
                                <i class="fa-solid fa-angle-down pr-3 menu-mobile-parent"></i>
                            @endif
                        </div>
                        @if (count($category->children) > 0)
                            <ul class="menu-mobile-child">
                                @foreach ($category->children as $item)
                                    <li><a class="text-uppercase"
                                            href="{{ route('fe.category.show', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </div>
                <span style="font-size:30px;cursor:pointer;color:white" onclick="openNav()">&#9776;</span>
            </div>
            <div><a href="{{ route('fe.home') }}"><img style="width: 110px;height: 80px;"
                        src="{{ asset('') }}assets/image/logo.png" alt="LOGO"></a></div>
            <div class="position-relative">
                <a class="text-light" href="{{ route('cart.index') }}">
                    <span class="cart-mobile" id="count">{{ Cart::count() }}</span>
                    <i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- Footer -->
    <footer class="bg-red text-light">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-4">
                    <h5>MAYMAN.COM.VN</h5>
                    <p>Mayman.com.vn cam kết sản phẩm chất lượng, dịch vụ uy tín, hỗ trợ bảo hành và đổi trả. Liên hệ
                        ngay với
                        chúng tôi để được tư vấn! 028.62966189</p>
                    <h6 class="text-light">Đây là phiên bản thử nghiệm</h6>
                </div>
                <div class="col-md-4">
                    <h5>THÔNG TIN LIÊN HỆ</h5>
                    <ul>
                        <li><a href="#">Công ty Cổ Phần May Mắn</a></li>
                        <li><a href="#">Địa chỉ: 4/6B Văn Chung, Phường 13, Tân Bình, TPHCM</a></li>
                        <li><a href="#">Điện thoại/Fax: 028.62966189</a></li>
                        <li><a href="#">Email: Saleland24h@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>CHÍNH SÁCH CHUNG</h5>
                    <ul>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Hướng dẫn thanh toán</a></li>
                        <li><a href="#">Phương thức giao nhận</a></li>
                        <li><a href="#">Chính sách đổi trả và hoàn tiền </a></li>
                        <li><a href="#">Chính sách bảo mật thông tin</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer bottom -->
    <div class="footer-bottom text-center">
        <div>Hotline: 028.62966189</div>
        <div>@Đồ phong thủy mayman.com.vn</div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            items: 1
        });
    </script>
    <!-- slick -->
    <script type="text/javascript" src="{{ asset('assets/slick/slick.min.js') }}"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
