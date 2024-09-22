<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'password' => bcrypt('123456aA@'),
            'email' => 'plthaotrang@gmail.com',
            'phone_number' => '0336725712',
            'fullname' => 'Phạm Lê Thảo Trang',
        ]);
    }
}
