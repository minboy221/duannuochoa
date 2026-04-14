@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Thêm Phương thức Vận chuyển</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.shipping-methods.store') }}" method="POST">
            @csrf
            <div class="mb-4 text-error">@if ($errors->any()) {{ $errors->first() }} @endif</div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Đơn vị / Phương thức</label>
                <input type="text" name="name" class="w-full rounded-lg border-gray-300 p-3" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Phí Vận chuyển (VNĐ)</label>
                <input type="text" name="fee" class="currency-input w-full rounded-lg border-gray-300 p-3" required>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Phương thức</button>
                <a href="{{ route('admin.shipping-methods.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
