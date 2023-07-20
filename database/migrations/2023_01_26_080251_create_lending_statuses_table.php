<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lending_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('claimant_id')->nullable();
            $table->string('borrower_id')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->enum('medical_lending_type', ['Bridge', 'Term', 'Both'])->nullable();
            $table->string('vendor_partner_name_nbfc_or_bank')->nullable();
            $table->string('vendor_partner_id')->nullable();
            $table->string('loan_application_comments')->nullable();
            $table->string('date_of_loan_application')->nullable();
            $table->time('time_of_loan_application')->nullable();
            $table->string('date_of_loan_re_application')->nullable();
            $table->time('time_of_loan_re_application')->nullable();
            $table->string('loan_id_or_no')->nullable();
            $table->enum('loan_status', ['Waiting for the Approval', 'Approved', 'Rejected', 'Re-applied'])->nullable();
            $table->double('loan_approved_amount')->nullable();
            $table->double('loan_disbursed_amount')->nullable();
            $table->string('date_of_loan_disbursement')->nullable();
            $table->string('loan_tenure')->nullable();
            $table->string('loan_instalments')->nullable();
            $table->string('loan_start_date')->nullable();
            $table->string('loan_end_date')->nullable();
            $table->string('insurance_claim_settlement_date')->nullable();
            $table->double('insurance_claim_settled_amount')->nullable();
            $table->string('insurance_claim_amount_disbursement_date')->nullable();
            $table->text('loan_application_status_comments')->nullable();
            $table->double('re_apply_loan_amount')->nullable();
            $table->text('loan_re_application_status_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lending_statuses');
    }
};
