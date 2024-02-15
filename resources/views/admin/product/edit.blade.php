@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Sản phẩm</span></li>
            <li class="breadcrumb-item active"><span>Sửa</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3>Sửa sản phẩm</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name"
                            value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Vui lòng chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option @if ($category->id == $product->category_id) {{ 'selected' }} @endif
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Giá sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập giá sản phẩm" name="price"
                            value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Số lượng sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập số lượng sản phẩm" name="qty"
                            value="{{ $product->qty }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Phần trăm giảm giá</label>
                        <input type="text" class="form-control" placeholder="Nhập % giảm giá" name="discount"
                            value="{{ $product->discount }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Hình ảnh đại diện sản phẩm</label>
                        <input type="file" class="form-control" name="image">
                        <img width="200" src="{{ asset('') }}admin/image/product/{{ $product->image }}"
                            alt="">
                    </div>
                    <div class="form-group mt-2">
                        <label for="name">Hình ảnh thu nhỏ(chọn nhiều)</label>
                        <input type="file" multiple class="form-control" name="thumbnail-image[]">
                        @foreach ($product->product_images as $product_image)
                            <img width="150" height="150"
                                src="{{ asset('') }}admin/image/product-thumbnail/{{ $product_image->image }}" alt="">
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung tóm tắt</label> <br>
                        <textarea class="ckeditor" name="summary" id="" cols="80" rows="10">{{ $product->summary }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung chi tiết</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10">{{ $product->description }}</textarea>
                    </div>
                    <div>
                        <a href="{{ route('product.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Sửa</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
