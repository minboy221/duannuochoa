@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Biến thể</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.variants.update', $variant) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4 text-error">@if ($errors->any()) {{ $errors->first() }} @endif</div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Dung tích (ml)</label>
                    <input type="number" name="volume_id" value="{{ $variant->volume_id }}" class="w-full rounded-lg border-gray-300 p-3" required min="1">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Màu sắc (Không bắt buộc)</label>
                    <input type="text" name="color" value="{{ $variant->color }}" class="w-full rounded-lg border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Giá bán (VNĐ)</label>
                    <input type="number" name="price" value="{{ $variant->price }}" class="w-full rounded-lg border-gray-300 p-3" required min="0">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Số lượng tồn kho</label>
                    <input type="number" name="stock_quantity" value="{{ $variant->stock_quantity }}" class="w-full rounded-lg border-gray-300 p-3" required min="0">
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.products.variants.index', $variant->product_id) }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
