@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3 space-y-4">
                <div class="bg-surface-container-low p-6 rounded-lg sticky top-28">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="relative group">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-on-primary text-xl font-bold shadow-lg overflow-hidden border-2 border-white">
                                <img alt="Avatar" class="w-full h-full object-cover"
                                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=0052d0&color=fff' }}" />
                            </div>
                        </div>
                        <div>
                            <h2 class="font-headline font-bold text-lg leading-tight">Chào, {{ Auth::user()->full_name }}</h2>
                            <p class="text-sm text-on-surface-variant">Thành viên mới</p>
                        </div>
                    </div>
                    <nav class="space-y-2">
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="{{ route('taikhoan') }}">
                            <span class="material-symbols-outlined">person_outline</span>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl bg-surface-container-lowest text-primary font-bold transition-all shadow-sm"
                            href="{{ route('lichsu') }}">
                            <span class="material-symbols-outlined">history</span>
                            <span>Lịch sử đơn hàng</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="{{ route('taikhoan') }}#settings">
                            <span class="material-symbols-outlined">settings</span>
                            <span>Cài đặt tài khoản</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-outline-variant/20">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 p-4 rounded-xl hover:text-error transition-all text-on-surface-variant font-medium text-left">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="lg:col-span-9">
                <header class="mb-10">
                    <h1 class="text-4xl font-extrabold tracking-tight text-primary mb-2">Lịch sử đơn hàng</h1>
                    <p class="text-on-surface-variant">Theo dõi và quản lý các đơn hàng của bạn.</p>
                </header>

                <!-- Orders List -->
                <div class="space-y-6">
                    @forelse($orders as $order)
                        <div class="bg-surface-container-lowest rounded-2xl overflow-hidden transition-all hover:shadow-xl border border-outline-variant/10 shadow-sm">
                            <div class="p-6 border-b border-surface-container flex justify-between items-center bg-surface-container-low/30">
                                <div class="flex gap-8">
                                    <div>
                                        <p class="text-[10px] font-bold text-outline uppercase tracking-wider mb-1">Mã đơn hàng</p>
                                        <p class="font-headline font-bold text-on-surface">#{{ $order->order_id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-outline uppercase tracking-wider mb-1">Ngày đặt</p>
                                        <p class="font-medium text-on-surface">{{ $order->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @php
                                    $statusClasses = [
                                        'Chờ xác nhận' => 'bg-surface-container-high text-on-surface-variant',
                                        'Đang xử lý' => 'bg-primary-container text-on-primary-container',
                                        'Đang giao' => 'bg-secondary-container text-on-secondary-container',
                                        'Đã giao' => 'bg-green-100 text-green-700',
                                        'Đã hủy' => 'bg-error-container text-on-error-container',
                                    ];
                                    $class = $statusClasses[$order->status] ?? 'bg-surface-container text-on-surface';
                                @endphp
                                <span class="px-4 py-1.5 rounded-full {{ $class }} text-xs font-bold flex items-center gap-2">
                                    {{ $order->status }}
                                </span>
                            </div>
                            
                            <div class="p-6 space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 rounded-xl bg-surface-container-low overflow-hidden flex-shrink-0 border border-outline-variant/10">
                                            <img src="{{ $item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-on-surface">{{ $item->variant->product->name }}</h3>
                                            <p class="text-on-surface-variant text-xs">Dung tích: {{ $item->variant->volume_id }}ml | Số lượng: {{ $item->quantity }}</p>
                                        </div>
                                        <p class="font-bold text-primary">{{ number_format($item->price) }}đ</p>
                                    </div>
                                @endforeach
                            </div>

                            <div class="p-6 bg-surface-container-low/50 flex justify-between items-center">
                                <div class="text-on-surface">
                                    <span class="text-sm font-medium">Tổng thanh toán:</span>
                                    <span class="text-xl font-black ml-2 text-primary">{{ number_format($order->total_amount) }}đ</span>
                                </div>
                                <div class="flex gap-4">
                                    <button class="px-6 py-3 rounded-xl font-bold text-on-surface-variant bg-surface-container-highest hover:bg-surface-container-high transition-all text-sm">
                                        Chi tiết
                                    </button>
                                    @if($order->status == 'Đã giao' || $order->status == 'Đã hủy')
                                        <button class="px-8 py-3 rounded-xl font-bold text-white bg-primary shadow-lg hover:scale-105 active:scale-95 transition-all text-sm">
                                            Mua lại
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-surface-container-lowest rounded-2xl border border-dashed border-outline-variant/30">
                            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">receipt_long</span>
                            <p class="text-on-surface-variant font-medium">Bạn chưa có đơn hàng nào.</p>
                            <a href="{{ route('sanpham') }}" class="inline-block mt-6 text-primary font-bold hover:underline underline-offset-4">Khám phá sản phẩm ngay</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection