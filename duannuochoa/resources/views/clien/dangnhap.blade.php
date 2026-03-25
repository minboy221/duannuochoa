@extends('layouts.login')
@section('content')
    <main class="min-h-screen flex items-center justify-center p-4 md:p-8 relative overflow-hidden">
        <!-- Background Kinetic Blobs -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-primary/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-secondary/10 rounded-full blur-[100px]">
        </div>
        <div
            class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 bg-surface-container-low rounded-lg overflow-hidden shadow-2xl shadow-on-surface/5 relative z-10">
            <!-- Left Side: Editorial Visual -->
            <div class="hidden lg:block relative min-h-[700px]">
                <img alt="X-MEN Fragrance Bottle" class="absolute inset-0 w-full h-full object-cover"
                    data-alt="Premium glass cologne bottle with deep blue liquid resting on a wet dark stone surface with dramatic side lighting and spray mist"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlVkO5aiZYw03vHIV6UaBEOBcYDO77L6B-tKKCvLdDlSPzExtIFTR4GAYu_YgKWRAxZyrftVOnDgWer5GIvFrnSKzoaMoGNH8AQ41IKWZwWjWT8HSneVZw4zjuVgI_oW6hMiNnEDgODuaUC0xxzIPJpxxxukqAaxR0nfrfcQltDJ6IYeqoroOBHucc23GiFRJetQxJOwiigFRpVfR6dheLi8ZMlO6wbzH3hnGzdiM4tkFKezgqT7abvBPGWBYwUWhr6pQBRpI2j2Mf" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                <div class="absolute bottom-12 left-12 right-12 text-on-primary">
                    <h1 class="font-headline text-5xl font-black italic tracking-tighter mb-4">X-MEN</h1>
                    <p class="font-body text-xl opacity-90 max-w-md leading-relaxed">Đánh thức bản lĩnh phái mạnh với
                        hương thơm lôi cuốn và năng lượng bứt phá.</p>
                </div>
            </div>
            <!-- Right Side: Auth Forms -->
            <div class="bg-surface-container-lowest p-8 md:p-16 flex flex-col justify-center">
                <!-- Toggle Header -->
                <div class="flex gap-8 mb-12">
                    <button
                        class="font-headline text-2xl font-extrabold tracking-tight border-b-4 border-primary pb-2 text-on-surface">Đăng
                        Nhập</button>
                    <button
                        class="font-headline text-2xl font-extrabold tracking-tight text-outline-variant pb-2 hover:text-primary transition-colors">Đăng
                        Ký</button>
                </div>
                <!-- Login Form -->
                <form class="space-y-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold ml-4 text-on-surface-variant">Email hoặc Số điện
                            thoại</label>
                        <input
                            class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none text-on-surface placeholder:text-outline-variant"
                            placeholder="example@gmail.com" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold ml-4 text-on-surface-variant">Mật khẩu</label>
                        <div class="relative">
                            <input
                                class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none text-on-surface placeholder:text-outline-variant"
                                placeholder="••••••••" type="password" />
                            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-outline" type="button">
                                <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between px-2">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/20"
                                type="checkbox" />
                            <span
                                class="text-sm font-medium text-on-surface-variant group-hover:text-primary transition-colors">Ghi
                                nhớ</span>
                        </label>
                        <a class="text-sm font-bold text-primary hover:text-primary-dim transition-colors" href="#">Quên
                            mật khẩu?</a>
                    </div>
                    <button
                        class="w-full kinetic-gradient text-on-primary py-4 rounded-xl font-headline font-bold text-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all"
                        type="submit">
                        ĐĂNG NHẬP NGAY
                    </button>
                </form>
                <!-- Divider -->
                <div class="relative my-10 flex items-center">
                    <div class="flex-grow border-t border-surface-variant"></div>
                    <span class="flex-shrink mx-4 text-sm font-medium text-outline-variant">Hoặc đăng nhập với</span>
                    <div class="flex-grow border-t border-surface-variant"></div>
                </div>
                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-4">
                    <button
                        class="flex items-center justify-center gap-3 py-3 px-6 bg-surface-container-high rounded-lg hover:bg-surface-container-highest border border-transparent hover:border-outline-variant/20 transition-all group">
                        <img alt="Google" class="w-5 h-5"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB7onaKjNlD2yOk0pIEJbJOeT9KpaJpruQzKnPz_IA39_mJDzi7F7BuYX3fmubE20SlDHBz4jmf5sRfSY6Ed-6oF2IvQgPMVXKNL3Efk5Y0SxJcwpzrwtt5TYMVq9Ngjc7FKDJTdR1DlNwE5ikf2te0z9R7YnjaSdupjyIkFqFtshI0n_xnaXY3N0TuqqOJyTP63eYpKr_5TE_D6KHPxwXnt458mQGZ_tAg8op8gw0sajY_aCnH-QP7V3-WXqvW6xTNHJ3Tg_EVWlso" />
                        <span class="font-bold text-on-surface text-sm">Google</span>
                    </button>
                    <button
                        class="flex items-center justify-center gap-3 py-3 px-6 bg-surface-container-high rounded-lg hover:bg-surface-container-highest border border-transparent hover:border-outline-variant/20 transition-all group">
                        <img alt="Facebook" class="w-5 h-5"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCT9QQkpUhjqkylY-lq5QdJT26Bhr2aCbmSkc8GOZxNZjzL-Se3Rm2akuR2-fZv4JcsvL1RdteYE_eQBj8CoAIAySixPoFgbvHvqYnIb-wgc2MrIOCVMBG09OzlmGPqRCl4xgDIKPTT5tOmIogZ0698qxkldEcIkxGZdM0OV0beS85-gPPYaeCelOI1-Gas6KNEvUEEYfDU8irpl5NicoyoIUTUNtCnGKDYXkDLugmYBUbqTMxnegYhg5xPEMuCPSJgXisjFie8Uy5U" />
                        <span class="font-bold text-on-surface text-sm">Facebook</span>
                    </button>
                </div>
                <!-- Toggle Mobile -->
                <div class="mt-12 text-center lg:hidden">
                    <p class="text-on-surface-variant text-sm">Chưa có tài khoản? <a class="text-primary font-bold"
                            href="#">Tạo tài khoản mới</a></p>
                </div>
            </div>
        </div>
    </main>
    <!-- Hidden Register Flow (Layout Structure) -->
    <div class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-inverse-surface/40 backdrop-blur-sm">
        <div class="bg-surface-container-lowest w-full max-w-lg p-10 rounded-lg shadow-2xl">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-headline text-3xl font-black text-on-surface">Tạo Tài Khoản</h2>
                <button class="p-2 hover:bg-surface-container-high rounded-full"><span class="material-symbols-outlined"
                        data-icon="close">close</span></button>
            </div>
            <form class="space-y-5">
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-outline ml-4">Họ và tên</label>
                    <input class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md outline-none"
                        placeholder="Nguyễn Văn A" type="text" />
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-outline ml-4">Email</label>
                    <input class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md outline-none"
                        placeholder="example@gmail.com" type="email" />
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-outline ml-4">Mật khẩu</label>
                    <input class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md outline-none"
                        placeholder="••••••••" type="password" />
                    <!-- Password Strength Indicator -->
                    <div class="flex gap-1 mt-2 px-4">
                        <div class="h-1 flex-1 bg-tertiary rounded-full"></div>
                        <div class="h-1 flex-1 bg-tertiary rounded-full"></div>
                        <div class="h-1 flex-1 bg-surface-variant rounded-full"></div>
                        <div class="h-1 flex-1 bg-surface-variant rounded-full"></div>
                        <span class="text-[10px] font-bold text-tertiary ml-2">TRUNG BÌNH</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold uppercase tracking-wider text-outline ml-4">Xác nhận mật
                        khẩu</label>
                    <input class="w-full px-6 py-4 bg-surface-container-high border-none rounded-md outline-none"
                        placeholder="••••••••" type="password" />
                </div>
                <button
                    class="w-full kinetic-gradient text-on-primary py-4 rounded-xl font-headline font-bold mt-4 shadow-lg"
                    type="submit">ĐĂNG KÝ NGAY</button>
            </form>
        </div>
    </div>
@endsection