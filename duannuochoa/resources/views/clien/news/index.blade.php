@extends('layouts.app')

@section('content')
    <main class="pt-32 pb-20 max-w-7xl mx-auto px-6 lg:px-12 min-h-[60vh]">
        <!-- Header Section -->
        <div class="space-y-4 mb-16 text-center max-w-3xl mx-auto">
            <h1 class="text-5xl font-extrabold text-primary tracking-tight font-headline">Tin Tức & Xu Hướng</h1>
            <p class="text-on-surface-variant text-lg leading-relaxed italic">Cập nhật những bí quyết làm đẹp, xu hướng mùi hương và tin tức mới nhất từ X-MEN.</p>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($articles as $article)
                <article class="group flex flex-col bg-white rounded-[2rem] overflow-hidden hover:shadow-2xl transition-all duration-500 border border-slate-100 h-full">
                    <div class="aspect-[16/10] overflow-hidden relative">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest text-primary shadow-sm border border-slate-100">Cân bằng</span>
                        </div>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col space-y-4">
                        <div class="flex items-center gap-3 text-xs font-bold text-slate-400 uppercase tracking-tighter">
                            <span>{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}</span>
                            <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                            <span>Bởi: {{ $article->author->full_name }}</span>
                        </div>
                        
                        <h2 class="text-2xl font-black text-slate-800 leading-tight group-hover:text-primary transition-colors">
                            <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                        </h2>
                        
                        <p class="text-on-surface-variant text-sm leading-relaxed line-clamp-3 italic flex-1">
                            {{ $article->summary ?? Str::limit(strip_tags($article->content), 120) }}
                        </p>
                        
                        <div class="pt-4 mt-auto border-t border-slate-50">
                            <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center gap-2 text-primary font-black text-xs uppercase tracking-widest hover:gap-4 transition-all">
                                Xem chi tiết
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full py-20 text-center space-y-4 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200">
                    <span class="material-symbols-outlined text-6xl text-slate-200">newspaper</span>
                    <p class="text-slate-400 font-bold">Hiện chưa có tin tức nào được cập nhật.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $articles->links() }}
            </div>
        @endif
    </main>
@endsection
