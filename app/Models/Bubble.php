<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bubble extends Model
{
    use Traits\HashIdHelper;

    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'user_id', 'category_id', 'tags'];




}
