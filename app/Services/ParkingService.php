<?php

namespace App\Services;

use App\Models\CarSpot;
use App\Models\Parking;

class ParkingService
{
    public function __construct(
        public Parking $parking
    ) {}

    /**
     * Select first free car spot.
     */
    public function selectCarSpot(): ?CarSpot
    {
        return $this->parking->carSpots()->free()->first();
    }
}
