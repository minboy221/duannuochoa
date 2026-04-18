@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('lichsu') }}" class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-white transition-all">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h1 class="text-3xl font-black text-primary tracking-tight">Chi tiết đơn hàng #{{ $order->order_id }}</h1>
                <p class="text-sm text-on-surface-variant italic">Cảm ơn bạn đã tin tưởng và mua sắm tại Xmen Fragrance</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Side: Items & Progress -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Status Progress Tracker -->
                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 overflow-x-auto">
                    <div class="flex items-center min-w-[700px] justify-between relative px-4">
                        <div class="absolute top-[26px] left-12 right-12 h-1 bg-surface-container-high z-0"></div>
                        
                        @php
                            $statusFlow = [
                                'Chờ xác nhận' => 'pending_actions',
                                'Đã xác nhận' => 'check_circle',
                                'Đang chuẩn bị hàng' => 'inventory_2',
                                'Đang giao' => 'local_shipping',
                                'Đã giao hàng' => 'package_2',
                                'Đã hoàn thành' => 'task_alt'
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
                            <div class="flex flex-col items-center gap-3 relative z-10">
                                <div class="w-14 h-14 rounded-full flex items-center justify-center transition-all duration-500 
                                    {{ $isCurrent ? 'bg-primary text-white scale-110 shadow-xl ring-4 ring-primary/20' : ($isActive ? 'bg-primary-container text-primary' : 'bg-surface-container-high text-outline-variant') }}">
                                    <span class="material-symbols-outlined">{{ $icon }}</span>
                                </div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-center {{ $isActive ? 'text-primary' : 'text-on-surface-variant' }}">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                    @if($order->status == 'Đã hủy')
                        <div class="mt-8 pt-6 border-t border-red-50 flex items-center justify-center gap-3 text-red-500">
                            <span class="material-symbols-outlined">cancel</span>
                            <span class="font-black uppercase tracking-widest text-xs">Đơn hàng đã bị hủy</span>
                        </div>
                    @endif
                </div>

                @if($order->status == 'Chờ thanh toán' && $order->payment_method == 'vnpay')
                    <div class="bg-amber-50 border border-amber-200 p-8 rounded-[2rem] shadow-sm animate-pulse">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                            <div class="flex-1 space-y-2">
                                <div class="flex items-center gap-3 text-amber-800">
                                    <span class="material-symbols-outlined">warning</span>
                                    <span class="font-black uppercase tracking-widest text-xs">Lời nhắc thanh toán</span>
                                </div>
                                <p class="text-sm text-amber-700 leading-relaxed">Chúng tôi vẫn chưa nhận được khoản thanh toán cho đơn hàng này. Vui lòng thanh toán sớm để chúng tôi có thể chuẩn bị hàng cho bạn ngay lập tức.</p>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                                <form action="{{ route('donhang.retry-vnpay', $order->order_id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    <button type="submit" class="w-full px-8 py-4 rounded-xl bg-primary text-white font-bold shadow-lg shadow-primary/20 hover:scale-[1.05] active:scale-[0.95] transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                                        <span class="material-symbols-outlined">payments</span>
                                        Thanh toán ngay
                                    </button>
                                </form>
                                
                                <form action="{{ route('donhang.switch-to-cod', $order->order_id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Bạn có chắc chắn muốn chuyển sang thanh toán khi nhận hàng (COD)?')">
                                    @csrf
                                    <button type="submit" class="w-full px-8 py-4 rounded-xl bg-white border border-amber-200 text-amber-800 font-bold hover:bg-amber-100 transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                                        <span class="material-symbols-outlined">local_shipping</span>
                                        Đổi sang COD
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Product List -->
                <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/10 overflow-hidden">
                    <div class="p-6 border-b border-surface-container flex items-center justify-between">
                        <h3 class="font-bold text-lg text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">fragrance</span>
                            Danh sách sản phẩm
                        </h3>
                        <span class="bg-surface-container-high px-3 py-1 rounded-lg text-xs font-bold text-on-surface-variant">{{ $order->orderItems->count() }} sản phẩm</span>
                    </div>
                    <div class="divide-y divide-surface-container">
                        @foreach($order->orderItems as $item)
                        <div class="p-6 flex items-center gap-6 group hover:bg-surface-container-low/30 transition-colors">
                            <div class="w-24 h-24 rounded-xl bg-surface-container-low overflow-hidden flex-shrink-0 border border-outline-variant/10">
                                <img src="{{ $item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <div class="flex-1 space-y-1">
                                <h4 class="font-bold text-lg text-on-surface">{{ $item->variant->product->name }}</h4>
                                <div class="flex items-center gap-4 text-sm text-on-surface-variant">
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-xs">open_in_full</span> {{ $item->variant->volume_id }}ml</span>
                                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-xs">numbers</span> x{{ $item->quantity }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-black text-primary">{{ number_format($item->price) }}đ</p>
                                <p class="text-[10px] text-on-surface-variant italic">Thành tiền: {{ number_format($item->price * $item->quantity) }}đ</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary & Info -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Shipping Info -->
                <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-outline-variant/10">
                    <h3 class="font-bold text-lg text-on-surface mb-4 flex items-center gap-2 border-b border-surface-container pb-4">
                        <span class="material-symbols-outlined text-primary">local_shipping</span>
                        Thông tin nhận hàng
                    </h3>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase text-outline tracking-widest">Người nhận</label>
                            <p class="font-bold text-on-surface">{{ Auth::user()->full_name }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase text-outline tracking-widest">Số điện thoại</label>
                            <p class="font-medium text-on-surface">{{ Auth::user()->phone }}</p>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black uppercase text-outline tracking-widest">Địa chỉ giao hàng</label>
                            <p class="text-sm font-medium text-on-surface-variant leading-relaxed">{{ Auth::user()->address }}</p>
                        </div>
                        @if($order->shippingMethod)
                        <div class="pt-4 mt-4 border-t border-surface-container flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm text-primary">box</span>
                                <span class="text-xs font-bold text-on-surface-variant">{{ $order->shippingMethod->name }}</span>
                            </div>
                            <span class="text-xs font-black text-primary">+{{ number_format($order->shippingMethod->fee) }}đ</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="bg-primary p-8 rounded-[2rem] text-on-primary shadow-xl shadow-primary/30 space-y-6 relative overflow-hidden">
                    <!-- Decor Circles -->
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>
                    
                    <h3 class="font-bold text-xl relative z-10 flex items-center gap-2">
                        <span class="material-symbols-outlined">payments</span>
                        Thanh toán
                    </h3>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="flex justify-between items-center text-sm">
                            <span class="opacity-80">Tạm tính:</span>
                            <span class="font-bold">{{ number_format($order->total_amount - ($order->shippingMethod ? $order->shippingMethod->fee : 0) + ($order->discount ? $order->discount->discount_value : 0)) }}đ</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="opacity-80">Phí vận chuyển:</span>
                            <span class="font-bold">+{{ $order->shippingMethod ? number_format($order->shippingMethod->fee) : 0 }}đ</span>
                        </div>
                        @if($order->discount)
                        <div class="flex justify-between items-center text-sm text-green-200">
                            <span class="opacity-80">Giảm giá:</span>
                            <span class="font-bold">-{{ number_format($order->discount->discount_value) }}đ</span>
                        </div>
                        @endif
                        <div class="pt-4 border-t border-white/20 flex justify-between items-center">
                            <span class="font-black uppercase tracking-widest text-sm">Tổng cộng</span>
                            <span class="text-3xl font-black">{{ number_format($order->total_amount) }}đ</span>
                        </div>
                    </div>

                    <div class="pt-4 relative z-10">
                        <div class="flex items-center gap-2 py-2 px-4 bg-white/10 rounded-xl border border-white/20">
                            <span class="material-symbols-outlined text-sm">verified</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Phương thức: {{ $order->payment_method ?? 'COD' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3">

                    <button class="w-full py-4 rounded-xl bg-surface-container-highest text-primary font-bold hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">print</span>
                        In hóa đơn
                    </button>
                    @if($order->status == 'Đã hủy' || $order->status == 'Đã hoàn thành' || $order->status == 'Đã xác nhận')
                        <a href="{{ route('sanpham') }}" class="w-full py-4 rounded-xl bg-primary text-white font-bold shadow-lg hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            Tiếp tục mua sắm
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
