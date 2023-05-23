<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;
class Citys extends Model
{
    use HasFactory;
    protected $table = 'citys';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'sub_name',
        'image'
    ];
   
    public function hotels()
    {
        return $this->hasMany(Hotel::class,'city_id');
    }
   
}
