<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $primaryKey = 'price_list_id';
    protected $fillable = [
        'price_list_name',
        'valid_from',
        'valid_to',
        'description',
        'is_default',
        'tour_id'
    ];

    public function priceDetails()
    {
        return $this->hasMany(PriceDetail::class, 'price_list_id', 'price_list_id');
    }
    
}