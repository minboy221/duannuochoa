@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Mã giảm giá (Voucher)</h2>
        </div>
        <a href="{{ route('admin.discounts.create') }}" class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition-all">
            <span class="material-symbols-outlined">add</span> Thêm Voucher
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">{{ session('success') }}</div>
    @endif

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.discounts.index') }}" class="mb-6 flex gap-4 bg-surface-container-lowest p-4 rounded-xl shadow-sm border border-surface-container">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm voucher theo mã code..." class="flex-1 bg-surface-container-low border-none rounded-lg px-4 py-2 text-on-background placeholder-on-surface-variant focus:ring-2 focus:ring-primary">
        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold hover:bg-primary/90 transition-colors">Tìm kiếm</button>
        @if(request('search'))
            <a href="{{ route('admin.discounts.index') }}" class="bg-surface-container-high text-on-surface px-6 py-2 rounded-lg font-bold hover:bg-surface-container-highest transition-colors flex items-center justify-center">Xóa lọc</a>
        @endif
    </form>

    <div class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                    <th class="px-6 py-4">Mã Code</th>
                    <th class="px-6 py-4">Giá trị giảm</th>
                    <th class="px-6 py-4">Loại</th>
                    <th class="px-6 py-4">Đơn tối thiểu</th>
                    <th class="px-6 py-4">Xu yêu cầu</th>
                    <th class="px-6 py-4">Thời hạn</th>
                    <th class="px-6 py-4 text-right">Thao tác</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @foreach($discounts as $discount)
                <tr class="hover:bg-slate-50 transition-colors group">
                    <td class="px-6 py-4 font-bold text-primary">{{ $discount->code }}</td>
                    <td class="px-6 py-4 font-medium">{{ number_format($discount->discount_value) }} {{ $discount->discount_type == 'percent' ? '%' : 'VNĐ' }}</td>
                    <td class="px-6 py-4">{{ $discount->discount_type == 'percent' ? 'Phần trăm' : 'Cố định' }}</td>
                    <td class="px-6 py-4">{{ number_format($discount->min_order_value) }} đ</td>
                    <td class="px-6 py-4 font-bold text-tertiary">{{ $discount->points_required > 0 ? number_format($discount->points_required) . ' xu' : 'Miễn phí' }}</td>
                    <td class="px-6 py-4 text-sm">
                        {{ \Carbon\Carbon::parse($discount->valid_from)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($discount->valid_to)->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.discounts.edit', $discount) }}" class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </a>
                        <form action="{{ route('admin.discounts.destroy', $discount) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                            @csrf @method('DELETE')
                            <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $discounts->appends(request()->query())->links() }}
    </div>
</main>
@endsection
