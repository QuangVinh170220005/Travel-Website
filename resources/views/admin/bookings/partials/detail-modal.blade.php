<div class="space-y-6">
    <!-- Thông tin đặt tour -->
    <div>
        <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin đặt tour</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Mã booking</p>
                <p class="font-medium">{{ $booking->booking_id }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Trạng thái</p>
                <div>{!! $booking->status_badge !!}</div>
            </div>
            <div>
                <p class="text-sm text-gray-600">Ngày đặt</p>
                <p class="font-medium">{{ $booking->booking_date->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Tổng tiền</p>
                <p class="font-medium">{{ number_format($booking->total_amount) }} VNĐ</p>
            </div>
        </div>
    </div>

    <!-- Thông tin tour -->
    <div>
        <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin tour</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Tên tour</p>
                <p class="font-medium">{{ $booking->tour->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Lịch trình</p>
                <p class="font-medium">{{ $booking->schedule->name }}</p>
            </div>
        </div>
    </div>

    <!-- Thông tin thanh toán -->
    <div>
        <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin thanh toán</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Tổng tiền</p>
                <p class="font-medium">{{ number_format($booking->total_amount) }} VNĐ</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Số tiền đặt cọc</p>
                <p class="font-medium">{{ number_format($booking->deposit_amount) }} VNĐ</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Còn lại</p>
                <p class="font-medium">{{ number_format($booking->total_amount - $booking->deposit_amount) }} VNĐ</p>
            </div>
        </div>
    </div>

    <!-- Thông tin đón khách -->
    <div>
        <h4 class="text-lg font-medium text-gray-900 mb-4">Thông tin đón khách</h4>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Yêu cầu đón</p>
                <p class="font-medium">{{ $booking->need_pickup ? 'Có' : 'Không' }}</p>
            </div>
            @if($booking->need_pickup && $booking->pickup_location)
            <div>
                <p class="text-sm text-gray-600">Địa điểm đón</p>
                <p class="font-medium">{{ $booking->pickup_location }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Ghi chú đặc biệt -->
    @if($booking->special_requests)
    <div>
        <h4 class="text-lg font-medium text-gray-900 mb-4">Yêu cầu đặc biệt</h4>
        <p class="text-gray-700">{{ $booking->special_requests }}</p>
    </div>
    @endif
</div>