<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Patient;
use App\Models\AssociatePartner;
use App\Models\Hospital;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPatient;
use App\Exports\ExportPatient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hospital_id = $request->hospital_id;
        $associates = AssociatePartner::get();
        $hospital = Hospital::where('id',$hospital_id)->first(['name','address','city', 'state', 'pincode']);
        return view('admin.claims.create.patient',  compact('hospital_id','associates','hospital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'firstname'                 => 'required|string',
            'dob'                       => 'required',
            'email'                     => 'required|unique:users',
            'mobile'                    => 'required|numeric|digits:10',
            'address'                   => 'required',
        ];

        $messages = [
            'firstname.required'             => 'Please enter firstname',
            'dob.required'                   => 'Please enter dob.',
            'email.required'                 => 'Please enter official mail ID.',
            'mobile.required'                 => 'Please enter contact number.',
            'address.required'            => 'Please select address.',
        ];

        $this->validate($request, $rules, $messages);

        $patient                     =   Patient::create($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient created successfully');
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
        $rules = [
            'firstname'                => 'required|string',
            'uid'                      => 'required|unique:users,email,'.$id,
            'designation'              => 'required|string',
            'email'                    => 'required|unique:users,email,'.$id,
            'phone'                    => 'required|numeric|digits:10',
            'department'               => 'required',
            'kra'                      => 'required|string',
            'linked_employee'          => 'required',
            'linked_employee_id'       => 'required',
        ];

        $messages = [
            'firstname.required'             => 'Please enter firstname',
            'uid.required'                   => 'Please enter employee code.',
'uid.unique'                   => 'This Employee Code is already taken.',
            'designation.required'           => 'Please enter designation.',
            'email.required'                 => 'Please enter official mail ID.',
            'phone.required'                 => 'Please enter contact number.',
            'department.required'            => 'Please select department.',
            'kra.required'                   => 'Please enter KRA',
            'linked_employee.required'       => 'Please select linked employee.',
            'linked_employee_id.required'    => 'Please enter linked employee ID.',
        ];

        $this->validate($request, $rules, $messages);

        $user                    =   Patient::where('id', $id)->update([
            'firstname'           =>  $request->firstname,
            'lastname'            =>  $request->lastname,
            'uid'                 =>  $request->uid,
            'employee_code'       =>  'EMP'.$request->uid,
            'designation'         =>  $request->designation,
            'email'               =>  $request->email,
            'phone'               =>  $request->phone,
            'department'          =>  $request->department,
            'kra'                 =>  $request->kra,
            'linked_employee'     =>  $request->linked_employee,
            'linked_employee_id'  =>  $request->linked_employee_id
        ]);

        $perm_user = Patient::find($id);
        $perm_user->syncPermissions($request->permission);

        return redirect()->route('admin.users.index')->with('success', 'Patient updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::find($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Patient deleted successfully');
    }


    public function changePassword(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'new_password' => 'required|min:8|confirmed',

        ]);

        $user = Patient::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully');
    }
}
