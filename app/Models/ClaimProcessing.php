<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimProcessing extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'claimant_id',
        'claim_id',
        'primary_diagnosis_icd_leveli_disease',
        'primary_diagnosis_icd_leveli_code',
        'primary_diagnosis_icd_levelii_disease',
        'primary_diagnosis_icd_levelii_code',
        'primary_diagnosis_icd_leveliii_disease',
        'primary_diagnosis_icd_leveliii_code',
        'primary_diagnosis_icd_leveliv_disease',
        'primary_diagnosis_icd_leveliv_code',
        'additional_diagnosis_icd_leveli_disease',
        'additional_diagnosis_icd_leveli_code',
        'additional_diagnosis_icd_levelii_disease',
        'additional_diagnosis_icd_levelii_code',
        'additional_diagnosis_icd_leveliii_disease',
        'additional_diagnosis_icd_leveliii_code',
        'additional_diagnosis_icd_leveliv_disease',
        'additional_diagnosis_icd_leveliv_code',
        'co_morbidities_icd_leveli_disease',
        'co_morbidities_icd_leveli_code',
        'co_morbidities_icd_levelii_disease',
        'co_morbidities_icd_levelii_code',
        'co_morbidities_icd_leveliii_disease',
        'co_morbidities_icd_leveliii_code',
        'co_morbidities_icd_leveliv_disease',
        'co_morbidities_icd_leveliv_code',
        'co_morbidities_comments',
        'procedure_name',
        'procedure_i_pcs_group_name',
        'procedure_i_pcs_group_code',
        'procedure_i_pcs_sub_group_name',
        'procedure_i_pcs_sub_group_code',
        'procedure_i_pcs_short_name',
        'procedure_i_pcs_code',
        'procedure_i_pcs_long_name',
        'procedure_ii_pcs_group_name',
        'procedure_ii_pcs_group_code',
        'procedure_ii_pcs_sub_group_name',
        'procedure_ii_pcs_sub_group_code',
        'procedure_ii_pcs_short_name',
        'procedure_ii_pcs_code',
        'procedure_ii_pcs_long_name',
        'procedure_iii_pcs_group_name',
        'procedure_iii_pcs_group_code',
        'procedure_iii_pcs_sub_group_name',
        'procedure_iii_pcs_sub_group_code',
        'procedure_iii_pcs_short_name',
        'procedure_iii_pcs_code',
        'procedure_iii_pcs_long_name',
        'final_assessment_status',
        'processing_query',
        'final_assessment_amount',
        'final_assessment_comments',
    ];
}
