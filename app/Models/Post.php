<?php

namespace App\Models;

class Post extends Model
{
    use Traits\HashIdHelper;

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'tags'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
