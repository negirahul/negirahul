<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\Claimant\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Claimant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'email',
        'password',
        'patient_id',
        'claim_id',
        'associate_partner_id',
        'hospital_id',       
        'policy_type',
        'group_name',
        'employee_id_or_member_id',
        'are_patient_and_claimant_same',
        'title',
        'firstname',
        'middlename',
        'lastname',
        'pan_no',
        'pan_no_file',
        'aadhar_no',
        'aadhar_no_file',
        'patients_relation_with_claimant',
        'specify',
        'address',
        'city',
        'state',
        'pincode',
        'personal_email_id',
        'official_email_id',
        'mobile_no',
        'estimated_amount',
        'cancel_cheque',
        'cancel_cheque_file',
        'bank_name',
        'bank_address',
        'ac_no',
        'ifs_code',
        'status',
        'comments',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id', 'id');
    }

     public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
