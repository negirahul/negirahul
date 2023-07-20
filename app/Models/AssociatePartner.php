<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\Associate\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssociatePartner extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'associate_partner_id',
        'type',
        'pan',
        'panfile',
        'owner_firstname',
        'owner_lastname',
        'email',
        'address',
        'city',
        'state',
        'pincode',
        'password',
        'phone',
        'reference',
        'status',
        'linked_associate_partner',
        'linked_associate_partner_id',
        'assigned_employee_department',
        'assigned_employee',
        'assigned_employee_id',
        'linked_employee_department',
        'linked_employee',
        'linked_employee_id',
        'mou',
        'moufile',
        'agreement_start_date',
        'agreementfile',
        'agreement_end_date',
        'contact_person',
        'contact_person_phone',
        'contact_person_email',
        'bank_name',
        'bank_address',
        'bank_account_no',
        'bank_ifs_code',
        'cancel_cheque',
        'cancel_cheque_file',
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

    public function associate_partner()
    {
        return $this->hasMany(AssociatePartner::class, 'linked_associate_partner_id');
    }
}
