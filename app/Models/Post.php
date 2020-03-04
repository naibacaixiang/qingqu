<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Traits\HashIdHelper;
    use Traits\PostTagHelper;
    use Traits\CountHelper;
    use SoftDeletes;//软删除

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'tags'];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
