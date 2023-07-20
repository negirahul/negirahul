<?php

namespace Database\Seeders;

use App\Models\AssessmentStatus;
use App\Models\Claimant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
class AssessmentStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $claimants  = Claimant::get();
        $faker      = app(Generator::class);
        foreach ($claimants as $claimant) {
            AssessmentStatus::create([
                'patient_id' => $claimant->patient_id,
                'claim_id' => $claimant->claim_id,
                'claimant_id' => $claimant->id,
                'hospital_id' => $claimant->hospital_id,       
                'hospital_on_the_panel_of_insurance_co' => $faker->randomElement(['Yes', 'No']),
                'hospital_id_insurance_co' => $faker->numerify('HSP##'),
                'pre_assessment_status' => $faker->randomElement(['Waiting for Pre-Assessment', 'Query Raised by BHC Team', 'Non Admissible as per the Policy TC', 'Non Admissible as per the Treatment Received', 'Admissible']),
                'query_pre_assessment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'pre_assessment_amount'=> $faker->numerify('1#######'),
                'pre_assessment_suspected_fraud'=> $faker->randomElement(['Yes', 'No']),
                'pre_assessment_status_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'final_assessment_status'=> $faker->randomElement(['Waiting for Final-Assessment', 'Query Raised by BHC Team', 'Non Admissible as per the Policy TC', 'Non Admissible as per the Treatment Received', 'Admissible']),
                'query_final_assessment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'final_assessment_amount'=> $faker->numerify('1#######'),
                'final_assessment_suspected_fraud'=> $faker->randomElement(['Yes', 'No']),
                'final_assessment_status_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        
            ]);
        }       
    }
}
