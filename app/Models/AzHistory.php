<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzHistory extends Model
{
    use HasFactory;
    protected $table = 'az_histories';
    protected $fillable = [
        'restaurant_id',
        'bank_id',
        'admin_id',
        'seller_code_id',
        'paid_amount',
        'discount',
        'tax',
        'transfer_photo',
        'invoice_id',
        'payment_type',
        'details',
        'subscription_type',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class , 'restaurant_id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class , 'bank_id');
    }
    public function seller_code()
    {
        return $this->belongsTo(AzSellerCode::class , 'seller_code_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }
}
