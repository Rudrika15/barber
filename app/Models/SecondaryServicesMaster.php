<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryServicesMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_service_id',
        'secondaryName',
        'urlIcon',
        'business_key',
    ];
}
