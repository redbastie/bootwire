<?php

namespace Redbastie\Bootwire\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

trait SendsPasswordResetLinks
{
    use ThrottlesAttempts;

    public $state = [];
    public $sent;

    public function render()
    {
        return view('livewire.auth.password.forgot');
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    public function send()
    {
        $validated = Validator::make($this->state, $this->rules())->validate();

        if ($this->hasTooManyAttempts()) {
            $this->addError('email', trans('passwords.throttled'));
        }
        else if (!$user = User::where('email', $validated['email'])->first()) {
            $this->incrementAttempts();
            $this->addError('email', trans('passwords.user'));
        }
        else {
            $this->clearAttempts();
            $this->sendPasswordResetLink($user);
            $this->sent = trans('passwords.sent');
        }
    }

    protected function sendPasswordResetLink($user)
    {
        Password::broker()->sendResetLink(['email' => $user->email]);
    }
}
