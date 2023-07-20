<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesServiceType extends Model
{
    use HasFactory;

    protected $fillable = [
       'associate_partner_id',
       'consulting',
       'consulting_charge',
       'consulting_comment',
       'dealer_distributor',
       'dealer_distributor_charge',
       'dealer_distributor_comment',
       'hospital_empanelment_agent',
       'hospital_empanelment_agent_charge',
       'hospital_empanelment_agent_comment',
       'software_sales',
       'software_sales_charge',
       'software_sales_comment',
       'others',
       'others_charge',
       'others_comment',
       'sales_partner_comments',
    ];
}
