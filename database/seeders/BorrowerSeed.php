<?php

namespace Database\Seeders;

use App\Models\Borrower;
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

class BorrowerSeed extends Seeder
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
            Borrower::create([
                'patient_id'        => $claimant->patient_id,
                'claim_id'          => $claimant->claim_id,
                'claimant_id'       => $claimant->id,
                'hospital_id'       => $claimant->hospital_id,
                'is_patient_and_borrower_same' => "Yes",
                'is_claimant_and_borrower_same' => "No",
                'borrower_title'     => $claimant->patient->title,
                'borrower_firstname' => $claimant->patient->firstname,
                'borrower_middlename' => $claimant->patient->middlename,
                'borrower_lastname'  => $claimant->patient->lastname,
                'borrowers_relation_with_patient' => 'Self',
                'gender'             => "M",
                'bank_statement'     => "No",
                'itr'                => "No",
                'borrower_personal_email_id' => $claimant->personal_email_id,
                'borrower_official_email_id' => $claimant->official_email_id,
                'borrower_address'            => $claimant->patient->patient_current_address,
                'borrower_city'               => $claimant->patient->patient_current_city,
                'borrower_state'              => $claimant->patient->patient_current_state,
                'borrower_pincode'            => $claimant->patient->patient_current_pincode,
                'borrower_id_proof'           => $claimant->patient->id_proof,
                'nature_of_income'            => $faker->randomElement(['Salaried', 'Self Employed']),
                'organization'                => $faker->company,
                'member_or_employer_id'       => $faker->numerify('#012#######9'),
                'borrower_dob'                => $claimant->patient->dob,
                'borrower_mobile_no'          => $claimant->mobile_no,
                'borrower_pan_no'             => $claimant->pan_no,
                'borrower_aadhar_no'          => $claimant->aadhar_no,
                'borrower_cancel_cheque'      => $claimant->cancel_cheque,
                'borrower_bank_name'            => $claimant->bank_name,
                'borrower_bank_address'         => $claimant->bank_address,
                'borrower_estimated_amount'     => $claimant->estimated_amount,
                'co_borrower_nominee_name'      => $faker->randomElement(['Self', 'Relations']),
                'co_borrower_nominee_dob'       => Carbon::now()->subYears(45)->format('d-m-Y'),
                'co_borrower_nominee_gender'    => "M",
                'co_borrower_nominee_relation'  => "Father",
                'co_borrower_other_documents'   => "No",
                'borrower_ac_no'                => $claimant->ac_no,
                'borrower_ifs_code'             => $claimant->ifs_code,
                'co_borrower_comments'          => $faker->realText($maxNbChars = 200, $indexSize = 2),

            ]);
        }

        $borrowers = Borrower::get(['id', 'borrower_pan_no']);
        foreach ($borrowers as $partner) {
            Borrower::where('id', $partner->id)->update([
                'uid'      => 'BRO' . substr($partner->borrower_pan_no, 0, 2) . substr($partner->borrower_pan_no, -3)
            ]);
        }
    }
}
