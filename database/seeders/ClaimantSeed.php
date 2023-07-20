<?php

namespace Database\Seeders;

use App\Models\Claimant;
use App\Models\User;
use App\Models\Patient;
use App\Models\Claim;
use App\Models\Hospital;
use App\Models\AssociatePartner;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class ClaimantSeed extends Seeder
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
            Claimant::create([
                'email'                             => $claim->id == 1 ? 'claimant@claimstack.com' : $faker->unique()->safeEmail(),
                'password'                          => Hash::make('password'),
                'patient_id'                        => $claim->patient_id,
                'claim_id'                          => $claim->id,
                'associate_partner_id'              => Hospital::find($claim->patient->hospital_id)->linked_associate_partner_id,
                'hospital_id'                       => $claim->patient->hospital_id,                
                'policy_type'                       => $faker->randomElement(['Retail', 'Group']),
                'group_name'                        => "Random Group Name",
                'employee_id_or_member_id'          => "EID".$faker->numerify('######2##########'),
                'are_patient_and_claimant_same'     => "Yes",
                'title'                             => $claim->patient->title,
                'firstname'                         => $claim->patient->firstname,
                'middlename'                        => $claim->patient->middlename,
                'lastname'                          => $claim->patient->lastname,
                'pan_no'                            => 'CCZPP'.$faker->numerify('####').'B',               
                'aadhar_no'                         => $faker->numerify('26##70####30'),
                'patients_relation_with_claimant'   => 'Self',
                'address'                           =>  $claim->patient->patient_current_address,
                'city'                              =>  $claim->patient->patient_current_city,
                'state'                             =>  $claim->patient->patient_current_state,
                'pincode'                           =>  $claim->patient->patient_current_pincode,
                'personal_email_id'                 => $faker->unique()->safeEmail(),    
                'official_email_id'                 => $faker->unique()->safeEmail(),
                'mobile_no'                         => $faker->numerify('9#########'),
                'estimated_amount'                  => $faker->numerify('9#####'),
                'cancel_cheque'                     => $faker->randomElement(['Yes', 'No']),
                'bank_name'                         => $faker->randomElement(['Punjab National Bank', 'State Bank of India', 'Axis Bank', 'HDFC Bank', 'ICICI Bank']),
                'bank_address'                      => $faker->address,
                'ac_no'                             => $faker->numerify('4#7###8###0#'),
                'ifs_code'                          => 'IFSC'.$faker->numerify('9###2##'),
                'comments'                          => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }

        $claimants = Claimant::get(['id', 'pan_no']);
        foreach ($claimants as $partner) {
            Claimant::where('id', $partner->id)->update([
                'uid' => 'CLMT' . substr($partner->pan_no, 0, 2) . substr($partner->pan_no, -3)
            ]);

        }
    }
}
