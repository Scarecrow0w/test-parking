<?php

namespace App\Pipelines;

use Closure;

class MarkCarSpotAsBusy implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['car_spot']->update(['is_busy' => true]);

        return $next($data);
    }
}
