@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Hình trang chủ</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container table-responsive">
        @if (session('type'))
            <div class="btn btn-{{ session('type') }} w-100 text-start"> {{ session('mess') }}</div>
        @endif
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên hình</th>
                    <th>Hình ảnh</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($home_images as $key => $home_image)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>{{ $home_image->name }}</td>
                        <td>
                            <img width="100" src="{{ asset('') }}admin/image/home-image/{{ $home_image->image }}"
                                alt="{{ $home_image->image }}">
                        </td>
                        <td>
                            {{ $home_image->category->name }}
                        </td>
                        <td>
                            <a href="{{ route('home-image.edit',['home_image'=>$home_image->id]) }}"
                                class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
