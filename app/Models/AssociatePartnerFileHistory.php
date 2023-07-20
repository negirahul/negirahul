<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatePartnerFileHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'associate_partner_id',
        'file_name',
        'file_path',
        'file_id',
    ];
}
