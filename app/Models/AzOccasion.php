<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzOccasion extends Model
{
    use HasFactory;
    protected $table = 'az_occasions';
    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
    ];
}
