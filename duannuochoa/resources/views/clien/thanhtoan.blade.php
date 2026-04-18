@extends('layouts.app')
@section('content')
<main class="pt-32 pb-24 px-6 md:px-12 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Billing Details -->
        <div class="lg:col-span-8 space-y-8">
            <header>
                <h1 class="font-headline text-4xl font-extrabold tracking-tight text-on-surface mb-2">Thông tin thanh toán</h1>
                <p class="text-on-surface-variant font-medium">Vui lòng điền đầy đủ thông tin giao hàng bên dưới.</p>
            </header>

            @if ($errors->any())
                <div class="bg-error-container text-on-error-container p-4 rounded-xl">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-error-container text-on-error-container p-4 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="cart_item_ids" value="{{ implode(',', $cartItems->pluck('cart_item_id')->toArray()) }}">

                @if(session('error'))
                <div class="bg-error-container/10 border border-error/20 text-error p-4 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined">error</span>
                    <p class="font-bold text-sm">{{ session('error') }}</p>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-error-container/10 border border-error/20 text-error p-4 rounded-xl space-y-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="material-symbols-outlined">report</span>
                        <p class="font-bold">Vui lòng kiểm tra lại thông tin:</p>
                    </div>
                    <ul class="list-disc list-inside text-sm ml-9">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant ml-2">Họ và tên người nhận</label>
                        <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->full_name) }}" required
                            class="w-full bg-surface-container-low border-none rounded-xl px-6 py-4 focus:ring-2 focus:ring-primary/20 transition-all @error('full_name') ring-2 ring-error/50 @enderror">
                        @error('full_name')
                            <p class="text-error text-xs font-bold ml-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">info</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant ml-2">Số điện thoại</label>
                        <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" required
                            class="w-full bg-surface-container-low border-none rounded-xl px-6 py-4 focus:ring-2 focus:ring-primary/20 transition-all @error('phone') ring-2 ring-error/50 @enderror">
                        @error('phone')
                            <p class="text-error text-xs font-bold ml-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">info</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant ml-2">Địa chỉ nhận hàng</label>
                        <textarea name="address" rows="3" required
                            class="w-full bg-surface-container-low border-none rounded-xl px-6 py-4 focus:ring-2 focus:ring-primary/20 transition-all @error('address') ring-2 ring-error/50 @enderror">{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <p class="text-error text-xs font-bold ml-2 flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">info</span> {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div class="md:col-span-2 space-y-2">
                        <label class="text-sm font-bold text-on-surface-variant ml-2">Ghi chú (Tùy chọn)</label>
                        <textarea name="note" rows="2"
                            class="w-full bg-surface-container-low border-none rounded-xl px-6 py-4 focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Ví dụ: Giao giờ hành chính, gọi trước khi giao..."></textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="font-bold text-lg text-on-surface">Phương thức vận chuyển</h3>
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($shippingMethods as $method)
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-primary/20 has-[:checked]:border-primary has-[:checked]:bg-primary-container/10">
                            <input type="radio" name="shipping_id" value="{{ $method->shipping_id }}" {{ $loop->first ? 'checked' : '' }} 
                                   data-fee="{{ $method->fee }}" onchange="calculateTotal()" class="hidden">
                            <span class="material-symbols-outlined text-primary mr-4">local_shipping</span>
                            <div class="flex-grow">
                                <p class="font-bold">{{ $method->name ?? 'Giao hàng' }}</p>
                                <p class="text-sm text-on-surface-variant">Thời gian nhận hàng 2-3 ngày</p>
                            </div>
                            <span class="font-bold text-primary">{{ $method->fee > 0 ? number_format($method->fee) . 'đ' : 'Miễn phí' }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('shipping_id')
                        <p class="text-error text-xs font-bold ml-2 flex items-center gap-1 mt-2">
                            <span class="material-symbols-outlined text-sm">info</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <h3 class="font-bold text-lg text-on-surface">Phương thức thanh toán</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-primary/20 has-[:checked]:border-primary has-[:checked]:bg-primary-container/10">
                            <input type="radio" name="payment_method" value="cod" checked class="sr-only">
                            <span class="material-symbols-outlined text-primary mr-4">payments</span>
                            <div class="flex-grow">
                                <p class="font-bold">Tiền mặt (COD)</p>
                                <p class="text-[10px] text-on-surface-variant uppercase font-bold">Thanh toán khi nhận hàng</p>
                            </div>
                        </label>
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-primary/20 has-[:checked]:border-primary has-[:checked]:bg-primary-container/10">
                            <input type="radio" name="payment_method" value="vnpay" class="sr-only">
                            <span class="material-symbols-outlined text-primary mr-4">account_balance</span>
                            <div class="flex-grow">
                                <p class="font-bold">VNPay</p>
                                <p class="text-[10px] text-on-surface-variant uppercase font-bold">Thanh toán trực tuyến</p>
                            </div>
                        </label>
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-primary/20 has-[:checked]:border-primary has-[:checked]:bg-primary-container/10">
                            <input type="radio" name="payment_method" value="wallet" class="sr-only">
                            <span class="material-symbols-outlined text-primary mr-4">account_balance_wallet</span>
                            <div class="flex-grow">
                                <p class="font-bold">Ví điện tử</p>
                                <p class="text-[10px] text-on-surface-variant uppercase font-bold tracking-tight">Số dư: {{ number_format(Auth::user()->wallet_balance) }}đ</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-error text-xs font-bold ml-2 flex items-center gap-1 mt-2">
                            <span class="material-symbols-outlined text-sm">info</span> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <h3 class="font-bold text-lg text-on-surface">Voucher hiện có</h3>
                    @if($userVouchers->count() > 0)
                    <div class="grid grid-cols-1 gap-4">
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-surface-container-high has-[:checked]:border-primary has-[:checked]:bg-primary-container/10">
                            <input type="radio" name="user_discount_id" value="" checked class="hidden">
                            <span class="material-symbols-outlined text-outline-variant mr-4">block</span>
                            <div class="flex-grow">
                                <p class="font-bold text-on-surface-variant">Không sử dụng voucher</p>
                            </div>
                        </label>
                        @foreach($userVouchers as $uv)
                        <label class="relative flex items-center p-4 rounded-xl border-2 cursor-pointer transition-all hover:bg-surface-container-low border-surface-container-high has-[:checked]:border-primary has-[:checked]:bg-primary-container/10"
                               data-code="{{ $uv->discount->code }}" 
                               data-value="{{ $uv->discount->discount_value }}" 
                               data-type="{{ $uv->discount->discount_type }}"
                               data-min="{{ $uv->discount->min_order_value }}">
                            <input type="radio" name="user_discount_id" value="{{ $uv->user_discount_id }}" class="hidden" onchange="calculateTotal()">
                            <span class="material-symbols-outlined text-primary mr-4">confirmation_number</span>
                            <div class="flex-grow">
                                <p class="font-bold">{{ $uv->discount->code }}</p>
                                <p class="text-sm text-on-surface-variant">
                                    Giảm {{ number_format($uv->discount->discount_value) }}{{ $uv->discount->discount_type == 'percentage' ? '%' : 'đ' }} 
                                    (Từ đơn {{ number_format($uv->discount->min_order_value) }}đ)
                                </p>
                            </div>
                            @if($subtotal < $uv->discount->min_order_value)
                                <span class="text-[10px] font-bold text-error uppercase">Chưa đủ ĐK</span>
                            @else
                                <span class="material-symbols-outlined text-primary opacity-0 group-has-[:checked]:opacity-100">check_circle</span>
                            @endif
                        </label>
                        @endforeach
                    </div>
                    @else
                    <p class="text-on-surface-variant italic p-4 bg-surface-container-low rounded-xl">Bạn chưa có voucher nào. Hãy đổi xu để lấy voucher!</p>
                    @endif
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-4 lg:sticky lg:top-32">
            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-2xl shadow-blue-900/5 space-y-6 border border-surface-container-high">
                <h2 class="font-headline text-2xl font-bold text-on-surface border-b border-surface-container-high pb-4">Tóm tắt đơn hàng</h2>
                
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cartItems as $item)
                    <div class="flex gap-4">
                        <div class="w-16 h-16 bg-surface-container-low rounded-lg overflow-hidden flex-shrink-0">
                            <img src="{{ $item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <p class="text-sm font-bold text-on-surface line-clamp-1">{{ $item->variant->product->name }}</p>
                            <p class="text-xs text-on-surface-variant">{{ $item->variant->volume_id }}ml x {{ $item->quantity }}</p>
                        </div>
                        <p class="text-sm font-bold">
                            @php $price = $item->variant->price > 0 ? $item->variant->price : $item->variant->product->base_price; @endphp
                            {{ number_format($price * $item->quantity) }}đ
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="space-y-3 pt-6 border-t border-surface-container-high">
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Tạm tính</span>
                        <span class="font-bold text-on-surface" id="summary-subtotal" data-val="{{ $subtotal }}">{{ number_format($subtotal) }}đ</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Giảm giá</span>
                        <span class="font-bold text-tertiary" id="summary-discount">-0đ</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Phí vận chuyển</span>
                        <span class="font-bold text-secondary" id="summary-shipping">Miễn phí</span>
                    </div>
                </div>

                <div class="pt-6 border-t border-surface-container-high">
                    <div class="flex justify-between items-end mb-8">
                        <span class="font-bold text-on-surface">Tổng thanh toán</span>
                        <span class="font-headline text-3xl font-extrabold text-primary" id="summary-total">{{ number_format($subtotal) }}đ</span>
                    </div>
                    
                    <button type="button" onclick="document.getElementById('checkout-form').submit()"
                        class="w-full bg-gradient-to-br from-primary to-primary-container text-on-primary py-5 rounded-2xl font-headline font-bold text-lg shadow-lg shadow-primary/25 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        Xác nhận đặt hàng
                        <span class="material-symbols-outlined">check</span>
                    </button>
                    
                    <p class="text-[10px] text-center text-on-surface-variant mt-4 uppercase font-bold tracking-widest">
                        Bằng việc nhấn đặt hàng, bạn đồng ý với các điều khoản của chúng tôi
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function calculateTotal() {
        const subtotal = parseInt(document.getElementById('summary-subtotal').dataset.val);
        const selectedVoucher = document.querySelector('input[name="user_discount_id"]:checked');
        const selectedShipping = document.querySelector('input[name="shipping_id"]:checked');
        let discountAmount = 0;
        let shippingFee = 0;

        if (selectedVoucher && selectedVoucher.value !== "") {
            const label = selectedVoucher.closest('label');
            const type = label.dataset.type;
            const value = parseInt(label.dataset.value);
            const min = parseInt(label.dataset.min);

            if (subtotal >= min) {
                if (type === 'fixed') {
                    discountAmount = value;
                } else {
                    discountAmount = (subtotal * value) / 100;
                }
            }
        }

        if (selectedShipping) {
            shippingFee = parseInt(selectedShipping.dataset.fee) || 0;
        }

        document.getElementById('summary-discount').innerText = '-' + discountAmount.toLocaleString() + 'đ';
        document.getElementById('summary-shipping').innerText = shippingFee > 0 ? shippingFee.toLocaleString() + 'đ' : 'Miễn phí';
        document.getElementById('summary-total').innerText = Math.max(0, subtotal - discountAmount + shippingFee).toLocaleString() + 'đ';
    }

    // Initial calculation
    window.addEventListener('load', calculateTotal);
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
</style>
@endsection
