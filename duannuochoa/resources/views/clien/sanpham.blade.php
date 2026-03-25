@extends('layouts.app')
@section('content')

    <main class="pt-32 pb-20 px-6 md:px-12 max-w-screen-2xl mx-auto">
        <!-- Hero Header -->
        <header class="mb-16">
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-primary mb-4">DÒNG SẢN
                PHẨM</h1>
            <p class="text-on-surface-variant max-w-2xl text-lg font-medium">Khám phá sức mạnh lôi cuốn với bộ sưu tập
                mùi hương được thiết kế riêng cho nam giới hiện đại. Năng động, mạnh mẽ và tràn đầy sức sống.</p>
        </header>
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filter -->
            <aside class="w-full lg:w-72 flex-shrink-0 space-y-10">
                <!-- Scent Types -->
                <section>
                    <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-tertiary rounded-full"></span>
                        Mùi Hương
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input
                                class="w-6 h-6 rounded-md border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low transition-all"
                                type="checkbox" />
                            <span class="text-on-surface font-medium group-hover:text-primary transition-colors">Woody
                                (Gỗ)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input checked=""
                                class="w-6 h-6 rounded-md border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low transition-all"
                                type="checkbox" />
                            <span class="text-on-surface font-medium group-hover:text-primary transition-colors">Citrus
                                (Cam chanh)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input
                                class="w-6 h-6 rounded-md border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low transition-all"
                                type="checkbox" />
                            <span class="text-on-surface font-medium group-hover:text-primary transition-colors">Spicy
                                (Gia vị)</span>
                        </label>
                    </div>
                </section>
                <!-- Price Range -->
                <section>
                    <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                        Khoảng Giá
                    </h3>
                    <div class="px-2">
                        <input
                            class="w-full h-2 bg-surface-container-high rounded-full appearance-none cursor-pointer accent-primary"
                            max="1000000" min="0" step="50000" type="range" />
                        <div class="flex justify-between mt-4 text-sm font-semibold text-on-surface-variant">
                            <span>0đ</span>
                            <span>1.000.000đ+</span>
                        </div>
                    </div>
                </section>
                <!-- Brand -->
                <section>
                    <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-secondary rounded-full"></span>
                        Thương Hiệu
                    </h3>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input checked=""
                                class="w-6 h-6 border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low"
                                name="brand" type="radio" />
                            <span class="text-on-surface font-medium">X-Men Original</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input
                                class="w-6 h-6 border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low"
                                name="brand" type="radio" />
                            <span class="text-on-surface font-medium">X-Men For Boss</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input
                                class="w-6 h-6 border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low"
                                name="brand" type="radio" />
                            <span class="text-on-surface font-medium">X-Men Go</span>
                        </label>
                    </div>
                </section>
            </aside>
            <!-- Main Listing Area -->
            <div class="flex-grow">
                <!-- Sorting & Stats -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
                    <p class="text-on-surface-variant font-medium">Hiển thị <span class="text-primary font-bold">12</span>
                        sản phẩm</p>
                    <div class="flex items-center gap-4 bg-surface-container-low p-2 rounded-xl">
                        <span class="text-sm font-bold text-on-surface ml-2">Sắp xếp:</span>
                        <select
                            class="bg-transparent border-none focus:ring-0 text-sm font-semibold text-primary cursor-pointer pr-8">
                            <option>Mới Nhất</option>
                            <option>Giá: Thấp đến Cao</option>
                            <option>Phổ Biến Nhất</option>
                        </select>
                    </div>
                </div>
                <!-- Product Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div
                        class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                data-alt="Premium sleek dark cologne bottle on a reflective black marble surface with dramatic blue accent lighting"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkBlwwb4GvFydwdnYbaXQn5LSwC8DhUg0CEFnGjYGm7nUhA706lrCQ1y-KruOhv3fRj84QDXrYM6JTFsf09N5Iju5SiLFCaSdXWUfUEcagCMw5freUSsJ957fl4qhFy722Gn-3DEZ7uTYf49l2mZyllWzWmItwUliPteFAqfKmGc2od_6SUKf9aKTfCHJJuBvLnvvE9XsXcbiVhA_znNGnxmjVdh34TAkrym2gbsIOP_4PGqlx1FDedIDEiYNUD6eWL15WHupSV988" />
                            <!-- Overlay Actions -->
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                <button
                                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                    Thêm vào giỏ
                                </button>
                                <button
                                    class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 shadow-lg">
                                    Xem chi tiết
                                </button>
                            </div>
                            <!-- Badges -->
                            <div
                                class="absolute top-4 left-4 bg-tertiary text-on-tertiary px-4 py-1 rounded-full text-xs font-black tracking-widest uppercase">
                                New</div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 0;">star</span>
                                <span class="text-xs text-on-surface-variant font-bold ml-1">(4.8)</span>
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight">X-Men Fire -
                                Năng Lượng Cháy Bỏng</h3>
                            <p class="text-primary font-black text-2xl tracking-tight">185.000đ</p>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div
                        class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                data-alt="Minimalist perfume bottle in clear glass with silver cap on a clean light blue background with soft shadows"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4BoZID2pbX9wbwVk8j8TiVXGQ5QwKO2TSExSR-05GNSRDu8W3YDm_07K6bqu2oCoclRBRXwWgVF5pESALjPgwdFvk8j2bYSjY14n4co0zGcPWNkdRkHXhkiLqxCn89pTuIl3TxePhUcLzSX9eOwtFNrx35NOUvudkEHhP_BKEID7sIhfdBjh9TZT077vFRZa7nOXBEt0HM25fJULNKAz5TAKI9SkGHM-K9VfBCkGSlzm5FEaEs1cLKW_p30Dm5irYMWGzvMSRFqkN" />
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                <button
                                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                    Thêm vào giỏ
                                </button>
                                <button
                                    class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 shadow-lg">
                                    Xem chi tiết
                                </button>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs text-on-surface-variant font-bold ml-1">(5.0)</span>
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight">X-Men For
                                Boss Luxury</h3>
                            <p class="text-primary font-black text-2xl tracking-tight">420.000đ</p>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div
                        class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                data-alt="Modern geometric perfume bottle with orange citrus slices and fresh mint leaves in a bright high-key lighting setup"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCmGcU6mBbwwtnnMRA4Hej8KuQymxGFASR_K7kFTLAAGUukU7oLCom-uSYLUtAKF4u-IbcdBCyoz-UY0DtxmBJCUdW8m_40Z_xYH_i1LGKZFqE7sBDrGD3-pDuXDVlAeLhYhaC9r2sCDR7iuZwlAU2g6HcsieAwXJ7F_jB7LCJedP0zPq-Pwuo3UMxUjAdNGuqZq4dgaNRMzCMMiecMurePNbdH1Z0RUfQF6NnDcnRqn36AOYQtxb_Pc9e53YPRN9D5Lvuzf0twLx8Z" />
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                <button
                                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                    Thêm vào giỏ
                                </button>
                                <button
                                    class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 shadow-lg">
                                    Xem chi tiết
                                </button>
                            </div>
                            <div
                                class="absolute top-4 right-4 bg-error-container text-on-error-container px-3 py-1 rounded-lg text-xs font-black">
                                -15%</div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 0.5;">star</span>
                                <span class="text-xs text-on-surface-variant font-bold ml-1">(4.5)</span>
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight">X-Men Go -
                                Citrus Fresh</h3>
                            <div class="flex items-end gap-3">
                                <p class="text-primary font-black text-2xl tracking-tight">165.000đ</p>
                                <p class="text-outline-variant line-through text-sm mb-1">195.000đ</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for more cards with same high-end layout -->
                    <div
                        class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                data-alt="Sleek silver metal spray bottle in a frosty cold environment with ice crystals and cool blue backlighting"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHoqor0_06lzPnRPadNAazzKVVM2QRdUZkn5-vzj6NvzbAxVHWoK3puKlPKOCQ2tCjGJobQd_HYPglEzm6tcOXyP4ZuzOVD0d4bOnpvBn_B_vGS0TDfTpuKAvXfKkwX3Ny1OfVa6xEuDJ9rWsJz6Jkkkvi8ALA2pQ0tlK3oluaDVq16BD--Dn76YM4d0RQrWUvDXL1IWUFDugXwf8m6JJXsk8pfkfW7WyPfYo5R9KTbqNTzhtpxmMhFafBPZhNASBtTqyQSA8oWq6s" />
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                <button
                                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                    Thêm vào giỏ
                                </button>
                                <button
                                    class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 shadow-lg">
                                    Xem chi tiết
                                </button>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm"
                                    style="font-variation-settings: 'FILL' 0;">star</span>
                                <span class="text-xs text-on-surface-variant font-bold ml-1">(4.0)</span>
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight">X-Men Cool -
                                Băng Lạnh</h3>
                            <p class="text-primary font-black text-2xl tracking-tight">145.000đ</p>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="mt-20 flex justify-center items-center gap-4">
                    <button
                        class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-on-surface-variant hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                    </button>
                    <button
                        class="w-12 h-12 rounded-xl bg-primary text-on-primary font-bold flex items-center justify-center shadow-lg shadow-primary/20">1</button>
                    <button
                        class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-on-surface-variant hover:border-primary hover:text-primary transition-all font-bold">2</button>
                    <button
                        class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-on-surface-variant hover:border-primary hover:text-primary transition-all font-bold">3</button>
                    <button
                        class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-on-surface-variant hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
@endsection