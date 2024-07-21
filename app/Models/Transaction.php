<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'user_id', 'product_id', 'qty', 'billing_type_id', 'status_id', 'total_price', 'payment_url', 'payment_status', 'payment_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function billingType()
    {
        return $this->belongsTo(BillingType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
