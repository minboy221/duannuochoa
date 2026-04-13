@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Sản phẩm</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-3xl">
        <form action="{{ route('admin.products.update', $product) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4 text-error">@if ($errors->any()) {{ $errors->first() }} @endif</div>
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full rounded-lg border-gray-300 p-3" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Danh mục</label>
                    <select name="category_id" class="w-full rounded-lg border-gray-300 p-3" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Thương hiệu</label>
                    <select name="brand_id" class="w-full rounded-lg border-gray-300 p-3" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}" {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Giá cơ bản (VNĐ)</label>
                <input type="number" name="base_price" value="{{ $product->base_price }}" class="w-full rounded-lg border-gray-300 p-3" required min="0">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Bài viết Mô tả hương thơm</label>
                <textarea name="description" class="w-full rounded-lg border-gray-300 p-3" rows="6">{{ $product->description }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
