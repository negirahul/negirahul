<?php

namespace Database\Seeders;

use App\Models\Claimant;
use App\Models\DischargeStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
class DischargeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $claimants = Claimant::get();
        $faker = app(Generator::class);
        foreach ($claimants as $claimant) {
            DischargeStatus::create([
                'claimant_id'           => $claimant->id,
                'hospital_id'           => $claimant->hospital_id,
                'patient_id'            => $claimant->patient_id,
                'claim_id'              => $claimant->claim_id,
                'injury_reason'         => $faker->randomElement(['Self Inflected', 'Road Traffic Accident', 'Substance Abuse-Alcohol Consumption']),
                'injury_due_to_substance_abuse_alcohol_consumption' => $faker->randomElement(['Yes', 'No']),
                'if_medico_legal_case_mlc'=> $faker->randomElement(['Yes', 'No']),
                'reported_to_police'=> $faker->randomElement(['Yes', 'No']),
                'mlc_report_and_police_fir_attached'=> $faker->randomElement(['Yes', 'No']),
                'fir_or_mlc_no' => $faker->numerify('FIR-#########'),
                'not_reported_to_police_reason' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'maternity_date_of_delivery'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'maternity_gravida_status_g'=> $faker->numerify('##'),
                'maternity_gravida_status_p'=> $faker->numerify('##'),
                'maternity_gravida_status_l'=> $faker->numerify('##'),
                'maternity_gravida_status_a'=> $faker->numerify('##'),
                'premature_baby'=> $faker->randomElement(['Yes', 'No']),
                'date_of_discharge'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'time_of_discharge'=> Carbon::now()->subMonths(2)->format('H:i:s'),
                'discharge_status' => $faker->randomElement(['Discharge to Home','Discharge to another Hospital','Deceased','LAMA']),
                'death_summary'=> $faker->realText($maxNbChars = 200, $indexSize = 2),
                'discharge_status_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}
