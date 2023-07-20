<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'pharmacy',
        'lab',
        'ambulance',
        'operation_theatre',
        'icu',
        'iccu',
        'nicu',
        'csc_sterilization',
        'centralized_gas_ons',
        'centralized_ac',
        'kitchen',
        'usg_machine',
        'digital_xray',
        'ct',
        'mri',
        'pet_scan',
        'organ_transplant_unit',
        'burn_unit',
        'dialysis_unit',
        'blood_bank',
        'hospital_facility_comments'
    ];
}
