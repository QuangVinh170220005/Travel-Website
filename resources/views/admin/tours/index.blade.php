@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Quản lý Tour</h1>
        <a href="{{ route('tours.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Thêm Tour Mới
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="relative">
                <input type="text" placeholder="Tìm kiếm tour..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Tất cả địa điểm</option>
                @foreach($locations as $location)
                    <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                @endforeach
            </select>
            <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Tất cả danh mục</option>
                <option value="adventure">Phiêu lưu</option>
                <option value="cultural">Văn hóa</option>
                <option value="relaxation">Nghỉ dưỡng</option>
            </select>
            <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Thời gian tour</option>
                <option value="1-3">1-3 ngày</option>
                <option value="4-7">4-7 ngày</option>
                <option value="8+">8+ ngày</option>
            </select>
        </div>
    </div>

    <!-- Tours List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Tour
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Địa điểm
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh mục
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng
                        thái</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($tours as $tour)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $tour->tour_id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    @if($tour->images->first())
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ asset('storage/' . $tour->images->first()->image_path) }}"
                                            alt="{{ $tour->tour_name }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-mountain text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $tour->tour_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tour->duration_days }} ngày
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tour->location->location_name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tour->category }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $tour->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $tour->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                            </span>
                        </td>
                        <!-- Thay thế phần dropdown menu cũ bằng code sau -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="relative" x-data="{ open: false }">
                                <!-- Nút dropdown có vùng bấm lớn hơn -->
                                <button @click="open = !open"
                                    class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition duration-150 ease-in-out">
                                    <i class="fas fa-ellipsis-v text-gray-600"></i>
                                </button>

                                <!-- Menu dropdown với padding lớn hơn -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1">
                                        <a href="{{ route('tours.edit', $tour->tour_id) }}"
                                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                            <i class="fas fa-edit w-5"></i>
                                            <span class="ml-3">Chỉnh sửa</span>
                                        </a>

                                        <a href="{{ route('tours.pricing', $tour->tour_id) }}"
                                            class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 transition duration-150 ease-in-out">
                                            <i class="fas fa-dollar-sign w-5"></i>
                                            <span class="ml-3">Quản lý giá</span>
                                        </a>

                                        <button onclick="deleteTour('{{ $tour->tour_id }}')"
                                            class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition duration-150 ease-in-out">
                                            <i class="fas fa-trash w-5"></i>
                                            <span class="ml-3">Xóa tour</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-white border-t border-gray-200">
            <div class="w-full">
                {{ $tours->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>



</div>
</div>

@push('scripts')
    <script>
        function deleteTour(tourId) {
            if (confirm('Bạn có chắc chắn muốn xóa tour này?')) {
                fetch(`/admin/tours/${tourId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            alert('Có lỗi xảy ra khi xóa tour');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Có lỗi xảy ra khi xóa tour');
                    });
            }
        }
    </script>
@endpush
@endsection