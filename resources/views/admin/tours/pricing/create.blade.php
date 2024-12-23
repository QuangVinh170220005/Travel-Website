@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-roboto font-medium">Tạo Bảng Giá Cho Tour: {{ $tour->tour_name }}</h1>
        <a href="{{ route('tours.index') }}"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Quay Lại
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="pricingForm" action="{{ route('tours.pricing.store', $tour) }}" method="POST"
        class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <!-- Form content remains the same -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price_list_name">
                Tên Bảng Giá
            </label>
            <input type="text" name="price_list_name" id="price_list_name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="valid_from">
                    Ngày Bắt Đầu
                </label>
                <input type="date" name="valid_from" id="valid_from"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="valid_to">
                    Ngày Kết Thúc
                </label>
                <input type="date" name="valid_to" id="valid_to"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Mô Tả
            </label>
            <textarea name="description" id="description" rows="3"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="hidden" name="is_default" value="0">
                <input type="checkbox" name="is_default" value="1" class="form-checkbox h-4 w-4 text-blue-600">
                <span class="ml-2 text-gray-700">Đặt làm bảng giá mặc định</span>
            </label>
        </div>

        <div class="mb-4">
            <h3 class="text-lg font-bold mb-2">Chi Tiết Giá</h3>
            <div id="price-details">
                <!-- Giá cho người lớn -->
                <div class="price-detail-item grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Loại Khách</label>
                        <input type="hidden" name="prices[0][customer_type]" value="ADULT">
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly>
                            <option value="ADULT">Người Lớn</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Giá</label>
                        <input type="number" name="prices[0][price]" step="0.01"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ghi Chú</label>
                        <input type="text" name="prices[0][note]"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <!-- Giá cho trẻ em -->
                <div class="price-detail-item grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Loại Khách</label>
                        <input type="hidden" name="prices[1][customer_type]" value="CHILD">
                        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" readonly>
                            <option value="CHILD">Trẻ Em</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Giá</label>
                        <input type="number" name="prices[1][price]" step="0.01"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ghi Chú</label>
                        <input type="text" name="prices[1][note]"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <button type="submit"
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Lưu Bảng Giá
            </button>
        </div>
    </form>
</div>

<!-- Add SweetAlert2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pricingForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable submit button
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;

        // Collect form data
        const formData = new FormData(form);

        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    // Redirect after clicking OK
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                });
            } else {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: data.message || 'Có lỗi xảy ra, vui lòng thử lại',
                    confirmButtonText: 'OK'
                });

                // If there are validation errors, display them
                if (data.errors) {
                    Object.keys(data.errors).forEach(key => {
                        const errorMessages = data.errors[key];
                        errorMessages.forEach(message => {
                            // Add error class to input
                            const input = form.querySelector(`[name="${key}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                            }
                        });
                    });
                }
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra, vui lòng thử lại',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => {
            // Re-enable submit button
            submitButton.disabled = false;
        });
    });
});
</script>
@endsection
