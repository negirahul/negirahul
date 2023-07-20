<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportUser implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::latest('id')->select('id', 'firstname', 'lastname', 'email', 'uid', 'employee_code', 'designation', 'department', 'phone', 'linked_employee', 'linked_employee_id', 'kra',DB::raw("DATE_FORMAT(users.created_at, '%d-%m-%Y %H:%i:%s')"))->get();
    }

    public function headings(): array
    {     

        return [
            'Id',
            'Firstname',
            'Lastname',
            'Email',
            'U Id',
            'Employee Code',
            'Designation',
            'Department',
            'Phone',
            'Linked Employee',
            'Linked Employee Id',
            'Kra',
            'Created At'
        ];
    }
}
