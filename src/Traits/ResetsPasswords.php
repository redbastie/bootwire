<?php

namespace Redbastie\Bootwire\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

trait ResetsPasswords
{
    use ThrottlesAttempts, RedirectsUsers;

    public $state = [];

    public function mount($token, $email)
    {
        $this->state = [
            'token' => $token,
            'email' => $email,
        ];
    }

    public function render()
    {
        return view('livewire.auth.password.reset');
    }

    public function rules()
    {
        return [
            'password' => ['required', 'confirmed'],
        ];
    }

    public function resetPassword()
    {
        Validator::make($this->state, $this->rules())->validate();

        if ($this->hasTooManyAttempts()) {
            $this->addError('password', trans('passwords.throttled'));
        }
        else if ($this->resetPasswordHandled()) {
            $this->incrementAttempts();
            $this->addError('password', trans('passwords.token'));
        }
        else {
            $this->clearAttempts();
            $this->redirectUser();
        }
    }

    protected function resetPasswordHandled()
    {
        $response = Password::broker()->reset($this->state, function ($user, $password) {
            $user->update(['password' => Hash::make($password)]);

            Auth::guard()->login($user, true);
        });

        return $response == Password::PASSWORD_RESET;
    }
}
