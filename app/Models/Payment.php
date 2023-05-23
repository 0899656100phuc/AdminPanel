<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;


class Payment extends Model
{
    use HasFactory;
    protected $table = 'payment';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'payment_date',
        'payment_method',
        'payment_amount',
        'booking_id',
        'date_booking'

    ];
    public function booking()
    {
        return $this->belongsTo(Bookings::class);
    }
}
