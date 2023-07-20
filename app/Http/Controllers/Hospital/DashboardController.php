<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Admin;
use App\Models\AssociatePartner;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hospital');
    }

    public function index()
    {

        $id = Auth::user()->id;
        $hospital = Hospital::find($id);
        $linked_ap         = Hospital::find($hospital->linked_employee);
        $assigned_ap         = Hospital::find($hospital->assigned_employee);

        $linked_employee  = User::where('employee_code', $hospital->linked_employee_id)->exists();
        if (!$linked_employee) {
            $linked_employee  = Admin::where('employee_code', $hospital->linked_employee_id)->first();
        }else{
            $linked_employee  = User::where('employee_code', $hospital->linked_employee_id)->first();
        }

        $assigned_employee  = User::where('employee_code', $hospital->assigned_employee_id)->exists();
        if (!$assigned_employee) {
            $assigned_employee  = Admin::where('employee_code', $hospital->assigned_employee_id)->first();
        }else{
            $assigned_employee  = User::where('employee_code', $hospital->assigned_employee_id)->first();
        }

        
        return view('hospital.dashboard', compact('assigned_employee', 'linked_employee'));
    }
}
