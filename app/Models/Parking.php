<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Parking extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the car spots for the Parking
     */
    public function carSpots(): HasMany
    {
        return $this->hasMany(CarSpot::class);
    }

    /**
     * Get the barrier associated with the Parking
     */
    public function barrier(): HasOne
    {
        return $this->hasOne(Barrier::class);
    }

    /**
     * Get all of the sessions for the Parking
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
