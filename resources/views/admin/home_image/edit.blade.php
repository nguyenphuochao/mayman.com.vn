@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Danh mục</span></li>
            <li class="breadcrumb-item active"><span>Hình danh mục trang chủ</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('home-image.update', ['home_image' => $home_image->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3>Sửa hình danh mục trang chủ</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên danh mục hình</label>
                        <input type="text" class="form-control" name="name" value="{{ $home_image->name }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Hình đại diện</label>
                        <input type="file" class="form-control" name="image">
                        <img width="200" src="{{ asset('')}}admin/image/home-image/{{$home_image->image }}" alt="">
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('home-image.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Sửa</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
