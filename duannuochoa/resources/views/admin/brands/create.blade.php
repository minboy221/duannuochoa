@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Thêm Nhãn hàng Mới</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.brands.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Nhãn hàng</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Đường dẫn / Link Logo</label>
                <input type="url" name="logo_url" value="{{ old('logo_url') }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('logo_url') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Nhãn hàng</button>
                <a href="{{ route('admin.brands.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
