<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RandomCommentsSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')
            ->where('username', 'like', 'user2026\_%')
            ->orderBy('username')
            ->get();

        $products = DB::table('products')
            ->where('status', 1)
            ->get();

        if ($users->count() < 10) {
            $this->command?->error('Can thieu 10 tai khoan user2026_01 den user2026_10. Hay chay RandomUsersSeeder truoc.');
            return;
        }

        if ($products->isEmpty()) {
            $this->command?->error('Khong co san pham dang hien thi trong database de tao binh luan.');
            return;
        }

        $contents = [
            'San pham dung mo ta, dong goi can than.',
            'May chay muot, pin on, minh kha hai long.',
            'Gia hop ly so voi cau hinh, se ung ho tiep.',
            'Man hinh dep, cam ung nhay va mau sac ro.',
            'Shop tu van nhiet tinh, giao hang nhanh.',
            'San pham con moi, phu kien day du.',
            'Hieu nang tot, dung hang ngay rat on dinh.',
            'Thiet ke dep, cam nam chac tay.',
            'Camera chup anh ro, dung tot trong tam gia.',
            'Da mua va trai nghiem vai ngay, rat dang tien.',
            'May phu hop nhu cau hoc tap va lam viec.',
            'Dong goi ky, nhan hang khong bi tray xuoc.',
            'Chat luong tot hon mong doi.',
            'Pin su dung du lau, sac cung kha nhanh.',
            'San pham dep, shop ho tro rat nhanh.',
            'Mua lam qua tang, nguoi nhan rat thich.',
            'Hang dung nhu thong tin tren website.',
            'Gia tot, tinh nang day du, dang can nhac mua them.',
            'Trai nghiem on dinh, khong gap loi khi su dung.',
            'Se gioi thieu cho ban be neu can mua dien thoai.',
        ];

        DB::transaction(function () use ($users, $products, $contents) {
            DB::table('comments')
                ->whereIn('user_id', $users->pluck('user_id'))
                ->delete();

            $start = CarbonImmutable::create(2026, 6, 1, 9, 0, 0);
            $end = CarbonImmutable::create(2026, 6, 26, 22, 0, 0);

            foreach ($contents as $index => $content) {
                $user = $users[(int) floor($index / 2)];
                $product = $products->random();
                $date = $start->addSeconds(random_int(0, $start->diffInSeconds($end)));

                DB::table('comments')->insert([
                    'content' => $content,
                    'date' => $date,
                    'status' => 1,
                    'user_id' => $user->user_id,
                    'product_id' => $product->product_id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        });
    }
}
