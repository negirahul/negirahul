<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DischargeStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'claimant_id',
        'hospital_id',
        'patient_id',
        'claim_id',
        'injury_reason',
        'injury_due_to_substance_abuse_alcohol_consumption',
        'injury_due_to_substance_abuse_alcohol_consumption_file',
        'if_medico_legal_case_mlc',
        'reported_to_police',
        'mlc_report_and_police_fir_attached',
        'mlc_report_and_police_fir_attached_file',
        'fir_or_mlc_no',
        'not_reported_to_police_reason',
        'maternity_date_of_delivery',
        'maternity_gravida_status_g',
        'maternity_gravida_status_p',
        'maternity_gravida_status_l',
        'maternity_gravida_status_a',
        'premature_baby',
        'date_of_discharge',
        'time_of_discharge',
        'discharge_status',
        'death_summary',
        'death_summary_file',
        'discharge_status_comments',
    ];
}
