<?php

namespace App\Pipelines;

use Closure;

class MarkCarSpotAsFree implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['user']->activeSession->carSpot->update(['is_busy' => false]);

        return $next($data);
    }
}
