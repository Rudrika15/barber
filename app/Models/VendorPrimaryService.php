<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VendorPrimaryService extends Model
{
    use HasFactory;

    function user(){
        return $this->belongsTo(User::class,'vendorId');
    }
    function primary_services(){
        return $this->belongsTo(PrimaryServicesMaster::class,'primaryId');
    }
    function secondary_services(){
        return $this->hasMany(SecondaryServicesMaster::class,'primaryId','id');
    }
    public function vendor_secondary_services()
    {
        return $this->hasMany(VendorSecondaryService::class,'vendorId');
    }
   
    // public function vendor_secondary_services()
    // {
    //     return $this->hasMany(VendorSecondaryService::class, 'vendorId','vendorId');
    // }
}
