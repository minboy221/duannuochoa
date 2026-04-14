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
                            <span>1,000,000đ+</span>
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
                    @forelse($products as $product)
                    <div
                        class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2">
                        <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                            <!-- Overlay Actions -->
                            <div
                                class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                <button
                                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                    Thêm vào giỏ
                                </button>
                                <a href="{{ route('xemchitiet', $product) }}"
                                    class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 delay-75 shadow-lg">
                                    Xem chi tiết
                                </a>
                            </div>
                            <!-- Badges -->
                            @if($product->is_featured)
                            <div
                                class="absolute top-4 left-4 bg-tertiary text-on-tertiary px-4 py-1 rounded-full text-xs font-black tracking-widest uppercase">
                                Popular</div>
                            @endif
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-xs text-on-surface-variant font-bold ml-1">(5.0)</span>
                            </div>
                            <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight">{{ $product->name }}</h3>
                            <p class="text-primary font-black text-2xl tracking-tight">{{ number_format($product->base_price) }}đ</p>
                        </div>
                    </div>
                    @empty
                        <p class="col-span-1 md:col-span-3 text-center py-8 text-outline">Chưa có sản phẩm nào.</p>
                    @endforelse
                </div>
                <!-- Pagination -->
                <div class="mt-20 flex justify-center items-center gap-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
@endsection