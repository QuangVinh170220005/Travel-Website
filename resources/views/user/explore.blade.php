@extends('user.layouts.app')

@section('title', 'Explore')

@section('content')

@php
$featuredExperiences = [
    [
        'id' => 'han-river-cruise',
        'title' => 'Du thuyền đêm trên sông Hàn',
        'image' => 'https://static.vinwonders.com/2022/12/du-thuyen-tren-song-han-banner.jpg',
        'slug' => 'du-thuyen-dem-tren-song-han'
    ],
    [
        'id' => 'bana-hills-ticket',
        'title' => 'Vé Sun World Ba Na Hills',
        'image' => 'https://owa.bestprice.vn/images/tickets/uploads/ve-sunworld-ba-na-hills-608fa9d49f3a4.jpg',
        'slug' => 've-sun-world-ba-na-hills'
    ],
    [
        'id' => 'bana-hills-tour',
        'title' => 'Tour Bà Nà Hills trọn ngày với bữa trưa buffet',
        'image' => 'https://havatravel.vn/upload/images/tour-ba-na-hill-1-ngay%20-havatravel(1).jpeg',
        'slug' => 'tour-ba-na-hills-tron-ngay'
    ],
    [
        'id' => 'coconut-forest',
        'title' => 'Tour rừng dừa bằng thuyền thúng',
        'image' => 'https://vpdt.vietrantour.com.vn/data/upload/2024/0129/vietrantour-65b785209e3051.jpg',
        'slug' => 'tour-rung-dua-bang-thuyen-thung'
    ]
];

$popularDestinations = [
    [
        'id' => 'hochiminh',
        'name' => 'TP. Hồ Chí Minh',
        'image' => 'https://dulichkhatvongviet.com/wp-content/uploads/2022/06/dia-diem-du-lich.jpg',
        'activities' => '1491 hoạt động',
        'slug' => 'ho-chi-minh'
    ],
    [
        'id' => 'danang',
        'name' => 'Đà Nẵng',
        'image' => 'https://danangsensetravel.com/view/at_ve-dep-thanh-pho-da-nang-giu-tron-tung-khoanh-khac_6b555585df3ca96d931cf6f4378c9488.jpg',
        'activities' => '2583 hoạt động',
        'slug' => 'da-nang'
    ],
    [
        'id' => 'hanoi',
        'name' => 'Hà Nội',
        'image' => 'https://iwater.vn/Image/Picture/Dia-danh/ha-noi.jpg',
        'activities' => '3969 hoạt động',
        'slug' => 'ha-noi'
    ]
];
@endphp

<div class="container mx-auto px-4 py-8">
    <!-- Featured Experiences Section -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Được gợi ý ở Đà Nẵng</h2>
            <a href="{{ route('explore-all') }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredExperiences as $experience)
            <div class="rounded-lg overflow-hidden shadow-lg bg-white">
                <a href="{{ route('explore-show', $experience['slug']) }}">
                    <div class="relative h-48">
                        <img src="{{ asset($experience['image']) }}" 
                             alt="{{ $experience['title'] }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $experience['title'] }}</h3>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Popular Destinations Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Điểm đến lân cận</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularDestinations as $destination)
            <a href="{{ route('destinations-show', $destination['slug']) }}" 
               class="relative rounded-lg overflow-hidden shadow-lg group">
                <div class="relative h-64">
                    <img src="{{ asset($destination['image']) }}" 
                         alt="{{ $destination['name'] }}"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-xl font-semibold">{{ $destination['name'] }}</h3>
                        <p class="text-sm">{{ $destination['activities'] }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection