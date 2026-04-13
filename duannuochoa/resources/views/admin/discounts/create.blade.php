@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Thêm Voucher Mới</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.discounts.store') }}" method="POST">
            @csrf
            <div class="mb-4 text-error">@if ($errors->any()) {{ $errors->first() }} @endif</div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Mã Voucher (Code)</label>
                <input type="text" name="code" class="w-full rounded-lg border-gray-300 p-3" required uppercase>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Giá trị giảm</label>
                    <input type="number" name="discount_value" class="w-full rounded-lg border-gray-300 p-3" required min="0">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Loại giảm</label>
                    <select name="discount_type" class="w-full rounded-lg border-gray-300 p-3" required>
                        <option value="percent">Phần trăm (%)</option>
                        <option value="fixed">Cố định (VNĐ)</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Giá trị đơn hàng tối thiểu (VNĐ)</label>
                <input type="number" name="min_order_value" class="w-full rounded-lg border-gray-300 p-3" value="0">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Từ ngày</label>
                    <input type="datetime-local" name="valid_from" class="w-full rounded-lg border-gray-300 p-3" required>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Đến ngày</label>
                    <input type="datetime-local" name="valid_to" class="w-full rounded-lg border-gray-300 p-3" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Giới hạn số lần dùng (để trống nếu không giới hạn)</label>
                <input type="number" name="usage_limit" class="w-full rounded-lg border-gray-300 p-3" min="1">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Voucher</button>
                <a href="{{ route('admin.discounts.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
