<?php

namespace App\Models\Restaurant\Azmak;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant;
use App\Models\City;
use App\Traits\ModelHelper;

class AZBranch extends Model
{
    use HasFactory ,ModelHelper;
    protected  $table = 'a_z_branches';
    protected $fillable = [
        'restaurant_id',
        'city_id',
        'name_ar',
        'name_en',
        'latitude',
        'longitude',
    ];
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }
}
