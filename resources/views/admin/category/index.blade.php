@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Danh mục</span></li>
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
                    <th>Tên danh mục</th>
                    <th>Danh mục cha</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $key => $category)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            @if ($category->parent_id == 0)
                                Không có
                            @else
                                {{ $category->parent->name }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('category.edit', ['category' => $category->id]) }}"
                                class="btn btn-warning">Sửa</a>
                            <form action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                style="display: inline-block" method="POST">
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
