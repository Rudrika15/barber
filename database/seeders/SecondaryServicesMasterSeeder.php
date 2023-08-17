<?php

namespace Database\Seeders;

use App\Models\SecondaryServicesMaster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecondaryServicesMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $secondaryServices=[
            [
                'primaryId'=>1,
                'secondaryName'=>'HairCut',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'HairWash',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Hair Styling',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Hair Coloring',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Hair Spa',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Hair Extension',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Hair Treatments',
            ],
            [
                'primaryId'=>1,
                'secondaryName'=>'Scalp Treatments',
            ],
            // Face Care
            [
                'primaryId'=>2,
                'secondaryName'=>'Facial',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Clean Up',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Masks',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Waxing',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Thearding/Bleaching',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Mustache/Beard Grooming',   
            ],
            [
                'primaryId'=>2,
                'secondaryName'=>'Advanced Skincare Treatments',   
            ],
            // Nail Care
            [
                'primaryId'=>3,
                'secondaryName'=>'Manicure',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'padicure',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'Nail Polish',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'Nail Extensions',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'Nail Art',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'Stick Ons',   
            ],
            [
                'primaryId'=>3,
                'secondaryName'=>'Refills/Removals',   
            ],
            //BodyCare & Spa
            [
                'primaryId'=>4,
                'secondaryName'=>'waxing',   
            ],
            [
                'primaryId'=>4,
                'secondaryName'=>'message',   
            ],
            [
                'primaryId'=>4,
                'secondaryName'=>'Body Polishing',   
            ],
            [
                'primaryId'=>4,
                'secondaryName'=>'AromaTherapy',   
            ],
            [
                'primaryId'=>4,
                'secondaryName'=>'Reflexology',   
            ],
            [
                'primaryId'=>4,
                'secondaryName'=>'Advanced Skincare Treatements',   
            ],
            // Body Art
            [
                'primaryId'=>5,
                'secondaryName'=>'Tattoo'
            ],
            [
                'primaryId'=>5,
                'secondaryName'=>'Piercing'
            ],
            [
                'primaryId'=>5,
                'secondaryName'=>'Henna/Mehendi'
            ],
            // Make-up & Styling
            [
                'primaryId'=>6,
                'secondaryName'=>'Bridal/Groom Make-up'
            ],
            [
                'primaryId'=>6,
                'secondaryName'=>'Every Day Make-up'
            ],
            [
                'primaryId'=>6,
                'secondaryName'=>'Party Make-up'
            ],
            [
                'primaryId'=>6,
                'secondaryName'=>'Semi-Permenent Make-up'
            ],
            [
                'primaryId'=>6,
                'secondaryName'=>'Saree Draping'
            ],
            [
                'primaryId'=>6,
                'secondaryName'=>'Outdoor Events'
            ],
        ];
        foreach($secondaryServices as $secondaryServicesData){
            SecondaryServicesMaster::Create($secondaryServicesData);
        }
    }
}
