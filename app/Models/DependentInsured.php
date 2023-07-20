<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependentInsured extends Model
{
    use HasFactory;

   protected $fillable = [
    'firstname',
    'lastname',
    'gender',
    'age',
    'relation',
    'sum_insured',
    'cumulative_bonus',
    'balance_sum_insured',
    'comment',
    'insurance_policy_id'
   ];
}
