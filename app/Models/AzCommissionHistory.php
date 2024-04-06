<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzCommissionHistory extends Model
{
    use HasFactory;
    protected $table = 'az_commission_histories';
    protected $fillable = [
        'restaurant_id',
        'admin_id',
        'bank_id',
        'paid_amount',
        'payment_type',
        'invoice_id',
        'transfer_photo',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class , 'Bank_id');
    }
}
