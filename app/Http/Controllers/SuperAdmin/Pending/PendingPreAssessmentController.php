<?php

namespace App\Http\Controllers\SuperAdmin\Pending;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Insurer;
use App\Models\Admin;
use App\Models\User;

class PendingPreAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claims =  Claim::where('status', 0)
            ->where(function ($query) {
            $query->whereNotNull('assign_to')
            ->orWhereNotNull('re_assign_to');
        })->orderBy('id', 'desc')->paginate(20);

        foreach ($claims as $key => $claim) {
           $employee = $this->getEmployeesById($claim->hospital->assignedEmployee->id);

           $claims[$key]->linked_employee_data = $employee;

           Claim::where('id', $claim->id)->update(['linked_admin' => $employee->id]);
        }

        $filter_search = '';

        return view('super-admin.pendings.pre-assessment.manage',  compact('claims', 'filter_search'));
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
        //
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
        Claim::where('id', $id)->update(['status' => 1]);
        return redirect()->route('super-admin.pending-pre-assessment.index')->with('success', 'Claim Authorised successfully');
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
