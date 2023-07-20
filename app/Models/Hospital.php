<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\Hospital\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'uid',
        'name',
        'onboarding',
        'by',
        'hospital_by',
        'hms_hospital_id',
        'address',
        'city',
        'state',
        'pincode',
        'firstname',
        'lastname',
        'pan',
        'panfile',
        'email',
        'password',
        'code',
        'landline',
        'phone',
        'rohini',
        'rohinifile',
        'linked_employee_department',
        'linked_associate_partner',
        'linked_associate_partner_id',
        'assigned_employee_department',
        'assigned_employee',
        'assigned_employee_id',
        'linked_employee',
        'linked_employee_id',
        'tan',
        'gst',
        'gstfile',
        'owner_email',
        'owner_phone',
        'owner_pan',
        'owner_aadhar',
        'contact_person_firstname',
        'contact_person_lastname',
        'contact_person_email',
        'contact_person_phone',
        'registration_no',
        'medical_superintendent_firstname',
        'medical_superintendent_lastname',
        'medical_superintendent_email',
        'medical_superintendent_registration_no',
        'medical_superintendent_registration_no_file',
        'medical_superintendent_qualification',
        'medical_superintendent_mobile',
        'pollution_clearance_certificate',
        'fire_safety_clearance_certificate',
        'certificate_of_incorporation',
        'bank_name',
        'bank_account_no',
        'bank_ifs_code',
        'cancel_cheque',
        'cancel_cheque_file',
        'tariff_list_soc',
        'tariff_list_soc_file',
        'nabh_registration_no',
        'nabh_registration_file',
        'nabl_registration_no',
        'nabl_registration_file',
        'signed_mous',
        'signed_mous_file',
        'other_documents',
        'other_documents_file',
        'hrms_software',
        'iso_status',
        'status',
        'comments',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function associate_partner()
    {
        return $this->hasOne(AssociatePartner::class);
    }

    public function associate()
    {
        return $this->hasOne(AssociatePartner::class, 'associate_partner_id', 'linked_associate_partner_id');
    }

    public function assignedEmployee()
    {
        $user_exists  = User::where('id', $this->assigned_employee)->exists();
        if ($user_exists) {
            return $this->belongsTo(User::class, 'assigned_employee');
        }else{

            $admin_exists  = Admin::where('id', $this->assigned_employee)->exists();
            if ($admin_exists) {
                return $this->belongsTo(Admin::class, 'assigned_employee');
            }else{
                return Admin::first();
            }
        }
    }


    public function linkedEmployee()
    {
        $user_exists  = User::where('id', $this->linked_employee)->exists();
        if ($user_exists) {
            return $this->belongsTo(User::class, 'linked_employee');
        }else{

            $admin_exists  = Admin::where('id', $this->linked_employee)->exists();
            if ($admin_exists) {
                return $this->belongsTo(Admin::class, 'linked_employee');
            }else{
                return Admin::first();
            }
        }
    }

}
