@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Sản phẩm</h2>
        </div>
        <a href="{{ route('admin.products.create') }}" class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition-all">
            <span class="material-symbols-outlined">add</span> Thêm Sản phẩm
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Hình ảnh</th>
                    <th class="px-6 py-4">Sản Phẩm</th>
                    <th class="px-6 py-4">Danh mục</th>
                    <th class="px-6 py-4">Nhãn hàng</th>
                    <th class="px-6 py-4">Giá cơ bản</th>
                    <th class="px-6 py-4 text-center">Biến thể</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($products as $product)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4">
                        @if($product->img)
                            <img src="{{ asset('storage/' . $product->img) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded-lg">
                        @else
                            <div class="w-12 h-12 bg-surface-container rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-on-surface-variant">image</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-primary">{{ $product->name }}</div>
                        <div class="text-xs text-on-surface-variant max-w-[200px] truncate">{{ $product->description }}</div>
                    </td>
                    <td class="px-6 py-4 font-medium">{{ $product->category ? $product->category->name : 'N/A' }}</td>
                    <td class="px-6 py-4 font-medium">{{ $product->brand ? $product->brand->name : 'N/A' }}</td>
                    <td class="px-6 py-4">{{ number_format($product->base_price) }} đ</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.products.variants.index', $product) }}" class="inline-flex items-center justify-center bg-secondary/10 text-secondary px-3 py-1 rounded-full text-sm font-bold hover:bg-secondary/20">
                            Quản lý Biến thể
                        </a>
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này (bao gồm tất cả biến thể)?');">
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
