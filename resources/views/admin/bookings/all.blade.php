@extends('admin.layouts.app')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-700">Quản lý Booking</h2>
        <div class="flex gap-3">
            <select class="rounded-md border-gray-300" id="statusFilter">
                <option value="">Tất cả trạng thái</option>
                <option value="PENDING">Chờ xác nhận</option>
                <option value="CONFIRMED">Đã xác nhận</option>
                <option value="PAID">Đã thanh toán</option>
                <option value="CANCELLED">Đã hủy</option>
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-md">
                Xuất dữ liệu
            </button>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày đặt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Khách hàng</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tour</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tổng tiền</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($bookings as $booking)
                <tr class="hover:bg-gray-50 cursor-pointer booking-row" data-booking-id="{{ $booking->booking_id }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $booking->booking_date?->format('d/m/Y H:i') ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full overflow-hidden mr-3">
                                <img src="{{ $booking->user->avatar_url ?? asset('images/default-avatar.jpg') }}" 
                                     alt="Avatar" class="h-full w-full object-cover">
                            </div>
                            <span>{{ $booking->user->name ?? 'N/A' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        {{ $booking->tour->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($booking->status === 'PENDING') bg-yellow-100 text-yellow-800
                            @elseif($booking->status === 'CONFIRMED') bg-blue-100 text-blue-800
                            @elseif($booking->status === 'PAID') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($booking->total_amount, 0, ',', '.') }} đ
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>

<!-- Modal Chi tiết -->
<div id="bookingDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">Chi tiết Booking</h3>
                <button class="close-modal text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="bookingDetailContent" class="p-6">
                <!-- Nội dung chi tiết sẽ được load ở đây -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Click vào hàng để xem chi tiết
    $('.booking-row').on('click', function() {
        const bookingId = $(this).data('booking-id');
        const modal = $('#bookingDetailModal');
        const content = $('#bookingDetailContent');

        content.html('<div class="flex justify-center"><div class="loader">Loading...</div></div>');
        modal.removeClass('hidden');

        $.ajax({
            url: `/admin/bookings/${bookingId}`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    content.html(response.html);
                } else {
                    content.html('<div class="text-red-500 text-center">Không thể tải dữ liệu</div>');
                }
            },
            error: function() {
                content.html('<div class="text-red-500 text-center">Có lỗi xảy ra</div>');
            }
        });
    });

    // Đóng modal
    $('.close-modal, #bookingDetailModal').on('click', function(e) {
        if (e.target === this) {
            $('#bookingDetailModal').addClass('hidden');
        }
    });

    // Filter theo trạng thái
    $('#statusFilter').on('change', function() {
        const status = $(this).val();
        const currentUrl = new URL(window.location.href);
        if (status) {
            currentUrl.searchParams.set('status', status);
        } else {
            currentUrl.searchParams.delete('status');
        }
        window.location.href = currentUrl.toString();
    });
});
</script>
@endpush
