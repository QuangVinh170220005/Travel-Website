<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Mail\AdminBookingConfirmed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['tour', 'schedule', 'bookingDetail'])
            ->select('bookings.*')
            ->latest();

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('bookings.status', $request->status);
        }

        // Lọc theo ngày
        if ($request->filled('from_date')) {
            $query->whereDate('bookings.created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('bookings.created_at', '<=', $request->to_date);
        }

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('bookingDetail', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%");
                })
                    ->orWhere('bookings.booking_id', 'LIKE', "%{$search}%");
            });
        }

        $bookings = $query->paginate(10)->appends(request()->query());
        return view('admin.bookings.all', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:PENDING,CONFIRMED,CANCELLED,COMPLETED'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        // Có thể thêm logic gửi email thông báo cho khách hàng ở đây

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }

    // Thêm các phương thức xử lý trạng thái
    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->status !== 'PENDING') {
            return back()->with('error', 'Chỉ có thể xác nhận các đơn đang chờ xử lý');
        }

        try {
            // Cập nhật trạng thái
            $booking->update([
                'status' => 'CONFIRMED'
            ]);

            Mail::send('emails.admin-booking-confirmed', ['booking' => $booking], function($message) use ($booking) {
                $message->to($booking->bookingDetail->email)
                        ->subject('Tour của bạn đã được xác nhận');
            });

            return back()->with('success', 'Đã xác nhận đơn đặt tour và gửi mail thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xác nhận booking: ' . $e->getMessage());
            return back()->with('warning', 'Đã xác nhận đơn đặt tour nhưng không gửi được email');
        }
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        // Kiểm tra xem có thể hủy không
        if (!in_array($booking->status, ['PENDING', 'CONFIRMED'])) {
            return back()->with('error', 'Không thể hủy đơn này');
        }

        $booking->update([
            'status' => 'CANCELLED'
        ]);

        // Gửi email thông báo cho khách hàng

        return back()->with('success', 'Đã hủy đơn đặt tour');
    }

    public function complete($id)
    {
        $booking = Booking::findOrFail($id);

        // Kiểm tra xem có thể hoàn thành không
        if ($booking->status !== 'CONFIRMED') {
            return back()->with('error', 'Chỉ có thể hoàn thành các đơn đã xác nhận');
        }

        $booking->update([
            'status' => 'COMPLETED'
        ]);

        return back()->with('success', 'Đã hoàn thành đơn đặt tour');
    }

}
