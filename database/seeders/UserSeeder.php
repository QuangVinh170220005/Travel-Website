<?php
// php artisan db:seed --class=UserSeeder
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'full_name' => 'Administrator',
            'email' => 'admin@web.com',
            'password' => Hash::make('admin'),
            'role' => 'ADMIN',
            'created_at' => now()
        ]);
    }
}
