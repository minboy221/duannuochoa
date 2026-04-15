@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Thêm Voucher Mới</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.discounts.store') }}" method="POST" novalidate>
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Mã Voucher (Code)</label>
                <input type="text" name="code" value="{{ old('code') }}" class="w-full rounded-lg border-gray-300 p-3" uppercase>
                @error('code') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Giá trị giảm</label>
                    <input type="text" name="discount_value" value="{{ old('discount_value') ? number_format((float)str_replace(',', '', old('discount_value'))) : '' }}" class="currency-input w-full rounded-lg border-gray-300 p-3" required min="0">
                    @error('discount_value') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Loại giảm</label>
                    <select name="discount_type" class="w-full rounded-lg border-gray-300 p-3">
                        <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Cố định (VNĐ)</option>
                    </select>
                    @error('discount_type') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                <input type="text" name="min_order_value" value="{{ old('min_order_value') ? number_format((float)str_replace(',', '', old('min_order_value'))) : '0' }}" class="currency-input w-full rounded-lg border-gray-300 p-3" required min="0">
                @error('min_order_value') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Từ ngày</label>
                    <input type="datetime-local" name="valid_from" value="{{ old('valid_from') }}" class="w-full rounded-lg border-gray-300 p-3">
                    @error('valid_from') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Đến ngày</label>
                    <input type="datetime-local" name="valid_to" value="{{ old('valid_to') }}" class="w-full rounded-lg border-gray-300 p-3">
                    @error('valid_to') <span class="text-error text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Số xu yêu cầu để đổi (Để trống hoặc bằng 0 nếu miễn phí)</label>
                <input type="number" name="points_required" value="{{ old('points_required', 0) }}" class="w-full rounded-lg border-gray-300 p-3" min="0">
                @error('points_required') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Giới hạn số lần dùng (để trống nếu không giới hạn)</label>
                <input type="number" name="usage_limit" value="{{ old('usage_limit') }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('usage_limit') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Voucher</button>
                <a href="{{ route('admin.discounts.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
