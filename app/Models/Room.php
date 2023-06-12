<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TypeRoom;
use App\Models\Hotel;
use App\Models\BookingDetail;
use App\Models\ImageRoom;
use App\Models\ServiceRoom;




class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'hotel_id',
        'type_room_id',
        'name',
        'description',
        'status',

    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class);
    }
    public function bookingDetailRoom()
    {
        return $this->hasOne(BookingDetail::class, 'room_id');
    }
    public function images()
    {
        return $this->hasMany(ImageRoom::class);
    }
    public function services()
    {
        return $this->hasMany(ServiceRoom::class);
    }
}
