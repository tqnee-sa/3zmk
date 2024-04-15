<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant\Azmak\AZUser;


class AzRestaurantUser extends Model
{
    use HasFactory;
    protected $table = 'az_restaurant_users';
    protected $fillable = [
        'restaurant_id',
        'user_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
    public function user()
    {
        return $this->belongsTo(AZUser::class , 'user_id');
    }
}
