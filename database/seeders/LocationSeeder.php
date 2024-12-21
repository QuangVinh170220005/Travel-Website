<?php
// php artisan db:seed --class=LocationSeeder
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'location_name' => 'Hạ Long Bay',
                'province' => 'Quảng Ninh',
                'region' => 'North',
                'description' => 'A UNESCO World Heritage Site featuring thousands of limestone islands and islets rising from emerald waters.',
                'coordinates' => '20.9101,107.1839',
                'is_popular' => true,
                'best_time_to_visit' => 'October to December',
                'weather_notes' => 'Spring (March-April) has light rain. Summer (May-August) is hot with occasional storms.'
            ],
            [
                'location_name' => 'Hội An',
                'province' => 'Quảng Nam',
                'region' => 'Central',
                'description' => 'Ancient trading port featuring unique architecture blending Vietnamese, Chinese and Japanese influences.',
                'coordinates' => '15.8801,108.3380',
                'is_popular' => true,
                'best_time_to_visit' => 'February to July',
                'weather_notes' => 'Dry season from February to July. Rainy season from October to January.'
            ],
            [
                'location_name' => 'Sapa',
                'province' => 'Lào Cai',
                'region' => 'North',
                'description' => 'Mountain town famous for rice terraces, trekking routes and ethnic minority cultures.',
                'coordinates' => '22.3364,103.8438',
                'is_popular' => true,
                'best_time_to_visit' => 'March to May, September to November',
                'weather_notes' => 'Spring and Fall offer the best weather. Winter can be very cold.'
            ],
            [
                'location_name' => 'Phú Quốc',
                'province' => 'Kiên Giang',
                'region' => 'South',
                'description' => 'Vietnam\'s largest island known for pristine beaches, luxury resorts, and pearl farms.',
                'coordinates' => '10.2896,103.9833',
                'is_popular' => true,
                'best_time_to_visit' => 'November to March',
                'weather_notes' => 'Dry season from November to March. Rainy season from July to September.'
            ],
            [
                'location_name' => 'Đà Lạt',
                'province' => 'Lâm Đồng',
                'region' => 'Central Highlands',
                'description' => 'Mountain resort city known for its cool climate, French colonial architecture and flowers.',
                'coordinates' => '11.9404,108.4583',
                'is_popular' => true,
                'best_time_to_visit' => 'December to March',
                'weather_notes' => 'Cool climate year-round. Rainy season from May to October.'
            ],
            [
                'location_name' => 'Nha Trang',
                'province' => 'Khánh Hòa',
                'region' => 'Central',
                'description' => 'Coastal resort city with beautiful beaches, diving sites, and offshore islands.',
                'coordinates' => '12.2388,109.1967',
                'is_popular' => true,
                'best_time_to_visit' => 'March to September',
                'weather_notes' => 'Best weather from March to September. Rainy season from October to December.'
            ]
        ];

        DB::table('locations')->insert($locations);
    }
}
