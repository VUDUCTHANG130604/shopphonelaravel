<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportDuan1PhoneLegacySeeder extends Seeder
{
    private string $legacyDatabase = 'duan1_phone';

    public function run(): void
    {
        if (!$this->legacyTableExists('products')) {
            $this->command->error("Cannot read {$this->legacyDatabase}.products. Start MySQL and import duan1_phone.sql first.");
            return;
        }

        $this->importUsers();
        $this->importCategories();
        $this->importProducts();
        $this->importPostCategories();
        $this->importPosts();
        $this->importComments();
        $this->importCarts();
        $this->importOrders();
        $this->importOrderDetails();
        $this->importAddresses();
        $this->importWarehouse();
    }

    private function legacyTableExists(string $table): bool
    {
        try {
            DB::selectOne("SELECT 1 FROM {$this->legacyDatabase}.{$table} LIMIT 1");
            return true;
        } catch (\Throwable) {
            return false;
        }
    }

    private function importUsers(): void
    {
        if (!$this->legacyTableExists('users')) {
            return;
        }

        $rows = DB::table("{$this->legacyDatabase}.users")
            ->select(['user_id', 'username', 'password', 'full_name', 'image', 'email', 'phone', 'address', 'role', 'active'])
            ->get()
            ->map(function ($row) {
                $data = (array) $row;
                $data['name'] = $data['full_name'] ?: $data['username'];
                $data['email'] = $data['email'] ?: "legacy-user-{$data['user_id']}@example.local";
                return $data;
            })
            ->all();

        $seenEmails = [];
        foreach ($rows as &$row) {
            $email = mb_strtolower($row['email']);
            if (isset($seenEmails[$email])) {
                $row['email'] = "legacy-user-{$row['user_id']}@example.local";
            }

            $seenEmails[mb_strtolower($row['email'])] = true;
        }
        unset($row);

        DB::table('users')->upsert($rows, ['user_id'], ['username', 'password', 'full_name', 'image', 'email', 'phone', 'address', 'role', 'active', 'name']);
        $this->command->info('Imported users: '.count($rows));
    }

    private function importCategories(): void
    {
        if (!$this->legacyTableExists('categories')) {
            return;
        }

        $columns = ['category_id', 'name', 'image', 'status'];
        $rows = DB::table("{$this->legacyDatabase}.categories")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('categories')->upsert($rows, ['category_id'], ['name', 'image', 'status']);
        $this->command->info('Imported categories: '.count($rows));
    }

    private function importProducts(): void
    {
        $columns = [
            'product_id',
            'category_id',
            'name',
            'image',
            'quantity',
            'sell_quantity',
            'price',
            'sale_price',
            'create_date',
            'views',
            'details',
            'short_description',
            'status',
        ];

        $rows = DB::table("{$this->legacyDatabase}.products")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('products')->upsert($rows, ['product_id'], array_values(array_diff($columns, ['product_id'])));
        $this->command->info('Imported products: '.count($rows));
    }

    private function importPostCategories(): void
    {
        if (!$this->legacyTableExists('post_categories')) {
            return;
        }

        $columns = ['id', 'name'];
        $rows = DB::table("{$this->legacyDatabase}.post_categories")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('post_categories')->upsert($rows, ['id'], ['name']);
        $this->command->info('Imported post categories: '.count($rows));
    }

    private function importPosts(): void
    {
        if (!$this->legacyTableExists('posts')) {
            return;
        }

        $columns = ['post_id', 'category_id', 'title', 'image', 'author', 'content', 'views', 'status', 'created_at', 'updated_at'];
        $rows = DB::table("{$this->legacyDatabase}.posts")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('posts')->upsert($rows, ['post_id'], array_values(array_diff($columns, ['post_id'])));
        $this->command->info('Imported posts: '.count($rows));
    }

    private function importComments(): void
    {
        if (!$this->legacyTableExists('comments')) {
            return;
        }

        $columns = ['comment_id', 'content', 'date', 'status', 'user_id', 'product_id'];
        $rows = DB::table("{$this->legacyDatabase}.comments")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('comments')->upsert($rows, ['comment_id'], array_values(array_diff($columns, ['comment_id'])));
        $this->command->info('Imported comments: '.count($rows));
    }

    private function importCarts(): void
    {
        if (!$this->legacyTableExists('carts')) {
            return;
        }

        $columns = ['cart_id', 'product_id', 'user_id', 'product_name', 'product_price', 'product_quantity', 'product_image'];
        $rows = DB::table("{$this->legacyDatabase}.carts")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('carts')->upsert($rows, ['cart_id'], array_values(array_diff($columns, ['cart_id'])));
        $this->command->info('Imported carts: '.count($rows));
    }

    private function importOrders(): void
    {
        if (!$this->legacyTableExists('orders')) {
            return;
        }

        $columns = ['order_id', 'user_id', 'date', 'total', 'address', 'phone', 'note', 'status'];
        $rows = DB::table("{$this->legacyDatabase}.orders")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('orders')->upsert($rows, ['order_id'], array_values(array_diff($columns, ['order_id'])));
        $this->command->info('Imported orders: '.count($rows));
    }

    private function importOrderDetails(): void
    {
        if (!$this->legacyTableExists('orderdetails')) {
            return;
        }

        $rows = DB::table("{$this->legacyDatabase}.orderdetails")
            ->select(['orderdetails_id', 'order_id', 'product_id', 'quantity', 'price'])
            ->get()
            ->map(function ($row) {
                $data = (array) $row;
                $data['id'] = $data['orderdetails_id'];
                unset($data['orderdetails_id']);
                return $data;
            })
            ->all();

        DB::table('orderdetails')->upsert($rows, ['id'], ['order_id', 'product_id', 'quantity', 'price']);
        $this->command->info('Imported order details: '.count($rows));
    }

    private function importAddresses(): void
    {
        if (!$this->legacyTableExists('address')) {
            return;
        }

        $columns = ['id', 'user_id', 'address'];
        $rows = DB::table("{$this->legacyDatabase}.address")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('address')->upsert($rows, ['id'], ['user_id', 'address']);
        $this->command->info('Imported addresses: '.count($rows));
    }

    private function importWarehouse(): void
    {
        if (!$this->legacyTableExists('warehouse')) {
            return;
        }

        $columns = ['id', 'name', 'price', 'quantity', 'sell', 'created_at'];
        $rows = DB::table("{$this->legacyDatabase}.warehouse")->select($columns)->get()->map(fn ($row) => (array) $row)->all();

        DB::table('warehouse')->upsert($rows, ['id'], ['name', 'price', 'quantity', 'sell', 'created_at']);
        $this->command->info('Imported warehouse: '.count($rows));
    }
}
