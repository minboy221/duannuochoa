<!DOCTYPE html>

<html class="light" lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Xmen Admin - Tổng quan Quản trị</title>
    <!-- Google Fonts: Plus Jakarta Sans & Be Vietnam Pro -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be+Vietnam+Pro:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet" />
    <!-- Material Symbols -->
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface-variant": "#535b71",
                        "on-secondary-fixed": "#003a48",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#00647b",
                        "primary-fixed-dim": "#638eff",
                        "background": "#f6f6ff",
                        "tertiary-fixed-dim": "#f78500",
                        "inverse-primary": "#5e8bff",
                        "tertiary": "#8d4a00",
                        "error": "#b31b25",
                        "secondary-fixed-dim": "#37d4ff",
                        "inverse-on-surface": "#959cb5",
                        "on-error-container": "#570008",
                        "surface-tint": "#0052d0",
                        "on-tertiary-fixed-variant": "#5b2d00",
                        "surface-container-high": "#d9e2ff",
                        "on-tertiary-container": "#4e2600",
                        "on-primary": "#f1f2ff",
                        "tertiary-dim": "#7c4000",
                        "surface-dim": "#c7d4fa",
                        "on-primary-fixed-variant": "#00276c",
                        "on-background": "#272e42",
                        "surface-container": "#e2e7ff",
                        "on-tertiary-fixed": "#2a1200",
                        "on-secondary-fixed-variant": "#00586d",
                        "on-secondary": "#e2f6ff",
                        "secondary-container": "#80deff",
                        "primary-container": "#799dff",
                        "secondary-dim": "#00576c",
                        "outline": "#6f768e",
                        "secondary-fixed": "#80deff",
                        "surface-variant": "#d1dcff",
                        "surface-container-low": "#eef0ff",
                        "primary": "#0052d0",
                        "surface-bright": "#f6f6ff",
                        "error-container": "#fb5151",
                        "error-dim": "#9f0519",
                        "primary-dim": "#0047b7",
                        "surface": "#f6f6ff",
                        "outline-variant": "#a5adc6",
                        "primary-fixed": "#799dff",
                        "inverse-surface": "#060e20",
                        "on-secondary-container": "#004e61",
                        "on-primary-fixed": "#000000",
                        "tertiary-fixed": "#ff9738",
                        "on-error": "#ffefee",
                        "surface-container-highest": "#d1dcff",
                        "on-tertiary": "#fff0e7",
                        "tertiary-container": "#ff9738",
                        "on-primary-container": "#001e58",
                        "on-surface": "#272e42"
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
            display: inline-block;
            vertical-align: middle;
        }

        body {
            font-family: 'Be Vietnam Pro', sans-serif;
            background-color: #f6f6ff;
        }

        h1,
        h2,
        h3,
        .font-headline {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="text-on-background">
    <!-- SideNavBar Shell -->
    <aside
        class="fixed left-0 top-0 h-full z-40 flex flex-col p-4 h-screen w-64 border-r border-slate-200 bg-slate-50 font-['Plus_Jakarta_Sans'] font-medium text-sm">
        <div class="mb-8 px-2">
            <h1 class="font-extrabold text-2xl tracking-tight text-blue-700">Xmen Admin</h1>
            <p class="text-[10px] text-on-surface-variant tracking-widest uppercase mt-1">Cổng Quản trị</p>
        </div>
        <nav class="flex flex-col gap-2 flex-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-200 transition-all duration-200 scale-95 active:scale-90"
                href="#">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                <span>Tổng quan</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
                <span>Sản phẩm</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="shopping_cart">shopping_cart</span>
                <span>Đơn hàng</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="group">group</span>
                <span>Khách hàng</span>
            </a>
            <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                <span>Cài đặt</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-slate-200 flex items-center gap-3 px-2">
            <img alt="Admin User Profile" class="w-10 h-10 rounded-full object-cover border-2 border-primary"
                data-alt="Professional studio portrait of a confident male executive in a blue shirt with a clean background"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAo8vYkaHjNHzG9Q6iykrniuK0XxlHnzACLMuFqP5A0Bm6sbzWO-jqsrsKvZGPhqDWmpd0FsmhJMkRv-6DxcUjJlluPmTHYTLBFrOD_EauJU7udtADCv45Yg6JvXZrPwNgwyUqP6jtpmq3jna6PRqmP7o0Jp-qe2pA33n-nPHiBOVsafz-K7f27WkTw2WHnIuGpbAKGw8zqvXGE4uCT0xBGyz6an-ncv97K69dFtYg8s5JEIPodOXXnWOxJzG3fajIfdBmhN-7b9Eht" />
            <div>
                <p class="font-bold text-on-background">Quản trị viên</p>
                <p class="text-xs text-on-surface-variant">Quản trị viên cấp cao</p>
            </div>
        </div>
    </aside>
    <!-- TopNavBar Shell -->
    <header
        class="sticky top-0 right-0 z-30 flex justify-between items-center px-8 w-[calc(100%-16rem)] ml-64 bg-white/80 backdrop-blur-xl h-16 shadow-sm border-b border-slate-100">
        <div class="flex items-center gap-4 flex-1">
            <div class="relative w-full max-w-md group">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline"
                    data-icon="search">search</span>
                <input
                    class="w-full bg-surface-container-low border-none rounded-full py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/20 transition-all"
                    placeholder="Tìm kiếm phân tích hoặc đơn hàng..." type="text" />
            </div>
        </div>
        <div class="flex items-center gap-4">
            <button
                class="w-10 h-10 flex items-center justify-center rounded-full text-slate-500 hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
            </button>
            <button
                class="w-10 h-10 flex items-center justify-center rounded-full text-slate-500 hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
            </button>
        </div>
    </header>
    @yield('content')
</body>

</html>