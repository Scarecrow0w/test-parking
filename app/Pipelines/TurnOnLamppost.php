<?php

namespace App\Pipelines;

use Closure;

class TurnOnLamppost implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['car_spot']->lamppost->update(['is_turn_on' => true]);

        return $next($data);
    }
}
