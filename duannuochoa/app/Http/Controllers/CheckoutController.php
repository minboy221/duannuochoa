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
        if ($shippingMethods->isEmpty()) {
            // Seed a default if empty for demo purposes
            $shippingMethods = collect([
                (object)['shipping_id' => 1, 'name' => 'Giao hàng tiêu chuẩn', 'fee' => 0]
            ]);
        }

        return view('clien.thanhtoan', compact('cartItems', 'subtotal', 'userVouchers', 'shippingMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'shipping_id' => 'required',
            'user_discount_id' => 'nullable|exists:user_discounts,user_discount_id',
            'payment_method' => 'required|in:cod,vnpay',
            'note' => 'nullable|string'
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
                'status' => $request->payment_method === 'vnpay' ? 'Chờ thanh toán' : 'Chờ xác nhận',
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending'
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

                // Check for out of stock alert
                if ($item->variant->stock_quantity <= 0) {
                    $adminEmail = env('MAIL_ADMIN_ADDRESS', 'phamtuan20061969@gmail.com');
                    try {
                        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\OutOfStockAlert($item->variant->load('product')));
                    } catch (\Exception $e) {
                        \Log::error('Out of stock mail error: ' . $e->getMessage());
                    }
                }
            }

            // Clear Cart
            CartItem::where('cart_id', $cart->cart_id)->delete();
            $cart->delete();

            DB::commit();

            if ($request->payment_method === 'vnpay') {
                return $this->createVnpayPayment($order);
            }

            return redirect()->route('lichsu')->with('success', 'Đặt hàng thành công! Mã đơn hàng: #' . $order->order_id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    private function createVnpayPayment($order)
    {
        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('VNP_RETURN_URL');
        $vnp_TmnCode = env('VNP_TM_CODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_TxnRef = $order->order_id;
        $vnp_OrderInfo = "Thanh toan don hang #" . $order->order_id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)($order->total_amount * 100);
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('VNP_HASH_SECRET');
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                $order = Order::findOrFail($request->vnp_TxnRef);
                $order->update([
                    'status' => 'Đã xác nhận',
                    'payment_status' => 'paid'
                ]);
                return redirect()->route('lichsu')->with('success', 'Thanh toán thành công qua VNPay!');
            } else {
                return redirect()->route('checkout.index')->with('error', 'Thanh toán không thành công hoặc đã bị hủy.');
            }
        } else {
            return redirect()->route('checkout.index')->with('error', 'Chữ ký không hợp lệ.');
        }
    }

    public function vnpayIPN(Request $request)
    {
        // IPN logic for server-to-server confirmation
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET'));
        if ($secureHash == $vnp_SecureHash) {
            $order = Order::findOrFail($inputData['vnp_TxnRef']);
            if ($inputData['vnp_ResponseCode'] == '00') {
                $order->update([
                    'status' => 'Đã xác nhận',
                    'payment_status' => 'paid'
                ]);
            }
            return response()->json(['RspCode' => '00', 'Message' => 'Confirm Success']);
        }
        return response()->json(['RspCode' => '97', 'Message' => 'Invalid Checksum']);
    }

    public function retryVnpay(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'Chờ thanh toán') {
            return back()->with('error', 'Đơn hàng này không ở trạng thái chờ thanh toán.');
        }

        return $this->createVnpayPayment($order);
    }

    public function switchToCod(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'Chờ thanh toán') {
            return back()->with('error', 'Không thể chuyển đổi phương thức cho đơn hàng này.');
        }

        $order->update([
            'payment_method' => 'cod',
            'status' => 'Chờ xác nhận',
            'payment_status' => 'pending'
        ]);

        return redirect()->route('donhang.show', $order)->with('success', 'Đã chuyển sang phương thức Thanh toán khi nhận hàng (COD).');
    }
}
