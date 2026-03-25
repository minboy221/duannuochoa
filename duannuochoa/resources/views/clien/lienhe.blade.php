@extends('layouts.app')
@section('content')
    <main class="pt-24">
        <!-- Hero Section -->
        <section class="relative h-[409px] min-h-[400px] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover"
                    data-alt="abstract dynamic background with flowing deep blue and electric teal gradients representing kinetic energy and motion"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBUGMFJJL76hjvN3UU2dliT3oN70xmxWTVmp1O_uqCq6raVRUA8pNZuLY2YMmtnXzTNKqIdKPUXtrilswBQ9XC4e2P7itSG6_N_CPlUEvjJ15oB1_0rYObVDltsbwydMy4b8yV7qC8QZmDDcuWTbnMuQ_eLEQ4kMS9GbN0IKbqQWktGwMCz6PX66mnM_T25sGxiAk-IPWzWW0QmD5saGpVa_tATmOY1K4pIBJnAlSVHk3ElMSwCXpRPryHKrqpzmA4BBtn2S1stN30z" />
                <div class="absolute inset-0 bg-primary/20 mix-blend-multiply"></div>
            </div>
            <div class="relative z-10 text-center px-6">
                <span class="text-tertiary-fixed font-bold tracking-[0.2em] uppercase text-sm mb-4 block">KINETIC
                    VITALITY</span>
                <h1 class="font-headline text-5xl md:text-7xl font-extrabold text-white tracking-tighter mb-6">Liên Hệ
                    Với X-MEN</h1>
                <p class="text-on-primary text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                    Khám phá sức mạnh bản lĩnh và năng lượng bứt phá. Chúng tôi luôn sẵn sàng lắng nghe mọi phản hồi của
                    bạn.
                </p>
            </div>
        </section>
        <!-- Contact Content & Info Bento Grid -->
        <section class="max-w-7xl mx-auto px-6 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Contact Form Card -->
                <div class="lg:col-span-7 bg-surface-container-lowest rounded-lg p-8 md:p-12 shadow-2xl shadow-blue-900/5">
                    <h2 class="font-headline text-3xl font-bold text-primary mb-8">Gửi tin nhắn cho chúng tôi</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-on-surface-variant ml-4">Họ và Tên</label>
                                <input
                                    class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none"
                                    placeholder="Nguyễn Văn A" type="text" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-on-surface-variant ml-4">Địa chỉ Email</label>
                                <input
                                    class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none"
                                    placeholder="name@example.com" type="email" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant ml-4">Chủ đề</label>
                            <input
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none"
                                placeholder="Tôi muốn hỏi về..." type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-on-surface-variant ml-4">Lời nhắn</label>
                            <textarea
                                class="w-full bg-surface-container-high border-none rounded-md px-6 py-4 focus:ring-2 focus:ring-primary/20 focus:bg-surface-container-lowest transition-all outline-none resize-none"
                                placeholder="Chia sẻ ý kiến của bạn tại đây..." rows="5"></textarea>
                        </div>
                        <button
                            class="w-full md:w-auto primary-gradient text-on-primary font-bold px-12 py-4 rounded-xl scale-100 hover:scale-[1.02] active:scale-95 transition-all shadow-lg shadow-primary/20"
                            type="submit">
                            Gửi Ngay
                        </button>
                    </form>
                </div>
                <!-- Info & Socials -->
                <div class="lg:col-span-5 space-y-8">
                    <!-- Store Info -->
                    <div class="bg-surface-container-low rounded-lg p-8 md:p-10 border border-white/50 backdrop-blur-sm">
                        <h3 class="font-headline text-2xl font-bold text-primary mb-8">Thông Tin Cửa Hàng</h3>
                        <div class="space-y-8">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary"
                                        data-icon="location_on">location_on</span>
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">Địa chỉ</p>
                                    <p class="text-on-surface-variant leading-relaxed">Tòa nhà Landmark 81, 720A Điện
                                        Biên Phủ, Phường 22, Quận Bình Thạnh, TP. Hồ Chí Minh</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary" data-icon="call">call</span>
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">Hotline</p>
                                    <p class="text-on-surface-variant">1900 123 456</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-primary-container/20 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-primary"
                                        data-icon="schedule">schedule</span>
                                </div>
                                <div>
                                    <p class="font-bold text-on-surface">Giờ làm việc</p>
                                    <p class="text-on-surface-variant">Thứ 2 - Chủ Nhật: 09:00 - 22:00</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-12 pt-8 border-t border-primary/10">
                            <p class="font-bold text-on-surface mb-6">Theo dõi chúng tôi</p>
                            <div class="flex gap-4">
                                <a class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300"
                                    href="#">
                                    <span class="material-symbols-outlined" data-icon="facebook">social_leaderboard</span>
                                </a>
                                <a class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300"
                                    href="#">
                                    <span class="material-symbols-outlined" data-icon="share">share</span>
                                </a>
                                <a class="w-12 h-12 rounded-full bg-surface-container-highest flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all duration-300"
                                    href="#">
                                    <span class="material-symbols-outlined" data-icon="video_library">video_library</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Small Map Placeholder Bento Item -->
                    <div class="relative rounded-lg overflow-hidden h-[240px] group shadow-xl">
                        <img class="w-full h-full object-cover grayscale brightness-50 group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700"
                            data-alt="stylized top-down map view of a modern urban city center with glowing blue transit lines and clean minimalist aesthetics"
                            data-location="Ho Chi Minh City"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwx3yejwMOG9VBGFUNqcnHZY3T7PlILg1EZKooZjp_T9vSAWdOH3x-cHARA7GKYf9Agj9iUQZEQtZBZc9dwED_UujaPEITRuDKNDmg4nMSVHYL5qtuuOZwMslRBZgHd3CcjOMoZ5ohWujcO-WeJukryCoDA9DRKuLI5wNaTvkm9x2Fb_am8NDhQLgPfXHS6zHAEidXtmKybzW7DtUKmKyV1F5qeD4Id0GNAT0QHXwWsfEm8y6c5SFPiatASGsu3YzkKIyxOJiz_vfs" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="bg-white/90 backdrop-blur-md px-6 py-3 rounded-full flex items-center gap-2 shadow-xl">
                                <span class="material-symbols-outlined text-primary" data-icon="explore">explore</span>
                                <span class="text-sm font-bold text-primary">Xem bản đồ tương tác</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter / CTA -->
        <section class="bg-surface-container-low py-20 px-6">
            <div
                class="max-w-5xl mx-auto bg-white rounded-lg p-12 text-center shadow-2xl shadow-blue-900/5 relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
                <h2 class="font-headline text-3xl font-extrabold text-on-surface mb-4">Tham gia cộng đồng X-MEN</h2>
                <p class="text-on-surface-variant mb-10 max-w-lg mx-auto">Đăng ký nhận bản tin để cập nhật những bộ sưu
                    tập mới nhất và ưu đãi đặc quyền.</p>
                <div class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                    <input
                        class="flex-1 bg-surface-container-low border-none rounded-md px-6 py-4 outline-none focus:ring-2 focus:ring-primary/20"
                        placeholder="Email của bạn" type="email" />
                    <button class="primary-gradient text-on-primary font-bold px-8 py-4 rounded-xl">Đăng ký</button>
                </div>
            </div>
        </section>
    </main>

@endsection