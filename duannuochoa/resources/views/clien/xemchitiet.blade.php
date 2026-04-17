@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 max-w-7xl mx-auto px-6 lg:px-12">
        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Image Gallery (Asymmetric Layout) -->
            <div class="lg:col-span-5 grid grid-cols-1 gap-4">
                <div class="col-span-1 aspect-square rounded-2xl overflow-hidden bg-surface-container-lowest shadow-sm group p-8 flex items-center justify-center">
                    <img alt="{{ $product->name }}"
                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-700"
                        src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
            <div class="lg:col-span-7 grid grid-cols-2 gap-4">
                <div class="col-span-2 aspect-[4/5] rounded-lg overflow-hidden bg-surface-container-low group">
                    <img id="main-product-image" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" 
                        data-default-src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                </div>
                
                <!-- Thumbnails -->
                <div class="col-span-2 flex gap-4 overflow-x-auto py-2 px-1 scrollbar-hide">
                    @php $defaultImg = $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80'; @endphp
                    <!-- Main Product Image Thumbnail -->
                    <button type="button" class="thumbnail-btn w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden border-2 border-primary" 
                            onclick="selectThumbnail(this, '{{ $defaultImg }}')">
                        <img src="{{ $defaultImg }}" class="w-full h-full object-cover" alt="Main image">
                    </button>
                    
                    <!-- Variant Images Thumbnails -->
                    @foreach($product->variants as $variant)
                        @if($variant->image)
                            <button type="button" class="thumbnail-btn w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary-container transition-all" 
                                    data-variant-id="{{ $variant->variant_id }}"
                                    onclick="selectThumbnail(this, '{{ asset('storage/' . $variant->image) }}')">
                                <img src="{{ asset('storage/' . $variant->image) }}" class="w-full h-full object-cover" alt="Variant image">
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
            <!-- Content Info -->
            <div class="lg:col-span-7 sticky top-32 space-y-8 pl-0 lg:pl-12">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        @if($product->is_featured)
                        <span class="bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Nổi bật</span>
                        @endif
                        <div class="flex text-tertiary">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $averageRating ? 1 : 0 }};">star</span>
                            @endfor
                            <span class="ml-2 text-on-surface-variant text-sm font-medium">({{ $reviewsCount }} đánh giá)</span>
                        </div>
                    </div>
                    <h1 class="text-5xl font-extrabold text-primary tracking-tight leading-tight">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-primary" id="display-price">
                        {{ number_format($product->base_price) }}đ
                    </p>
                </div>

                <p class="text-on-surface-variant leading-relaxed text-lg">
                    {!! nl2br(e($product->description ?? 'Đánh thức năng lượng bứt phá với sản phẩm này.')) !!}
                </p>

                <!-- Options -->
                <div class="space-y-4">
                    <h3 class="font-bold text-sm uppercase tracking-widest text-on-surface-variant flex justify-between">
                        <span>Dung tích</span>
                        <span id="display-stock" class="text-primary normal-case">Tồn kho: {{ $product->variants->sum('stock_quantity') }}</span>
                    </h3>
                    <div class="flex flex-wrap gap-4">
                        @forelse($product->variants as $variant)
                        <button
                            type="button"
                            class="variant-btn py-3 px-6 rounded-xl border-2 transition-all font-bold flex items-center gap-2
                            {{ $loop->first ? 'border-primary bg-primary-container/10 text-primary' : 'border-transparent bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest' }}"
                            data-variant-id="{{ $variant->variant_id }}"
                            data-price="{{ number_format($variant->price) }}đ"
                            data-stock="{{ $variant->stock_quantity }}"
                            data-image="{{ $variant->image ? asset('storage/' . $variant->image) : '' }}"
                            data-variant-id="{{ $variant->variant_id }}"
                            onclick="selectVariant(this)">
                            {{ $variant->volume_id }}ml
                            @if($variant->color_code)
                                <span class="w-4 h-4 rounded-full border border-gray-300 inline-block" style="background-color: {{ $variant->color_code }};" title="{{ $variant->color }}"></span>
                            @endif
                        </button>
                        @empty
                        <p class="text-sm text-outline">Sản phẩm này hiện chưa có biến thể dung tích.</p>
                        @endforelse
                    </div>
                </div>

                <script>
                    function selectVariant(element, syncThumbnail = true) {
                        // Reset all buttons
                        document.querySelectorAll('.variant-btn').forEach(btn => {
                            btn.classList.remove('border-primary', 'bg-primary-container/10', 'text-primary');
                            btn.classList.add('border-transparent', 'bg-surface-container-high', 'text-on-surface-variant');
                        });

                        // Highlight selected button
                        element.classList.remove('border-transparent', 'bg-surface-container-high', 'text-on-surface-variant');
                        element.classList.add('border-primary', 'bg-primary-container/10', 'text-primary');

                        // Update price and stock
                        document.getElementById('display-price').innerText = element.getAttribute('data-price');
                        document.getElementById('display-stock').innerText = 'Tồn kho: ' + element.getAttribute('data-stock');
                        
                        // Update variant ID for form submission
                        const variantInput = document.getElementById('selected-variant-id');
                        if (variantInput) {
                            variantInput.value = element.getAttribute('data-variant-id');
                        }

                        // Update main image and thumbnail
                        if (syncThumbnail) {
                            const mainImage = document.getElementById('main-product-image');
                            const variantImage = element.getAttribute('data-image');
                            
                            // Try to find the thumbnail for this variant to highlight it
                            const variantId = element.getAttribute('data-variant-id');
                            const thumbnail = document.querySelector(`.thumbnail-btn[data-variant-id="${variantId}"]`);
                            
                            document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                                btn.classList.remove('border-primary');
                                btn.classList.add('border-transparent');
                            });
                            
                            if (thumbnail) {
                                thumbnail.classList.remove('border-transparent');
                                thumbnail.classList.add('border-primary');
                                mainImage.src = variantImage;
                            } else {
                                // Default thumbnail logic if this variant doesn't have a specific image
                                const defaultThumb = document.querySelector('.thumbnail-btn:not([data-variant-id])');
                                if (defaultThumb) {
                                    defaultThumb.classList.remove('border-transparent');
                                    defaultThumb.classList.add('border-primary');
                                }
                                mainImage.src = variantImage ? variantImage : mainImage.getAttribute('data-default-src');
                            }
                        }
                    }

                    function selectThumbnail(element, src) {
                        // Update main image
                        const mainImage = document.getElementById('main-product-image');
                        mainImage.src = src;

                        // Update border
                        document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                            btn.classList.remove('border-primary');
                            btn.classList.add('border-transparent');
                        });
                        element.classList.remove('border-transparent');
                        element.classList.add('border-primary');

                        // Check if thumbnail belongs to a variant
                        const variantId = element.getAttribute('data-variant-id');
                        if (variantId) {
                            // Find the correspond variant button and click it to sync price/stock (passing false to avoid syncing thumb again)
                            const variantBtn = document.querySelector(`.variant-btn[data-variant-id="${variantId}"]`);
                            if (variantBtn && !variantBtn.classList.contains('border-primary')) {
                                selectVariant(variantBtn, false); 
                            }
                        }
                        // Update hidden variant_id input
                        const variantInput = document.querySelector('input[name="variant_id"]');
                        if (variantInput) {
                            variantInput.value = element.getAttribute('data-variant-id');
                        }
                    }

                    // Initial price/stock if variants exist
                    window.addEventListener('DOMContentLoaded', (event) => {
                        const firstVariant = document.querySelector('.variant-btn');
                        if (firstVariant) {
                            firstVariant.click();
                        }
                    });
                </script>

                <!-- Actions -->
                <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col gap-4 pt-4">
                    @csrf
                    @if($product->variants->first())
                        <input type="hidden" name="variant_id" id="selected-variant-id" value="{{ $product->variants->first()->variant_id }}">
                    @endif
                    <input type="hidden" name="quantity" value="1">
                    
                    <button type="submit"
                        class="w-full py-4 rounded-xl bg-surface-container-highest text-primary font-bold text-lg hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" data-icon="add_shopping_cart">add_shopping_cart</span>
                        Thêm vào giỏ hàng
                    </button>
                </form>
                <div
                    class="flex justify-between items-center py-4 border-t border-surface-container-high text-sm text-on-surface-variant">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg" data-icon="local_shipping">local_shipping</span>
                        Miễn phí giao hàng toàn quốc
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg" data-icon="verified">verified</span>
                        Chính hãng 100%
                    </div>
                </div>
            </div>
        </div>
        <!-- Reviews Section -->
        <section class="mt-32 space-y-12 border-t border-surface-container pt-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Review Summary & Form -->
                <div class="lg:col-span-4 space-y-10">
                    <div class="space-y-4">
                        <h2 class="text-3xl font-black text-on-surface tracking-tight">Đánh Giá Sản Phẩm</h2>
                        <div class="flex items-center gap-4">
                            <div class="text-6xl font-black text-primary">{{ number_format($averageRating, 1) }}</div>
                            <div class="space-y-1">
                                <div class="flex text-tertiary">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= floor($averageRating) ? 1 : ($i - $averageRating < 1 ? 1 : 0) }};">{{ $i <= ceil($averageRating) && $i - $averageRating > 0 && $i - $averageRating < 1 ? 'star_half' : 'star' }}</span>
                                    @endfor
                                </div>
                                <p class="text-sm font-medium text-on-surface-variant">Dựa trên {{ $reviewsCount }} nhận xét</p>
                            </div>
                        </div>
                    </div>
                    <!-- Write a Review Form -->
                    @if($canReview)
                    <div class="bg-surface-container-low p-8 rounded-lg shadow-sm space-y-6">
                        <h3 class="text-xl font-bold text-on-surface">Viết đánh giá của bạn</h3>
                        <form action="{{ route('review.store') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider">Đánh
                                    giá của bạn</label>
                                <div class="flex flex-row-reverse justify-end gap-1">
                                    <input class="hidden rating-star-input" id="star5" name="rating" type="radio"
                                        value="5" />
                                    <label
                                        class="material-symbols-outlined cursor-pointer text-surface-dim hover:text-tertiary transition-colors"
                                        for="star5" style="font-variation-settings: 'FILL' 1;">star</label>
                                    <input class="hidden rating-star-input" id="star4" name="rating" type="radio"
                                        value="4" />
                                    <label
                                        class="material-symbols-outlined cursor-pointer text-surface-dim hover:text-tertiary transition-colors"
                                        for="star4" style="font-variation-settings: 'FILL' 1;">star</label>
                                    <input class="hidden rating-star-input" id="star3" name="rating" type="radio"
                                        value="3" />
                                    <label
                                        class="material-symbols-outlined cursor-pointer text-surface-dim hover:text-tertiary transition-colors"
                                        for="star3" style="font-variation-settings: 'FILL' 1;">star</label>
                                    <input class="hidden rating-star-input" id="star2" name="rating" type="radio"
                                        value="2" />
                                    <label
                                        class="material-symbols-outlined cursor-pointer text-surface-dim hover:text-tertiary transition-colors"
                                        for="star2" style="font-variation-settings: 'FILL' 1;">star</label>
                                    <input class="hidden rating-star-input" id="star1" name="rating" type="radio"
                                        value="1" />
                                    <label
                                        class="material-symbols-outlined cursor-pointer text-surface-dim hover:text-tertiary transition-colors"
                                        for="star1" style="font-variation-settings: 'FILL' 1;">star</label>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider">Họ và
                                    tên</label>
                                <input
                                    class="w-full bg-white border border-surface-container-high rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none opacity-50"
                                    value="{{ Auth::user()->full_name }}" readonly type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider">Nhận
                                    xét</label>
                                <textarea name="content"
                                    class="w-full bg-white border border-surface-container-high rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none resize-none"
                                    placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm..." rows="4" required></textarea>
                            </div>
                            <button
                                class="w-full py-4 rounded-xl bg-primary text-on-primary font-bold hover:bg-primary-dim transition-all shadow-lg shadow-primary/10"
                                type="submit">
                                Gửi đánh giá
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="bg-surface-container-low p-8 rounded-lg shadow-sm text-center space-y-4">
                        <div class="flex justify-center">
                            <span class="material-symbols-outlined text-5xl text-outline-variant">rate_review</span>
                        </div>
                        <h3 class="text-xl font-bold text-on-surface">Bạn muốn đánh giá sản phẩm?</h3>
                        <p class="text-on-surface-variant">Bạn chỉ có thể để lại đánh giá sau khi đã mua và nhận được sản phẩm này.</p>
                        @guest
                        <a href="{{ route('login') }}" class="inline-block py-3 px-8 rounded-xl bg-primary text-on-primary font-bold">Đăng nhập ngay</a>
                        @endguest
                    </div>
                    @endif
                </div>
                <!-- Review List -->
                <div class="lg:col-span-8 space-y-8">
                    <div class="flex items-center justify-between border-b border-surface-container pb-4">
                        <h3 class="font-bold text-lg">Tất cả nhận xét ({{ $reviewsCount }})</h3>
                        <div class="flex items-center gap-2 text-sm font-medium text-on-surface-variant">
                            Sắp xếp theo:
                            <select class="bg-transparent border-none focus:ring-0 cursor-pointer font-bold text-primary">
                                <option>Mới nhất</option>
                                <option>Đánh giá cao</option>
                                <option>Đánh giá thấp</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-8">
                        @forelse($product->reviews as $review)
                        <div class="space-y-4 pb-8 border-b border-surface-container-low">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center text-primary font-bold">
                                        {{ substr($review->user->full_name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-surface">{{ $review->user->full_name }}</h4>
                                        <p class="text-xs text-on-surface-variant">{{ $review->created_at }}</p>
                                    </div>
                                </div>
                                <div class="flex text-tertiary">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? 1 : 0 }};">star</span>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed">
                                {{ $review->content }}
                            </p>
                        </div>
                        @empty
                        <div class="py-12 text-center space-y-4">
                            <span class="material-symbols-outlined text-6xl text-outline-variant">chat_bubble_outline</span>
                            <p class="text-on-surface-variant">Chưa có đánh giá nào cho sản phẩm này.</p>
                        </div>
                        @endforelse
                        <button
                            class="w-full py-4 rounded-xl border-2 border-surface-container-high text-on-surface-variant font-bold hover:bg-surface-container-low transition-all">
                            Xem thêm đánh giá
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Related Products Section -->
        <section class="mt-32 space-y-12">
            <div class="flex justify-between items-end">
                <div class="space-y-2">
                    <h2 class="text-4xl font-black text-on-surface tracking-tight">Sản Phẩm Tương Tự</h2>
                    <p class="text-on-surface-variant">Khám phá thêm các dòng hương kinetic đầy năng lượng khác</p>
                </div>
                <a class="text-primary font-bold flex items-center gap-1 hover:gap-2 transition-all" href="#">
                    Xem tất cả <span class="material-symbols-outlined" data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($relatedProducts as $related)
                <div class="group bg-surface-container-lowest p-4 rounded-lg hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container-low mb-6 relative">
                        <img alt="{{ $related->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="{{ $related->img ? asset('storage/' . $related->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                        <a href="{{ route('xemchitiet', $related->product_id) }}"
                            class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-lg flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-tertiary uppercase">{{ $related->category->name ?? 'Fragrance' }}</p>
                        <h4 class="font-bold text-lg text-on-surface"><a href="{{ route('xemchitiet', $related->product_id) }}">{{ $related->name }}</a></h4>
                        <p class="text-primary font-bold">{{ number_format($related->base_price) }}đ</p>
                    </div>
                </div>
                @empty
                <p class="col-span-4 text-center text-on-surface-variant">Không có sản phẩm nào tương tự.</p>
                @endforelse
            </div>
        </section>
    </main>
@endsection