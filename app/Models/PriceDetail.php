<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    protected $table = 'price_details';
    protected $primaryKey = 'price_detail_id';

    public $timestamps = false;
    
    protected $fillable = [
        'price_list_id',
        'customer_type',
        'price',
        'note'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function priceList()
    {
        return $this->belongsTo(PriceList::class, 'price_list_id');
    }
}