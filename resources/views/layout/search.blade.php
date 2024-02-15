   @foreach ($products as $product)
       <div class="col-md-2 mb-2"><a href="{{ route('fe.product.show', ['slug' => $product->alias]) }}"><img
                   class="img-fluid" src="{{ asset('') }}admin/image/product/{{ $product->image }}"
                   alt="{{ $product->name }}"></a>
       </div>
       <div class="col-md-7 mt-1"><a href="{{ route('fe.product.show', ['slug' => $product->alias]) }}"
               class="text-dark text-decoration-none">{{ $product->name }}</a></div>
       <div class="col-md-3">
           @if ($product->discount != 0)
               <span class="text-danger font-weight-bold">{{ number_format($product->price_sale) }}đ</span>
               <br>
               <span class="text-danger text text-decoration-line-through">{{ number_format($product->price) }}đ</span>
           @else
               <span class="text-danger font-weight-bold">{{ number_format($product->price_sale) }}đ</span>
           @endif
       </div>
   @endforeach
