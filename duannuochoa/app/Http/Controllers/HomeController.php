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

        $reviewedProductIds = \App\Models\Review::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();

        return view('clien.lichsudonhang', compact('orders', 'reviewedProductIds'));
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
        $totalRevenue = \App\Models\Order::where('status', 'Đã hoàn thành')->sum('total_amount');
        $totalOrders = \App\Models\Order::count();
        $ordersToday = \App\Models\Order::whereDate('created_at', \Carbon\Carbon::today())->count();
        $totalCustomers = \App\Models\User::count();
        
        $lowStockVariants = \App\Models\ProductVariant::with('product')
            ->where('stock_quantity', '<=', 10)
            ->get();
        $lowStockCount = $lowStockVariants->count();
            
        $recentOrders = \App\Models\Order::with(['user', 'orderItems.variant.product'])
            ->latest()
            ->take(5)
            ->get();
            
        // For basic category analytics
        $categoriesSales = \Illuminate\Support\Facades\DB::table('order_items')
            ->join('product_variants', 'order_items.variant_id', '=', 'product_variants.variant_id')
            ->join('products', 'product_variants.product_id', '=', 'products.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->select('categories.name', \Illuminate\Support\Facades\DB::raw('sum(order_items.quantity) as total'))
            ->groupBy('categories.name')
            ->get();

        return view('admin.tongquan', compact('totalRevenue', 'totalOrders', 'ordersToday', 'totalCustomers', 'lowStockCount', 'lowStockVariants', 'recentOrders', 'categoriesSales'));
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

    public function markNotified(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order->update(['client_notified' => true]);
        return response()->json(['success' => true]);
    }
}