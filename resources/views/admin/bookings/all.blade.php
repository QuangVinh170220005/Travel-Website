@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mt-4 mb-6">Quản lý đặt tour</h1>
    
    <div class="bg-white rounded-lg shadow-md">
        <div class="border-b border-gray-200 px-6 py-4 flex items-center">
            <i class="fas fa-table mr-2"></i>
            <span class="font-semibold">Danh sách đặt tour</span>
        </div>

        <div class="p-6">
            <!-- Bộ lọc -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <form action="{{ route('admin.bookings.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trạng thái</label>
                        <select name="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Tất cả trạng thái</option>
                            <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>Chờ xác nhận</option>
                            <option value="CONFIRMED" {{ request('status') == 'CONFIRMED' ? 'selected' : '' }}>Đã xác nhận</option>
                            <option value="CANCELLED" {{ request('status') == 'CANCELLED' ? 'selected' : '' }}>Đã hủy</option>
                            <option value="COMPLETED" {{ request('status') == 'COMPLETED' ? 'selected' : '' }}>Đã hoàn thành</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Từ ngày</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Đến ngày</label>
                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tìm kiếm</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Tìm theo mã, tên khách hàng..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search mr-2"></i> Lọc
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bảng dữ liệu -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã đặt tour</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tour</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày khởi hành</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng tiền</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày đặt</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $booking->booking_id }}</td>
                            <td class="px-6 py-4">
                                @if($booking->bookingDetail)
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $booking->bookingDetail->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $booking->bookingDetail->email }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $booking->bookingDetail->phone }}
                                    </div>
                                @else
                                    <!-- Thêm debug để xem booking_id -->
                                    <div class="text-sm text-red-500">
                                        No details found for booking ID: {{ $booking->booking_id }}
                                    </div>
                                @endif
                            </td>


                            <td class="px-6 py-4">{{ $booking->tour->tour_name }}</td>
                            <td class="px-6 py-4">{{ $booking->schedule->departure_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">{{ number_format($booking->total_amount) }}đ</td>
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4">{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class=" text-gray-700 p-2">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" 
                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                        <div class="py-1">
                                            @if($booking->status === 'PENDING')
                                                <form action="{{ route('admin.bookings.confirm', $booking->booking_id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-check mr-2"></i> Xác nhận
                                                    </button>
                                                </form>
                                            @endif

                                            @if(in_array($booking->status, ['PENDING', 'CONFIRMED']))
                                                <form action="{{ route('admin.bookings.cancel', $booking->booking_id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-times mr-2"></i> Hủy
                                                    </button>
                                                </form>
                                            @endif

                                            @if($booking->status === 'CONFIRMED')
                                                <form action="{{ route('admin.bookings.complete', $booking->booking_id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                        <i class="fas fa-check-double mr-2"></i> Hoàn thành
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Phân trang -->
            <div class="mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
