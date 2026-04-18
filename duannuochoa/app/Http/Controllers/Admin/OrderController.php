<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;

class OrderController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $orders = Order::with(['user', 'shippingMethod', 'discount'])
            ->when($search, function ($query, $search) {
                return $query->where('order_id', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'shippingMethod', 'discount', 'orderItems.variant.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(UpdateOrderStatusRequest $request, Order $order)
    {
        $newStatus = $request->status;
        
        // Auto-refund logic
        if ($newStatus === 'Trả hàng/Hoàn tiền' && !$order->is_refunded && $order->user) {
            \Illuminate\Support\Facades\DB::beginTransaction();
            try {
                $user = $order->user;
                $refundAmount = $order->total_amount;
                
                // Credit wallet
                $user->increment('wallet_balance', $refundAmount);
                
                // Log transaction
                \App\Models\WalletTransaction::create([
                    'user_id' => $user->user_id,
                    'amount' => $refundAmount,
                    'type' => 'refund',
                    'description' => "Hoàn tiền cho đơn hàng #ORD-" . str_pad($order->order_id, 5, '0', STR_PAD_LEFT)
                ]);
                
                $order->is_refunded = true;
                $order->save();
                
                \Illuminate\Support\Facades\DB::commit();
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                return back()->with('error', 'Có lỗi xảy ra khi hoàn tiền: ' . $e->getMessage());
            }
        }

        $order->update($request->validated());
        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    // Usually orders are not deleted in ecommerce, but if needed:
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công.');
    }
}
