@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Chỉnh sửa Danh mục</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Danh mục</label>
                <input type="text" name="name" value="{{ $category->name }}" class="w-full rounded-lg border-gray-300 p-3" required>
                @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Mô tả</label>
                <textarea name="description" class="w-full rounded-lg border-gray-300 p-3" rows="4">{{ $category->description }}</textarea>
                @error('description') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
