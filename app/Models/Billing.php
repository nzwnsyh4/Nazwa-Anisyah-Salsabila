<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function Detail()
    {
        return $this->hasMany(BillingDetail::class, 'billing_id', 'id');
    }
    public function BillingType()
    {
        return $this->hasOne(BillingType::class, 'id', 'billing_type_id');
    }
    public function Payment()
    {
        return $this->hasOne(Payment::class, 'billing_id', 'id');
    }
    public function Ticket()
    {
        return $this->hasOne(Ticket::class, 'billing_id', 'id');
    }
    public function Status()
    {
        return $this->belongsTo(BillingStatus::class, 'status_id', 'id');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
