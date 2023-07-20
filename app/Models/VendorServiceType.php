<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'associate_partner_id',
        'cashless_claims_management',
        'cashless_claims_management_charge',
        'cashless_claims_management_comment',
        'cashless_helpdesk',
        'cashless_helpdesk_charge',
        'cashless_helpdesk_comment',
        'claims_assessment',
        'claims_assessment_charge',
        'claims_assessment_comment',
        'claims_bill_entry',
        'claims_bill_entry_charge',
        'claims_bill_entry_comment',
        'claims_reimbursement',
        'claims_reimbursement_charge',
        'claims_reimbursement_comment',
        'doctor_claim_process',
        'doctor_claim_process_charge',
        'doctor_claim_process_comment',
        'doctor_honorary_panel',
        'doctor_honorary_panel_charge',
        'doctor_honorary_panel_comment',
        'doctor_tele_consultation',
        'doctor_tele_consultation_charge',
        'doctor_tele_consultation_comment',
        'insurance_tpa_coordination',
        'insurance_tpa_coordination_charge',
        'insurance_tpa_coordination_comment',
        'medical_lending_bill',
        'medical_lending_bill_charge',
        'medical_lending_bill_comment',
        'medical_lending_patient',
        'medical_lending_patient_charge',
        'medical_lending_patient_comment',
        'others',
        'others_charge',
        'others_comment',
        'vendor_partner_comments',
    ];
}
