<?php

namespace App\Http\Controllers\Admin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Admin;
use DB;

class HospitalAuthorizationController extends Controller
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

         DB::enableQueryLog();

        $filter_search = $request->search;
        $hospitals = Hospital::query();
        if($filter_search){
            $hospitals->where('name', 'like','%' . $filter_search . '%');
            $hospitals->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        $hospitals = $hospitals->where('status', 0)
        ->where(function ($query) {
            $query->where('linked_employee', auth('admin')->user()->id)
                ->orWhere('assigned_employee', auth('admin')->user()->id);
                })->orderBy('id', 'desc')->paginate(20);

        foreach ($hospitals as $key => $hospital) {
           $employee = $this->getEmployeesById($hospital->linked_employee);

           $hospitals[$key]->linked_employee_data = $employee;
        }

        return view('admin.authorizations.hospitals.manage',  compact('hospitals', 'filter_search'));
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
        $hospital = Hospital::find($id);
        
        $employee = $this->getEmployeesById($hospital->linked_employee);

        $hospital->linked_employee_data = $employee;

        $assigned_employee = $this->getEmployeesById($hospital->assigned_employee);

        $hospital->assigned_employee_data = $assigned_employee;

        return view('admin.authorizations.hospitals.show',  compact('hospital'));
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
        Hospital::where('id', $id)->update(['status' => 1]);
        return redirect()->route('admin.hospital-authorizations.index')->with('success', 'Hospital Authorised successfully');
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
