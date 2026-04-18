@extends('layouts.admin')
@section('content')

    <!-- Main Content Canvas -->
    <main class="ml-64 p-8 w-[calc(100%-16rem)]">
        <header class="mb-10 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-extrabold text-on-background tracking-tight">Tổng quan Quản trị</h2>
                <p class="text-on-surface-variant font-body">Chỉ số hiệu suất thời gian thực cho dòng sản phẩm Xmen.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="px-6 py-3 rounded-xl bg-surface-container-highest text-primary font-bold transition-all hover:scale-[1.02]">
                    Xuất CSV
                </button>
                <button
                    class="px-6 py-3 rounded-xl bg-gradient-to-br from-primary to-primary-container text-on-primary font-bold shadow-lg shadow-primary/20 transition-all hover:scale-[1.02]">
                    Tạo Chiến dịch
                </button>
            </div>
        </header>
        <!-- KPI Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Revenue -->
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm group hover:scale-[1.02] transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-primary/10 rounded-xl">
                        <span class="material-symbols-outlined text-primary" data-icon="payments">payments</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">+12.5%</span>
                </div>
                <p class="text-sm font-medium text-on-surface-variant">Tổng doanh thu</p>
                <h3 class="text-2xl font-extrabold text-on-background">{{ number_format($totalRevenue, 0, ',', '.') }}$</h3>
                <div class="mt-4 h-12 flex items-end gap-1">
                    <div class="w-full bg-primary/20 rounded-t-sm h-[40%]"></div>
                    <div class="w-full bg-primary/20 rounded-t-sm h-[60%]"></div>
                    <div class="w-full bg-primary/20 rounded-t-sm h-[50%]"></div>
                    <div class="w-full bg-primary rounded-t-sm h-[80%]"></div>
                    <div class="w-full bg-primary/20 rounded-t-sm h-[70%]"></div>
                    <div class="w-full bg-primary rounded-t-sm h-[100%]"></div>
                </div>
            </div>
            <!-- Card 2: Orders -->
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm group hover:scale-[1.02] transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-secondary/10 rounded-xl">
                        <span class="material-symbols-outlined text-secondary" data-icon="shopping_bag">shopping_bag</span>
                    </div>
                    <span class="text-xs font-bold text-on-surface-variant bg-surface-container px-2 py-1 rounded-full">TB
                        84$</span>
                </div>
                <p class="text-sm font-medium text-on-surface-variant">Tổng đơn hàng</p>
                <h3 class="text-2xl font-extrabold text-on-background">{{ number_format($totalOrders) }}</h3>
                <p class="text-xs mt-4 text-on-surface-variant italic">{{ $ordersToday }} đơn hàng từ nửa đêm</p>
            </div>
            <!-- Card 3: Customers -->
            <div
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm group hover:scale-[1.02] transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-tertiary/10 rounded-xl">
                        <span class="material-symbols-outlined text-tertiary" data-icon="person_add">person_add</span>
                    </div>
                    <span class="text-xs font-bold text-tertiary bg-tertiary-container/20 px-2 py-1 rounded-full">Mới</span>
                </div>
                <p class="text-sm font-medium text-on-surface-variant">Khách hàng mới</p>
                <h3 class="text-2xl font-extrabold text-on-background">{{ number_format($totalCustomers) }}</h3>
                <div class="mt-4 flex -space-x-2">
                    <img alt="User" class="w-8 h-8 rounded-full border-2 border-surface-container-lowest object-cover"
                        data-alt="Portrait of a young man with a slight smile and casual hairstyle"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0WQg2MLCFugjXKBKYQgrJ-c2CuEf7GIWkaNIjwo5sHR4s5QzwrmoXO_dqoqUfkmb5DQwsVMtjWDjk2JjMbjJJWUpDeX31_B9813GivCKn-QjHgSVpw2GsJfohG3rUGbzBj0Sw--QPp7H5XwUud56RRXNc5W_nE6Tj1XIQ_5Y-qE5IKxYWY6H-aB4eHfG6Kk56cGdjF28vyTF3DBEg9EcNvH5BgkicYd8006FeEvPQe6Amz2lj4PolsZ6lXxZ-hulAG6sQ5Dnl6i5O" />
                    <img alt="User" class="w-8 h-8 rounded-full border-2 border-surface-container-lowest object-cover"
                        data-alt="Close up of a smiling woman with a bright and friendly expression"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUdB9CGJSIW0YtAyHYXy3pcOsu8dyWsbsmqtgVTg8cB0BdK_tdLdSCAmZKaEG-V3z2r96_OD_yjqXn73NTB_ZWDph3mYNpqI2o9Q8gTATrQSdpWxuRJuBOCNmf1lO9R5V-Zc-lBNRNu5uUucZAbaobik3CIBWcXPLqkFV423Z28foC13qTvbYyqFAQrvIElrSLlkXFCzgNn9z7Wq8fZXJKDf0kBAkm9YnxLtK8c5flTNEH0cf-Q7r5XnbbwMw0bpMQh7qWw3jbnRHx" />
                    <img alt="User" class="w-8 h-8 rounded-full border-2 border-surface-container-lowest object-cover"
                        data-alt="Portrait of a young person wearing glasses and a focused look"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5Yx57tV2a_c0AkMCvNkl2BNA19OaCrjKilUMjb3qF7xoVSjRJEZGcSR6B5vBkUCETnd7Bq-odBnlmjTotZ5AwygBvaQBpfAclCk_cNVZfd1hxi-JMH_Xxj182Y4LzkAxG7wAPo5pdTbeRJX-FCYAQq8-2j8cOewbB1WfLUfWA3hMWyMQbk6NrpBWV3fsqo_9HGdWlunuLy6rbzxVW9clGFv3vTsUohqlKx-s9oZHOpnTaALmFZcnO5J7DxvIozCpMOS8qjj-Fs59F" />
                    <div
                        class="w-8 h-8 rounded-full bg-surface-container border-2 border-surface-container-lowest flex items-center justify-center text-[10px] font-bold text-primary">
                        +42</div>
                </div>
            </div>
            <!-- Card 4: Low Stock -->
            <a href="{{ route('admin.inventory.index', ['status' => 'low_stock']) }}"
                class="bg-surface-container-lowest p-6 rounded-lg shadow-sm group hover:scale-[1.02] transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-red-100/50 rounded-xl">
                        <span class="material-symbols-outlined text-red-600" data-icon="inventory">inventory</span>
                    </div>
                    @if($lowStockCount > 0)
                        <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-full animate-pulse">Cần nhập
                            hàng</span>
                    @endif
                </div>
            </div>
        </div>
        <!-- Charts Bento Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Revenue Trends -->
            <div class="lg:col-span-2 bg-surface-container-lowest p-8 rounded-lg shadow-sm border border-slate-50">
                <div class="flex justify-between items-center mb-10">
                    <h3 class="text-xl font-bold text-on-background">Xu hướng Doanh thu</h3>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 rounded-full text-xs font-bold bg-primary text-on-primary">Hàng
                            tháng</button>
                        <button
                            class="px-3 py-1 rounded-full text-xs font-bold text-on-surface-variant hover:bg-surface-container transition-colors">Hàng
                            tuần</button>
                    </div>
                </div>
                <div class="relative h-[300px] w-full rounded-xl p-2 pt-6">
                    <div id="revenueChart" class="w-full h-full"></div>
                </div>
            </div>
            <!-- Categories -->
            <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm flex flex-col">
                <h3 class="text-xl font-bold text-on-background mb-8">Đơn hàng theo Danh mục</h3>
                <div class="flex-1 flex flex-col justify-center items-center">
                    <div class="relative w-48 h-48 mb-8">
                        <svg class="w-full h-full transform -rotate-90" viewbox="0 0 36 36">
                            <circle class="stroke-surface-container-high" cx="18" cy="18" fill="none" r="16" stroke-width="4"></circle>
                            @php
                                $totalSales = $categoriesSales->sum('total');
                                $colors = ['stroke-primary', 'stroke-secondary', 'stroke-tertiary', 'stroke-error', 'stroke-warning', 'stroke-emerald-500'];
                                $bgColors = ['bg-primary', 'bg-secondary', 'bg-tertiary', 'bg-error', 'bg-warning', 'bg-emerald-500'];
                                $offset = 0;
                            @endphp
                            @foreach($categoriesSales->sortByDesc('total')->take(5) as $index => $cat)
                                @php
                                    $percentage = $totalSales > 0 ? ($cat->total / $totalSales) * 100 : 0;
                                    $dashArray = $percentage . ', 100';
                                    $dashOffset = '-' . $offset;
                                    $offset += $percentage;
                                @endphp
                                <circle class="{{ $colors[$index % count($colors)] }}" cx="18" cy="18" fill="none" r="16" stroke-dasharray="{{ $dashArray }}"
                                    stroke-dashoffset="{{ $dashOffset }}" stroke-width="4"></circle>
                            @endforeach
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-extrabold text-on-background">{{ $totalSales >= 1000 ? round($totalSales/1000, 1) . 'k' : $totalSales }}</span>
                            <span class="text-[10px] uppercase font-bold text-outline">Tổng SP</span>
                        </div>
                    </div>
                    <div class="w-full space-y-4">
                        @foreach($categoriesSales->sortByDesc('total')->take(5) as $index => $cat)
                        @php
                            $percentage = $totalSales > 0 ? round(($cat->total / $totalSales) * 100) : 0;
                        @endphp
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full {{ $bgColors[$index % count($bgColors)] }}"></span>
                                <span class="text-sm font-medium text-on-surface-variant">{{ $cat->name }}</span>
                            </div>
                            <span class="text-sm font-bold">{{ $percentage }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Orders Table -->
        <section class="bg-surface-container-lowest rounded-lg shadow-sm overflow-hidden mb-12">
            <div class="px-8 py-6 flex justify-between items-center border-b border-slate-50">
                <h3 class="text-xl font-bold text-on-background">Đơn hàng Gần đây</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-primary font-bold text-sm flex items-center gap-1 hover:underline">
                    Xem Toàn bộ Lịch sử <span class="material-symbols-outlined text-sm"
                        data-icon="chevron_right">chevron_right</span>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-surface-container-low/50">
                        <tr>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider">Mã Đơn hàng
                            </th>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider">Khách hàng
                            </th>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider">Sản phẩm</th>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider">Trạng thái
                            </th>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider">Tổng cộng</th>
                            <th class="px-8 py-4 text-xs font-bold text-outline uppercase tracking-wider text-right">
                                Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-5 font-bold text-primary">#{{ $order->order_id }}</td>
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-3">
                                    @if($order->user && $order->user->avatar)
                                        <img alt="User" class="w-8 h-8 rounded-full object-cover" src="{{ asset('storage/' . $order->user->avatar) }}" />
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-[10px] font-bold">
                                            {{ strtoupper(substr($order->user->full_name ?? $order->user->username ?? 'U', 0, 2)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-on-background">{{ $order->user->full_name ?? $order->user->username ?? 'Khách' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-on-surface-variant">
                                @if($order->orderItems->isNotEmpty())
                                    {{ $order->orderItems->first()->variant->product->name ?? 'Sản phẩm' }}
                                    @if($order->orderItems->count() > 1)
                                        <span class="text-xs text-outline">(+{{ $order->orderItems->count() - 1 }} nữa)</span>
                                    @endif
                                @else
                                    Không có SP
                                @endif
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $statusColors = [
                                        'Chờ xử lý' => 'bg-orange-100 text-orange-700',
                                        'Đang giao hàng' => 'bg-blue-100 text-blue-700',
                                        'Hoàn tất' => 'bg-emerald-100 text-emerald-700',
                                        'Đã hủy' => 'bg-red-100 text-red-700',
                                        'Đã hoàn thành' => 'bg-emerald-100 text-emerald-700',
                                    ];
                                    $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $colorClass }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-8 py-5 font-bold text-on-background">{{ number_format($order->total_amount, 0, ',', '.') }}$</td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.orders.show', $order->order_id) }}" class="p-2 text-outline hover:text-primary transition-colors inline-block text-center mt-2">
                                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-5 text-center text-on-surface-variant">Không có đơn hàng nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <!-- Floating Quick Actions -->
    <button
        class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-br from-primary to-primary-container text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-110 active:scale-95 transition-all z-50">
        <span class="material-symbols-outlined" data-icon="add"
            style="font-variation-settings: 'FILL' 0, 'wght' 700;">add</span>
    </button>
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Revenue Trend Chart
            const revenueData = @json($revenueTrends);
            
            // Format labels and series data
            const labels = revenueData.map(item => item.label);
            const seriesData = revenueData.map(item => item.total);
            const fullLabels = revenueData.map(item => item.fullLabel);

            const options = {
                series: [{
                    name: 'Doanh thu',
                    data: seriesData
                }],
                chart: {
                    type: 'area',
                    height: 280,
                    fontFamily: 'Be Vietnam Pro, sans-serif',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#0052d0'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#6f768e',
                            fontSize: '12px',
                            fontWeight: 500,
                        }
                    }
                },
                yaxis: {
                    show: false, // Hide y-axis as per design
                },
                grid: {
                    show: false, // Hide grid lines
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 10
                    }
                },
                tooltip: {
                    theme: 'dark',
                    y: {
                        formatter: function (val) {
                            return new Intl.NumberFormat('en-US').format(val) + "$";
                        }
                    },
                    x: {
                        formatter: function (val, { dataPointIndex }) {
                            return fullLabels[dataPointIndex];
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#revenueChart"), options);
            chart.render();
        });
    </script>
@endsection