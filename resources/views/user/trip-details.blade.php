@extends('user.layouts.app')

@section('title', $tour->tour_name)

@section('content')

@php
    $villa = [
        'location' => 'Milano, Lombardia, Italy',
        'type' => 'Private Villa',
        'max_guests' => 8,
        'description' => 'Villa Pinewood is a spacious and elegant villa that offers a comfortable and relaxing stay for up to 8 guests. It features 4 bedrooms, 3 bathrooms, a fully-equipped kitchen, a living room, a dining room, and a private pool. The villa is located on a hilltop, overlooking the beautiful ocean and the lush greenery.',
        'chedule' => '',
        'main_image' => 'https://media.istockphoto.com/id/1429367591/vi/anh/m%E1%BB%99t-gia-%C4%91%C3%ACnh-trong-k%E1%BB%B3-ngh%E1%BB%89-h%C3%A8-%C4%91%E1%BB%A9ng-b%C3%AAn-h%E1%BB%93-b%C6%A1i-v%C3%A0-t%E1%BA%ADn-h%C6%B0%E1%BB%9Fng-c%E1%BA%A3nh-ho%C3%A0ng-h%C3%B4n-tuy%E1%BB%87t-%C4%91%E1%BA%B9p.jpg?s=2048x2048&w=is&k=20&c=8nfsgkJNVCzOainEs-Jlq-mTpaqHKQXVAWEjcM3eXDs=',
        'images' => [
            'https://media.istockphoto.com/id/1526986072/vi/anh/m%C3%A1y-bay-bay-tr%C3%AAn-bi%E1%BB%83n-nhi%E1%BB%87t-%C4%91%E1%BB%9Bi-l%C3%BAc-ho%C3%A0ng-h%C3%B4n.jpg?s=2048x2048&w=is&k=20&c=SdCIpE5SDaSfokbkqHttOykEHkzw6MKHSPFQZgMOshM=',
            'https://media.istockphoto.com/id/1412976847/vi/anh/anse-source-dargent-la-digue-seychelles-c%E1%BA%B7p-v%E1%BB%A3-ch%E1%BB%93ng-tr%E1%BA%BB-%C4%91%C3%A0n-%C3%B4ng-v%C3%A0-ph%E1%BB%A5-n%E1%BB%AF-tr%C3%AAn-m%E1%BB%99t-b%C3%A3i-bi%E1%BB%83n.jpg?s=2048x2048&w=is&k=20&c=wXUOy_UeoUHZvV9kpP96kC6ap2pdvI_6eAnQElNMbDY=',
            'https://media.istockphoto.com/id/1499760492/vi/anh/c%E1%BA%B7p-%C4%91%C3%B4i-du-l%E1%BB%8Bch-h%E1%BA%A1nh-ph%C3%BAc-l%C3%A3ng-m%E1%BA%A1n-%C3%B4m-nhau-v%C3%A0-th%E1%BB%B1c-hi%E1%BB%87n-%C4%91i%E1%BB%81u-%C6%B0%E1%BB%9Bc-trong-thung-l%C5%A9ng-tuy%E1%BB%87t-%C4%91%E1%BA%B9p-%E1%BB%9F.jpg?s=2048x2048&w=is&k=20&c=mQngIjqowGZxp19TsgmUosBGE5ld5WGmvkojXNbjVWk=',
        ],

        'host' => [
            'name' => 'Zoyhra Ivalline',
            'avatar' => 'https://media.istockphoto.com/id/1526986072/vi/anh/m%C3%A1y-bay-bay-tr%C3%AAn-bi%E1%BB%83n-nhi%E1%BB%87t-%C4%91%E1%BB%9Bi-l%C3%BAc-ho%C3%A0ng-h%C3%B4n.jpg?s=2048x2048&w=is&k=20&c=SdCIpE5SDaSfokbkqHttOykEHkzw6MKHSPFQZgMOshM=',
            'country' => 'Italia',
            'years_hosting' => 5,
        ],
        'facilities' => [
            ['icon' => '🛏️', 'name' => ' Không gian phòng ngủ rộng rãi, thoải mái cho giấc ngủ ngon.'],
            ['icon' => '🚪', 'name' => 'Check-in nhanh chóng, tiện lợi'],
            ['icon' => '🥘', 'name' => 'Ẩm thực đặc sản - Tour ẩm thực'],
            ['icon' => '🛎️', 'name' => 'Dịch vụ chu đáo, chuyên nghiệp'],
            ['icon' => '🎨', 'name' => 'Văn hóa - Khám phá nghệ thuật, lịch sử'],
            ['icon' => '🚗', 'name' => 'Phương tiện di chuyển tiện lợi, an toàn'],
            ['icon' => '📞', 'name' => 'Hỗ trợ khách hàng 24/7'],
        ],
        'full_address' => 'Milano, Lombardia, Italy',
        'latitude' => 45.4642,
        'longitude' => 9.1900,
        'nearby_places' => [
            ['description' => '10 minutes to supermarket'],
            ['description' => 'Strategic area'],
            ['description' => '15 minutes to coffee shop'],
            ['description' => '20 minutes to the highway'],
        ],
        'terms' => [
            ['description' => 'Check In 02:00 PM and Check Out 12:00 PM'],
            ['description' => 'No animals allowed'],
            ['description' => 'Maximum 8 guests'],
            ['description' => 'No Parties / Event'],
        ],
        'price_per_night' => 100,
        'rating' => 4.67,
        'reviews_count' => 24,
    ];

    // Rating distribution và width classes
    $ratingDistribution = [
        5 => 40,
        4 => 61,
        3 => 5,
        2 => 2,
        1 => 0
    ];

    $widthClasses = [
        '0' => 'w-0',
        '1' => 'w-1/12',
        '2' => 'w-2/12',
        '3' => 'w-3/12',
        '4' => 'w-4/12',
        '5' => 'w-5/12',
        '6' => 'w-6/12',
        '7' => 'w-7/12',
        '8' => 'w-8/12',
        '9' => 'w-9/12',
        '10' => 'w-10/12',
        '11' => 'w-11/12',
        '12' => 'w-full',
    ];

    $reviews = [
        [
            'rating' => 5,
            'author' => 'John Doe',
            'date' => 'October 2024',
            'title' => 'Amazing Stay!',
            'content' => 'We had a wonderful time at Villa Pinewood. The views are breathtaking and the facilities are top-notch. Would definitely recommend!'
        ],
        [
            'rating' => 4,
            'author' => 'Jane Smith',
            'date' => 'September 2024',
            'title' => 'Great Location',
            'content' => 'Perfect location with beautiful surroundings. The villa is well-maintained and comfortable. The host was very responsive and helpful.'
        ],
        [
            'rating' => 5,
            'author' => 'Mike Johnson',
            'date' => 'August 2024',
            'title' => 'Perfect Family Vacation',
            'content' => 'Spacious villa with all the amenities needed for a family vacation. The pool was a hit with the kids. Will definitely come back!'
        ]
    ];

    // Tính toán tổng số review và số review cao nhất
    $totalReviews = array_sum($ratingDistribution);
    $maxCount = max($ratingDistribution);
