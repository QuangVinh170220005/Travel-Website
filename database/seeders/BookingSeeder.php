<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy danh sách users và tour_schedules có sẵn
        $users = DB::table('users')->pluck('user_id')->toArray();
        $schedules = DB::table('tour_schedules')->pluck('schedule_id')->toArray();
        $tours = DB::table('tours')->pluck('tour_id')->toArray();

        // Tạo một số booking mẫu
        $bookings = [];
        for ($i = 0; $i < 10; $i++) {
            $bookings[] = [
                'user_id' => $users[array_rand($users)],
                'tour_id' => $tours[array_rand($tours)],
                'schedule_id' => $schedules[array_rand($schedules)],
                'booking_date' => Carbon::now()->subDays(rand(1, 30)),
                'total_amount' => rand(1000000, 10000000),
                'status' => array_rand(['PENDING' => 0, 'CONFIRMED' => 1, 'CANCELLED' => 2]),
                'special_requests' => ['Cần hỗ trợ xe lăn', 'Ăn chay', 'Đón sớm'][array_rand([0,1,2])],
                'deposit_amount' => function($data) {
                    return $data['total_amount'] * 0.3; // 30% đặt cọc
                },
                'need_pickup' => rand(0, 1),
                'pickup_location' => 'Bến xe miền Đông',
                'created_at' => now()
                // Đã xóa updated_at vì không có trong schema
            ];
        }

        // Insert dữ liệu
        foreach ($bookings as $booking) {
            if (is_callable($booking['deposit_amount'])) {
                $booking['deposit_amount'] = $booking['deposit_amount']($booking);
            }
            DB::table('bookings')->insert($booking);
        }
    }
}
