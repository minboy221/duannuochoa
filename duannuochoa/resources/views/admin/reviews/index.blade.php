@extends('layouts.admin')

@section('content')
    <main class="flex-1 p-8 ml-64 min-h-screen bg-slate-50">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight font-headline">Quản lý Đánh giá</h2>
                    <p class="text-slate-500 font-medium mt-1">Xem và quản lý tất cả nhận xét từ khách hàng</p>
                </div>
            </div>

            <!-- Filters & Search -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <form action="{{ route('admin.reviews.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-5 relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-600 transition-colors">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="w-full bg-slate-50 border-none rounded-2xl py-3.5 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition-all font-medium"
                               placeholder="Tìm người dùng hoặc sản phẩm...">
                    </div>
                    
                    <div class="md:col-span-3">
                        <select name="rating" class="w-full bg-slate-50 border-none rounded-2xl py-3.5 px-4 text-sm focus:ring-2 focus:ring-blue-600/20 transition-all font-medium">
                            <option value="">Tất cả số sao</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 sao ★★★★★</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 sao ★★★★</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 sao ★★★</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 sao ★★</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 sao ★</option>
                        </select>
                    </div>

                    <div class="md:col-span-4 flex gap-2">
                        <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-3.5 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 active:scale-95">
                            Lọc dữ liệu
                        </button>
                        <a href="{{ route('admin.reviews.index') }}" class="px-6 py-3.5 bg-slate-100 text-slate-600 font-bold rounded-2xl hover:bg-slate-200 transition-all active:scale-95 flex items-center justify-center">
                            <span class="material-symbols-outlined">restart_alt</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Reviews Table -->
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Sản phẩm</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Người dùng</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Đánh giá</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400">Nội dung</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-slate-400 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($reviews as $review)
                        <tr class="hover:bg-slate-50/30 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-200">
                                        <img src="{{ $review->product->img ? asset('storage/' . $review->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=100&q=80' }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $review->product->name }}</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">ID: #PRO-{{ $review->product_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-black text-xs">
                                        {{ substr($review->user->full_name, 0, 1) }}
                                    </div>
                                    <p class="font-bold text-slate-700 text-sm">{{ $review->user->full_name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? 1 : 0 }};">star</span>
                                    @endfor
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="max-w-xs">
                                    <div class="mb-2">
                                        @if($review->status)
                                            <span class="bg-green-100 text-green-700 text-[10px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter">Công khai</span>
                                        @else
                                            <span class="bg-slate-100 text-slate-400 text-[10px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter italic">Đã ẩn</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-slate-600 line-clamp-2 italic font-medium">"{{ $review->content }}"</p>
                                    <p class="text-[10px] text-slate-400 mt-1 font-bold">{{ \Carbon\Carbon::parse($review->created_at)->format('H:i d/m/Y') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-right">
                                <form action="{{ route('admin.reviews.destroy', $review->review_id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có muốn {{ $review->status ? 'ẩn' : 'hiển thị' }} đánh giá này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 rounded-xl transition-all {{ $review->status ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-blue-50 text-blue-600 hover:bg-blue-100' }}" title="{{ $review->status ? 'Ẩn đánh giá' : 'Hiển thị đánh giá' }}">
                                        <span class="material-symbols-outlined">{{ $review->status ? 'visibility_off' : 'visibility' }}</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">rate_review</span>
                                    <p class="text-slate-400 font-bold">Chưa có đánh giá nào được tìm thấy.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($reviews->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100">
                    {{ $reviews->links() }}
                </div>
                @endif
            </div>
        </div>
    </main>
@endsection
