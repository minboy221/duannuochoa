@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Thêm Sản phẩm Mới (Hương thơm mới)</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-3xl">
        <form action="{{ route('admin.products.store') }}" method="POST" novalidate>
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Sản phẩm</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Danh mục</label>
                    <select name="category_id" class="w-full rounded-lg border-gray-300 p-3">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Thương hiệu</label>
                    <select name="brand_id" class="w-full rounded-lg border-gray-300 p-3">
                        <option value="">-- Chọn nhãn hàng --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}" {{ old('brand_id') == $brand->brand_id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Giá cơ bản (VNĐ) - Dùng để tham khảo</label>
                <input type="text" name="base_price" class="currency-input w-full rounded-lg border-gray-300 p-3" required min="0" value="{{ old('base_price') ? number_format((float)str_replace(',', '', old('base_price'))) : '0' }}">
                @error('base_price') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Trạng thái Hiển thị Trang chủ</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary h-5 w-5">
                        <span class="text-on-surface">Sản phẩm Nổi bật</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary h-5 w-5">
                        <span class="text-on-surface">Sản phẩm Bán chạy</span>
                    </label>
                </div>
            </div>


            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Bài viết Mô tả hương thơm</label>
                <textarea name="description" class="w-full rounded-lg border-gray-300 p-3" rows="6">{{ old('description') }}</textarea>
                @error('description') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
