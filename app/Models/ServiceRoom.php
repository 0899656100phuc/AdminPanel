<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRoom extends Model
{
    use HasFactory;

    protected $table = 'services_room';
    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'room_id',
        'name',

    ];
    public function rooms()
    {
        return $this->belongsTo(Room::class);
    }
}
