@if (Cart::count() > 0)
    <div class="row">
        <!-- Start cart item -->
        @php
            foreach (Cart::content() as $rowId => $item) :
        @endphp

            <div class="col-md-3 mt-2">
                <img class="img-fluid" src="{{asset('')}}admin/image/product/{{ $item->options->image }}" alt="{{ $item->name }}">
            </div>
            <div class="col-md-7 mt-2">
                <h6>{{ $item->name }}</h6>
                <h6>{{ $item->qty }} x {{ number_format($item->price) }} đ</h6>
            </div>
            <div class="col-md-2 mt-2"><a href="javascript:void(0)" onclick="deleteProductInCart('{{$rowId}}')"  class="text-dark"><i class="fa-regular fa-circle-xmark"></i></a></div>
            <hr class="w-100">
      @php
          endforeach
      @endphp
        <!-- End cart item -->
    </div>
    <div class="row" id="cart-total">
        <div class="col-md-12 text-center sub-total">
            <hr>
            <h6>Tổng số phụ: <span id="subtotal">{{ Cart::subtotal() }}</span> đ</h6>
            <hr>
        </div>
        <div class="col-md-12">
            <div><a href="{{ route('cart.index') }}" class="btn btn-danger w-100">XEM GIỎ HÀNG</a></div>
            <div class="mt-1"><a href="{{route('fe.payment')}}" class="btn btn-danger w-100">THANH TOÁN</a></div>
        </div>
    </div>
@else
    <div class="p-2">Chưa có sản phẩm trong giỏ hàng</div>
@endif
