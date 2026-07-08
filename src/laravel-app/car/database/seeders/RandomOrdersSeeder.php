<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RandomOrdersSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('username', 'like', 'user2026\_%')
            ->orderBy('username')
            ->get();

        $products = DB::table('products')
            ->where('status', 1)
            ->where('quantity', '>', 0)
            ->get();

        if ($users->count() < 10) {
            $this->command?->error('Can thieu 10 tai khoan user2026_01 den user2026_10. Hay chay RandomUsersSeeder truoc.');
            return;
        }

        if ($products->isEmpty()) {
            $this->command?->error('Khong co san pham dang hien thi trong database de tao don hang.');
            return;
        }

        DB::transaction(function () use ($users, $products) {
            $seedNote = 'Seed order for user2026 accounts';

            $seedOrderIds = DB::table('orders')
                ->where('note', $seedNote)
                ->pluck('order_id');

            if ($seedOrderIds->isNotEmpty()) {
                DB::table('orderdetails')->whereIn('order_id', $seedOrderIds)->delete();
                DB::table('orders')->whereIn('order_id', $seedOrderIds)->delete();
            }

            $statuses = [
                1, 1, 1, 1, 1,
                3, 3, 3, 3, 3,
                4, 4, 4, 4, 4,
                0, 0, 0, 0, 0,
            ];

            $start = CarbonImmutable::create(2026, 6, 1, 8, 0, 0);
            $end = CarbonImmutable::create(2026, 6, 26, 21, 0, 0);

            foreach ($statuses as $index => $status) {
                $user = $users[$index % $users->count()];
                $date = $start->addSeconds(random_int(0, $start->diffInSeconds($end)));
                $orderItems = $products
                    ->shuffle()
                    ->take(random_int(1, min(3, $products->count())))
                    ->map(function ($product) {
                        $quantity = random_int(1, 2);
                        $price = (int) ($product->sale_price > 0 ? $product->sale_price : $product->price);

                        return compact('product', 'quantity', 'price');
                    });
                $total = $orderItems->sum(fn (array $item) => $item['price'] * $item['quantity']);

                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => $user->user_id,
                    'total' => $total,
                    'address' => $user->address ?: 'Ha Noi',
                    'phone' => $user->phone ?: '0901000000',
                    'note' => $seedNote,
                    'status' => $status,
                    'date' => $date,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                foreach ($orderItems as $item) {
                    DB::table('orderdetails')->insert([
                        'order_id' => $orderId,
                        'product_id' => $item['product']->product_id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        });
    }
}
