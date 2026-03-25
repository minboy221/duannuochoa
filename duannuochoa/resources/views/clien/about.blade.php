@extends('layouts.app')
@section('content')

    <section class="py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
                <div class="relative">
                    <div class="absolute -top-10 -left-10 w-64 h-64 bg-primary-container/20 rounded-full blur-3xl">
                    </div>
                    <img alt="X-Men Heritage" class="rounded-lg shadow-2xl relative z-10 aspect-[4/5] object-cover"
                        data-alt="Close up of a premium blue cologne bottle with water droplets, dramatic lighting against a dark slate background, high-end product photography"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAXheojL59_2pk8y0yqV0GD-gLgmS1CPGBqyq94HeaoaQ_-Dwn1GXTRaVDjuPukJral2yzhUudx4ENuLfrvrC_IqgrYbUrUAD9o1-An__aGfPycECMU7Fz_pUEz-7pkOgi1w_wzwCYbWfSII7P2UwqqqfIHKEzeBZ3PFqorZbb-OkcoAQaWGbJinKhKsDQw7ShFpSgQxGGwQZgEP4fjnvqmTMvL59DSQACN7odWKat_Q1rHP915By0wOeXkzAdOmPNuTov6Y7BnbX1a" />
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-secondary-container/30 rounded-full blur-2xl">
                    </div>
                </div>
                <div class="space-y-8">
                    <h2 class="font-headline text-4xl md:text-5xl font-bold text-primary tracking-tight">Câu Chuyện
                        Thương Hiệu</h2>
                    <div class="space-y-6 text-on-surface-variant text-lg leading-relaxed">
                        <p>Ra đời từ khát khao định nghĩa lại phong cách phái mạnh Việt Nam, X-MEN đã bắt đầu hành trình
                            từ những nốt hương nam tính đầy mê hoặc. Chúng tôi tin rằng, mỗi người đàn ông đều sở hữu
                            một nguồn năng lượng tiềm ẩn, chỉ chờ được kích hoạt.</p>
                        <p>Trải qua hơn hai thập kỷ, X-MEN đã trở thành người bạn đồng hành không thể thiếu, giúp nam
                            giới khẳng định cái tôi riêng biệt và phong thái tự tin trong mọi hoàn cảnh.</p>
                    </div>
                    <div class="pt-4">
                        <button
                            class="px-8 py-4 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-xl font-bold shadow-xl hover:scale-105 transition-transform">
                            Khám Phá Di Sản
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mission & Vision (Bento Grid) -->
    <section class="py-32 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-8">
            <div class="text-center mb-20">
                <h2 class="font-headline text-4xl md:text-5xl font-black text-on-surface mb-4">Tầm Nhìn &amp; Sứ Mệnh
                </h2>
                <div class="h-1.5 w-24 bg-primary mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission -->
                <div
                    class="md:col-span-2 bg-surface-container-lowest p-12 rounded-lg shadow-sm flex flex-col justify-between group hover:shadow-xl transition-all duration-500">
                    <div>
                        <div
                            class="w-16 h-16 bg-primary-container/10 rounded-2xl flex items-center justify-center mb-8 text-primary group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                            <span class="material-symbols-outlined text-4xl" data-icon="rocket_launch">rocket_launch</span>
                        </div>
                        <h3 class="font-headline text-3xl font-bold mb-6 text-on-surface">Sứ Mệnh</h3>
                        <p class="text-on-surface-variant text-lg leading-relaxed">
                            Cung cấp những giải pháp chăm sóc cá nhân toàn diện, giúp nam giới Việt luôn giữ vững phong
                            độ và sự tự tin để chinh phục mọi thử thách trong cuộc sống năng động.
                        </p>
                    </div>
                    <div class="mt-12 h-40 overflow-hidden rounded-xl">
                        <img alt="Mission Image"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            data-alt="Dynamic shot of young men playing basketball on an urban court, splashing sweat, energetic movement, golden hour lighting"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRiak8fF8ODQToQU0HMBYV_iCe-oQ7aLztyte58R_fuWNQuaLW5I0gCsfoO2Clpe7NI64TLrwOgVwy6laABcFfG_tKgk_S-UoI49qeYcPuItV4UxjiRaEqndraoLg0HkMohVcYUAfOhwLbhHNd3iXvXY9E3H4tlI8b4qYFOQjUrECl5yg9MZPkG-lF7BgS9CCTN42V51EegcjUSC4tQkBlY9_5lvprmAZN-nmCntBmO5Tnb-xvq7NzeVvtBZWr7lEvsuQjrRvLMcZs" />
                    </div>
                </div>
                <!-- Vision -->
                <div
                    class="bg-gradient-to-br from-primary to-primary-dim p-12 rounded-lg shadow-2xl text-white flex flex-col justify-center text-center">
                    <span class="material-symbols-outlined text-6xl mb-8" data-icon="visibility">visibility</span>
                    <h3 class="font-headline text-3xl font-bold mb-6">Tầm Nhìn</h3>
                    <p class="text-primary-container font-medium text-lg leading-relaxed">
                        Trở thành biểu tượng phong cách sống hàng đầu cho phái mạnh tại Đông Nam Á, dẫn đầu xu hướng về
                        mùi hương và sự sáng tạo không ngừng.
                    </p>
                </div>
                <!-- Core Values -->
                <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-surface-container-lowest p-8 rounded-lg flex items-start space-x-6 border-l-4 border-tertiary">
                        <span class="material-symbols-outlined text-tertiary" data-icon="verified">verified</span>
                        <div>
                            <h4 class="font-bold text-on-surface mb-2">Chất Lượng</h4>
                            <p class="text-sm text-on-surface-variant">Tiêu chuẩn quốc tế trong từng thành phần mùi
                                hương.</p>
                        </div>
                    </div>
                    <div
                        class="bg-surface-container-lowest p-8 rounded-lg flex items-start space-x-6 border-l-4 border-secondary">
                        <span class="material-symbols-outlined text-secondary" data-icon="bolt">bolt</span>
                        <div>
                            <h4 class="font-bold text-on-surface mb-2">Năng Động</h4>
                            <p class="text-sm text-on-surface-variant">Luôn chuyển động và thích nghi với xu hướng mới.
                            </p>
                        </div>
                    </div>
                    <div
                        class="bg-surface-container-lowest p-8 rounded-lg flex items-start space-x-6 border-l-4 border-primary">
                        <span class="material-symbols-outlined text-primary" data-icon="groups">groups</span>
                        <div>
                            <h4 class="font-bold text-on-surface mb-2">Cộng Đồng</h4>
                            <p class="text-sm text-on-surface-variant">Kết nối và truyền cảm hứng cho phái mạnh.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Lifestyle Gallery -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="max-w-xl">
                    <h2 class="font-headline text-4xl md:text-5xl font-black text-on-surface leading-tight">Phong Cách
                        <br /> Sống X-MEN
                    </h2>
                </div>
                <p class="text-on-surface-variant text-lg md:text-right max-w-sm">
                    Ghi lại những khoảnh khắc đầy cảm hứng của người đàn ông X-MEN trong cuộc sống đời thường.
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                <div class="col-span-2 row-span-2 rounded-lg overflow-hidden group relative">
                    <img alt="Lifestyle 1"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Portrait of a confident young man in a minimalist grey suit, studio lighting with subtle blue shadows, high fashion style"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpWpjuyxxBFMuBfl4HrgGjZhYdZVWnnATAdK5iFb8ucXRyPQ6Aa0GECSxhJqwz4nn_q8QHxMDQW_75YbihnCsKULnZ1AZSfKG7d2CnrdSyyOZ1Pr9S55X71pfMFGOHQs6FOAWl5X_WBSDDFJY6bDLu5VtII-Woj3GfcJiDCu705F2smpdKU9zYvbXKR0FIEhRRcuIT-E4tBDeYvjXJY1R6SxCOMnKXR5zTstDj6-_n7WU6BYHShamZBnSFo_yx8H1MK9ggc84gzpEc" />
                    <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>
                <div class="rounded-lg overflow-hidden group relative">
                    <img alt="Lifestyle 2"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Young man riding a classic motorcycle through a sunlit coastal road, ocean breeze, cinematic feel"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBXrKLE-8IOgoWKVapUes8lu7A-NH2s9sH_UvPhP08GN2Ws7r5sd3MoU-MYKY-vhAMDmDAyXyTW1mud2Y4NYp8Tue4U7xNrhJc9sU5TL3a_ne6ftlBJCPY27YlKqYd3TL1KRKbkc-3bNzZPiPQFzry_ARouHMfwwDgJD7KxY3KKzHIe6jPrgC52EyGs-oyYXELqdA-UluHsW-xtdyiLktOYHVqaywql53LEoMEz3AB_KXT0uEgnEQYa-WIW8UlZ2B1v65IkyZqf_my2" />
                </div>
                <div class="rounded-lg overflow-hidden group relative">
                    <img alt="Lifestyle 3"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Close up of a man fixing his tie in a mirror, moody atmosphere with low key lighting, focus on detail and grooming"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdTSTsgviXN4QIgjcgMwYuZgCspMglVEeFF5FrM_wPB99pkmbEYMMsP04nED2JCXKAT_dTmDEPex3zXBz11IrkgyUOh1s9eSiN2aqU9JVVxzRUWD3IP5cOXUvLuBQ7LJVy1q5Q7dtBWCnWid8e9jDLyVZ8DdNrbS6xoGDSiZz2hHeVX-rFN4WAKaAf0jBdyvwequXYQMcXXR6FC2paL-doKsGn0vKjc-hz4EHS3F8a3ycxjx3VlHYZC_tzMPDHmAX2yMQ0LliBVL1B" />
                </div>
                <div class="col-span-2 rounded-lg overflow-hidden h-64 md:h-80 group relative">
                    <img alt="Lifestyle 4"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Dynamic office scene with a young businessman laughing during a meeting, modern architecture, bright and airy lighting"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8A7NW7NY4EwvtWYu6lBgqbq_czlBmvllW6GJHEDhH2xiKDikX09aeEJTVS2le-fZ0S-d6HO5-XbcY5o4qLy1HzMILbdrp37ooeDLA23RVErADWnqvKF0VYOZ2Gv6812BYNBx6K23h5p4j0UPZcnOOBkOAzyaH32qiMIAGER8fNFhmfYgwMoOI-3EDLhtvD9KAOu9Be2V6zJx7MaHyeeBR-edkHK8O9XV6F3AUx8BNQIQr02Ni8bigr-J2uM7HWS7vgQSjF61xWYaJ" />
                </div>
            </div>
        </div>
    </section>
@endsection