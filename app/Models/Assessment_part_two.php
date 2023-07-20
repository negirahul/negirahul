<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment_part_two extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'present_ailment_duration',
        'pastHitory',
        'Diabetes',
        'DiabetesDate',
        'HTN',
        'HTNDate',
        'Alcohol',
        'AlcoholDate',
        'Smoking',
        'SmokingDate',
        'Drug',
        'DrugDate',
        'Heart',
        'HeartDate',
        'Kidney',
        'KidneyDate',
        'Liver',
        'LiverDate',
        'Arthritis',
        'ArthritisDate',
        'Neuro',
        'NeuroDate',
        'Hear',
        'HearDate',
        'Hypertension',
        'HypertensionDate',
        'Hyperlipidaemias',
        'HyperlipidaemiasDate',
        'Osteoarthritis',
        'OsteoarthritisDate',
        'Asthma',
        'AsthmaDate',
        'Cancer',
        'CancerDate',
        'HIV',
        'HIVDate',
        'Any_other_ailment',
        'Any_other_ailment_Date',
        'patient_signature',
        'patient_signature_date',
        'relation_with_patient',
        'officer_signature',
        'officer_signature_date',
    ];
}
