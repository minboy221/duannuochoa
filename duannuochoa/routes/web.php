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
