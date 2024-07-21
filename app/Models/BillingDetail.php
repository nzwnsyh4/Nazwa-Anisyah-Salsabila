<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    public function Billing()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }
}
