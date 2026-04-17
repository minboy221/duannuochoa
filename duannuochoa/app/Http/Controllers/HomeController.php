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
    public function sanpham(Request $request)
    {
        $categories = \App\Models\Category::all();
        $brands = \App\Models\Brand::all();

        $query = \App\Models\Product::with(['category', 'brand', 'reviews']);

        if ($request->has('category') && is_array($request->category)) {
            $query->whereIn('category_id', $request->category);
        }

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        if ($request->filled('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('base_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('base_price', 'desc');
                    break;
                case 'popular':
                    // Just sorting by ID or something for now as poor-man's popularity
                    $query->withCount('reviews')->orderBy('reviews_count', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        return view('clien.sanpham', compact('products', 'categories', 'brands'));
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
        $availableVouchers = \App\Models\Discount::where('valid_to', '>', now())
            ->where('points_required', '>', 0)
            ->get();
            
        $userVouchers = \App\Models\UserDiscount::where('user_id', Auth::id())
            ->with('discount')
            ->get();

        return view('clien.taikhoan', compact('availableVouchers', 'userVouchers'));
    }

    public function lichsu()
    {
        $orders = \App\Models\Order::where('user_id', Auth::id())
            ->with(['orderItems.variant.product'])
            ->latest()
            ->get();

        return view('clien.lichsudonhang', compact('orders'));
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