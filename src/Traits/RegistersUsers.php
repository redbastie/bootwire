<?php

namespace Redbastie\Bootwire\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

trait RegistersUsers
{
    use RedirectsUsers;

    public $state = [];

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ];
    }

    protected function createUser($validated)
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }

    public function register()
    {
        $validated = Validator::make($this->state, $this->rules())->validate();

        Auth::guard()->login($this->createUser($validated));

        $this->redirectUser();
    }
}
