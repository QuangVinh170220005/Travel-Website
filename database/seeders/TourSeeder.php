<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $tours = [
            [
                'tour_name' => 'Khám phá Hạ Long',
                'description' => 'Tour du lịch Hạ Long trọn gói bao gồm khách sạn 4 sao và du thuyền',
                'duration_days' => 3,
                'max_participants' => 20,
                'category' => 'Nature',
                'transportation' => 'Bus, Cruise',
                'include_hotel' => true,
                'include_meal' => true,
                'highlight_places' => 'Hang Sửng Sốt, Đảo Ti Tốp, Hang Luồn',
                'location_id' => 1,
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'tour_name' => 'Hội An City Tour',
                'description' => 'Khám phá phố cổ Hội An, làng nghề truyền thống',
                'duration_days' => 1,
                'max_participants' => 15,
                'category' => 'Cultural',
                'transportation' => 'Walking, Cyclo',
                'include_hotel' => false,
                'include_meal' => true,
                'highlight_places' => 'Chùa Cầu, Phố cổ, Làng gốm Thanh Hà',
                'location_id' => 2,
                'is_active' => true,
                'created_at' => now()
            ],
            [
                'tour_name' => 'Sapa Trekking Adventure',
                'description' => 'Khám phá Sapa với tour trek đến các bản làng dân tộc',
                'duration_days' => 2,
                'max_participants' => 12,
                'category' => 'Adventure',
                'transportation' => 'Bus, Walking',
                'include_hotel' => true,
                'include_meal' => true,
                'highlight_places' => 'Bản Cát Cát, Thác Bạc, Núi Hàm Rồng',
                'location_id' => 3,
                'is_active' => true,
                'created_at' => now()
            ]
        ];

        DB::table('tours')->insert($tours);
    }
}
