<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CarSpot extends Model
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
       'is_busy' => 'boolean',
    ];

    /**
     * Get the parking that owns the CarSpot
     */
    public function parking(): BelongsTo
    {
        return $this->belongsTo(Parking::class);
    }

    /**
     * Get the lamppost associated with the CarSpot
     */
    public function lamppost(): HasOne
    {
        return $this->hasOne(Lamppost::class);
    }

    /**
     * Scope a query to only include free car spots.
     */
    public function scopeFree(Builder $query): void
    {
        $query->where('is_busy', false);
    }

    /**
     * Get all of the sessions for the CarSpot
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
