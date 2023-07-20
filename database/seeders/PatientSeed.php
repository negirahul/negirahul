<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use App\Models\AssociatePartner;
use App\Models\Hospital;
use App\Models\HospitalDepartment;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class PatientSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);


        for ($i = 1; $i < 20; $i++) {
            $hospital                       = Hospital::inRandomOrder()->first();
            $hospital->ap_name              = AssociatePartner::where('id', $hospital->linked_associate_partner)->value('name');
            $dob                            = Carbon::now()->subYears(35)->format('d-m-Y');
            $age                            = Carbon::parse($dob)->age;
            $address                        = $faker->address;
            $city                           = $faker->city;
            $state                          = $faker->state;
            $postcode                       = $faker->numerify('1100##');
            Patient::create([
                'uid'                       => 'P-'.$i+10000,
                'title'                     => $faker->randomElement(['Mr.', 'Ms.']),
                'firstname'                 => $faker->firstname(),
                'middlename'                => $faker->lastname(),
                'lastname'                  => $faker->lastname(),
                'dob'                       => $dob,
                'age'                       => $age,
                'gender'                    => "Male",
                'occupation'                => "Other",
                'specify'                   => $faker->randomElement(['Doctor', 'Police', 'Engineer']),
                'patient_current_address'   => $address,
                'patient_current_city'      => $city,
                'patient_current_state'     => $state,
                'patient_current_pincode'   => $postcode,
                'current_permanent_address_same' => 'Yes',
                'patient_permanent_address' => $address,
                'patient_permanent_city'    => $city,
                'patient_permanent_state'   => $state,
                'patient_permanent_pincode' => $postcode,
                'id_proof'                  => 'Aadhar Card',
                'hospital_id'               => $hospital->id,
                'hospital_name'             => $hospital->name,
                'hospital_address'          => $hospital->address,
                'hospital_city'             => $hospital->city,
                'hospital_state'            => $hospital->state,
                'registration_number'       => $faker->numerify('4#2#######5#####0###'),
                'treating_doctor'           => HospitalDepartment::where('id', $hospital->id)->first()->id,
                'hospital_pincode'          => $hospital->pincode,
                'associate_partner_id'      => $hospital->linked_associate_partner_id,
                'email'                     => $faker->unique()->safeEmail(),
                'phone'                     => $faker->numerify('9#########'),
                'code'                      => '011',
                'landline'                  => $faker->numerify('272#######'),
                'referred_by'               => 'BHC Direct',
                'referral_name'             => 'BHC',
                'admitted_by'               => 'Father',
                'admitted_by_title'         => $faker->randomElement(['Mr.', 'Ms.']),
                'admitted_by_firstname'     => $faker->firstname,
                'admitted_by_middlename'    => $faker->lastname,
                'admitted_by_lastname'      => $faker->lastname,
                'comments'                  => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}

