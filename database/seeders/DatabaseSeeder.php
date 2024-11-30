<?php
// php artisan db:seed
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // UserSeeder::class,          // Chạy đầu tiên vì không phụ thuộc bảng nào
            // LocationSeeder::class,       // Chạy thứ hai vì tours cần location_id
            TourSeeder::class,          // Chạy thứ ba vì price_lists cần tour_id
            PriceListSeeder::class,     // Chạy thứ tư vì tour_schedules cần price_list_id
            TourScheduleSeeder::class,   // Chạy thứ năm vì bookings cần tour_schedule_id
            BookingSeeder::class,        // Chạy cuối cùng vì phụ thuộc vào users và tour_schedules
        ]);
    }
}
