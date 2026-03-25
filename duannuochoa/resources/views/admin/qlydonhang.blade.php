@extends('layouts.admin')
@session('content')
    <!-- Canvas Content -->
    <section class="p-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h2 class="text-4xl font-extrabold tracking-tight text-on-surface mb-2">Quản lý Đơn hàng</h2>
                <p class="text-on-surface-variant max-w-lg">Theo dõi, quản lý và xử lý tất cả các đơn hàng nước hoa
                    từ hệ sinh thái Xmen.</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="bg-primary hover:bg-primary-dim text-on-primary px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-xl">download</span>
                    Xuất Danh sách
                </button>
            </div>
        </div>
        <!-- Stats Grid (Bento Style Lite) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary/10 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <span class="material-symbols-outlined">pending_actions</span>
                    </div>
                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">+12%</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Đang xử lý</p>
                <p class="text-2xl font-extrabold mt-1">142</p>
            </div>
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary/10 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <span
                        class="text-xs font-bold text-secondary bg-secondary-container/20 px-2 py-1 rounded-full">+5%</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Đã giao hàng</p>
                <p class="text-2xl font-extrabold mt-1">89</p>
            </div>
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary/10 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-tertiary-container/20 flex items-center justify-center text-tertiary">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="text-xs font-bold text-tertiary bg-tertiary-container/20 px-2 py-1 rounded-full">Hôm
                        nay</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Tổng Doanh thu</p>
                <p class="text-2xl font-extrabold mt-1">42.5M ₫</p>
            </div>
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary/10 transition-all">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-full bg-error-container/10 flex items-center justify-center text-error">
                        <span class="material-symbols-outlined">cancel</span>
                    </div>
                    <span class="text-xs font-bold text-error bg-error-container/10 px-2 py-1 rounded-full">-2%</span>
                </div>
                <p class="text-on-surface-variant text-sm font-medium">Đã hủy</p>
                <p class="text-2xl font-extrabold mt-1">14</p>
            </div>
        </div>
        <!-- Filters Section -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <button
                class="px-5 py-2 rounded-full bg-primary text-on-primary font-semibold text-sm shadow-md transition-all">Tất
                cả</button>
            <button
                class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-medium text-sm hover:bg-primary/5 hover:text-primary transition-all">Đang
                xử lý</button>
            <button
                class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-medium text-sm hover:bg-primary/5 hover:text-primary transition-all">Đã
                giao hàng</button>
            <button
                class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-medium text-sm hover:bg-primary/5 hover:text-primary transition-all">Hoàn
                tất</button>
            <button
                class="px-5 py-2 rounded-full bg-surface-container-highest text-on-surface-variant font-medium text-sm hover:bg-primary/5 hover:text-primary transition-all">Đã
                hủy</button>
            <div class="ml-auto flex items-center gap-2">
                <button
                    class="p-2 rounded-lg bg-white border border-slate-100 text-slate-500 hover:text-primary transition-all">
                    <span class="material-symbols-outlined">filter_list</span>
                </button>
                <button
                    class="p-2 rounded-lg bg-white border border-slate-100 text-slate-500 hover:text-primary transition-all">
                    <span class="material-symbols-outlined">sort</span>
                </button>
            </div>
        </div>
        <!-- Orders Table Container -->
        <div class="bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm border border-slate-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50 border-b border-slate-100">
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Mã đơn hàng</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Ngày đặt</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Khách hàng</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Tổng tiền</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Thanh toán</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider">
                            Trạng thái</th>
                        <th
                            class="px-6 py-4 font-headline font-bold text-on-surface-variant text-sm uppercase tracking-wider text-right">
                            Thao tác</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5 font-medium text-primary">#XM-82910</td>
                        <td class="px-6 py-5 text-on-surface-variant text-sm">24 Th10, 2023</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                                    NL</div>
                                <span class="font-semibold text-on-surface">Nguyễn Lãm</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-bold">850.000 ₫</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-primary"></div>
                                <span class="text-sm font-medium">MoMo</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-700"></span>
                                Đang xử lý
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5 font-medium text-primary">#XM-82911</td>
                        <td class="px-6 py-5 text-on-surface-variant text-sm">24 Th10, 2023</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary font-bold text-xs">
                                    TH</div>
                                <span class="font-semibold text-on-surface">Trần Hoàng</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-bold">1.250.000 ₫</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                <span class="text-sm font-medium">COD</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-700"></span>
                                Đã giao hàng
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50/50 transition-colors group border-l-4 border-emerald-500">
                        <td class="px-6 py-5 font-medium text-primary">#XM-82912</td>
                        <td class="px-6 py-5 text-on-surface-variant text-sm">23 Th10, 2023</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-tertiary/10 flex items-center justify-center text-tertiary font-bold text-xs">
                                    PV</div>
                                <span class="font-semibold text-on-surface">Phạm Văn</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-bold">450.000 ₫</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-tertiary"></div>
                                <span class="text-sm font-medium">ZaloPay</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-700"></span>
                                Hoàn tất
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5 font-medium text-primary">#XM-82913</td>
                        <td class="px-6 py-5 text-on-surface-variant text-sm">23 Th10, 2023</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-error/10 flex items-center justify-center text-error font-bold text-xs">
                                    LT</div>
                                <span class="font-semibold text-on-surface">Lê Tú</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-bold">2.100.000 ₫</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-primary"></div>
                                <span class="text-sm font-medium">MoMo</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-700"></span>
                                Đã hủy
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </td>
                    </tr>
                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-5 font-medium text-primary">#XM-82914</td>
                        <td class="px-6 py-5 text-on-surface-variant text-sm">22 Th10, 2023</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                                    DH</div>
                                <span class="font-semibold text-on-surface">Đinh Hữu</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 font-bold">990.000 ₫</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                <span class="text-sm font-medium">COD</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-700"></span>
                                Đang xử lý
                            </span>
                        </td>
                        <td class="px-6 py-5 text-right">
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                            <button
                                class="p-2 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/5 transition-all">
                                <span class="material-symbols-outlined">more_vert</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="px-6 py-4 flex items-center justify-between bg-surface-container-low/20">
                <p class="text-sm text-on-surface-variant">Hiển thị <span class="font-bold">1 đến 5</span> trong số
                    <span class="font-bold">245</span> đơn hàng
                </p>
                <div class="flex items-center gap-2">
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold text-xs shadow-sm shadow-primary/20">1</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-on-surface-variant font-medium text-xs hover:border-primary hover:text-primary transition-all">2</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-on-surface-variant font-medium text-xs hover:border-primary hover:text-primary transition-all">3</button>
                    <span class="text-on-surface-variant px-1">...</span>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-on-surface-variant font-medium text-xs hover:border-primary hover:text-primary transition-all">49</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 hover:border-primary hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- Promotion / Action Section (Bento Bottom) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <div
                class="bg-gradient-to-br from-primary to-primary-container p-8 rounded-lg text-on-primary overflow-hidden relative">
                <div class="relative z-10">
                    <h3 class="text-2xl font-extrabold mb-2">Cảnh báo Kho hàng</h3>
                    <p class="opacity-90 mb-6 max-w-xs text-sm">3 mặt hàng nước hoa bán chạy nhất đang sắp hết. Vui
                        lòng nhập thêm hàng để tránh chậm trễ đơn hàng.</p>
                    <button
                        class="bg-white/20 backdrop-blur-md px-6 py-2.5 rounded-full font-bold text-sm hover:bg-white/30 transition-all border border-white/20">Kiểm
                        tra Kho</button>
                </div>
                <span
                    class="material-symbols-outlined absolute -bottom-6 -right-6 text-[120px] opacity-10 rotate-12">inventory_2</span>
            </div>
            <div class="bg-surface-container p-8 rounded-lg flex flex-col justify-center border border-primary/5">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-white shadow-sm flex items-center justify-center">
                        <span class="material-symbols-outlined text-tertiary">trending_up</span>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-on-surface">Phân tích Hàng ngày</h4>
                        <p class="text-sm text-on-surface-variant">Đơn hàng đã tăng 18% so với thứ Hai tuần trước.
                        </p>
                    </div>
                </div>
                <p class="text-xs text-on-surface-variant italic">"Dòng sản phẩm 'Azure Ocean' đang có sức hút mạnh
                    mẽ trong ngày hôm nay."</p>
            </div>
        </div>
    </section>
    </main>
    <!-- Floating Action Button for Support/Quick Add -->
    <div class="fixed bottom-8 right-8 z-50">
        <button
            class="w-14 h-14 rounded-full bg-tertiary shadow-xl flex items-center justify-center text-white hover:scale-110 active:scale-90 transition-transform group">
            <span class="material-symbols-outlined text-2xl group-hover:rotate-12 transition-transform">add</span>
        </button>
    </div>
@endsession