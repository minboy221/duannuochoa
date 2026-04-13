<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('san-pham', [HomeController::class, 'sanpham'])->name('sanpham');
Route::get('lien-he', [HomeController::class, 'lienhe'])->name('lienhe');
Route::get('gio-hang', [HomeController::class, 'giohang'])->name('giohang');
Route::get('tai-khoan', [HomeController::class, 'taikhoan'])->name('taikhoan');
Route::get('dang-nhap', [HomeController::class, 'dangnhap'])->name('dangnhap');
Route::get('xem-chi-tiet', [HomeController::class, 'xemchitiet'])->name('xemchitiet');
//trang admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('tong-quan', [HomeController::class, 'tongquan'])->name('tongquan');
    
    // Management Routes
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('products.variants', \App\Http\Controllers\Admin\ProductVariantController::class)->shallow();
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class);
    Route::resource('shipping-methods', \App\Http\Controllers\Admin\ShippingMethodController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});
