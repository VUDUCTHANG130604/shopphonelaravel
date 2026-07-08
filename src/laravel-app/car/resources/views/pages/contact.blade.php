@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')
<div class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-links">
            <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa fa-home"></i> Trang chủ</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Liên hệ</span>
        </div>
    </div>
</div>

<div class="contact-section">
    <div class="container mb-5">
        <div class="page-header">
            <h1 class="page-title">Liên Hệ Với Chúng Tôi</h1>
            <p class="page-description">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn 24/7</p>
        </div>

        <div class="contact-grid">
            <div class="contact-left">
                <div class="info-card">
                    <div class="card-header"><i class="fas fa-info-circle"></i><h4>Thông Tin Liên Hệ</h4></div>
                    <div class="info-list">
                        <div class="info-item"><div class="info-icon"><i class="fas fa-map-marker-alt"></i></div><div class="info-content"><h6>Địa chỉ cửa hàng</h6><p>Đại học Công nghệ Đông Á</p></div></div>
                        <div class="info-item"><div class="info-icon"><i class="fas fa-phone"></i></div><div class="info-content"><h6>Hotline</h6><a href="tel:0123456789">0123 456 789</a></div></div>
                        <div class="info-item"><div class="info-icon"><i class="fas fa-envelope"></i></div><div class="info-content"><h6>Email</h6><a href="mailto:20220468@eaut.edu.vn">20220468@eaut.edu.vn</a></div></div>
                        <div class="info-item"><div class="info-icon"><i class="fas fa-clock"></i></div><div class="info-content"><h6>Giờ làm việc</h6><p>T2 - T7: 8:00 - 20:00<br>Chủ nhật: 9:00 - 18:00</p></div></div>
                    </div>
                </div>

                <div class="form-card">
                    <div class="card-header"><i class="fas fa-paper-plane"></i><h4>Gửi Tin Nhắn</h4></div>
                    <form class="contact-form" onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã gửi liên hệ.');">
                        <div class="form-group"><label>Họ và tên <span class="required">*</span></label><input type="text" placeholder="Nhập họ tên" required></div>
                        <div class="form-row">
                            <div class="form-group"><label>Email <span class="required">*</span></label><input type="email" placeholder="your@email.com" required></div>
                            <div class="form-group"><label>Số điện thoại</label><input type="tel" placeholder="0123456789"></div>
                        </div>
                        <div class="form-group"><label>Chủ đề</label><select><option>Chọn chủ đề</option><option>Hỏi về sản phẩm</option><option>Đơn hàng</option><option>Hỗ trợ kỹ thuật</option><option>Khác</option></select></div>
                        <div class="form-group"><label>Tin nhắn <span class="required">*</span></label><textarea rows="5" placeholder="Nội dung tin nhắn..." required></textarea></div>
                        <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i>Gửi tin nhắn</button>
                    </form>
                </div>
            </div>

            <div class="contact-right">
                <div class="map-card">
                    <div class="card-header"><i class="fas fa-map-marked-alt"></i><h4>Vị Trí Cửa Hàng</h4></div>
                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps?q=Truong+Dai+hoc+Cong+nghe+Dong+A&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="links-card">
                        <h4 class="card-title">Liên Kết Nhanh</h4>
                        <div class="links-grid">
                            <a href="{{ route('shop.legacy') }}" class="link-item"><i class="fas fa-shopping-bag"></i><span>Cửa hàng</span></a>
                            <a href="{{ route('contact') }}" class="link-item"><i class="fas fa-info-circle"></i><span>Giới thiệu</span></a>
                            <a href="{{ route('contact') }}" class="link-item"><i class="fas fa-file-alt"></i><span>Chính sách</span></a>
                            <a href="{{ route('blog.index') }}" class="link-item"><i class="fas fa-newspaper"></i><span>Tin tức</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.breadcrumb-section{background:#f9fafb;padding:14px 0;border-bottom:1px solid #e5e7eb}.breadcrumb-links{display:flex;align-items:center;gap:8px;font-size:14px}.breadcrumb-item{color:#6b7280;text-decoration:none;font-weight:500;transition:color .2s}.breadcrumb-item:hover{color:#dc2626}.breadcrumb-separator{color:#d1d5db}.breadcrumb-current{color:#dc2626;font-weight:600}.contact-section{background:#fff;min-height:100vh;padding:40px 0 60px}.page-header{text-align:center;margin-bottom:40px;padding-bottom:24px;border-bottom:2px solid #f3f4f6}.page-title{font-size:1.875rem;font-weight:700;color:#111827;margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px}.page-description{font-size:.9375rem;color:#6b7280}.contact-grid{display:grid;grid-template-columns:1fr;gap:24px}@media(min-width:1024px){.contact-grid{grid-template-columns:1.2fr 1fr;gap:32px}}.contact-left{display:flex;flex-direction:column;gap:24px}.info-card,.form-card,.map-card,.links-card{background:#fff;border:1px solid #e5e7eb;border-radius:8px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,.05);transition:all .3s}.info-card:hover,.form-card:hover,.map-card:hover,.links-card:hover{box-shadow:0 4px 12px rgba(220,38,38,.1);border-color:#dc2626}.card-header{display:flex;align-items:center;gap:10px;margin-bottom:20px;padding-bottom:16px;border-bottom:2px solid #dc2626;background:transparent}.card-header i{font-size:20px;color:#dc2626}.card-header h4{font-size:1.125rem;font-weight:700;color:#111827;margin:0;text-transform:uppercase;letter-spacing:.3px}.info-list{display:flex;flex-direction:column;gap:16px}.info-item{display:flex;gap:14px;padding:14px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;transition:all .2s}.info-item:hover{background:#fff;border-color:#dc2626;box-shadow:0 2px 8px rgba(220,38,38,.1)}.info-icon{flex-shrink:0;width:48px;height:48px;background:#fef2f2;color:#dc2626;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.125rem}.info-content{flex:1}.info-content h6{font-size:.8125rem;font-weight:700;color:#6b7280;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px}.info-content p{font-size:.9375rem;color:#111827;margin:0;line-height:1.5}.info-content a{font-size:.9375rem;color:#dc2626;text-decoration:none;font-weight:600}.contact-form{display:flex;flex-direction:column;gap:18px}.form-row{display:grid;grid-template-columns:1fr;gap:18px}@media(min-width:640px){.form-row{grid-template-columns:1fr 1fr}}.form-group{display:flex;flex-direction:column;gap:6px}.form-group label{font-size:.875rem;font-weight:600;color:#374151}.required{color:#dc2626}.form-group input,.form-group select,.form-group textarea{width:100%;padding:12px 16px;border:1px solid #d1d5db;border-radius:6px;font-size:.9375rem;color:#111827;background:#fff;transition:all .2s}.form-group input:focus,.form-group select:focus,.form-group textarea:focus{outline:none;border-color:#dc2626;box-shadow:0 0 0 3px rgba(220,38,38,.1)}.form-group textarea{resize:vertical;min-height:100px;font-family:inherit}.btn-submit{width:100%;padding:14px;background:#dc2626;color:#fff;border:none;border-radius:6px;font-size:1rem;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .3s;box-shadow:0 2px 8px rgba(220,38,38,.2)}.btn-submit:hover{background:#b91c1c;box-shadow:0 4px 12px rgba(220,38,38,.3);transform:translateY(-2px)}.contact-right{display:flex;flex-direction:column;gap:24px}@media(min-width:1024px){.contact-right{position:sticky;top:24px;height:fit-content}}.map-wrapper{border-radius:8px;overflow:hidden;height:400px;border:1px solid #e5e7eb}.card-title{font-size:1.125rem;font-weight:700;color:#111827;margin-bottom:16px;text-transform:uppercase;letter-spacing:.3px}.links-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}.link-item{display:flex;flex-direction:column;align-items:center;gap:8px;padding:20px 12px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;text-decoration:none;color:#374151;font-weight:600;font-size:.875rem;transition:all .3s}.link-item i{font-size:1.5rem;color:#dc2626}.link-item:hover{background:#fff;border-color:#dc2626;color:#dc2626;transform:translateY(-4px);box-shadow:0 4px 12px rgba(220,38,38,.1)}@media(max-width:767px){.page-title{font-size:1.5rem}.info-card,.form-card,.map-card,.links-card{padding:20px}.map-wrapper{height:300px}.links-grid{grid-template-columns:1fr}}
</style>
@endsection
