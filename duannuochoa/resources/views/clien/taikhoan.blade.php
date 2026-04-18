@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3 space-y-4">
                <div class="bg-surface-container-low p-6 rounded-lg sticky top-28">
                    <div class="flex items-center space-x-4 mb-8">
                        <div
                            class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-on-primary text-xl font-bold shadow-lg overflow-hidden">
                        <div class="relative group">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-on-primary text-xl font-bold shadow-lg overflow-hidden border-2 border-white">
                                <img alt="Avatar" class="w-full h-full object-cover"
                                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=0052d0&color=fff' }}" />
                            </div>
                            <label for="avatar-sidebar" class="absolute bottom-0 right-0 bg-white rounded-full p-1 shadow-md cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
                                <span class="material-symbols-outlined text-xs text-primary">edit</span>
                            </label>
                        </div>
                        </div>
                        <div>
                            <h2 class="font-headline font-bold text-lg leading-tight">Chào, {{ Auth::user()->full_name }}</h2>
                            <p class="text-sm text-on-surface-variant">Thành viên mới</p>
                        </div>
                    </div>
                    <nav class="space-y-2">
                        <a class="flex items-center space-x-3 p-4 rounded-xl bg-surface-container-lowest text-primary font-bold transition-all shadow-sm"
                            href="#personal-info">
                            <span class="material-symbols-outlined" data-icon="person_outline">person_outline</span>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="{{ route('lichsu') }}">
                            <span class="material-symbols-outlined" data-icon="history">history</span>
                            <span>Lịch sử đơn hàng</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="#settings">
                            <span class="material-symbols-outlined" data-icon="settings">settings</span>
                            <span>Cài đặt tài khoản</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-outline-variant/20">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 p-4 rounded-xl hover:text-error transition-all text-on-surface-variant font-medium text-left">
                                    <span class="material-symbols-outlined" data-icon="logout">logout</span>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </aside>
            <!-- Main Content Area -->
            <div class="lg:col-span-9 space-y-12">
                <!-- Personal Info Section -->
                <section class="bg-surface-container-lowest p-8 md:p-10 rounded-lg shadow-2xl shadow-blue-900/5"
                    id="personal-info">
                    <header class="mb-8">
                        <h1 class="text-3xl font-headline font-extrabold tracking-tight text-primary mb-2">Thông tin cá
                            nhân</h1>
                        <p class="text-on-surface-variant">Quản lý thông tin hồ sơ của bạn để bảo mật tài khoản</p>
                    </header>
                    @if(session('success'))
                        <div class="alert alert-success mb-6">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div class="md:col-span-2 flex justify-center mb-6">
                            <div class="relative group cursor-pointer" onclick="document.getElementById('avatar-input').click()">
                                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-surface-container-high shadow-xl transition-all group-hover:border-primary/30">
                                    <img id="avatar-preview" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=0052d0&color=fff&size=128' }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="material-symbols-outlined text-white text-3xl">photo_camera</span>
                                </div>
                                <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Họ và Tên</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                type="text" name="full_name" value="{{ Auth::user()->full_name }}" required />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Địa chỉ Email</label>
                            <input
                                class="w-full bg-surface-container-high/50 border-none rounded-md px-6 py-4 text-on-surface-variant cursor-not-allowed"
                                type="email" value="{{ Auth::user()->email }}" disabled />
                            <p class="text-[10px] text-on-surface-variant ml-2 italic">* Email không thể thay đổi</p>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Số điện thoại</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                type="tel" name="phone" value="{{ Auth::user()->phone }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Giới tính</label>
                            <select
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all">
                                <option selected="">Nam</option>
                                <option>Nữ</option>
                                <option>Khác</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Địa chỉ nhận hàng</label>
                            <textarea
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                name="address" rows="3">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="md:col-span-2 pt-4">
                            <button
                                class="bg-gradient-to-r from-primary to-primary-container text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95"
                                type="submit">
                                Cập nhật thông tin
                            </button>
                        </div>
                    </form>

                    <script>
                        function previewImage(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('avatar-preview').src = e.target.result;
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                </section>
                <!-- Activity Insights (Visual Interest) -->
                <section class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="bg-indigo-600 p-6 rounded-lg text-white">
                        <span class="material-symbols-outlined mb-4 scale-125" data-icon="account_balance_wallet"
                            style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
                        <h4 class="text-sm font-medium opacity-80">Số dư ví</h4>
                        <p class="text-3xl font-black">{{ number_format(Auth::user()->wallet_balance) }}đ</p>
                    </div>
                    <div class="bg-gradient-to-br from-primary to-primary-container p-6 rounded-lg text-on-primary">
                        <span class="material-symbols-outlined mb-4 scale-125" data-icon="stars"
                            style="font-variation-settings: 'FILL' 1;">stars</span>
                        <h4 class="text-sm font-medium opacity-80">Xu tích lũy</h4>
                        <p class="text-3xl font-black">{{ number_format(Auth::user()->xu) }} xu</p>
                    </div>
                    <div class="bg-tertiary-container p-6 rounded-lg text-on-tertiary-container">
                        <span class="material-symbols-outlined mb-4 scale-125" data-icon="local_shipping"
                            style="font-variation-settings: 'FILL' 1;">local_shipping</span>
                        <h4 class="text-sm font-medium opacity-80">Đơn hàng hiện tại</h4>
                        <p class="text-3xl font-black">01</p>
                    </div>
                    <div class="bg-secondary-container p-6 rounded-lg text-on-secondary-container">
                        <span class="material-symbols-outlined mb-4 scale-125" data-icon="confirmation_number"
                            style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
                        <h4 class="text-sm font-medium opacity-80">Voucher của tôi</h4>
                        <p class="text-3xl font-black">{{ $userVouchers->whereNull('used_at')->count() }}</p>
                    </div>
                </section>

                <!-- Voucher Exchange Section -->
                <section class="space-y-6" id="vouchers">
                    <h2 class="text-2xl font-headline font-extrabold tracking-tight text-primary">Đổi Voucher từ Xu</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($availableVouchers as $voucher)
                        <div class="bg-surface-container-low p-6 rounded-lg border-2 border-dashed border-primary/20 flex justify-between items-center group hover:border-primary transition-all">
                            <div>
                                <h4 class="font-bold text-lg text-primary">{{ $voucher->code }}</h4>
                                <p class="text-sm text-on-surface-variant">Giảm {{ number_format($voucher->discount_value) }}{{ $voucher->discount_type == 'percentage' ? '%' : 'đ' }}</p>
                                <p class="text-xs font-bold text-tertiary mt-2">Giá: {{ number_format($voucher->points_required) }} xu</p>
                            </div>
                            <form action="{{ route('vouchers.redeem') }}" method="POST">
                                @csrf
                                <input type="hidden" name="discount_id" value="{{ $voucher->discount_id }}">
                                <button type="submit" @if(Auth::user()->xu < $voucher->points_required) disabled @endif
                                    class="px-6 py-2 rounded-full font-bold text-sm transition-all
                                    {{ Auth::user()->xu >= $voucher->points_required ? 'bg-primary text-on-primary hover:scale-105' : 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed' }}">
                                    Đổi
                                </button>
                            </form>
                        </div>
                        @empty
                        <p class="text-on-surface-variant italic">Hiện không có voucher nào khả dụng để đổi.</p>
                        @endforelse
                    </div>

                    <h2 class="text-2xl font-headline font-extrabold tracking-tight text-primary mt-12">Voucher của tôi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($userVouchers as $uv)
                        <div class="bg-surface-container-lowest p-6 rounded-lg border border-surface-container-high flex justify-between items-center opacity-{{ $uv->used_at ? '50' : '100' }}">
                            <div>
                                <h4 class="font-bold text-lg {{ $uv->used_at ? 'line-through text-on-surface-variant' : 'text-on-surface' }}">{{ $uv->discount->code }}</h4>
                                <p class="text-sm text-on-surface-variant">Hạn dùng: {{ $uv->discount->valid_to->format('d/m/Y') }}</p>
                                @if($uv->used_at)
                                    <span class="inline-block mt-2 px-2 py-1 rounded-md bg-surface-container text-[10px] font-bold uppercase">Đã sử dụng</span>
                                @else
                                    <span class="inline-block mt-2 px-2 py-1 rounded-md bg-secondary-container text-on-secondary-container text-[10px] font-bold uppercase">Khả dụng</span>
                                @endif
                            </div>
                            <span class="material-symbols-outlined text-4xl text-primary/30">confirmation_number</span>
                        </div>
                        @empty
                        <p class="text-on-surface-variant italic">Bạn chưa sở hữu voucher nào.</p>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection