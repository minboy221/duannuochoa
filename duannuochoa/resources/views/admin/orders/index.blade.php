@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Đơn hàng</h2>
            <p class="text-on-surface-variant mt-1">Theo dõi và cập nhật trạng thái đơn hàng theo quy trình chuyên nghiệp</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold shadow-sm border border-green-200 flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <!-- Status Summary -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-8">
        @php
            $statuses = [
                'Chờ xác nhận' => ['icon' => 'pending_actions', 'color' => 'amber'],
                'Đã xác nhận' => ['icon' => 'check_circle', 'color' => 'blue'],
                'Đang chuẩn bị hàng' => ['icon' => 'inventory_2', 'color' => 'purple'],
                'Đang giao' => ['icon' => 'local_shipping', 'color' => 'indigo'],
                'Đã giao hàng' => ['icon' => 'package_2', 'color' => 'cyan'],
                'Đã hoàn thành' => ['icon' => 'task_alt', 'color' => 'green'],
                'Đã hủy' => ['icon' => 'cancel', 'color' => 'red'],
                'Trả hàng/Hoàn tiền' => ['icon' => 'assignment_return', 'color' => 'rose']
            ];
            // Since we only have paginated orders, we'd ideally pass counts from controller, 
            // but for a quick enhancement we'll show labels. 
            // Ideally we'd do: App\Models\Order::select('status', DB::raw('count(*) as count'))->groupBy('status')->get();
        @endphp
        @foreach($statuses as $label => $config)
        <div class="bg-surface-container-lowest p-4 rounded-xl border border-{{ $config['color'] }}-100 shadow-sm flex flex-col items-center justify-center text-center">
            <span class="material-symbols-outlined text-{{ $config['color'] }}-600 mb-2">{{ $config['icon'] }}</span>
            <span class="text-[10px] font-black uppercase tracking-tighter text-on-surface-variant">{{ $label }}</span>
        </div>
        @endforeach
    </div>

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.orders.index') }}" class="mb-6 flex gap-4 bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-surface-container">
        <div class="relative flex-1">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm mã đơn hàng..." 
                   class="w-full bg-surface-container-low border-none rounded-lg pl-10 pr-4 py-2 text-on-background placeholder-on-surface-variant focus:ring-2 focus:ring-primary transition-all">
        </div>
        
        <select name="status" class="bg-surface-container-low border-none rounded-lg px-4 py-2 text-on-background focus:ring-2 focus:ring-primary w-56 text-sm font-medium">
            <option value="">Tất cả trạng thái</option>
            @foreach(array_keys($statuses) as $statusLabel)
                <option value="{{ $statusLabel }}" {{ request('status') == $statusLabel ? 'selected' : '' }}>{{ $statusLabel }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">filter_alt</span>
            Lọc
        </button>
        @if(request('search') || request('status'))
            <a href="{{ route('admin.orders.index') }}" class="bg-surface-container-high text-on-surface px-6 py-2 rounded-lg font-bold hover:bg-surface-container-highest transition-colors flex items-center justify-center">Xóa lọc</a>
        @endif
    </form>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-[11px] font-bold uppercase tracking-widest border-b border-surface-container">
                    <th class="px-6 py-5">Mã Đơn</th>
                    <th class="px-6 py-5">Khách hàng</th>
                    <th class="px-6 py-5">Tổng tiền</th>
                    <th class="px-6 py-5">Trạng thái</th>
                    <th class="px-6 py-5">Ngày đặt</th>
                    <th class="px-6 py-5">Thanh toán</th>
                    <th class="px-6 py-5 text-right font-bold">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($orders as $order)
                <tr class="hover:bg-primary/5 transition-colors group">
                    <td class="px-6 py-5">
                        <span class="font-headline font-extrabold text-primary">#ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="font-bold text-on-surface">{{ $order->user ? $order->user->full_name : 'Khách vãng lai' }}</div>
                        <div class="text-[10px] text-on-surface-variant uppercase tracking-tighter">{{ $order->user ? $order->user->phone : 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-5 font-headline font-bold text-on-surface">{{ number_format($order->total_amount) }}đ</td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col gap-2">
                            @php
                                $badgeStyle = match($order->status) {
                                    'Chờ thanh toán' => 'bg-slate-100 text-slate-500 border-slate-200',
                                    'Chờ xác nhận' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'Đã xác nhận' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'Đã thanh toán' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'Đang chuẩn bị hàng' => 'bg-purple-100 text-purple-700 border-purple-200',
                                    'Đang giao' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                    'Đã giao hàng' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                    'Đã hoàn thành' => 'bg-green-100 text-green-700 border-green-200',
                                    'Đã hủy' => 'bg-red-100 text-red-700 border-red-200',
                                    'Trả hàng/Hoàn tiền' => 'bg-rose-100 text-rose-700 border-rose-200',
                                    default => 'bg-slate-100 text-slate-700 border-slate-200'
                                };

                                $nextStatus = match($order->status) {
                                    'Chờ xác nhận' => 'Đã xác nhận',
                                    'Đã xác nhận' => 'Đang chuẩn bị hàng',
                                    'Đã thanh toán' => 'Đang chuẩn bị hàng',
                                    'Đang chuẩn bị hàng' => 'Đang giao',
                                    'Đang giao' => 'Đã giao hàng',
                                    'Đã giao hàng' => 'Đã hoàn thành',
                                    default => null
                                };
                            @endphp
                            <span class="w-fit px-4 py-1.5 text-[10px] font-black rounded-full border {{ $badgeStyle }} uppercase tracking-widest shadow-sm">
                                {{ $order->status }}
                            </span>
                            
                            @if($nextStatus)
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $nextStatus }}">
                                <button type="submit" class="text-[9px] font-bold text-primary hover:underline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[12px]">double_arrow</span>
                                    Chuyển sang {{ $nextStatus }}
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5 text-sm font-medium text-on-surface-variant italic">
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2">
                            @if(strtolower($order->payment_method) == 'vnpay')
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-blue-600 text-sm">payments</span>
                                </div>
                                <span class="text-[11px] font-black text-blue-700 uppercase tracking-widest">VNPay</span>
                            @else
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-600 text-sm">local_shipping</span>
                                </div>
                                <span class="text-[11px] font-black text-slate-700 uppercase tracking-widest">COD</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-1">
                            <a href="{{ route('admin.orders.show', $order) }}" 
                               class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-primary hover:text-white text-primary transition-all duration-300 transition-all shadow-sm bg-surface-container-low"
                               title="Xem chi tiết">
                                <span class="material-symbols-outlined text-xl">visibility</span>
                            </a>
                            <a href="{{ route('admin.orders.edit', $order) }}" 
                               class="w-10 h-10 flex items-center justify-center rounded-xl hover:bg-secondary hover:text-white text-secondary transition-all duration-300 shadow-sm bg-surface-container-low"
                               title="Quản lý trạng thái">
                                <span class="material-symbols-outlined text-xl">settings</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center bg-surface-container-lowest p-4 rounded-xl border border-surface-container">
        <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Hiển thị {{ $orders->count() }} / {{ $orders->total() }} đơn hàng</p>
        <div class="flex gap-2">
            {{ $orders->appends(request()->query())->links() }}
        </div>
    </div>
</main>
@endsection
