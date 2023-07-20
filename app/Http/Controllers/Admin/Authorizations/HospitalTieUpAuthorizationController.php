<?php

namespace App\Http\Controllers\Admin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\HospitalTieUp;
use App\Models\User;
use App\Models\Admin;
use DB;

class HospitalTieUpAuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request)
    {
        $hospitals_tie_ups = HospitalTieUp::where('status', 0)->orderBy('id', 'desc')->paginate(20);

        foreach ($hospitals_tie_ups as $key => $hospitals_tie_up) {
            if(isset($hospitals_tie_up->hospital->assigned_employee) && !empty($hospitals_tie_up->hospital->assigned_employee)){
                $employee = $this->getEmployeesById($hospitals_tie_up->hospital->assignedEmployee->id);
                HospitalTieUp::where('id', $hospitals_tie_up->id)->update(['linked_admin' => @$employee->id, 'updated_at' => \DB::raw('updated_at')]);
            }else{
                continue;
            }
        }

        DB::connection()->enableQueryLog();

        $filter_search = $request->search;
        $hospitals_tie_ups = HospitalTieUp::query();
        if($filter_search){
            $hospitals_tie_ups->where('name', 'like','%' . $filter_search . '%');
            $hospitals_tie_ups->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        $hospitals_tie_ups = $hospitals_tie_ups->where('status', 0)
        ->where(function ($query) {
            $query->orWhere('linked_admin', auth('admin')->user()->id);
                })
        ->whereHas('hospital' , function($query)
        {
            $query->orWhere('hospitals.linked_employee', auth('admin')->user()->id)
                ->orWhere('hospitals.assigned_employee', auth('admin')->user()->id);
        })->orderBy('id', 'DESC')->paginate(20);

        $queries = DB::getQueryLog();

        $last_query = end($queries);

        foreach ($hospitals_tie_ups as $key => $hospitals_tie_up) {

            if(isset($hospitals_tie_up->hospital->assigned_employee) && !empty($hospitals_tie_up->hospital->assigned_employee)){

                $employee = $this->getEmployeesById($hospitals_tie_up->hospital->assignedEmployee->id);

                HospitalTieUp::where('id', $hospitals_tie_up->id)->update(['linked_admin' => $employee->id, 'updated_at' => \DB::raw('updated_at')]);

                $hospitals_tie_ups[$key]->linked_employee_data = $employee;
            }else{

                $hospitals_tie_ups[$key]->linked_employee_data = '';
            }
        }

        return view('admin.authorizations.hospitals.tie-ups.manage',  compact('hospitals_tie_ups', 'filter_search'));
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
        
        $employee = $this->getEmployeesById($hospital_tie_up->hospital->linked_employee);

        $hospital_tie_up->linked_employee_data = $employee;

        $assigned_employee = $this->getEmployeesById($hospital_tie_up->hospital->assigned_employee);

        $hospital_tie_up->assigned_employee_data = $assigned_employee;

        return view('admin.authorizations.hospitals.tie-ups.show',  compact('hospital_tie_up'));
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
        return redirect()->route('admin.hospital-tie-up-authorizations.index')->with('success', 'Hospital Tie Ups Authorised successfully');
    }

    /*public function getEmployeesById($id)
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
    }*/

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
