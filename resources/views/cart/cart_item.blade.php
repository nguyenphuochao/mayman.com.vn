@foreach (Cart::content() as $item)
    <tr>
        <td class="align-middle">
            <a href="javacript:void(0)" onclick="deleteProductInCartDetail('{{ $item->rowId }}')"><i
                    class="fa-regular fa-circle-xmark"></i></a>
            <img width="100" src="{{asset('')}}admin/image/product/{{ $item->options->image }}" alt="{{ $item->name }}">
            <span>{{ $item->name }}</span>
        </td>
        <td class="align-middle">{{ number_format($item->price) }} đ</td>
        <td class="align-middle"><input type="number" name="quantity[]" value="{{ $item->qty }}"
                style="width: 50px;text-align: center;"></td>
        <td class="align-middle">{{ number_format($item->qty * $item->price) }}0 đ</td>
    </tr>
@endforeach
