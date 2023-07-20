<?php

namespace App\Imports;

use App\Models\AssociatePartner;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class ImportAssociatePartner implements ToModel
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


        return new AssociatePartner([
            'name' => $row[0],
            'type' => $row[1],
            'pan' => $row[2],
            'associate_partner_id' => 'AP' . substr($row[2], 0, 2) . substr($row[2], -3),
            'owner_firstname' => $row[3],
            'owner_lastname' => $row[4],
            'email' => $row[5],
            'address' => $row[6],
            'city' => $row[7],
            'state' => $row[8],
            'pincode' => $row[9],
            'password' => Hash::make('12345678'),
            'phone' => $row[10],
            'reference' => $row[11],
            'status' => $row[12],
            'linked_associate_partner' => $row[13],
            'linked_associate_partner_id' => $row[14],
            'assigned_employee_department' => $row[15],
            'assigned_employee' => $row[16],
            'assigned_employee_id' => $row[17],
            'linked_employee_department' => $row[18],
            'linked_employee' => $row[19],
            'linked_employee_id' => $row[20],
            'mou' => $row[21],
            'agreement_start_date' => $row[22],
            'agreement_end_date' => $row[23],
            'contact_person' => $row[24],
            'contact_person_phone' => $row[25],
            'contact_person_email' => $row[26],
            'bank_name' => $row[27],
            'bank_address' => $row[28],
            'bank_account_no' => $row[29],
            'bank_ifs_code' => $row[30],
            'cancel_cheque' => $row[31],
            'comments' => $row[32],
        ]);
    }
}
