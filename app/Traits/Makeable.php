<?php

namespace App\Traits;

use Illuminate\Foundation\Application;

trait Makeable
{
    /**
     * Get the available container instance.
     *
     * @param  string|null  $abstract
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|mixed
     */
    public static function make(...$arguments): static|Application
    {
        return app(static::class, $arguments);
    }
}
