<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
<<<<<<< Updated upstream
    protected $primaryKey = 'tour_id';
=======
    protected $table = 'tours'; 
    protected $primaryKey = 'tour_id'; 
    public $timestamps = false;
>>>>>>> Stashed changes
    protected $fillable = [
        'tour_name',
        'description',
        'duration_days',
        'max_participants',
        'category',
        'transportation',
        'include_hotel',
        'include_meal',
        'highlight_places',
        'is_active',
        'location_id'
    ];
<<<<<<< Updated upstream
}
=======

    protected $casts = [
        'include_hotel' => 'boolean',
        'include_meal' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationship with Location
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'location_id');
    }

    public function priceLists()
    {
        return $this->hasMany(PriceList::class, 'tour_id', 'tour_id');
    }
    public function schedules()
    {
        return $this->hasMany(TourSchedule::class, 'tour_id');
    }

}
>>>>>>> Stashed changes
