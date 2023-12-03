<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamppost extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
       'is_turn_on' => 'boolean',
    ];

    /**
     * Get the car spot that owns the Lamppost
     */
    public function carSpot(): BelongsTo
    {
        return $this->belongsTo(CarSpot::class);
    }
}
