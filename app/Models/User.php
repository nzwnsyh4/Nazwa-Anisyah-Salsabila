<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Maskapai()
    {
        return $this->hasOne(Maskapai::class, 'owner_id', 'id');
    }
    public function Ticket()
    {
        return $this->hasMany(Ticket::class, 'user_id', 'id')->whereHas('Billing', function ($q) {
            return  $q->where('status_id', 4);
        });
    }
    public function Pesanan()
    {
        return $this->hasMany(Billing::class, 'user_id', 'id')->whereNotIn('status_id', [4]);
    }
}
