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
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('gioi-thieu', [HomeController::class, 'about'])->name('about');
Route::get('san-pham', [HomeController::class, 'sanpham'])->name('sanpham');
Route::get('lien-he', [HomeController::class, 'lienhe'])->name('lienhe');
Route::get('xem-chi-tiet/{id}', [HomeController::class, 'xemchitiet'])->name('xemchitiet');
// Cart Routes
Route::get('gio-hang', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('gio-hang/them', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::put('gio-hang/cap-nhat', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('gio-hang/xoa/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
//trang admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('tong-quan', [HomeController::class, 'tongquan'])->name('tongquan');
    
    // Management Routes
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('products.variants', \App\Http\Controllers\Admin\ProductVariantController::class)->shallow();
    Route::post('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['destroy', 'edit', 'update']);
    Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class);
    Route::resource('shipping-methods', \App\Http\Controllers\Admin\ShippingMethodController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::resource('reviews', \App\Http\Controllers\Admin\ReviewManagementController::class)->only(['index', 'destroy']);
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('register/verify', [AuthController::class, 'showRegisterOtpForm'])->name('register.otp');
    Route::post('register/verify', [AuthController::class, 'verifyRegisterOtp']);
    
    Route::get('dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('dang-nhap', [AuthController::class, 'login']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'showEmailForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
    Route::get('verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('password.otp');
    Route::post('verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
    Route::get('reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('tai-khoan', [HomeController::class, 'taikhoan'])->name('taikhoan');
    Route::get('lich-su-don-hang', [HomeController::class, 'lichsu'])->name('lichsu');
    Route::post('tai-khoan', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::get('change-password', [PasswordController::class, 'showChangeForm'])->name('password.change');
    Route::post('change-password', [PasswordController::class, 'sendOtp'])->name('password.change.send');
    Route::get('change-password/verify', [PasswordController::class, 'showOtpForm'])->name('password.change.otp.form');
    Route::post('change-password/verify', [PasswordController::class, 'update'])->name('password.change.update');

    Route::post('reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
    
    // Voucher & Checkout
    Route::post('vouchers/redeem', [\App\Http\Controllers\VoucherController::class, 'redeem'])->name('vouchers.redeem');
    Route::get('thanh-toan', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('dat-hang', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('don-hang/{order}/mark-notified', [\App\Http\Controllers\HomeController::class, 'markNotified'])->name('orders.mark-notified');
    Route::get('vnpay/return', [\App\Http\Controllers\CheckoutController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::get('vnpay/ipn', [\App\Http\Controllers\CheckoutController::class, 'vnpayIPN'])->name('vnpay.ipn');
});

// Admin routes
Route::get('tong-quan', [HomeController::class, 'tongquan'])->name('tongquan');
Route::get('qly-sanpham', [HomeController::class, 'qlysanpham'])->name('qlysanpham');
Route::get('qly-donhang', [HomeController::class, 'qlydonhang'])->name('qlydonhang');
Route::get('qly-taikhoan', [HomeController::class, 'qlytaikhoan'])->name('qlytaikhoan');
