@extends('layouts.admin')
@section('content')
    <main class="ml-64 min-h-screen">
        <!-- TopNavBar -->
        <header
            class="sticky top-0 right-0 z-30 flex justify-between items-center px-8 w-full h-16 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-slate-100 dark:border-slate-800 shadow-sm dark:shadow-none font-['Plus_Jakarta_Sans'] text-base">
            <div class="flex items-center flex-1 max-w-xl">
                <div class="relative w-full group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant"
                        data-icon="search">search</span>
                    <input
                        class="w-full pl-12 pr-4 py-2 bg-surface-container-low rounded-full border-none focus:ring-2 focus:ring-primary/20 transition-all font-body text-sm text-on-surface"
                        placeholder="Tìm kiếm theo tên hoặc email..." type="text" />
                </div>
            </div>
            <div class="flex items-center gap-6 ml-8">
                <button class="relative text-slate-500 hover:text-blue-600 transition-colors">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
                </button>
                <button class="text-slate-500 hover:text-blue-600 transition-colors">
                    <span class="material-symbols-outlined" data-icon="help_outline">help_outline</span>
                </button>
                <div class="h-8 w-[1px] bg-slate-200 mx-2"></div>
                <button
                    class="flex items-center gap-2 bg-primary text-on-primary px-5 py-2 rounded-full font-bold text-sm shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-sm" data-icon="file_download">file_download</span>
                    <span>Xuất file CSV</span>
                </button>
            </div>
        </header>
        <!-- Content Canvas -->
        <div class="p-8 space-y-8">
            <!-- Page Header -->
            <div class="flex flex-col gap-2">
                <h2 class="text-4xl font-headline font-extrabold tracking-tight text-on-background">Quản lý Khách hàng
                </h2>
                <p class="text-on-surface-variant font-body">Quản lý và giám sát cơ sở khách hàng đang hoạt động trên
                    tất cả các khu vực.</p>
            </div>
            <!-- Dashboard Stats (Bento Style) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg border-none transition-all hover:scale-[1.02] cursor-default">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-primary/10 rounded-2xl">
                            <span class="material-symbols-outlined text-primary" data-icon="group">group</span>
                        </div>
                        <span
                            class="text-xs font-bold text-secondary bg-secondary-container px-2 py-1 rounded-full">+12%</span>
                    </div>
                    <p class="text-on-surface-variant text-sm font-medium">Tổng khách hàng</p>
                    <h3 class="text-3xl font-headline font-bold text-on-surface mt-1">12,482</h3>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg border-none transition-all hover:scale-[1.02] cursor-default">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-tertiary/10 rounded-2xl">
                            <span class="material-symbols-outlined text-tertiary" data-icon="payments">payments</span>
                        </div>
                        <span
                            class="text-xs font-bold text-tertiary bg-tertiary-container/20 px-2 py-1 rounded-full">+5.4%</span>
                    </div>
                    <p class="text-on-surface-variant text-sm font-medium">Giá trị TB</p>
                    <h3 class="text-3xl font-headline font-bold text-on-surface mt-1">$1,240</h3>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg border-none transition-all hover:scale-[1.02] cursor-default">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-secondary/10 rounded-2xl">
                            <span class="material-symbols-outlined text-secondary" data-icon="bolt">bolt</span>
                        </div>
                        <span class="text-xs font-bold text-secondary bg-secondary-container px-2 py-1 rounded-full">Hoạt
                            động</span>
                    </div>
                    <p class="text-on-surface-variant text-sm font-medium">Đang hoạt động</p>
                    <h3 class="text-3xl font-headline font-bold text-on-surface mt-1">842</h3>
                </div>
                <div
                    class="bg-surface-container-lowest p-6 rounded-lg border-none transition-all hover:scale-[1.02] cursor-default">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-error/10 rounded-2xl">
                            <span class="material-symbols-outlined text-error" data-icon="block">block</span>
                        </div>
                        <span class="text-xs font-bold text-error bg-error-container/20 px-2 py-1 rounded-full">-2%</span>
                    </div>
                    <p class="text-on-surface-variant text-sm font-medium">Tỷ lệ rời bỏ</p>
                    <h3 class="text-3xl font-headline font-bold text-on-surface mt-1">1.2%</h3>
                </div>
            </div>
            <!-- Customer Table Section -->
            <div class="bg-surface-container-lowest rounded-lg overflow-hidden shadow-sm">
                <div class="p-6 border-b border-surface-container-low flex justify-between items-center">
                    <h4 class="font-headline font-bold text-xl">Danh bạ Người dùng</h4>
                    <div class="flex items-center gap-3">
                        <button
                            class="flex items-center gap-2 px-4 py-2 bg-surface-container-low text-on-surface rounded-full text-sm font-medium hover:bg-surface-container-high transition-colors">
                            <span class="material-symbols-outlined text-lg" data-icon="filter_list">filter_list</span>
                            Bộ lọc
                        </button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Khách hàng</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Liên hệ</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Trạng thái</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Tổng chi tiêu</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Ngày tham gia</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-on-surface-variant">
                                    Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-low">
                            <!-- User Row 1 -->
                            <tr class="hover:bg-surface-container-low/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-10 h-10 rounded-full object-cover border-2 border-primary/10"
                                            data-alt="headshot of a stylish man with a beard and glasses, looking directly at the camera with a neutral expression, soft natural lighting"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDUcgL6rrnXhN9NaUzcj4BtkLTtQsj0r8Sz56VQutlF2bFHt1nuMr0kmghPNXP-yipgprpfqxOFUrMZI5boyTxkSXFrjsEcl43-3LzuX3cSVSJ_KEr9LuHpd4R2jZB4Mp0Cp7cQNtyaF2HUjUAg0ZTvoYxvXB-kieG7oVjaF-CTH--L6REetvmzhaLdAuEms6Ugw14C4UfiYv0Sp3_M6V6i28YarXYT81dx_J1JBP4xchNpmJ5pZ_akTqUNfwvwZH0Xt8QSS5GJIOe-" />
                                        <div>
                                            <p
                                                class="font-headline font-bold text-on-surface group-hover:text-primary transition-colors">
                                                Nguyễn Tấn Dũng</p>
                                            <p class="text-xs text-on-surface-variant font-body">Thành viên Premium</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-on-surface">dung.nguyen@email.com</p>
                                    <p class="text-xs text-on-surface-variant">+84 901 234 567</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                        <span class="text-xs font-bold text-secondary uppercase">Hoạt động</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-headline font-bold text-on-surface">
                                    $4,250.00
                                </td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">
                                    12 thg 10, 2023
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 hover:bg-primary/10 rounded-full text-primary transition-colors"
                                            title="Chỉnh sửa">
                                            <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                        </button>
                                        <button class="p-2 hover:bg-error/10 rounded-full text-error transition-colors"
                                            title="Khóa người dùng">
                                            <span class="material-symbols-outlined text-xl" data-icon="block">block</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- User Row 2 -->
                            <tr class="hover:bg-surface-container-low/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-10 h-10 rounded-full object-cover border-2 border-primary/10"
                                            data-alt="portrait of a young smiling woman with long brown hair in a bright outdoor park setting, golden hour soft light"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbaO7GTzB40tsfqis8kCwCmEu87dSWdwlUzVVgVNmmL6PpBKx7mCw5QkbM7XNrGrKCt-KNkhmWlWMX_e0EVPglIrWtHv_5ZZBV0y3iCEwf12NdhnTFO3omHWesyoINqsjCuBlbOEXWFc8dRzahLjhfWm61NygYKp39lvnUQNizqqSGx7WWATF6upbH9r4xNUsPmz5DDRFVW8haT1HDuoxxcXJN39TKzPAsmdqhCQrSTeSgoIf_UOv-YgVrKWKgjYcsCpnduzkaoo1P" />
                                        <div>
                                            <p
                                                class="font-headline font-bold text-on-surface group-hover:text-primary transition-colors">
                                                Lê Thị Kim Chi</p>
                                            <p class="text-xs text-on-surface-variant font-body">Thành viên thường</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-on-surface">kimchi.le@example.com</p>
                                    <p class="text-xs text-on-surface-variant">+84 912 345 678</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                        <span class="text-xs font-bold text-secondary uppercase">Hoạt động</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-headline font-bold text-on-surface">
                                    $1,120.50
                                </td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">
                                    05 thg 11, 2023
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 hover:bg-primary/10 rounded-full text-primary transition-colors"
                                            title="Chỉnh sửa">
                                            <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                        </button>
                                        <button class="p-2 hover:bg-error/10 rounded-full text-error transition-colors"
                                            title="Khóa người dùng">
                                            <span class="material-symbols-outlined text-xl" data-icon="block">block</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- User Row 3 (Banned) -->
                            <tr class="hover:bg-surface-container-low/30 transition-colors group opacity-80">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-10 h-10 rounded-full object-cover border-2 border-error/10 grayscale"
                                            data-alt="young man with short black hair wearing a simple white t-shirt, neutral studio background, clean and professional look"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuZMgTooZuCP-HX48HMp_cMP2kWez1ACz0kxGs-sA4CXYBh_oQpeQesG-dWeqoHVh9XjPkh3HTFH3ysMxFCBCO6GmO0aMmTJNGLDVfJvSWg4E-Y6tU7okyLwSluDJLsjMJKUYLa8a3ix2PVaxID40ZTwU9nE425Ucq4B34HUMR2E22iqrmuUUOxmUxBGqIkthv6xm1VmZ_Z-cSTCsZtZsFy5-EZjYxN7_dQyFrFf9lskriFOqk73MhqcWQxtYfyV8NLyq-vpiJQJg6" />
                                        <div>
                                            <p
                                                class="font-headline font-bold text-on-surface group-hover:text-error transition-colors">
                                                Trần Văn A</p>
                                            <p class="text-xs text-error font-body">Đã bị đình chỉ</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-on-surface">tranva@outlook.com</p>
                                    <p class="text-xs text-on-surface-variant">+84 944 888 999</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-error"></div>
                                        <span class="text-xs font-bold text-error uppercase">Đã khóa</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-headline font-bold text-on-surface">
                                    $85.00
                                </td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">
                                    22 thg 8, 2023
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 hover:bg-primary/10 rounded-full text-primary transition-colors"
                                            title="Chỉnh sửa">
                                            <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                        </button>
                                        <button class="p-2 bg-error text-on-error rounded-full transition-all scale-110"
                                            title="Mở khóa">
                                            <span class="material-symbols-outlined text-xl"
                                                data-icon="lock_open">lock_open</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- User Row 4 -->
                            <tr class="hover:bg-surface-container-low/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img class="w-10 h-10 rounded-full object-cover border-2 border-primary/10"
                                            data-alt="close-up portrait of a woman with red hair and freckles, soft natural daylight, minimalist aesthetic"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgZmf8NG0lV2kV80SeVPJpZ7wNyzGlqSHzfqV2peuSj33skJj83kuj5jnn8ZudU_o6biMYYoG7hTh5T4uz9yN48TwbQVQg10sn8TMOQj02e4QWxFk2KXyEY0h-AHBWsvgs5ULBVsvyBuZC3q7l5SMeL-IZsDm5cDTUeQUp0Ltz9CzVjIJTJqpYOFcs9iCHQqpJRX0tEfbFh40O_FCwaRa6HOG5zCuD51MH3buTmY4w8fYZEtF-r1kIgYAClmwtjLeP02ehQHE98CiH" />
                                        <div>
                                            <p
                                                class="font-headline font-bold text-on-surface group-hover:text-primary transition-colors">
                                                Phạm Bảo Ngọc</p>
                                            <p class="text-xs text-on-surface-variant font-body">Thành viên VIP</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-on-surface">ngocpham@company.vn</p>
                                    <p class="text-xs text-on-surface-variant">+84 988 777 666</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-secondary"></div>
                                        <span class="text-xs font-bold text-secondary uppercase">Hoạt động</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-headline font-bold text-on-surface">
                                    $8,720.00
                                </td>
                                <td class="px-6 py-4 text-sm text-on-surface-variant">
                                    30 thg 12, 2022
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button class="p-2 hover:bg-primary/10 rounded-full text-primary transition-colors"
                                            title="Chỉnh sửa">
                                            <span class="material-symbols-outlined text-xl" data-icon="edit">edit</span>
                                        </button>
                                        <button class="p-2 hover:bg-error/10 rounded-full text-error transition-colors"
                                            title="Khóa người dùng">
                                            <span class="material-symbols-outlined text-xl" data-icon="block">block</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Table Footer / Pagination -->
                <div class="p-6 border-t border-surface-container-low flex justify-between items-center">
                    <p class="text-sm text-on-surface-variant">Hiển thị <span class="font-bold text-on-surface">1 -
                            4</span> trên <span class="font-bold text-on-surface">1,284</span> kết quả</p>
                    <div class="flex items-center gap-2">
                        <button
                            class="p-2 rounded-full hover:bg-surface-container-low text-on-surface-variant disabled:opacity-50"
                            disabled="">
                            <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-primary text-on-primary font-bold text-sm">1</button>
                        <button
                            class="w-8 h-8 rounded-full hover:bg-surface-container-low text-on-surface font-bold text-sm">2</button>
                        <button
                            class="w-8 h-8 rounded-full hover:bg-surface-container-low text-on-surface font-bold text-sm">3</button>
                        <span class="text-on-surface-variant mx-1">...</span>
                        <button
                            class="w-8 h-8 rounded-full hover:bg-surface-container-low text-on-surface font-bold text-sm">32</button>
                        <button class="p-2 rounded-full hover:bg-surface-container-low text-on-surface-variant">
                            <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Contextual Help / Insights Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                <div class="bg-primary p-8 rounded-lg relative overflow-hidden group">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <div class="relative z-10">
                        <h5 class="text-2xl font-headline font-extrabold text-on-primary mb-4">Mẹo giữ chân khách hàng
                        </h5>
                        <p class="text-primary-container font-body mb-6">Người dùng đã chi tiêu trên $500 trong 3 tháng
                            đầu tiên có tỷ lệ giữ chân cao hơn 85%. Hãy cân nhắc các chiến dịch mục tiêu cho người dùng
                            mới sắp đạt ngưỡng này.</p>
                        <button
                            class="bg-on-primary text-primary px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-all">Bắt
                            đầu chiến dịch</button>
                    </div>
                </div>
                <div class="bg-secondary p-8 rounded-lg relative overflow-hidden group">
                    <div
                        class="absolute bottom-0 right-0 w-32 h-32 bg-on-secondary/10 rounded-full -mr-16 -mb-16 group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <div class="relative z-10">
                        <h5 class="text-2xl font-headline font-extrabold text-on-secondary mb-4">Xuất báo cáo</h5>
                        <p class="text-secondary-container font-body mb-6">Cần một tập dữ liệu tùy chỉnh? Sử dụng công
                            cụ xuất nâng cao để lọc theo khu vực, ngày tham gia hoặc tần suất mua hàng để có thông tin
                            chi tiết hơn.</p>
                        <button
                            class="bg-on-secondary text-secondary px-6 py-2 rounded-full font-bold text-sm hover:scale-105 transition-all">Đi
                            tới Xuất dữ liệu</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection