<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentReimbursementFileHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'file_name',
        'file_path',
        'file_id',
    ];
}
