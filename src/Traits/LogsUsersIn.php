<?php

namespace Redbastie\Bootwire\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait LogsUsersIn
{
    use ThrottlesAttempts, RedirectsUsers;

    public $state = [];

    public function render()
    {
        return view('livewire.auth.login');
    }

    protected function username()
    {
        return 'email';
    }

    public function rules()
    {
        return [
            $this->username() => ['required'],
            'password' => ['required'],
        ];
    }

    public function login()
    {
        $validated = Validator::make($this->state, $this->rules())->validate();

        if ($this->hasTooManyAttempts()) {
            $this->addError($this->username(), trans('auth.throttle', ['seconds' => $this->availableInSeconds()]));
        }
        else if (!Auth::guard()->attempt($validated, $this->state['remember'] ?? false)) {
            $this->incrementAttempts();
            $this->addError($this->username(), trans('auth.failed'));
        }
        else {
            $this->clearAttempts();
            $this->redirectUser();
        }
    }

    protected function throttleKeyPrefix()
    {
        return $this->state[$this->username()];
    }
}
