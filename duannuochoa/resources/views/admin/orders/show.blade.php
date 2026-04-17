@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Chi tiết Đơn hàng #ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</h2>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span> Quay lại
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container">
                <h3 class="font-bold text-lg mb-4 text-primary border-b pb-2">Danh sách sản phẩm</h3>
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-on-surface-variant text-xs uppercase tracking-wider border-b">
                            <th class="py-2">Sản phẩm</th>
                            <th class="py-2">Phân loại</th>
                            <th class="py-2 text-right">Đơn giá</th>
                            <th class="py-2 text-center">SL</th>
                            <th class="py-2 text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container text-sm">
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td class="py-3">{{ $item->variant->product->name ?? 'Sản phẩm đã xóa' }}</td>
                            <td class="py-3">{{ $item->variant->volume_id ?? 'N/A' }}ml - {{ $item->variant->color ?? 'Mặc định' }}</td>
                            <td class="py-3 text-right">{{ number_format($item->price) }} đ</td>
                            <td class="py-3 text-center">{{ $item->quantity }}</td>
                            <td class="py-3 font-medium text-right">{{ number_format($item->price * $item->quantity) }} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container">
                <h3 class="font-bold text-lg mb-4 text-primary border-b pb-2">Tổng quan đơn hàng</h3>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-on-surface-variant font-medium">Trạng thái hiện tại:</span>
                        @php
                            $badgeStyle = match($order->status) {
                                'Chờ xác nhận' => 'bg-amber-100 text-amber-700 border-amber-200',
                                'Đã xác nhận' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'Đang chuẩn bị hàng' => 'bg-purple-100 text-purple-700 border-purple-200',
                                'Đang giao' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                'Đã giao hàng' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                'Đã hoàn thành' => 'bg-green-100 text-green-700 border-green-200',
                                'Đã hủy' => 'bg-red-100 text-red-700 border-red-200',
                                'Trả hàng/Hoàn tiền' => 'bg-rose-100 text-rose-700 border-rose-200',
                                default => 'bg-slate-100 text-slate-700 border-slate-200'
                            };
                        @endphp
                        <span class="px-4 py-1 text-[10px] font-black rounded-full border {{ $badgeStyle }} uppercase tracking-widest shadow-sm">
                            {{ $order->status }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-on-surface-variant font-medium">Ngày đặt hàng:</span>
                        <span class="font-bold text-on-surface">{{ $order->created_at->format('d/m/Y H:i:s') }}</span>
                    </div>
                    @if($order->status == 'Đã hủy' && $order->cancel_reason)
                        <div class="pt-4 border-t mt-2">
                            <span class="block text-red-700 font-black text-[10px] uppercase tracking-widest mb-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">report</span>
                                Lý do hủy đơn hàng:
                            </span>
                            <div class="bg-red-50 p-4 rounded-xl border border-red-100 text-red-900 italic font-medium">
                                "{{ $order->cancel_reason }}"
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="space-y-6">
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container">
                <h3 class="font-bold text-lg mb-4 text-primary border-b pb-2">Thông tin Khách hàng</h3>
                @if($order->user)
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium mr-2">Tên:</span> {{ $order->user->full_name }}</p>
                        <p><span class="font-medium mr-2">SĐT:</span> {{ $order->user->phone }}</p>
                        <p><span class="font-medium mr-2">Email:</span> {{ $order->user->email }}</p>
                        <p><span class="font-medium mr-2">Địa chỉ:</span> {{ $order->user->address }}</p>
                    </div>
                @else
                    <p class="text-on-surface-variant italic">Khách vãng lai</p>
                @endif
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container">
                <h3 class="font-bold text-lg mb-4 text-primary border-b pb-2">Thanh toán</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Phí vận chuyển:</span>
                        <span>+ {{ $order->shippingMethod ? number_format($order->shippingMethod->fee) : 0 }} đ</span>
                    </div>
                    <div class="flex justify-between text-green-600">
                        <span>Giảm giá (Voucher):</span>
                        <span>- {{ $order->discount ? number_format($order->discount->discount_value) : 0 }}</span>
                    </div>
                    <div class="pt-2 border-t mt-2 flex justify-between font-bold text-lg">
                        <span>Tổng cộng:</span>
                        <span class="text-primary">{{ number_format($order->total_amount) }} đ</span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.orders.edit', $order) }}" class="block w-full text-center bg-primary text-white py-3 rounded-xl font-bold shadow-lg hover:opacity-90 transition-opacity">
                Cập nhật trạng thái
            </a>
        </div>
    </div>
</main>
@endsection
