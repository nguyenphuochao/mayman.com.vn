@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Sản phẩm</span></li>
            <li class="breadcrumb-item active"><span>Thêm</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Thêm sản phẩm</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Vui lòng chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Giá sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập giá sản phẩm" name="price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Số lượng sản phẩm</label>
                        <input type="text" class="form-control" placeholder="Nhập số lượng sản phẩm" name="qty"
                            value="{{ old('qty') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Phần trăm giảm giá</label>
                        <input type="text" class="form-control" placeholder="Nhập % giảm giá" name="discount"
                            value="0">
                    </div>
                    <div class="form-group">
                        <label for="name">Hình ảnh đại diện sản phẩm</label>
                        <input type="file" class="form-control" name="image" value="{{old('image')}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Hình ảnh thu nhỏ(chọn nhiều)</label>
                        <input type="file" multiple class="form-control" name="thumbnail-image[]">
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung tóm tắt</label> <br>
                        <textarea class="ckeditor" name="summary" id="" cols="80" rows="10">{{old('summary')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung chi tiết</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10">{{old('description')}}</textarea>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('product.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Thêm</button>
                        <input type="reset" value="Reset" class="btn btn-secondary">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
