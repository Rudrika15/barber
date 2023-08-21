<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryServicesMaster extends Model
{
    use HasFactory;
    function secondary_service(){
        return $this->hasMany(SecondaryServicesMaster::class,'primaryId');
    }
    function vednor_primary_service(){
        return $this->hasMany(VendorPrimaryService::class,'primaryId');
    }
    function vednor_secondary_service(){
        return $this->hasOne(VendorSecondaryService::class,'primaryId');
    }

}
