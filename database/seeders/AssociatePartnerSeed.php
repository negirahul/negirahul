<?php

namespace Database\Seeders;

use App\Models\AssociatePartner;
use App\Models\SalesServiceType;
use App\Models\User;
use App\Models\VendorServiceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class AssociatePartnerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);
        $user  = User::inRandomOrder()->first();
        for ($i = 1; $i < 21; $i++) {
            $type =  $faker->randomElement(['vendor', 'sales']);
            AssociatePartner::create([
                'name' =>  $faker->company,
                'type' => $type,
                'pan' => 'CCZPP'.$faker->numerify('####').'B',
                'owner_firstname' => $faker->firstname(),
                'owner_lastname' => $faker->lastname(),
                'email' => $i == 1 ? 'associate@claimstack.com' : $faker->unique()->safeEmail(),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'pincode' => 110009,
                'phone' => $faker->numerify('9#########'),
                'reference' => 'Refereed By Admin',
                'status' => $type == 'sales' ? $faker->randomElement(['Sub AP', 'Main', 'Agency']) : 'Main',
                'assigned_employee_department' => $user->department,
                'assigned_employee' => $user->id,
                'assigned_employee_id' => $user->employee_code,
                'linked_employee_department' => $user->department,
                'linked_employee' => $user->id,
                'linked_employee_id' => $user->employee_code,
                'mou' => $faker->randomElement(['yes', 'no']),
                'agreement_start_date' => Carbon::now()->format('Y-m-d'),
                'agreement_end_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'contact_person' => $faker->name(),
                'contact_person_phone' => $faker->numerify('9#########'),
                'contact_person_email' => $faker->unique()->safeEmail(),
                'bank_name' =>  $faker->randomElement(['Punjab National Bank', 'State Bank of India', 'Axis Bank', 'HDFC Bank', 'ICICI Bank']),
                'bank_address' => $faker->address,
                'bank_account_no' => $faker->numerify('4#7###8###0#'),
                'bank_ifs_code' => 'IFSC'.$faker->numerify('9###2##'),
                'cancel_cheque' => $faker->randomElement(['Yes', 'No']),
                'comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password')

            ]);
        }
        $associate_partners = AssociatePartner::get(['id', 'pan', 'type']);
        foreach ($associate_partners as $partner) {
            AssociatePartner::where('id', $partner->id)->update([
                'associate_partner_id' => 'AP' . substr($partner->pan, 0, 2) . substr($partner->pan, -3)
            ]);

            if ($partner->type == 'vendor') {
                VendorServiceType::create([
                    'associate_partner_id' => $partner->id,
                    'cashless_claims_management' => $faker->randomElement(['yes', 'no']),
                    'cashless_claims_management_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'cashless_helpdesk' => $faker->randomElement(['yes', 'no']),
                    'cashless_helpdesk_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'claims_assessment' => $faker->randomElement(['yes', 'no']),
                    'claims_assessment_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'claims_bill_entry' => $faker->randomElement(['yes', 'no']),
                    'claims_bill_entry_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'claims_reimbursement' => $faker->randomElement(['yes', 'no']),
                    'claims_reimbursement_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'doctor_claim_process' => $faker->randomElement(['yes', 'no']),
                    'doctor_claim_process_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'doctor_honorary_panel' => $faker->randomElement(['yes', 'no']),
                    'doctor_honorary_panel_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'doctor_tele_consultation' => $faker->randomElement(['yes', 'no']),
                    'doctor_tele_consultation_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'insurance_tpa_coordination' => $faker->randomElement(['yes', 'no']),
                    'insurance_tpa_coordination_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'medical_lending_bill' => $faker->randomElement(['yes', 'no']),
                    'medical_lending_bill_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'medical_lending_patient' => $faker->randomElement(['yes', 'no']),
                    'medical_lending_patient_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'others' => $faker->randomElement(['yes', 'no']),
                    'others_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'vendor_partner_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                ]);
            } else {
                SalesServiceType::create([
                    'associate_partner_id' => $partner->id,
                    'consulting' => $faker->randomElement(['yes', 'no']),
                    'consulting_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'dealer_distributor' => $faker->randomElement(['yes', 'no']),
                    'dealer_distributor_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'hospital_empanelment_agent' => $faker->randomElement(['yes', 'no']),
                    'hospital_empanelment_agent_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'software_sales' => $faker->randomElement(['yes', 'no']),
                    'software_sales_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'others' => $faker->randomElement(['yes', 'no']),
                    'others_charge' => $faker->randomElement(['2000', '3000', '4000', '5000', '6000', '7000']),
                    'sales_partner_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                ]);
            }
        }

        foreach ($associate_partners as $partner) {
            $part  = AssociatePartner::where('status', 'Main')->where('type', 'sales')->inRandomOrder()->first();
            AssociatePartner::where('id', $partner->id)->where('type', 'sales')->whereIn('status', ['Sub AP', 'Agency'])->update([
                'linked_associate_partner' => $part->id,
                'linked_associate_partner_id' => $part->associate_partner_id
            ]);
        }
    }
}
