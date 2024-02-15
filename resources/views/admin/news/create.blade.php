@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Tin tức</span></li>
            <li class="breadcrumb-item active"><span>Thêm</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Thêm tin tức</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên tin tức</label>
                        <input type="text" class="form-control" placeholder="Nhập tên tin tức" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Hình ảnh đại diện sản phẩm</label>
                        <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung chi tiết</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('news.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Thêm</button>
                        <input type="reset" value="Reset" class="btn btn-secondary">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
