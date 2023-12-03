<?php

namespace App\Pipelines;

use Closure;

class OpenBarrier implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['parking']->barrier->open();

        return $next($data);
    }
}
