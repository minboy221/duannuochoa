@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8 flex items-center justify-between max-w-2xl">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Chi tiết Tài khoản</h2>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-surface-container rounded-lg font-bold hover:bg-gray-200 transition-colors">Quay lại</a>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Vai trò</label>
            <input type="text" value="{{ $user->role ? $user->role->role_name : 'N/A' }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Tên Đăng nhập (Username)</label>
            <input type="text" value="{{ $user->username }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Họ & Tên</label>
            <input type="text" value="{{ $user->full_name }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Email</label>
            <input type="email" value="{{ $user->email }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Số điện thoại</label>
            <input type="text" value="{{ $user->phone }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Địa chỉ</label>
            <input type="text" value="{{ $user->address }}" class="w-full rounded-lg border-gray-300 p-3 bg-gray-100 text-gray-500 font-medium" disabled>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-bold mb-2 text-gray-700">Trạng thái hoạt động</label>
            <div class="pt-2">
                @if($user->is_active)
                    <span class="px-4 py-2 bg-green-100 text-green-700 font-bold rounded-full border border-green-200">Đang Hoạt động</span>
                @else
                    <span class="px-4 py-2 bg-red-100 text-red-700 font-bold rounded-full border border-red-200">Đã Bị Khóa</span>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
