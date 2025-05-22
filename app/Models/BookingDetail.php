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

    protected $table = 'booking_details';
    protected $primaryKey = 'detail_id'; // Chú ý đây
    
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
