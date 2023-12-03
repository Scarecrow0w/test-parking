<?php

namespace App\Pipelines;

use App\Services\ParkingService;
use Closure;

class SelectCarSpot implements Pipeable
{
    /**
     * Handle an incoming request
     *
     * @param  array<string, \Illuminate\Database\Eloquent\Model>  $data
     * @return array<string, \Illuminate\Database\Eloquent\Model>
     */
    public function handle(array $data, Closure $next)
    {
        $data['car_spot'] = (new ParkingService($data['parking']))->selectCarSpot();

        return $next($data);
    }
}
