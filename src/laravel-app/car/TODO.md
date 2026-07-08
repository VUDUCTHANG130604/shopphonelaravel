# TODO - Quy trình chuyển code PHP -> Laravel (theo dự án hiện tại)

## Giai đoạn 1: Khảo sát & map luồng
- [x] Đọc các entry point: `index.php`, `admin/index.php`, `routes/web.php`
- [x] Lập danh sách các route hiện tại (user/front + admin) từ switch-case
- [x] Xác định controller/action tương ứng trong Laravel

## Giai đoạn 2: Tạo routing + controller (chạy song song)
- [x] Tạo route mới cho các URL quan trọng (front + admin) trong `routes/web.php`
- [x] Tạo controller skeleton `FrontController` và `AdminController` trả `welcome` tạm thời
- [x] Kiểm tra nhanh route admin bằng `php artisan route:list --path=admin`

## Giai đoạn 3: Chuyển view sang Blade
- [x] Adapter legacy view sang Blade để chạy tạm (legacy/*)
- [ ] Chuyển các view checkout/thanhtoan từ `include(legacy.*)` sang Blade-native cho toàn bộ luồng

## Giai đoạn 4: Chuyển database layer
- [ ] Tạo Eloquent model (vd: `Product`, `Category`, ...)
- [ ] Viết repository/service chuyển các hàm trong `models/*Model.php`

## Giai đoạn 5: Xử lý Cart/Checkout/Auth
- [ ] Chuyển cart sang session Laravel
- [ ] Chuyển thanh toán sang controller + service (giữ luồng cũ nếu cần)
- [ ] Chuyển auth user và admin (guard/middleware)

## Giai đoạn 6: Admin + Export/Charts/Stats
- [ ] Tạo prefix `admin` và route cho admin chức năng

## Kiểm tra
- [ ] Chạy `php artisan test` (nếu có)
- [ ] Manual luồng: browse/search/filter/product detail/cart/checkout/order
- [ ] Kiểm tra admin: login/list/edit + export

