@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Đơn hàng</h2>
            <p class="text-on-surface-variant mt-1">Theo dõi và cập nhật trạng thái đơn hàng của khách hàng</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Mã Đơn</th>
                    <th class="px-6 py-4">Khách hàng</th>
                    <th class="px-6 py-4">Tổng tiền</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4">Ngày đặt</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($orders as $order)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 font-bold text-primary">#ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium">{{ $order->user ? $order->user->full_name : 'Khách vãng lai' }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium">{{ number_format($order->total_amount) }} đ</td>
                    <td class="px-6 py-4">
                        @php
                            $badgeColor = match($order->status) {
                                'Chờ xác nhận' => 'bg-yellow-100 text-yellow-800',
                                'Đang giao' => 'bg-blue-100 text-blue-800',
                                'Đã hoàn thành' => 'bg-green-100 text-green-800',
                                'Đã hủy' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                            };
                        @endphp
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $badgeColor }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="p-2 hover:bg-surface-container rounded-lg text-primary transition-colors">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </a>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
