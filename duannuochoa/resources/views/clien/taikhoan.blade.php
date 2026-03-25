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
                            <img alt="Avatar" class="w-full h-full object-cover"
                                data-alt="close-up portrait of a confident young man with stylish hair looking at the camera in soft daylight"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCb25ToM5e4RsuerzJsXK4H3blc19H9HnK00DYnnqvkiT8ZGH9vNZ19TWxQ_hgGeNx3Wmq4W3gR8SVHG1t9KcGCMKbwuQrs-ISKtOd9unkN1gVg_G6rmNK6Fn40pAHQrcTGVCjcnIlwhkd0Inpp6a-9-9SKo9rJ0FY6_sGcbrMIk3VydtNadqYFCJykxLGTtWZTBsqUrTMJ3T2HJi4LpKTkOhFIz751nXkk1H3Yf3E4BiKg3PYd9ExubuK8OpKyyHqx7lxr9peIyQCl" />
                        </div>
                        <div>
                            <h2 class="font-headline font-bold text-lg leading-tight">Chào, Nam Trần</h2>
                            <p class="text-sm text-on-surface-variant">Thành viên Bạc</p>
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
                            <a class="flex items-center space-x-3 p-4 rounded-xl hover:text-error transition-all text-on-surface-variant font-medium"
                                href="#">
                                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                                <span>Đăng xuất</span>
                            </a>
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
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Họ và Tên</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                type="text" value="Trần Hoàng Nam" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Địa chỉ Email</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                type="email" value="nam.tran@example.com" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-on-surface-variant ml-2">Số điện thoại</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all"
                                type="tel" value="090 123 4567" />
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
                                rows="3">123 Đường Lê Lợi, Quận 1, TP. Hồ Chí Minh</textarea>
                        </div>
                        <div class="md:col-span-2 pt-4">
                            <button
                                class="bg-gradient-to-r from-primary to-primary-container text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-95"
                                type="submit">
                                Cập nhật thông tin
                            </button>
                        </div>
                    </form>
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
                                <span class="font-bold text-lg">450.000₫</span>
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
                                <span class="font-bold text-lg">720.000₫</span>
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
                        <h4 class="text-sm font-medium opacity-80">Điểm tích lũy</h4>
                        <p class="text-3xl font-black">1.250</p>
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
                        <h4 class="text-sm font-medium opacity-80">Voucher khả dụng</h4>
                        <p class="text-3xl font-black">04</p>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection