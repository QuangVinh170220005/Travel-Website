<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

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
        // Implement booking storage logic here
    }
}
