<div style="border: 1px solid #fce4ec;"></div>

<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="footer-intro">
                    <p class="intro-text">
                        Chào mừng quý khách đến với website. Hãy lựa chọn và đặt hàng ngay để được giao hàng nhanh.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h6>Đường dẫn</h6>
                    <ul>
                        <li><a href="{{ route('home') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('blog.index') }}">Blogs</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer-menu">
                    <h6>Tài khoản</h6>
                    <ul>
                        <li><a href="{{ route('account.show') }}">Tài khoản của tôi</a></li>
                        <li><a href="{{ route('orders.index') }}">Theo dõi đơn hàng</a></li>
                        <li><a href="{{ route('checkout') }}">Thanh toán</a></li>
                        <li><a href="{{ route('cart.index') }}">Giỏ hàng</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="footer-subscribe">
                    <h6>Đăng ký nhận tin</h6>
                    <p class="subscribe-text">Nhận thông tin về sản phẩm mới và ưu đãi đặc biệt</p>
                    <form action="#" class="subscribe-form">
                        <div class="input-group">
                            <input type="email" placeholder="Nhập email của bạn">
                            <button type="submit" class="submit-btn"><i class="fa fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <div class="payment-methods">
                        <span class="payment-label">Phương thức thanh toán</span>
                        <div class="payment-logos">
                            <img src="{{ asset('img/payment/payment-1.png') }}" alt="Visa">
                            <img src="{{ asset('img/payment/payment-2.png') }}" alt="Mastercard">
                            <img src="{{ asset('img/payment/payment-3.png') }}" alt="PayPal">
                            <img src="{{ asset('img/payment/payment-4.png') }}" alt="Momo">
                            <img src="{{ asset('img/payment/payment-5.png') }}" alt="Zalopay">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form action="{{ route('shop.search') }}" method="get" class="search-model-form">
            <input type="search" name="query" id="search-input" placeholder="TÌM KIẾM.....">
        </form>
    </div>
</div>

<style>
.site-footer { background: #fff; color: #000; padding: 64px 0 0; position: relative; }
.site-footer::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, #ef4444, transparent); }
.footer-intro, .footer-menu, .footer-subscribe { margin-bottom: 32px; }
.intro-text { font-size: 15px; line-height: 1.7; color: #718096; margin-bottom: 24px; }
.social-links { display: flex; gap: 12px; }
.social-links a { display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; background: #fff; color: #ef4444; border-radius: 50%; transition: all .3s ease; border: 2px solid #fce4ec; }
.social-links a:hover { background: #ef4444; color: #fff; border-color: #ef4444; transform: translateY(-4px); box-shadow: 0 6px 20px rgba(255,38,123,.3); text-decoration: none; }
.footer-menu h6, .footer-subscribe h6 { color: #2d3748; font-size: 16px; font-weight: 700; margin-bottom: 20px; position: relative; padding-bottom: 12px; }
.footer-menu h6::after, .footer-subscribe h6::after { content: ''; position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: #ef4444; border-radius: 2px; }
.footer-menu ul { list-style: none; padding: 0; margin: 0; }
.footer-menu ul li { margin-bottom: 12px; }
.footer-menu ul li a { color: #718096; font-size: 15px; text-decoration: none; transition: all .3s ease; display: inline-block; position: relative; }
.footer-menu ul li a:hover { color: #ef4444; padding-left: 8px; }
.subscribe-text { font-size: 14px; color: #718096; margin-bottom: 16px; line-height: 1.6; }
.subscribe-form { margin-bottom: 24px; }
.footer-subscribe .input-group { display: flex; gap: 8px; background: #fff; border-radius: 12px; padding: 6px; border: 2px solid #fce4ec; transition: border-color .3s ease; }
.footer-subscribe .input-group input { flex: 1; min-width: 0; padding: 10px 14px; background: transparent; border: 0; color: #2d3748; font-size: 15px; }
.footer-subscribe .input-group input:focus { outline: 0; }
.submit-btn { padding: 10px 20px; background: #ef4444; color: #fff; border: 0; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all .3s ease; display: flex; align-items: center; justify-content: center; }
.submit-btn:hover { background: #e61a68; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(255,38,123,.3); }
.payment-methods { margin-top: 24px; }
.payment-label { display: block; font-size: 14px; color: #718096; margin-bottom: 12px; font-weight: 500; }
.payment-logos { display: flex; flex-wrap: wrap; gap: 10px; }
.payment-logos img { height: 32px; width: auto; background: #fff; padding: 6px 10px; border-radius: 8px; border: 2px solid #fce4ec; transition: all .3s ease; }
@media (max-width: 767px) {
    .site-footer { padding: 40px 0 0; }
    .footer-subscribe .input-group { flex-direction: column; gap: 10px; }
    .submit-btn { width: 100%; padding: 12px 20px; }
    .social-links, .payment-logos { justify-content: center; }
    .footer-menu h6, .footer-subscribe h6 { text-align: center; }
    .footer-menu h6::after, .footer-subscribe h6::after { left: 50%; transform: translateX(-50%); }
    .footer-menu ul { text-align: center; }
    .intro-text { text-align: center; }
}
</style>
