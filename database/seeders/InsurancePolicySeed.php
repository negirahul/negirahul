<?php

namespace Database\Seeders;

use App\Models\Claim;
use App\Models\InsurancePolicy;
use App\Models\Insurer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;

class InsurancePolicySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $claims = Claim::get();
        $faker = app(Generator::class);
        foreach ($claims as $claim) {
            InsurancePolicy::create([
                'patient_id' => $claim->patient_id,
                'claim_id' => $claim->id,
                'policy_no' => $claim->policy_no,
                'insurer_id' => Insurer::inRandomOrder()->first()->id,
                'policy_id' => Insurer::inRandomOrder()->first()->id,
                'certificate_no' => $faker->numerify('4#2#######5#####'),
                'company_tpa_id_card_no' => $claim->company_tpa_id_card_no,
                'tpa_name' => $faker->firstname().' '.$faker->lastname(),
                'policy_type' => $faker->randomElement(['Retail', 'Group']),
                'group_name' => $faker->company,
                'previous_policy_no' => 'POL'.$faker->numerify('102####'),
                'start_date' => Carbon::now()->subYears(3)->format('d-m-Y'),
                'expiry_date' => Carbon::now()->subYears(3)->format('d-m-Y'),
                'commencement_date' => Carbon::now()->subYears(3)->format('d-m-Y'),
                'title' => $claim->patient->title,
                'firstname' => $claim->patient->firstname,
                'middlename' => $claim->patient->middlename,
                'lastname' => $claim->patient->lastname,
                'is_primary_insured_and_patient_same' => "Yes",
                'primary_insured_address' => $claim->patient->patient_current_address,
                'primary_insured_city' => $claim->patient->patient_current_city,
                'primary_insured_state' => $claim->patient->patient_current_state,
                'primary_insured_pincode' => $claim->patient->patient_current_pincode,
                'no_of_person_insured' => $faker->numerify('#'),
                'basic_sum_insured' => $faker->numerify('5######'),
                'cumulative_bonus_cv' => $faker->numerify('4####'),
                'agent_broker_code' =>'ABC'.$faker->numerify('102####'),
                'agent_broker_name' => $faker->firstname().' '.$faker->lastname(),
                'additional_policy' => "Yes",
                'policy_no_additional' => 'POL'.$faker->numerify('102####'),
                'currently_covered' => "Yes",
                'commencement_date_other' => Carbon::now()->subYears(3)->format('d-m-Y'),
                'insurance_company_other' => Insurer::inRandomOrder()->first()->id,
                'policy_no_other' =>'POL'.$faker->numerify('102####'),
                'sum_insured_other' => $faker->numerify('5######'),
                'hospitalized' => "Yes",
                'admission_date_past' => Carbon::now()->subYears(3)->format('d-m-Y'),
                'diagnosis' => $faker->randomElement(['Tuberculosis', 'Cancer', 'Other']),
                'comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'primary_insured_firstname' => $faker->firstname(),
                'primary_insured_lastname' => $faker->lastname(),
                'primary_insured_gender' => $faker->randomElement(['Male', 'Female']),
                'primary_insured_age' => $faker->numerify('##'),
                'primary_insured_relation' => $faker->randomElement(['Husband', 'Wife', 'Son']),
                'primary_insured_sum_insured' => $faker->numerify('5######'),
                'primary_insured_cumulative_bonus' => $faker->numerify('4###'),
                'primary_insured_balance_sum_insured' => $faker->numerify('3###'),
                'primary_insured_comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'dependent_insured_firstname' =>  $faker->firstname(),
                'dependent_insured_lastname' =>  $faker->lastname(),
                'dependent_insured_gender' => $faker->randomElement(['Male', 'Female']),
                'dependent_insured_age' => $faker->numerify('##'),
                'dependent_insured_relation'  => $faker->randomElement(['Husband', 'Wife', 'Son']),
                'dependent_insured_sum_insured' => $faker->numerify('5######'),
                'dependent_insured_cumulative_bonus' => $faker->numerify('4###'),
                'dependent_insured_balance_sum_insured' => $faker->numerify('3###'),
                'dependent_insured_comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}
