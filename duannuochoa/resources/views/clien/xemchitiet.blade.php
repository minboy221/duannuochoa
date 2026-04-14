@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 max-w-7xl mx-auto px-6 lg:px-12">
        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Image Gallery (Asymmetric Layout) -->
            <div class="lg:col-span-7 grid grid-cols-2 gap-4">
                <div class="col-span-2 aspect-[4/5] rounded-lg overflow-hidden bg-surface-container-low group">
                    <img alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                        src="{{ $product->img ? asset('storage/' . $product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                </div>
                <div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low">
                    <img alt="Xmen Kinetic Blue Detail 1" class="w-full h-full object-cover"
                        data-alt="Close up of perfume spray mist captured in motion with dramatic lighting against a dark blue gradient background"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPQ-8TwT857mVCoJro7Hf6PSFpYF6hg9W8O0wTEBabbTHbbNzMwdxuoNmQfpcYzPZek4dTDAOp5ZKv6lSoDbZfM8LrIwrrCPwoBcikeO2cVKdY_WR0Xg6oqNwmLEFpwaA2_QCDLT9FYytXjlkYRoofsh4eoYJ7POyrGOtpRFTXD6EdrP8MNNvqRErGLSZlGKmE-4lPjbPFnRTXruK2cRwlTdLsND9ZXWOyfWKQyZ-BKGZ8JsZrEIHW2vMKKFyWGwZ3uXQs8cWUC_MX" />
                </div>
                <div class="aspect-square rounded-lg overflow-hidden bg-surface-container-low">
                    <img alt="Xmen Kinetic Blue Detail 2" class="w-full h-full object-cover"
                        data-alt="Ingredients of a fresh fragrance including sliced bergamot and cedar wood pieces on a clean white surface"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBniXs6ii6rA8OGdQ0fK5aIA0qPB3OTKg2FXxcuzKvuEBP7IDBTR2caljjLwjSlXNPqwz4Xb6JS58z0u6p2vJ1lDFVSnBETklail7zKIDXU5DbtUHmwd9U2TsSSa-DdFwPmSlovfOv_fHNgMDedquILLU69urYMQs6zlmyxUk3WwwNOUytXY8Ym9Qsbgym4riExcNoJ3IZNAhK7sbWss-fN8ccp0iO2uuLDcxP7t7F3qqJTFogcb6Ja7LnzuqnqhhkSmGRPRVxcUkBH" />
                </div>
            </div>
            <!-- Content Info -->
            <div class="lg:col-span-5 sticky top-32 space-y-8">
                <div class="space-y-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="bg-tertiary-container text-on-tertiary-container px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Mới
                            Nhất</span>
                        <div class="flex text-tertiary">
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
                            <span class="ml-2 text-on-surface-variant text-sm font-medium">(128 đánh giá)</span>
                        </div>
                    </div>
                    <h1 class="text-5xl font-extrabold text-primary tracking-tight leading-tight">{{ $product->name }}</h1>
                    <p class="text-2xl font-bold text-on-surface" id="display-price">{{ number_format($product->base_price) }}đ</p>
                </div>
                <p class="text-on-surface-variant leading-relaxed text-lg">
                    {{ $product->description }}
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
                            class="variant-btn py-3 px-6 rounded-xl border-2 transition-all font-bold 
                            {{ $loop->first ? 'border-primary bg-primary-container/10 text-primary' : 'border-transparent bg-surface-container-high text-on-surface-variant hover:bg-surface-container-highest' }}"
                            data-price="{{ number_format($variant->price) }}đ"
                            data-stock="{{ $variant->stock_quantity }}"
                            onclick="selectVariant(this)">
                            {{ $variant->volume_id }}ml
                        </button>
                        @empty
                        <p class="text-sm text-outline">Sản phẩm này hiện chưa có biến thể dung tích.</p>
                        @endforelse
                    </div>
                </div>

                <script>
                    function selectVariant(element) {
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
                    }

                    // Initial price/stock if variants exist
                    window.addEventListener('DOMContentLoaded', (event) => {
                        const firstVariant = document.querySelector('.variant-btn');
                        if (firstVariant) {
                            firstVariant.click();
                        }
                    });
                </script>
                <!-- Fragrance Pyramid -->
                <div class="p-6 rounded-lg bg-surface-container-low space-y-6">
                    <h3 class="font-bold text-sm uppercase tracking-widest text-primary">Tầng Hương Đặc Trưng</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm text-primary">
                                <span class="material-symbols-outlined" data-icon="eco">eco</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-on-surface-variant uppercase">Hương Đầu</p>
                                <p class="font-semibold">Cam Bergamot, Bưởi, Hương Biển</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm text-secondary">
                                <span class="material-symbols-outlined" data-icon="filter_vintage">filter_vintage</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-on-surface-variant uppercase">Hương Giữa</p>
                                <p class="font-semibold">Hoa Oải Hương, Lá Xô Thơm, Nhục Đậu Khấu</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm text-tertiary">
                                <span class="material-symbols-outlined" data-icon="forest">forest</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-on-surface-variant uppercase">Hương Cuối</p>
                                <p class="font-semibold">Gỗ Tuyết Tùng, Hổ Phách, Xạ Hương</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Actions -->
                <div class="flex flex-col gap-4 pt-4">
                    <button
                        class="w-full py-4 rounded-xl bg-gradient-to-r from-primary to-primary-container text-on-primary font-bold text-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Mua ngay
                    </button>
                    <button
                        class="w-full py-4 rounded-xl bg-surface-container-highest text-primary font-bold text-lg hover:bg-surface-container-high transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" data-icon="add_shopping_cart">add_shopping_cart</span>
                        Thêm vào giỏ hàng
                    </button>
                </div>
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
                            <div class="text-6xl font-black text-primary">4.8</div>
                            <div class="space-y-1">
                                <div class="flex text-tertiary">
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined"
                                        style="font-variation-settings: 'FILL' 1;">star_half</span>
                                </div>
                                <p class="text-sm font-medium text-on-surface-variant">Dựa trên 128 nhận xét</p>
                            </div>
                        </div>
                    </div>
                    <!-- Write a Review Form -->
                    <div class="bg-surface-container-low p-8 rounded-lg shadow-sm space-y-6">
                        <h3 class="text-xl font-bold text-on-surface">Viết đánh giá của bạn</h3>
                        <form class="space-y-4">
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
                                    class="w-full bg-white border border-surface-container-high rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none"
                                    placeholder="Nhập tên của bạn" type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-on-surface-variant uppercase tracking-wider">Nhận
                                    xét</label>
                                <textarea
                                    class="w-full bg-white border border-surface-container-high rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none resize-none"
                                    placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm..." rows="4"></textarea>
                            </div>
                            <button
                                class="w-full py-4 rounded-xl bg-primary text-on-primary font-bold hover:bg-primary-dim transition-all shadow-lg shadow-primary/10"
                                type="submit">
                                Gửi đánh giá
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Review List -->
                <div class="lg:col-span-8 space-y-8">
                    <div class="flex items-center justify-between border-b border-surface-container pb-4">
                        <h3 class="font-bold text-lg">Tất cả nhận xét (128)</h3>
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
                        <!-- Review Item 1 -->
                        <div class="space-y-4 pb-8 border-b border-surface-container-low">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center text-primary font-bold">
                                        NH
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-surface">Nguyễn Hoàng</h4>
                                        <p class="text-xs text-on-surface-variant">20 tháng 5, 2024</p>
                                    </div>
                                </div>
                                <div class="flex text-tertiary">
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
                                </div>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed">
                                Mùi hương rất nam tính và lưu hương cực lâu. Mình xịt từ sáng mà đến tối vẫn còn nghe
                                thoang thoảng mùi gỗ trầm ấm. Rất đáng đồng tiền bát gạo!
                            </p>
                            <div class="flex items-center gap-4 text-xs font-bold text-on-surface-variant">
                                <button class="flex items-center gap-1 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">thumb_up</span> Hữu ích (12)
                                </button>
                                <button class="hover:text-primary transition-colors">Phản hồi</button>
                            </div>
                        </div>
                        <!-- Review Item 2 -->
                        <div class="space-y-4 pb-8 border-b border-surface-container-low">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary font-bold">
                                        TM
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-surface">Trần Minh</h4>
                                        <p class="text-xs text-on-surface-variant">15 tháng 5, 2024</p>
                                    </div>
                                </div>
                                <div class="flex text-tertiary">
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
                                </div>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed">
                                Giao hàng nhanh, đóng gói cẩn thận. Mùi hương biển lúc đầu rất sảng khoái, sau đó chuyển
                                sang tông gỗ ấm áp. Phù hợp dùng hàng ngày đi làm hoặc đi chơi.
                            </p>
                            <div class="flex items-center gap-4 text-xs font-bold text-on-surface-variant">
                                <button class="flex items-center gap-1 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">thumb_up</span> Hữu ích (5)
                                </button>
                                <button class="hover:text-primary transition-colors">Phản hồi</button>
                            </div>
                        </div>
                        <!-- Review Item 3 -->
                        <div class="space-y-4 pb-8">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-tertiary-container/20 flex items-center justify-center text-tertiary font-bold">
                                        LH
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-on-surface">Lê Huy</h4>
                                        <p class="text-xs text-on-surface-variant">10 tháng 5, 2024</p>
                                    </div>
                                </div>
                                <div class="flex text-tertiary">
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
                                </div>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed">
                                Vừa mới nhận hàng xong. Thiết kế chai cầm rất chắc tay và sang trọng. Xịt thử thấy mùi
                                thơm mát lạnh đúng kiểu Kinetic. Rất hài lòng!
                            </p>
                            <div class="flex items-center gap-4 text-xs font-bold text-on-surface-variant">
                                <button class="flex items-center gap-1 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-sm">thumb_up</span> Hữu ích (8)
                                </button>
                                <button class="hover:text-primary transition-colors">Phản hồi</button>
                            </div>
                        </div>
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
                <!-- Related Card 1 -->
                <div class="group bg-surface-container-lowest p-4 rounded-lg hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container-low mb-6 relative">
                        <img alt="Xmen Fire Energy"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            data-alt="Modern perfume bottle in a warm orange setting with soft shadows, minimalist aesthetic"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAE8pQC-75mV2kvh1ysP3BlNxlvAmvNVxcYygMuyvPStEEjDUDd5o4A4IXM3hXh_XWyhVmanZ1yWEHPgIBneCWl6DQZd_0UlrqQ5ptyYAkXAurPngRsN7JEX0NphrMrWuZ3TADGDMwnVQtGKkgZRSh50ldQVBqOVHg3eWFgebw8Tx5gHsxED7sMf7oYsF5xxcB4V8HgN_pZUC-714Vd4ole1aiuzsJicIcCSA7WRVdvOMZyJjW6a_-LnyYedoPdYP4ozwqolCWxSJ7I" />
                        <button
                            class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-lg flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                        </button>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-tertiary uppercase">Warm &amp; Spicy</p>
                        <h4 class="font-bold text-lg text-on-surface">Xmen Fire Energy</h4>
                        <p class="text-primary font-bold">545,000đ</p>
                    </div>
                </div>
                <!-- Related Card 2 -->
                <div class="group bg-surface-container-lowest p-4 rounded-lg hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container-low mb-6 relative">
                        <img alt="Xmen Green Nature"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            data-alt="Dark green glass perfume bottle resting on a mossy stone, forest background, moody cinematic lighting"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6ewa-iJUOAMRPP9o89O1M2kPHizCQV7OhVTdjBAhuS1grY60-L_OhQK3-XJI-q5jkMVLxN5FYHPNPzvCBME85pFlqdji62U6RivdV05e9cd5icw7hndDVIlgJBxkl19pi5eTHC-g4Mm5KX4mKSYc_iiqvYPI66Uml0d1NZVq4skkj6fPsOICcmnD3VgNRR3ZIIkSAh6vyFP4kCFiSFsGYXoCl0kyZINSsUkRYdpWDcCFSXxQ9tVz21HX4fUzLFNGeArP5UrAZev7j" />
                        <button
                            class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-lg flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                        </button>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-secondary uppercase">Fresh &amp; Earthy</p>
                        <h4 class="font-bold text-lg text-on-surface">Xmen Green Nature</h4>
                        <p class="text-primary font-bold">525,000đ</p>
                    </div>
                </div>
                <!-- Related Card 3 -->
                <div class="group bg-surface-container-lowest p-4 rounded-lg hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container-low mb-6 relative">
                        <img alt="Xmen Black Edition"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            data-alt="Sleek black perfume bottle with silver cap on a mirrored surface, dramatic top light, luxury feel"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUjCk1HqLZ8gtBp4ZaucKT8DIIRlUTmOuIkqnQmHBmw9zdsllaFSFGoidKquz5QX_BD5euCg5ptJ8W5DhOnwqkUG5cdKoHl5J8PkwP9mk5idvkDXAwDQOd1XnUyOLebgDSHoqOVGrhieg1DGHF5ZGsONDKKKAEehuYLqDOWX0oJsttb6IHMslpZyf82owosQeUohKAxKva0BqjNqMsyseIhd5I279fjlqvgmM8wMMKEsdCbw-tleB4CYsERdqtseNTihhEAjsYr09a" />
                        <button
                            class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-lg flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                        </button>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-on-surface-variant uppercase">Deep &amp; Intense</p>
                        <h4 class="font-bold text-lg text-on-surface">Xmen Black Edition</h4>
                        <p class="text-primary font-bold">620,000đ</p>
                    </div>
                </div>
                <!-- Related Card 4 -->
                <div class="group bg-surface-container-lowest p-4 rounded-lg hover:shadow-xl transition-all duration-500">
                    <div class="aspect-[3/4] rounded-lg overflow-hidden bg-surface-container-low mb-6 relative">
                        <img alt="Xmen Pure Citric"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            data-alt="Clear fragrance bottle with light yellow liquid against a bright sunny window, airy and fresh mood"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDABW1a3eSw5LojdqHvbFeYasQv2mb0Un-aseq-dZceZ1HEXpRvPetSKx5qxjdOe2ScuFAqO9kRsfG0vx9GNBtayuM3H4RiQFChiloxp8YxrNVblaHgCUBf5_beHm7HWSCvd1Q4IqkSs0cTfrOyDuoIykP46uCAfDWPPAlyEwiLVjeibOMKgggTyqZR4xnLytYi4WPuEu7eP4z9oIZTYqAsKMf6Dt_R88oayY-hM42oS6k-qes45eEwrefma1FrFRKiGijyEhykBBxt" />
                        <button
                            class="absolute bottom-4 right-4 w-12 h-12 rounded-full bg-white/90 backdrop-blur shadow-lg flex items-center justify-center text-primary opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all">
                            <span class="material-symbols-outlined" data-icon="add">add</span>
                        </button>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-primary-container uppercase">Light &amp; Citrus</p>
                        <h4 class="font-bold text-lg text-on-surface">Xmen Pure Citric</h4>
                        <p class="text-primary font-bold">495,000đ</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection