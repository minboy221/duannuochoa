@extends('layouts.admin')
@section('content')
    <!-- Main Content Area -->
    <main class="ml-64 min-h-screen">
        <!-- TopNavBar (Shared Component Execution) -->
        <header
            class="sticky top-0 right-0 z-30 flex justify-between items-center px-8 w-full h-16 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-100 dark:border-slate-800 shadow-sm dark:shadow-none font-['Plus_Jakarta_Sans'] text-base">
            <div class="flex items-center gap-4 flex-1">
                <div
                    class="relative w-full max-w-md focus-within:ring-2 focus-within:ring-blue-100 rounded-full transition-all">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant"
                        data-icon="search">search</span>
                    <input
                        class="w-full bg-surface-container-low border-none rounded-full py-2 pl-12 pr-4 text-sm focus:ring-0 placeholder:text-outline"
                        placeholder="Tìm kiếm sản phẩm, SKU, hoặc danh mục..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-6">
                <button class="relative text-slate-500 dark:text-slate-400 hover:text-blue-500 transition-colors">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-error rounded-full"></span>
                </button>
                <button class="text-slate-500 dark:text-slate-400 hover:text-blue-500 transition-colors">
                    <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                </button>
                <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800"></div>
                <img alt="Admin Avatar" class="w-8 h-8 rounded-full object-cover"
                    data-alt="close-up profile photo of a male business professional with a friendly expression"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5Cl3XdQnrAbrWJiO1VzrUT-wnnsYjcQl6St4STHuYoNdxdYWavIJtX4-f7AmjQOCO-NKQvHVTJ0BzEo2hcuXRXcav-QH4yTiONXgsc5x844g8uCY1e9gad00Mi-rNelBwEq1MMqCwh49_ry4jrKcJce2K36zrRpaoxi-q49q1CM5JieAth4CVBoWKZ7g8mXa_nq7b8l1K2DwPoTIuwb92hNO1QJT4vNP0MRqGWQrwt4rKwcQSermiOas2uA8wzNiv1wbi4U61NswQ" />
            </div>
        </header>
        <!-- Page Header & Actions -->
        <section class="p-8 pb-0">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Quản lý Sản phẩm</h2>
                    <p class="text-on-surface-variant mt-1">Quản lý danh mục hương thơm và mức tồn kho của bạn.</p>
                </div>
                <button
                    class="flex items-center gap-2 bg-gradient-to-br from-primary to-primary-container text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all">
                    <span class="material-symbols-outlined" data-icon="add">add</span>
                    <span>Thêm Sản phẩm mới</span>
                </button>
            </div>
            <!-- Stats Overview (Bento Style) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary-container/30 transition-all">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-primary-container/20 rounded-2xl text-primary">
                            <span class="material-symbols-outlined" data-icon="inventory_2"
                                style="font-variation-settings: 'FILL' 1;">inventory_2</span>
                        </div>
                        <span class="text-sm font-medium text-on-surface-variant">Tổng sản phẩm</span>
                    </div>
                    <div class="text-2xl font-bold">1,284</div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-secondary-container/30 transition-all">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-secondary-container/20 rounded-2xl text-secondary">
                            <span class="material-symbols-outlined" data-icon="local_fire_department"
                                style="font-variation-settings: 'FILL' 1;">local_fire_department</span>
                        </div>
                        <span class="text-sm font-medium text-on-surface-variant">Bán chạy nhất</span>
                    </div>
                    <div class="text-2xl font-bold">42</div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-tertiary-container/30 transition-all">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-tertiary-container/20 rounded-2xl text-tertiary">
                            <span class="material-symbols-outlined" data-icon="warning"
                                style="font-variation-settings: 'FILL' 1;">warning</span>
                        </div>
                        <span class="text-sm font-medium text-on-surface-variant">Sắp hết hàng</span>
                    </div>
                    <div class="text-2xl font-bold text-error">12</div>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg shadow-sm border border-transparent hover:border-primary-container/30 transition-all">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="p-3 bg-surface-container/50 rounded-2xl text-on-surface-variant">
                            <span class="material-symbols-outlined" data-icon="visibility_off"
                                style="font-variation-settings: 'FILL' 1;">visibility_off</span>
                        </div>
                        <span class="text-sm font-medium text-on-surface-variant">Đang tạm ngưng</span>
                    </div>
                    <div class="text-2xl font-bold">8</div>
                </div>
            </div>
            <!-- Filters & Search Toolbar -->
            <div class="bg-surface-container-low p-4 rounded-xl flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-on-surface-variant"
                            data-icon="filter_list">filter_list</span>
                        <span>Lọc theo Danh mục</span>
                        <span class="material-symbols-outlined text-on-surface-variant text-sm"
                            data-icon="expand_more">expand_more</span>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                        <span>Trạng thái: Tất cả</span>
                        <span class="material-symbols-outlined text-on-surface-variant text-sm"
                            data-icon="expand_more">expand_more</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="p-2 text-on-surface-variant hover:bg-white rounded-lg transition-colors">
                        <span class="material-symbols-outlined" data-icon="download">download</span>
                    </button>
                    <button class="p-2 text-on-surface-variant hover:bg-white rounded-lg transition-colors">
                        <span class="material-symbols-outlined" data-icon="print">print</span>
                    </button>
                    <div class="h-6 w-[1px] bg-outline-variant/30"></div>
                    <span class="text-xs text-on-surface-variant font-bold">1-10 TRÊN 1,284</span>
                </div>
            </div>
            <!-- Data Table -->
            <div
                class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-8 border border-surface-container">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-surface-container-low text-on-surface-variant text-xs font-bold uppercase tracking-wider">
                            <th class="px-6 py-4">Sản phẩm</th>
                            <th class="px-6 py-4">Danh mục</th>
                            <th class="px-6 py-4">Giá (VNĐ)</th>
                            <th class="px-6 py-4">Tồn kho</th>
                            <th class="px-6 py-4">Trạng thái</th>
                            <th class="px-6 py-4 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        <!-- Product Row 1 -->
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center overflow-hidden">
                                        <img alt="X-Men For Boss Intense" class="w-full h-full object-cover"
                                            data-alt="sleek black cologne bottle with elegant branding on a minimal grey surface with soft reflections"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBedxbWgzPmT70RLPlMM5uy72XeuqP_Z8JHQH2D2iNBmD_mbe6wnrueSevljztpNn7QP27tOuJTWxdWHI_tC_TDZUMxSfMhEsixAzl-pKx1FBDvHVjAZz11DxDEwLIvb1JkGfKzvCmoVFodIe-X6Z5znR35yxwStOZUIxaq-qGs1Y8-zpDdCEQQilj9prOKvpCCes2Y6yFQfuS6zISehzqCjVYT4IHtFX13DAmtjk5o6o1YXhv2GjGZV6lo1GvDS-CVyIWOzxy-U9ib" />
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-background group-hover:text-primary transition-colors">
                                            X-Men For Boss Intense</p>
                                        <p class="text-xs text-on-surface-variant">SKU: XM-FR-001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-primary-container/20 text-primary text-xs font-bold rounded-full">Nước
                                    hoa</span>
                            </td>
                            <td class="px-6 py-4 font-medium">325,000 ₫</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="w-3/4 h-full bg-primary"></div>
                                    </div>
                                    <span class="text-xs font-medium">142</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    <span class="text-xs font-bold uppercase">Đang hoạt động</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                </button>
                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="delete">delete</span>
                                </button>
                            </td>
                        </tr>
                        <!-- Product Row 2 -->
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center overflow-hidden">
                                        <img alt="Sữa tắm X-Men Deep Force" class="w-full h-full object-cover"
                                            data-alt="blue plastic bottle of men's shower gel with water droplets on the surface in a bright clean environment"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_ilPpI1qJRQHFlnvdDLfaOq-t17FuiQcIY1_Pox6p6oDB7aOXqZI9xltIAfsB5Oi9QOsjLkRLHekSKLUUDhRwMN-NIe0Q7FVdt-uEJhC-JpAs_IPtUjrU_AtjBpQ61ARqW2FMoMFEqdOsyAPka6ttY1tw1JhxFjRi6ZA2Dv-TMvy8hVrMswlAtwdv50dlxQ8y10YUQtdfjWHhX_ynQxF9ly78ztavPrf7QiBIkAKt6FwgU7lTWXFI--evcZoFNCQloQmC2elPths7" />
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-background group-hover:text-primary transition-colors">
                                            Sữa tắm X-Men Deep Force</p>
                                        <p class="text-xs text-on-surface-variant">SKU: XM-SG-042</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-secondary-container/20 text-secondary text-xs font-bold rounded-full">Sữa
                                    tắm</span>
                            </td>
                            <td class="px-6 py-4 font-medium">145,000 ₫</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="w-1/4 h-full bg-error"></div>
                                    </div>
                                    <span class="text-xs font-medium text-error">12</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    <span class="text-xs font-bold uppercase">Đang hoạt động</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                </button>
                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="delete">delete</span>
                                </button>
                            </td>
                        </tr>
                        <!-- Product Row 3 -->
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center overflow-hidden">
                                        <img alt="Gel vuốt tóc X-Men Strong Hold" class="w-full h-full object-cover"
                                            data-alt="transparent plastic tub of hair styling gel showing the clear textured product inside on a white background"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQddT_hLKBl-zNppn3yyVWC9KS0ywxirHesZ4C97TmpNwtAZ3HOrO_L55FAqJY9w5L32miMcDRjSUZPocltzRfD8Za1tBbvde0CVVwaHETImGbsZrWrPGEOw8gEA3dkyvr6FAyGyh8X06YoDVdvCye1TPXnQhQL3iUQNExrwadUMskUnAVYS8Px6jGgPG2w5lm9PLCVbr3Bo1vQwcB9ryxVVkJYsD84dTyqJgofOk7xNhSX1hXaJiWAvlJUEDLsWQcKCOlHjzEZ2JB" />
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-background group-hover:text-primary transition-colors">
                                            Gel vuốt tóc X-Men Strong Hold</p>
                                        <p class="text-xs text-on-surface-variant">SKU: XM-HG-018</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-tertiary-container/20 text-tertiary text-xs font-bold rounded-full">Gel
                                    vuốt tóc</span>
                            </td>
                            <td class="px-6 py-4 font-medium">85,000 ₫</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="w-full h-full bg-primary"></div>
                                    </div>
                                    <span class="text-xs font-medium">520</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-on-surface-variant">
                                    <span class="w-2 h-2 rounded-full bg-outline-variant"></span>
                                    <span class="text-xs font-bold uppercase">Tạm ngưng</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                </button>
                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="delete">delete</span>
                                </button>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-surface-container flex items-center justify-center overflow-hidden">
                                        <img alt="Nước hoa X-Men Fire" class="w-full h-full object-cover"
                                            data-alt="modern perfume bottle with orange and red accents, representing energetic fire fragrance theme"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBGxBmLFXvZDH0y3gmxkeDfj09gxlL3k1geyVGeOU8It7ha5YnIlSAdFzgQwq628RfVmRqvT4ouK7522kcfzaV6lJL68I0sTMMkHOz1jNUvEGjs9uKkDik1OX0scJr-98F3sMwfmXp0m7MayltzllKW12_puUour7QehSEPEAIWwIw1YxkC0n_Wf-MSyMyTT8mJ7kGXWAt5ZiTmLWw17nabkKaqyhVTkOrBasLZwv8WdPmy3-6dswM-ivOrv8CruhvD82kiumEHtsUM" />
                                    </div>
                                    <div>
                                        <p class="font-bold text-on-background group-hover:text-primary transition-colors">
                                            X-Men Fire Phiên bản giới hạn</p>
                                        <p class="text-xs text-on-surface-variant">SKU: XM-FR-099</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-primary-container/20 text-primary text-xs font-bold rounded-full">Nước
                                    hoa</span>
                            </td>
                            <td class="px-6 py-4 font-medium">450,000 ₫</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-24 h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="w-1/2 h-full bg-primary"></div>
                                    </div>
                                    <span class="text-xs font-medium">85</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="w-2 h-2 rounded-full bg-secondary"></span>
                                    <span class="text-xs font-bold uppercase">Đang hoạt động</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    class="p-2 hover:bg-surface-container rounded-lg text-on-surface-variant transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                </button>
                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                    <span class="material-symbols-outlined text-xl" data-icon="delete">delete</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="bg-surface-container-low px-6 py-4 flex items-center justify-between">
                    <span class="text-sm text-on-surface-variant font-medium">Hiển thị từ 1 đến 4 trong số 1,284 kết
                        quả</span>
                    <div class="flex items-center gap-1">
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white text-on-surface-variant transition-colors disabled:opacity-30"
                            disabled="">
                            <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                        </button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-white font-bold shadow-md shadow-primary/20">1</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white text-on-surface-variant transition-colors">2</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white text-on-surface-variant transition-colors">3</button>
                        <span class="px-2 text-on-surface-variant">...</span>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white text-on-surface-variant transition-colors">128</button>
                        <button
                            class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-white text-on-surface-variant transition-colors">
                            <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer -->
        <footer class="p-8 pt-0 text-center">
            <p class="text-xs text-on-surface-variant/60 font-medium">© 2024 X-Men International. Bảo lưu mọi quyền.
                Thiết kế cho Kinetic Vitality.</p>
        </footer>
    </main>
    <!-- Floating Help Button -->
    <button
        class="fixed bottom-8 right-8 w-14 h-14 rounded-full bg-white text-primary shadow-xl shadow-on-surface/5 flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50">
        <span class="material-symbols-outlined text-2xl" data-icon="chat_bubble_outline">chat_bubble_outline</span>
    </button>
@endsection