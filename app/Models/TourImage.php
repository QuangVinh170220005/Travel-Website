<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    public $timestamps = false;
    protected $table = 'tour_images';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'tour_id',
        'image_path',
        'is_main'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}