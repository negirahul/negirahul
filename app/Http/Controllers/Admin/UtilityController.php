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
        if ($department && $department == 'all') {
            $users  = User::get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
            $users->map(function ($item) {
                $item->name = $item->firstname . ' ' . $item->lastname;
                $item->role = 'User';
                unset($item->firstname);
                unset($item->lastname);
                return $item;
            });

            $admins = Admin::get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
        }else{

            $users  = User::where('department', $department)->get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
            $users->map(function ($item) {
                $item->name = $item->firstname . ' ' . $item->lastname;
                $item->role = 'User';
                unset($item->firstname);
                unset($item->lastname);
                return $item;
            });

            $admins = Admin::where('department', $department)->get(['id', 'firstname', 'lastname', 'department', 'employee_code'])->collect();
        }
        $admins->map(function ($item) {
            $item->name = $item->firstname . ' ' . $item->lastname;
            $item->role = 'Admin';
            unset($item->firstname);
            unset($item->lastname);
            return $item;
        });
        $employees = $users->merge($admins);
        $html  = '<option value="">Select Employee</option>';
        if (count($employees) > 0) {
            foreach ($employees as $employee) {
                $html .= '<option value=' . $employee->id . '  data-id=' . $employee->employee_code . '>' . $employee->name . '[' . $employee->employee_code . '][' . $employee->department . ']</option>';
            }
        } else {
            $html  = 'No Employee found for selected department.';
        }


        return response()->json($html);
    }

    public function getEmployeesById($id)
    {
        $user_exists  = User::where('id', $id)->exists();
        if ($user_exists) {
            return User::where('id', $id)->get(['id', 'firstname', 'lastname', 'employee_code'])->first();
        }else{

            $admin_exists  = Admin::where('id', $id)->exists();
            if ($admin_exists) {
                return Admin::where('id', $id)->get(['id', 'firstname', 'lastname', 'employee_code'])->first();
            }else{
                return "Not exist";
            }
        }
    }
}
