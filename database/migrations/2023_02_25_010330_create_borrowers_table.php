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
        Schema::create('borrowers', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('claimant_id')->nullable();
            $table->string('hospital_id')->nullable();
            $table->enum('is_patient_and_borrower_same',['Yes', 'No'])->nullable();
            $table->enum('is_claimant_and_borrower_same',['Yes', 'No'])->nullable();
            $table->string('borrower_title')->nullable();
            $table->string('borrower_firstname')->nullable();
            $table->string('borrower_middlename')->nullable();
            $table->string('borrower_lastname')->nullable();
            $table->string('borrower_id_proof_file')->nullable();
            $table->string('borrower_pan_no_file')->nullable();
            $table->string('borrower_aadhar_no_file')->nullable();
            $table->string('bank_statement_file')->nullable();
            $table->string('itr_file')->nullable();
            $table->string('borrower_cancel_cheque_file')->nullable();
            $table->string('co_borrower_nominee_dob_file')->nullable();
            $table->string('co_borrower_nominee_gender_file')->nullable();
            $table->string('co_borrower_other_documents_file')->nullable();
            $table->enum('borrowers_relation_with_patient', ['Self', 'Husband', 'Wife', 'Son', 'Daughter', 'Father', 'Mother', 'Other'])->nullable();
            $table->string('borrower_dob')->nullable();
            $table->enum('gender', ['M', 'F', 'Other'])->nullable();
            $table->string('borrower_address')->nullable();
            $table->string('borrower_city')->nullable();
            $table->string('borrower_state')->nullable();
            $table->string('borrower_pincode')->nullable();
            $table->string('borrower_id_proof')->nullable();
            $table->string('nature_of_income')->nullable();
            $table->string('organization')->nullable();
            $table->string('member_or_employer_id')->nullable();
            $table->string('member_or_employer_id_file')->nullable();
            $table->string('borrower_personal_email_id')->nullable();
            $table->string('borrower_official_email_id')->nullable();
            $table->string('borrower_mobile_no')->nullable();
            $table->string('borrower_pan_no')->nullable();
            $table->string('borrower_aadhar_no')->nullable();
            $table->enum('bank_statement', ['Yes', 'No'])->nullable();
            $table->enum('itr', ['Yes', 'No'])->nullable();
            $table->enum('borrower_cancel_cheque', ['Yes', 'No'])->nullable();
            $table->string('borrower_bank_name')->nullable();
            $table->string('borrower_bank_address')->nullable();
            $table->string('borrower_ac_no')->nullable();
            $table->string('borrower_ifs_code')->nullable();
            $table->string('co_borrower_nominee_name')->nullable();
            $table->string('co_borrower_nominee_dob')->nullable();
            $table->enum('co_borrower_nominee_gender', ['M', 'F', 'Other'])->nullable();
            $table->enum('co_borrower_nominee_relation', ['Husband', 'Wife', 'Son', 'Daughter', 'Father', 'Mother', 'Other'])->nullable();
            $table->string('co_borrower_other_documents')->nullable();
            $table->string('borrower_estimated_amount')->nullable();
            $table->string('co_borrower_comments')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1)->nullable();
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
        Schema::dropIfExists('borrowers');
    }
};
