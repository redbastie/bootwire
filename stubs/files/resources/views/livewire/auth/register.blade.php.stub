@section('title', __('Register'))

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="register">
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                   wire:model.defer="state.name">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                   wire:model.defer="state.email">
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                   wire:model.defer="state.password">
                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" class="form-control"
                                   wire:model.defer="state.password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
