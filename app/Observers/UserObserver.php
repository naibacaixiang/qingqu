<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    public function saved(User $user)
    {


//        $user->magicIncrement($user,'post_count');
    }
}
