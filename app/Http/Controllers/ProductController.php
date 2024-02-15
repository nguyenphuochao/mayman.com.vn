<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slugCate, Request $request)
    {
        $category = Category::where('slug', $slugCate)->first();
        $cateID = $category->id;
        $products = Product::where('category_id', $cateID)->orderBy('id', 'DESC')->paginate(16);
        if ($request->show_result_filter == 'latest') {
            $products = Product::where('category_id', $cateID)->orderBy('id', 'DESC')->paginate(16); // lọc theo sản phẩm mới nhất
        }
        if ($request->show_result_filter == 'price_high_to_low') {
            $products = Product::where('category_id', $cateID)->orderBy('price_sale', 'DESC')->paginate(16); // lọc theo sản phẩm giá giảm dần
        }
        if ($request->show_result_filter == 'price_low_to_hight') {
            $products = Product::where('category_id', $cateID)->orderBy('price_sale', 'ASC')->paginate(16); // lọc theo sản phẩm giá tăng dần
        }


        $cateContent = $category->description;
        return view('product.index', compact('category', 'products', 'cateContent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('alias', $slug)->first();
        return view('product.show', compact('product'));
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
    public function update(Request $request, $id)
    {
        //
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
    public function search(Request $request)
    {
        $name = $request->input('name');
        $products = Product::where('name', 'LIKE', '%' . $name . '%')->get();
        return view('layout.search', compact('products'));
    }
    public function search_post(Request $request)
    {
        $name = $request->input('search');
        $products = Product::where('name', 'LIKE', '%' . $name . '%')->get();
        return view('product.search', compact('products'));
    }
}
