<?php

namespace App\Models;

use App\Models\Restaurant\Azmak\AZProduct;
use App\Models\Restaurant\Azmak\AZBranch;
use App\Models\Restaurant\Azmak\AZOrder;
use App\Models\AzRestaurantCommission;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Restaurant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'restaurant';
    protected $table = 'restaurants';
    protected $fillable = [
        'restaurant_id',
        'name_ar',
        'name_en',
        'country_id',
        'city_id',
        'package_id',
        'phone_number',
        'email',
        'password',
        'phone_verification',
        'latitude',
        'longitude',
        'status',     //ENUM( 'inComplete','tentative','active','finished' ),
        'logo',
        'ar',    // true , false
        'en',    // true , false
        'archive',    // true , false
        'cart',    // true , false
        'name_barcode', // the name used for barcode,
        'menu_arrange',
        'product_arrange',
        'total_tax_price',
        'tax_value',
        'tax',
        'tax_foodics_id',
        'foodics_charge_id',
        'information_ar',
        'information_en',
        'description_ar',
        'description_en',
        'views',
        'myfatoora_token',
        'show_branches_list',
        'menu',        // ENUM('vertical','horizontal'),
        'state',       // ENUM('open','closed','busy' , 'un_available')
        'enable_feedback',
        'foodics_status', // Emun (true,false)
        'foodics_referance',
        'foodics_state',
        'foodics_access_token', // text
        'delivery_price',     // delivery price used for foodics deliveries
        'enable_bank', // Emun (true,false)
        'enable_reservation_online_pay', 'enable_reservation_bank',
        'enable_online_payment', // Emun (true,false)
        'reservation_description_ar',
        'reservation_description_en',
        'reservation_service',     // true , false
        'answer_id',
        'orders',
        'foodics_orders',
        'whatsapp_orders',
        'enable_fixed_category',  //true , false
        'enable_contact_us',  //true , false
        'enable_reservation_cash', //true , false
        'default_lang',
        'is_call_phone', //true , false
        'is_whatsapp', //true , false
        'call_phone',
        'whatsapp_number',
        'payment_company',
        'online_token',
        'theme_id',
        'archive_category_id',
        'merchant_key',
        'express_password',
        'stop_menu',
        'admin_activation',
        'type',   // restaurant , employee
        'online_payment_fees',
        'last_session',
        'reservation_to_restaurant', // true , false
        'last_activity',
        'reservation_call_number', 'reservation_is_call_phone', 'reservation_whatsapp_number', 'reservation_tax_value', 'reservation_is_whatsapp', 'reservation_tax',
        'enable_loyalty_point', // true, false
        'enable_loyalty_point_paymet_method', //true , false
        'header', 'footer',
        'sms_method', // enum [taqnyat]
        'sms_sender',  'sms_token',
        'slider_down_contact_us_title',
        'archive_reason', 'archived_by_id',
        'enable_party_payment_bank',  // enum [true , false]
        'enable_party_payment_online',  // enum [true , false]
        'enable_party', // enum [true , false]
        'reservation_title_ar', 'reservation_title_en', 'party_description_ar', 'party_description_en', 'enable_party_payment_cash', // enum [true , false]
        'party_to_restaurant', 'party_is_call_phone', 'party_is_whatsapp', 'party_tax', 'party_tax_value', 'party_call_phone', 'party_whatsapp_number',
        'product_menu_view',
        'enable_reservation_email_notification', // enum [true , false]
        'reservation_sms_otp', 'reservation_sms_success', // enum [true , false]
        'reservation_email_notification',
        'enable_party_email_notification', // enum [true , false]
        'party_email_notification',
        'enable_waiter', // enum [true , false]
        'bio_description_ar', 'bio_description_en', // description of restaurant show in bio links
        'waiting_progress_time', 'waiting_max_new_request', 'waiting_new_request', 'waiting_alert_type', 'enable_waiting', 'waiting_privacy_en', 'waiting_privacy_ar',
        'lucky_day_wins_count', 'enable_lucky_wheel',
        'enable_loyalty_offer', 'enable_contact_us_links' ,
        'a_z_orders_payment_type',
        'a_z_tap_token',
        'a_z_myFatoourah_token',
        'a_z_edfa_merchant',
        'a_z_edfa_password',
        'az_logo',
        'az_commission'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'waiting_new_request' => 'json',
    ];
    public function getImagePathAttribute()
    {
        return 'uploads/restaurants/logo/' . $this->logo;
    }
    public function getBioDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->bio_description_ar : $this->bio_description_en;
    }
    public function getNameAttribute()
    {
        return app()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }
    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'en' ? $this->description_en : $this->description_ar;
    }
    public function getWaitingPrivacyAttribute()
    {
        return app()->getLocale() == 'en' ? $this->waiting_privacy_en : $this->waiting_privacy_ar;
    }
    public function getReservationTitleAttribute()
    {
        return app()->getLocale() == 'en' ? $this->reservation_title_en : $this->reservation_title_ar;
    }
    public function getPartyDescriptionAttribute()
    {
        return app()->getLocale() == 'en' ? $this->party_description_en : $this->party_description_ar;
    }
    public function archiveBy()
    {
        return $this->belongsTo(Admin::class, 'archived_by_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function marketerOperations()
    {
        return $this->hasMany(MarketerOperation::class, 'restaurant_id');
    }

    public function color()
    {
        return $this->hasOne(RestaurantColors::class, 'restaurant_id');
    }

    public function menu_categories()
    {
        return $this->hasMany(MenuCategory::class, 'restaurant_id');
    }
    public function restaurantCategories()
    {
        return $this->belongsToMany(Category::class, 'restaurant_categories', 'restaurant_id', 'category_id');
    }
    public function branches()
    {
        return $this->hasMany(AZBranch::class, 'restaurant_id');
    }
    public function tables()
    {
        return $this->hasMany(Table::class, 'restaurant_id');
    }
    public function products()
    {
        return $this->hasMany(AZProduct::class, 'restaurant_id');
    }
    public function deliveries()
    {
        return $this->hasMany(RestaurantDelivery::class, 'restaurant_id');
    }
    public function socials()
    {
        return $this->hasMany(RestaurantSocial::class, 'restaurant_id');
    }
    public function sensitivities()
    {
        return $this->hasMany(RestaurantSensitivity::class, 'restaurant_id');
    }
    public function offers()
    {
        return $this->hasMany(RestaurantOffer::class, 'restaurant_id');
    }
    public function sliders()
    {
        return $this->hasMany(AzRestaurantSlider::class, 'restaurant_id');
    }

    public function banks()
    {
        return $this->hasMany(Bank::class, 'restaurant_id');
    }


    public function histories()
    {
        return $this->hasMany(History::class, 'restaurant_id');
    }

    public function posters()
    {
        return $this->hasMany(RestaurantPoster::class, 'restaurant_id');
    }
    public function answer()
    {
        return $this->belongsTo(RegisterAnswers::class, 'answer_id');
    }
    public function contactUsItems()
    {
        return $this->hasMany(RestaurantContactUs::class, 'restaurant_id');
    }
    public function az_subscription()
    {
        return $this->hasOne(AzSubscription::class , 'restaurant_id');
    }
    public function az_orders()
    {
        return $this->hasMany(AZOrder::class , 'restaurant_id');
    }
    public function az_commissions()
    {
        return $this->hasMany(AzRestaurantCommission::class , 'restaurant_id');
    }
}
