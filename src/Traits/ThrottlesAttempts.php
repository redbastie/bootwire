<?php

namespace Redbastie\Bootwire\Traits;

use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

trait ThrottlesAttempts
{
    protected function hasTooManyAttempts()
    {
        return $this->rateLimiter()->tooManyAttempts($this->throttleKey(), $this->maxAttempts(), $this->decayMinutes());
    }

    protected function availableInSeconds()
    {
        return $this->rateLimiter()->availableIn($this->throttleKey());
    }

    protected function incrementAttempts()
    {
        $this->rateLimiter()->hit($this->throttleKey());
    }

    protected function clearAttempts()
    {
        $this->rateLimiter()->clear($this->throttleKey());
    }

    protected function throttleKeyPrefix()
    {
        return $this->state['email'];
    }

    protected function throttleKey()
    {
        return Str::lower($this->throttleKeyPrefix()) . '|' . request()->ip();
    }

    protected function rateLimiter()
    {
        return app(RateLimiter::class);
    }

    protected function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    protected function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}
