<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TourScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $tours = DB::table('tours')->get();
        
        foreach ($tours as $tour) {
            // Lấy price_list_id mặc định cho tour này
            $defaultPriceList = DB::table('price_lists')
                ->where('tour_id', $tour->tour_id)
                ->where('is_default', true)
                ->first();

            // Tạo lịch trong 3 tháng tới
            for ($i = 1; $i <= 5; $i++) {
                $departureDate = Carbon::now()->addDays(rand(1, 90));
                $returnDate = $departureDate->copy()->addDays($tour->duration_days);
                
                DB::table('tour_schedules')->insert([
                    'tour_id' => $tour->tour_id,
                    'price_list_id' => $defaultPriceList->price_list_id,
                    'departure_date' => $departureDate,
                    'return_date' => $returnDate,
                    'available_slots' => rand(5, $tour->max_participants),
                    'status' => 'OPEN',
                    'meeting_point' => 'Văn phòng công ty - 123 Nguyễn Huệ, Q1, TP.HCM',
                    'meeting_time' => sprintf('%02d:00:00', rand(6, 9)) // Giờ họp mặt từ 6-9h sáng
                ]);
            }
        }
    }
}
