<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Session extends Model
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
       'amount' => 'decimal:2',
       'started_at' => 'datetime',
       'finished_at' => 'datetime',
    ];

    /**
     * Get the user that owns the Session
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car Spot that owns the Session
     */
    public function carSpot(): BelongsTo
    {
        return $this->belongsTo(CarSpot::class);
    }

    /**
     * Get the parking that owns the Session
     */
    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }
}
