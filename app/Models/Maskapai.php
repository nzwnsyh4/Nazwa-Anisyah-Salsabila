<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    use HasFactory;
    protected $table = 'maskapai';
    public function Owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }
}
