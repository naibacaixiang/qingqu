<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bubble extends Model
{
    //
    protected $table = 'bubbles';

    protected $fillable = ['content'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
