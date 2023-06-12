<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Bookings;



class Customer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'customers';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id ',
        'username',
        'password',
        'email',
        'phone',

    ];
    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'user_id');
    }
}
