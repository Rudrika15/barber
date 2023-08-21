<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSecondaryService extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo(User::class, 'vendorId');
    }
    // function secondary_services()
    // {
    //     return $this->belongsTo(SecondaryServicesMaster::class,'primaryId','id');
    // }
    // function primary_services()
    // {
    //     return $this->belongsTo(PrimaryServicesMaster::class,'primaryId');
    // }
    function primary_services(){
        return $this->belongsTo(PrimaryServicesMaster::class,'primaryId');
    }
    function secondary_services(){
        return $this->belongsTo(SecondaryServicesMaster::class,'primaryId');
    }
    function secondary_services_list(){
        return $this->hasMany(SecondaryServicesMaster::class,'primaryId');
    }
    
    
}
