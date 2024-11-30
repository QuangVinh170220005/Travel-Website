<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'booking_id';
    
    protected $fillable = [
        'user_id', 'tour_id', 'schedule_id', 'booking_date',
        'total_amount', 'status', 'special_requests',
        'deposit_amount', 'need_pickup', 'pickup_location'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'need_pickup' => 'boolean',
        'total_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'tour_id');
    }

    public function schedule()
    {
        return $this->belongsTo(TourSchedule::class, 'schedule_id', 'schedule_id');
    }
}
