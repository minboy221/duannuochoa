@extends('layouts.app')
@section('content')
    <!-- Hero Section -->
    <section class="relative h-[921px] flex items-center overflow-hidden bg-surface-container-low">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover object-center opacity-90"
                data-alt="Modern stylish man in sharp blue suit adjusting his collar in a minimalist high-end architectural setting with dynamic natural lighting"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuClbESyHQGUh8oIuXYC-5lQKkru7ezI_SGDWupCmrX4vgZPs4ADw4C6sQQ8ovD3L9UrYk7LTtSys2gJSNDHm5kArycYq01Dp0TzD9GXcpznhEcqIFzvcEfko7tv-Y1x6POpsfIGNFOZumWT7_bD4HpQEsVWjMPhIbRIT78KFFedrNU_v4jt8gLqM1YzUvQGaK8k0GSfq5mrvb-OGx7cFdf8awz_PzOXTYNzrR1nz06vdTdcCvh_F8hvNEvrG9-Oy22kBiqpG3jYrXgS" />
            <div class="absolute inset-0 bg-gradient-to-r from-surface via-surface/40 to-transparent"></div>
        </div>
        <div class="container mx-auto px-8 relative z-10">
            <div class="max-w-2xl">
                <span
                    class="inline-block bg-tertiary text-on-tertiary px-4 py-1 rounded-full text-xs font-bold tracking-widest mb-6">MỚI
                    RA MẮT</span>
                <h1 class="font-headline text-7xl font-extrabold text-primary tracking-tighter leading-none mb-6">
                    Xmen - Khẳng định <br />
                    <span class="text-transparent bg-clip-text kinetic-gradient">bản lĩnh phái mạnh</span>
                </h1>
                <p class="text-lg text-on-surface-variant mb-10 max-w-lg leading-relaxed">
                    Khám phá bộ sưu tập nước hoa cao cấp, thiết kế dành riêng cho người đàn ông hiện đại, đầy năng
                    lượng và khát khao chinh phục.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button
                        class="kinetic-gradient text-on-primary px-10 py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 transition-transform">
                        Mua Ngay
                    </button>
                    <button
                        class="bg-surface-container-highest text-primary px-10 py-4 rounded-xl font-bold text-lg hover:bg-primary-container transition-colors">
                        Tìm Hiểu Thêm
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products - Bento Grid Style -->
    <section class="py-24 bg-surface px-8">
        <div class="container mx-auto">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="font-headline text-4xl font-extrabold text-on-surface tracking-tight mb-2">Sản phẩm
                        nổi bật</h2>
                    <div class="h-1.5 w-24 kinetic-gradient rounded-full"></div>
                </div>
                <a class="text-primary font-bold flex items-center gap-2 hover:underline" href="#">Xem tất cả <span
                        class="material-symbols-outlined">arrow_forward</span></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @forelse($featuredProducts as $item)
                    @if($loop->iteration == 1)
                        <div class="md:col-span-2 md:row-span-2 group relative overflow-hidden rounded-lg bg-surface-container-lowest shadow-sm hover:shadow-2xl transition-all duration-500">
                            <div class="absolute top-6 left-6 z-10">
                                <h3 class="font-headline text-3xl font-bold text-on-surface">{{ $item->name }}</h3>
                                <p class="text-primary font-semibold">Sản phẩm Nổi bật</p>
                            </div>
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMwqmq3Pecj-lgmuDdelVlH6FdmSNeIbtLNRa3q2WHUTcXl8z8BvYQ5CGi8twizyZwyB2KImekckngCDQQ7sOmzlJscO049-_7k38M3ae4rOE3nO-gQR_iXFI8MkWdUa3_W-TZeoRDv7McKttfJI4amb1aiKRiryUJn6Y6WKyegUCEXMAoNlMzkeJTz2vnk3sErFe7Kg8nYxR7xgL67seGVJr726ayucnrScesCy96GX91gu0_2Bue9G6sJLAplW5G-MCbLueRnHf1" />
                            <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('xemchitiet', $item->product_id) }}" class="inline-block p-4 rounded-full kinetic-gradient text-white shadow-lg">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                src="{{ $item->img ? asset('storage/' . $item->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                            <div class="absolute bottom-6 right-6 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                                <a href="{{ route('xemchitiet', $item) }}" class="p-4 rounded-full bg-white text-primary shadow-lg hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                <button class="p-4 rounded-full kinetic-gradient text-white shadow-lg">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    @elseif($loop->iteration == 4)
                        <div class="md:col-span-2 group relative overflow-hidden rounded-lg bg-surface-container-lowest h-64 flex items-center hover:shadow-xl transition-all cursor-pointer" onclick="window.location='{{ route('xemchitiet', $item) }}'">
                            <div class="flex-1 p-8">
                                <h3 class="font-headline text-2xl font-bold">{{ $item->name }}</h3>
                                <p class="text-outline-variant mb-4">Hương thơm độc đáo dành cho phái mạnh.</p>
                                <p class="text-primary font-black text-2xl mb-4">{{ number_format($item->base_price) }}đ</p>
                                <a href="{{ route('xemchitiet', $item->product_id) }}" class="inline-block bg-primary text-on-primary px-6 py-2 rounded-full font-bold">Xem chi tiết</a>
                            </div>
                            <div class="flex-1 h-full overflow-hidden">
                                <img class="w-full h-full object-cover" 
                                    src="{{ $item->img ? asset('storage/' . $item->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                            </div>
                        </div>
                    @else
                        <div class="group relative overflow-hidden rounded-lg bg-surface-container-lowest p-6 flex flex-col items-center text-center hover:shadow-xl transition-all cursor-pointer" onclick="window.location='{{ route('xemchitiet', $item) }}'">
                            <div class="mb-4 h-48 w-full overflow-hidden rounded-lg">
                                <a href="{{ route('xemchitiet', $item->product_id) }}">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKCuUtPhmGNoQ4JWZXxcmsRlK9CGXUAgX5aJg9NeZyK1LnTzhwcTZdt7JSeyDf4OkbCrpEOUd8IHnU5gQL6lyqFMfXfhrfhvHcK_8sC_FIudYg4na7x0IO0y4rTsThWIkHmjuQVADPbW0mC3l1X7pAE7wOoVDFw8OO3LB2xgnFqIP4avVjTwEkd2PB5WcFn8VsG9hTSjfnk1z8Ir00LXiaFUUo-QqW_zGYU8SJldN46ZdhhZvKYnxRu1vS5NRBzu1mKaSrz5jv_ceZ" />
                                </a>
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                                    src="{{ $item->img ? asset('storage/' . $item->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                            </div>
                            <h3 class="font-bold text-lg"><a href="{{ route('xemchitiet', $item->product_id) }}">{{ $item->name }}</a></h3>
                            <p class="text-outline text-sm mb-4">Lịch lãm &amp; Đẳng cấp</p>
                            <p class="text-primary font-black text-xl">{{ number_format($item->base_price) }}đ</p>
                        </div>
                    @endif
                @empty
                    <p class="col-span-1 md:col-span-4 text-center py-8 text-outline">Chưa có sản phẩm nổi bật nào được chọn.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Best Sellers -->
    <section class="py-24 bg-surface-container-low px-8">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-headline text-4xl font-extrabold text-on-surface mb-4">Sản phẩm bán chạy</h2>
                <p class="text-outline max-w-md mx-auto">Những lựa chọn hàng đầu của phái mạnh Việt Nam năm 2024</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($bestsellingProducts as $item)
                <div class="bg-surface-container-lowest rounded-lg p-2 shadow-sm group cursor-pointer" onclick="window.location='{{ route('xemchitiet', $item) }}'">
                    <div class="relative overflow-hidden rounded-lg aspect-square mb-4">
                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            data-alt="Clean minimal glass perfume bottle with silver cap on a blue satin fabric background"
                            src="{{ $item->img ? asset('storage/' . $item->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" />
                        <span class="absolute top-4 left-4 bg-tertiary-container text-on-tertiary-container text-xs font-bold px-3 py-1 rounded-full">BEST SELLER</span>
                    </div>
                    <div class="px-4 pb-6">
                        <div class="flex items-center gap-1 mb-2">
                            <span class="material-symbols-outlined text-orange-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-orange-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-orange-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-orange-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-orange-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="text-xs text-outline-variant ml-2">(1.2k)</span>
                        </div>
                        <h4 class="font-bold text-lg text-on-surface mb-1">{{ $item->name }}</h4>
                        <p class="text-sm text-outline mb-4">Sản phẩm bán chạy nhất</p>
                        <div class="flex justify-between items-center">
                            <span class="text-primary font-black text-xl">{{ number_format($item->base_price) }}đ</span>
                            <a href="{{ route('xemchitiet', $item->product_id) }}" class="h-10 w-10 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:kinetic-gradient hover:text-white transition-all">
                                <span class="material-symbols-outlined">visibility</span>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-8 text-outline">Chưa có sản phẩm bán chạy nào được chọn.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- Special Offers - Modern Glassmorphism Card -->
    <section class="py-24 px-8">
        <div class="container mx-auto">
            <div class="relative rounded-xl overflow-hidden min-h-[400px] flex items-center p-12">
                <img class="absolute inset-0 w-full h-full object-cover"
                    data-alt="Abstract dynamic blue background with flying glass shards and citrus fruits in motion"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAC6kNJeX64KO4j7Uwwk5qJ8imZlUeH0D70QntIvz0mdHSZGgj312wsIxSnmPP0EZGUn1odOhl6SLn7HMdmJkQstyeIrgDonUxflzOJK11CBQ78kw00rPBlgcZaGSgP7dof4uUTYrBF5nsqRI_MHIF6HZRew4_NuN9-QVevftDU-TcEI35WlniG7vsESBUWpbZJ8YVZ1K8B6CkcYaNFEfzbtyLDXhyGtanh7wrcEkA8t7z3UkW8gjV9QOcURsYTYHhhvOCEhrx6kEmH" />
                <div class="absolute inset-0 bg-blue-900/40 backdrop-blur-sm"></div>
                <div class="relative z-10 max-w-xl text-white">
                    <span class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-bold mb-6 inline-block">ƯU
                        ĐÃI ĐẶC BIỆT</span>
                    <h2 class="font-headline text-5xl font-black mb-6">Combo Phái Mạnh: <br />Tự tin bứt phá</h2>
                    <p class="text-lg opacity-90 mb-8">Giảm ngay 25% khi mua trọn bộ Sữa tắm &amp; Nước hoa Xmen
                        Boss. Tặng kèm túi du lịch cao cấp.</p>
                    <button
                        class="bg-white text-blue-700 px-10 py-4 rounded-xl font-extrabold text-lg hover:bg-slate-100 transition-all hover:shadow-2xl">NHẬN
                        ƯU ĐÃI NGAY</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose Xmen? -->
    <section class="py-24 bg-surface px-8">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="flex-1">
                    <h2 class="font-headline text-4xl font-extrabold text-primary mb-8">Tại sao chọn Xmen?</h2>
                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div
                                class="bg-primary-container/20 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-3xl">verified</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-on-surface">Chất lượng chuẩn quốc tế</h4>
                                <p class="text-outline">Nguyên liệu cao cấp được nhập khẩu trực tiếp từ các nhà
                                    hương hàng đầu thế giới.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div
                                class="bg-primary-container/20 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-3xl">timer</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-on-surface">Lưu hương 12 giờ</h4>
                                <p class="text-outline">Công nghệ nén hương tiên tiến giúp mùi hương bám tỏa mạnh mẽ
                                    suốt cả ngày dài.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div
                                class="bg-primary-container/20 h-14 w-14 rounded-full flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-3xl">eco</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1 text-on-surface">An toàn cho da</h4>
                                <p class="text-outline">Công thức được kiểm nghiệm da liễu, không gây kích ứng kể cả
                                    da nhạy cảm.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 relative">
                    <div class="relative rounded-lg overflow-hidden z-10 shadow-2xl">
                        <img class="w-full h-[500px] object-cover"
                            data-alt="Macro close-up of amber liquid and perfume mist being sprayed from a silver nozzle in a clean studio setting"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2TC-8v-Eo_Viv9e3OvySLRi0YR58lLiGwlyt2-9Hrb6nmu4wGw9vXw4BMwHXquqLOjbmDmyzz_JHn2s1rRdogJoLbmrDLLNMpCQ6rO4T4gsjww_WQsOI-TH79scoHZw6-id8akl9vv4QxVYTxcW1MQlTTfHoH1DJnAj-3m0f9N7Y2wckV-SZswDSQ4Uj7pnhgr1VwBrktNM0EdORyc0r7aouJv1eltMecZtNLm3588W9EFcfRBL3IeZ8ja7RY7E46Rn1mQ7KfJRfx" />
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-full h-full border-4 border-primary-container rounded-lg -z-0">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Customer Reviews -->
    <section class="py-24 bg-surface-container-low px-8">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-headline text-4xl font-extrabold text-on-surface mb-4">Đánh giá từ khách hàng</h2>
                <div class="flex justify-center gap-1 mb-2">
                    <span class="material-symbols-outlined text-orange-500"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-orange-500"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-orange-500"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-orange-500"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined text-orange-500"
                        style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
                <p class="text-outline">Hơn 500,000+ người đàn ông tin dùng mỗi năm</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <img class="w-12 h-12 rounded-full object-cover"
                            data-alt="Headshot of a confident young Asian man smiling against a clean neutral background"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-ier-0XGhkocqX3NXy5umKAP20MkyednuWpFzkV88Qqr1U9-wJiy5UbVKhsobNthefOGUfU3HIgxJ_LG4OrQStWOnUYKo8e3REwNxu6Vos7iFea4torwV5xl7cfXcA0-MDe-WrXpiE6S9eg_yl6Eh5_Vsygvy8z_wpOyc0hLvcLPXa72FHi1MSxTbK4RLXMwpaYC2_VhXcO0WAsWiyXm2n5caY37K9n69VEnMROEo4-noyEFEeeuHoPf8K9BubXiZeb55sBe3Qqsk" />
                        <div>
                            <h5 class="font-bold">Trần Minh Quân</h5>
                            <p class="text-xs text-outline-variant">Nhân viên văn phòng</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant italic leading-relaxed">"Mình đã dùng Xmen Boss được hơn 2
                        năm. Mùi hương rất sang trọng, đi gặp khách hàng cực kỳ tự tin. Lưu hương cũng rất lâu."</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border-t-4 border-primary">
                    <div class="flex items-center gap-4 mb-6">
                        <img class="w-12 h-12 rounded-full object-cover"
                            data-alt="Portrait of a stylish middle-aged man with a short beard and professional look"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPA899kNwpVDIlZ5gQb9jAIuHnhFvB5ZZIjHmx2assH6mU8nLpR33J8tj5REmEycvoV21lShRCxFjLiNv8tW3b4y-k85aDojJ_tgiLHQ5q6XdA-RAIK9e-vdULufYdNEhyRQ3JeSeDBtb7QafcS11D4Pi0XPd9bKGLi-inObLKmoHQh8oa2t8Nyml-gaG-wsjpXk3KdVakWu5ISmOT7ghabKkhgl5qvKnts_MxsWO-YFco-ynf1sJE5oeYWedS5RxMj047Vy_hbvbN" />
                        <div>
                            <h5 class="font-bold">Nguyễn Hoàng Nam</h5>
                            <p class="text-xs text-outline-variant">Freelancer</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant italic leading-relaxed">"Ấn tượng nhất là dòng Active. Rất mát
                        mẻ, phù hợp dùng đi gym hoặc hoạt động ngoài trời. Giá thành quá tốt so với chất lượng."</p>
                </div>
                <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm">
                    <div class="flex items-center gap-4 mb-6">
                        <img class="w-12 h-12 rounded-full object-cover"
                            data-alt="Casual headshot of a young man with a friendly expression in natural lighting"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPganbNJt4Pz1Nt0RjiDkJPLLw9hdYRRf7S74Mo_gT2TW3Hg85UgAqqTqfGWh0IZixlZ5SDIeBF25aGstPcLQpNwej2nIMzFOphyhK7on1RbdDd-JiAnvXRpujqDQ_piqlf4dQJgjo2RBHh4Jgs8ynKiUsW9DmIJ9RbLjyrCw1PdZH5H3dMsq5BAmIPIlTG28kqFWjUiHFbdN5EZuEqD-5SLvgfxuJK9KTpjgE_7M8y_z6h5qg5S4mtPbAUI83xnPtssoms7kjYWQB" />
                        <div>
                            <h5 class="font-bold">Lê Văn Đức</h5>
                            <p class="text-xs text-outline-variant">Kỹ sư</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant italic leading-relaxed">"Mùi Wood rất trầm và ấm, vợ mình cực
                        kỳ thích mùi này. Shop đóng gói cẩn thận, giao hàng nhanh. Sẽ ủng hộ dài lâu."</p>
                </div>
            </div>
        </div>
    </section>
@endsection