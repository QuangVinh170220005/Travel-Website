@extends('user.layouts.app')

@section('title', 'Blog Page')

@php
$featuredPost = [
    'title' => 'Khám phá vẻ đẹp ẩn giấu của Hội An',
    'excerpt' => 'Hội An không chỉ có phố cổ, hãy cùng chúng tôi khám phá những điểm đến tuyệt vời ít người biết đến.',
    'content' => '<p>Hội An - thành phố cổ kính với những con phố rợp bóng đèn lồng không chỉ có những địa điểm du lịch nổi tiếng mà còn ẩn chứa nhiều điểm đến tuyệt vời ít được biết đến.</p>

        <h3 class="text-xl font-semibold mt-4 mb-2">1. Làng rau Trà Quế</h3>
        <p class="mb-4">Nằm cách trung tâm phố cổ khoảng 3km, làng rau Trà Quế là nơi trồng các loại rau thơm đặc trưng của Hội An:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Tham gia trải nghiệm làm nông dân</li>
            <li>Học nấu các món ăn địa phương</li>
            <li>Khám phá kỹ thuật trồng rau truyền thống</li>
            <li>Thưởng thức đặc sản địa phương</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 mb-2">2. Rừng dừa Bảy Mẫu</h3>
        <p class="mb-4">Một "miền Venice" thu nhỏ giữa lòng Hội An:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Chèo thuyền thúng qua rừng dừa</li>
            <li>Trải nghiệm đánh bắt thủy sản</li>
            <li>Ngắm hoàng hôn tuyệt đẹp</li>
            <li>Thưởng thức hải sản tươi sống</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 mb-2">3. Đảo Cù Lao Chàm</h3>
        <p class="mb-4">Thiên đường biển đảo cách Hội An 15km:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Lặn ngắm san hô</li>
            <li>Tham quan làng chài cổ</li>
            <li>Khám phá đền Hải Tạng cổ kính</li>
            <li>Thưởng thức hải sản tươi ngon</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 mb-2">4. Làng gốm Thanh Hà</h3>
        <p class="mb-4">Làng nghề truyền thống với lịch sử hơn 500 năm:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Tham quan lò gốm cổ</li>
            <li>Trải nghiệm làm gốm</li>
            <li>Mua sắm đồ gốm thủ công</li>
            <li>Tìm hiểu về nghề gốm truyền thống</li>
        </ul>

        <h3 class="text-xl font-semibold mt-4 mb-2">5. Chợ đêm Nguyễn Hoàng</h3>
        <p class="mb-4">Khu chợ đêm sôi động với nhiều hoạt động thú vị:</p>
        <ul class="list-disc ml-6 mb-4">
            <li>Thưởng thức ẩm thực đường phố</li>
            <li>Mua sắm đồ lưu niệm</li>
            <li>Xem biểu diễn nghệ thuật đường phố</li>
            <li>Trải nghiệm không khí về đêm của phố cổ</li>
        </ul>

        <div class="bg-yellow-50 p-4 rounded-lg mt-6">
            <h4 class="font-semibold text-yellow-800">Lời khuyên cho du khách:</h4>
            <ul class="list-disc ml-4 mt-2 text-yellow-700">
                <li>Nên đi vào mùa khô (từ tháng 2 đến tháng 8)</li>
                <li>Thuê xe đạp để khám phá thành phố</li>
                <li>Mang theo nón và kem chống nắng</li>
                <li>Nên đặt khách sạn ở khu vực trung tâm</li>
                <li>Tham gia tour đi bộ buổi sáng sớm</li>
            </ul>
        </div>',
    'featured_image' => 'https://t2.ex-cdn.com/crystalbay.com/resize/1860x570/files/news/2024/05/30/du-lich-hoi-an-kham-pha-pho-co-hoi-an-tu-a-den-z-164402.jpg',
    'category' => [
        'name' => 'Du lịch Việt Nam'
    ],
    'author' => [
        'name' => 'Nguyễn Văn Sơn',
        'avatar' => 'https://i.pinimg.com/736x/03/eb/d6/03ebd625cc0b9d636256ecc44c0ea324.jpg'
    ],
    'published_at' => now(),
    'reading_time' => 8
];

