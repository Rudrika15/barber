<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPrimaryService extends Model
{
    use HasFactory;

    function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendorId');
    }
}
