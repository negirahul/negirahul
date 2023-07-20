<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RetailPolicy extends Model
{
    use HasFactory;

    protected $fillable =[
        'policy_name', 'plan_name'
    ];
}
