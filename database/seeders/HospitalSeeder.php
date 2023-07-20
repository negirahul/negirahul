<?php

namespace Database\Seeders;

use App\Models\AssociatePartner;
use App\Models\Hospital;
use App\Models\HospitalDepartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HospitalSeeder extends Seeder
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

            $partner    = AssociatePartner::inRandomOrder()->first();
            $linked     = User::inRandomOrder()->first();
            $assigned   = User::inRandomOrder()->first();
            $onboarding = $faker->randomElement(['Tie Up', 'Non - Tie Up']);
            $by         = $faker->randomElement(['Direct', 'Associate Partner']);

            Hospital::create([
                'uid'                           => 'HSP'.$i,
                'name'                          => $i == 1 ? 'Triveni Hospital' : $faker->company,
                'onboarding'                    => $onboarding,
                'by'                            => $by,
                'address'                       => $faker->address,
                'city'                          => $faker->city,
                'state'                         => $faker->state,
                'pincode'                       => 110009,
                'firstname'                     => $faker->firstname(),
                'lastname'                      => $faker->lastname(),
                'pan'                           => 'CCZPP'.$faker->numerify('####').'B',
                'email'                         => $i == 1 ? 'hospital@claimstack.com' : $faker->unique()->safeEmail(),
                'password'                      => Hash::make('password'),
                'code'                          => '011',
                'landline'                      => $faker->numerify('2##8#####5'),
                'phone'                         => $faker->numerify('9#########'),
                'rohini'                        => Str::upper(Str::random(13)),
                'linked_associate_partner'      => $by == 'Direct' ? Null : $partner->id,
                'linked_associate_partner_id'   => $by == 'Direct' ? Null : $partner->associate_partner_id,
                'assigned_employee_department'  => $assigned->department,
                'assigned_employee'             => $assigned->id,
                'assigned_employee_id'          => $assigned->employee_code,
                'linked_employee_department'    => $linked->department,
                'linked_employee'               => $linked->id,
                'linked_employee_id'            => $linked->employee_code,
                'tan'                           => Str::upper(Str::random(10)),
                'gst'                           => Str::upper(Str::random(15)),
                'owner_email'                   => $faker->unique()->safeEmail(),
                'owner_phone'                   => $faker->numerify('89########'),
                'contact_person_firstname'      => $faker->firstname,
                'contact_person_lastname'       => $faker->lastname,
                'contact_person_email'          => $faker->unique()->safeEmail(),
                'contact_person_phone'          => $faker->numerify('78########'),
                'registration_no'               => Str::upper(Str::random(20)),
                'medical_superintendent_firstname'      => $faker->firstname,
                'medical_superintendent_lastname'       => $faker->lastname,
                'medical_superintendent_email'          => $faker->unique()->safeEmail(),
                'medical_superintendent_registration_no'=> Str::upper(Str::random(20)),
                'medical_superintendent_qualification'  => 'Masters Degree',
                'medical_superintendent_mobile'         => $faker->numerify('78########'),
                'pollution_clearance_certificate'       => 'No',
                'fire_safety_clearance_certificate'     => 'No',
                'certificate_of_incorporation'          => 'No',
                'bank_name'                             =>  $faker->randomElement(['Punjab National Bank', 'State Bank of India', 'Axis Bank', 'HDFC Bank', 'ICICI Bank']),
                'bank_account_no'                       =>  $faker->numerify('4#7###8###0#'),
                'bank_ifs_code'                         => 'IFSC'.$faker->numerify('9###2##'),
                'cancel_cheque'                         => 'No',
                'tariff_list_soc'                       => 'No',
                'nabh_registration_no'                  => Str::upper(Str::random(15)),
                'nabl_registration_no'                  => Str::upper(Str::random(15)),
                'signed_mous'                           => 'No',
                'other_documents'                       => 'No',
                'hrms_software'                         => 'No',
                'iso_status'                            => 'No',
                'comments'                              => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }

        $hospitals = Hospital::get();
        foreach($hospitals as $hospital){
            HospitalDepartment::create([
                'hospital_id' => $hospital->id,
                'specialization' => $faker->randomElement(['ENT', 'Dental', 'Neonatology', 'Cardiac', 'Ophthalmology']),
                'doctors_firstname' =>$faker->firstname(),
                'doctors_lastname' =>$faker->lastname(),
                'registration_no' => Str::upper(Str::random(15)),
                'email_id' => $faker->unique()->safeEmail(),
                'doctors_mobile_no' => $faker->numerify('9#######8#')          
            ]);
        }
    }
}
