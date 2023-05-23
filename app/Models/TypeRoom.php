<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
class TypeRoom extends Model
{
    use HasFactory;
    protected $table = 'type_room';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [

        'id',
        'name',
        'price',
        'area',
        'number_of_people',
        'number_of_bed',
        
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
   /*  public function images()
    {
        return $this->hasMany(ImageHotel::class);
    } */
}
