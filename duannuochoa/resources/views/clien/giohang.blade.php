@extends('layouts.app')
@section('content')
    <main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
        <!-- Page Title -->
        <header class="mb-12">
            <h1 class="font-headline text-5xl md:text-6xl font-extrabold tracking-tight text-on-surface mb-2">Giỏ Hàng
            </h1>
            <p class="text-on-surface-variant font-medium">Bạn có {{ count($cartItems ?? []) }} sản phẩm trong giỏ hàng của mình.</p>
        </header>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Products Table Section -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Product Carts -->
                @forelse($cartItems as $item)
                    <div class="bg-surface-container-lowest p-6 rounded-lg flex flex-col md:flex-row items-center gap-8 shadow-sm transition-transform hover:scale-[1.01]">
                        <div class="w-32 h-32 flex-shrink-0 bg-surface-container-low rounded-lg overflow-hidden">
                            <!-- Try getting product image, fallback to placeholder -->
                            <img alt="{{ $item->variant->product->name }}" class="w-full h-full object-cover"
                                src="{{ $item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <h3 class="font-headline text-xl font-bold text-on-surface">{{ $item->variant->product->name }}</h3>
                            <p class="text-on-surface-variant text-sm mt-1">
                                <!-- Example: show variant color/vol if exists -->
                                Phân loại: {{ $item->variant->color ?? ($item->variant->volume_id . 'ml') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-4">
                            <span class="font-headline text-lg font-bold text-primary">{{ number_format($item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price) }}đ</span>
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center bg-surface-container-low rounded-full px-4 py-2">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cart_item_id" value="{{ $item->cart_item_id }}">
                                <button type="button" onclick="this.nextElementSibling.stepDown(); this.form.submit()" class="text-primary hover:text-primary-dim transition-colors">
                                    <span class="material-symbols-outlined text-xl">remove</span>
                                </button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->variant->stock_quantity }}" class="w-12 text-center bg-transparent border-none font-bold text-on-surface px-1 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none" onchange="this.form.submit()">
                                <button type="button" onclick="this.previousElementSibling.stepUp(); this.form.submit()" class="text-primary hover:text-primary-dim transition-colors">
                                    <span class="material-symbols-outlined text-xl">add</span>
                                </button>
                            </form>
                        </div>
                        <div class="text-right min-w-[120px]">
                            <p class="text-xs text-on-surface-variant font-medium uppercase tracking-wider mb-1">Thành tiền</p>
                            @php 
                                $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price; 
                            @endphp
                            <p class="font-headline text-xl font-bold text-on-surface">{{ number_format($price * $item->quantity) }}đ</p>
                        </div>
                        <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-error opacity-50 hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="bg-surface-container-lowest p-8 rounded-lg text-center shadow-sm">
                        <span class="material-symbols-outlined text-6xl text-surface-dim mb-4">shopping_cart</span>
                        <h2 class="text-2xl font-bold text-on-surface mb-2">Giỏ hàng trống</h2>
                        <p class="text-on-surface-variant mb-6">Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
                        <a href="{{ route('home') }}" class="inline-block bg-primary text-on-primary px-8 py-3 rounded-full font-bold hover:bg-primary-dim transition-colors">Đi mua sắm ngay</a>
                    </div>
                @endforelse
                <!-- Promo Code -->
                <div class="bg-surface-container-low p-6 rounded-lg flex items-center justify-between mt-8">
                    <div class="flex items-center gap-3 text-on-surface-variant">
                        <span class="material-symbols-outlined">sell</span>
                        <span class="font-medium">Bạn có mã giảm giá?</span>
                    </div>
                    <div class="flex gap-2">
                        <input
                            class="bg-surface-container-lowest border-none rounded-full px-6 py-2 text-sm focus:ring-2 focus:ring-primary/20 w-48"
                            placeholder="Nhập mã tại đây..." type="text" />
                        <button
                            class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold text-sm hover:bg-primary-dim transition-colors">Áp
                            dụng</button>
                    </div>
                </div>
            </div>
            <!-- Summary Section -->
            <div class="lg:col-span-4 sticky top-32">
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-2xl shadow-blue-900/5 space-y-6">
                    <h2
                        class="font-headline text-2xl font-bold text-on-surface border-b border-surface-container-high pb-4">
                        Tóm tắt đơn hàng</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tổng số loại sản phẩm</span>
                            <span class="font-bold text-on-surface">{{ count($cartItems ?? []) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tổng số lượng</span>
                            <span class="font-bold text-on-surface">{{ $totalQuantity ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tạm tính</span>
                            <span class="font-bold text-on-surface">{{ number_format($subtotal ?? 0) }}đ</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Phí vận chuyển</span>
                            <span class="font-bold text-secondary">Miễn phí</span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-surface-container-high">
                        <div class="flex justify-between items-end mb-8">
                            <span class="font-bold text-on-surface-variant">Tổng cộng</span>
                            <span class="font-headline text-3xl font-extrabold text-primary">{{ number_format($subtotal ?? 0) }}đ</span>
                        </div>
                        <button
                            class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary py-5 rounded-xl font-headline font-bold text-lg shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                            Tiến hành thanh toán
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                        <div class="mt-6 flex items-center justify-center gap-4">
                            <div
                                class="flex items-center gap-1 text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">
                                <span class="material-symbols-outlined text-sm">verified_user</span>
                                Bảo mật 100%
                            </div>
                            <div class="w-1 h-1 bg-surface-container-high rounded-full"></div>
                            <div
                                class="flex items-center gap-1 text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">
                                <span class="material-symbols-outlined text-sm">local_shipping</span>
                                Giao hỏa tốc
                            </div>
                        </div>
                    </div>
                </div>
                <a class="mt-8 flex items-center justify-center gap-2 text-primary font-bold hover:underline transition-all"
                    href="#">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
        <!-- Recommendations Grid (Bento Style) -->
        <section class="mt-32">
            <h2 class="font-headline text-3xl font-bold text-on-surface mb-8">Có thể bạn sẽ thích</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div
                    class="md:col-span-2 bg-primary-container/10 rounded-lg p-8 flex flex-col justify-between group overflow-hidden relative min-h-[300px]">
                    <div class="relative z-10">
                        <span
                            class="bg-tertiary text-on-tertiary text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">Mới
                            Nhất</span>
                        <h3 class="font-headline text-3xl font-bold text-on-primary-container max-w-[200px]">Combo Sức
                            Mạnh Thức Tỉnh</h3>
                        <p class="text-on-primary-container/70 mt-4 max-w-[240px]">Trọn bộ chăm sóc toàn diện cho phái
                            mạnh tự tin mỗi ngày.</p>
                        <button
                            class="mt-6 text-primary font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                            Xem ngay <span class="material-symbols-outlined">east</span>
                        </button>
                    </div>
                    <img alt="X-Men Bundle"
                        class="absolute -right-12 -bottom-12 w-64 h-64 object-contain rotate-12 group-hover:rotate-0 transition-transform duration-500"
                        data-alt="Collection of men's grooming products arranged artistically on a blue textured surface with dynamic diagonal shadows"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuHyis5Qc7bU66MbdsSafDZxDPDLVXr0ZoZJ9ZV9CCReC5hIXY42-RoSEYs8eIFswk7-J_c2R3-MMnlVjqhgLlkvlqTzc0zQ1G2942X5bh_WRAzxvS8cH_MHK5i42j0YZftuySMeYnCGERapPk7YN0JjP-BnTOQx7FAvOwjHjSQlcS7w1KEU4bK3iCK6LgvZSNCDcYHwD8-sTSA8OZS_pMx8_sEqe7qxzfGNNvcFmp4XTa3lEuRYi8LaNIXK5VyP9RGL3m_8B-Dyhg" />
                </div>
                <div class="bg-surface-container-low rounded-lg p-6 flex flex-col items-center text-center group">
                    <div class="w-full aspect-square bg-white rounded-lg mb-6 overflow-hidden">
                        <img alt="Product"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            data-alt="Modern geometric perfume bottle with orange citrus notes, sunlight refraction through the glass, bright energetic atmosphere"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA86OnizyWVhlt2rnG_uhXBwVR_63TY9zIqPThz5eLejHwVMtNiOvAOrpPRJDB6aOuGOllpScLLE1MaTdDcSg_M5DfQhvXkVm_X_61ihtvN2a7-pvdOjymwlt3Po3R-vV1_v0j6DxmoXWBOIY170C8nzLR0OPOelorVkXiqKSqmS_aRSK9OD3k9ote2ZkotfpcRcRqXzMoku46ZDs2KyaaymvntZnJHa0FiRvX3lfGlAviTsioAXH9ZNlMxquEefg3nrRbrkVkXxaBr" />
                    </div>
                    <h4 class="font-bold text-on-surface mb-1">Lăn Khử Mùi Fire</h4>
                    <p class="text-primary font-bold">78,000đ</p>
                    <button
                        class="mt-4 w-full py-3 bg-surface-container-highest rounded-xl font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors">Thêm
                        vào</button>
                </div>
                <div class="bg-surface-container-low rounded-lg p-6 flex flex-col items-center text-center group">
                    <div class="w-full aspect-square bg-white rounded-lg mb-6 overflow-hidden">
                        <img alt="Product"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            data-alt="Dark aesthetic shot of men's facial wash bottle with water splashes and charcoal textures, professional photography"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7k4j1RgyHrfIjiNc8fhoQ55uhS0NwdrYScrnSzFUiJnOM47V63v64JRuyUsWYgwLz4Hfbnk0dji39jzqW6H8cwN2nYww66LZY-qBt2mwuDgAO9SVOb1lvRopY7jp6EiOnT7Ry6I6mWStIeCt6DexYW7sE0UtCMtAKC5cfRCFzxIQuGx7OtMrkZHnrn1QQpMh2-ZKdXXrQNyW6zRRiulbV2rf5b8gygB_j2umDJvZGY3VoNYOhO5t_ybZptP-HvHb5GT0vN_KDeGTG" />
                    </div>
                    <h4 class="font-bold text-on-surface mb-1">Sữa Rửa Mặt Sạch Sâu</h4>
                    <p class="text-primary font-bold">95,000đ</p>
                    <button
                        class="mt-4 w-full py-3 bg-surface-container-highest rounded-xl font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors">Thêm
                        vào</button>
                </div>
            </div>
        </section>
    </main>
@endsection