<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;
use App\Models\Room;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = 'bookings_detail';
    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
       
        'room_id',
        'booking_id',

    ];
    public function bookings()
    {
        return $this->belongsTo(Bookings::class,);
    }
    public function rooms()
    {
        return $this->belongsTo(Room::class,);
    }
}
