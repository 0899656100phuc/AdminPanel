<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Room;
use App\Models\Citys;

use App\Models\TypeRoom;



class Hotel extends Model

{
    use HasFactory;

    protected $table = 'hotels';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'city_id',
        'name',
        'address',
        'phone',
        'image',
        'email',
        'star_number',
        'description',

    ];
    public function citys()
    {
        return $this->belongsTo(Citys::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
   
    public function images()
    {
        return $this->hasMany(ImageHotel::class);
    }
    
}
