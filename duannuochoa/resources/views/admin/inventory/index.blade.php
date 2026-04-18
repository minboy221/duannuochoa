@extends('layouts.admin')

@section('content')
<main class="ml-64 p-8 w-[calc(100%-16rem)]">
    <header class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Kho hàng</h2>
            <p class="text-on-surface-variant font-body">Theo dõi và cập nhật số lượng tồn kho của toàn bộ sản phẩm.</p>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-3 rounded-xl bg-surface-container-highest text-primary font-bold transition-all hover:scale-[1.02] flex items-center gap-2">
                <span class="material-symbols-outlined">download</span>
                Xuất báo cáo Kho
            </button>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 flex items-center gap-4">
            <div class="p-4 bg-primary/10 rounded-2xl text-primary">
                <span class="material-symbols-outlined text-3xl">inventory_2</span>
            </div>
            <div>
                <p class="text-sm font-medium text-on-surface-variant uppercase tracking-widest text-[10px]">Tổng số loại hàng</p>
                <h3 class="text-2xl font-black text-on-background">{{ $stats['total'] }}</h3>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 flex items-center gap-4">
            <div class="p-4 bg-amber-50 rounded-2xl text-amber-600">
                <span class="material-symbols-outlined text-3xl">warning</span>
            </div>
            <div>
                <p class="text-sm font-medium text-on-surface-variant uppercase tracking-widest text-[10px]">Sắp hết hàng (<= 10)</p>
                <h3 class="text-2xl font-black text-amber-600">{{ $stats['low_stock'] }}</h3>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 flex items-center gap-4">
            <div class="p-4 bg-red-50 rounded-2xl text-red-600">
                <span class="material-symbols-outlined text-3xl">error_outline</span>
            </div>
            <div>
                <p class="text-sm font-medium text-on-surface-variant uppercase tracking-widest text-[10px]">Đã hết hàng</p>
                <h3 class="text-2xl font-black text-red-600">{{ $stats['out_of_stock'] }}</h3>
            </div>
        </div>
    </div>

    <!-- Inventory Table Container -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <!-- Table Filter Tabs -->
        <div class="px-8 py-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
            <div class="flex gap-4">
                <a href="{{ route('admin.inventory.index') }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ !$status ? 'bg-primary text-white shadow-md' : 'text-on-surface-variant hover:bg-slate-200' }}">Tất cả</a>
                <a href="{{ route('admin.inventory.index', ['status' => 'low_stock']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ $status === 'low_stock' ? 'bg-amber-500 text-white shadow-md' : 'text-on-surface-variant hover:bg-slate-200' }}">Sắp hết hàng</a>
                <a href="{{ route('admin.inventory.index', ['status' => 'out_of_stock']) }}" class="px-6 py-2 rounded-full text-xs font-bold transition-all {{ $status === 'out_of_stock' ? 'bg-red-500 text-white shadow-md' : 'text-on-surface-variant hover:bg-slate-200' }}">Đã hết hàng</a>
            </div>
            <div class="text-[10px] font-black uppercase tracking-widest text-outline">Hiển thị {{ $variants->count() }} kết quả</div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-surface-container-low/50">
                    <tr>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest">Sản phẩm</th>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest">Danh mục</th>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest">Biến thể</th>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest">Tồn kho hiện tại</th>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest">Trạng thái</th>
                        <th class="px-8 py-4 text-[10px] font-black text-outline uppercase tracking-widest text-right">Cập nhật nhanh</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($variants as $variant)
                    <tr class="hover:bg-slate-50 transition-colors group" id="row-{{ $variant->variant_id }}">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                @if($variant->image)
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden border border-slate-100">
                                        <img src="{{ asset('storage/' . $variant->image) }}" class="w-full h-full object-cover">
                                    </div>
                                @elseif($variant->product->img)
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden border border-slate-100">
                                        <img src="{{ asset('storage/' . $variant->product->img) }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400">
                                        <span class="material-symbols-outlined">image</span>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-on-background line-clamp-1">{{ $variant->product->name }}</div>
                                    <div class="text-[10px] text-on-surface-variant uppercase font-medium tracking-tighter">{{ $variant->product->brand->name ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-xs font-bold text-primary bg-primary/5 px-3 py-1 rounded-lg">
                                {{ $variant->product->category->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col gap-1">
                                <span class="text-xs font-bold text-on-surface">Dung tích: {{ $variant->volume->name ?? $variant->volume_id }}ml</span>
                                @if($variant->color)
                                    <div class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full" style="background-color: {{ $variant->color_code ?? '#ccc' }}"></span>
                                        <span class="text-[10px] text-outline-variant font-medium">{{ $variant->color }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-2">
                                <span class="text-lg font-black text-on-background current-stock">{{ $variant->stock_quantity }}</span>
                                <span class="text-[10px] text-outline font-medium uppercase">đơn vị</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            @php
                                $statusLabel = 'Sẵn có';
                                $statusColor = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                                if ($variant->stock_quantity <= 0) {
                                    $statusLabel = 'Hết hàng';
                                    $statusColor = 'bg-red-100 text-red-700 border-red-200';
                                } elseif ($variant->stock_quantity <= 10) {
                                    $statusLabel = 'Sắp hết hàng';
                                    $statusColor = 'bg-amber-100 text-amber-700 border-amber-200';
                                }
                            @endphp
                            <span class="status-badge px-3 py-1 rounded-full text-[10px] font-black uppercase border {{ $statusColor }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end items-center gap-2">
                                <div class="relative w-24">
                                    <input type="number" 
                                           class="w-full bg-surface-container-low border-none rounded-lg py-2 px-3 text-sm font-bold text-center focus:ring-2 focus:ring-primary/20 stock-input" 
                                           value="{{ $variant->stock_quantity }}"
                                           data-id="{{ $variant->variant_id }}">
                                </div>
                                <button onclick="updateStock({{ $variant->variant_id }})" 
                                        class="p-2 bg-primary text-white rounded-lg hover:scale-110 active:scale-95 transition-all shadow-md shadow-primary/20 flex items-center justify-center update-btn">
                                    <span class="material-symbols-outlined text-sm">check</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <span class="material-symbols-outlined text-6xl text-slate-200">inventory</span>
                                <p class="text-on-surface-variant font-medium">Không tìm thấy sản phẩm nào trong kho khớp với điều kiện lọc.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-8 border-t border-slate-50 bg-slate-50/30">
            {{ $variants->appends(['status' => $status])->links() }}
        </div>
    </div>
</main>

<!-- Toaster for Notifications -->
<div id="toaster" class="fixed bottom-8 right-8 z-[100] transform translate-y-32 opacity-0 transition-all duration-500">
    <div class="bg-inverse-surface text-on-primary px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
        <span class="material-symbols-outlined text-emerald-400 status-icon">check_circle</span>
        <span class="font-bold text-sm toast-message">Cập nhật thành công!</span>
    </div>
</div>

<script>
    function updateStock(id) {
        const row = document.querySelector(`#row-${id}`);
        const input = row.querySelector('.stock-input');
        const btn = row.querySelector('.update-btn');
        const quantity = input.value;
        
        // Visual feedback
        btn.disabled = true;
        btn.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">sync</span>';
        
        fetch("{{ route('admin.inventory.updateStock') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                variant_id: id,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI smoothly
                row.querySelector('.current-stock').innerText = quantity;
                const badge = row.querySelector('.status-badge');
                badge.innerText = data.new_status;
                
                // Update badge color
                badge.className = 'status-badge px-3 py-1 rounded-full text-[10px] font-black uppercase border';
                if (quantity <= 0) {
                    badge.classList.add('bg-red-100', 'text-red-700', 'border-red-200');
                } else if (quantity <= 10) {
                    badge.classList.add('bg-amber-100', 'text-amber-700', 'border-amber-200');
                } else {
                    badge.classList.add('bg-emerald-100', 'text-emerald-700', 'border-emerald-200');
                }
                
                showToast("Đã cập nhật số lượng tồn kho!", "check_circle");
            } else {
                showToast("Có lỗi xảy ra, vui lòng thử lại.", "error");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast("Lỗi kết nối máy chủ.", "error");
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '<span class="material-symbols-outlined text-sm">check</span>';
        });
    }

    function showToast(message, icon) {
        const toaster = document.getElementById('toaster');
        const messageEl = toaster.querySelector('.toast-message');
        const iconEl = toaster.querySelector('.status-icon');
        
        messageEl.innerText = message;
        iconEl.innerText = icon;
        
        if (icon === 'error') iconEl.className = 'material-symbols-outlined text-red-400 status-icon';
        else iconEl.className = 'material-symbols-outlined text-emerald-400 status-icon';

        toaster.classList.remove('translate-y-32', 'opacity-0');
        
        setTimeout(() => {
            toaster.classList.add('translate-y-32', 'opacity-0');
        }, 3000);
    }
</script>
@endsection
