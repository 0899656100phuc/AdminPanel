<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bookings;

class People extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'people';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id ',
        'elder',
        'children',
        'id_booking',

    ];
    public function bookingUser()
    {
        return $this->belongsTo(Bookings::class);
    }
}
