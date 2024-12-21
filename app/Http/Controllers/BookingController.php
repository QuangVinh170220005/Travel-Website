<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function all()
    {
        $bookings = Booking::with(['tour', 'schedule', 'user'])
            ->latest('booking_date')
            ->paginate(10);
            
        return view('admin.bookings.all', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['tour', 'schedule', 'user']);
        
        if(request()->ajax()) {
            $html = view('admin.bookings.partials.detail-modal', compact('booking'))->render();
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        }

        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:PENDING,CONFIRMED,PAID,CANCELLED'
        ]);

        try {
            DB::beginTransaction();
            
            $booking->update([
                'status' => $request->status
            ]);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái thành công',
                'status_badge' => $booking->status_badge
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật trạng thái'
            ], 500);
        }
    }

    public function statistics()
    {
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'PENDING')->count(),
            'confirmed' => Booking::where('status', 'CONFIRMED')->count(),
            'paid' => Booking::where('status', 'PAID')->count(),
            'cancelled' => Booking::where('status', 'CANCELLED')->count(),
            
            'revenue' => [
                'total' => Booking::where('status', 'PAID')
                    ->sum('total_amount'),
                'deposit' => Booking::whereIn('status', ['CONFIRMED', 'PAID'])
                    ->sum('deposit_amount')
            ],
            
            'top_tours' => Booking::select('tour_id', DB::raw('count(*) as total'))
                ->with('tour:tour_id,name')
                ->groupBy('tour_id')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
        ];

        return view('admin.bookings.statistics', compact('stats'));
    }

    public function export()
    {
        $bookings = Booking::with(['tour', 'schedule', 'user'])
            ->latest('booking_date')
            ->get();
        
        return back()->with('success', 'Đang phát triển tính năng xuất file');
    }
}
