@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Tin tức</span></li>
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
                    <th>Hình đại diện</th>
                    <th>Tên tin tức</th>
                    <th>Mô tả ngắn</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $key => $new)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>
                            <img width="100" src="{{ asset('') }}admin/image/news/{{ $new->image }}" alt="{{ $new->image }}">
                        </td>
                        <td>{{ $new->name }}</td>
                        <td>
                            @php
                            $content = $new->description;
                                $limitedString = Str::words($content, 10,'...');
                            @endphp
                            {!!$limitedString !!}
                        </td>
                        <td>
                            <a href="{{ route('news.edit', ['news' => $new->id]) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('news.destroy', ['news' => $new->id]) }}" style="display: inline-block"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Bạn chắc xóa chứ ?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
