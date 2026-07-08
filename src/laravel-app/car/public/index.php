<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (isset($_GET['url'])) {
    $id = $_GET['id'] ?? $_GET['id_sp'] ?? $_GET['post_id'] ?? null;
    $categoryId = $_GET['id'] ?? $_GET['id_dm'] ?? null;
    $keyword = $_GET['query'] ?? $_GET['keyword'] ?? null;
    $search = $keyword ? '?query='.urlencode($keyword) : '';
    $map = [
        'trang-chu' => '/',
        'cua-hang' => '/cua-hang',
        'chitietsanpham' => $id ? '/san-pham/'.$id : '/cua-hang',
        'danh-muc-san-pham' => $categoryId ? '/danh-muc-san-pham/'.$categoryId : '/cua-hang',
        'lien-he' => '/lien-he',
        'gio-hang' => '/gio-hang',
        'thanh-toan' => '/thanh-toan',
        'thanh-toan-2' => '/thanh-toan-2',
        'thanh-toan-momo' => '/thanh-toan-momo',
        'thanh-toan-momo-address' => '/thanh-toan-momo-address',
        'thanh-toan-momo-address-2' => '/thanh-toan-momo-address-2',
        'thanh-toan-dia-chi2' => '/thanh-toan-dia-chi2',
        'remove-address' => '/remove-address',
        'cam-on' => '/cam-on',
        'don-hang' => '/don-hang',
        'chi-tiet-don-hang' => $id ? '/chi-tiet-don-hang/'.$id : '/don-hang',
        'dang-nhap' => '/dang-nhap',
        'dang-ky' => '/dang-ky',
        'thong-tin-tai-khoan' => '/thong-tin-tai-khoan',
        'ho-so' => '/ho-so',
        'them-dia-chi' => '/them-dia-chi',
        'doi-mat-khau' => '/doi-mat-khau',
        'quen-mat-khau' => '/quen-mat-khau',
        'khoi-phuc-mat-khau' => '/khoi-phuc-mat-khau',
        'bai-viet' => '/bai-viet',
        'chi-tiet-bai-viet' => $id ? '/chi-tiet-bai-viet/'.$id : '/bai-viet',
        'danh-muc-bai-viet' => $id ? '/danh-muc-bai-viet/'.$id : '/bai-viet',
        'tim-kiem' => '/tim-kiem'.$search,
    ];

    header('Location: '.($map[$_GET['url']] ?? '/'), true, 302);
    exit;
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
