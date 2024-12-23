<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'parent_id' // Thêm parent_id vào fillable
    ];

    // Relationship với user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Sửa lại foreign key
    }

    // Thêm relationship với post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Thêm relationship với replies
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
