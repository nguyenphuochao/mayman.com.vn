@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Danh mục</span></li>
            <li class="breadcrumb-item active"><span>Thêm</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Thêm danh mục</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục cha</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">Không có</option>
                            @foreach ($cate_parents as $cate_parent)
                                <option value="{{ $cate_parent->id }}">{{ $cate_parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Hình đại diện danh mục</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10"></textarea>
                    </div>
                    <div>
                        <a href="{{ route('category.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Thêm</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
