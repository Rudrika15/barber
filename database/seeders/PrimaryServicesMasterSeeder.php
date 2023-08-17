<?php

namespace Database\Seeders;

use App\Models\PrimaryServicesMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrimaryServicesMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $primaryServices=[
            [
                'serviceName'=>'HairCare',
                'icon'=>'primaryIcon/2Hair_Care.jpg',
            ],
            [
                'serviceName'=>'FaceCare',
                'icon'=>'primaryIcon/FaceCare.jpg',
            ],
            [
                'serviceName'=>'NailCare',
                'icon'=>'primaryIcon/NailCare.jpg',
            ],
            [
                'serviceName'=>'BodyCare & Spa',
                'icon'=>'primaryIcon/BodyCare_Spa.jpg',
            ],
            [
                'serviceName'=>'BodyArt',
                'icon'=>'primaryIcon/BodyArt.jpg',
            ],
            [
                'serviceName'=>'Make-up & Styling',
                'icon'=>'primaryIcon/Make-up-Styling.jpg',
            ]
        ];
    
        foreach($primaryServices as $primaryServicesData){
            PrimaryServicesMaster::Create($primaryServicesData);
        }      
    }
}
