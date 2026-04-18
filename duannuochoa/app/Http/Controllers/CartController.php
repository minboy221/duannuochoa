<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\ProductVariant;
use App\Models\Discount;
use App\Models\UserDiscount;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Yêu cầu đăng nhập để sử dụng giỏ hàng bằng Database
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();
        
        $cartItems = [];
        $totalQuantity = 0;
        $subtotal = 0;

        if ($cart) {
            $cartItems = CartItem::where('cart_id', $cart->cart_id)
                ->with(['variant.product', 'variant'])
                ->get();

            foreach ($cartItems as $item) {
                // If variant has its own price, use it. Otherwise use product base_price.
                $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price;
                $subtotal += $price * $item->quantity;
                $totalQuantity += $item->quantity;
            }
        }

        $recommendedProducts = \App\Models\Product::with(['category', 'brand'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('clien.giohang', compact('cartItems', 'totalQuantity', 'subtotal', 'recommendedProducts'));
        return view('clien.giohang', compact('cartItems', 'totalQuantity', 'subtotal', 'cart'));
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $code = strtoupper($request->input('code'));
        $discount = Discount::where('code', $code)->first();

        if (!$discount) {
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại.');
        }

        // Check validity dates
        $now = now();
        if ($discount->valid_from > $now || $discount->valid_to < $now) {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn hoặc chưa đến thời gian sử dụng.');
        }

        // Check usage limit
        if ($discount->usage_limit !== null) {
            $usedCount = Order::where('discount_id', $discount->discount_id)->count();
            if ($usedCount >= $discount->usage_limit) {
                return redirect()->back()->with('error', 'Mã giảm giá này đã hết lượt sử dụng.');
            }
        }

        // Check points requirement
        if ($discount->points_required > 0) {
            $user = Auth::user();
            $alreadyRedeemed = UserDiscount::where('user_id', $user->user_id)
                ->where('discount_id', $discount->discount_id)
                ->exists();

            if (!$alreadyRedeemed) {
                return redirect()->back()->with('error', 'Mã giảm giá này yêu cầu đổi bằng ' . $discount->points_required . ' xu. Vui lòng đổi voucher trước khi sử dụng.');
            }
        }

        // Check min order value
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $subtotal = 0;
        foreach ($cart->items as $item) {
            $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price;
            $subtotal += $price * $item->quantity;
        }

        if ($subtotal < $discount->min_order_value) {
            return redirect()->back()->with('error', 'Đơn hàng tối thiểu phải đạt ' . number_format($discount->min_order_value) . 'đ để áp dụng mã này.');
        }

        // Apply to cart
        $cart->discount_id = $discount->discount_id;
        $cart->save();

        return redirect()->route('giohang')->with('success', 'Đã áp dụng mã giảm giá: ' . $discount->code);
    }

    public function removeDiscount()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();
        if ($cart) {
            $cart->discount_id = null;
            $cart->save();
        }

        return redirect()->route('giohang')->with('success', 'Đã gỡ mã giảm giá.');
    }

    public function add(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'quantity' => 'integer|min:1'
        ]);

        $user = Auth::user();
        $variant_id = $request->input('variant_id');
        $quantity = $request->input('quantity', 1);

        $variant = ProductVariant::findOrFail($variant_id);

        if ($variant->stock_quantity < $quantity) {
            return redirect()->back()->with('error', 'Sản phẩm không đủ số lượng trong kho.');
        }

        // Fetch or create cart for user
        $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->first();

        if ($cartItem) {
            // Update quantity if already in cart
            $newQuantity = $cartItem->quantity + $quantity;
            if ($variant->stock_quantity < $newQuantity) {
                return redirect()->back()->with('error', 'Sản phẩm trong kho không đủ để thêm số lượng này.');
            }
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            // Add new item
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'variant_id' => $variant_id,
                'quantity' => $quantity
            ]);
        }

        return redirect()->route('giohang')->with('success', 'Đã thêm sản phẩm vào giỏ hàng.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,cart_item_id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($request->input('cart_item_id'));
        $variant = $cartItem->variant;

        if ($variant->stock_quantity < $request->input('quantity')) {
            return redirect()->back()->with('error', 'Không đủ tồn kho.');
        }

        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return redirect()->route('giohang')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('giohang')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}