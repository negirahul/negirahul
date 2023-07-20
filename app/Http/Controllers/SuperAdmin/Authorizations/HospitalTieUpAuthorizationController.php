<?php

namespace App\Http\Controllers\SuperAdmin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\HospitalTieUp;
use App\Models\User;
use App\Models\Admin;

class HospitalTieUpAuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;
        $hospitals_tie_ups = HospitalTieUp::whereHas('hospital', function ($q) {
                $q->whereNotNull('id');
            });
        if($filter_search){
            $hospitals_tie_ups->where('name', 'like','%' . $filter_search . '%');
            $hospitals_tie_ups->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        $hospitals_tie_ups = $hospitals_tie_ups->where('status', 0)->orderBy('id', 'desc')->paginate(20);

        foreach ($hospitals_tie_ups as $key => $hospitals_tie_up) {

            if(isset($hospitals_tie_up->hospital->assigned_employee) && !empty($hospitals_tie_up->hospital->assigned_employee)){
             $employee = $this->getEmployeesById($hospitals_tie_up->hospital->assignedEmployee->id);

             HospitalTieUp::where('id', $hospitals_tie_up->id)->update(['linked_admin' => @$employee->id, 'updated_at' => \DB::raw('updated_at')]);

             $hospitals_tie_ups[$key]->linked_employee_data = $employee;
         }else{

             $hospitals_tie_ups[$key]->linked_employee_data = '';
         }
     }

        return view('super-admin.authorizations.hospitals.tie-ups.manage',  compact('hospitals_tie_ups', 'filter_search'));
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
        $hospital_tie_up = HospitalTieUp::find($id);

        if(isset($hospital_tie_up->hospital->linked_employee) && !empty($hospital_tie_up->hospital->linked_employee))
        {
            $employee = $this->getEmployeesById($hospital_tie_up->hospital->linkedEmployee->id);

            $hospital_tie_up->linked_employee_data = $employee;
        }else{
            $hospital_tie_up->linked_employee_data = '';

        }

        if(isset($hospital_tie_up->hospital->assigned_employee) && !empty($hospital_tie_up->hospital->assigned_employee))
        {
            $assigned_employee = $this->getEmployeesById($hospital_tie_up->hospital->assignedEmployee->id);

            $hospital_tie_up->assigned_employee_data = $assigned_employee;
        }else{
            $hospital_tie_up->assigned_employee_data = '';

        }

        return view('super-admin.authorizations.hospitals.tie-ups.show',  compact('hospital_tie_up'));
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
        HospitalTieUp::where('id', $id)->update(['status' => 1]);
        return redirect()->route('super-admin.hospital-tie-up-authorizations.index')->with('success', 'Hospital Tie Ups Authorised successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getEmployeesById($id)
    {
        $admin_exists  = Admin::where('id', $id)->exists();
        if ($admin_exists) {
            $linked = Admin::where('id', $id)->value('linked_employee');
            return Admin::where('id', $linked)->get(['id', 'firstname', 'lastname', 'employee_code'])->first();
        }else{
            return "Not exist";
        }
    }

    public function destroy($id)
    {
        //
    }
}
