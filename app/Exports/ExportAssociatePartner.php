<?php

namespace App\Exports;

use App\Models\AssociatePartner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportAssociatePartner implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AssociatePartner::latest('id')->select('id', 'name', 'associate_partner_id', 'type', 'pan', 'owner_firstname', 'owner_lastname', 'email', 'address', 'city', 'state', 'pincode', 'phone', 'reference', 'status', 'linked_associate_partner', 'linked_associate_partner_id', 'assigned_employee_department', 'assigned_employee', 'assigned_employee_id', 'linked_employee_department', 'linked_employee', 'linked_employee_id', 'mou', 'agreement_start_date', 'agreement_end_date', 'contact_person', 'contact_person_phone', 'contact_person_email', 'bank_name', 'bank_address', 'bank_account_no', 'bank_ifs_code', 'cancel_cheque', 'comments', DB::raw("DATE_FORMAT(associate_partners.created_at, '%d-%m-%Y %H:%i:%s')"))->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Associate Partner Id',
            'Type',
            'Pan',
            'Owner Firstname',
            'Owner Lastname',
            'Email',
            'Address',
            'City',
            'State',
            'Pincode',
            'Phone',
            'Reference',
            'Status',
            'Linked Associate Partner',
            'Linked Associate Partner Id',
            'Assigned Employee Department',
            'Assigned Employee',
            'Assigned Employee Id',
            'Linked Employee Department',
            'Linked Employee',
            'Linked Employee Id',
            'Mou',
            'Agreement Start Date',
            'Agreement End Date',
            'Contact Person',
            'Contact Person Phone',
            'Contact Person Email',
            'Bank Name',
            'Bank Address',
            'Bank Account No',
            'Bank Ifs Code',
            'Cancel Cheque',
            'Comments',
            'Created At'
        ];
    }
}
