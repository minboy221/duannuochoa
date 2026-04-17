<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserDiscount;
use App\Models\ShippingMethod;
use App\Models\Discount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('giohang')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $cartItems = $cart->items()->with('variant.product')->get();
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price;
            $subtotal += $price * $item->quantity;
        }

        $userVouchers = UserDiscount::where('user_id', $user->user_id)
            ->whereNull('used_at')
            ->with('discount')
            ->get();

        $shippingMethods = ShippingMethod::all();

        return view('clien.thanhtoan', compact('cartItems', 'subtotal', 'userVouchers', 'shippingMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'shipping_id' => 'required',
            'user_discount_id' => 'nullable|exists:user_discounts,user_discount_id'
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->user_id)->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống.');
        }

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $cartItems = $cart->items()->with('variant.product')->get();
            foreach ($cartItems as $item) {
                $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price;
                $subtotal += $price * $item->quantity;
            }

            $discountAmount = 0;
            $discountId = null;
            if ($request->user_discount_id) {
                $userDiscount = UserDiscount::where('user_discount_id', $request->user_discount_id)
                    ->where('user_id', $user->user_id)
                    ->whereNull('used_at')
                    ->first();

                if ($userDiscount) {
                    $discount = $userDiscount->discount;
                    if ($subtotal >= $discount->min_order_value) {
                        if ($discount->discount_type == 'fixed') {
                            $discountAmount = $discount->discount_value;
                        } else {
                            $discountAmount = ($subtotal * $discount->discount_value) / 100;
                        }
                        $discountId = $discount->discount_id;
                        $userDiscount->used_at = now();
                        $userDiscount->save();
                    }
                }
            }

            $shippingMethod = ShippingMethod::find($request->shipping_id);
            $shippingFee = $shippingMethod ? $shippingMethod->fee : 0;
            $totalAmount = max(0, $subtotal - $discountAmount + $shippingFee);

            // Create Order
            $order = Order::create([
                'user_id' => $user->user_id,
                'shipping_id' => $request->shipping_id,
                'discount_id' => $discountId,
                'total_amount' => $totalAmount,
                'status' => 'Chờ xác nhận'
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price;
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price' => $price
                ]);

                // Update stock
                $item->variant->stock_quantity -= $item->quantity;
                $item->variant->save();
            }

            // Clear Cart
            CartItem::where('cart_id', $cart->cart_id)->delete();
            $cart->delete();

            DB::commit();
            return redirect()->route('taikhoan')->with('success', 'Đặt hàng thành công! Mã đơn hàng: #' . $order->order_id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
