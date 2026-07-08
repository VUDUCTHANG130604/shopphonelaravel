<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDuan1PhoneProductsSeeder extends Seeder
{
    /**
     * Import sản phẩm từ DB legacy (duan1_phone) sang Laravel table products.
     *
     * Mặc định chạy với connection mysql trong config/database.php.
     *
     * Lưu ý:
     * - Bạn cần đảm bảo server MySQL/container có database `duan1_phone` và table `products`.
     * - Mapping cột có thể cần chỉnh nếu schema khác.
     */
    public function run(): void
    {
        $legacyExists = null;
        try {
            $legacyExists = DB::selectOne('SELECT 1 FROM duan1_phone.products LIMIT 1');
        } catch (\Throwable $e) {
            // Không có quyền/không tồn tại DB legacy
            $this->command->error('Cannot read duan1_phone.products: ' . $e->getMessage());
            return;
        }

        if (!$legacyExists) {
            $this->command->info('Legacy database duan1_phone.products not found.');
            return;
        }

        $columns = [
            'product_id',
            'category_id',
            'name',
            'image',
            'quantity',
            'price',
            'sale_price',
            'status',
            'sell_quantity',
            'views',
        ];

        $rows = DB::table('duan1_phone.products')
            ->select($columns)
            ->get()
            ->toArray();

        if (!$rows) {
            $this->command->info('No legacy products rows found.');
            return;
        }

        $updateColumns = array_values(array_diff($columns, ['product_id']));

        DB::table('products')->upsert($rows, ['product_id'], $updateColumns);

        $this->command->info('Imported products from duan1_phone to products. Rows: ' . count($rows));
    }
}

