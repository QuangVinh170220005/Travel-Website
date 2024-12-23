<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $table = 'price_lists';
    protected $primaryKey = 'price_list_id';
    protected $fillable = [
        'price_list_name',
        'valid_from',
        'valid_to',
        'description',
        'is_default',
        'tour_id'
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
        'is_default' => 'boolean'
    ];

    public function priceDetails()
    {
        return $this->hasMany(PriceDetail::class, 'price_list_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}