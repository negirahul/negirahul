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
        Schema::create('final_assessments', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('claim_id')->nullable();
            $table->string('doctors_1st_consultation')->nullable();
            $table->string('doctors_1st_consultation_file')->nullable();
            $table->string('treatment_documents_prescriptions')->nullable();
            $table->string('treatment_documents_prescriptions_file')->nullable();
            $table->string('treatments_chart')->nullable();
            $table->string('treatments_chart_file')->nullable();
            $table->string('indoor_cash_paper')->nullable();
            $table->string('indoor_cash_paper_file')->nullable();
            $table->string('diagnostic_reports')->nullable();
            $table->string('diagnostic_reports_file')->nullable();
            $table->string('bills')->nullable();
            $table->string('bills_file')->nullable();
            $table->string('discharge_summary')->nullable();
            $table->string('discharge_summary_file')->nullable();
            $table->string('payment_receipts_of_the_hospital')->nullable();
            $table->string('payment_receipts_of_the_hospital_file')->nullable();
            $table->string('policy_copy')->nullable();
            $table->string('policy_copy_file')->nullable();
            $table->string('tpa_card')->nullable();
            $table->string('tpa_card_file')->nullable();
            $table->string('claimant_cancel_cheque')->nullable();
            $table->string('claimant_cancel_cheque_file')->nullable();
            $table->string('patient_id_proof')->nullable();
            $table->string('patient_id_proof_file')->nullable();
            $table->string('photograph_of_the_patient')->nullable();
            $table->string('photograph_of_the_patient_file')->nullable();
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
        Schema::dropIfExists('final_assessments');
    }
};
