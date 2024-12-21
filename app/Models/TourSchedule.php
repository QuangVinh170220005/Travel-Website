<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourSchedule extends Model
{
    protected $table = 'tour_schedules';
    protected $primaryKey = 'schedule_id';
    
    protected $fillable = [
        'tour_id',
        'price_list_id',
        'departure_date',
        'description',
        'return_date',
        'available_slots',
        'status',
        'meeting_point',
        'meeting_time'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'return_date' => 'datetime',
        'meeting_time' => 'datetime',
        'available_slots' => 'integer'
    ];

    // Định nghĩa các giá trị status có thể có
    const STATUS_OPEN = 'OPEN';
    const STATUS_FULL = 'FULL';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CANCELLED = 'CANCELLED';


    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }
}
