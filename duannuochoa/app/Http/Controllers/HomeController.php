<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    public function index()
    {
        $featuredProducts = \App\Models\Product::with('category')->where('is_featured', true)->take(4)->get();
        $bestsellingProducts = \App\Models\Product::with('category')->where('is_bestseller', true)->take(4)->get();
        return view('clien.home', compact('featuredProducts', 'bestsellingProducts'));
    }
    //phần giới thiệu
    public function about()
    {
        return view('clien.about');
    }
    //phần sản phẩm
    public function sanpham()
    {
        $products = \App\Models\Product::with('category')->paginate(12);
        return view('clien.sanpham', compact('products'));
    }
    //phần liên hệ
    public function lienhe()
    {
        return view('clien.lienhe');
    }
    //phần giỏ hàng
    public function giohang()
    {
        return view('clien.giohang');
    }
    //phần tài khoản người dùng
    public function taikhoan()
    {
        return view('clien.taikhoan');
    }
    //phần đăng nhập, đăng ký
    public function dangnhap()
    {
        return view('clien.dangnhap');
    }
    //phần xem chi tiết sản phẩm
    public function xemchitiet($id)
    {
        $product = Product::with(['variants', 'reviews.user'])->findOrFail($id);
        
        $averageRating = $product->averageRating();
        $reviewsCount = $product->reviews()->count();
        
        // Fetch related products (same category, excluding current)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $id)
            ->take(4)
            ->get();
            
        // Check if user can review
        $canReview = false;
        if (Auth::check()) {
            $userId = Auth::id();
            $canReview = Order::where('user_id', $userId)
                ->where('status', 'Đã hoàn thành')
                ->whereHas('orderItems.variant', function ($query) use ($id) {
                    $query->where('product_id', $id);
                })->exists();
        }
        
        return view('clien.xemchitiet', compact('product', 'averageRating', 'reviewsCount', 'relatedProducts', 'canReview'));
    }
    //phần trang admin tổng quan
    public function tongquan()
    {
        return view('admin.tongquan');
    }
    //phần trang qly sản phẩm
    public function qlysanpham()
    {
        return view('admin.qlysanpham');
    }
    //quản lý tài khoản
    public function qlytaikhoan()
    {
        return view('admin.qlytaikhoan');
    }

    //quản lý đơn hàng
    public function qlydonhang()
    {
        return view('admin.qlydonhang');
    }
}