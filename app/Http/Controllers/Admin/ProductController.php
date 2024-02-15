<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products',
                'category_id' => 'required',
                'price' => 'required',
                'qty' => 'required',
                'discount' => 'required',
                'image' => 'required|mimes:jpeg,png,jpg,gif'
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'name.unique' => 'Tên sản phẩm bị trùng',
                'category_id.required' => 'Vui lòng chọn danh mục',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'qty.required' => 'Vui lòng nhập số lượng sản phẩm',
                'discount.required' => 'Vui lòng chọn giảm giá. Mặc định là 0',
                'image.required' => 'Vui lòng chọn ảnh đại diện sản phẩm',
                'image.mimes' => 'Vui lòng chọn hình ảnh có dịnh dạng jpeg,png,jpg,gif'
            ]
        );
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->alias = Str::slug($request->name);
        $product->name = $request->name;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/product'), $file->getClientOriginalName());
            $product->image =  $request->file('image')->getClientOriginalName();
        }
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->price_sale = $product->price - ($product->price * $product->discount / 100);
        $product->save();
        // Xử lí hình ảnh thu nhỏ
        if ($request->hasFile('thumbnail-image')) {
            $files = $request->file('thumbnail-image');
            foreach ($files as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(base_path('public/admin/image/product-thumbnail'), $file->getClientOriginalName());
                $product_image = new ProductImage();
                $product_image->image = $fileName;
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }
        return redirect()->route('product.index')->with(['type' => 'success', 'mess' => 'Thêm mới thành công sản phẩm '.$product->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|unique:products,name,' . $id,
                'category_id' => 'required',
                'price' => 'required',
                'qty' => 'required',
                'discount' => 'required',
                'image' => 'mimes:jpeg,png,jpg,gif'
            ],
            [
                'name.required' => 'Vui lòng nhập tên sản phẩm',
                'name.unique' => 'Tên sản phẩm bị trùng',
                'category_id.required' => 'Vui lòng chọn danh mục',
                'price.required' => 'Vui lòng nhập giá sản phẩm',
                'qty.required' => 'Vui lòng nhập số lượng sản phẩm',
                'discount.required' => 'Vui lòng chọn giảm giá. Mặc định là 0',
                'image.mimes' => 'Vui lòng chọn hình ảnh có dịnh dạng jpeg,png,jpg,gif'
            ]
        );
        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->alias = Str::slug($request->name);
        $product->name = $request->name;
        // Xử lí hình ảnh đại diện
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(base_path('public/admin/image/product'), $file->getClientOriginalName());
            $product->image =  $request->file('image')->getClientOriginalName();
        }
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->price_sale = $product->price - ($product->price * $product->discount / 100);
        $product->save();
        // Xử lí hình ảnh thu nhỏ
        if ($request->hasFile('thumbnail-image')) {
            $files = $request->file('thumbnail-image');
            foreach ($files as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(base_path('public/admin/image/product-thumbnail'), $file->getClientOriginalName());
                $product_image = new ProductImage();
                $product_image->image = $fileName;
                $product_image->product_id = $product->id;
                $product_image->save();
            }
        }
        return redirect()->route('product.index')->with(['type' => 'success', 'mess' => 'Cập nhật thành công sản phẩm '.$product->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with(['type' => 'success', 'mess' => 'Xóa thành công sản phẩm '.$product->name]);
    }
}
