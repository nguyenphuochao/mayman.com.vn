<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeImage;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $discarded_products = []; // biến này chứa các sản phẩm cần loại bỏ trùng lặp vs sản phẩm mới nhất đã xuất hiện
        $new_product_left = Product::orderBy('id', 'DESC')->take(10)->get();
        $new_product_right = Product::orderBy('id', 'DESC')->skip(10)->take(10)->get();

        foreach ($new_product_left as $key => $value1) {
            $discarded_products[] = $value1->id;
        }
        foreach ($new_product_right as $key => $value2) {
            $discarded_products[] = $value2->id;
        }
        //dd($discarded_products);
        $categories = Category::all();
        // Lấy danh sách sản phẩm theo danh mục
        $productCate = [];
        foreach ($categories as $category) {
            $product_category = Product::where('category_id', $category->id)->whereNotIn('id', $discarded_products)->orderBy('id', 'DESC')->take(10)->get();
            $productCate[$category->name] = $product_category;
        }
        //dd($productCate);
        // Lấy hình ảnh trang chủ
        $home_image = HomeImage::all();
        // Hiển thị danh sách tin tức
        $news = News::orderBy('id', 'DESC')->get();
        return view('home.index', compact('productCate', 'home_image', 'new_product_left', 'new_product_right', 'news'));
    }
}
