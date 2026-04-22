@extends('layouts.app')
@section('content')
    <main class="pt-24 pb-20 px-4 md:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3 space-y-4">
                <div class="bg-surface-container-low p-6 rounded-lg sticky top-28">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="relative group">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary-container flex items-center justify-center text-on-primary text-xl font-bold shadow-lg overflow-hidden border-2 border-white">
                                <img alt="Avatar" class="w-full h-full object-cover"
                                    src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->full_name) . '&background=0052d0&color=fff' }}" />
                            </div>
                        </div>
                        <div>
                            <h2 class="font-headline font-bold text-lg leading-tight">Chào, {{ Auth::user()->full_name }}</h2>
                            <p class="text-sm text-on-surface-variant">Thành viên mới</p>
                        </div>
                    </div>
                    <nav class="space-y-2">
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="{{ route('taikhoan') }}">
                            <span class="material-symbols-outlined">person_outline</span>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl bg-surface-container-lowest text-primary font-bold transition-all shadow-sm"
                            href="{{ route('lichsu') }}">
                            <span class="material-symbols-outlined">history</span>
                            <span>Lịch sử đơn hàng</span>
                        </a>
                        <a class="flex items-center space-x-3 p-4 rounded-xl hover:bg-surface-container-high transition-all text-on-surface-variant font-medium"
                            href="{{ route('taikhoan') }}#settings">
                            <span class="material-symbols-outlined">settings</span>
                            <span>Cài đặt tài khoản</span>
                        </a>
                        <div class="pt-4 mt-4 border-t border-outline-variant/20">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 p-4 rounded-xl hover:text-error transition-all text-on-surface-variant font-medium text-left">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="lg:col-span-9">
                <header class="mb-10">
                    <h1 class="text-4xl font-extrabold tracking-tight text-primary mb-2">Lịch sử đơn hàng</h1>
                    <p class="text-on-surface-variant">Theo dõi và quản lý các đơn hàng của bạn.</p>
                </header>

                <!-- Orders List -->
                <div class="space-y-6">
                    @forelse($orders as $order)
                        <div class="bg-surface-container-lowest rounded-2xl overflow-hidden transition-all hover:shadow-xl border border-outline-variant/10 shadow-sm">
                            <div class="p-6 border-b border-surface-container flex justify-between items-center bg-surface-container-low/30">
                                <div class="flex gap-8">
                                    <div>
                                        <p class="text-[10px] font-bold text-outline uppercase tracking-wider mb-1">Mã đơn hàng</p>
                                        <p class="font-headline font-bold text-on-surface">#{{ $order->order_id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-outline uppercase tracking-wider mb-1">Ngày đặt</p>
                                        <p class="font-medium text-on-surface">{{ $order->created_at->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                @php
                                    $statusStyle = match($order->status) {
                                        'Chờ xác nhận' => 'bg-amber-100 text-amber-700 border-amber-200',
                                        'Đã xác nhận' => 'bg-blue-100 text-blue-700 border-blue-200',
                                        'Đang chuẩn bị hàng' => 'bg-purple-100 text-purple-700 border-purple-200',
                                        'Đang giao' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                        'Đã giao hàng' => 'bg-cyan-100 text-cyan-700 border-cyan-200',
                                        'Đã hoàn thành' => 'bg-green-100 text-green-700 border-green-200',
                                        'Đã hủy' => 'bg-red-100 text-red-700 border-red-200',
                                        'Yêu cầu trả hàng' => 'bg-orange-100 text-orange-700 border-orange-200',
                                        'Trả hàng/Hoàn tiền' => 'bg-rose-100 text-rose-700 border-rose-200',
                                        default => 'bg-slate-100 text-slate-700 border-slate-200'
                                    };
                                @endphp
                                <span class="px-4 py-1.5 rounded-full border {{ $statusStyle }} text-xs font-black uppercase tracking-widest shadow-sm">
                                    {{ $order->status }}
                                </span>
                            </div>
                            
                            @if($order->status == 'Đã hủy' && $order->cancel_reason)
                                <div class="px-6 py-3 bg-red-50/50 border-b border-red-100 flex items-center gap-3">
                                    <span class="material-symbols-outlined text-red-500 text-sm">info</span>
                                    <p class="text-xs text-red-700 font-medium italic">Lý do hủy: {{ $order->cancel_reason }}</p>
                                </div>
                            @endif

                            @if($order->status == 'Yêu cầu trả hàng' && $order->return_reason)
                                <div class="px-6 py-3 bg-orange-50/50 border-b border-orange-100 flex items-center gap-3">
                                    <span class="material-symbols-outlined text-orange-500 text-sm">assignment_return</span>
                                    <p class="text-xs text-orange-700 font-medium italic">Lý do trả hàng: {{ $order->return_reason }}</p>
                                </div>
                            @endif
                            
                            <div class="p-6 space-y-4">
                                @foreach($order->orderItems as $item)
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 rounded-xl bg-surface-container-low overflow-hidden flex-shrink-0 border border-outline-variant/10">
                                            <img src="{{ $item->variant->product->img ? asset('storage/' . $item->variant->product->img) : 'https://images.unsplash.com/photo-1541643600914-78b084683601?auto=format&fit=crop&w=200&q=80' }}" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-on-surface">{{ $item->variant->product->name }}</h3>
                                            <p class="text-on-surface-variant text-xs">Dung tích: {{ $item->variant->volume_id }}ml | Số lượng: {{ $item->quantity }}</p>
                                        </div>
                                        <div class="flex flex-col items-end gap-2">
                                            <p class="font-bold text-primary">{{ number_format($item->price) }}đ</p>
                                            @if($order->status == 'Đã hoàn thành')
                                                @if(in_array($item->variant->product_id, $reviewedProductIds))
                                                    <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded-lg border border-green-100 flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[10px]">check_circle</span>
                                                        Đã đánh giá
                                                    </span>
                                                @else
                                                    <button type="button" 
                                                            class="review-modal-btn text-[10px] font-black uppercase tracking-widest text-white bg-amber-500 hover:bg-amber-600 px-3 py-1.5 rounded-lg shadow-md hover:shadow-amber-200/50 transition-all active:scale-95"
                                                            data-product-id="{{ $item->variant->product_id }}"
                                                            data-product-name="{{ $item->variant->product->name }}">
                                                        Đánh giá
                                                    </button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="p-6 bg-surface-container-low/50 flex justify-between items-center">
                                <div class="text-on-surface">
                                    <span class="text-sm font-medium">Tổng thanh toán:</span>
                                    <span class="text-xl font-black ml-2 text-primary">{{ number_format($order->total_amount) }}đ</span>
                                </div>
                                <div class="flex gap-4">
                                    <a href="{{ route('donhang.show', $order->order_id) }}" class="px-6 py-3 rounded-xl font-bold text-on-surface-variant bg-surface-container-highest hover:bg-surface-container-high transition-all text-sm flex items-center justify-center">
                                        Chi tiết
                                    </a>

                                    @if(in_array($order->status, ['Đang giao', 'Đã giao hàng']))
                                        <form action="{{ route('donhang.received', $order->order_id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-green-600 shadow-lg hover:bg-green-700 transition-all text-sm">
                                                Đã nhận hàng
                                            </button>
                                        </form>
                                    @endif

                                    @if($order->status == 'Đã hoàn thành')
                                        <button type="button" 
                                                class="return-modal-btn px-6 py-3 rounded-xl font-bold text-error border-2 border-error/10 hover:bg-error/5 transition-all text-sm"
                                                data-order-id="{{ $order->order_id }}">
                                            Trả hàng
                                        </button>
                                    @endif

                                    @if(in_array($order->status, ['Đã giao hàng', 'Đã hoàn thành', 'Đã hủy']))
                                        <button class="px-8 py-3 rounded-xl font-bold text-white bg-primary shadow-lg hover:scale-105 active:scale-95 transition-all text-sm">
                                            Mua lại
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20 bg-surface-container-lowest rounded-2xl border border-dashed border-outline-variant/30">
                            <span class="material-symbols-outlined text-6xl text-outline-variant mb-4">receipt_long</span>
                            <p class="text-on-surface-variant font-medium">Bạn chưa có đơn hàng nào.</p>
                            <a href="{{ route('sanpham') }}" class="inline-block mt-6 text-primary font-bold hover:underline underline-offset-4">Khám phá sản phẩm ngay</a>
                        </div>
                    @endforelse
                </div>
                
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Return Request Modal -->
    <div id="return-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-300">
        <div class="bg-white w-full max-w-lg rounded-[2rem] shadow-2xl overflow-hidden animate-in zoom-in-95 duration-500">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-slate-800 font-headline">Yêu cầu trả hàng</h3>
                    <button id="close-return-modal" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form id="return-form" action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Lý do trả hàng/hoàn tiền</label>
                        <textarea name="return_reason" rows="4" required
                                  class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none resize-none text-sm font-medium"
                                  placeholder="Vui lòng cho chúng tôi biết lý do bạn muốn trả hàng..."></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Hình ảnh bằng chứng (nếu có)</label>
                        <div class="relative group">
                            <input type="file" name="return_image" id="return_image" accept="image/*" class="hidden">
                            <label for="return_image" class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50 hover:bg-slate-100 hover:border-primary/30 transition-all cursor-pointer overflow-hidden">
                                <div id="preview-container" class="hidden w-full h-full relative">
                                    <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-xs font-bold uppercase tracking-widest">Thay đổi ảnh</span>
                                    </div>
                                </div>
                                <div id="upload-placeholder" class="flex flex-col items-center gap-2">
                                    <span class="material-symbols-outlined text-4xl text-slate-300">add_a_photo</span>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Chọn ảnh bằng chứng</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-error text-white py-4 rounded-xl font-bold text-lg shadow-xl shadow-error/30 hover:shadow-error/40 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Gửi yêu cầu ngay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div id="review-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm animate-in fade-in duration-300">
        <div class="bg-white w-full max-w-lg rounded-[2rem] shadow-2xl overflow-hidden animate-in zoom-in-95 duration-500">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-slate-800 font-headline">Đánh giá sản phẩm</h3>
                    <button id="close-review-modal" class="text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form action="{{ route('review.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="product_id" id="modal-product-id">
                    
                    <div class="bg-slate-50 p-4 rounded-2xl flex items-center gap-4 mb-4 border border-slate-100">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined">package_2</span>
                        </div>
                        <p id="modal-product-name" class="font-bold text-slate-700 text-sm"></p>
                    </div>

                    <div class="space-y-2 text-center py-4">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest block mb-2">Chất lượng sản phẩm</label>
                        <div class="flex justify-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-radio" required>
                                    <span class="material-symbols-outlined text-4xl text-slate-200 group-hover:text-amber-400 transition-colors star-icon" data-value="{{ $i }}">star</span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest block">Nhận xét của bạn</label>
                        <textarea name="content" rows="4" required
                                  class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all outline-none resize-none text-sm font-medium"
                                  placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm nhé..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold text-lg shadow-xl shadow-primary/30 hover:shadow-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all">
                        Gửi đánh giá ngay
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('review-modal');
            const closeBtn = document.getElementById('close-review-modal');
            const openBtns = document.querySelectorAll('.review-modal-btn');
            const productIdInput = document.getElementById('modal-product-id');
            const productNameDisplay = document.getElementById('modal-product-name');
            const starIcons = document.querySelectorAll('.star-icon');
            const ratingRadios = document.querySelectorAll('.rating-radio');

            openBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    productIdInput.value = this.dataset.productId;
                    productNameDisplay.textContent = this.dataset.productName;
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            });

            closeBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            });

            // Return Modal Logic
            const returnModal = document.getElementById('return-modal');
            const closeReturnBtn = document.getElementById('close-return-modal');
            const openReturnBtns = document.querySelectorAll('.return-modal-btn');
            const returnForm = document.getElementById('return-form');

            openReturnBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    returnForm.action = `/don-hang/${orderId}/yeu-cau-tra-hang`;
                    returnModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            });

            closeReturnBtn.addEventListener('click', function() {
                returnModal.classList.add('hidden');
                document.body.style.overflow = '';
                // Reset preview
                const previewContainer = document.getElementById('preview-container');
                const placeholder = document.getElementById('upload-placeholder');
                const imagePreview = document.getElementById('image-preview');
                const fileInput = document.getElementById('return_image');
                
                previewContainer.classList.add('hidden');
                placeholder.classList.remove('hidden');
                imagePreview.src = '#';
                fileInput.value = '';
            });

            // Image Preview logic
            const returnImageInput = document.getElementById('return_image');
            if (returnImageInput) {
                returnImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        const previewContainer = document.getElementById('preview-container');
                        const placeholder = document.getElementById('upload-placeholder');
                        const imagePreview = document.getElementById('image-preview');

                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            previewContainer.classList.remove('hidden');
                            placeholder.classList.add('hidden');
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Star Rating Logic
            starIcons.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.dataset.value);
                    updateStars(value);
                });

                star.addEventListener('mouseover', function() {
                    const value = parseInt(this.dataset.value);
                    previewStars(value);
                });

                star.addEventListener('mouseout', function() {
                    const checkedRadio = document.querySelector('.rating-radio:checked');
                    if (checkedRadio) {
                        updateStars(parseInt(checkedRadio.value));
                    } else {
                        resetStars();
                    }
                });
            });

            function updateStars(value) {
                starIcons.forEach(s => {
                    const sValue = parseInt(s.dataset.value);
                    if (sValue <= value) {
                        s.style.fontVariationSettings = "'FILL' 1";
                        s.classList.remove('text-slate-200');
                        s.classList.add('text-amber-400');
                    } else {
                        s.style.fontVariationSettings = "'FILL' 0";
                        s.classList.remove('text-amber-400', 'text-slate-200');
                        s.classList.add('text-slate-200');
                    }
                });
            }

            function previewStars(value) {
                starIcons.forEach(s => {
                    const sValue = parseInt(s.dataset.value);
                    if (sValue <= value) {
                        s.classList.add('text-amber-300');
                        s.classList.remove('text-slate-200');
                    } else {
                        s.classList.remove('text-amber-300');
                    }
                });
            }

            function resetStars() {
                starIcons.forEach(s => {
                    s.style.fontVariationSettings = "'FILL' 0";
                    s.classList.remove('text-amber-400', 'text-amber-300');
                    s.classList.add('text-slate-200');
                });
            }
        });
    </script>
@endsection