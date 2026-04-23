<!DOCTYPE html>

<html lang="vi">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Be_Vietnam_Pro:wght@300;400;500;600;700&amp;display=swap"
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
                        "surface-variant": "#d1dcff",
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
        }

        .glass-nav {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .kinetic-gradient {
            background: linear-gradient(135deg, #0052d0 0%, #799dff 100%);
        }

        .hero-mask {
            mask-image: linear-gradient(to right, black 50%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, black 50%, transparent 100%);
        }

        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll {
            animation: scroll 20s linear infinite;
        }
    </style>
</head>

<body class="bg-surface font-body text-on-surface">
    <!-- TopNavBar -->
    <header class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl shadow-2xl shadow-blue-900/5">
        <!-- Announcement Bar -->
        <div class="w-full bg-gradient-to-r from-violet-600 via-fuchsia-500 to-orange-500 overflow-hidden py-2 flex whitespace-nowrap">
            <div class="animate-scroll flex w-max">
                <div class="flex items-center">
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">⚡ Flash sale giảm tới 50%</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">✨ Giao hàng hỏa tốc trong 2H</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">🎁 Quà tặng cho đơn từ 2 triệu</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">⚡ Flash sale giảm tới 50%</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">✨ Giao hàng hỏa tốc trong 2H</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">🎁 Quà tặng cho đơn từ 2 triệu</span>
                </div>
                <div class="flex items-center">
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">⚡ Flash sale giảm tới 50%</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">✨ Giao hàng hỏa tốc trong 2H</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">🎁 Quà tặng cho đơn từ 2 triệu</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">⚡ Flash sale giảm tới 50%</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">✨ Giao hàng hỏa tốc trong 2H</span>
                    <span class="text-white font-bold text-sm px-8 uppercase tracking-widest flex items-center gap-2">🎁 Quà tặng cho đơn từ 2 triệu</span>
                </div>
            </div>
        </div>
        <nav class="flex justify-between items-center px-8 py-4 max-w-screen-2xl mx-auto">
            <div class="text-3xl font-black italic tracking-tighter text-blue-700">X-MEN</div>
            <div class="hidden md:flex items-center space-gap-8 gap-8">
                <a class="{{ request()->routeIs('home') ? 'text-blue-700 border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors duration-300' }} font-medium font-['Plus_Jakarta_Sans'] font-bold tracking-tight"
                    href="{{ route('home') }}">Trang Chủ</a>
                <a class="{{ request()->routeIs('about') ? 'text-blue-700 border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors duration-300' }} font-medium font-['Plus_Jakarta_Sans'] font-bold tracking-tight"
                    href="{{ route('about') }}">Giới Thiệu</a>
                <a class="{{ request()->routeIs('sanpham', 'xemchitiet') ? 'text-blue-700 border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors duration-300' }} font-medium font-['Plus_Jakarta_Sans'] font-bold tracking-tight"
                    href="{{ route('sanpham') }}">Sản Phẩm</a>
                <a class="{{ request()->routeIs('news.*') ? 'text-blue-700 border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors duration-300' }} font-medium font-['Plus_Jakarta_Sans'] font-bold tracking-tight"
                    href="{{ route('news.index') }}">Tin tức</a>
                <a class="{{ request()->routeIs('lienhe') ? 'text-blue-700 border-b-2 border-blue-600 pb-1' : 'text-slate-600 hover:text-blue-500 transition-colors duration-300' }} font-medium font-['Plus_Jakarta_Sans'] font-bold tracking-tight"
                    href="{{ route('lienhe') }}">Liên Hệ</a>
            </div>
            <div class="flex items-center gap-6">
                <div class="relative hidden lg:block" id="header-search-container">
                    <form action="{{ route('sanpham') }}" method="GET">
                        <input id="header-search-input" name="search" autocomplete="off" value="{{ request('search') }}"
                            class="bg-surface-container-high border-none rounded-full py-2 px-6 w-64 focus:ring-2 focus:ring-primary/20 transition-all outline-none text-sm focus:w-80"
                            placeholder="Tìm kiếm mùi hương..." type="text" />
                        <button type="submit" class="absolute right-4 top-2 text-outline hover:text-primary">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                    <!-- Suggestions Dropdown -->
                    <div id="header-search-results" class="absolute top-full right-0 w-80 mt-2 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden hidden z-50">
                        <div id="header-search-list" class="max-h-[60vh] overflow-y-auto">
                            <!-- Items go here -->
                        </div>
                    </div>
                </div>
                <div class="flex gap-4">
                    <button
                        class="p-2 hover:bg-primary-container/20 rounded-full transition-colors scale-95 active:scale-90 duration-300">
                        <a href="{{ route('giohang') }}" class="relative flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">shopping_cart</span>
                            @auth
                                @php
                                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->first()?->items()->sum('quantity') ?? 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            @endauth
                        </a>
                    </button>
                    <button
                        class="p-2 hover:bg-primary-container/20 rounded-full transition-colors scale-95 active:scale-90 duration-300">
                        @auth
                            <a href="{{ route('taikhoan') }}">
                                <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-primary/20 shadow-sm">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=0052d0&color=fff' }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            </a>
                        @else
                            <a href="{{ route('login') }}">
                                <span class="material-symbols-outlined text-primary">person</span>
                            </a>
                        @endauth
                   </button>
                </div>
            </div>
        </nav>
    </header>
    <main class="pt-[104px]">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200">
        <div
            class="grid grid-cols-1 md:grid-cols-4 gap-12 px-12 py-16 max-w-7xl mx-auto font-['Be_Vietnam_Pro'] text-sm">
            <div class="col-span-1 md:col-span-1">
                <div class="text-xl font-black text-blue-700 mb-6">X-MEN</div>
                <p class="text-slate-500 leading-relaxed mb-6">Xmen là thương hiệu nước hoa và mỹ phẩm dành cho phái
                    mạnh hàng đầu Việt Nam, mang đến giải pháp chăm sóc toàn diện cho nam giới hiện đại.</p>
                <div class="flex gap-4">
                    <a class="h-10 w-10 bg-white shadow-sm flex items-center justify-center rounded-full hover:text-blue-600 transition-colors"
                        href="#"><span class="material-symbols-outlined">social_leaderboard</span></a>
                    <a class="h-10 w-10 bg-white shadow-sm flex items-center justify-center rounded-full hover:text-blue-600 transition-colors"
                        href="#"><span class="material-symbols-outlined">video_library</span></a>
                    <a class="h-10 w-10 bg-white shadow-sm flex items-center justify-center rounded-full hover:text-blue-600 transition-colors"
                        href="#"><span class="material-symbols-outlined">photo_camera</span></a>
                </div>
            </div>
            <div>
                <h6 class="font-bold text-slate-800 mb-6 text-base uppercase tracking-wider">Hỗ trợ khách hàng</h6>
                <ul class="space-y-4">
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Privacy Policy</a>
                    </li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Terms of Service</a>
                    </li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Shipping &amp;
                            Returns</a></li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Contact Us</a></li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Store Locator</a>
                    </li>
                </ul>
            </div>
            <div>
                <h6 class="font-bold text-slate-800 mb-6 text-base uppercase tracking-wider">Bộ sưu tập</h6>
                <ul class="space-y-4">
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Xmen Boss</a></li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Xmen Sport</a></li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Xmen Clean &amp;
                            Fresh</a></li>
                    <li><a class="text-slate-500 hover:text-orange-500 transition-colors" href="#">Limited Editions</a>
                    </li>
                </ul>
            </div>
            <div>
                <h6 class="font-bold text-slate-800 mb-6 text-base uppercase tracking-wider">Bản tin</h6>
                <p class="text-slate-500 mb-6">Đăng ký nhận tin để không bỏ lỡ những ưu đãi đặc quyền.</p>
                <div class="relative">
                    <input
                        class="w-full bg-white border-none rounded-xl py-4 px-6 focus:ring-2 focus:ring-primary/20 outline-none"
                        placeholder="Email của bạn" type="email" />
                    <button
                        class="absolute right-2 top-2 bottom-2 bg-primary text-white px-4 rounded-lg font-bold">Gửi</button>
                </div>
            </div>
        </div>
        <div
            class="border-t border-slate-100 py-8 px-12 max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-slate-400 text-xs">© 2024 X-MEN KINETIC VITALITY. ALL RIGHTS RESERVED.</p>
            <div class="flex gap-6">
                <img class="h-4 grayscale hover:grayscale-0 transition-all opacity-50 hover:opacity-100"
                    data-alt="Visa payment method logo"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXajaRFb6t43Odjr_wuPOaIBUFumPefV0Vfl7b5yGz55pa3AKCwsVJafuUyagTz3CV-UuZvBlqsxfGqMfSjBXoiK5FRd4hwHUNiz9MSTNzV45jVez9LzTEn5Dk0b6jDIgF3FwRNsCwDO-Kcs0ADG15CvN2X1ZChNyVYdjI0fDbK1ZiWVWNqc4dI6ohEbAMcPCerjc38rgeZp3z6mKkr2uG4SOBYuashs4cmxHvgLaVTv4CGY-dzG86Ex3-9z1zWNkbi9Qml7fWD7r0" />
                <img class="h-4 grayscale hover:grayscale-0 transition-all opacity-50 hover:opacity-100"
                    data-alt="Mastercard payment method logo"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJ47wJBhYwG_VjJv3-Qij-rp46UjzFlj_37EKRf9TT4qMS5Vdg6LexOahjCIgl5imQ2GLUXpvcZUdjSjy2q_9OwSKzViom8lCJN0JahOvbRVo7KpaDPL25YQxn6W1z68Vbhh-MIohjsfhYWcYQ1kBmXmymM58_m2J96SAa2l5XuYmDM_D2iRztNjP7AG-0hGyCF0kJlxkMtT2j9Sg3HrTIUAPXWVPpnmCaI3iCijATqDkaBN-8oRiSi3tF3Hi5rpfjkR4bWdVQS_3Y" />
            </div>
        </div>
    </footer>
    </footer>

    @if(isset($unnotifiedCancelledOrders) && $unnotifiedCancelledOrders->count() > 0)
    <!-- Cancellation Notification Modal -->
    <div id="cancellation-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-300">
        <div class="bg-white w-full max-w-lg rounded-[2rem] shadow-2xl overflow-hidden animate-in zoom-in-95 slide-in-from-bottom-8 duration-500">
            <div class="relative h-32 bg-gradient-to-br from-red-500 to-rose-600 flex items-center justify-center">
                <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
                <span class="material-symbols-outlined text-white text-6xl drop-shadow-lg">report_problem</span>
            </div>
            
            <div class="p-8 text-center">
                <h3 class="text-2xl font-black text-slate-800 mb-2 font-headline">Thông báo hủy đơn hàng</h3>
                <p class="text-slate-500 text-sm mb-6">Chúng tôi rất tiếc phải thông báo rằng đơn hàng của bạn đã bị hủy.</p>
                
                <div class="space-y-4 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($unnotifiedCancelledOrders as $order)
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 text-left relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-red-500">#ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="text-[10px] text-slate-400 font-bold">{{ $order->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <p class="text-slate-700 text-sm font-bold mb-1">Lý do hủy:</p>
                        <p class="text-slate-600 text-sm italic leading-relaxed font-medium">"{{ $order->cancel_reason ?? 'Không có lý do cụ thể' }}"</p>
                        <div class="absolute right-0 bottom-0 w-24 h-24 bg-red-500/5 rounded-full -mr-12 -mb-12 group-hover:scale-150 transition-transform duration-700"></div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8 flex flex-col gap-3">
                    <button id="close-cancellation-modal" class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg active:scale-95">
                        Tôi đã hiểu
                    </button>
                    <a href="{{ route('lichsu') }}" class="text-slate-400 hover:text-primary text-xs font-bold transition-colors">Xem chi tiết trong lịch sử</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('close-cancellation-modal').addEventListener('click', function() {
            const modal = document.getElementById('cancellation-modal');
            modal.classList.add('fade-out');
            
            // Mark all shown orders as notified
            const orderIds = [@foreach($unnotifiedCancelledOrders as $order) {{ $order->order_id }}, @endforeach];
            
            Promise.all(orderIds.map(id => {
                return fetch(`/don-hang/${id}/mark-notified`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });
            })).then(() => {
                setTimeout(() => modal.remove(), 300);
            });
        });
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .fade-out { opacity: 0; transition: opacity 0.3s ease; }
    </style>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('header-search-input');
            const searchResults = document.getElementById('header-search-results');
            const searchList = document.getElementById('header-search-list');
            let timeout = null;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    const query = this.value.trim();

                    if (query.length < 2) {
                        searchResults.classList.add('hidden');
                        return;
                    }

                    timeout = setTimeout(() => {
                        fetch(`{{ route('search.suggest') }}?search=${encodeURIComponent(query)}`)
                            .then(res => res.json())
                            .then(data => {
                                searchList.innerHTML = '';
                                if (data.length > 0) {
                                    data.forEach(item => {
                                        const el = document.createElement('a');
                                        el.href = item.url;
                                        el.className = 'flex items-center gap-3 p-3 hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0';
                                        el.innerHTML = `
                                            <img src="${item.img_url}" class="w-10 h-10 object-cover rounded-lg">
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-sm font-bold text-slate-800 truncate">${item.name}</h4>
                                                <p class="text-xs font-semibold text-primary mt-0.5">${item.formatted_price}</p>
                                            </div>
                                        `;
                                        searchList.appendChild(el);
                                    });
                                    searchResults.classList.remove('hidden');
                                } else {
                                    searchList.innerHTML = `<div class="p-4 text-center text-sm text-slate-500">Không tìm thấy sản phẩm</div>`;
                                    searchResults.classList.remove('hidden');
                                }
                            });
                    }, 300);
                });

                // Hide when clicking outside
                document.addEventListener('click', function(e) {
                    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>

</html>