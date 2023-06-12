<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingDetail;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\People;




class Bookings extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'user_id',
        'date_booking',
        'note',
        'number_of_room',

    ];
    public function bookingDetailBooking()
    {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function numberOfPeople()
    {
        return $this->hasMany(People::class, 'id_booking');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,);
    }
}
