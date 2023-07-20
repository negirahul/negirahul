<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalInfrastructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'city_category',
        'hospital_type',
        'hospital_category',
        'no_of_beds',
        'no_of_ots',
        'no_of_modular_ots',
        'no_of_icus',
        'no_of_iccus',
        'no_of_nicus',
        'no_of_rmos',
        'no_of_nurses',
        'nabl_approved_lab',
        'nabl_approved_lab_file',
        'nabh_status_file',
        'jci_status_file',
        'nqac_nhsrc_status_file',
        'hippa_status_file',
        'no_of_dialysis_units',
        'no_ambulance_normal',
        'no_ambulance_acls',
        'nabh_status',
        'hospital_infrastructure_comments',
        'jci_status',
        'nqac_nhsrc_status',
        'hippa_status',
        'comments',
    ];
}
