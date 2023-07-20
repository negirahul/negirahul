<?php

namespace App\Http\Controllers\Admin\Authorizations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrower;
use App\Models\User;
use App\Models\Admin;

class BorrowerAuthorizationController extends Controller
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
        $filter_search = $request->search;

        $borrowers = Borrower::query();

        if($filter_search){
            $borrowers->where('borrower_firstname', 'like','%' . $filter_search . '%');
            $borrowers->orWhere('borrower_middlename', 'like','%' . $filter_search . '%');
            $borrowers->orWhere('borrower_lastname', 'like','%' . $filter_search . '%');
            $borrowers->orWhere('uid', 'like','%' . $filter_search . '%');
        }

        // $borrowers = $borrowers->where('status', 0)->orderBy('id', 'desc')->paginate(20);

        $borrowers = $borrowers->where('status', 0)->whereHas('hospital' , function($query)
        {
            $query->where('hospitals.linked_employee', auth('admin')->user()->id)
                ->orWhere('hospitals.assigned_employee', auth('admin')->user()->id);
        })->orderBy('id', 'DESC')->paginate(20);

        
        foreach ($borrowers as $key => $borrower) {
           $employee = $this->getEmployeesById($borrower->hospital->linked_employee);

           $borrowers[$key]->linked_employee_data = $employee;
        }

        return view('admin.authorizations.borrowers.manage',  compact('borrowers', 'filter_search'));
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
        $borrower = Borrower::find($id);
        
        $employee = $this->getEmployeesById($borrower->hospital->linked_employee);

        $borrower->linked_employee_data = $employee;

        $assigned_employee = $this->getEmployeesById($borrower->hospital->assigned_employee);

        $borrower->assigned_employee_data = $assigned_employee;

        return view('admin.authorizations.borrowers.show',  compact('borrower'));
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
        Borrower::where('id', $id)->update(['status' => 1]);
        return redirect()->route('admin.borrower-authorizations.index')->with('success', 'Borrower Authorised successfully');
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
