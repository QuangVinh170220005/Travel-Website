<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use App\Models\BookingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function create(Request $request, Tour $tour)
    {
        // Validate the request
        $validated = $request->validate([
            'adult_count' => 'required|integer|min:1|max:10',
            'child_count' => 'nullable|integer|min:0|max:10',
        ]);

        // Get price details
        $priceList = $tour->priceLists->first();
        $adultPrice = $priceList->priceDetails->where('customer_type', 'ADULT')->first();
        $childPrice = $priceList->priceDetails->where('customer_type', 'CHILD')->first();

        // Calculate totals
        $adultTotal = $validated['adult_count'] * $adultPrice->price;
        $childTotal = ($validated['child_count'] ?? 0) * ($childPrice ? $childPrice->price : 0);
        $totalAmount = $adultTotal + $childTotal;

        return view('user.booking.confirm', compact(
            'tour',
            'adultPrice',
            'childPrice',
            'validated',
            'adultTotal',
            'childTotal',
            'totalAmount'
        ));
    }

    public function store(Request $request)
    {
        // Đảm bảo need_pickup là boolean
        $needPickup = $request->boolean('need_pickup');

        // Merge lại request với giá trị boolean
        $request->merge(['need_pickup' => $needPickup]);

        // Nếu không cần đón, set pickup_location là null
        if (!$needPickup) {
            $request->merge(['pickup_location' => null]);
        }

        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,tour_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'adult_count' => 'required|integer|min:1|max:10',
            'child_count' => 'nullable|integer|min:0|max:10',
            'special_requests' => 'nullable|string',
            'need_pickup' => 'boolean',
            'pickup_location' => 'nullable|string|required_if:need_pickup,1',
            'total_amount' => 'required|numeric|min:0',
            'schedule_id' => 'required|exists:tour_schedules,schedule_id'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // 1. Tạo booking record
                $booking = Booking::create([
                    'tour_id' => $validated['tour_id'],
                    'user_id' => Auth::id(),
                    'schedule_id' => $validated['schedule_id'],
                    'booking_date' => now(),
                    'total_amount' => $validated['total_amount'],
                    'status' => 'PENDING',
                    'special_requests' => $validated['special_requests'] ?? null,
                    'need_pickup' => $validated['need_pickup'] ?? false,
                    'pickup_location' => $validated['need_pickup'] ? $validated['pickup_location'] : null
                ]);

                // 2. Tạo booking detail
                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address' => $validated['address'],
                    'adult_count' => $validated['adult_count'],
                    'child_count' => $validated['child_count'] ?? 0
                ]);

                // Có thể thêm logic gửi email xác nhận ở đây
            });

            return redirect()
                ->route('booking.my-bookings')
                ->with('success', 'Đặt tour thành công! Vui lòng kiểm tra email để xem chi tiết.');

        } catch (\Exception $e) {
            Log::error('Booking creation failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
            // ->with('error', 'Có lỗi xảy ra khi đặt tour. Vui lòng thử lại sau.');
        }
    }
    public function myBookings()
    {
        $bookings = Booking::with(['tour', 'schedule'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.booking.my-bookings', compact('bookings'));
    }
}
