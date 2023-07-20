<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentStatus extends Model
{
    use HasFactory;
    protected $fillable=[
        'patient_id',
        'claim_id',
        'claimant_id',
        'hospital_id',        
        'hospital_on_the_panel_of_insurance_co',
        'hospital_id_insurance_co',
        'pre_assessment_status',
        'query_pre_assessment',
        'pre_assessment_amount',
        'pre_assessment_suspected_fraud',
        'pre_assessment_status_comments',
        'final_assessment_status',
        'query_final_assessment',
        'final_assessment_amount',
        'final_assessment_suspected_fraud',
        'final_assessment_status_comments',

    ];
}
