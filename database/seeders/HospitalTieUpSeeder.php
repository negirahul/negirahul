<?php

namespace Database\Seeders;

use App\Models\AssociatePartner;
use App\Models\HospitalTieUp;
use App\Models\Hospital;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class HospitalTieUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);
        $hospitals = Hospital::get();
        foreach ($hospitals as $hospital) {
            HospitalTieUp::create([
                'hospital_id' => $hospital->id,
                'mou_inception_date' => Null,
                'bhc_packages_for_surgical_procedures_accepted' => 'No',
                'discount_on_medical_management_cases'  => 'No',
                'discount_on_final_bill' => 5,
                'discount_on_room_rent' => 6,
                'discount_on_medicines' => 7,
                'discount_on_consumables' => 8,
                'referral_commission_offered' => 'No',
                'referral' => 9,
                'claimstag_usage_services' => 'Monthly',
                'claimstag_installation_charges' => 100,
                'claimstag_usage_charges' => 150,
                'claims_reimbursement_insured_services' => 'Quarterly',
                'claims_reimbursement_insured_service_charges' => 510,
                'cashless_claims_management_services' => 'Half Yearly',
                'cashless_claims_management_services_charges' => 402,
                'medical_lending_for_patients' => $faker->randomElement(['Yes', 'No']),
                'medical_lending_service_type' => $faker->randomElement(['Bridge', 'Term', 'Both']),
                'subvention' => $faker->randomNumber(2),
                'medical_lending_for_bill_invoice_discounting' => $faker->randomElement(['Yes', 'No']),
                'comments_on_invoice_discounting' => $faker->numerify('2##8#####'),
                'lending_finance_company_agreement' => $faker->numerify('2##8#####'),
                'lending_finance_company_agreement_date' => $faker->numerify('2##8#####'),
                'hospital_management_system_installation' => $faker->randomElement(['Yes', 'No']),
                'hms_services' => $faker->randomElement(['Monthly', 'Half Yearly', 'Quarterly', 'Yearly', 'Pre Use', 'No']),
                'hms_charges' => $faker->randomNumber(2),
                'comments' => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }
    }
}