$latestPosts = [
    [
        'title' => '10 món ăn đường phố phải thử ở Bangkok',
        'excerpt' => 'Khám phá ẩm thực đường phố đa dạng và hấp dẫn của thủ đô Thái Lan.',
        'content' => '<p>Bangkok nổi tiếng với nền ẩm thực đường phố phong phú và đặc sắc. Dưới đây là 10 món ăn bạn không thể bỏ qua khi đến đây:</p>
            <h3 class="text-xl font-semibold mt-4 mb-2">1. Pad Thai</h3>
            <p>Món mì xào truyền thống với tôm, đậu phộng, trứng và các gia vị đặc trưng. Được bán ở hầu hết các góc phố Bangkok.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">2. Som Tam (Gỏi đu đủ)</h3>
            <p>Món gỏi cay nổi tiếng với đu đủ xanh bào sợi, cà chua, đậu đũa, tôm khô và lạc.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">3. Moo Ping (Thịt heo nướng)</h3>
            <p>Xiên thịt heo nướng thơm lừng, ướp gia vị đặc biệt, thường được bán kèm với xôi nếp.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">4. Tom Yum Goong</h3>
            <p>Súp tôm chua cay đặc trưng của Thái Lan, với nấm, sả, lá chanh và ớt.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">5. Khao Man Gai</h3>
            <p>Cơm gà Hải Nam phiên bản Thái, với nước chấm đặc biệt và súp gừng.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">6. Mango Sticky Rice</h3>
            <p>Xôi xoài ngọt ngào với nước cốt dừa, món tráng miệng không thể bỏ qua.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">7. Boat Noodles</h3>
            <p>Mì thuyền với nước dùng đậm đà, thịt bò hoặc thịt heo, rau sống và gia vị.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">8. Sai Krok Isan</h3>
            <p>Xúc xích lên men kiểu Đông Bắc Thái, thường ăn kèm với gừng và ớt.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">9. Kluay Tod</h3>
            <p>Chuối chiên giòn, phủ mật ong hoặc đường, món ăn vặt phổ biến.</p>
            
            <h3 class="text-xl font-semibold mt-4 mb-2">10. Khao Pad</h3>
            <p>Cơm chiên Thái với nhiều lựa chọn: tôm, gà, thịt bò hoặc hải sản.</p>
            
            <div class="mt-6 bg-yellow-50 p-4 rounded-lg">
                <h4 class="font-semibold text-yellow-800">Lời khuyên cho người lần đầu:</h4>
                <ul class="list-disc ml-4 mt-2 text-yellow-700">
                    <li>Chọn quán có nhiều khách địa phương</li>
                    <li>Mang theo khăn giấy và nước uống</li>
                    <li>Bắt đầu với món ít cay trước</li>
                    <li>Hỏi giá trước khi gọi món</li>
                </ul>
            </div>',
        'featured_image' => 'https://phuotvivu.com/blog/wp-content/uploads/2024/10/bangkok-1.jpg',
        'category' => [
            'name' => 'Ẩm thực'
        ],
        'author' => [
            'name' => 'Trần Thị Hồng',
            'avatar' => 'https://i.pinimg.com/474x/04/67/4f/04674f9f3954ec43210040d632e3698a.jpg'
        ],
        'published_at' => now()->subDays(2),
        'reading_time' => 6
    ],
    [
        'title' => 'Hướng dẫn chi tiết cho chuyến du lịch bụi Châu Âu',
        'excerpt' => 'Lên kế hoạch cho chuyến phiêu lưu qua các quốc gia Châu Âu với ngân sách hợp lý.',
        'content' => '<p>Du lịch bụi Châu Âu là trải nghiệm tuyệt vời nhưng cần chuẩn bị kỹ lưỡng. Dưới đây là hướng dẫn chi tiết giúp bạn có chuyến đi hoàn hảo:</p>

            <h3 class="text-xl font-semibold mt-4 mb-2">1. Chuẩn bị trước chuyến đi</h3>
            <ul class="list-disc ml-6 mb-4">
                <li>Xin visa Schengen (nộp hồ sơ trước 2-3 tháng)</li>
                <li>Đặt vé máy bay sớm để được giá tốt</li>
                <li>Mua bảo hiểm du lịch</li>
                <li>Đặt chỗ ở trước (hostel/hotel/airbnb)</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">2. Di chuyển trong Châu Âu</h3>
            <ul class="list-disc ml-6 mb-4">
                <li>Eurail Pass cho di chuyển bằng tàu</li>
                <li>Các hãng bay giá rẻ (Ryanair, EasyJet)</li>
                <li>Xe bus đường dài (Flixbus)</li>
                <li>Thẻ giao thông công cộng địa phương</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">3. Ngân sách tham khảo</h3>
            <ul class="list-disc ml-6 mb-4">
                <li>Hostel: 20-30 EUR/đêm</li>
                <li>Ăn uống: 30-40 EUR/ngày</li>
                <li>Di chuyển: 10-15 EUR/ngày</li>
                <li>Vé tham quan: 15-20 EUR/địa điểm</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">4. Lịch trình đề xuất (1 tháng)</h3>
            <ul class="list-disc ml-6 mb-4">
                <li>Paris, Pháp (5 ngày)</li>
                <li>Amsterdam, Hà Lan (4 ngày)</li>
                <li>Berlin, Đức (4 ngày)</li>
                <li>Prague, Séc (4 ngày)</li>
                <li>Vienna, Áo (3 ngày)</li>
                <li>Venice & Rome, Ý (7 ngày)</li>
                <li>Barcelona, Tây Ban Nha (3 ngày)</li>
            </ul>

            <div class="bg-blue-50 p-4 rounded-lg mt-6">
                <h4 class="font-semibold text-blue-800">Mẹo tiết kiệm:</h4>
                <ul class="list-disc ml-4 mt-2 text-blue-700">
                    <li>Đặt chỗ ở có bếp để tự nấu ăn</li>
                    <li>Mua vé tham quan online trước</li>
                    <li>Tận dụng các ngày free entrance</li>
                    <li>Dùng ứng dụng Too Good To Go để mua đồ ăn giảm giá</li>
                </ul>
            </div>',
        'featured_image' => 'https://tour.dulichvietnam.com.vn/uploads/image/du-lich-chau-au/mua-thu-chau-au.jpg',
        'category' => [
            'name' => 'Du lịch bụi'
        ],
        'author' => [
            'name' => 'Lê Văn Nghĩa',
            'avatar' => 'https://i.pinimg.com/736x/24/21/85/242185eaef43192fc3f9646932fe3b46.jpg'
        ],
        'published_at' => now()->subDays(5),
        'reading_time' => 10
    ],
    [
        'title' => 'Top 5 bãi biển đẹp nhất Phú Quốc',
        'excerpt' => 'Khám phá những bãi biển trong xanh và hoang sơ nhất tại đảo ngọc Phú Quốc.',
        'content' => '<p>Phú Quốc không chỉ là hòn đảo lớn nhất Việt Nam mà còn sở hữu những bãi biển tuyệt đẹp. Hãy cùng khám phá top 5 bãi biển đẹp nhất tại đây:</p>

            <h3 class="text-xl font-semibold mt-4 mb-2">1. Bãi Sao</h3>
            <p class="mb-4">Được mệnh danh là một trong những bãi biển đẹp nhất Việt Nam với cát trắng mịn như bột, nước biển trong vắt, hoàng hôn tuyệt đẹp và nhiều dịch vụ giải trí.</p>
            <ul class="list-disc ml-6 mb-4">
                <li>Cát trắng mịn như bột</li>
                <li>Nước biển trong vắt</li>
                <li>Hoàng hôn tuyệt đẹp</li>
                <li>Nhiều dịch vụ giải trí</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">2. Bãi Dài</h3>
            <p class="mb-4">Bãi biển hoang sơ dài 20km, lý tưởng cho những ai thích không gian yên tĩnh:</p>
            <ul class="list-disc ml-6 mb-4">
                <li>Bãi biển dài và rộng</li>
                <li>Ít du khách</li>
                <li>Nhiều resort cao cấp</li>
                <li>Thích hợp ngắm hoàng hôn</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">3. Bãi Trường</h3>
            <p class="mb-4">Bãi biển sôi động nhất Phú Quốc với nhiều hoạt động giải trí:</p>
            <ul class="list-disc ml-6 mb-4">
                <li>Nhiều nhà hàng, quán bar</li>
                <li>Các môn thể thao nước</li>
                <li>Chợ đêm gần đó</li>
                <li>Sunset Sanato Beach Club</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">4. Bãi Khem</h3>
            <p class="mb-4">Bãi biển yên bình với vẻ đẹp hoang sơ:</p>
            <ul class="list-disc ml-6 mb-4">
                <li>Nước biển trong xanh</li>
                <li>Cát trắng mịn</li>
                <li>Nhiều rặng dừa</li>
                <li>Thích hợp tắm biển</li>
            </ul>

            <h3 class="text-xl font-semibold mt-4 mb-2">5. Bãi Ông Lang</h3>
            <p class="mb-4">Bãi biển hoàng hôn đẹp nhất Phú Quốc:</p>
            <ul class="list-disc ml-6 mb-4">
                <li>Hoàng hôn tuyệt đẹp</li>
                <li>Nhiều nhà hàng hải sản</li>
                <li>Không gian yên tĩnh</li>
                <li>Thích hợp chụp ảnh</li>
            </ul>

            <div class="bg-green-50 p-4 rounded-lg mt-6">
                <h4 class="font-semibold text-green-800">Lời khuyên khi đi biển Phú Quốc:</h4>
                <ul class="list-disc ml-4 mt-2 text-green-700">
                    <li>Mang theo kem chống nắng</li>
                    <li>Đi sớm để tránh nắng gắt</li>
                    <li>Mang theo nước uống</li>
                    <li>Cẩn thận với sứa khi tắm biển</li>
                </ul>
            </div>',
        'featured_image' => 'https://phuquocexpress.com/wp-content/uploads/2024/09/anh-phu-quoc.jpg',
        'category' => [
            'name' => 'Du lịch biển'
        ],
        'author' => [
            'name' => 'Phạm Thị Trang',
            'avatar' => 'https://i.pinimg.com/236x/3e/f5/17/3ef517d85e60396d6c98aea16b47ca47.jpg'
        ],
        'published_at' => now()->subDays(7),
        'reading_time' => 7
    ]
];

