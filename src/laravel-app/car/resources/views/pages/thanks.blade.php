@extends('layouts.app')

@section('title', 'Cảm ơn')

@section('content')
<style>
.thank-page-wrapper{min-height:100vh;background-color:#f9fafb;display:flex;align-items:center;justify-content:center;padding:3rem 1rem;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif}.thank-container{animation:fadeIn .6s ease-out}@keyframes fadeIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}.thank-card{background:#fff;border:1px solid #e5e7eb;border-radius:.5rem;max-width:600px;width:100%;overflow:hidden}.thank-header{background-color:#dc2626;padding:3rem 2rem;text-align:center}.success-icon-wrapper{width:4rem;height:4rem;background-color:#10b981;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;animation:scaleIn .5s ease-out}@keyframes scaleIn{from{transform:scale(0)}to{transform:scale(1)}}.checkmark-svg{width:2.5rem;height:2.5rem;stroke:#fff;stroke-width:3;fill:none;stroke-dasharray:100;stroke-dashoffset:100;animation:drawCheckmark .6s ease-out .3s forwards}@keyframes drawCheckmark{to{stroke-dashoffset:0}}.thank-title{color:#fff;font-size:1.475rem;font-weight:600;margin:0 0 .75rem;line-height:1.2}.thank-subtitle{color:#d1d5db;font-size:.9375rem;line-height:1.5;margin:0;font-weight:400}.thank-body{padding:2rem}.thank-info{background-color:#f9fafb;border:1px solid #e5e7eb;border-radius:.5rem;padding:1.5rem;margin-bottom:1.5rem}.info-row{display:flex;justify-content:space-between;align-items:center;padding:.75rem 0;border-bottom:1px solid #e5e7eb}.info-row:last-child{border-bottom:none;padding-bottom:0}.info-row:first-child{padding-top:0}.info-label{color:#6b7280;font-size:.875rem;font-weight:500;text-transform:uppercase;letter-spacing:.025em}.info-value{color:#dc2626;font-size:.9375rem;font-weight:600}.thank-buttons{display:grid;grid-template-columns:1fr 1fr;gap:.75rem}.thank-btn{display:inline-flex;align-items:center;justify-content:center;gap:.5rem;padding:.75rem 1.5rem;border-radius:.375rem;font-size:.9375rem;font-weight:500;text-decoration:none;transition:all .15s;border:1px solid;cursor:pointer}.thank-btn-primary{background-color:#dc2626;border-color:#dc2626;color:#fff}.thank-btn-primary:hover{background-color:#1f2937;border-color:#1f2937;color:#fff}.thank-btn-secondary{background-color:#fff;border-color:#e5e7eb;color:#374151}.thank-btn-secondary:hover{background-color:#f9fafb;color:#dc2626}.thank-footer{background-color:#f9fafb;border-top:1px solid #e5e7eb;padding:1.5rem 2rem;text-align:center}.thank-footer-text{color:#6b7280;font-size:.875rem;margin:0;line-height:1.5}@media(max-width:640px){.thank-page-wrapper{padding:2rem 1rem}.thank-header{padding:2.5rem 1.5rem}.thank-body{padding:1.5rem}.thank-title{font-size:1.5rem}.thank-subtitle{font-size:.875rem}.thank-buttons{grid-template-columns:1fr}.info-row{flex-direction:column;align-items:flex-start;gap:.25rem}.thank-footer{padding:1.25rem 1.5rem}}
</style>

<div class="thank-page-wrapper">
    <div class="thank-container">
        <div class="thank-card">
            <div class="thank-header">
                <div class="success-icon-wrapper">
                    <svg class="checkmark-svg" viewBox="0 0 52 52"><path d="M14 27l7 7 16-16" /></svg>
                </div>
                <h3 class="thank-title">Đặt hàng thành công</h3>
                <p class="thank-subtitle">Đơn hàng của bạn đã được tiếp nhận và đang xử lý</p>
            </div>

            <div class="thank-body">
                <div class="thank-info">
                    <div class="info-row"><span class="info-label">Trạng thái</span><span class="info-value">Chưa xác nhận</span></div>
                    <div class="info-row"><span class="info-label">Thời gian</span><span class="info-value">Vừa xong</span></div>
                </div>

                <div class="thank-buttons">
                    <a href="{{ route('orders.index') }}" class="thank-btn thank-btn-primary"><i class="fa fa-list"></i><span>Xem đơn hàng</span></a>
                    <a href="{{ route('home') }}" class="thank-btn thank-btn-secondary"><i class="fa fa-home"></i><span>Về trang chủ</span></a>
                </div>
            </div>

            <div class="thank-footer">
                <p class="thank-footer-text">Cảm ơn quý khách đã tin tưởng.<br>Chúng tôi sẽ liên hệ trong thời gian sớm nhất.</p>
            </div>
        </div>
    </div>
</div>
@endsection
