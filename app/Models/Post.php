<?php

namespace App\Models;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'tags', 'reply_count', 'view_count', 'gift_count', 'status', 'download_link', 'excerpt'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
