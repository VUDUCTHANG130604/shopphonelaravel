<?php

namespace App\Services;

use Illuminate\Support\Collection;

class PostService
{
    protected \Closure $legacy;

    public function __construct()
    {
        // Adapter nhanh: dùng PostModel legacy để lấy dữ liệu
        // (vì bạn chọn hướng (2) chuyển chuẩn Laravel nhưng vẫn cần port dữ liệu nhanh cho trang mới).
        $this->legacy = function () {
            $path = base_path('..') . '/duanmobiphone/models/PostModel.php';
            if (!file_exists($path)) {
                $path = base_path('duanmobiphone/models/PostModel.php');
            }

            require_once $path;

            // legacy file tạo biến $PostModel ở global scope
            return isset($GLOBALS['PostModel']) ? $GLOBALS['PostModel'] : null;
        };
    }

    private function legacyModel()
    {
        $model = ($this->legacy)();
        return $model;
    }

    public function selectAllPosts(): Collection
    {
        $m = $this->legacyModel();
        if (!$m) {
            return collect();
        }
        return collect($m->select_all_posts());
    }

    public function selectPostCategories(): Collection
    {
        $m = $this->legacyModel();
        if (!$m) {
            return collect();
        }
        return collect($m->select_post_category());
    }

    public function selectPostsByCategory(int $categoryId): Collection
    {
        if ($categoryId <= 0) {
            return collect();
        }

        $m = $this->legacyModel();
        if (!$m) {
            return collect();
        }

        return collect($m->select_post_by_catgory($categoryId));
    }

    public function selectPostById(int $postId): ?array
    {
        if ($postId <= 0) {
            return null;
        }

        $m = $this->legacyModel();
        if (!$m) {
            return null;
        }

        $row = $m->select_post_by_id($postId);
        if (!$row) {
            return null;
        }

        return $row;
    }
}


