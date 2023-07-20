<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalTieUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'mou_inception_date', 
        'bhc_packages_for_surgical_procedures_accepted', 
        'discount_on_medical_management_cases', 
        'discount_on_final_bill', 
        'discount_on_room_rent', 
        'discount_on_medicines', 
        'discount_on_consumables', 
        'referral_commission_offered', 
        'referral', 
        'agreed_for', 
        'claimstag_usage_services', 
        'claimstag_installation_charges', 
        'claimstag_usage_charges', 
        'claims_reimbursement_insured_services', 
        'claims_reimbursement_insured_service_charges', 
        'cashless_claims_management_services', 
        'cashless_claims_management_services_charges', 
        'medical_lending_for_patients', 
        'medical_lending_service_type', 
        'subvention', 
        'medical_lending_for_bill_invoice_discounting', 
        'comments_on_invoice_discounting', 
        'lending_finance_company_agreement', 
        'lending_finance_company_agreement_date', 
        'hms_services', 
        'hospital_management_system_installation', 
        'hms_charges', 
        'comments',
        'status'
    ];


    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
}
