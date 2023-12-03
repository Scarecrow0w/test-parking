<?php

namespace Database\Seeders;

use App\Models\CarSpot;
use App\Models\Parking;
use Illuminate\Database\Seeder;

class ParkingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Parking::factory()
            ->hasBarrier()
            ->has(
                CarSpot::factory()
                    ->count(6)
                    ->hasLamppost()
            )->create();
    }
}
