<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'specialization',
        'doctors_firstname',
        'doctors_lastname',
        'registration_no',
        'email_id',
        'doctors_mobile_no',
        'upload',
    ];
}
