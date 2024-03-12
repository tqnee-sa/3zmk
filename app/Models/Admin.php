<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',        // admin , sales
        'status'  ,
        'send_email_new_client' , 'send_email_incomplete_restaurant'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function sendPasswordResetNotification($token)
//    {
//        $this->notify(new AdminResetPasswordNotification($token));
//    }

    public function attendances(){
        return $this->hasMany(Attendance::class , 'admin_id');
    }
}
