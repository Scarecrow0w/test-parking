<?php

namespace App\Pipelines;

use Closure;

class PayForParking implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['user']->decrement('balance', $data['amount']);

        return $next($data);
    }
}
