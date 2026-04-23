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

    <!-- Status Timeline -->
    <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-surface-container mb-8 overflow-x-auto">
        <div class="flex items-center min-w-[800px] justify-between relative px-4">
            <!-- Connecting Line Background -->
            <div class="absolute top-[26px] left-12 right-12 h-1 bg-surface-container-high z-0"></div>
            
            @php
                $statusFlow = [
                    'Chờ xác nhận' => 'pending_actions',
                    'Đã xác nhận' => 'check_circle',
                    'Đang chuẩn bị hàng' => 'inventory_2',
                    'Đang giao' => 'local_shipping',
                    'Đã giao hàng' => 'package_2',
                    'Đã hoàn thành' => 'task_alt',
                    'Yêu cầu trả hàng' => 'assignment_return',
                    'Trả hàng/Hoàn tiền' => 'keyboard_return'
                ];
                
                $currentIndex = array_search($order->status, array_keys($statusFlow));
                if ($order->status == 'Đã hủy') $currentIndex = -1;
            @endphp

            @foreach($statusFlow as $label => $icon)
                @php
                    $itemIndex = array_search($label, array_keys($statusFlow));
                    $isActive = ($itemIndex <= $currentIndex && $currentIndex !== -1);
                    $isCurrent = ($itemIndex === $currentIndex);
                @endphp
                <div class="flex flex-col items-center gap-3 relative z-10 group">
                    <div class="w-14 h-14 rounded-full flex items-center justify-center transition-all duration-500 
                        {{ $isCurrent ? 'bg-primary text-white scale-125 shadow-xl shadow-primary/30 ring-4 ring-primary/20' : ($isActive ? 'bg-primary-container text-primary' : 'bg-surface-container-high text-outline-variant') }}">
                        <span class="material-symbols-outlined">{{ $icon }}</span>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-black uppercase tracking-widest {{ $isActive ? 'text-primary' : 'text-on-surface-variant' }}">{{ $label }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        @if($order->status == 'Đã hủy')
            <div class="mt-8 pt-6 border-t border-red-100 flex items-center justify-center gap-3 text-red-600">
                <span class="material-symbols-outlined">cancel</span>
                <span class="font-black uppercase tracking-widest text-sm">Đơn hàng hiện đã bị hủy</span>
            </div>
        @endif
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
                                    'Chờ thanh toán' => 'bg-slate-100 text-slate-500 border-slate-200',
                                    'Chờ xác nhận' => 'bg-amber-100 text-amber-700 border-amber-200',
                                    'Đã xác nhận' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'Đã thanh toán' => 'bg-blue-100 text-blue-700 border-blue-200',
                                    'Đang chuẩn bị hàng' => 'bg-purple-100 text-purple-700 border-purple-200',
                                    'Đang giao' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                    'Đã giao hàng' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                    'Đã hoàn thành' => 'bg-green-100 text-green-700 border-green-200',
                                    'Đã hủy' => 'bg-red-100 text-red-700 border-red-200',
                                    'Yêu cầu trả hàng' => 'bg-orange-100 text-orange-700 border-orange-200',
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

                    @if($order->status == 'Yêu cầu trả hàng' && $order->return_reason)
                        <div class="pt-4 border-t mt-2">
                            <span class="block text-orange-700 font-black text-[10px] uppercase tracking-widest mb-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">assignment_return</span>
                                Lý do yêu cầu trả hàng:
                            </span>
                            <div class="bg-orange-50 p-4 rounded-xl border border-orange-100 text-orange-900 italic font-medium mb-4">
                                "{{ $order->return_reason }}"
                            </div>
                            
                            @if($order->return_image)
                                <span class="block text-orange-700 font-black text-[10px] uppercase tracking-widest mb-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-xs">image</span>
                                    Hình ảnh bằng chứng:
                                </span>
                                <div class="relative group w-48 h-48 rounded-xl overflow-hidden border-2 border-orange-200 shadow-sm">
                                    <img src="{{ asset('storage/' . $order->return_image) }}" class="w-full h-full object-cover cursor-pointer hover:scale-110 transition-transform" onclick="window.open(this.src)">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                        <span class="material-symbols-outlined text-white">zoom_in</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="space-y-6">
            <!-- Quick Status Management -->
            <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container">
                <h3 class="font-bold text-lg mb-4 text-primary border-b pb-2">Xử lý Đơn hàng</h3>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" id="status-form">
                    @csrf
                    @method('PUT')
                    <div class="space-y-3">
                        @php
                            $currentStatus = $order->status;
                            $transitionRules = [
                                'Chờ thanh toán' => ['Đã hủy'],
                                'Chờ xác nhận' => ['Đã xác nhận', 'Đã hủy'],
                                'Đã xác nhận' => ['Đang chuẩn bị hàng', 'Đã hủy'],
                                'Đã thanh toán' => ['Đang chuẩn bị hàng'],
                                'Đang chuẩn bị hàng' => ['Đang giao', 'Đã hủy'],
                                'Đang giao' => ['Đã giao hàng', 'Đã hoàn thành'],
                                'Đã giao hàng' => ['Đã hoàn thành'],
                                'Đã hoàn thành' => [],
                                'Đã hủy' => [],
                                'Yêu cầu trả hàng' => ['Trả hàng/Hoàn tiền', 'Đã hoàn thành'],
                                'Trả hàng/Hoàn tiền' => []
                            ];
                            $allowed = $transitionRules[$currentStatus] ?? [];
                        @endphp

                        @if(empty($allowed))
                            <p class="text-xs text-on-surface-variant italic py-4 text-center bg-surface-container-low rounded-lg">Không thể thực hiện thêm thao tác nào cho đơn hàng ở trạng thái này.</p>
                        @endif

                        @foreach($allowed as $status)
                            @php
                                $displayLabel = $status;
                                if ($currentStatus == 'Yêu cầu trả hàng') {
                                    if ($status == 'Trả hàng/Hoàn tiền') {
                                        $displayLabel = 'Đồng ý (Trả hàng/Hoàn tiền)';
                                    } elseif ($status == 'Đã hoàn thành' || $status == 'Đã giao hàng') {
                                        $displayLabel = 'Từ chối (Đơn hàng tiếp tục hoặc hoàn thành)';
                                    }
                                }
                                // Specifically handle the exact string shown in screenshot
                                if ($currentStatus == 'Yêu cầu trả hàng' && $status == 'Đã hoàn thành') {
                                    $displayLabel = 'Từ chối trả hàng (Hoàn thành đơn)';
                                }
                            @endphp
                            <label class="flex items-center gap-3 p-3 rounded-xl border border-surface-container hover:bg-primary-container/10 hover:border-primary transition-all cursor-pointer group">
                                <input type="radio" name="status" value="{{ $status }}" class="w-4 h-4 text-primary focus:ring-primary/20 status-radio" required>
                                <span class="text-sm font-bold text-on-surface group-hover:text-primary transition-colors">{{ $displayLabel }}</span>
                            </label>
                        @endforeach

                        <div id="cancel-reason-input" class="hidden mt-4 animate-in fade-in duration-300">
                            <label class="block text-[10px] font-black uppercase text-red-600 mb-2">Lý do hủy đơn *</label>
                            <textarea name="cancel_reason" rows="3" class="w-full text-xs bg-red-50 border-red-100 rounded-lg focus:ring-red-200 transition-all" placeholder="Nhập lý do hủy..."></textarea>
                        </div>

                        @if(!empty($allowed))
                            <button type="submit" class="w-full mt-4 bg-primary text-white py-3 rounded-xl font-black uppercase tracking-widest text-xs shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                                Cập nhật ngay
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const radios = document.querySelectorAll('.status-radio');
                    const reasonInput = document.getElementById('cancel-reason-input');
                    const form = document.getElementById('status-form');

                    radios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            if (this.value === 'Đã hủy') {
                                reasonInput.classList.remove('hidden');
                                reasonInput.querySelector('textarea').required = true;
                            } else {
                                reasonInput.classList.add('hidden');
                                reasonInput.querySelector('textarea').required = false;
                            }
                        });
                    });
                });
            </script>

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
                    <div class="flex justify-between mb-2">
                        <span class="font-medium">Phương thức:</span>
                        <span class="font-bold uppercase text-primary">
                            @if(strtolower($order->payment_method) == 'vnpay')
                                VNPay
                            @elseif(strtolower($order->payment_method) == 'wallet')
                                Ví điện tử
                            @else
                                Thanh toán khi nhận hàng (COD)
                            @endif
                        </span>
                    </div>
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
        </div>
    </div>
</main>
@endsection
