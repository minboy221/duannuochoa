@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Tài khoản</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" novalidate>
            @csrf @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Vai trò</label>
                <select name="role_id" class="w-full rounded-lg border-gray-300 p-3">
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" {{ old('role_id', $user->role_id) == $role->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                    @endforeach
                </select>
                @error('role_id') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tên Đăng nhập (Username)</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('username') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Họ & Tên</label>
                <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('full_name') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-lg border-gray-300 p-3">
                @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Số điện thoại</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="w-full rounded-lg border-gray-300 p-3">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Địa chỉ</label>
                <input type="text" name="address" value="{{ $user->address }}" class="w-full rounded-lg border-gray-300 p-3">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Mật khẩu mới (Để trống nếu không đổi)</label>
                <input type="password" name="password" class="w-full rounded-lg border-gray-300 p-3">
                @error('password') <span class="text-error text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold">Lưu Thay đổi</button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
