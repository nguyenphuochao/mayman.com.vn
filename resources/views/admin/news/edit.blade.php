@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Tin tức</span></li>
            <li class="breadcrumb-item active"><span>Sửa</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('news.update', ['news' => $new->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3>Sửa tin tức</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên tin tức</label>
                        <input type="text" class="form-control" placeholder="Nhập tên tin tức" name="name"
                            value="{{ $new->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Hình ảnh đại diện tin tức</label>
                        <input type="file" class="form-control" name="image">
                        <img width="200" src="{{ asset('') }}admin/image/news/{{ $new->image }}"
                            alt="">
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung chi tiết</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10">{{ $new->description }}</textarea>
                    </div>
                    <div>
                        <a href="{{ route('news.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Sửa</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
