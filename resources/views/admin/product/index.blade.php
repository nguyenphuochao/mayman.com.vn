@extends('admin.layout.app')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
                <span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Sản phẩm</span></li>
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
                    <th>Tên sản phẩm</th>
                    <th>Hình đại diện</th>
                    <th>Danh mục</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Giảm giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td scope="row">{{ ++$key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img width="100" src="../admin/image/product/{{ $product->image }}"
                                alt="{{ $product->image }}">
                        </td>
                        <td>
                            {{ $product->category->name }}
                        </td>
                        <td>{{ $product->qty }}</td>
                        <td>
                            @if ($product->discount == 0)
                                <span>{{ number_format($product->price) }}</span>
                            @else
                                <span>{{ number_format($product->price_sale) }}</span> <br>
                                <span class="text-decoration-line-through">{{ number_format($product->price) }}</span>
                            @endif

                        </td>
                        <td>{{ $product->discount }}%</td>
                        <td>
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                class="btn btn-warning">Sửa</a>
                            <form action="{{ route('product.destroy', ['product' => $product->id]) }}"
                                style="display: inline-block" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Bạn chắc xóa chứ ?')">Xóa</button>
                            </form>
                            <a href="{{route('fe.product.show',['slug'=>$product->alias])}}" class="btn btn-success mt-1">Xem chi tiết</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
