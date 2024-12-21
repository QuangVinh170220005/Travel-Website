<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PriceListSeeder extends Seeder
{
    public function run(): void
    {
        $tours = DB::table('tours')->pluck('tour_id')->toArray();
        
        foreach ($tours as $tourId) {
            // Tạo bảng giá mặc định cho mỗi tour
            DB::table('price_lists')->insert([
                'price_list_name' => 'Bảng giá chuẩn 2024',
                'valid_from' => Carbon::now(),
                'valid_to' => Carbon::now()->addYear(),
                'description' => 'Bảng giá áp dụng cho năm 2024',
                'is_default' => true,
                'tour_id' => $tourId,
                'created_at' => now()
            ]);

            // Tạo bảng giá cho mùa cao điểm
            DB::table('price_lists')->insert([
                'price_list_name' => 'Giá mùa cao điểm 2024',
                'valid_from' => Carbon::create(2024, 6, 1),
                'valid_to' => Carbon::create(2024, 8, 31),
                'description' => 'Bảng giá áp dụng cho mùa cao điểm hè 2024',
                'is_default' => false,
                'tour_id' => $tourId,
                'created_at' => now()
            ]);

            // Tạo bảng giá khuyến mãi
            DB::table('price_lists')->insert([
                'price_list_name' => 'Giá khuyến mãi đầu năm',
                'valid_from' => Carbon::create(2024, 1, 1),
                'valid_to' => Carbon::create(2024, 3, 31),
                'description' => 'Bảng giá khuyến mãi đặc biệt đầu năm 2024',
                'is_default' => false,
                'tour_id' => $tourId,
                'created_at' => now()
            ]);
        }
    }
}
