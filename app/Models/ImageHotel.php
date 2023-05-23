<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageHotel extends Model
{
    use HasFactory;
    protected $table = 'images_hotel';
    
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'hotel_id',
        'image',
    ];
    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
}