@endphp


@if($tour->schedules)
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="w-full flex items-center mb-6">
            <!-- All icons in one row -->
            <div class="flex items-center gap-4 w-full">
                <!-- Back Button -->
                <a href="{{ url()->previous() }}" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>

                <!-- Push remaining icons to the right -->
                <div class="flex-grow"></div>

                <!-- Share Button -->
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>

                <!-- Home Button -->
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </button>
            </div>
        </div>
        <h1 class="text-2xl sm:text-3xl font-bold mb-2">{{ $tour->tour_name }}</h1>

        <!-- Image Gallery -->
        <div class="mb-4 mt-4">
            <div class="flex flex-col md:flex-row gap-2">
                <div class="w-full md:w-2/3 relative">
                    <!-- Ảnh chính -->
                    <img id="mainImage" src="{{ asset('storage/' . ($tour->mainImage->image_path ?? 'default.jpg')) }}"
                        alt="Main Tour Image" class="w-full h-[300px] md:h-[525px] object-cover rounded-3xl">
                </div>
                <div class="w-full md:w-1/3 flex flex-row md:flex-col gap-2 md:gap-4">
                    @foreach($tour->images->filter(fn($image) => $image->image_path !== $tour->mainImage->image_path)->take(3) as $index => $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Tour Image {{ $index + 1 }}"
                            onclick="swapImages(this)"
                            class="w-1/3 md:w-full h-[100px] md:h-[164px] object-cover rounded-2xl cursor-pointer hover:opacity-80 transition-opacity"
                            data-original-index="{{ $index }}">
                    @endforeach
                </div>

            </div>
        </div>
        <script>
            function swapImages(clickedImage) {
                const mainImage = document.getElementById('mainImage');
                const mainImageSrc = mainImage.src;
                const clickedImageSrc = clickedImage.src;

                // Hoán đổi ảnh
                mainImage.src = clickedImageSrc;
                clickedImage.src = mainImageSrc;

                // Hiệu ứng fade
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.style.opacity = '1';
                }, 50);
            }

            // Thêm hiệu ứng transition cho ảnh chính
            document.getElementById('mainImage').style.transition = 'opacity 0.3s ease-in-out';
        </script>


        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column -->
            <div class="w-full lg:w-2/3">
                <!-- Host Info -->
                <!-- <div class="flex justify-between items-center mb-6">
                                        <div>
                                            <h2 class="text-xl sm:text-2xl font-semibold">Hosted by {{ $villa['host']['name'] }}</h2>
                                            <p class="text-gray-600 text-sm">{{ $villa['host']['country'] }} • {{ $villa['host']['years_hosting'] }} years hosting</p>
                                        </div>
                                        <img src="{{ $villa['host']['avatar'] }}" alt="{{ $villa['host']['name'] }}" class="w-12 h-12 sm:w-16 sm:h-16 rounded-full">
                                    </div> -->

                <!-- Facilities -->
                <div class="mb-6">
                    <h3 class="text-lg sm:text-xl font-semibold mb-3">What this place offers</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($villa['facilities'] as $facility)
                            <div class="flex items-center">
                                <span class="text-xl sm:text-2xl mr-2">{{ $facility['icon'] }}</span>
                                <span class="text-sm sm:text-base">{{ $facility['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Description -->
                <div class="my-6">
                    <h3 class="text-lg sm:text-xl font-semibold mb-3">About this place</h3>
                    <p class="text-gray-700 text-sm sm:text-base">{{$tour->description}}</p>

                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3">Lịch trình của chuyến đi</h3>
                @if($tour->schedules->count() > 0)

                    @foreach($tour->schedules as $schedule)
                        <div class="my-6">
                            <p class="text-gray-700 text-sm sm:text-base">{{ $schedule->description }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 text-sm sm:text-base">Chưa có lịch trình cho chuyến đi này.</p>
                @endif

                <!-- Map -->
                <div class="my-12">
                    <h3 class="text-lg sm:text-xl font-semibold mb-3">Where you'll be</h3>
                    <div class="w-full rounded-lg overflow-hidden mb-4">
                        <div id="map" class="w-full h-[300px] sm:h-[400px]"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($villa['nearby_places'] as $place)
                            <div class="flex items-center bg-gray-50 p-3 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700 text-sm">{{ $place['description'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="border-b border-gray-200 mb-6"></div>
@else
    <p class="text-gray-500 text-sm sm:text-base">Chưa có lịch trình cho chuyến đi này.</p>
@endif
            <!-- Reviews -->
            <div class="container mx-auto py-6">
                <div class="mb-8">
                    <h2 class="text-xl sm:text-2xl font-semibold mb-2">Ratings and Reviews</h2>
                    <p class="text-gray-600 text-sm">Get a quick overview of the overall satisfaction from our guests
                    </p>
                </div>

                <div class="flex flex-col lg:flex-row items-start gap-8 mb-8">
                    {{-- Rating Summary --}}
                    <div class="w-full lg:w-48">
                        <div class="mb-8">
                            <span class="text-3xl sm:text-4xl font-bold">{{ $villa['rating'] }}</span>
                            <div class="flex items-center mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $villa['rating'])
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-300" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $villa['reviews_count'] }} Ratings</p>
                        </div>

                        {{-- Rating Bars --}}
                        <div class="space-y-2">
                            @foreach($ratingDistribution as $rating => $count)
                                <div class="flex items-center gap-2">
                                    <span class="w-3 text-sm">{{ $rating }}</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full">
                                        <div
                                            class="h-2 bg-yellow-400 rounded-full {{ $widthClasses[round(($count / $maxCount) * 12)] }}">
                                        </div>
                                    </div>
                                    <span class="text-xs sm:text-sm text-gray-600 w-8">({{ $count }})</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Reviews List --}}
                    <div class="flex-1">
                        <div class="space-y-6">
                            @foreach($reviews as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review['rating'])
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-300" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>

                                    <div class="flex items-center gap-3 mb-2">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span
                                                class="text-gray-600 text-sm sm:text-base">{{ substr($review['author'], 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-sm sm:text-base">{{ $review['author'] }}</h3>
                                            <p class="text-xs sm:text-sm text-gray-500">{{ $review['date'] }}</p>
                                        </div>
                                    </div>

                                    <h4 class="font-medium mb-2 text-sm sm:text-base">{{ $review['title'] }}</h4>
                                    <p class="text-gray-600 text-sm sm:text-base">{{ $review['content'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Terms -->
            <div class="mb-6">
                <h3 class="text-lg sm:text-xl font-semibold mb-3">Things to know</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($villa['terms'] as $term)
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm sm:text-base">{{ $term['description'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column - Booking Card -->
        <div class="w-full lg:w-1/3">
            <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg sticky top-8">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        @php
                            $priceList = $tour->priceLists->first();
                            $adultPrice = $priceList ? $priceList->priceDetails->where('customer_type', 'ADULT')->first() : null;
                            $childPrice = $priceList ? $priceList->priceDetails->where('customer_type', 'CHILD')->first() : null;
                        @endphp

                        @if($adultPrice)
                            <div class="flex items-center gap-2">
                                <span class="text-2xl font-bold">${{ number_format($adultPrice->price, 2) }}</span>
                                <span class="text-gray-600">/adult</span>
                            </div>

                            @if($childPrice)
                                <div class="text-sm text-gray-600">
                                    Child: ${{ number_format($childPrice->price, 2) }}/person
                                </div>
                            @endif
                        @else
                            <span class="text-gray-600">Price not available</span>
                        @endif
                    </div>
                </div>

                <form method="GET" action="{{ route('booking.create', ['tour' => $tour->tour_id]) }}">
                    @csrf
                    <div class="mb-4">
                        <div class="flex items-center justify-between border rounded-md p-3">
                            <div>
                                <div class="font-medium">Adults</div>
                                <div class="text-sm text-gray-500">Age 13+</div>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="button" onclick="updateGuests('adult', -1)"
                                    class="w-8 h-8 flex items-center justify-center border rounded-full hover:bg-gray-100 transition-colors">
                                    -
                                </button>
                                <input type="number" id="adult-count" name="adult_count" value="1" min="1" max="10"
                                    readonly class="w-12 text-center border-none focus:ring-0 p-0 text-lg">
                                <button type="button" onclick="updateGuests('adult', 1)"
                                    class="w-8 h-8 flex items-center justify-center border rounded-full hover:bg-gray-100 transition-colors">
                                    +
                                </button>
                            </div>
                        </div>
                    </div>

                    @if($childPrice)
                        <div class="mb-4">
                            <div class="flex items-center justify-between border rounded-md p-3">
                                <div>
                                    <div class="font-medium">Children</div>
                                    <div class="text-sm text-gray-500">Age 2-12</div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button type="button" onclick="updateGuests('child', -1)"
                                        class="w-8 h-8 flex items-center justify-center border rounded-full hover:bg-gray-100 transition-colors">
                                        -
                                    </button>
                                    <input type="number" id="child-count" name="child_count" value="0" min="0" max="10"
                                        readonly class="w-12 text-center border-none focus:ring-0 p-0 text-lg">
                                    <button type="button" onclick="updateGuests('child', 1)"
                                        class="w-8 h-8 flex items-center justify-center border rounded-full hover:bg-gray-100 transition-colors">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Thêm vào trước button Reserve Now -->
                    <div class="border-t pt-4 mt-4">
                        <!-- Adult Summary -->
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">
                                Adults × <span id="adult-total-count">1</span>
                            </span>
                            <span>$<span
                                    id="adult-total-price">{{ number_format($adultPrice ? $adultPrice->price : 0, 2) }}</span></span>
                        </div>

                        <!-- Child Summary (if child price exists) -->
                        @if($childPrice)
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">
                                    Children × <span id="child-total-count">0</span>
                                </span>
                                <span>$<span id="child-total-price">0.00</span></span>
                            </div>
                        @endif

                        <!-- Total Price -->
                        <div class="flex justify-between items-center border-t py-4 my-2">
                            <span class="font-semibold">Total Price</span>
                            <span class="font-semibold text-xl">$<span
                                    id="total-price">{{ number_format($adultPrice ? $adultPrice->price : 0, 2) }}</span></span>
                        </div>
                    </div>


                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Reserve Now
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@goongmaps/goong-js@1.0.9/dist/goong-js.css" rel="stylesheet" />

<script>
    const API_KEY = 'wCJbks0Q8BSaJobLRuaVpxLTMR47V9PtGZFK9f7i';
    const MAPTILES_KEY = 'tN9ukc25KjSGFzfG41uzlgWP3AzHXN0TcsOd3A3K';


    // Thêm logging để debug
    console.log("Raw coordinates:", "{{ $tour->location->coordinates }}");

    try {
        // Tách chuỗi tọa độ và chuyển thành số
        const coordinates = "{{ $tour->location->coordinates }}".split(',').map(Number);
        const lng = coordinates[0]; // Kinh độ 
        const lat = coordinates[1]; // Vĩ độ 

        console.log("Parsed coordinates:", { lng, lat });

        goongjs.accessToken = MAPTILES_KEY;
        const map = new goongjs.Map({
            container: 'map',
            style: 'https://tiles.goong.io/assets/goong_map_web.json',
            center: [lng, lat], // Đúng thứ tự [longitude, latitude]
            zoom: 15
        });
        new goongjs.Marker()
            .setLngLat([lng, lat])
            .addTo(map);
    } catch (error) {
        console.error("Error initializing map:", error);
    }

    const adultPrice = {{ $adultPrice ? $adultPrice->price : 0 }};
    const childPrice = {{ $childPrice ? $childPrice->price : 0 }};
    let adultCount = 0;
    let childCount = 0;

    function updateGuests(type, change) {
        const input = document.getElementById(`${type}-count`);
        let value = parseInt(input.value) + change;

        // Ensure value stays within min-max bounds
        const min = type === 'adult' ? 1 : 0;
        value = Math.max(min, Math.min(10, value));

        input.value = value;

        // Update summary counts
        document.getElementById(`${type}-total-count`).textContent = value;

        // Calculate and update prices
        const price = type === 'adult' ? adultPrice : childPrice;
        const subtotal = value * price;
        document.getElementById(`${type}-total-price`).textContent = subtotal.toFixed(2);

        // Calculate total price
        const adultSubtotal = parseInt(document.getElementById('adult-count').value) * adultPrice;
        const childSubtotal = parseInt(document.getElementById('child-count').value) * childPrice;
        const total = adultSubtotal + childSubtotal;

        // Update total price display
        document.getElementById('total-price').textContent = total.toFixed(2);
    }

</script>

@endsection