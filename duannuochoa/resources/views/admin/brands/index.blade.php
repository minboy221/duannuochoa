@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Nhãn hàng</h2>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition-all">
            <span class="material-symbols-outlined">add</span> Thêm Nhãn hàng
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Logo</th>
                    <th class="px-6 py-4">Tên Nhãn hàng</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($brands as $brand)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 font-bold">{{ $brand->brand_id }}</td>
                    <td class="px-6 py-4">
                        @if($brand->logo_url)
                            <img src="{{ $brand->logo_url }}" alt="Logo" class="w-12 h-12 object-cover rounded">
                        @else
                            <span class="text-xs text-gray-400">Không có ảnh</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-medium text-primary">{{ $brand->name }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
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
