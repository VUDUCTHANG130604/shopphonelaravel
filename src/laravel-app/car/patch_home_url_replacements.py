from pathlib import Path
path = Path(r'd:\Đồ án tốt nghiệp\DATN\DUANPHONE\src\laravel-app\car\resources\views\home.blade.php')
text = path.read_text(encoding='utf-8')
replacements = [
    ("window.location.href='{{ url('/dang-nhap') }}';", "window.location.href='{{ route('front.login') }}';"),
    ("href=\"{{ url('/cua-hang') }}\"", "href=\"{{ route('front.shop') }}\""),
    ("href=\"/san-pham/{{ $product_id }}\"", "href=\"{{ route('front.product.detail', $product_id) }}\""),
    ("href=\"/chi-tiet-bai-viet?id={{ $post_id }}\"", "href=\"{{ route('front.blog.detail', ['id' => $post_id]) }}\""),
]
for old, new in replacements:
    text = text.replace(old, new)
path.write_text(text, encoding='utf-8')
print('done')