$categories = [
    ['name' => 'Du lịch Việt Nam'],
    ['name' => 'Ẩm thực'],
    ['name' => 'Du lịch bụi'],
    ['name' => 'Du lịch biển'],
    ['name' => 'Văn hóa'],
    ['name' => 'Mẹo du lịch']
];
@endphp

@section('content')
    <div class="bg-gray-50">
        <!-- Hero Section -->
        <section class="relative h-[500px] mb-12" x-data="{ openModal: null }">
            <div class="absolute inset-0">
                <img src="{{ $featuredPost['featured_image'] }}" 
                    class="w-full h-full object-cover" 
                    alt="Featured post">
                <div class="absolute inset-0 bg-black opacity-40"></div>
            </div>
            
            <div class="relative container mx-auto px-4 h-full flex items-end pb-16">
                <div class="text-white max-w-2xl">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm">
                        {{ $featuredPost['category']['name'] }}
                    </span>
                    <button 
                        @click="openModal = 'featured'" 
                        class="text-left w-full hover:text-yellow-200 transition-colors">
                        <h1 class="text-4xl font-bold mt-4 mb-2 font-roboto">
                            {{ $featuredPost['title'] }}
                        </h1>
                        <p class="text-gray-200 mb-4">
                            {{ $featuredPost['excerpt'] }}
                        </p>
                    </button>
                    <div class="flex items-center gap-4">
                        <img src="{{ $featuredPost['author']['avatar'] }}" 
                            class="w-10 h-10 rounded-full" 
                            alt="Author">
                        <div>
                            <p class="font-medium">{{ $featuredPost['author']['name'] }}</p>
                            <p class="text-sm">
                                {{ $featuredPost['published_at']->format('d M Y') }} • 
                                {{ $featuredPost['reading_time'] }} mins read
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Post Modal -->
            <div x-show="openModal === 'featured'" 
                 class="fixed inset-0 z-50 overflow-y-auto" 
                 style="display: none;">
                <div class="min-h-screen px-4 flex items-center justify-center">
                    <div class="fixed inset-0 bg-black opacity-50"></div>
                    <div class="relative bg-white rounded-lg max-w-4xl w-full">
                        <button @click="openModal = null" 
                                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <div class="p-6">
                            <!-- Author Info -->
                            <div class="flex items-center mb-6">
                                <img src="{{ $featuredPost['author']['avatar'] }}" 
                                     alt="{{ $featuredPost['author']['name'] }}" 
                                     class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <p class="font-semibold">{{ $featuredPost['author']['name'] }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $featuredPost['published_at']->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <img src="{{ $featuredPost['featured_image'] }}" 
                                 alt="{{ $featuredPost['title'] }}" 
                                 class="w-full h-80 object-cover rounded-lg mb-6">

                            <!-- Post Content -->
                            <span class="text-sm text-blue-500">{{ $featuredPost['category']['name'] }}</span>
                            <h2 class="text-2xl font-bold my-4 font-roboto">{{ $featuredPost['title'] }}</h2>
                            <div class="prose max-w-none mb-6">
                                {!! $featuredPost['content'] !!}
                            </div>

                            <!-- Reading Time -->
                            <p class="text-sm text-gray-500 mb-4">
                                Thời gian đọc: {{ $featuredPost['reading_time'] }} phút
                            </p>

                            <!-- Interaction Stats -->
                            <div class="flex items-center justify-between border-t border-b py-3 mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <span class="bg-blue-500 text-white rounded-full p-1 mr-2">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                            </svg>
                                        </span>
                                        <span>256 Thích</span>
                                    </div>
                                    <div>42 Bình luận</div>
                                    <div>15 Chia sẻ</div>
                                </div>
                            </div>

                            <!-- Interaction Buttons -->
                            <div class="flex justify-between border-b pb-4 mb-4">
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                    </svg>
                                    <span>Thích</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                    <span>Bình luận</span>
                                </button>
                                <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    <span>Chia sẻ</span>
                                </button>
                            </div>

                            <!-- Comments Section -->
                            <div class="space-y-4">
                                <h3 class="font-semibold">Bình luận gần đây</h3>
                                <!-- Sample Comments -->
                                <div class="flex space-x-3">
                                    <img src="https://i.pravatar.cc/40?img=1" 
                                         alt="Commenter" 
                                         class="w-8 h-8 rounded-full">
                                    <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                        <p class="font-medium">Trần Thanh Hà</p>
                                        <p class="text-sm text-gray-600">Bài viết rất hay! Tôi đã đến Hội An nhiều lần nhưng chưa biết đến làng rau Trà Quế.</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <button class="hover:text-blue-500">Thích</button>
                                            <button class="hover:text-blue-500">Trả lời</button>
                                            <span>2 giờ trước</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <img src="https://i.pravatar.cc/40?img=2" 
                                         alt="Commenter" 
                                         class="w-8 h-8 rounded-full">
                                    <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                        <p class="font-medium">Nguyễn Minh Tuấn</p>
                                        <p class="text-sm text-gray-600">Rừng dừa Bảy Mẫu thực sự là một trải nghiệm tuyệt vời. Các bạn nên đi vào buổi chiều để ngắm hoàng hôn nhé!</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <button class="hover:text-blue-500">Thích</button>
                                            <button class="hover:text-blue-500">Trả lời</button>
                                            <span>5 giờ trước</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment Input -->
                                <div class="flex items-center space-x-3 mt-6">
                                    <img src="{{ $featuredPost['author']['avatar'] }}" 
                                         alt="Your avatar" 
                                         class="w-8 h-8 rounded-full">
                                    <input type="text" 
                                           placeholder="Viết bình luận..." 
                                           class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                                        Gửi
                                    </button>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="bg-gray-50 px-6 py-4 mt-6 rounded-b-lg border-t">
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-4 text-sm text-gray-600">
                                        <button class="hover:text-blue-500">Báo cáo bài viết</button>
                                        <button class="hover:text-blue-500">Lưu bài viết</button>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-sm text-gray-500">Chia sẻ qua:</span>
                                        <button class="text-blue-600 hover:text-blue-700">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                                            </svg>
                                        </button>
                                        <button class="text-blue-400 hover:text-blue-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="bg-gray-50 px-6 py-3 flex justify-end rounded-b-lg">
                            <button @click="openModal = null" 
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                                Đóng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Section -->
        <main class="container mx-auto px-4 py-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold mb-2 font-roboto">Latest Posts</h2>
                    <p class="text-gray-600">
                        Discover travel tips, destination guides, and inspiring stories.
                    </p>
                </div>
                <div class="flex gap-4">
                    <button class="px-4 py-2 bg-gray-100 rounded-full hover:bg-gray-200">
                        Latest
                    </button>
                    <button class="px-4 py-2 bg-gray-100 rounded-full hover:bg-gray-200">
                        Popular
                    </button>
                </div>
            </div>

            <!-- Blog Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ openModal: null }">
                @foreach($latestPosts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $post['featured_image'] }}" 
                         alt="{{ $post['title'] }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-blue-500">{{ $post['category']['name'] }}</span>
                        <button 
                            @click="openModal = 'post{{ $loop->index }}'" 
                            class="text-xl font-semibold mt-2 mb-3 hover:text-blue-600 text-left w-full">
                            {{ $post['title'] }}
                        </button>
                        <p class="text-gray-600 mb-4">{{ $post['excerpt'] }}</p>
                        <div class="flex items-center">
                            <img src="{{ $post['author']['avatar'] }}" 
                                 alt="{{ $post['author']['name'] }}" 
                                 class="w-10 h-10 rounded-full mr-4">
                            <div>
                                <p class="font-medium">{{ $post['author']['name'] }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $post['published_at']->format('d M Y') }} • {{ $post['reading_time'] }} mins read
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Simple Blog Post Modal -->
                    <div x-show="openModal === 'post{{ $loop->index }}'" 
                         class="fixed inset-0 z-50 overflow-y-auto" 
                         style="display: none;">
                        <div class="min-h-screen px-4 flex items-center justify-center">
                            <!-- Backdrop -->
                            <div class="fixed inset-0 bg-black opacity-50"></div>

                            <!-- Modal Content -->
                            <div class="relative bg-white rounded-lg max-w-2xl w-full">
                                <!-- Close Button -->
                                <button @click="openModal = null" 
                                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>

                                <!-- Post Content -->
                                <div class="p-6">
                                    <!-- Author Info -->
                                    <div class="flex items-center mb-6">
                                        <img src="{{ $post['author']['avatar'] }}" 
                                             alt="{{ $post['author']['name'] }}" 
                                             class="w-12 h-12 rounded-full mr-4">
                                        <div>
                                            <p class="font-semibold">{{ $post['author']['name'] }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $post['published_at']->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Post Image -->
                                    <img src="{{ $post['featured_image'] }}" 
                                         alt="{{ $post['title'] }}" 
                                         class="w-full h-64 object-cover rounded-lg mb-6">

                                    <!-- Post Title & Category -->
                                    <span class="text-sm text-blue-500">{{ $post['category']['name'] }}</span>
                                    <h2 class="text-2xl font-bold my-4 font-roboto">{{ $post['title'] }}</h2>

                                    <!-- Post Excerpt -->
                                    <p class="text-gray-600 mb-4">{{ $post['excerpt'] }}</p>
                                    
                                    <!-- Post Content -->
                                    <div class="prose max-w-none mb-6">
                                        {!! $post['content'] !!}
                                    </div>

                                    <!-- Reading Time -->
                                    <p class="text-sm text-gray-500 mb-6">
                                        Thời gian đọc: {{ $post['reading_time'] }} phút
                                    </p>

                                    <!-- Interaction Stats -->
                                    <div class="flex items-center justify-between border-t border-b py-3 mb-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center">
                                                <span class="bg-blue-500 text-white rounded-full p-1 mr-2">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                    </svg>
                                                </span>
                                                <span>256 Thích</span>
                                            </div>
                                            <div>42 Bình luận</div>
                                            <div>15 Chia sẻ</div>
                                        </div>
                                    </div>

                                    <!-- Interaction Buttons -->
                                    <div class="flex justify-between border-b pb-4 mb-4">
                                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                            </svg>
                                            <span>Thích</span>
                                        </button>
                                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                            </svg>
                                            <span>Bình luận</span>
                                        </button>
                                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                            </svg>
                                            <span>Chia sẻ</span>
                                        </button>
                                    </div>

                                    <!-- Comments Section -->
                                    <div class="space-y-4">
                                        <h3 class="font-semibold">Bình luận gần đây</h3>
                                        <!-- Sample Comments -->
                                        <div class="flex space-x-3">
                                            <img src="https://i.pravatar.cc/40?img=1" 
                                                 alt="Commenter" 
                                                 class="w-8 h-8 rounded-full">
                                            <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                                <p class="font-medium">Trần Thanh Hà</p>
                                                <p class="text-sm text-gray-600">Bài viết rất hay! Tôi đã đến Hội An nhiều lần nhưng chưa biết đến làng rau Trà Quế.</p>
                                                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                    <button class="hover:text-blue-500">Thích</button>
                                                    <button class="hover:text-blue-500">Trả lời</button>
                                                    <span>2 giờ trước</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex space-x-3">
                                            <img src="https://i.pravatar.cc/40?img=2" 
                                                 alt="Commenter" 
                                                 class="w-8 h-8 rounded-full">
                                            <div class="flex-1 bg-gray-100 rounded-lg p-3">
                                                <p class="font-medium">Nguyễn Minh Tuấn</p>
                                                <p class="text-sm text-gray-600">Rừng dừa Bảy Mẫu thực sự là một trải nghiệm tuyệt vời. Các bạn nên đi vào buổi chiều để ngắm hoàng hôn nhé!</p>
                                                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                    <button class="hover:text-blue-500">Thích</button>
                                                    <button class="hover:text-blue-500">Trả lời</button>
                                                    <span>5 giờ trước</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comment Input -->
                                        <div class="flex items-center space-x-3 mt-6">
                                            <img src="{{ $post['author']['avatar'] }}" 
                                                 alt="Your avatar" 
                                                 class="w-8 h-8 rounded-full">
                                            <input type="text" 
                                                   placeholder="Viết bình luận..." 
                                                   class="flex-1 bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                                                Gửi
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="bg-gray-50 px-6 py-3 flex justify-end rounded-b-lg">
                                    <button @click="openModal = null" 
                                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Categories -->
            <div class="mt-12">
                <h3 class="text-xl font-semibold mb-4">Categories</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach($categories as $category)
                    <a href="#" class="px-4 py-2 bg-gray-100 rounded-full hover:bg-gray-200">
                        {{ $category['name'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-8 mt-12">
            <div class="container mx-auto px-4">
                <p>&copy; 2024 Travel Blog. All rights reserved.</p>
            </div>
        </footer>
    </div>
@endsection



