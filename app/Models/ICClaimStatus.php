<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICClaimStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'claimant_id',
        'patient_id',
        'patient_name',
        'hospital_id',
        'hospital_name',
        'associate_partner_name',
        'insurance_co_name',
        'policy_no',
        'tpa_name',
        'tpa_card_no',
        'claim_intimation_no',
        'date_receiving_main_claim_documents',
        'date_dispatching_main_claim_documents_to_ic_or_tpa',
        'date_receiving_pre_claim_documents',
        'date_dispatching_pre_claim_documents_to_ic_or_tpa',
        'date_receiving_post_claim_documents',
        'date_dispatching_post_claim_documents_to_ic_or_tpa',
        'date_receiving_query1_documents',
        'date_dispatching_query1_documents_to_ic_or_tpa',
        'date_receiving_query2_documents',
        'date_dispatching_query2_documents_to_ic_or_tpa',
        'date_receiving_query3_documents',
        'date_dispatching_query3_documents_to_ic_or_tpa',
        'date_settlement',
        'settled_amount',
        'date_disbursement',
        'ic_claim_status_comments',
    ];
}
