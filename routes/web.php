<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HomeImageController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//--------------------------- User --------------------------

Route::get('/', [ControllersHomeController::class, 'index'])->name('fe.home'); //trang chủ
Route::get('/{slug}.html', [ControllersProductController::class, 'show'])->name('fe.product.show'); //chi tiết sản phẩm
Route::get('danh-muc/{slug}', [ControllersProductController::class, 'index'])->name('fe.category.show'); // sản phẩm theo danh mục
Route::get('gio-hang', [CartController::class, 'index'])->name('cart.index'); //giỏ hàng
Route::get('thanh-toan', [PaymentController::class, 'create'])->name('fe.payment'); //hiển thị form thanh toán
Route::post('thanh-toan', [PaymentController::class, 'store'])->name('fe.payment.store'); // gửi thông tin thanh toán lên server
Route::get('xac-nhan-don-hang', [PaymentController::class, 'order_received'])->name('fe.order-received'); //mua hàng thành công
Route::post('buy-now', [PaymentController::class, 'buy_now'])->name('fe.payment.buy_now'); //mua hàng nhanh trong chi tiết sản phẩm
Route::get('search', [ControllersProductController::class, 'search'])->name('fe.product.search'); // search này cho ajax
Route::get('tim-kiem', [ControllersProductController::class, 'search_post'])->name('fe.product.search_post'); // danh sách tìm kiếm
Route::get('dat-mua-ngay', [PaymentController::class, 'ordered'])->name('fe.payment.ordered');
// Cart
Route::get('carts/add', [CartController::class, 'store'])->name('cart.create'); // thêm 1 số lượng sp vào giỏ hàng
Route::get('carts/add/detail', [CartController::class, 'add_cart_detail'])->name('cart.add_cart_detail'); // thêm nhiều số lượng sp vào giỏ hàng
Route::get('carts/show', [CartController::class, 'show'])->name('cart.show'); // hiển thị giỏ hàng
Route::get('carts/delete/{rowId}', [CartController::class, 'delete'])->name('cart.delete'); //xóa giỏ hàng ở trang chủ
Route::get('carts/delete-detail/{rowId}', [CartController::class, 'deleteDetail'])->name('cart.deleteDetail'); //xóa giỏ hàng ở trang chi tiết giỏ hàng
Route::get('carts/update', [CartController::class, 'update'])->name('cart.update'); // cập nhật tất cả giỏ hàng
// Admin login
Route::get('login', [LoginController::class, 'login'])->name('b.login'); // form đăng nhập
Route::post('login', [LoginController::class, 'post_login'])->name('b.post_login'); //gửi đăng nhập
Route::get('logout', [LoginController::class, 'logout'])->name('b.logout'); //đăng xuất
//--------------------------- Admin group ----------------------
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth.backend'], function () {
    // Home dashboard
    Route::get('/', [HomeController::class, 'index'])->name('b.home');
    // Category
    Route::resource('category', CategoryController::class);
    // Product
    Route::resource('product', ProductController::class);
    // Order
    Route::resource('order', OrderController::class);
    // News
    Route::resource('news', NewsController::class);
    // Home image
    Route::resource('home-image', HomeImageController::class);
    // Media
    Route::resource('media', MediaController::class);
});
// Reder password
Route::get('render-pass', function () {
    echo bcrypt("@brightstar123");
});
// Config cache
Route::get('/clear-config-cache', function () {
    $exitCode = Artisan::call('config:cache');

    return "Config cache cleared successfully.";
});
