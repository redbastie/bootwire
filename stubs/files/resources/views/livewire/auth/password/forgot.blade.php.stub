@section('title', __('Reset Password'))

<main class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    @yield('title')
                </div>
                <div class="card-body">
                    @if($this->sent)
                        {{ $this->sent }}
                    @else
                        <form wire:submit.prevent="send">
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       wire:model.defer="state.email">
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
