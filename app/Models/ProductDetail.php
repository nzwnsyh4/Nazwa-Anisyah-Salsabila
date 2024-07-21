<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    public function FromAirport()
    {
        return $this->belongsTo(Airport::class, 'from_airport', 'id');
    }
    public function DestinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport', 'id');
    }
}
