<?php

namespace App\Exports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportAdmin implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Admin::latest('id')->select('id', 'firstname', 'lastname', 'email', 'employee_code', 'designation', 'department', 'phone', 'linked_employee', 'linked_employee_id', 'kra', DB::raw("DATE_FORMAT(admins.created_at, '%d-%m-%Y %H:%i:%s')"))->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Firstname',
            'Lastname',
            'Email',
            'Employee Code',
            'Designation',
            'Department',
            'Phone',
            'Linked Employee',
            'Linked Employee Id',
            'Kra',
            'Created At',
        ];
    }
}
