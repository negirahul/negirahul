<?php

namespace App\Http\Controllers\SuperAdmin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\HospitalEmpanelmentStatus;
use App\Models\User;
use App\Models\Admin;

class HospitalEmanelmentStatusAuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $hospital_empanelments = HospitalEmpanelmentStatus::query();
        if($filter_search){
            $hospital_empanelments->where('name', 'like','%' . $filter_search . '%');
            $hospital_empanelments->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        $hospital_empanelments = $hospital_empanelments->where('status', 1)->orderBy('id', 'desc')->paginate(20);

        foreach ($hospital_empanelments as $key => $hospital_empanelment) {
           $employee = $this->getEmployeesById($hospital_empanelment->hospital->linked_employee);

           $hospital_empanelments[$key]->linked_employee_data = $employee;
        }

        return view('super-admin.authorizations.hospitals.empanelments.manage',  compact('hospital_empanelments', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hospital_empanelment = HospitalEmpanelmentStatus::find($id);
        
        $employee = $this->getEmployeesById($hospital_empanelment->hospital->linked_employee);

        $hospital_empanelment->linked_employee_data = $employee;

        $assigned_employee = $this->getEmployeesById($hospital_empanelment->hospital->assigned_employee);

        $hospital_empanelment->assigned_employee_data = $assigned_employee;

        return view('super-admin.authorizations.hospitals.empanelments.show',  compact('hospital_empanelment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        HospitalEmpanelmentStatus::where('id', $id)->update(['status' => 1]);
        return redirect()->route('super-admin.hospital-empstatus-authorizations.index')->with('success', 'Hospital Empanelment Status Authorised successfully');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
