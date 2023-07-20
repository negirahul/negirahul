<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'hospital_pan_card',
        'hospital_cancel_cheque',
        'hospital_owners_pan_card',
        'hospital_owners_aadhar_card',
        'hospital_other_documents',
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
        'digital_x_ray',
        'ct',
        'mri',
        'pet_scan',
        'organ_transplant_unit',
        'burn_unit',
        'dialysis_unit',
        'blood_banks',
        'other',
        'hospital_registration_certificate',
        'hospital_rohini_certificate',
        'hospital_pollution_clearance_certificate',
        'hospital_fire_safety_clearance_certificate',
        'hospital_certificate_of_incorporation',
        'hospital_certificate_of_incorporation',
        'hospital_tan_certificate',
        'hospital_gst_certificate',
        'nabl_certificate',
        'nabh_certificate',
        'jci_certificate',
        'nqac_or_nhsrc_certificate',
        'hippa_certificate',
        'iso_certificates',
        'other_certificates',
        'medical_superintendents_registration_certificate',
        'doctors_registration_certificate_other',
        'mou_with_bhc',
        'mous_with_nbfcs_banks_triparty',
        'mous_ic_or_tpa_or_govt_or_psu_or_other_corporates',
        'agreed_tariff_and_packages',
        'other_packages',
    ];
}
