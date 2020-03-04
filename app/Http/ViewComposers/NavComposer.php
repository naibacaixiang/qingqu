<?php
namespace App\Http\ViewComposers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class NavComposer
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function compose(View $view)
    {
        $user = Auth::user();

        $view->with('user', $user);
    }
}
