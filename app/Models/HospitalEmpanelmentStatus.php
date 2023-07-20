<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalEmpanelmentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_id',
        'tpa_id',
        'company_type',
        'empanelled',
        'empanelled_file',
        'hospital_id_as_per_the_selected_company',
        'signed_mou',
        'signed_mou_file',
        'agreed_packages_and_tariff_pdf_other_images',
        'upload_packages_and_tariff_excel_or_csv',
        'upload_packages_and_tariff_excel_or_csv_file',
        'agreed_packages_and_tariff_pdf_other_images_file',
        'negative_listing_status',
        'negative_listing_status_file',
        'hospital_empanelment_status_comments',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Tpa::class, 'tpa_id');
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');
    }
    
}
