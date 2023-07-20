<?php

namespace App\Imports;

use App\Models\Admin;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportAdmin implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] == 'Firstname') {
            return;
        }

        return new Admin([
            'firstname' => $row[0],
            'lastname' => $row[1],
            'email' => $row[2],
            'uid' => $row[3],
            'employee_code' => 'EMP'.$row[3],
            'designation' => $row[4],
            'department' => $row[5],
            'phone' => $row[6],
            'password' => Hash::make('12345678'),
            'linked_employee' => $row[7],
            'linked_employee_id' => $row[8],
            'kra' => $row[9]
        ]);
    }
}
