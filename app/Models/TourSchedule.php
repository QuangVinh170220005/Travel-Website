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



    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
