@extends('user.layouts.app')

@section('title', 'Explore')

@section('content')
<div class="container mx-auto mt-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-7 sm:p-6 md:py-10 md:px-8">
    @if($tours->count() > 0)
        @foreach($tours as $tour)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <div class="h-48 w-full relative overflow-hidden">
                <button class="absolute top-4 right-4 z-10 p-2 bg-white bg-opacity-70 rounded-full hover:bg-opacity-100 transition-all duration-300 group add-to-wishlist"
                    data-tour-id="{{ $tour->tour_id }}">
                    <svg class="w-6 h-6 text-gray-600 group-hover:text-red-500 transition-colors duration-300 favorite-icon" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24" 
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </button>

                    <img src="{{ asset('storage/' . ($tour->mainImage->image_path ?? 'default.jpg')) }}" 
                        class="w-full h-full object-cover transition-all duration-500 transform group-hover:scale-110 filter brightness-90" 
                        >
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">
                        <a href="{{ route('tour.schedule', $tour->tour_id) }}">
                            {{ $tour->tour_name ?? 'Chưa có tên' }} 
                        </a>
                    </h3>
                    <div class="space-y-2">
                        @foreach([
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => $tour->duration_days . ' ngày ' . ($tour->duration_nights ?? ($tour->duration_days - 1)) . ' đêm'],
                            ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'text' =>'Tối đa: '. $tour->max_participants . ' người'],
                            ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'text' => 'Thể loại: ' . ($tour->category ?? 'Chưa phân loại')],
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Phương tiện: ' . ($tour->transportation ?? 'Chưa cập nhật')]
                        ] as $item)
                        <div class="flex items-center group">
                            <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" 
                                fill="none" 
                                stroke="currentColor" 
                                viewBox="0 0 24 24">
                                <path d="{{ $item['icon'] }}"></path>
                            </svg>
                            <span class="group-hover:text-blue-600 transition-colors duration-300">{{ $item['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">Giá từ</span>
                            <div class="flex items-center">
                                @if($tour->original_price)
                                    <span class="text-sm text-gray-500 line-through mr-2">${{ number_format($tour->original_price, 0) }}</span>
                                @endif
                                <span class="text-xl font-bold text-green-600 transition-all duration-300 hover:text-green-700 hover:text-2xl">
                                    @if($tour->priceLists->isNotEmpty() && $tour->priceLists->first()->priceDetails->isNotEmpty())
                                        ${{ number_format($tour->priceLists->first()->priceDetails->first()->price, 0) }}
                                    @else
                                        Giá chưa cập nhật
                                    @endif
                                </span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Giá/người (phòng đôi)</p>
                        <a href="{{ route('tour.schedule', $tour->tour_id) }}" 
                           class="inline-block w-full py-2 text-center bg-gray-100 text-gray-800 rounded-md hover:bg-blue-500 hover:text-white transition-all duration-300 transform hover:scale-105">
                            Xem chi tiết
                        </a>
                    </div>
                    </div>
            </div>
        @endforeach
    @else
        <p class="text-center col-span-full">Không có tour nào để hiển thị.</p>
    @endif
</div>

<!-- Pagination -->
<div class="px-6 py-4 bg-white border-t border-gray-200">
    <div class="w-full">
        {{ $tours->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wishlistButtons = document.querySelectorAll('.add-to-wishlist');

        wishlistButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tourId = this.getAttribute('data-tour-id');

                fetch('{{ route("wishlist.add") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ tour_id: tourId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Đổi màu trái tim
                        this.querySelector('svg').classList.remove('text-gray-600');
                        this.querySelector('svg').classList.add('text-red-500');
                    } else {
                        console.error('Failed to add tour to wishlist.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>


