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
                            href="#order-history">
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
                <!-- Order History Section (Bento Grid Style) -->
                <section class="space-y-6" id="order-history">
                    <div class="flex items-end justify-between px-2">
                        <div>
                            <h2 class="text-2xl font-headline font-extrabold tracking-tight text-primary">Đơn hàng gần
                                đây</h2>
                            <p class="text-on-surface-variant">Theo dõi trạng thái các đơn hàng của bạn</p>
                        </div>
                        <button class="text-primary font-bold flex items-center space-x-1 hover:underline">
                            <span>Xem tất cả</span>
                            <span class="material-symbols-outlined text-sm" data-icon="arrow_forward">arrow_forward</span>
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Order Card 1 -->
                        <div
                            class="bg-surface-container-lowest p-6 rounded-lg shadow-xl shadow-blue-900/5 hover:scale-[1.02] transition-transform group">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span class="text-xs font-bold text-primary uppercase tracking-widest">Đang xử
                                        lý</span>
                                    <h3 class="text-lg font-bold mt-1">#XM-88291</h3>
                                </div>
                                <span class="text-sm text-on-surface-variant">15 Th05, 2024</span>
                            </div>
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-20 h-20 bg-surface-container-low rounded-lg p-2 overflow-hidden">
                                    <img alt="Product" class="w-full h-full object-contain"
                                        data-alt="sleek professional blue glass perfume bottle on a clean white surface with elegant lighting"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBmbgYGeQwMHs6RPYy3sEEw2GXpJz1hnW_DfdLlUggjsGmfMqv_A6LmdYJm9rAzChf_eD7TjKGkML1X3IfztvK7qdCGw2p0ikzsai6lOiYGn9_vxX8xqfU2IyeNThroc6Rb7B05au-Q58nInpsz9UK5nC5xCT-2AKiKvCQxjoGkBp-xEhdgpOl1uyc4Es1mI4IJdByEwuajrLg5UIKVaP-khPLtGdf07BgtBG0FZSBnMeiNkfaiHHjr7e-cHZqmZFoAUNAN9pAflJbW" />
                                </div>
                                <div>
                                    <p class="font-bold">X-MEN Kinetic Scent</p>
                                    <p class="text-sm text-on-surface-variant">Số lượng: 01 • 100ml</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                                <span class="font-bold text-lg">450,000₫</span>
                                <button
                                    class="bg-surface-container-highest text-primary px-4 py-2 rounded-full text-sm font-bold group-hover:bg-primary group-hover:text-on-primary transition-colors">Chi
                                    tiết</button>
                            </div>
                        </div>
                        <!-- Order Card 2 -->
                        <div
                            class="bg-surface-container-lowest p-6 rounded-lg shadow-xl shadow-blue-900/5 hover:scale-[1.02] transition-transform group">
                            <div class="flex justify-between items-start mb-6">
                                <div>
                                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Đã giao
                                        hàng</span>
                                    <h3 class="text-lg font-bold mt-1">#XM-88104</h3>
                                </div>
                                <span class="text-sm text-on-surface-variant">02 Th05, 2024</span>
                            </div>
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-20 h-20 bg-surface-container-low rounded-lg p-2 overflow-hidden">
                                    <img alt="Product" class="w-full h-full object-contain"
                                        data-alt="premium metallic blue shaving foam canister with modern design against a minimal background"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlbAHGC8o4-6yHEnIUkbsbRzY57EGgHsyBYqlD3TQEeHrNNL_FVn4MVMNDMCcbCdxWGL_l2VLAm0NsAPRK3nCrAmodGxX94U4Wi-OBmNHBlmayzx8pTO08I4GOcW29O0GWqGgWd-sL1T0rue3IKd99i5Z7sdHaaGz-tASNQVBLa1iVVCuaoZQ9zvl0J3BfQMHXdSUc0NusXYTJToWJm2OWbOV3DM9CUilOJlql_4ffuDgPDjM7Ns67ojuMeQ-ZHPENRXSNuE-wfIgm" />
                                </div>
                                <div>
                                    <p class="font-bold">Combo Sạch Sâu X-MEN</p>
                                    <p class="text-sm text-on-surface-variant">Số lượng: 02 • Bundle</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                                <span class="font-bold text-lg">720,000₫</span>
                                <button
                                    class="bg-surface-container-highest text-primary px-4 py-2 rounded-full text-sm font-bold group-hover:bg-primary group-hover:text-on-primary transition-colors">Mua
                                    lại</button>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Activity Insights (Visual Interest) -->
                <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
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