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

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Dung tích (ml)</th>
                    <th class="px-6 py-4">Màu sắc</th>
                    <th class="px-6 py-4">Giá bán</th>
                    <th class="px-6 py-4">Tồn kho</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($variants as $variant)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 font-bold">{{ $variant->variant_id }}</td>
                    <td class="px-6 py-4 font-medium">{{ $variant->volume_id }} ml</td>
                    <td class="px-6 py-4">{{ $variant->color ?? 'Không' }}</td>
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
</main>
@endsection
