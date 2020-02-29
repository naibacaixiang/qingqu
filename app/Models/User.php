<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Hashids\Hashids;

class User extends Authenticatable
{
    use Notifiable;
    use Traits\HashIdHelper;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }





    public function feed()
    {
        return $this->bubbles()
            ->orderBy('created_at', 'desc');
    }


    //Eloquent 修改器, admin后台修改密码时用到的
    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况（就是用户自己注册时或者改密码时）
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理（后台改密码时）
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function bubbles()
    {
        return $this->hasMany(Bubble::class);
    }


}
