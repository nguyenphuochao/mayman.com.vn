@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Media</span></li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container">
        @if (session('type'))
            <div class="btn btn-{{ session('type') }} w-100 text-start"> {{ session('mess') }}</div>
        @endif
        <div class="row">
            @foreach ($medias as $media)
                <div class="col-2 col-sm-2 col-md-2 mt-2">
                    <img width="100%" height="188" src="{{ asset('') }}admin/uploads/images/{{ $media->image }}"
                        alt="">
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{$medias->links()}}
        </div>
    </div>
@endsection
