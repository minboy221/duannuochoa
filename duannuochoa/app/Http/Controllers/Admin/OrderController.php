<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'shippingMethod', 'discount'])->orderBy('created_at', 'desc')->get();
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

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:Chờ xác nhận,Đang giao,Đã hoàn thành,Đã hủy',
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }

    // Usually orders are not deleted in ecommerce, but if needed:
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công.');
    }
}
