<?php

namespace App\Pipelines;

use Closure;

class StartSession implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['parking']->sessions()->create([
            'user_id' => $data['user']->id,
            'car_spot_id' => $data['car_spot']->id,
            'started_at' => now(),
        ]);

        return $next($data);
    }
}
