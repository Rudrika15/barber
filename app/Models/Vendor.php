<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    function primary_services(){
        return $this->hasMany(VendorPrimaryService::class,'vendorId','id');
    }
    function seconday_service(){
        return $this->hasMany(VendorSecondaryService::class,'vendorId','id');
    }
    function staff(){
        return $this->hasMany(VendorStaff::class,'vendorId','id');
    }
    function targeted(){
        return $this->hasMany(VendorTargeted::class,'vandorId','id');
    }
    function schedule(){
        return $this->hasMany(VendorSchedule::class,'vendorId','id');
    }
    function document(){
        return $this->hasMany(VendorDocument::class,'vendorId','id');
    }
}
