@extends('user.layouts.app')

@section('title', 'Wishlist')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold my-6">My Wishlist</h1>
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-4 text-left w-1/2">Product</th>
                    <th class="py-3 px-4 text-right">Price</th>
                    <th class="py-3 px-4 text-center">Quantity</th>
                    <th class="py-3 px-4 text-right">Total</th>
                    <th class="py-3 px-4 text-center">Select</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tours as $tour)
                <tr class="border-b">
                    <td class="py-4 px-4">
                        <div class="flex items-center">
                        <img src="{{ asset('storage/' . ($tour['image'] ?? 'default.jpg')) }}" class="w-24 h-24 object-cover rounded mr-4">

                            <div>
                                <h2 class="text-blue-600 font-semibold">{{ $tour['tour_name'] }}</h2>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-right">
                        <p>Adult: ${{ number_format($tour['adult_price'], 2) }}</p>
                        <p>Child: ${{ number_format($tour['child_price'], 2) }}</p>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="flex items-center">
                                <button class="bg-gray-200 px-3 py-1 rounded-l decrement-adult" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['adult_price'] }}">-</button>
                                <input type="number" value="{{ $tour['adults'] }}" min="0" class="w-12 text-center border-t border-b border-gray-200 adult-quantity" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['adult_price'] }}">
                                <button class="bg-gray-200 px-3 py-1 rounded-r increment-adult" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['adult_price'] }}">+</button>
                            </div>
                            <div class="flex items-center">
                                <button class="bg-gray-200 px-3 py-1 rounded-l decrement-child" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['child_price'] }}">-</button>
                                <input type="number" value="{{ $tour['children'] }}" min="0" class="w-12 text-center border-t border-b border-gray-200 child-quantity" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['child_price'] }}">
                                <button class="bg-gray-200 px-3 py-1 rounded-r increment-child" data-tour-id="{{ $tour['tour_id'] }}" data-price="{{ $tour['child_price'] }}">+</button>
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-4 text-right font-bold total-price" data-tour-id="{{ $tour['tour_id'] }}">
                        ${{ number_format($tour['total_price'], 2) }}
                    </td>
                    <td class="py-4 px-4 text-center">
                        <input type="checkbox" class="select-tour" data-tour-id="{{ $tour['tour_id'] }}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <h2 class="text-lg font-semibold mb-2">Order Summary</h2>
        <!-- Thêm div để hiển thị danh sách tour được chọn -->
        <div id="selected-tours-list" class="mb-4">
            <!-- Các tour được chọn sẽ hiển thị ở đây -->
        </div>
        <div class="border-t pt-2">
            <div class="flex justify-between items-center mt-2 text-xl font-bold">
                <span>Total:</span>
                <span id="total" class="text-red-600">$0.00</span>
            </div>
        </div>
    </div>

    <div class="text-right">
        <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-red-600 transition-colors duration-300 text-lg font-semibold">
            Checkout
        </button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const updateOrderSummary = () => {
        let subtotal = 0;
        const selectedToursList = document.getElementById('selected-tours-list');
        selectedToursList.innerHTML = ''; // Xóa danh sách cũ

        document.querySelectorAll('.select-tour:checked').forEach(checkbox => {
            const tourId = checkbox.dataset.tourId;
            const tourRow = checkbox.closest('tr');
            const tourName = tourRow.querySelector('.text-blue-600').textContent;
            const totalPriceElement = tourRow.querySelector('.total-price');
            const priceText = totalPriceElement.textContent.replace('$', '').replace(/,/g, '');
            const price = parseFloat(priceText) || 0;
            
            // Thêm thông tin tour được chọn vào danh sách
            const tourInfo = document.createElement('div');
            tourInfo.className = 'flex justify-between items-center mb-2';
            tourInfo.innerHTML = `
                <span class="text-gray-700">${tourName}</span>
                <span class="text-red-600">$${price.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}</span>
            `;
            selectedToursList.appendChild(tourInfo);

            subtotal += price;
        });

        // Nếu không có tour nào được chọn
        if (selectedToursList.children.length === 0) {
            selectedToursList.innerHTML = '<p class="text-gray-500 text-center">No tours selected</p>';
        }

        // Cập nhật tổng tiền
        document.querySelector('#total').textContent = `$${subtotal.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
    };

    // Giữ nguyên các event listener khác
    document.querySelectorAll('.increment-adult, .decrement-adult, .increment-child, .decrement-child').forEach(button => {
        button.addEventListener('click', function () {
            const tourId = this.dataset.tourId;
            const input = this.classList.contains('increment-adult') || this.classList.contains('decrement-adult')
                ? document.querySelector(`.adult-quantity[data-tour-id='${tourId}']`)
                : document.querySelector(`.child-quantity[data-tour-id='${tourId}']`);

            let value = parseInt(input.value) || 0;
            if (this.classList.contains('increment-adult') || this.classList.contains('increment-child')) {
                value++;
            } else if (value > 0) {
                value--;
            }
            input.value = value;

            updateTotalPrice(tourId);
        });
    });

    document.querySelectorAll('.adult-quantity, .child-quantity').forEach(input => {
        input.addEventListener('input', function () {
            const tourId = this.dataset.tourId;
            updateTotalPrice(tourId);
        });
    });

    document.querySelectorAll('.select-tour').forEach(checkbox => {
        checkbox.addEventListener('change', updateOrderSummary);
    });
    
    const updateTotalPrice = (tourId) => {
        const adultInput = document.querySelector(`.adult-quantity[data-tour-id='${tourId}']`);
        const childInput = document.querySelector(`.child-quantity[data-tour-id='${tourId}']`);
        const totalPriceElement = document.querySelector(`.total-price[data-tour-id='${tourId}']`);

        const adultPrice = parseFloat(adultInput.dataset.price);
        const childPrice = parseFloat(childInput.dataset.price);

        const adults = parseInt(adultInput.value) || 0;
        const children = parseInt(childInput.value) || 0;

        const total = (adults * adultPrice) + (children * childPrice);
        totalPriceElement.textContent = `$${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;

        updateOrderSummary();
    };
});
</script>
@endsection
