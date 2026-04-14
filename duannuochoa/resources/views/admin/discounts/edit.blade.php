@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Voucher</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.discounts.update', $discount) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4 text-error">@if ($errors->any()) {{ $errors->first() }} @endif</div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Mã Voucher (Code)</label>
                <input type="text" name="code" value="{{ $discount->code }}" class="w-full rounded-lg border-gray-300 p-3" required>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Giá trị giảm</label>
                    <input type="number" name="discount_value" value="{{ $discount->discount_value }}" class="w-full rounded-lg border-gray-300 p-3" required min="0">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Loại giảm</label>
                    <select name="discount_type" class="w-full rounded-lg border-gray-300 p-3" required>
                        <option value="percent" {{ $discount->discount_type == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                        <option value="fixed" {{ $discount->discount_type == 'fixed' ? 'selected' : '' }}>Cố định (VNĐ)</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                <input type="number" name="min_order_value" value="{{ $discount->min_order_value }}" class="w-full rounded-lg border-gray-300 p-3">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Từ ngày</label>
                    <input type="datetime-local" name="valid_from" value="{{ \Carbon\Carbon::parse($discount->valid_from)->format('Y-m-d\TH:i') }}" class="w-full rounded-lg border-gray-300 p-3" required>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Đến ngày</label>
                    <input type="datetime-local" name="valid_to" value="{{ \Carbon\Carbon::parse($discount->valid_to)->format('Y-m-d\TH:i') }}" class="w-full rounded-lg border-gray-300 p-3" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Giới hạn số lần dùng</label>
                <input type="number" name="usage_limit" value="{{ $discount->usage_limit }}" class="w-full rounded-lg border-gray-300 p-3" min="1">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.discounts.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
