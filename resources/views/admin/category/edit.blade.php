@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Danh mục</span></li>
            <li class="breadcrumb-item active"><span>Sửa</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container mb-2">
        @include('admin.layout.error')
        <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3>Sửa danh mục</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Danh mục cha</label>
                        <select name="parent_id" class="form-control">
                            <option value="0">Không có</option>
                            @foreach ($cate_parents as $cate_parent)
                                <option @if ($cate_parent->id == $category->parent_id) {{ 'selected' }} @endif
                                    value="{{ $cate_parent->id }}">{{ $cate_parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Hình đại diện danh mục</label>
                        <input type="file" class="form-control" name="image">
                        <img width="200" src="{{ asset('admin/image/category') . '/' . $category->image }}"
                            alt="">
                    </div>
                    <div class="form-group">
                        <label for="name">Nội dung</label> <br>
                        <textarea class="ckeditor" name="description" id="" cols="80" rows="10">{{$category->description}}</textarea>
                    </div>
                    <div>
                        <a href="{{ route('category.index') }}" class="btn btn-warning">Quay về</a>
                        <button class="btn btn-primary">Sửa</button>
                        <input type="reset" class="btn btn-secondary" value="Reset">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
