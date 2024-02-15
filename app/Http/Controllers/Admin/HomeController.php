<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('admin.dashboard.index', compact('products', 'categories', 'orders'));
    }
}
