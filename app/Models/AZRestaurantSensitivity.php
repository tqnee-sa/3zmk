<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AZRestaurantSensitivity extends Model
{
    use HasFactory;
    protected $table = 'a_z_restaurant_sensitivities';
    protected $fillable = [
        'restaurant_id',
        'name_ar',
        'name_en',
        'photo',
        'details_ar',
        'details_en',
        'easy_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
}
