<!DOCTYPE html>

<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>X-MEN | Đăng Nhập &amp; Đăng Ký</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&amp;family=Be+Vietnam+Pro:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary": "#e2f6ff",
                        "background": "#f6f6ff",
                        "on-tertiary-container": "#4e2600",
                        "on-secondary-fixed": "#003a48",
                        "inverse-surface": "#060e20",
                        "on-primary-container": "#001e58",
                        "inverse-on-surface": "#959cb5",
                        "tertiary-container": "#ff9738",
                        "secondary-fixed-dim": "#37d4ff",
                        "secondary-dim": "#00576c",
                        "secondary-fixed": "#80deff",
                        "surface-bright": "#f6f6ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-variant": "#d1dcff",
                        "tertiary": "#8d4a00",
                        "error-container": "#fb5151",
                        "surface-dim": "#c7d4fa",
                        "on-primary": "#f1f2ff",
                        "on-surface-variant": "#535b71",
                        "surface-tint": "#0052d0",
                        "on-tertiary-fixed-variant": "#5b2d00",
                        "primary-container": "#799dff",
                        "error-dim": "#9f0519",
                        "tertiary-fixed-dim": "#f78500",
                        "primary": "#0052d0",
                        "surface-container-high": "#d9e2ff",
                        "on-surface": "#272e42",
                        "error": "#b31b25",
                        "surface-container-low": "#eef0ff",
                        "secondary": "#00647b",
                        "surface": "#f6f6ff",
                        "primary-fixed": "#799dff",
                        "on-tertiary": "#fff0e7",
                        "inverse-primary": "#5e8bff",
                        "on-background": "#272e42",
                        "surface-container-highest": "#d1dcff",
                        "primary-dim": "#0047b7",
                        "surface-container": "#e2e7ff",
                        "on-error-container": "#570008",
                        "on-primary-fixed-variant": "#00276c",
                        "outline": "#6f768e",
                        "on-tertiary-fixed": "#2a1200",
                        "on-error": "#ffefee",
                        "on-primary-fixed": "#000000",
                        "outline-variant": "#a5adc6",
                        "tertiary-fixed": "#ff9738",
                        "tertiary-dim": "#7c4000",
                        "on-secondary-fixed-variant": "#00586d",
                        "secondary-container": "#80deff",
                        "primary-fixed-dim": "#638eff",
                        "on-secondary-container": "#004e61"
                    },
                    fontFamily: {
                        "headline": ["Plus Jakarta Sans"],
                        "body": ["Be Vietnam Pro"],
                        "label": ["Be Vietnam Pro"]
                    },
                    borderRadius: { "DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .kinetic-gradient {
            background: linear-gradient(135deg, #0052d0 0%, #799dff 100%);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(24px);
        }
    </style>
</head>

<body
    class="bg-background font-body text-on-background selection:bg-primary-container selection:text-on-primary-container">
    <!-- Auth Shell Section -->
    @yield('content')
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
    <!-- Footer from Shared Components -->
    <footer class="bg-slate-50 dark:bg-slate-900 w-full border-t border-slate-200 dark:border-slate-800">
        <div
            class="grid grid-cols-1 md:grid-cols-4 gap-12 px-12 py-16 max-w-7xl mx-auto font-['Be_Vietnam_Pro'] text-sm">
            <div class="col-span-1 md:col-span-1">
                <div class="text-xl font-black text-blue-700 dark:text-blue-500 mb-6">X-MEN</div>
                <p class="text-slate-500 leading-relaxed">Năng lượng bứt phá, khẳng định bản lĩnh phái mạnh trong mọi
                    hoàn cảnh.</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-6">Sản Phẩm</h4>
                <ul class="space-y-4 text-slate-500 dark:text-slate-500">
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Nước Hoa</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Tắm Gội</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Khử Mùi</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Tạo Kiểu Tóc</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-6">Hỗ Trợ</h4>
                <ul class="space-y-4 text-slate-500 dark:text-slate-500">
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Privacy Policy</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Terms of Service</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Shipping &amp; Returns</a></li>
                    <li><a class="hover:text-orange-500 transition-colors" href="#">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-6">Liên Hệ</h4>
                <ul class="space-y-4 text-slate-500 dark:text-slate-500">
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600" data-icon="location_on">location_on</span>
                        Store Locator
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600" data-icon="mail">mail</span>
                        contact@xmen.com.vn
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-12 py-8 border-t border-slate-200 dark:border-slate-800 text-center text-slate-400">
            © 2024 X-MEN KINETIC VITALITY. ALL RIGHTS RESERVED.
        </div>
    </footer>
</body>

</html>