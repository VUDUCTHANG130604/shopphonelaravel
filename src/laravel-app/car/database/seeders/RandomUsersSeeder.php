<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RandomUsersSeeder extends Seeder
{
    public function run(): void
    {
        $start = CarbonImmutable::create(2026, 5, 1, 0, 0, 0);
        $end = CarbonImmutable::create(2026, 6, 26, 23, 59, 59);
        $password = Hash::make('password123');
        $nextUserId = ((int) DB::table('users')->max('user_id')) + 1;

        $users = collect([
            ['Nguyen Van An', '0901000001', 'Ha Noi'],
            ['Tran Thi Bich', '0901000002', 'Da Nang'],
            ['Le Minh Chau', '0901000003', 'TP Ho Chi Minh'],
            ['Pham Quoc Dung', '0901000004', 'Can Tho'],
            ['Hoang Gia Han', '0901000005', 'Hai Phong'],
            ['Vo Thanh Khoa', '0901000006', 'Hue'],
            ['Dang Ngoc Linh', '0901000007', 'Nha Trang'],
            ['Bui Tuan Minh', '0901000008', 'Vung Tau'],
            ['Do Phuong Nhi', '0901000009', 'Binh Duong'],
            ['Mai Duc Phat', '0901000010', 'Dong Nai'],
        ])->map(function (array $user, int $index) use ($start, $end, $password, $nextUserId) {
            [$fullName, $phone, $address] = $user;
            $username = 'user2026_'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
            $createdAt = $start->addSeconds(random_int(0, $start->diffInSeconds($end)));

            return [
                'user_id' => $nextUserId + $index,
                'username' => $username,
                'name' => $fullName,
                'full_name' => $fullName,
                'image' => null,
                'email' => $username.'@example.com',
                'phone' => $phone,
                'address' => $address,
                'password' => $password,
                'role' => 0,
                'active' => 1,
                'email_verified_at' => $createdAt,
                'remember_token' => Str::random(10),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        })->all();

        DB::table('users')->insertOrIgnore($users);
    }
}
