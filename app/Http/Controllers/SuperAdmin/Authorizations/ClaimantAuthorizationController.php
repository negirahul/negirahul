<?php

namespace App\Http\Controllers\SuperAdmin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claimant;
use App\Models\User;
use App\Models\Admin;

class ClaimantAuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:super-admin');
    }

    public function index(Request $request)
    {
        $filter_search  = $request->search;
        $claimants      = Claimant::query();

        if ($filter_search) {
            $claimants->where('firstname', 'like','%' . $filter_search . '%');
            $claimants->orWhere('middlename', 'like','%' . $filter_search . '%');
            $claimants->orWhere('lastname', 'like','%' . $filter_search . '%');
            $claimants->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        $claimants      = $claimants->where('status', 0)->orderBy('id', 'desc')->paginate(20);

        foreach ($claimants as $key => $claimant) {
           $employee = $this->getEmployeesById($claimant->hospital->linked_employee);

           $claimants[$key]->linked_employee_data = $employee;
        }

        return view('super-admin.authorizations.claimants.manage',  compact('claimants', 'filter_search'));
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
        $claimant = Claimant::find($id);
        
        $employee = $this->getEmployeesById($claimant->hospital->linked_employee);

        $claimant->linked_employee_data = $employee;

        $assigned_employee = $this->getEmployeesById($claimant->hospital->assigned_employee);

        $claimant->assigned_employee_data = $assigned_employee;

        return view('super-admin.authorizations.claimants.show',  compact('claimant'));
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
        Claimant::where('id', $id)->update(['status' => 1]);
        return redirect()->route('super-admin.claimant-authorizations.index')->with('success', 'Claimant Authorised successfully');
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
