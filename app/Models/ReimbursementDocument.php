<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'patient_title',
        'patient_firstname',
        'patient_middlename',
        'patient_lastname',
        'patient_id_proof_file',
        'doctor_prescriptions_or_consultation_papers_file',
        'insurance_policy_copy_file',
        'tpa_card_file',
        'employee_or_member_id_group_file',
        'photograph_of_the_patient_file',
        'indoor_care_paper_file',
        'ecg_report_file',
        'ct_mri_usg_hpe_investigation_report_file',
        'diagnostic_or_investigation_reports_file',
        'doctor’s_reference_slip_for_investigation_file',
        'operation_theatre_notes_file',
        'pharmacy_bills_file',
        'implant_sticker_invoice_file',
        'hospital_break_up_bills_file',
        'hospital_main_final_bill_file',
        'discharge_or_day_care_summary_file',
        'death_summary_from_hospital_where_applicable_file',
        'payment_receipts_of_the_hospital_file',
        'other_documents_file',
        'claimant_pan_card_file',
        'claimant_aadhar_card_file',
        'claimant_current_address_proof_file',
        'claimant_cancel_cheque_file',
        'abha_id_proof_file',
        'mlc_report_and_police_fir_document_file',
        'borrower_current_address_proof_file',
        'borrower_pan_card_file',
        'borrower_aadhar_card_file',
        'borrower_bank_statement_3_months_file',
        'borrower_itr_income_tax_return_file',
        'bhc_assessment_formsi_and_ii_signed_stamped_file',
        'borrower_cancel_cheque_file',
        'borrower_other_documents_file',
        'co_borrower_current_address_proof_file',
        'insurance_co_tpa_claim_form_signed_and_stamped_file',
        'co_borrower_pan_card_file',
        'co_borrower_aadhar_card_file',
        'co_borrower_bank_statement_3_months_file',
        'co_borrower_itr_income_tax_return_file',
        'co_borrower_cancel_cheque_file',
        'co_borrower_other_documents_file',
        'claim_intimation_documents',
        'claim_other_documents_file',
        'settllement_letter_file',
        'insurance_other_documents_file',
        'loan_approval_letter_file',
        'loan_disbursement_letter_file',
    ];
}
