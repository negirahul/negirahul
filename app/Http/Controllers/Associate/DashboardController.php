<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AssociatePartner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:associate');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $associate_partner = AssociatePartner::find($id);
            
        $linked_ap  = User::where('employee_code', $associate_partner->linked_employee_id)->exists();
        if (!$linked_ap) {
            $linked_ap  = Admin::where('employee_code', $associate_partner->linked_employee_id)->first();
        }else{
            $linked_ap  = User::where('employee_code', $associate_partner->linked_employee_id)->first();
        }

        $assigned_ap  = User::where('employee_code', $associate_partner->assigned_employee_id)->exists();
        if (!$assigned_ap) {
            $assigned_ap  = Admin::where('employee_code', $associate_partner->assigned_employee_id)->first();
        }else{
            $assigned_ap  = User::where('employee_code', $associate_partner->assigned_employee_id)->first();
        }
        return view('associate.dashboard', compact('linked_ap', 'assigned_ap'));
    }
}
