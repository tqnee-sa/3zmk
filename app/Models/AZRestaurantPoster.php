<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AZRestaurantPoster extends Model
{
    use HasFactory;
    protected $table = 'a_z_restaurant_posters';
    protected $fillable = [
        'restaurant_id',
        'name_ar',
        'name_en',
        'poster',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
}
