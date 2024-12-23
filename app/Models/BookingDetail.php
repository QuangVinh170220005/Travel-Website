<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    protected $fillable = [
        'booking_id',
        'name',
        'email',
        'phone',
        'address',
        'adult_count',
        'child_count'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
