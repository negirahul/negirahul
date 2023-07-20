<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Patient extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'firstname',
        'middlename',
        'lastname',
        'dob',
        'age',
        'gender',
        'occupation',
        'specify',
        'patient_current_address',
        'patient_current_city',
        'patient_current_state',
        'patient_current_pincode',
        'current_permanent_address_same',
        'patient_permanent_address',
        'patient_permanent_city',
        'patient_permanent_state',
        'patient_permanent_pincode',
        'id_proof',
        'hospital_id',
        'hospital_name',
        'hospital_address',
        'hospital_city',
        'hospital_state',
        'registration_number',
        'treating_doctor',
        'hospital_pincode',
        'associate_partner_id',
        'email',
        'phone',
        'code',
        'landline',
        'referred_by',
        'referral_name',
        'admitted_by',
        'admitted_by_title',
        'admitted_by_firstname',
        'admitted_by_middlename',
        'admitted_by_lastname',
        'comments'
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class, 'patient_id');
    }
}
