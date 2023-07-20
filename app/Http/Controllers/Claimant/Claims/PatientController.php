<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $filter_search = $request->search;
        $patients = Patient::query();
        if ($filter_search) {
            $patients->where('uid', 'like', '%' . $filter_search . '%');
        }
        $patients = $patients->orderBy('id', 'desc')->paginate(20);

        return view('admin.claims.patients.manage',  compact('patients', 'filter_search'));
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
        $hospitals = Hospital::get();
        foreach ($hospitals as $hospital) {
            if (isset($hospital->linked_associate_partner_id)) {
                $hospital->ap_name = AssociatePartner::where('associate_partner_id', $hospital->linked_associate_partner_id)->value('name');
            } else {
                $hospital->ap_name = 'N/A';
            }
        }


        return view('admin.claims.patients.create',  compact('hospital_id', 'associates', 'hospitals'));
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
            'hospital_id'                       => 'required',
            'hospital_name'                     => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            'associate_partner_id'              => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'                   => 'required|max:20',
            'title'                             => 'required',
            'firstname'                         => 'required|max:25',
            'lastname'                          => isset($request->lastname) ? 'max:25' : '',
            'middlename'                        => isset($request->middlename) ? 'max:25' : '',
            'dob'                               => 'required',
            'age'                               => 'required',
            'gender'                            => 'required',
            'occupation'                        => 'required',
            'specify'                           => $request->occupation == 'other' ? 'required' : '',
            'patient_current_address'           => 'required|max:100',
            'patient_current_city'              => 'required',
            'patient_current_state'             => 'required',
            'patient_current_pincode'           => 'required|numeric',
            'current_permanent_address_same'    => 'required',
            'patient_permanent_address'         => $request->current_permanent_address_same == 'No' ? 'required|max:100' : '',
            'patient_permanent_city'            => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'patient_permanent_state'           => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'patient_permanent_pincode'         => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'id_proof'                          => 'required',
            'id_proof_file'                     => 'required',
            'code'                              => 'required|numeric|digits:3',
            'landline'                          => 'required|numeric|digits_between:1,10',
            'email'                             => 'required|email|min:1|max:45|unique:patients,email',
            'phone'                             => 'required|numeric|digits:10',
            'referred_by'                       => 'required',
            'referral_name'                     => 'required|max:45',
            'admitted_by'                       => 'required',
            'admitted_by_title'                 => $request->admitted_by == 'Self' ? '' : 'required',
            'admitted_by_firstname'             => $request->admitted_by == 'Self' ? '' : 'required|max:25',
            'comments'                          => isset($request->comments) ? '' : 'max:250',
        ];

        $messages = [
            'hospital_name.required'             => 'Please enter Hospital name',
            'hospital_id.required'               => 'Please enter Hospital ID.',
            'hospital_address.required'          => 'Please enter Hospital address.',
            'hospital_city.required'             => 'Please enter Hospital city.',
            'hospital_state.required'            => 'Please enter Hospital state.',
            'hospital_pincode.required'          => 'Please enter Hospital pincode.',
            'associate_partner_id.required'      => 'Please enter Associate Partner Id.',
            'registration_no.required'           => 'Please enter IP (In-patient) Registration No.',
            'title.required'                     => 'Please select Title',
            'firstname.required'                 => 'Please enter Firstname',
            'dob.required'                       => 'Please enter Date of birth',
            'age.required'                       => 'Please enter Age',
            'gender.required'                    => 'Please select Gender',
            'occupation.required'                => 'Please select Occupation',
            'specify'                            => 'Please specify Occupation',
            'patient_current_address.required'   => 'Please enter Patient current address.',
            'patient_current_city.required'      => 'Please enter Patient current city.',
            'patient_current_state.required'     => 'Please enter Patient current state.',
            'patient_current_pincode.required'   => 'Please enter Patient current pincode.',
            'current_permanent_address_same'     => 'Please choose whether permanent address is same as current address or not',
            'patient_permanent_address.required' => 'Please enter Patient permanent address.',
            'patient_permanent_city.required'    => 'Please enter Patient permanent city.',
            'patient_permanent_state.required'   => 'Please enter Patient permanent state.',
            'patient_permanent_pincode.required' => 'Please enter Patient permanent pincode.',
            'id_proof.required'                  => 'Please select ID Proof.',
            'id_proof_file.required'             => 'Please upload ID Proof.',
            'admitted_by_title.required'         => 'Please select Title',
            'admitted_by_firstname.required'     => 'Please enter Firstname',

        ];

        $this->validate($request, $rules, $messages);

        $patient = Patient::create([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'dob'                               => $request->dob,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'occupation'                        => $request->occupation,
            'specify'                           => $request->specify,
            'patient_current_address'           => $request->patient_current_address,
            'patient_current_city'              => $request->patient_current_city,
            'patient_current_state'             => $request->patient_current_state,
            'patient_current_pincode'           => $request->patient_current_pincode,
            'current_permanent_address_same'    => $request->current_permanent_address_same,
            'patient_permanent_address'         => $request->patient_permanent_address,
            'patient_permanent_city'            => $request->patient_permanent_city,
            'patient_permanent_state'           => $request->patient_permanent_state,
            'patient_permanent_pincode'         => $request->patient_permanent_pincode,
            'id_proof'                          => $request->id_proof,
            'hospital_id'                       => $request->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
            'email'                             => $request->email,
            'phone'                             => $request->phone,
            'code'                              => $request->code,
            'landline'                          => $request->landline,
            'referred_by'                       => $request->referred_by,
            'referral_name'                     => $request->referral_name,
            'admitted_by'                       => $request->admitted_by,
            'admitted_by_title'                 => $request->admitted_by_title,
            'admitted_by_firstname'             => $request->admitted_by_firstname,
            'admitted_by_middlename'            => $request->admitted_by_middlename,
            'admitted_by_lastname'              => $request->admitted_by_lastname,
            'comments'                          => $request->comments,
        ]);

        Patient::where('id', $patient->id)->update([
            'uid'      => 'P-' . $patient->id + 10000
        ]);

        if ($request->hasfile('dobfile')) {
            $dobfile                    = $request->file('dobfile');
            $name                       = $dobfile->getClientOriginalName();
            $dobfile->storeAs('uploads/patient/' . $patient->id . '/', $name, 'public');
            Patient::where('id', $patient->id)->update([
                'dobfile'               =>  $name
            ]);
        }

        if ($request->hasfile('id_proof_file')) {
            $id_proof_file                    = $request->file('id_proof_file');
            $name                       = $id_proof_file->getClientOriginalName();
            $id_proof_file->storeAs('uploads/patient/' . $patient->id . '/', $name, 'public');
            Patient::where('id', $patient->id)->update([
                'id_proof_file'               =>  $name
            ]);
        }

        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully');
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
            'hospital_name'                     => 'required',
            'hospital_id'                       => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            'associate_partner_id'              => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'                   => 'required|max:20',
            'title'                             => 'required',
            'firstname'                         => 'required|max:25',
            'lastname'                          => isset($request->lastname) ? 'max:25' : '',
            'middlename'                        => isset($request->middlename) ? 'max:25' : '',
            'dob'                               => 'required',
            'age'                               => 'required',
            'gender'                            => 'required',
            'occupation'                        => 'required',
            'specify'                           => $request->occupation == 'other' ? 'required' : '',
            'patient_current_address'           => 'required|max:100',
            'patient_current_city'              => 'required',
            'patient_current_state'             => 'required',
            'patient_current_pincode'           => 'required|numeric',
            'current_permanent_address_same'    => 'required',
            'patient_permanent_address'         => $request->current_permanent_address_same == 'No' ? 'required|max:100' : '',
            'patient_permanent_city'            => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'patient_permanent_state'           => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'patient_permanent_pincode'         => $request->current_permanent_address_same == 'No' ? 'required' : '',
            'id_proof'                          => 'required',
            'id_proof_file'                     => 'required',
            'code'                              => 'required|numeric|digits:3',
            'landline'                          => 'required|numeric|digits_between:1,10',
            'email'                             => 'required|email|min:1|max:45|unique:patients,email',
            'phone'                             => 'required|numeric|digits:10',
            'referred_by'                       => 'required',
            'referral_name'                     => 'required|max:45',
            'admitted_by'                       => 'required',
            'admitted_by_title'                 => $request->admitted_by == 'Self' ? '' : 'required',
            'admitted_by_firstname'             => $request->admitted_by == 'Self' ? '' : 'required|max:25',
            'comments'                          => isset($request->comments) ? '' : 'max:250',
        ];

        $messages = [
            'hospital_name.required'             => 'Please enter Hospital Name',
            'hospital_id.required'               => 'Please enter Hospital ID.',
            'hospital_address.required'          => 'Please enter Hospital address.',
            'hospital_city.required'             => 'Please enter Hospital city.',
            'hospital_state.required'            => 'Please enter Hospital state.',
            'hospital_pincode.required'          => 'Please enter Hospital pincode.',
            'associate_partner_id.required'      => 'Please enter Associate Partner Id.',
            'registration_no.required'           => 'Please enter IP (In-patient) Registration No.',
            'title.required'                     => 'Please select Title',
            'firstname.required'                 => 'Please enter Firstname',
            'dob.required'                       => 'Please enter Date of birth',
            'age.required'                       => 'Please enter Age',
            'gender.required'                    => 'Please select Gender',
            'occupation.required'                => 'Please select Occupation',
            'specify'                            => 'Please specify Occupation',
            'patient_current_address.required'   => 'Please enter Patient current address.',
            'patient_current_city.required'      => 'Please enter Patient current city.',
            'patient_current_state.required'     => 'Please enter Patient current state.',
            'patient_current_pincode.required'   => 'Please enter Patient current pincode.',
            'current_permanent_address_same'     => 'Please choose whether permanent address is same as current address or not',
            'patient_permanent_address.required' => 'Please enter Patient permanent address.',
            'patient_permanent_city.required'    => 'Please enter Patient permanent city.',
            'patient_permanent_state.required'   => 'Please enter Patient permanent state.',
            'patient_permanent_pincode.required' => 'Please enter Patient permanent pincode.',
            'id_proof.required'                  => 'Please select ID Proof.',
            'id_proof_file.required'             => 'Please upload ID Proof.',
            'admitted_by_title.required'         => 'Please select Title',
            'admitted_by_firstname.required'     => 'Please enter Firstname',

        ];

        $this->validate($request, $rules, $messages);

        $patient = Patient::where('id', $id)->update([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'dob'                               => $request->dob,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'occupation'                        => $request->occupation,
            'specify'                           => $request->specify,
            'patient_current_address'           => $request->patient_current_address,
            'patient_current_city'              => $request->patient_current_city,
            'patient_current_state'             => $request->patient_current_state,
            'patient_current_pincode'           => $request->patient_current_pincode,
            'current_permanent_address_same'    => $request->current_permanent_address_same,
            'patient_permanent_address'         => $request->patient_permanent_address,
            'patient_permanent_city'            => $request->patient_permanent_city,
            'patient_permanent_state'           => $request->patient_permanent_state,
            'patient_permanent_pincode'         => $request->patient_permanent_pincode,
            'id_proof'                          => $request->id_proof,
            'hospital_id'                       => $request->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
            'email'                             => $request->email,
            'phone'                             => $request->phone,
            'code'                              => $request->code,
            'landline'                          => $request->landline,
            'referred_by'                       => $request->referred_by,
            'referral_name'                     => $request->referral_name,
            'admitted_by'                       => $request->admitted_by,
            'admitted_by_title'                 => $request->admitted_by_title,
            'admitted_by_firstname'             => $request->admitted_by_firstname,
            'admitted_by_middlename'            => $request->admitted_by_middlename,
            'admitted_by_lastname'              => $request->admitted_by_lastname,
            'comments'                          => $request->comments,
        ]);

        if ($request->hasfile('dobfile')) {
            $dobfile                    = $request->file('dobfile');
            $name                       = $dobfile->getClientOriginalName();
            $dobfile->storeAs('uploads/patient/' . $patient->id . '/', $name, 'public');
            Patient::where('id', $patient->id)->update([
                'dobfile'               =>  $name
            ]);
        }

        if ($request->hasfile('id_proof_file')) {
            $id_proof_file                    = $request->file('id_proof_file');
            $name                       = $id_proof_file->getClientOriginalName();
            $id_proof_file->storeAs('uploads/patient/' . $patient->id . '/', $name, 'public');
            Patient::where('id', $patient->id)->update([
                'id_proof_file'               =>  $name
            ]);
        }

        return redirect()->route('admin.patients.index')->with('success', 'Patient updated successfully');
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
