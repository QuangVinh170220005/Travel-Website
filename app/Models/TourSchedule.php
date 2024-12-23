<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TourSchedule extends Model
{
    protected $table = 'tour_schedules';
    protected $primaryKey = 'schedule_id';
    public $timestamps = false;
    
    protected $fillable = [
        'tour_id',
        'day_number',
        'departure_date',
        'description',
        'meeting_point',
        'meeting_time'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'meeting_time' => 'datetime',
    ];


    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class, foreignKey: 'tour_id');
    }
    public function scopeOrdered($query)
    {
        return $query->orderBy('day_number');
    }
}
