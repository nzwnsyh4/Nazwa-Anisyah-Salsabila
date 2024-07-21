<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function Maskapai()
    {
        return $this->belongsTo(Maskapai::class,  'maskapai_id', 'id');
    }
    public function Detail()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }
}
