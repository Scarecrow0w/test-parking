<?php

namespace App\Pipelines;

use Closure;

class FinishSession implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $active_session = $data['user']->activeSession;

        $data['amount'] = $data['parking']->tariff * $active_session->started_at->diffInRealMinutes();

        $active_session->update([
            'amount' => $data['amount'],
            'finished_at' => now(),
        ]);

        $data['car_spot'] = $active_session->carSpot;

        return $next($data);
    }
}
