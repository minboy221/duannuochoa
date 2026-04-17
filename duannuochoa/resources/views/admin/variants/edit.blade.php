@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Biến thể</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.variants.update', $variant) }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf @method('PUT')
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Dung tích (ml)</label>
                    <input type="number" name="volume_id" value="{{ old('volume_id', $variant->volume_id) }}" class="w-full rounded-lg border-gray-300 p-3">
                    @error('volume_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Màu sắc (Tên)</label>
                    <input type="text" name="color" value="{{ old('color', $variant->color) }}" placeholder="Ví dụ: Xanh đen" class="w-full rounded-lg border-gray-300 p-3">
                    @error('color') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Mã màu (Hex)</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="color_code" value="{{ old('color_code', $variant->color_code ?? '#000000') }}" class="h-12 w-20 rounded-lg border-gray-300 p-1">
                        <input type="text" id="color_hex_display" value="{{ old('color_code', $variant->color_code ?? '#000000') }}" class="w-full rounded-lg border-gray-300 p-3" readonly>
                    </div>
                    @error('color_code') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Ảnh biến thể</label>
                    <div class="flex items-center gap-4">
                        @if($variant->image)
                            <img src="{{ asset('storage/' . $variant->image) }}" class="w-16 h-16 rounded-lg object-cover border" alt="Current image">
                        @endif
                        <input type="file" name="image" class="w-full rounded-lg border-gray-300 p-2 border">
                    </div>
                    @error('image') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Giá bán (VNĐ)</label>
                    <input type="text" name="price" value="{{ old('price', $variant->price) != '' ? number_format((float)str_replace(',', '', old('price', $variant->price))) : '' }}" class="currency-input w-full rounded-lg border-gray-300 p-3" required>
                    @error('price') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Số lượng tồn kho</label>
                    <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $variant->stock_quantity) }}" class="w-full rounded-lg border-gray-300 p-3">
                    @error('stock_quantity') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.products.variants.index', $variant->product_id) }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>

<script>
    document.querySelector('input[name="color_code"]').addEventListener('input', function(e) {
        document.getElementById('color_hex_display').value = e.target.value.toUpperCase();
    });
</script>
@endsection
