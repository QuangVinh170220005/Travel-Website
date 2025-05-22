<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'user_id',
        'schedule_id',
        'booking_date',
        'total_amount',
        'status',
        'special_requests',
        'deposit_amount',
        'need_pickup',
        'pickup_location'
    ];

    protected $primaryKey = 'booking_id';
    // Thêm dòng này vì booking_id là bigint
    public $incrementing = true;
    
    public function bookingDetail()
    {
        return $this->hasOne(BookingDetail::class, 'booking_id', 'booking_id');
    }
    
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'tour_id');
    }

    public function schedule()
    {
        return $this->belongsTo(TourSchedule::class, 'schedule_id', 'schedule_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
