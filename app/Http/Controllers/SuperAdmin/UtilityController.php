<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\HospitalDepartment;
use App\Models\User;
use App\Models\IcdCode;
use App\Models\RetailPolicy;
use Illuminate\Http\Request;
use DB;

class UtilityController extends Controller
{

    public function getHospitalDoctors($hospital)
    {
        $doctors = HospitalDepartment::where('hospital_id',$hospital)->get(['id','doctors_firstname', 'doctors_lastname', 'registration_no', 'doctors_mobile_no', 'specialization']);

        $html  = '<option value="">Search Treating Doctor</option>';
        if (count($doctors) > 0) {
            foreach ($doctors as $employee) {
                $html .= '<option value=' . $employee->id . ' data-specialization="'. $employee->specialization . '" data-registration="'. $employee->registration_no . '" data-mobile="'. $employee->doctors_mobile_no. '" >' . $employee->doctors_firstname . ' '.  $employee->doctors_lastname . '</option>';
            }
        } else {
            $html  = '<option value="">Search Treating Doctor</option>';
        }


        return response()->json($html);

    }

    public function getRetailPolicies($policy)
    {
        $data =  RetailPolicy::where('policy_name',trim($policy))->orWhere('policy_name', str_replace('.', '', $policy))->orWhere('policy_name',' '. str_replace('.', '', $policy))->get(['id','policy_name','plan_name']);

        $html  = '<option value="">Select Policy</option>';
        if (count($data) > 0) {
            foreach ($data as $employee) {
                $html .= '<option value=' . $employee->id . '  data-policy=' . $employee->policy_name . '>' . $employee->plan_name . '</option>';
            }
        } else {
           $html  = '<option value="">Select Policy</option>';
        }


        return response()->json($html);

        return $data;
    }

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

     public function getdataforselect2(Request $request)
     {
        if ($request->ajax()) {

            $term = trim($request->term);
            $icd_codes_level4 = IcdCode::distinct('level4_code')->select('id', 'level4 as text','level4_code')
                ->where('level4', 'LIKE',  '%' . $term. '%')
                ->orderBy('level4', 'asc')->simplePaginate(10);

            $morePages=true;
            $pagination_obj= json_encode($icd_codes_level4);
            if (empty($icd_codes_level4->nextPageUrl())){
                $morePages=false;
            }
            $results = array(
              "results" => $icd_codes_level4->items(),
              "pagination" => array(
                "more" => $morePages
            )
          );

            return \Response::json($results);
        }
    }
}
