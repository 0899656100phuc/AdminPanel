<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class ImageRoom extends Model
{
    use HasFactory;
   
    protected $table = 'images_room';
    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'room_id',
        'image',
    ];
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
}
