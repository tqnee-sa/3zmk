<?php

namespace App\Traits;

trait ModelHelper{
    public function getNameAttribute(){
        return @$this['name_' . app()->getLocale()] ?? @$this['name_ar'];
    }
    public function getDescriptionAttribute(){
        return @$this['description_' . app()->getLocale()] ?? @$this['description_ar'];
    }
}
