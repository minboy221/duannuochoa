@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Biến thể của: {{ $product->name }}</h2>
            <p class="text-on-surface-variant mt-1">Quản lý theo dung tích / màu sắc</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 bg-surface-container text-on-surface-variant px-6 py-3 rounded-xl font-bold hover:bg-surface-container-high transition-all">
                <span class="material-symbols-outlined">arrow_back</span> Trở lại
            </a>
            <a href="{{ route('admin.products.variants.create', $product) }}" class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition-all">
                <span class="material-symbols-outlined">add</span> Thêm Biến thể
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.products.variants.index', $product) }}" class="mb-6 flex gap-4 bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-surface-container flex-wrap">
        <div class="flex-1 min-w-[200px]">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm theo màu sắc, mã màu..." class="w-full bg-surface-container-low border-none rounded-lg px-4 py-2 text-on-background placeholder-on-surface-variant focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Giá từ..." class="w-32 bg-surface-container-low border-none rounded-lg px-4 py-2 text-on-background placeholder-on-surface-variant focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Đến giá..." class="w-32 bg-surface-container-low border-none rounded-lg px-4 py-2 text-on-background placeholder-on-surface-variant focus:ring-2 focus:ring-primary">
        </div>
        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition-colors">Lọc</button>
        @if(request('search') || request('min_price') || request('max_price'))
            <a href="{{ route('admin.products.variants.index', $product) }}" class="bg-surface-container-high text-on-surface px-6 py-2 rounded-lg font-bold hover:bg-surface-container-highest transition-colors flex items-center justify-center">Xóa lọc</a>
        @endif
    </form>

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Ảnh</th>
                    <th class="px-6 py-4">Dung tích (ml)</th>
                    <th class="px-6 py-4 text-center">Màu sắc</th>
                    <th class="px-6 py-4">Mã màu</th>
                    <th class="px-6 py-4">Giá bán</th>
                    <th class="px-6 py-4">Tồn kho</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($variants as $variant)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center gap-3">
                            @if($variant->image)
                                <img src="{{ asset('storage/' . $variant->image) }}" class="w-12 h-12 rounded-lg object-cover border border-surface-container" alt="">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-on-surface-variant">
                                    <span class="material-symbols-outlined">image</span>
                                </div>
                            @endif
                            <span class="font-bold">#{{ $variant->variant_id }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $variant->volume_id }} ml</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex flex-col items-center gap-1">
                            @if($variant->color_code)
                                <div class="w-6 h-6 rounded-full border border-gray-300 shadow-sm" style="background-color: {{ $variant->color_code }}"></div>
                            @endif
                            <span class="text-xs">{{ $variant->color ?? 'Không' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-mono text-xs">{{ $variant->color_code ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-primary font-bold">{{ number_format($variant->price) }} đ</td>
                    <td class="px-6 py-4 font-bold {{ $variant->stock_quantity <= 5 ? 'text-error' : 'text-green-600' }}">{{ $variant->stock_quantity }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.variants.edit', $variant) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form action="{{ route('admin.variants.destroy', $variant) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa biến thể này?');">
                            @csrf @method('DELETE')
                            <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $variants->appends(request()->query())->links() }}
    </div>
</main>
@endsection
