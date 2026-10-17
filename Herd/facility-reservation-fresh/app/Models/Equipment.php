<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $fillable = ['name', 'description', 'quantity', 'status'];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}