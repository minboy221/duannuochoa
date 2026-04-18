@extends('layouts.app')

@section('content')
    <main class="pt-32 pb-20 max-w-7xl mx-auto px-6 lg:px-12 bg-white min-h-[60vh]">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
            <!-- Article Body -->
            <div class="lg:col-span-8 space-y-12">
                <nav class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Trang chủ</a>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <a href="{{ route('news.index') }}" class="hover:text-primary transition-colors">Tin tức</a>
                </nav>

                <header class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight font-headline">
                        {{ $article->title }}
                    </h1>
                    <div class="flex items-center gap-6 pt-4 border-y border-slate-50 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                {{ substr($article->author->full_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-800 tracking-tight">{{ $article->author->full_name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Tác giả</p>
                            </div>
                        </div>
                        <div class="h-10 w-[1px] bg-slate-100"></div>
                        <div>
                            <p class="text-sm font-black text-slate-800 tracking-tight">{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Ngày đăng</p>
                        </div>
                    </div>
                </header>

                <div class="aspect-[21/9] rounded-[3rem] overflow-hidden shadow-2xl relative">
                    <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=1200&q=80' }}" 
                         alt="{{ $article->title }}"
                         class="w-full h-full object-cover">
                </div>

                <div class="prose prose-lg max-w-none text-slate-700 leading-[2] font-medium space-y-8">
                    @if($article->summary)
                        <div class="p-8 bg-slate-50 rounded-3xl border-l-[6px] border-blue-600 italic text-slate-600 text-lg font-headline">
                            "{{ $article->summary }}"
                        </div>
                    @endif
                    
                    <div class="text-lg">
                        {!! $article->content !!}
                    </div>
                </div>

                <!-- Footer Article -->
                <div class="pt-12 border-t border-slate-100 flex justify-between items-center">
                    <div class="flex gap-4">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Chia sẻ nhanh:</span>
                        <!-- Placeholder social icons -->
                        <button class="text-slate-400 hover:text-blue-600 transition-colors"><span class="material-symbols-outlined text-lg">share</span></button>
                    </div>
                    <a href="{{ route('news.index') }}" class="text-primary font-black text-xs uppercase tracking-widest flex items-center gap-2 hover:gap-4 transition-all">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Tất cả bài viết
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 space-y-12">
                <!-- Recent News Widget -->
                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 sticky top-32">
                    <h3 class="text-xl font-black text-slate-800 mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                        Bài viết mới nhất
                    </h3>
                    
                    <div class="space-y-8">
                        @forelse($recentNews as $recent)
                            <a href="{{ route('news.show', $recent->slug) }}" class="group flex gap-4 items-start">
                                <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0">
                                    <img src="{{ $recent->image ? asset('storage/' . $recent->image) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" 
                                         alt="{{ $recent->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 leading-snug">
                                        {{ $recent->title }}
                                    </h4>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">
                                        {{ \Carbon\Carbon::parse($recent->created_at)->format('d/m/Y') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">Không có bài viết khác.</p>
                        @endforelse
                    </div>

                    <!-- Newsletter Promo -->
                    <div class="mt-12 p-6 bg-blue-600 rounded-3xl text-white space-y-4 shadow-xl shadow-blue-600/20">
                        <h4 class="text-lg font-black leading-tight">Đăng ký nhận bí quyết từ chuyên gia</h4>
                        <p class="text-xs text-blue-50/70 font-medium">Nhận ngay 10% ưu đãi cho đơn hàng tiếp theo.</p>
                        <div class="relative">
                            <input type="email" placeholder="Email của bạn" class="w-full bg-white/10 border-none rounded-xl py-3 px-4 text-xs placeholder-white/50 focus:ring-2 focus:ring-white/20 transition-all shadow-inner">
                            <button class="mt-3 w-full bg-white text-blue-600 font-black py-3 rounded-xl text-xs hover:bg-blue-50 transition-all active:scale-95 shadow-lg">Gửi ngay</button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection
