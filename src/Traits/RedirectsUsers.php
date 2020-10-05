<?php

namespace Redbastie\Bootwire\Traits;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

trait RedirectsUsers
{
    protected function redirectUrl()
    {
        if (property_exists($this, 'redirectUrl')) {
            return $this->redirectUrl;
        }

        return Auth::guard()->guest() ? '/' : RouteServiceProvider::HOME;
    }

    protected function redirectUser()
    {
        $this->redirect($this->redirectUrl());
    }
}
