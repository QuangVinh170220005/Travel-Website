<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists'; 
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'user_id',
        'tour_id',
    ];

    /**
     * Liên kết với bảng users (Một wishlist thuộc về một người dùng)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Liên kết với bảng tours (Một wishlist thuộc về một tour)
     */
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'tour_id');
    }
}
