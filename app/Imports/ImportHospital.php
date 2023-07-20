<?php

namespace App\Imports;

use App\Models\Hospital;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportHospital implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] == 'Name') {
            return;
        }

        $hospital = Hospital::latest()->first();

        return new Hospital([
            'uid' => 'HSP'.(($hospital->id)+1),
            'name' => $row[0],
            'onboarding' => $row[1],
            'by' => $row[2],
            'by' => $row[2],
            'address' => $row[3],
            'city' => $row[4],
            'state' => $row[5],
            'pincode' => $row[6],
            'firstname' => $row[7],
            'lastname' => $row[8],
            'pan' => $row[9],
            'email' => $row[10],
            'landline' => $row[11],
            'phone' => $row[12],
            'rohini' => $row[13],
            'linked_associate_partner' => $row[14],
            'linked_associate_partner_id' => $row[15],
            'assigned_employee' => $row[16],
            'assigned_employee_id' => $row[17],
            'linked_employee' => $row[18],
            'linked_employee_id' => $row[19],
            'comments' => $row[20],
            'password' => Hash::make('12345678'),
        ]);
    }

    public function rules(): array
    {
        return [
            '10' => 'unique:hospitals,email',
        ];
    }
}
