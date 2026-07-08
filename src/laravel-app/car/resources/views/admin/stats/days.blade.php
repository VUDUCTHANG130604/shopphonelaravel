@extends('layouts.admin')

@section('title', 'Lượt bán theo ngày')

@push('styles')
<style>
.chart-page{background:#f9fafb;min-height:100vh;padding:2rem 0}
.chart-container{background:#fff;border-radius:.75rem;padding:2rem;box-shadow:0 1px 3px rgba(0,0,0,.1);max-width:1400px;margin:0 auto}
.chart-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:2px solid #e5e7eb;flex-wrap:wrap;gap:1rem}
.chart-title-section{flex:1;min-width:250px}
.chart-title{font-size:1.5rem;font-weight:700;color:#111827;margin:0 0 .5rem;display:flex;align-items:center;gap:.75rem}
.chart-subtitle{font-size:.875rem;color:#6b7280;margin:0}
.chart-badge{display:inline-flex;align-items:center;padding:.25rem .75rem;background:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);color:#fff;font-size:.875rem;font-weight:600;border-radius:9999px}
.chart-filters{display:flex;gap:.75rem;flex-wrap:wrap}
.filter-btn{background:#fff;border:1.5px solid #d1d5db;color:#374151;padding:.625rem 1rem;border-radius:.5rem;font-size:.875rem;font-weight:500;cursor:pointer;transition:all .2s;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem}
.filter-btn:hover{background:#f9fafb;border-color:#3b82f6;color:#3b82f6;transform:translateY(-1px)}
.chart-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;margin-bottom:2rem;padding:1.5rem;background:#f9fafb;border-radius:.5rem}
.stat-card{text-align:center;padding:1rem;background:#fff;border-radius:.5rem;border:1px solid #e5e7eb}
.stat-label{font-size:.75rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.5rem}
.stat-value{font-size:1.75rem;font-weight:700;color:#111827}
.chart-wrapper{position:relative;height:450px;margin-top:1.5rem}
@media(max-width:768px){.chart-page{padding:1rem 0}.chart-container{padding:1.5rem;border-radius:0}.chart-header{flex-direction:column;align-items:flex-start}.chart-title{font-size:1.25rem}.chart-filters{width:100%}.filter-btn{flex:1;justify-content:center}.chart-wrapper{height:350px}}
</style>
@endpush

@section('content')
@php
    $chartTypes = ['bar' => 'Cột', 'line' => 'Đường', 'doughnut' => 'Tròn'];
    $backgroundColors = ['rgba(59,130,246,.2)','rgba(239,68,68,.2)','rgba(16,185,129,.2)','rgba(245,158,11,.2)','rgba(139,92,246,.2)','rgba(236,72,153,.2)','rgba(6,182,212,.2)','rgba(132,204,22,.2)','rgba(249,115,22,.2)','rgba(99,102,241,.2)','rgba(20,184,166,.2)','rgba(168,85,247,.2)'];
    $borderColors = ['rgb(59,130,246)','rgb(239,68,68)','rgb(16,185,129)','rgb(245,158,11)','rgb(139,92,246)','rgb(236,72,153)','rgb(6,182,212)','rgb(132,204,22)','rgb(249,115,22)','rgb(99,102,241)','rgb(20,184,166)','rgb(168,85,247)'];
@endphp
<div class="chart-page">
    <div class="container-fluid px-4">
        <div class="chart-container">
            <div class="chart-header">
                <div class="chart-title-section">
                    <h5 class="chart-title">
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
                                <li><a href="{{ route('admin.stats.days', ['type_chart' => $type, 'limit_day' => $limitDay]) }}" class="dropdown-item {{ $chartType === $type ? 'active' : '' }}">Biểu đồ {{ strtolower($label) }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar"></i><span>Thời gian</span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach([100 => 'Tất cả', 7 => '7 ngày', 14 => '14 ngày', 21 => '21 ngày', 30 => '30 ngày'] as $days => $label)
                                <li><a href="{{ route('admin.stats.days', ['type_chart' => $chartType, 'limit_day' => $days]) }}" class="dropdown-item {{ $limitDay === $days ? 'active' : '' }}">{{ $label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="chart-stats">
                <div class="stat-card"><div class="stat-label">Tổng đã bán</div><div class="stat-value" style="color:#3b82f6">{{ number_format($summary['total_sold']) }}</div></div>
                <div class="stat-card"><div class="stat-label">Trung bình/ngày</div><div class="stat-value" style="color:#8b5cf6">{{ number_format($summary['avg_sold'], 1) }}</div></div>
                <div class="stat-card"><div class="stat-label">Cao nhất</div><div class="stat-value" style="color:#10b981">{{ number_format($summary['max_sold']) }}</div></div>
                <div class="stat-card"><div class="stat-label">Thấp nhất</div><div class="stat-value" style="color:#f59e0b">{{ number_format($summary['min_sold']) }}</div></div>
            </div>

            <div class="chart-wrapper">
                <canvas id="salesByDayChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
if (window.Chart && document.getElementById('salesByDayChart')) {
    var chartType = @json($chartType);
    new Chart(document.getElementById('salesByDayChart'), {
        type: chartType,
        data: {
            labels: @json($rows->pluck('day')->values()),
            datasets: [{
                label: 'Số lượng đã bán',
                data: @json($rows->pluck('sold_quantity')->map(fn ($value) => (int) $value)->values()),
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
