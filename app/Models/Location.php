<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'location_id';
    protected $fillable = [
        'location_name',
        'description',
        'coordinates',
        'is_popular',
        'best_time_to_visit',
        'weather_notes'
    ];

    public function tours()
    {
        return $this->hasMany(Tour::class, 'location_id', 'location_id');
    }

    public function getCoordinatesArrayAttribute()
    {
        if (!$this->coordinates) {
            return null;
        }
        
        list($longitude, $latitude) = explode(',', $this->coordinates);
        return [
            'longitude' => (float) $longitude,
            'latitude' => (float) $latitude
        ];
    }
}