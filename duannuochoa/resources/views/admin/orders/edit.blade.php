@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Trạng thái Đơn hàng #ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-on-surface-variant mt-1">Thay đổi trạng thái xử lý cho đơn hàng này theo quy trình chuyên nghiệp.</p>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-surface-container max-w-2xl">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" novalidate id="order-status-form">
            @csrf
            @method('PUT')
            
            <div class="mb-8 font-['Plus_Jakarta_Sans']">
                <label class="block text-sm font-bold text-on-surface-variant mb-6 uppercase tracking-wider flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">assignment_turned_in</span>
                    Trạng thái Đơn hàng
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @php
                        $currentStatus = $order->status;
                        $transitionRules = [
                            'Chờ xác nhận' => ['Chờ xác nhận', 'Đã xác nhận', 'Đã hủy'],
                            'Đã xác nhận' => ['Đã xác nhận', 'Đang chuẩn bị hàng', 'Đã hủy'],
                            'Đang chuẩn bị hàng' => ['Đang chuẩn bị hàng', 'Đang giao', 'Đã hủy'],
                            'Đang giao' => ['Đang giao', 'Đã giao hàng', 'Đã hủy'],
                            'Đã giao hàng' => ['Đã giao hàng', 'Đã hoàn thành', 'Trả hàng/Hoàn tiền'],
                            'Đã hoàn thành' => ['Đã hoàn thành'],
                            'Đã hủy' => ['Đã hủy'],
                            'Trả hàng/Hoàn tiền' => ['Trả hàng/Hoàn tiền']
                        ];
                        $allowed = $transitionRules[$currentStatus] ?? [$currentStatus];
                        
                        $allPossibleStatuses = [
                            'Chờ xác nhận', 'Đã xác nhận', 'Đang chuẩn bị hàng', 
                            'Đang giao', 'Đã giao hàng', 'Đã hoàn thành', 
                            'Đã hủy', 'Trả hàng/Hoàn tiền'
                        ];
                    @endphp

                    @foreach($allPossibleStatuses as $status)
                        @php $isDisabled = !in_array($status, $allowed); @endphp
                        <label class="relative flex items-center space-x-4 p-4 rounded-2xl border-2 transition-all {{ $isDisabled ? 'opacity-40 cursor-not-allowed bg-surface-container-low border-transparent grayscale' : 'cursor-pointer border-surface-container hover:bg-surface-container-low has-[:checked]:border-primary has-[:checked]:bg-primary-container/10 group shadow-sm' }}">
                            <input type="radio" name="status" value="{{ $status }}" 
                                   class="w-5 h-5 text-primary border-outline focus:ring-primary/20 status-radio" 
                                   {{ old('status', $order->status) == $status ? 'checked' : '' }}
                                   {{ $isDisabled ? 'disabled' : '' }}>
                            
                            <div class="flex-grow">
                                <span class="font-bold text-sm text-on-surface group-has-[:checked]:text-primary">{{ $status }}</span>
                                @if($order->status == $status)
                                    <div class="mt-1">
                                        <span class="text-[8px] bg-primary text-white px-2 py-0.5 rounded-full uppercase font-black tracking-widest">Hiện tại</span>
                                    </div>
                                @endif
                            </div>
                            
                            @if($isDisabled)
                                <span class="material-symbols-outlined text-outline-variant text-sm">lock</span>
                            @endif
                        </label>
                    @endforeach
                </div>
                @error('status') 
                    <p class="text-error text-sm mt-4 flex items-center gap-1 font-bold">
                        <span class="material-symbols-outlined text-sm">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Cancel Reason Section -->
            <div id="cancel-reason-container" class="{{ old('status', $order->status) == 'Đã hủy' ? '' : 'hidden' }} mb-8 animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                    <label class="block text-sm font-bold text-red-900 mb-3 uppercase tracking-wider flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">report_problem</span>
                        Lý do hủy đơn hàng <span class="text-error">*</span>
                    </label>
                    <textarea name="cancel_reason" rows="3" 
                              class="w-full bg-white border-2 border-red-100 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500/20 focus:border-red-300 transition-all font-medium"
                              placeholder="Vui lòng cung cấp lý do chi tiết cho việc hủy đơn hàng này...">{{ old('cancel_reason', $order->cancel_reason) }}</textarea>
                    @error('cancel_reason') 
                        <p class="text-red-600 text-sm mt-3 flex items-center gap-1 font-bold">
                            <span class="material-symbols-outlined text-sm">warning</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-surface-container">
                <button type="submit" class="bg-primary text-white py-4 rounded-xl font-headline font-bold text-lg shadow-xl shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-all disabled:opacity-30 disabled:grayscale disabled:scale-100" 
                        {{ in_array($order->status, ['Đã hoàn thành', 'Đã hủy', 'Trả hàng/Hoàn tiền']) ? 'disabled' : '' }}>
                    Lưu thay đổi
                </button>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-center py-4 rounded-xl font-headline font-bold text-lg text-on-surface-variant hover:bg-surface-container transition-all">
                    Quay lại
                </a>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const radios = document.querySelectorAll('.status-radio');
        const reasonContainer = document.getElementById('cancel-reason-container');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'Đã hủy') {
                    reasonContainer.classList.remove('hidden');
                } else {
                    reasonContainer.classList.add('hidden');
                }
            });
        });
    });
</script>
@endsection
