@extends('layouts.admin')

@section('title', 'Top lượt bán')

@push('styles')
<style>
.chart-page-container{background:#f9fafb;min-height:100vh;padding:2rem 0}
.chart-card{background:#fff;border-radius:.75rem;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:2rem;max-width:1400px;margin:0 auto}
.chart-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem;padding-bottom:1.5rem;border-bottom:2px solid #e5e7eb}
.chart-title{font-size:1.5rem;font-weight:700;color:#111827;margin:0;display:flex;align-items:center;gap:.75rem}
.chart-badge{display:inline-flex;align-items:center;padding:.25rem .75rem;background:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);color:#fff;font-size:.875rem;font-weight:600;border-radius:9999px}
.dropdown-btn{position:relative;display:inline-flex;align-items:center;gap:.5rem;padding:.625rem 1.25rem;background:#fff;color:#374151;font-size:.875rem;font-weight:500;border:1.5px solid #d1d5db;border-radius:.5rem;cursor:pointer;transition:all .2s;text-decoration:none}
.dropdown-btn:hover{background:#f9fafb;border-color:#3b82f6;color:#3b82f6}
.dropdown-menu{background:#fff;border:1px solid #e5e7eb;border-radius:.5rem;box-shadow:0 10px 25px -5px rgba(0,0,0,.1);margin-top:.5rem;padding:.5rem 0;min-width:180px}
.dropdown-item{padding:.625rem 1rem;color:#374151;font-size:.875rem;font-weight:500;transition:all .15s;text-decoration:none;display:flex;align-items:center;gap:.5rem}
.dropdown-item:hover{background:#f3f4f6;color:#3b82f6;padding-left:1.25rem}
.dropdown-item.active{background:#eff6ff;color:#3b82f6;font-weight:600}
.chart-wrapper{position:relative;height:500px;margin-top:1.5rem}
.chart-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:2rem;padding:1rem;background:#f9fafb;border-radius:.5rem}
.stat-item{text-align:center;padding:.75rem}
.stat-label{font-size:.75rem;font-weight:500;color:#6b7280;text-transform:uppercase;letter-spacing:.05em}
.stat-value{font-size:1.5rem;font-weight:700;color:#111827;margin-top:.25rem}
@media(max-width:768px){.chart-page-container{padding:1rem 0}.chart-card{padding:1.5rem;border-radius:0}.chart-header{flex-direction:column;align-items:flex-start}.chart-title{font-size:1.25rem}.chart-wrapper{height:350px}}
</style>
@endpush

@section('content')
@php
    $backgroundColors = ['rgba(59,130,246,.1)','rgba(139,92,246,.1)','rgba(236,72,153,.1)','rgba(249,115,22,.1)','rgba(34,197,94,.1)','rgba(14,165,233,.1)','rgba(168,85,247,.1)','rgba(239,68,68,.1)','rgba(245,158,11,.1)','rgba(16,185,129,.1)','rgba(99,102,241,.1)','rgba(244,63,94,.1)','rgba(6,182,212,.1)','rgba(132,204,22,.1)','rgba(251,146,60,.1)'];
    $borderColors = ['rgb(59,130,246)','rgb(139,92,246)','rgb(236,72,153)','rgb(249,115,22)','rgb(34,197,94)','rgb(14,165,233)','rgb(168,85,247)','rgb(239,68,68)','rgb(245,158,11)','rgb(16,185,129)','rgb(99,102,241)','rgb(244,63,94)','rgb(6,182,212)','rgb(132,204,22)','rgb(251,146,60)'];
@endphp
<div class="chart-page-container">
    <div class="container-fluid px-4">
        <div class="chart-card">
            <div class="chart-header">
                <h5 class="chart-title">
                    <i class="fas fa-chart-bar"></i>
                    Top sản phẩm bán chạy
                    <span class="chart-badge">{{ $top }} sản phẩm</span>
                </h5>
                <div class="dropdown">
                    <a class="dropdown-btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>Chọn top</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach([100 => 'Xem tất cả', 5 => 'Top 5', 10 => 'Top 10', 15 => 'Top 15', 30 => 'Top 30'] as $value => $label)
                            <li><a href="{{ route('admin.stats.top', ['top' => $value]) }}" class="dropdown-item {{ $top === $value ? 'active' : '' }}">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="chart-stats">
                <div class="stat-item"><div class="stat-label">Tổng đã bán</div><div class="stat-value">{{ number_format($rows->sum('sold')) }}</div></div>
                <div class="stat-item"><div class="stat-label">Sản phẩm</div><div class="stat-value">{{ $rows->count() }}</div></div>
                <div class="stat-item"><div class="stat-label">Cao nhất</div><div class="stat-value">{{ number_format((int) $rows->max('sold')) }}</div></div>
            </div>

            <div class="chart-wrapper">
                <canvas id="topOrdersChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
if (window.Chart && document.getElementById('topOrdersChart')) {
    new Chart(document.getElementById('topOrdersChart'), {
        type: 'bar',
        data: {
            labels: @json($rows->pluck('name')->values()),
            datasets: [{
                label: 'Số lượng đã bán',
                data: @json($rows->pluck('sold')->map(fn ($value) => (int) $value)->values()),
                backgroundColor: @json($backgroundColors),
                borderColor: @json($borderColors),
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
}
</script>
@endpush
