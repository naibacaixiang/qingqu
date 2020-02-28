<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name', 'description','slug','type','cover','post_count','order_by',
    ];

    /**
     * 获取该模型的路由的自定义键名
     * Category模型的键名为slug
     * @return string
     */
//    public function getRouteKeyName()
//    {
//        return 'slug';
//    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }




}
