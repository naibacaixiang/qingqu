<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name', 'description','slug','type','cover','post_count','order_by',
    ];


}
