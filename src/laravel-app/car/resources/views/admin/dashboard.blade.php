@extends('layouts.admin')

@section('title', 'Tổng quan')

@push('styles')
<style>
.dashboard-wrap{background:linear-gradient(135deg,#fef3f8 0%,#fff 100%);min-height:100vh;padding:2.5rem 0}
.dashboard-header{margin-bottom:2rem}
.dashboard-title{font-size:1.75rem;font-weight:700;color:#2d3748;margin:0 0 .5rem 0;display:flex;align-items:center;gap:.75rem}
.dashboard-title i{color:#dc2626}
.dashboard-subtitle{color:#718096;font-size:.9375rem;margin:0}
.stat-card{background:#fff;border-radius:16px;padding:1.75rem;box-shadow:0 2px 8px rgba(255,38,123,.08);transition:all .3s;position:relative;overflow:hidden;border:2px solid #fce4ec}
.stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--card-color),transparent);opacity:0;transition:opacity .3s}
.stat-card:hover{box-shadow:0 8px 24px rgba(255,38,123,.15);transform:translateY(-4px);border-color:var(--card-color)}
.stat-card:hover::before{opacity:1}
.stat-card.blue{--card-color:#dc2626}.stat-card.pink{--card-color:#ec4899}.stat-card.orange{--card-color:#f97316}.stat-card.green{--card-color:#10b981}
.stat-card-content{display:flex;align-items:center;justify-content:space-between}
.stat-card-icon{width:3.5rem;height:3.5rem;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;position:relative;transition:transform .3s ease}
.stat-card:hover .stat-card-icon{transform:scale(1.1) rotate(5deg)}
.stat-card-icon::after{content:'';position:absolute;inset:-4px;border-radius:12px;border:2px solid currentColor;opacity:.15}
.stat-card-icon.blue{background:linear-gradient(135deg,#ffe4f0 0%,#ffd4e5 100%);color:#dc2626}
.stat-card-icon.pink{background:linear-gradient(135deg,#fce7f3 0%,#fbcfe8 100%);color:#be185d}
.stat-card-icon.orange{background:linear-gradient(135deg,#ffedd5 0%,#fed7aa 100%);color:#c2410c}
.stat-card-icon.green{background:linear-gradient(135deg,#d1fae5 0%,#a7f3d0 100%);color:#065f46}
.stat-info{text-align:right;flex:1;margin-left:1rem}
.stat-label{font-size:.875rem;color:#718096;font-weight:600;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.5rem}
.stat-value{font-size:1.75rem;font-weight:700;color:#2d3748;line-height:1}
.stat-trend{font-size:.75rem;margin-top:.5rem;display:flex;align-items:center;justify-content:flex-end;gap:.25rem;font-weight:600}
.trend-up{color:#10b981}.trend-down{color:#ef4444}
.chart-section{margin-top:2rem}
.chart-box{background:#fff;border-radius:16px;padding:2rem;box-shadow:0 2px 8px rgba(255,38,123,.08);border:2px solid #fce4ec;transition:all .3s ease}
.chart-box:hover{border-color:#dc2626;box-shadow:0 6px 20px rgba(255,38,123,.12)}
.chart-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:2px solid #fce4ec}
.chart-title{font-size:1.25rem;font-weight:700;color:#2d3748;margin:0;display:flex;align-items:center;gap:.5rem}
.chart-title i{color:#dc2626;font-size:1.125rem}
.chart-page{background:#f9fafb;min-height:auto;padding:0}
.chart-container-old{background:#fff;border-radius:.75rem;padding:2rem;box-shadow:0 1px 3px rgba(0,0,0,.1);max-width:1400px;margin:0 auto}
.chart-header-old{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:2px solid #e5e7eb;flex-wrap:wrap;gap:1rem}
.chart-title-section{flex:1;min-width:250px}
.chart-title-old{font-size:1.5rem;font-weight:700;color:#111827;margin:0 0 .5rem 0;display:flex;align-items:center;gap:.75rem}
.chart-subtitle{font-size:.875rem;color:#6b7280;margin:0}
.chart-badge{display:inline-flex;align-items:center;padding:.25rem .75rem;background:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);color:#fff;font-size:.875rem;font-weight:600;border-radius:9999px}
.chart-filters{display:flex;gap:.75rem;flex-wrap:wrap}
.filter-btn{background:#fff;border:1.5px solid #d1d5db;color:#374151;padding:.625rem 1rem;border-radius:.5rem;font-size:.875rem;font-weight:500;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem}
.filter-btn:hover{background:#f9fafb;border-color:#3b82f6;color:#3b82f6;transform:translateY(-1px)}
.chart-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:2rem;padding:1.5rem;background:#f9fafb;border-radius:.5rem}
.chart-stat-card{text-align:center;padding:1rem;background:#fff;border-radius:.5rem;border:1px solid #e5e7eb}
.chart-stat-label{font-size:.75rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.5rem}
.chart-stat-value{font-size:1.75rem;font-weight:700;color:#111827}
.chart-wrapper{position:relative;height:450px;margin-top:1.5rem}
.quick-actions{margin-top:2rem}
.actions-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem}
.action-card{background:#fff;border:2px dashed #fce4ec;border-radius:16px;padding:1.5rem;text-align:center;transition:all .3s;cursor:pointer}
.action-card:hover{border-color:#dc2626;border-style:solid;box-shadow:0 6px 20px rgba(255,38,123,.12);transform:translateY(-4px);background:#fef3f8}
.action-icon{width:3rem;height:3rem;background:linear-gradient(135deg,#fef3f8 0%,#ffe4f0 100%);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.25rem;color:#dc2626;transition:all .3s ease;border:2px solid #fce4ec}
.action-card:hover .action-icon{background:#dc2626;color:#fff;border-color:#dc2626;transform:scale(1.1) rotate(-5deg)}
.action-label{font-size:.9375rem;font-weight:600;color:#2d3748;transition:color .3s ease}
.action-card:hover .action-label{color:#dc2626}
@media(max-width:992px){.chart-header,.chart-header-old{flex-direction:column;align-items:flex-start;gap:1rem}.chart-filter{width:100%}.filter-btn{flex:1}}
@media(max-width:768px){.dashboard-wrap{padding:1.5rem 0}.dashboard-title{font-size:1.5rem}.stat-card{padding:1.5rem}.stat-value{font-size:1.5rem}.stat-card-icon{width:3rem;height:3rem;font-size:1.25rem}.chart-box,.chart-container-old{padding:1.5rem}.actions-grid{grid-template-columns:repeat(2,1fr)}.chart-filters{width:100%}.chart-wrapper{height:350px}}
@media(max-width:576px){.stat-card-content{flex-direction:column;text-align:center}.stat-info{margin-left:0;margin-top:1rem;text-align:center}.stat-trend{justify-content:center}}
</style>
@endpush

@section('content')
@php
    $chartTypes = ['bar' => 'Cột', 'line' => 'Đường', 'doughnut' => 'Tròn'];
    $backgroundColors = ['rgba(59,130,246,.2)','rgba(239,68,68,.2)','rgba(16,185,129,.2)','rgba(245,158,11,.2)','rgba(139,92,246,.2)','rgba(236,72,153,.2)','rgba(6,182,212,.2)','rgba(132,204,22,.2)','rgba(249,115,22,.2)','rgba(99,102,241,.2)','rgba(20,184,166,.2)','rgba(168,85,247,.2)'];
    $borderColors = ['rgb(59,130,246)','rgb(239,68,68)','rgb(16,185,129)','rgb(245,158,11)','rgb(139,92,246)','rgb(236,72,153)','rgb(6,182,212)','rgb(132,204,22)','rgb(249,115,22)','rgb(99,102,241)','rgb(20,184,166)','rgb(168,85,247)'];
@endphp
<div class="dashboard-wrap">
    <div class="container">
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="stat-card blue">
                    <div class="stat-card-content">
                        <div class="stat-card-icon blue"><i class="fa fa-dollar-sign"></i></div>
                        <div class="stat-info">
                            <div class="stat-label">Tổng doanh thu</div>
                            <div class="stat-value">{{ number_format($stats['revenue'], 0, ',', '.') }}đ</div>
                            <div class="stat-trend trend-up"><i class="fa fa-arrow-up"></i><span>+12.5%</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('admin.products') }}" class="text-decoration-none">
                    <div class="stat-card pink">
                        <div class="stat-card-content">
                            <div class="stat-card-icon pink"><i class="fa fa-cubes"></i></div>
                            <div class="stat-info">
                                <div class="stat-label">Sản phẩm</div>
                                <div class="stat-value">{{ $stats['products'] }}</div>
                                <div class="stat-trend"><span style="color:#718096">Tổng số</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('admin.orders.pending') }}" class="text-decoration-none">
                    <div class="stat-card orange">
                        <div class="stat-card-content">
                            <div class="stat-card-icon orange"><i class="fa fa-clock"></i></div>
                            <div class="stat-info">
                                <div class="stat-label">Đơn chờ</div>
                                <div class="stat-value">{{ $stats['pendingOrders'] }}</div>
                                <div class="stat-trend" style="color:#f97316"><i class="fa fa-exclamation-circle"></i><span>Cần xử lý</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-xl-3">
                <a href="{{ route('admin.users') }}" class="text-decoration-none">
                    <div class="stat-card green">
                        <div class="stat-card-content">
                            <div class="stat-card-icon green"><i class="fa fa-users"></i></div>
                            <div class="stat-info">
                                <div class="stat-label">Khách hàng</div>
                                <div class="stat-value">{{ $stats['users'] }}</div>
                                <div class="stat-trend trend-up"><i class="fa fa-arrow-up"></i><span>+8 mới</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="chart-section">
            <div class="chart-box">
                <div class="chart-header">
                    <h3 class="chart-title"><i class="fa fa-chart-line"></i>Thống kê đơn hàng</h3>
                </div>

                <div class="chart-page">
                    <div class="chart-container-old">
                        <div class="chart-header-old">
                            <div class="chart-title-section">
                                <h5 class="chart-title-old">
                                    <i class="fas fa-chart-line"></i>
                                    Thống kê bán hàng
                                    <span class="chart-badge">{{ $limitDay }} ngày</span>
                                </h5>
                                <p class="chart-subtitle">Theo dõi số lượng sản phẩm đã bán trong {{ $limitDay }} ngày gần đây</p>
                            </div>

                            <div class="chart-filters">
                                <div class="dropdown">
                                    <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-chart-bar"></i><span>{{ $chartTypes[$chartType] ?? 'Cột' }}</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach($chartTypes as $type => $label)
                                            <li><a href="{{ route('admin.dashboard', ['type_chart' => $type, 'limit_day' => $limitDay]) }}" class="dropdown-item {{ $chartType === $type ? 'active' : '' }}">Biểu đồ {{ strtolower($label) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="dropdown">
                                    <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-calendar"></i><span>Thời gian</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach([100 => 'Tất cả', 7 => '7 ngày', 14 => '14 ngày', 21 => '21 ngày', 30 => '30 ngày'] as $days => $label)
                                            <li><a href="{{ route('admin.dashboard', ['type_chart' => $chartType, 'limit_day' => $days]) }}" class="dropdown-item {{ $limitDay === $days ? 'active' : '' }}">{{ $label }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="chart-stats">
                            <div class="chart-stat-card"><div class="chart-stat-label">Tổng đã bán</div><div class="chart-stat-value" style="color:#3b82f6">{{ number_format($chartSummary['total_sold']) }}</div></div>
                            <div class="chart-stat-card"><div class="chart-stat-label">Trung bình/ngày</div><div class="chart-stat-value" style="color:#8b5cf6">{{ number_format($chartSummary['avg_sold'], 1) }}</div></div>
                            <div class="chart-stat-card"><div class="chart-stat-label">Cao nhất</div><div class="chart-stat-value" style="color:#10b981">{{ number_format($chartSummary['max_sold']) }}</div></div>
                            <div class="chart-stat-card"><div class="chart-stat-label">Thấp nhất</div><div class="chart-stat-value" style="color:#f59e0b">{{ number_format($chartSummary['min_sold']) }}</div></div>
                        </div>

                        <div class="chart-wrapper">
                            <canvas id="adminOrderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <div class="actions-grid">
                <a href="{{ route('admin.products.create') }}" class="text-decoration-none">
                    <div class="action-card"><div class="action-icon"><i class="fa fa-plus"></i></div><div class="action-label">Thêm sản phẩm</div></div>
                </a>
                <a href="{{ route('admin.orders') }}" class="text-decoration-none">
                    <div class="action-card"><div class="action-icon"><i class="fa fa-list"></i></div><div class="action-label">Quản lý đơn hàng</div></div>
                </a>
                <a href="{{ route('admin.users') }}" class="text-decoration-none">
                    <div class="action-card"><div class="action-icon"><i class="fa fa-user-circle"></i></div><div class="action-label">Khách hàng</div></div>
                </a>
                <a href="{{ route('admin.stats.orders') }}" class="text-decoration-none">
                    <div class="action-card"><div class="action-icon"><i class="fa fa-chart-pie"></i></div><div class="action-label">Báo cáo</div></div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
if (window.Chart && document.getElementById('adminOrderChart')) {
    var chartType = @json($chartType);
    new Chart(document.getElementById('adminOrderChart'), {
        type: chartType,
        data: {
            labels: @json($chartRows->pluck('day')->values()),
            datasets: [{
                label: 'Số lượng đã bán',
                data: @json($chartRows->pluck('sold_quantity')->map(fn ($value) => (int) $value)->values()),
                backgroundColor: chartType === 'doughnut' ? @json($backgroundColors) : 'rgba(59, 130, 246, .2)',
                borderColor: chartType === 'doughnut' ? @json($borderColors) : 'rgb(59, 130, 246)',
                borderWidth: 2,
                tension: .35,
                fill: chartType === 'line'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: chartType === 'doughnut' ? {} : { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });
}
</script>
@endpush
