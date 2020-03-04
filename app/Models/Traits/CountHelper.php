<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait CountHelper
{

    public function magicIncrement(User $user,$table,$col)
    {
        DB::table($table)->where('id',Auth::id())->increment($col);
    }

    public function magicDecrement(User $user,$table,$col)
    {
        DB::table($table)->where('id',Auth::id())->decrement($col);
    }

}