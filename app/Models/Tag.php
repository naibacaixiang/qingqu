<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Traits\HashIdHelper;

    protected $fillable = ['name'];
}
