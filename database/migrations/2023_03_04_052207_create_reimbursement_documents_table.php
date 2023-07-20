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
        Schema::create('reimbursement_documents', function (Blueprint $table) {
            $table->id();

            $table->string('patient_id')->nullable();
            $table->string('patient_title')->nullable();
            $table->string('patient_firstname')->nullable();
            $table->string('patient_middlename')->nullable();
            $table->string('patient_lastname')->nullable();
            $table->string('patient_id_proof_file')->nullable();
            $table->string('doctor_prescriptions_or_consultation_papers_file')->nullable();
            $table->string('insurance_policy_copy_file')->nullable();
            $table->string('tpa_card_file')->nullable();
            $table->string('employee_or_member_id_group_file')->nullable();
            $table->string('photograph_of_the_patient_file')->nullable();
            $table->string('bhc_assessment_formsi_and_ii_signed_stamped_file')->nullable();
            $table->string('indoor_care_paper_file')->nullable();
            $table->string('ecg_report_file')->nullable();
            $table->string('ct_mri_usg_hpe_investigation_report_file')->nullable();
            $table->string('diagnostic_or_investigation_reports_file')->nullable();
            $table->string('doctor’s_reference_slip_for_investigation_file')->nullable();
            $table->string('operation_theatre_notes_file')->nullable();
            $table->string('pharmacy_bills_file')->nullable();
            $table->string('implant_sticker_invoice_file')->nullable();
            $table->string('hospital_break_up_bills_file')->nullable();
            $table->string('hospital_main_final_bill_file')->nullable();
            $table->string('discharge_or_day_care_summary_file')->nullable();
            $table->string('death_summary_from_hospital_where_applicable_file')->nullable();
            $table->string('payment_receipts_of_the_hospital_file')->nullable();
            $table->string('other_documents_file')->nullable();
            $table->string('claimant_pan_card_file')->nullable();
            $table->string('claimant_aadhar_card_file')->nullable();
            $table->string('claimant_current_address_proof_file')->nullable();
            $table->string('claimant_cancel_cheque_file')->nullable();
            $table->string('abha_id_proof_file')->nullable();
            $table->string('mlc_report_and_police_fir_document_file')->nullable();
            $table->string('insurance_co_tpa_claim_form_signed_and_stamped_file')->nullable();
            $table->string('borrower_current_address_proof_file')->nullable();
            $table->string('borrower_pan_card_file')->nullable();
            $table->string('borrower_aadhar_card_file')->nullable();
            $table->string('borrower_bank_statement_3_months_file')->nullable();
            $table->string('borrower_itr_income_tax_return_file')->nullable();
            $table->string('borrower_cancel_cheque_file')->nullable();
            $table->string('borrower_other_documents_file')->nullable();
            $table->string('co_borrower_current_address_proof_file')->nullable();
            $table->string('co_borrower_pan_card_file')->nullable();
            $table->string('co_borrower_aadhar_card_file')->nullable();
            $table->string('co_borrower_bank_statement_3_months_file')->nullable();
            $table->string('co_borrower_itr_income_tax_return_file')->nullable();
            $table->string('co_borrower_cancel_cheque_file')->nullable();
            $table->string('co_borrower_other_documents_file')->nullable();
            $table->string('loan_disbursement_letter_file')->nullable();
            $table->string('loan_approval_letter_file')->nullable();
            $table->string('insurance_other_documents_file')->nullable();
            $table->string('settllement_letter_file')->nullable();
            $table->string('claim_other_documents_file')->nullable();
            $table->string('claim_intimation_documents')->nullable();
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
        Schema::dropIfExists('reimbursement_documents');
    }
};
