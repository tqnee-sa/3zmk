<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzRestaurantCommission extends Model
{
    use HasFactory;
    protected $table = 'az_restaurant_commissions';
    protected $fillable = [
        'restaurant_id',
        'admin_id',
        'commission_value',
        'transfer_photo',
        'payment_type',       // bank , online,
        'bank_id',
        'payment',
        'invoice_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    public function bank(){
        return $this->belongsTo(Bank::class , 'bank_id');
    }
}
