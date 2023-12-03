<?php

namespace App\Pipelines;

use Closure;

interface Pipeable
{
    /**
     * Handle an incoming request
     */
    public function handle(array $pipeable, Closure $next);
}
