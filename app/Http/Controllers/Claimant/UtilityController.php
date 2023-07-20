<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class UtilityController extends Controller
{
    public function getEmployeesByDepartment($department)
    {
        $users  = User::where('department', $department)->get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
        $users->map(function ($item) {
            $item->name = $item->firstname . ' ' . $item->lastname;
            $item->role = 'User';
            unset($item->firstname);
            unset($item->lastname);
            return $item;
        });

        $admins = Admin::where('department', $department)->get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
        $admins->map(function ($item) {
            $item->name = $item->firstname . ' ' . $item->lastname;
            $item->role = 'Admin';
            unset($item->firstname);
            unset($item->lastname);
            return $item;
        });
        $employees = $users->merge($admins);
        $html  = '<option value="">Select Linked With Employee</option>';
        if (count($employees) > 0) {
            foreach ($employees as $employee) {
                $html .= '<option value=' . $employee->id . '  data-id=' . $employee->employee_code . '>' . $employee->name . '[' . $employee->employee_code . '][' . $employee->department . ']</option>';
            }
        } else {
            $html  = 'No Employee found for selected department.';
        }


        return response()->json($html);
    }
}
