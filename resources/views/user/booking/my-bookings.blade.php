@extends('user.layouts.app')

@section('title', 'Danh sách tour đã đặt')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-roboto font-bold mb-2">Danh sách tour đã đặt</h1>
        </div>

        @if($bookings->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <p class="text-gray-500">Bạn chưa đặt tour nào.</p>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mã đặt tour
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên tour
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ngày khởi hành
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Số lượng
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tổng tiền
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trạng thái
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ngày đặt
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $booking->booking_id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $booking->tour->tour_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $booking->schedule->departure_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $booking->adult_count }} người lớn
                                        @if($booking->child_count > 0)
                                            , {{ $booking->child_count }} trẻ em
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($booking->total_amount) }}đ
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($booking->status === 'PENDING') 
                                                bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'CONFIRMED')
                                                bg-green-100 text-green-800
                                            @elseif($booking->status === 'CANCELLED')
                                                bg-red-100 text-red-800
                                            @elseif($booking->status === 'COMPLETED')
                                                bg-blue-100 text-blue-800
                                            @endif">
                                            @switch($booking->status)
                                                @case('PENDING')
                                                    Chờ xác nhận
                                                    @break
                                                @case('CONFIRMED')
                                                    Đã xác nhận
                                                    @break
                                                @case('CANCELLED')
                                                    Đã hủy
                                                    @break
                                                @case('COMPLETED')
                                                    Đã hoàn thành
                                                    @break
                                                @default
                                                    {{ $booking->status }}
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $booking->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $bookings->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection