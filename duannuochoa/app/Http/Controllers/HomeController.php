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
        $latestArticles = \App\Models\Article::published()->latest()->take(3)->get();
        
        return view('clien.home', compact('featuredProducts', 'bestsellingProducts', 'latestArticles'));
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

        $recentOrders = \App\Models\Order::where('user_id', Auth::id())
            ->with(['orderItems.variant.product'])
            ->latest()
            ->take(4)
            ->get();

        return view('clien.taikhoan', compact('availableVouchers', 'userVouchers', 'recentOrders'));
    }

    public function lichsu(Request $request)
    {
        $status = $request->input('status', 'all');
        
        $query = \App\Models\Order::where('user_id', Auth::id())
            ->with(['orderItems.variant.product'])
            ->latest();

        if ($status === 'all') {
            $query->where('status', '!=', 'Đã hủy');
        } elseif ($status === 'completed') {
            $query->whereIn('status', ['Đã giao hàng', 'Đã hoàn thành']);
        } elseif ($status === 'returned') {
            $query->whereIn('status', ['Yêu cầu trả hàng', 'Trả hàng/Hoàn tiền']);
        } else {
            $query->where('status', $status);
        }

        $orders = $query->paginate(5)->withQueryString();

        $reviewedProductIds = \App\Models\Review::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();

        return view('clien.lichsudonhang', compact('orders', 'reviewedProductIds', 'status'));
    }

    public function chitietdonhang(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        $order->load(['orderItems.variant.product', 'shippingMethod', 'discount']);
        
        return view('clien.chitietdonhang', compact('order'));
    }
    //phần đăng nhập, đăng ký
    public function dangnhap()
    {
        return view('clien.dangnhap');
    }
    //phần xem chi tiết sản phẩm
    public function xemchitiet($id)
    {
        $product = Product::with(['variants', 'activeReviews.user'])->findOrFail($id);
        
        $averageRating = $product->averageRating();
        $reviewsCount = $product->activeReviews()->count();
        
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

        // Revenue trend for the last 6 months
        $revenueTrends = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $total = \App\Models\Order::where('status', 'Đã hoàn thành')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_amount');
            
            $revenueTrends->push([
                'label' => 'THG ' . $date->format('n'),
                'fullLabel' => 'Tháng ' . $date->format('n, y'),
                'total' => $total
            ]);
        }

        return view('admin.tongquan', compact('totalRevenue', 'totalOrders', 'ordersToday', 'totalCustomers', 'lowStockCount', 'lowStockVariants', 'recentOrders', 'categoriesSales', 'revenueTrends'));
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

    public function confirmReceived(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['Đang giao', 'Đã giao hàng'])) {
            return back()->with('error', 'Trạng thái đơn hàng không hợp lệ để xác nhận.');
        }

        $order->update(['status' => 'Đã hoàn thành']);
        return back()->with('success', 'Xác nhận đã nhận hàng thành công. Cảm ơn bạn đã mua sắm!');
    }

    public function requestReturn(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'Đã hoàn thành') {
            return back()->with('error', 'Chỉ có thể yêu cầu trả hàng cho đơn hàng đã hoàn thành.');
        }

        $request->validate([
            'return_reason' => 'required|string|max:1000',
            'return_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = [
            'status' => 'Yêu cầu trả hàng',
            'return_reason' => $request->return_reason
        ];

        if ($request->hasFile('return_image')) {
            $data['return_image'] = $request->file('return_image')->store('returns', 'public');
        }

        $order->update($data);

        return back()->with('success', 'Yêu cầu trả hàng của bạn đã được gửi. Chúng tôi sẽ sớm liên hệ lại.');
    }

    public function cancelOrder(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['Chờ xác nhận', 'Đã xác nhận'])) {
            return back()->with('error', 'Không thể hủy đơn hàng ở trạng thái này.');
        }

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Restore stock
            foreach ($order->orderItems as $item) {
                if ($item->variant) {
                    $item->variant->stock_quantity += $item->quantity;
                    $item->variant->save();
                }
            }

            // Refund if paid
            if (in_array($order->payment_status, ['paid']) || $order->payment_method === 'wallet') {
                // Double check if not already refunded to prevent double refund
                if (!$order->is_refunded) {
                    $user = Auth::user();
                    $refundAmount = $order->total_amount;
                    
                    $user->increment('wallet_balance', $refundAmount);
                    
                    \App\Models\WalletTransaction::create([
                        'user_id' => $user->user_id,
                        'amount' => $refundAmount,
                        'type' => 'refund',
                        'description' => "Hoàn tiền do khách hủy đơn hàng #ORD-" . str_pad($order->order_id, 5, '0', STR_PAD_LEFT)
                    ]);

                    $order->is_refunded = true;
                }
            }

            $order->status = 'Đã hủy';
            $order->cancel_reason = 'Khách hàng tự hủy';
            $order->save();

            \Illuminate\Support\Facades\DB::commit();
            return back()->with('success', 'Đã hủy đơn hàng thành công.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}