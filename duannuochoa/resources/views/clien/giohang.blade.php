@extends('layouts.app')
@section('content')
    <main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
        <!-- Page Title -->
        <header class="mb-8">
            <h1 class="font-headline text-5xl md:text-6xl font-extrabold tracking-tight text-on-surface mb-2">Giỏ Hàng
            </h1>
            <p class="text-on-surface-variant font-medium">Bạn có {{ count($cartItems ?? []) }} sản phẩm trong giỏ hàng của mình.</p>
        </header>

        @if(session('error'))
        <div class="bg-error-container/20 border border-error/50 text-error p-4 rounded-xl mb-8 flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">error</span>
            <p class="font-bold">{{ session('error') }}</p>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-700 p-4 rounded-xl mb-8 flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined">check_circle</span>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Products Table Section -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Select All Bar -->
                @if(count($cartItems) > 0)
                <div class="bg-surface-container-lowest p-6 rounded-lg flex items-center justify-between shadow-sm border border-surface-container-high/50">
                    <label class="flex items-center gap-4 cursor-pointer group">
                        <div class="relative flex items-center">
                            <input type="checkbox" id="select-all" checked 
                                class="peer w-6 h-6 rounded-md border-2 border-surface-container-highest text-primary focus:ring-primary focus:ring-offset-0 transition-all cursor-pointer appearance-none checked:bg-primary checked:border-primary">
                            <span class="material-symbols-outlined absolute text-on-primary scale-0 peer-checked:scale-100 transition-transform pointer-events-none text-xl">check</span>
                        </div>
                        <span class="font-headline font-bold text-on-surface group-hover:text-primary transition-colors">Chọn tất cả ({{ count($cartItems) }})</span>
                    </label>
                </div>
                @endif

                <!-- Product Carts -->
                @forelse($cartItems as $item)
                    @php 
                        $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price; 
                    @endphp
                    <div class="cart-item bg-surface-container-lowest p-6 rounded-lg flex flex-col md:flex-row items-center gap-6 shadow-sm border border-surface-container-high/50 transition-all hover:shadow-md hover:border-primary/20"
                         data-id="{{ $item->cart_item_id }}" 
                         data-price="{{ $price }}" 
                         data-quantity="{{ $item->quantity }}">
                        
                        <div class="relative flex items-center flex-shrink-0">
                            <input type="checkbox" class="item-checkbox peer w-6 h-6 rounded-md border-2 border-surface-container-highest text-primary focus:ring-primary focus:ring-offset-0 transition-all cursor-pointer appearance-none checked:bg-primary checked:border-primary" 
                                checked onchange="updateCartTotals()">
                            <span class="material-symbols-outlined absolute text-on-primary scale-0 peer-checked:scale-100 transition-transform pointer-events-none text-xl">check</span>
                        </div>
                        <div class="w-32 h-32 flex-shrink-0 bg-surface-container-low rounded-lg overflow-hidden">
                            <!-- Try getting product image, fallback to placeholder -->
                            <img alt="{{ $item->variant->product->name }}" class="w-full h-full object-cover"
                                src="{{ $item->variant->image ? asset('storage/' . $item->variant->image) : ($item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80') }}" />
                        </div>
                        <div class="flex-grow text-center md:text-left">
                            <h3 class="font-headline text-xl font-bold text-on-surface">{{ $item->variant->product->name }}</h3>
                            <p class="text-on-surface-variant text-sm mt-1 flex items-center gap-2">
                                Phân loại: {{ $item->variant->volume_id }}ml
                                @if($item->variant->color)
                                    - {{ $item->variant->color }}
                                @endif
                                @if($item->variant->color_code)
                                    <span class="w-3 h-3 rounded-full border border-gray-300 inline-block" style="background-color: {{ $item->variant->color_code }};" title="{{ $item->variant->color }}"></span>
                                @endif
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
                <div class="bg-surface-container-low p-6 rounded-lg mt-8">
                    @if(isset($cart) && $cart->discount)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-primary">
                                <span class="material-symbols-outlined">check_circle</span>
                                <div>
                                    <p class="font-bold">Đã áp dụng mã: {{ $cart->discount->code }}</p>
                                    <p class="text-xs opacity-70">
                                        Giảm {{ $cart->discount->discount_type == 'percentage' ? $cart->discount->discount_value . '%' : number_format($cart->discount->discount_value) . 'đ' }}
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('cart.removeDiscount') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="text-error font-bold text-sm hover:underline">Gỡ mã</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('cart.applyDiscount') }}" method="POST" class="flex flex-col md:flex-row items-center justify-between gap-4">
                            @csrf
                            <div class="flex items-center gap-3 text-on-surface-variant">
                                <span class="material-symbols-outlined">sell</span>
                                <span class="font-medium">Bạn có mã giảm giá?</span>
                            </div>
                            <div class="flex gap-2 w-full md:w-auto">
                                <input
                                    name="code"
                                    class="bg-surface-container-lowest border-none rounded-full px-6 py-2 text-sm focus:ring-2 focus:ring-primary/20 flex-grow md:w-48"
                                    placeholder="Nhập mã tại đây..." type="text" required />
                                <button type="submit"
                                    class="bg-primary text-on-primary px-6 py-2 rounded-full font-bold text-sm hover:bg-primary-dim transition-colors">Áp
                                    dụng</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <!-- Summary Section -->
            <div class="lg:col-span-4 sticky top-32">
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-2xl shadow-blue-900/5 space-y-6">
                    <h2
                        class="font-headline text-2xl font-bold text-on-surface border-b border-surface-container-high pb-4">
                        Tóm tắt đơn hàng</h2>
                    @php
                        $discountAmount = 0;
                        $discountType = '';
                        $discountValue = 0;
                        if (isset($cart) && $cart->discount) {
                            $discount = $cart->discount;
                            $discountType = $discount->discount_type;
                            $discountValue = $discount->discount_value;
                        }
                    @endphp
                    <div class="space-y-4" id="summary-container" 
                         data-discount-type="{{ $discountType }}" 
                         data-discount-value="{{ $discountValue }}">
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tổng số loại sản phẩm</span>
                            <span class="font-bold text-on-surface" id="total-types">0</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tổng số lượng</span>
                            <span class="font-bold text-on-surface" id="total-quantity">0</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Tạm tính</span>
                            <span class="font-bold text-on-surface" id="subtotal-amount">0đ</span>
                        </div>
                        @if($discountAmount > 0)
                            <div class="flex justify-between items-center text-primary">
                                <span>Giảm giá ({{ $cart->discount->code }})</span>
                                <span class="font-bold">-{{ number_format($discountAmount) }}đ</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center text-on-surface-variant">
                            <span>Phí vận chuyển</span>
                            <span class="font-bold text-secondary">Miễn phí</span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-surface-container-high">
                        <div class="flex justify-between items-end mb-8">
                            <span class="font-bold text-on-surface-variant">Tổng cộng</span>
                            <span class="font-headline text-3xl font-extrabold text-primary" id="total-amount">0đ</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" id="checkout-btn"
                            class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary py-5 rounded-xl font-headline font-bold text-lg shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                            Tiến hành thanh toán
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
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
        <section class="mt-32">
            <h2 class="font-headline text-3xl font-bold text-on-surface mb-8">Có thể bạn sẽ thích</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($recommendedProducts as $product)
                    @if($loop->first)
                        <!-- Large Bento Item -->
                        <div class="md:col-span-2 bg-primary-container/10 rounded-lg p-8 flex flex-col justify-between group overflow-hidden relative min-h-[300px]">
                            <div class="relative z-10">
                                <span class="bg-tertiary text-on-tertiary text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">Gợi ý</span>
                                <h3 class="font-headline text-3xl font-bold text-on-primary-container max-w-[200px]">{{ $product->name }}</h3>
                                <p class="text-on-primary-container/70 mt-4 max-w-[240px]">{{ Str::limit($product->description, 80) }}</p>
                                <a href="{{ route('xemchitiet', $product->product_id) }}"
                                    class="mt-6 text-primary font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                                    Xem ngay <span class="material-symbols-outlined">east</span>
                                </a>
                            </div>
                            <img alt="{{ $product->name }}"
                                class="absolute -right-12 -bottom-12 w-64 h-64 object-contain rotate-12 group-hover:rotate-0 transition-transform duration-500"
                                src="{{ asset('storage/' . $product->img) }}" />
                        </div>
                    @else
                        <!-- Standard Item -->
                        <div class="bg-surface-container-low rounded-lg p-6 flex flex-col items-center text-center group">
                            <div class="w-full aspect-square bg-white rounded-lg mb-6 overflow-hidden">
                                <img alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                    src="{{ asset('storage/' . $product->img) }}" />
                            </div>
                            <h4 class="font-bold text-on-surface mb-1">{{ $product->name }}</h4>
                            <p class="text-primary font-bold">{{ number_format($product->base_price) }}đ</p>
                            <a href="{{ route('xemchitiet', $product->product_id) }}"
                                class="mt-4 w-full py-3 bg-surface-container-highest rounded-xl font-bold text-primary hover:bg-primary hover:text-on-primary transition-colors inline-block w-full">Xem chi tiết</a>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>
    </main>

    <script>
        function updateCartTotals() {
            const checkboxes = document.querySelectorAll('.item-checkbox:checked');
            let totalQuantity = 0;
            let subtotal = 0;
            let selectedIds = [];

            checkboxes.forEach(cb => {
                const item = cb.closest('.cart-item');
                const price = parseInt(item.dataset.price);
                const quantity = parseInt(item.dataset.quantity);
                const id = item.dataset.id;

                totalQuantity += quantity;
                subtotal += price * quantity;
                selectedIds.push(id);
            });

            // Calculate Discount
            const summaryContainer = document.getElementById('summary-container');
            const discountType = summaryContainer.dataset.discountType;
            const discountValue = parseInt(summaryContainer.dataset.discountValue) || 0;
            let discountAmount = 0;

            if (discountType === 'percentage') {
                discountAmount = (subtotal * discountValue) / 100;
            } else if (discountType === 'fixed') {
                discountAmount = discountValue;
            }

            // Update UI
            document.getElementById('total-types').innerText = checkboxes.length;
            document.getElementById('total-quantity').innerText = totalQuantity;
            document.getElementById('subtotal-amount').innerText = subtotal.toLocaleString('vi-VN') + 'đ';
            
            if (document.getElementById('discount-row')) {
                document.getElementById('discount-amount').innerText = '-' + discountAmount.toLocaleString('vi-VN') + 'đ';
            }

            const finalTotal = Math.max(0, subtotal - discountAmount);
            document.getElementById('total-amount').innerText = finalTotal.toLocaleString('vi-VN') + 'đ';

            // Update Checkout Button
            const checkoutBtn = document.getElementById('checkout-btn');
            if (selectedIds.length > 0) {
                checkoutBtn.href = "{{ route('checkout.index') }}?items=" + selectedIds.join(',');
                checkoutBtn.classList.remove('opacity-50', 'pointer-events-none');
            } else {
                checkoutBtn.href = "javascript:void(0)";
                checkoutBtn.classList.add('opacity-50', 'pointer-events-none');
            }

            // Update Select All checkbox state
            const selectAll = document.getElementById('select-all');
            if (selectAll) {
                const allCheckboxes = document.querySelectorAll('.item-checkbox');
                selectAll.checked = checkboxes.length === allCheckboxes.length && allCheckboxes.length > 0;
            }
        }

        const selectAllBtn = document.getElementById('select-all');
        if (selectAllBtn) {
            selectAllBtn.addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.item-checkbox').forEach(cb => {
                    cb.checked = isChecked;
                });
                updateCartTotals();
            });
        }

        // Initial calculation
        document.addEventListener('DOMContentLoaded', updateCartTotals);
    </script>
@endsection