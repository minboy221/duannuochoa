@extends('layouts.app')
@section('content')

    <main class="pt-32 pb-20 px-6 md:px-12 max-w-screen-2xl mx-auto">
        <!-- Hero Header -->
        <header class="mb-16">
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-primary mb-4 uppercase">Dòng Sản Phẩm</h1>
            <p class="text-on-surface-variant max-w-2xl text-lg font-medium">Khám phá sức mạnh lôi cuốn với bộ sưu tập mùi hương được thiết kế riêng cho nam giới hiện đại. Năng động, mạnh mẽ và tràn đầy sức sống.</p>
        </header>

        <form action="{{ route('sanpham') }}" method="GET" id="filter-form">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Sidebar Filter -->
                <aside class="w-full lg:w-72 flex-shrink-0 space-y-10">
                    <!-- Scent Types (Categories) -->
                    <section>
                        <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-tertiary rounded-full"></span>
                            Mùi Hương
                        </h3>
                        <div class="space-y-3">
                            @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input
                                    class="w-6 h-6 rounded-md border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low transition-all"
                                    type="checkbox" name="category[]" value="{{ $category->category_id }}" 
                                    {{ in_array($category->category_id, (array)request('category')) ? 'checked' : '' }}
                                    onchange="this.form.submit()" />
                                <span class="text-on-surface font-medium group-hover:text-primary transition-colors">{{ $category->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </section>

                    <!-- Price Range -->
                    <section>
                        <h3 class="font-headline text-xl font-bold mb-6 flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-primary rounded-full"></span>
                            Khoảng Giá (Dưới)
                        </h3>
                        <div class="px-2">
                            <input
                                class="w-full h-2 bg-surface-container-high rounded-full appearance-none cursor-pointer accent-primary"
                                name="max_price" max="2000000" min="0" step="50000" type="range" 
                                value="{{ request('max_price', 2000000) }}"
                                onchange="this.form.submit()" />
                            <div class="flex justify-between mt-4 text-sm font-semibold text-on-surface-variant">
                                <span>0đ</span>
                                <span id="price-display">{{ number_format(request('max_price', 2000000)) }}đ</span>
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
                                <input class="w-6 h-6 border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low"
                                    name="brand" type="radio" value="" {{ !request('brand') ? 'checked' : '' }} onchange="this.form.submit()" />
                                <span class="text-on-surface font-medium">Tất cả thương hiệu</span>
                            </label>
                            @foreach($brands as $brand)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input
                                    class="w-6 h-6 border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-low"
                                    name="brand" type="radio" value="{{ $brand->brand_id }}" 
                                    {{ request('brand') == $brand->brand_id ? 'checked' : '' }}
                                    onchange="this.form.submit()" />
                                <span class="text-on-surface font-medium">{{ $brand->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </section>
                    
                    @if(request()->anyFilled(['category', 'brand', 'max_price']))
                    <a href="{{ route('sanpham') }}" class="inline-flex items-center gap-2 text-sm font-bold text-error hover:underline transition-all">
                        <span class="material-symbols-outlined text-sm">close</span>
                        Xóa tất cả bộ lọc
                    </a>
                    @endif
                </aside>

                <!-- Main Listing Area -->
                <div class="flex-grow">
                    <!-- Sorting & Stats -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-10 gap-4">
                        <p class="text-on-surface-variant font-medium">Hiển thị <span class="text-primary font-bold">{{ $products->total() }}</span> sản phẩm</p>
                        <div class="flex items-center gap-4 bg-surface-container-low p-2 rounded-xl">
                            <span class="text-sm font-bold text-on-surface ml-2">Sắp xếp:</span>
                            <select name="sort" onchange="this.form.submit()"
                                class="bg-transparent border-none focus:ring-0 text-sm font-semibold text-primary cursor-pointer pr-8">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới Nhất</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ Biến Nhất</option>
                            </select>
                        </div>
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                        @forelse($products as $product)
                        @php 
                            $isOOS = $product->isOutOfStock(); 
                            $isStopped = $product->status == 0;
                            $isDisabled = $isOOS || $isStopped;
                        @endphp
                        <div
                            class="group relative bg-surface-container-lowest rounded-lg overflow-hidden transition-all duration-500 {{ $isDisabled ? 'opacity-70' : 'hover:shadow-2xl hover:shadow-primary/10 hover:-translate-y-2' }}">
                            <div class="aspect-[4/5] bg-surface-container-low relative overflow-hidden">
                                <img class="w-full h-full object-cover transition-transform duration-700 {{ $isDisabled ? 'grayscale' : 'group-hover:scale-110' }}"
                                    src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                                <!-- Overlay Actions -->
                                <div
                                    class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center gap-4 backdrop-blur-[2px]">
                                    @if(!$isDisabled)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        @if($product->variants->isNotEmpty())
                                            <input type="hidden" name="variant_id" value="{{ $product->variants->first()->variant_id }}">
                                        @endif
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 shadow-xl">
                                            Thêm vào giỏ
                                        </button>
                                    </form>
                                    @endif
                                    <a href="{{ $isStopped ? 'javascript:void(0)' : route('xemchitiet', $product->product_id) }}"
                                        class="bg-surface-container-lowest text-primary px-8 py-3 rounded-xl font-bold translate-y-8 group-hover:translate-y-0 transition-transform duration-500 {{ $isDisabled ? '' : 'delay-75' }} shadow-lg {{ $isStopped ? 'cursor-not-allowed opacity-50' : '' }}">
                                        {{ $isStopped ? 'Tạm ngưng' : 'Xem chi tiết' }}
                                    </a>
                                </div>
                                <!-- Badges -->
                                @if($isStopped)
                                <div
                                    class="absolute top-4 left-4 bg-surface-variant text-on-surface-variant px-4 py-1 rounded-full text-xs font-black tracking-widest uppercase shadow-lg">
                                    Tạm ngưng</div>
                                @elseif($isOOS)
                                <div
                                    class="absolute top-4 left-4 bg-error text-on-error px-4 py-1 rounded-full text-xs font-black tracking-widest uppercase shadow-lg">
                                    Hết hàng</div>
                                @elseif($product->is_featured)
                                <div
                                    class="absolute top-4 left-4 bg-tertiary text-on-tertiary px-4 py-1 rounded-full text-xs font-black tracking-widest uppercase">
                                    Popular</div>
                                @endif
                            </div>
                            <div class="p-8">
                                <div class="flex items-center gap-1 mb-3 text-tertiary-fixed-dim">
                                    @php $rating = $product->averageRating(); @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= round($rating) ? 1 : 0 }};">star</span>
                                    @endfor
                                    <span class="text-xs text-on-surface-variant font-bold ml-1">({{ number_format($rating, 1) }})</span>
                                </div>
                                <h3 class="font-headline text-xl font-bold text-on-surface mb-2 leading-tight {{ $isDisabled ? 'text-on-surface-variant' : '' }}">{{ $product->name }}</h3>
                                <p class="text-primary font-black text-2xl tracking-tight {{ $isDisabled ? 'opacity-50' : '' }}">{{ number_format($product->base_price) }}đ</p>
                            </div>
                        </div>
                        @empty
                            <div class="col-span-full py-20 text-center bg-surface-container-low rounded-3xl border-2 border-dashed border-outline-variant/30">
                                <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">search_off</span>
                                <h4 class="text-xl font-bold text-outline">Không tìm thấy sản phẩm nào</h4>
                                <p class="text-on-surface-variant mt-2">Vui lòng thử điều chỉnh bộ lọc hoặc tìm kiếm theo tiêu chí khác.</p>
                                <a href="{{ route('sanpham') }}" class="inline-block mt-8 bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg shadow-primary/20">Xem tất cả sản phẩm</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-20 flex justify-center items-center gap-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </form>
    </main>

    <script>
        // Update price display dynamically
        const priceRange = document.querySelector('input[name="max_price"]');
        const priceDisplay = document.getElementById('price-display');
        if (priceRange) {
            priceRange.addEventListener('input', (e) => {
                priceDisplay.textContent = new Intl.NumberFormat('vi-VN').format(e.target.value) + 'đ';
            });
        }
    </script>
@endsection