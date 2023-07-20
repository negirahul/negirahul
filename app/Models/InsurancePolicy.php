<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsurancePolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'claim_id',
        'policy_no',
        'insurer_id',
        'policy_name',
        'policy_id',
        'certificate_no',
        'company_tpa_id_card_no',
        'tpa_name',
        'policy_type',
        'group_name',
        'previous_policy_no',
        'start_date',
        'expiry_date',
        'commencement_date',
        'title',
        'firstname',
        'middlename',
        'lastname',
        'is_primary_insured_and_patient_same',
        'primary_insured_address',
        'primary_insured_city',
        'primary_insured_state',
        'primary_insured_pincode',
        'no_of_person_insured',
        'basic_sum_insured',
        'cumulative_bonus_cv',
        'agent_broker_code',
        'agent_broker_name',
        'additional_policy',
        'policy_no_additional',
        'currently_covered',
        'commencement_date_other',
        'insurance_company_other',
        'policy_no_other',
        'sum_insured_other',
        'hospitalized',
        'admission_date_past',
        'diagnosis',
        'comments',
        'primary_insured_firstname',
        'primary_insured_lastname',
        'primary_insured_gender',
        'primary_insured_age',
        'primary_insured_relation',
        'primary_insured_sum_insured',
        'primary_insured_cumulative_bonus',
        'primary_insured_balance_sum_insured',
        'primary_insured_comment',
        'dependent_insured_firstname',
        'dependent_insured_lastname',
        'dependent_insured_gender',
        'dependent_insured_age',
        'dependent_insured_relation',
        'dependent_insured_sum_insured',
        'dependent_insured_cumulative_bonus',
        'dependent_insured_balance_sum_insured',
        'dependent_insured_comment',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}
