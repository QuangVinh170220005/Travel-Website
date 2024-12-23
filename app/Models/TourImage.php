<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
        protected $table = 'tour_images';
        protected $primaryKey = 'image_id';
        public $timestamps = false;
        protected $fillable = [
            'tour_id',
            'image_path',
            'is_main'
        ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tourImage) {
            if (empty($tourImage->tour_id)) {
                throw new \Exception('Tour ID is required');
            }
        });
    }
}
