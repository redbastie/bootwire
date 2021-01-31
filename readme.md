# NO LONGER MAINTAINED

This package is no longer maintained. Please consider my latest package here: https://github.com/redbastie/skele

-----

# Bootwire

Bootwire is a replacement for the deprecated `laravel/ui` package. It uses Laravel + Livewire + Bootstrap. With a single command it will set you up with basic auth scaffolding for your next Laravel app. This includes login, registration, and password resets.

## Installation

Require via composer:

    composer require redbastie/bootwire
    
Install the package:

    php artisan bootwire:install
    
This will create the livewire components inside of the `app/Http/Livewire` folder. All of the JS, SASS, and view files are created inside of your `resources` folder. It will also insert the auth routes, NPM packages, and update the webpack configuration file.

## Customization

You can override any package trait method inside of your components.

For example, customizing the `Register` component:

    class Register extends Component
    {
        use RegistersUsers;
        
        public function rules()
        {
            return [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'confirmed'],
                // add your new rules here
            ];
        }
    
        protected function createUser($validated)
        {
            return User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                // add your new fields here
            ]);
        }
    }
    
Just look at the package traits to see which methods you can override.
    
For all other customization, make any changes you want to the files created by this package.
