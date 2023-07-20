<?php

namespace App\Http\Controllers\Employee;

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
use App\Notifications\User\CredentialsGeneratedNotification;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //
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
        return view('employee.claims.create.patient',  compact('hospital_id','associates','hospital'));
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
            'firstname'                => 'required|string',
            // 'uid'                      => 'required|unique:users',
            'dob'              => 'required',
            'email'                    => 'required|unique:users',
            'mobile'                    => 'required|numeric|digits:10',
            'address'               => 'required',
        ];

        $messages = [
            'firstname.required'             => 'Please enter firstname',
            // 'uid.required'                => 'Please enter employee code.',
            'dob.required'                   => 'Please enter dob.',
            'email.required'                 => 'Please enter official mail ID.',
            'mobile.required'                 => 'Please enter contact number.',
            'address.required'            => 'Please select address.',
        ];

        $this->validate($request, $rules, $messages);

        $patient                     =   Patient::create($request->all());

        // $perm_patient = Patient::find($patient->id);

        // $password = '12345678';
        // $patient->notify(new CredentialsGeneratedNotification($patient->email, $password, $patient));

        return redirect()->route('employee.patients.index')->with('success', 'Patient created successfully');
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
       //
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
        return redirect()->route('employee.patients.index')->with('success', 'Patient deleted successfully');
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
