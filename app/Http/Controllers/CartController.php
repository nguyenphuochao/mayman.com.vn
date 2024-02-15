<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id, $qty)
    {
        $product = Product::find($product_id);
        Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->price_sale, 'weight' => 0, 'options' => ['image' => $product->image]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = $request->input("product_id");
        $qty = $request->input("qty");
        $this->create($product_id, $qty);
        $this->display();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // Cart::destroy();
        $cart = Cart::content();
        var_dump($cart);
    }
    protected function display()
    {
        $result = [];
        $result["count"] = Cart::count();
        $result["subtotal"] = Cart::subtotal();
        $result["items"] = view("layout.cart_item")->render();
        echo json_encode($result);
    }
    protected function displayCartDetail()
    {
        $result = [];
        $result["count"] = Cart::count();
        $result["subtotal"] = Cart::subtotal();
        $result["total"] = Cart::total();
        $result["items"] = view("cart.cart_item")->render();
        echo json_encode($result);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $newQuantities = $request->input('quantity');
        $index = 0;
        foreach (Cart::content() as $rowId => $item) {
            $newQuantity = $newQuantities[$index++];
            Cart::update($rowId, $newQuantity);
        }
        $this->displayCartDetail();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete($rowId)
    {
        Cart::remove($rowId);
        $this->display();
    }
    public function deleteDetail($rowId)
    {
        Cart::remove($rowId);
        $this->displayCartDetail();
    }
    public function add_cart_detail(Request $request)
    {
        $product_id = $request->product_id;
        $qty = $request->qty;
        $product = Product::find($product_id);
        Cart::add(['id' => $product_id, 'name' => $product->name, 'qty' => $qty, 'price' => $product->price_sale, 'weight' => 0, 'options' => ['image' => $product->image]]);
        $this->display();
    }
}
