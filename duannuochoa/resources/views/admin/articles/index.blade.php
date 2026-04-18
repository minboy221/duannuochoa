@extends('layouts.admin')

@section('content')
    <main class="flex-1 p-8 ml-64 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight font-headline">Quản lý Tin tức</h2>
                    <p class="text-slate-500 font-medium mt-1">Viết và quản lý các bài viết trên trang tin tức</p>
                </div>
                <a href="{{ route('admin.articles.create') }}" class="flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                    <span class="material-symbols-outlined">add</span>
                    Viết bài mới
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-xl font-bold">{{ session('success') }}</div>
            @endif

            <!-- Search & Filters -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <form action="{{ route('admin.articles.index') }}" method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[300px] relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition-colors">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition-all font-medium"
                               placeholder="Tìm kiếm tiêu đề bài viết...">
                    </div>
                    <button type="submit" class="bg-slate-900 text-white px-8 py-3.5 rounded-2xl font-bold hover:bg-slate-800 transition-all active:scale-95">
                        Tìm kiếm
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="px-5 py-3.5 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition-all active:scale-95 flex items-center justify-center">
                        <span class="material-symbols-outlined">restart_alt</span>
                    </a>
                </form>
            </div>

            <!-- Articles List -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Hình ảnh</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Tiêu đề / Tác giả</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-center">Trạng thái</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Ngày đăng</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($articles as $article)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="w-20 h-12 rounded-lg bg-slate-100 overflow-hidden border border-slate-100">
                                    <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" 
                                         class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <p class="font-bold text-slate-800 text-sm line-clamp-1">{{ $article->title }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase mt-0.5">Bởi: {{ $article->author->full_name }}</p>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($article->status)
                                    <span class="bg-green-100 text-green-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter">Công khai</span>
                                @else
                                    <span class="bg-slate-100 text-slate-400 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-tighter italic">Bản nháp</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <p class="text-sm text-slate-600 font-medium">{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}</p>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('news.show', $article->slug) }}" target="_blank" class="p-2.5 rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition-all">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article->article_id) }}" class="p-2.5 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all">
                                        <span class="material-symbols-outlined">edit</span>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->article_id) }}" method="POST" onsubmit="return confirm('Xóa bài viết này?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">article</span>
                                    <p class="text-slate-400 font-bold">Chưa có bài viết nào được đăng.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($articles->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $articles->links() }}
                </div>
                @endif
            </div>
        </div>
    </main>
@endsection
