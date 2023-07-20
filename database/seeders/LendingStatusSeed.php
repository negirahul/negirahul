<?php

namespace Database\Seeders;

use App\Models\Borrower;
use App\Models\Claimant;
use App\Models\LendingStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator;
class LendingStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $borrowers  = Borrower::get();
        $faker      = app(Generator::class);
        foreach ($borrowers as $borrower) {
            $claimant = Claimant::find($borrower->claimant_id);
            LendingStatus::create([
                'claimant_id' => $borrower->claimant_id,
                'borrower_id' => $borrower->id,
                'patient_id' => $borrower->patient_id,
                'claim_id' => $borrower->claim_id,
                'medical_lending_type' => $faker->randomElement(['Bridge', 'Term']),
                'vendor_partner_name_nbfc_or_bank' => $faker->randomElement(['NBFC', 'Bank']),
                'vendor_partner_id' => $faker->numerify('#4##5'),
                'loan_application_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'date_of_loan_application' => Carbon::now()->subMonths(2)->format('d-m-Y'),
                'time_of_loan_application' => Carbon::now()->subMonths(2)->format('H:i:s'),
                'date_of_loan_re_application'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'time_of_loan_re_application'=> Carbon::now()->subMonths(2)->format('H:i:s'),
                'loan_id_or_no'=> $faker->numerify('#4##5'),
                'loan_status' => $faker->randomElement( ['Waiting for the Approval', 'Approved', 'Rejected', 'Re-applied']),
                'loan_approved_amount'=> $faker->numerify('#1##5'),
                'loan_disbursed_amount'=> $faker->numerify('#2##5'),
                'date_of_loan_disbursement'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'loan_tenure'=> $faker->numerify('##'),
                'loan_instalments'=> $faker->numerify('##'),
                'loan_start_date' => Carbon::now()->subMonths(2)->format('d-m-Y'),
                'loan_end_date'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'insurance_claim_settlement_date'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'insurance_claim_settled_amount'=> $faker->numerify('#2##5'),
                'insurance_claim_amount_disbursement_date'=> Carbon::now()->subMonths(2)->format('d-m-Y'),
                'loan_application_status_comments'=> $faker->realText($maxNbChars = 200, $indexSize = 2),
                're_apply_loan_amount'=> $faker->numerify('#1##5'),
                'loan_re_application_status_comments' => $faker->realText($maxNbChars = 200, $indexSize = 2),
            ]);
        }
    }
}
