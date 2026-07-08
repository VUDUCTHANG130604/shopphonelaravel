<?php

$map = [
    'danh-sach-san-pham' => '/admin/san-pham',
    'them-san-pham' => '/admin/san-pham/them',
    'cap-nhat-san-pham' => '/admin/san-pham',
    'thung-rac-san-pham' => '/admin/thung-rac-san-pham',
    'danh-sach-danh-muc' => '/admin/danh-muc',
    'them-danh-muc' => '/admin/danh-muc/them',
    'cap-nhat-danh-muc' => '/admin/danh-muc',
    'danh-sach-don-hang' => '/admin/don-hang',
    'danh-sach-don-cho' => '/admin/don-hang',
    'cap-nhat-don-hang' => '/admin/don-hang',
    'danh-sach-bai-viet' => '/admin/bai-viet',
    'them-bai-viet' => '/admin/bai-viet/them',
    'cap-nhat-bai-viet' => '/admin/bai-viet',
    'danh-muc-bai-viet' => '/admin/danh-muc-bai-viet',
    'cap-nhat-danh-muc-bai-viet' => '/admin/danh-muc-bai-viet',
    'danh-sach-khach-hang' => '/admin/thanh-vien',
    'them-tai-khoan' => '/admin/thanh-vien/them',
    'binh-luan' => '/admin/binh-luan',
    'chi-tiet-binh-luan' => '/admin/binh-luan',
    'thong-ke-san-pham' => '/admin/thong-ke-san-pham',
    'thong-ke-don-hang' => '/admin/thong-ke-don-hang',
    'bieu-do-luot-ban' => '/admin/bieu-do-luot-ban',
    'top-luot-ban' => '/admin/top-luot-ban',
    'luot-ban-theo-ngay' => '/admin/luot-ban-theo-ngay',
    'xuat-exel' => '/admin/xuat-exel',
    'kho-hang' => '/admin/kho-hang',
    'kho-hang2' => '/admin/kho-hang2',
    'nhap-hang' => '/admin/nhap-hang',
    'them-hoa-don' => '/admin/them-hoa-don',
];

if (!isset($_GET['quanli'])) {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__.'/../index.php';
    require __DIR__.'/../index.php';
    exit;
}

$target = $map[$_GET['quanli']] ?? '/admin';
header('Location: '.$target, true, 302);
exit;
