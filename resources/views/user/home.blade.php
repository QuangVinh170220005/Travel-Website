@extends('user.layouts.app')

@section('title', 'Welcome to Traveling - Your Perfect Holiday Partner')

@section('content')
@php
$home = [
    'images' => [
        'https://media-cdn.tripadvisor.com/media/attractions-splice-spp-674x446/12/3f/9b/42.jpg',
        'https://d1629ugb7moz2f.cloudfront.net/ckeditor/ENfF1wy8I2nLdtpsLdPHQzdwXpUe9UbI6HOc4c8b.jpg',
        'https://static.wixstatic.com/media/f5dab6_4c7b4d42caeb4ccb8c35de0e68ade473~mv2.jpg/v1/fill/w_980,h_654,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/f5dab6_4c7b4d42caeb4ccb8c35de0e68ade473~mv2.jpg',
        'https://hips.hearstapps.com/hmg-prod/images/great-ocean-road-174028267-1494616481.jpg?crop=1.00xw:1.00xh;0,0&resize=1200:*'
    ],
]
@endphp
<div class="relative">
    <!-- Hero Banner -->
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://media.istockphoto.com/id/1429367591/vi/anh/m%E1%BB%99t-gia-%C4%91%C3%ACnh-trong-k%E1%BB%B3-ngh%E1%BB%89-h%C3%A8-%C4%91%E1%BB%A9ng-b%C3%AAn-h%E1%BB%93-b%C6%A1i-v%C3%A0-t%E1%BA%ADn-h%C6%B0%E1%BB%9Fng-c%E1%BA%A3nh-ho%C3%A0ng-h%C3%B4n-tuy%E1%BB%87t-%C4%91%E1%BA%B9p.jpg?s=2048x2048&w=is&k=20&c=8nfsgkJNVCzOainEs-Jlq-mTpaqHKQXVAWEjcM3eXDs=');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container mx-auto h-full relative z-10">
            <div class="flex items-center justify-center h-full">
                <div class="text-center text-white">
                    <h1 class="text-5xl font-bold mb-4 hover:text-yellow-300">Discover Your Perfect Destination</h1>
                    <p class="text-xl mb-8">Explore amazing holiday packages and create unforgettable memories</p>
                    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto transition-all duration-300 hover:shadow-2xl">
                        <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <input 
                                type="text" 
                                class="w-full px-4 py-2 border rounded-md text-gray-800 placeholder-gray-500 transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" 
                                placeholder="Where to?"
                            >
                            <input 
                                type="date" 
                                class="w-full px-4 py-2 border rounded-md text-gray-800 transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500" 
                                placeholder="Check-in"
                            >
                            <select class="w-full px-4 py-2 border rounded-md text-gray-800 transition-all duration-300 hover:border-blue-500 focus:ring-2 focus:ring-blue-500">
                                <option class="text-gray-500">Number of travelers</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3+</option>
                            </select>
                            <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                                Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- City Search Section -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                <h1 class="text-4xl font-bold text-center md:text-left transition-all duration-300 hover:text-5xl hover:text-blue-600">Best holiday deals</h1>
                
                <div class="flex items-center bg-white rounded-full border shadow-sm w-full md:w-auto transition-all duration-300 hover:shadow-lg">
                    <input type="text" placeholder="SEARCH YOUR NEXT CITY" class="px-6 py-3 rounded-l-full outline-none text-gray-600 w-full md:w-80 transition-all duration-300 focus:ring-2 focus:ring-blue-500">
                    <button class="bg-slate-900 text-white px-8 py-3 rounded-full hover:bg-slate-800 whitespace-nowrap transition-all duration-300 transform hover:scale-105">Search</button>
                </div>
            </div>

            <!-- City filters -->
            <div class="flex flex-wrap gap-4 mt-8 justify-center">
                <button class="px-6 py-2 rounded-full bg-teal-500 text-white transition-all duration-300 hover:bg-teal-600 transform hover:scale-110">All</button>
                @foreach(['London', 'Spain', 'Nottingham', 'Leicester', 'Plymouth', 'Derby', 'Southampton', 'Manchester', 'Liverpool'] as $city)
                <button class="px-6 py-2 rounded-full bg-white border hover:bg-gray-50 transition-all duration-300 hover:border-blue-500 transform hover:scale-110">{{ $city }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Tour cards section -->
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-7 sm:p-6 md:py-10 md:px-8">
        @foreach(range(1, 8) as $index)
            <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <div class="h-48 w-full relative overflow-hidden">
                    <!-- Thêm nút yêu thích -->
                    <button class="absolute top-4 right-4 z-10 p-2 bg-white bg-opacity-70 rounded-full hover:bg-opacity-100 transition-all duration-300 group">
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
                    <img src="https://i.pinimg.com/736x/70/35/00/703500d5da9cf9eb3d60e39844da7e5e.jpg" 
                        class="w-full h-full object-cover transition-all duration-500 transform group-hover:scale-110 filter brightness-90" 
                        alt="Night city">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 transition-all duration-300 hover:text-blue-600">Best in Derby</h3>
                    <div class="space-y-2">
                        @foreach([
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => '19 days and 18 night'],
                            ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'text' => 'Return international flight*'],
                            ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'text' => '7 Mar - Nov 2024'],
                            ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'text' => 'Book by 30 October 2024']
                        ] as $item)
                        <div class="flex items-center group">
                            <svg class="w-5 h-5 mr-2 text-gray-400 group-hover:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="{{ $item['icon'] }}"></path>
                            </svg>
                            <span class="group-hover:text-blue-600 transition-colors duration-300">{{ $item['text'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-500">From</span>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-500 line-through mr-2">$20,999</span>
                                <span class="text-xl font-bold text-green-600 transition-all duration-300 hover:text-green-700 hover:text-2xl">$14,395</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Per Person twin Share</p>
                        <a href="{{ route('trip-details') }}" class="inline-block w-full py-2 text-center bg-gray-100 text-gray-800 rounded-md hover:bg-blue-500 hover:text-white transition-all duration-300 transform hover:scale-105">
                            Enquire Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    </div>

    <!-- Special Offers -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10 transition-all duration-300 hover:text-4xl hover:text-blue-600">Special Offers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach(['Early Bird Discount', 'Family Package'] as $index => $offer)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:scale-105">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 overflow-hidden">
                            <img src="{{ asset('https://i.pinimg.com/736x/70/35/00/703500d5da9cf9eb3d60e39844da7e5e.jpg') }}" class="w-full h-full object-cover transition-all duration-500 transform hover:scale-110" alt="Offer">
                        </div>
                        <div class="md:w-2/3 p-6">
                            <h5 class="text-xl font-semibold mb-2 transition-all duration-300 hover:text-blue-600">{{ $offer }}</h5>
                            <p class="text-gray-600 mb-2">
                                @if($index == 0)
                                    Book 60 days in advance and get 25% off
                                @else
                                    Kids stay free! Special family rates available
                                @endif
                            </p>
                            <p class="text-red-600 font-semibold mb-4 transition-all duration-300 hover:text-red-700">
                                @if($index == 0)
                                    Limited time offer!
                                @else
                                    Save up to 40%
                                @endif
                            </p>
                            <a href="#" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">Book Now</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8">
        <!-- Tiêu đề -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 font-['Kalam']">Latest Travel Libraries</h2>

        <!-- Grid container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-9 relative">
            <!-- Read All Blog Button (Center) -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
                <a href="{{ route('blog') }}" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-3 px-6 transition duration-300 shadow-lg rounded-full">
                    Read All Blog
                </a>
            </div>

            <!-- Card 1 - Góc dưới phải được bo nhiều -->
            <div class="relative overflow-hidden group" style="border-radius: 7% 8% 19% 5% / 9% 8% 20% 10%">
                <img src="{{ $home['images'][0] }}" alt="Times Square" class="w-full h-[300px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2">Experience the iconic Times Square ball drop or a scenic river cruise.</h3>
                    <p class="text-gray-200 text-sm">
                        Europe, with its rich history, stunning landscapes, and vibrant culture, is a continent brimming with iconic attractions.
                    </p>
                </div>
            </div>

            <!-- Card 2 - Góc dưới trái được bo nhiều -->
            <div class="relative overflow-hidden group" style="border-radius: 8% 5% 7% 19% / 8% 10% 9% 20%">
                <img src="{{ $home['images'][1] }}" alt="Riverside" class="w-full h-[300px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2">Revel in riverside festivities and rooftop views of the fireworks.</h3>
                    <p class="text-gray-200 text-sm">
                        Europe, with its rich history, stunning landscapes, and vibrant culture, is a continent brimming with iconic attractions.
                    </p>
                </div>
            </div>

            <!-- Card 3 - Góc trên phải được bo nhiều -->
            <div class="relative overflow-hidden group" style="border-radius: 5% 19% 8% 7% / 10% 20% 8% 9%">
                <img src="{{ $home['images'][2] }}" alt="Travel Image" class="w-full h-[300px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2">Marvel at extravagant displays near Burj Khalifa and enjoy.</h3>
                    <p class="text-gray-200 text-sm">
                        Europe, with its rich history, stunning landscapes, and vibrant culture, is a continent brimming with iconic attractions.
                    </p>
                </div>
            </div>

            <!-- Card 4 - Góc trên trái được bo nhiều -->
            <div class="relative overflow-hidden group" style="border-radius: 19% 7% 5% 8% / 20% 9% 10% 8%">
                <img src="{{ $home['images'][3] }}" alt="Travel Image" class="w-full h-[300px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70 p-6 flex flex-col justify-end">
                    <h3 class="text-white text-2xl font-bold mb-2">Discover amazing destinations around the world.</h3>
                    <p class="text-gray-200 text-sm">
                        Europe, with its rich history, stunning landscapes, and vibrant culture, is a continent brimming with iconic attractions.
                    </p>
                </div>
            </div>
        </div>
    </div>



    <!-- Testimonial Container -->
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 container mx-auto">
        <!-- Header -->
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">
        What customer say about us
        </h2>
        
        <!-- Stats -->
        <p class="text-gray-600 mb-8">
        <span class="font-semibold">2,657</span> people have said how good Rareblocks
        </p>

        <!-- Navigation Buttons -->
        <div class="flex gap-2 mb-8">
        <button class="p-2 bg-teal-500 text-white rounded-full hover:bg-teal-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button class="p-2 bg-teal-500 text-white rounded-full hover:bg-teal-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        </div>

        <!-- Testimonial Card -->
        <div class="bg-gray-50 rounded-lg p-6 md:p-8">
        <blockquote class="text-gray-700 text-lg md:text-xl mb-6">
            "I have been a proud member of this incredible gym for over a year now, and the experience has been nothing short of amazing. The state-of-the-art equipment, knowledgeable staff, and diverse group classes have made my fitness journey not only effective but truly enjoyable"
        </blockquote>
        
        <!-- Author Info -->
        <div class="flex items-center gap-4">
            <img src="https://via.placeholder.com/50" alt="Profile" class="w-12 h-12 rounded-full object-cover"/>
            <div>
            <h4 class="text-teal-500 font-medium">Eleanor Pena</h4>
            <p class="text-gray-600">Athletes</p>
            </div>
        </div>
        </div>

        <!-- Review Link -->
        <div class="mt-6 text-center">
        <a href="#" class="text-teal-500 hover:text-teal-600 transition-colors">
            Check all 2,157 reviews
        </a>
        </div>
    </div>
    </div>

    <!-- Why Choose Us -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-10 transition-all duration-300 hover:text-4xl hover:text-blue-600">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([
                    ['icon' => 'fa-shield-alt', 'title' => 'Secure Booking', 'description' => '100% secure payment system'],
                    ['icon' => 'fa-dollar-sign', 'title' => 'Best Price', 'description' => 'Guaranteed best prices'],
                    ['icon' => 'fa-headset', 'title' => '24/7 Support', 'description' => 'Dedicated support team'],
                    ['icon' => 'fa-heart', 'title' => 'Travel Insurance', 'description' => 'Comprehensive coverage']
                ] as $feature)
                <div class="text-center transition-all duration-300 transform hover:scale-105">
                    <div class="mb-4">
                        <i class="fas {{ $feature['icon'] }} text-4xl text-blue-600 transition-all duration-300 hover:text-blue-700"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 transition-all duration-300 hover:text-blue-600">{{ $feature['title'] }}</h4>
                    <p class="text-gray-600 transition-all duration-300 hover:text-gray-700">{{ $feature['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    

    <!-- Background Image Container -->
    <div class="w-full">
        <!-- Banner Image with Mountains and Character -->
        <div class="relative w-full h-[400px] bg-gradient-to-b from-sky-100 to-white overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0">
            <!-- Mountains Background -->
            <div class="absolute inset-0 bg-[url('https://your-mountain-bg.jpg')] bg-cover bg-center opacity-20"></div>
            
            <!-- Floating Images -->
            <div class="absolute top-10 left-10 transform -rotate-6">
            <div class="w-48 h-32 bg-white rounded-lg shadow-lg"></div>
            </div>
            <div class="absolute top-10 right-10 transform rotate-6">
            <div class="w-48 h-32 bg-white rounded-lg shadow-lg"></div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 sm:p-6 lg:p-8">
            <div class="max-w-5xl mx-auto w-full">
                <!-- Heading -->
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 text-gray-800 leading-tight" 
                    style="font-family: 'Caveat', cursive;">
                    Sign up to our travel e-News 
                    <span class="block mt-2">And get $20 off your Next Travel Booking</span>
                </h2>
                
                <!-- Description -->
                <p class="text-sm sm:text-base lg:text-lg text-gray-600 mb-6 sm:mb-8 max-w-3xl mx-auto px-4">
                    We'll send our latest travel offers and exclusive packages straight to your inbox by signing up to this newsletter, 
                    you agree with our Privacy Policy and our Terms and Conditions
                </p>
                
                <!-- Email Input Form -->
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full max-w-2xl mx-auto px-4">
                    <input 
                        type="email" 
                        placeholder="Enter Your Email address" 
                        class="flex-1 px-4 sm:px-6 py-3 sm:py-4 rounded-full border-2 border-gray-200 
                            focus:outline-none focus:border-[#00b5e2] text-base sm:text-lg
                            placeholder:text-gray-400 w-full"
                    >
                    <button class="px-8 sm:px-12 py-3 sm:py-4 bg-[#00b5e2] text-white text-base sm:text-lg 
                                font-medium rounded-full hover:bg-[#0095bb] transition-colors duration-300
                                w-full sm:w-auto">
                        Signup
                    </button>
                </div>
                
                <!-- Mobile Optimization for very small screens -->
                <div class="mt-4 text-xs text-gray-500 px-4 sm:hidden">
                    *Get exclusive travel deals directly in your inbox
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
