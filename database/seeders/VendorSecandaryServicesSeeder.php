<?php

namespace Database\Seeders;

use App\Models\VendorSecondaryService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSecandaryServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $vendroSecondaryService=[
            [
                'vendorId'=>4,
                'secondaryId'=>1
            ],
            [
                'vendorId'=>4,
                'secondaryId'=>2
            ],
            [
                'vendorId'=>4,
                'secondaryId'=>3
            ],
            [
                'vendorId'=>4,
                'secondaryId'=>4
            ],
            [
                'vendorId'=>4,
                'secondaryId'=>5
            ],
            [
                'vendorId'=>4,
                'secondaryId'=>6
            ],
        ];
        foreach($vendroSecondaryService as $vendroSecondaryServiceData){
            VendorSecondaryService::Create($vendroSecondaryServiceData);
        }
    }
}
