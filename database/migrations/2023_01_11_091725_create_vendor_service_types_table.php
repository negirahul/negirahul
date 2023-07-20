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
        Schema::create('vendor_service_types', function (Blueprint $table) {
            $table->id();
            $table->integer('associate_partner_id')->unsigned();
            $table->string('cashless_claims_management')->nullable();
            $table->string('cashless_claims_management_charge')->nullable();
            $table->longText('cashless_claims_management_comment')->nullable();
            $table->string('cashless_helpdesk')->nullable();
            $table->string('cashless_helpdesk_charge')->nullable();
            $table->longText('cashless_helpdesk_comment')->nullable();
            $table->string('claims_assessment')->nullable();
            $table->string('claims_assessment_charge')->nullable();
            $table->longText('claims_assessment_comment')->nullable();
            $table->string('claims_bill_entry')->nullable();
            $table->string('claims_bill_entry_charge')->nullable();
            $table->longText('claims_bill_entry_comment')->nullable();
            $table->string('claims_reimbursement')->nullable();
            $table->string('claims_reimbursement_charge')->nullable();
            $table->longText('claims_reimbursement_comment')->nullable();
            $table->string('doctor_claim_process')->nullable();
            $table->string('doctor_claim_process_charge')->nullable();
            $table->longText('doctor_claim_process_comment')->nullable();
            $table->string('doctor_honorary_panel')->nullable();
            $table->string('doctor_honorary_panel_charge')->nullable();
            $table->longText('doctor_honorary_panel_comment')->nullable();
            $table->string('doctor_tele_consultation')->nullable();
            $table->string('doctor_tele_consultation_charge')->nullable();
            $table->longText('doctor_tele_consultation_comment')->nullable();
            $table->string('insurance_tpa_coordination')->nullable();
            $table->string('insurance_tpa_coordination_charge')->nullable();
            $table->longText('insurance_tpa_coordination_comment')->nullable();
            $table->string('medical_lending_bill')->nullable();
            $table->string('medical_lending_bill_charge')->nullable();
            $table->longText('medical_lending_bill_comment')->nullable();
            $table->string('medical_lending_patient')->nullable();
            $table->string('medical_lending_patient_charge')->nullable();
            $table->longText('medical_lending_patient_comment')->nullable();
            $table->string('others')->nullable();
            $table->string('others_charge')->nullable();
            $table->longText('others_comment')->nullable();
            $table->longText('vendor_partner_comments')->nullable();
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
        Schema::dropIfExists('vendor_service_types');
    }
};
