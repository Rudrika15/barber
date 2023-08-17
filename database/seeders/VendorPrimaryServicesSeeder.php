<?php

namespace Database\Seeders;

use App\Models\VendorPrimaryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorPrimaryServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $vednorPrimaryService=[
            [
                'vendorId'=>4,
                'primaryId'=>1
            ],
            [
                'vendorId'=>4,
                'primaryId'=>2
            ],
            [
                'vendorId'=>4,
                'primaryId'=>3
            ],
            [
                'vendorId'=>4,
                'primaryId'=>4
            ],
            [
                'vendorId'=>4,
                'primaryId'=>5
            ],
            [
                'vendorId'=>4,
                'primaryId'=>6
            ],
        ];
        foreach($vednorPrimaryService as $vednorPrimaryServiceData){
            VendorPrimaryService::Create($vednorPrimaryServiceData);
        }
    }
}
