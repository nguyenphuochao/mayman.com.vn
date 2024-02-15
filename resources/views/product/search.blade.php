@extends('layout.app')
@section('title')
    Kết quả tìm kiếm: "{{ request('search') }}" | Mayman.com.vn
@endsection
@section('content')
    <!-- Category -->
    <div class="category mb-2">
        <!-- Menu breadcrumd and filter -->
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-6">
                    <h5><strong>Kết quả tìm kiếm: "{{ request('search') }}"</strong></h5>
                    <div class="breadcrumd">
                        <span><a class="text-danger" href="{{ route('fe.home') }}">Trang chủ</a></span> /
                        <span class="text-danger">Cửa hàng</span> /
                        <span>Kết quả tìm cho "{{ request('search') }}"</span>
                    </div>
                </div>
                <div class="col-md-3 text-md-right mt-2">
                    <div class="title-filter">Hiển thị kết quả duy nhất</div>
                </div>
                <div class="col-md-3">
                    <select name="" class="form-control">
                        <option value="">Thứ tự theo mức độ phổ biến</option>
                        <option value="">Mới nhất</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- List product for category -->
        <div class="list-product pt-2 pb-2 mt-3">
            <div class="products container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col col-6 col-sm-6 col-md-3 mt-2">
                                    <div class="product text-center">
                                        @if ($product->discount != 0)
                                            <div class="discount">{{ $product->discount }}%</div>
                                        @endif
                                        <a href="{{ route('fe.product.show', ['slug' => $product->alias]) }}"><img
                                                width="100%" height="200"
                                                src="{{ asset('') }}admin/image/product/{{ $product->image }}"
                                                alt="{{ $product->name }}"></a>
                                        <h6 class="text-truncate">{{ $product->name }}</h6>
                                        <div class="price mb-2">
                                            @if ($product->discount == 0)
                                                <span
                                                    class="text-red font-weight-bold d-block pt-4">{{ number_format($product->price_sale) }}đ</span>
                                            @else
                                                <span
                                                    class="text-decoration-line-through text-muted d-block">{{ number_format($product->price) }}đ</span>
                                                <span
                                                    class="text-red font-weight-bold">{{ number_format($product->price_sale) }}đ</span>
                                            @endif
                                        </div>
                                        <a href="javascript:void(0)" class="bg-red p-1 add-to-cart"
                                            product-id="{{ $product->id }}">Mua ngay</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Sidebar -->
                    @include('layout.sidebar')
                </div>
            </div>
        </div>
    </div>
@endsection
