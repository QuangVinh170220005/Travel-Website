@extends('user.layouts.app')

@section('title', 'Xác nhận đặt tour')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-roboto font-bold mb-2">Xác nhận thông tin đặt tour</h1>
            <p class="text-gray-600">{{ $tour->tour_name }}</p>
        </div>
        <!-- Thêm ngay sau div class="mb-8" của phần header -->

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Có lỗi xảy ra!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Thành công!</strong>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <p>{{ session('error') }}</p>
            </div>
        @endif


        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 border-2 border-gray rounded-lg">
            <!-- Thông tin tour và giá -->
            <div class="md:col-span-7">
                <!-- Bảng thông tin tour -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-roboto font-semibold mb-4">Chi tiết tour</h2>
                    <table class="w-full">
                        <tr class="border-b">
                            <td class="py-3 text-gray-600">Mã tour:</td>
                            <td class="py-3 font-medium">{{ $tour->tour_id }}</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-gray-600">Ngày khởi hành:</td>
                            <td class="py-3 font-medium">
                                @if($tour->schedules->isNotEmpty())
                                    {{ $tour->schedules->first()->departure_date->format('d/m/Y') }}
                                @else
                                    Chưa có lịch khởi hành
                                @endif
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-gray-600">Thời gian:</td>
                            <td class="py-3 font-medium">{{ $tour->duration_days }} ngày</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-gray-600">Điểm khởi hành:</td>
                            <td class="py-3 font-medium">
                                @if($tour->schedules->isNotEmpty())
                                    {{ $tour->schedules->first()->meeting_point }}
                                @else
                                    Chưa có thông tin
                                @endif
                            </td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-3 text-gray-600">Giờ tập trung:</td>
                            <td class="py-3 font-medium">
                                @if($tour->schedules->isNotEmpty())
                                    {{ $tour->schedules->first()->meeting_time->format('H:i') }}
                                @else
                                    Chưa có thông tin
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Bảng chi tiết giá -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-roboto font-semibold mb-4">Chi tiết giá</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">Hạng mục</th>
                                    <th class="px-4 py-3 text-center text-sm font-medium text-gray-600">Số lượng</th>
                                    <th class="px-4 py-3 text-right text-sm font-medium text-gray-600">Đơn giá</th>
                                    <th class="px-4 py-3 text-right text-sm font-medium text-gray-600">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3">Người lớn</td>
                                    <td class="px-4 py-3 text-center">{{ $validated['adult_count'] }}</td>
                                    <td class="px-4 py-3 text-right">{{ number_format($adultPrice->price) }}đ</td>
                                    <td class="px-4 py-3 text-right">{{ number_format($adultTotal) }}đ</td>
                                </tr>
                                @if(($validated['child_count'] ?? 0) > 0)
                                    <tr>
                                        <td class="px-4 py-3">Trẻ em</td>
                                        <td class="px-4 py-3 text-center">{{ $validated['child_count'] }}</td>
                                        <td class="px-4 py-3 text-right">{{ number_format($childPrice->price) }}đ</td>
                                        <td class="px-4 py-3 text-right">{{ number_format($childTotal) }}đ</td>
                                    </tr>
                                @endif
                                <tr class="bg-gray-50 font-medium">
                                    <td colspan="3" class="px-4 py-3">Tổng cộng</td>
                                    <td class="px-4 py-3 text-right">{{ number_format($totalAmount) }}đ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Form thông tin cá nhân -->
            <div class="md:col-span-5">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-roboto font-semibold mb-4">Thông tin liên hệ</h2>
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf

                        <!-- Hidden inputs -->
                        <input type="hidden" name="tour_id" value="{{ $tour->tour_id }}">
                        <input type="hidden" name="schedule_id" value="{{ $tour->schedules->first()->schedule_id }}">
                        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                        <input type="hidden" name="adult_count" value="{{ $validated['adult_count'] }}">
                        <input type="hidden" name="child_count" value="{{ $validated['child_count'] ?? 0 }}">

                        <!-- Họ tên -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                            <input type="text" name="name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Số điện thoại -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                            <input type="tel" name="phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                            <input type="text" name="address" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Thêm một hidden input để đảm bảo need_pickup luôn được gửi -->
                        <input type="hidden" name="need_pickup" value="0">
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="need_pickup" value="1"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-600">Yêu cầu đón</span>
                            </label>
                        </div>

                        <div class="mb-4" id="pickup_location_container" style="display: none;">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Địa điểm đón</label>
                            <input type="text" name="pickup_location"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="">
                        </div>


                        <!-- Yêu cầu đặc biệt -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Yêu cầu đặc biệt</label>
                            <textarea name="special_requests" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <!-- Nút xác nhận -->
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-md font-medium hover:bg-blue-700 transition-colors">
                            Xác nhận đặt tour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const needPickupCheckbox = document.querySelector('input[name="need_pickup"]');
            const pickupLocationContainer = document.getElementById('pickup_location_container');
            const pickupLocationInput = document.querySelector('input[name="pickup_location"]');

            // Hàm xử lý hiển thị/ẩn pickup location
            function togglePickupLocation() {
                if (needPickupCheckbox.checked) {
                    pickupLocationContainer.style.display = 'block';
                    pickupLocationInput.setAttribute('required', '');
                } else {
                    pickupLocationContainer.style.display = 'none';
                    pickupLocationInput.removeAttribute('required');
                    pickupLocationInput.value = ''; // Reset về chuỗi rỗng
                }
            }

            // Xử lý khi checkbox thay đổi
            needPickupCheckbox.addEventListener('change', togglePickupLocation);

            // Khởi tạo trạng thái ban đầu
            togglePickupLocation();
        });
    </script>
@endpush

@endsection