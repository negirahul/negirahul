<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment_part_one extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'balance_sum_insured',
        'co_payment',
        'sub_limit',
        'no_claim_bonus',
        'effective_coverage',
        'buffer_limit',
        'eligible_icu_ccu_rent',
        'eligible_room',
        'patient_signature',
        'patient_signature_date',
        'relation_with_patient',
        'officer_signature',
        'officer_signature_date'
    ];
}
