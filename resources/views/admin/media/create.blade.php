@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item"><span>Media</span></li>
            <li class="breadcrumb-item active"><span>Thêm</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container">
        @include('admin.layout.error')
        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" class="form-control">
            <button class="btn btn-primary mt-2">Thêm</button>
        </form>
    </div>
@endsection
