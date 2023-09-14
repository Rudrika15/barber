<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimaryServicesMaster extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'urlIcon',
        'business_key',
    ];

    public function secondary_service(){
        return $this->hasMany(SecondaryServicesMaster::class,'primary_service_id','id');
    }
}
