@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Tài khoản</h2>
        </div>
        <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition-all">
            <span class="material-symbols-outlined">add</span> Thêm Tài khoản
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Tên người dùng</th>
                    <th class="px-6 py-4">Email / SĐT</th>
                    <th class="px-6 py-4">Vai trò</th>
                    <th class="px-6 py-4">Trạng thái</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 font-bold">{{ $user->user_id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-primary">{{ $user->full_name }}</div>
                        <div class="text-xs text-on-surface-variant">{{ $user->username }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div>{{ $user->email }}</div>
                        <div class="text-xs">{{ $user->phone }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-primary-container/20 text-primary text-xs font-bold rounded-full">
                            {{ $user->role ? $user->role->role_name : 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Hoạt động</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Bị khóa</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors" title="Xem chi tiết">
                            <span class="material-symbols-outlined text-xl">visibility</span>
                        </a>
                        @if(auth()->id() !== $user->user_id)
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn {{ $user->is_active ? "khóa" : "mở khóa" }} tài khoản này?');">
                            @csrf
                            <button class="p-2 {{ $user->is_active ? 'hover:bg-error/10 text-error' : 'hover:bg-green-100 text-green-700' }} rounded-lg transition-colors" title="{{ $user->is_active ? 'Khóa tài khoản' : 'Mở khóa tài khoản' }}">
                                <span class="material-symbols-outlined text-xl">{{ $user->is_active ? 'lock' : 'lock_open' }}</span>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
