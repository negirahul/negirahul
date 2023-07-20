<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'uid',
        'patient_id',
        'hospital_id',
        'admission_date',
        'admission_time',
        'abha_id',
        'insurance_coverage',
        'policy_no',
        'company_tpa_id_card_no',
        'lending_required',
        'hospitalization_due_to',
        'date_of_delivery',
        'system_of_medicine',
        'treatment_type',
        'admission_type_1',
        'admission_type_2',
        'admission_type_3',
        'claim_category',
        'treatment_category',
        'disease_category',
        'disease_name',
        'disease_type',
        'estimated_amount',
        'comments',
        'claim_intimation_done',
        'claim_intimation_number_mail',
        'discharge_date',
        'days_in_hospital',
        'room_category',
        'consultation_date',
        'nature_of_illness',
        'clinical_finding',
        'chronic_illness',
        'ailment_details',
        'has_family_physician',
        'family_physician',
        'family_physician_contact_no',
        'assign_to',
        'assigned_at',
        're_assign_to',
        're_assigned_at',
        'assign_to_claim_processing',
        'assigned_at_claim_processing',
        're_assign_to_claim_processing',
        're_assigned_at_claim_processing',
        'assign_to_assessment',
        'assigned_at_assessment',
        're_assign_to_assessment',
        're_assigned_at_assessment',
        'status',
        'claim_processing_status',
        'assessment_status',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function claimant()
    {
        return $this->hasOne(Claimant::class, 'id');
    }

    public function claimProcessing()
    {
        return $this->hasOne(ClaimProcessing::class, 'claim_id');
    }


    public function assessmentStatus()
    {
        return $this->hasOne(AssessmentStatus::class, 'claim_id');
    }

    public function dischargeStatus()
    {
        return $this->hasOne(DischargeStatus::class, 'claim_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }


    public function assignTo()
    {
        if(isset($this->re_assign_to) && !empty($this->re_assign_to)){
            return $this->belongsTo(Admin::class, 're_assign_to');
        }else{
            return $this->belongsTo(Admin::class, 'assign_to');

        }
    }

    public function assignToClaimProcessing()
    {
        if(isset($this->re_assign_to) && !empty($this->re_assign_to)){
            return $this->belongsTo(Admin::class, 're_assign_to_claim_processing');
        }else{
            return $this->belongsTo(Admin::class, 'assign_to_claim_processing');

        }
    }

    public function assignToAssessment()
    {
        if(isset($this->re_assign_to) && !empty($this->re_assign_to)){
            return $this->belongsTo(Admin::class, 're_assign_to_assessment');
        }else{
            return $this->belongsTo(Admin::class, 'assign_to_assessment');
        }
    }

    public function policy()
    {
        return $this->hasOne(InsurancePolicy::class, 'claim_id');
    }

    public function insurer()
    {
        return $this->hasOne(Insurer::class, 'id');
    }
}