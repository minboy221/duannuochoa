@extends('layouts.admin')
@section('content')
<main class="ml-64 min-h-screen p-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Cập nhật Trạng thái Đơn hàng #ORD-{{ str_pad($order->order_id, 5, '0', STR_PAD_LEFT) }}</h2>
    </div>

    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-surface-container max-w-xl">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" novalidate>
{{-- ... --}}
19:                             <input type="radio" name="status" value="{{ $status }}" class="w-5 h-5 text-primary" {{ old('status', $order->status) == $status ? 'checked' : '' }}>
                            <span class="font-medium">{{ $status }}</span>
                        </label>
                    @endforeach
                </div>
                @error('status') <span class="text-error text-sm mt-1 inline-block">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-bold w-full">Lưu Thay đổi</button>
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 rounded-lg font-bold text-on-surface-variant hover:bg-surface-container text-center w-full">Hủy</a>
            </div>
        </form>
    </div>
</main>
@endsection
