<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(ImportDuan1PhoneLegacySeeder::class);
        $this->call(RandomUsersSeeder::class);
        $this->call(RandomAddressesSeeder::class);
        $this->call(RandomOrdersSeeder::class);
        $this->call(RandomCommentsSeeder::class);
    }
}
