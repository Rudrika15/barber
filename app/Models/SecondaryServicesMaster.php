<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryServicesMaster extends Model
{
    use HasFactory;
    function primary_services(){
        return $this->belongsTo(PrimaryServicesMaster::class,'primaryId');
    }
    function primary_data(){
        return $this->hasOne(PrimaryServicesMaster::class,'primaryId','id');

    }
    function vednor_secondary_service(){
        return $this->hasMany(VendorSecondaryService::class,'primaryId','id');
    }
   
}
