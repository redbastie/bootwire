<?php

namespace Redbastie\Bootwire\Traits;

use Illuminate\Support\Facades\Auth;

trait LogsUsersOut
{
    use RedirectsUsers;

    public function render()
    {
        return view('livewire.auth.logout');
    }

    public function logout()
    {
        Auth::guard()->logout();

        $this->redirectUser();
    }
}
