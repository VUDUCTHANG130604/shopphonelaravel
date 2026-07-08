<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RandomAddressesSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            'user2026_01' => ['12 Nguyen Trai, Quan Thanh Xuan, Ha Noi', '45 Tran Duy Hung, Quan Cau Giay, Ha Noi'],
            'user2026_02' => ['26 Bach Dang, Quan Hai Chau, Da Nang', '88 Nguyen Van Linh, Quan Thanh Khe, Da Nang'],
            'user2026_03' => ['135 Le Van Sy, Quan 3, TP Ho Chi Minh', '72 Nguyen Thi Minh Khai, Quan 1, TP Ho Chi Minh'],
            'user2026_04' => ['18 Tran Phu, Quan Ninh Kieu, Can Tho', '50 Mau Than, Quan Ninh Kieu, Can Tho'],
            'user2026_05' => ['39 Lach Tray, Quan Ngo Quyen, Hai Phong', '102 To Hieu, Quan Le Chan, Hai Phong'],
            'user2026_06' => ['21 Hung Vuong, TP Hue, Thua Thien Hue', '64 Le Loi, TP Hue, Thua Thien Hue'],
            'user2026_07' => ['14 Tran Phu, TP Nha Trang, Khanh Hoa', '99 Nguyen Thien Thuat, TP Nha Trang, Khanh Hoa'],
            'user2026_08' => ['7 Ba Cu, TP Vung Tau, Ba Ria Vung Tau', '120 Le Hong Phong, TP Vung Tau, Ba Ria Vung Tau'],
            'user2026_09' => ['33 Dai Lo Binh Duong, TP Thu Dau Mot, Binh Duong', '56 Phu Loi, TP Thu Dau Mot, Binh Duong'],
            'user2026_10' => ['91 Pham Van Thuan, TP Bien Hoa, Dong Nai', '28 Vo Thi Sau, TP Bien Hoa, Dong Nai'],
        ];

        DB::transaction(function () use ($addresses) {
            foreach ($addresses as $username => [$defaultAddress, $savedAddress]) {
                $user = DB::table('users')->where('username', $username)->first();

                if (!$user) {
                    continue;
                }

                DB::table('users')
                    ->where('user_id', $user->user_id)
                    ->update([
                        'address' => $defaultAddress,
                        'updated_at' => now(),
                    ]);

                DB::table('address')->updateOrInsert(
                    ['user_id' => $user->user_id],
                    [
                        'address' => $savedAddress,
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        });
    }
}
