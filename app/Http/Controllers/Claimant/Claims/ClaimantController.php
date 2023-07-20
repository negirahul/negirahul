<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssociatePartner;
use App\Models\Claimant;
use App\Models\Borrower;
use App\Models\Patient;
use App\Models\Hospital;
use App\Models\User;
use App\Models\Claim;

class ClaimantController extends Controller
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
        $claimants = Claimant::query();

        if($filter_search){
            $claimants->where('patient_id', 'like','%' . $filter_search . '%');
        }

        $claimants = $claimants->orderBy('id', 'desc')->paginate(20);

        // echo "<pre>";print_r($claimants);"</pre>";exit;

        return view('admin.claims.claimants.manage',  compact('claimants', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patient_id             = $request->patient_id;
        $claim_id               = $request->claim_id;
        $associates             = AssociatePartner::get();
        $hospitals              = Hospital::get();
        $patients               = Patient::get();
        $claims                 = Claim::get();
        $patient                = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $claim                  = isset($claim_id) ? Claim::find($request->claim_id) : null;
        $hospital_id            = isset($patient_id) ? $patient->hospital->id : null;
        $associate_partner_id   = isset($patient_id) ? $patient->associate_partner_id : null;
        $patient_title          = isset($patient) ? $patient->title : null;
        $patient_id_proof          = isset($patient) ? $patient->id_proof : null;
        $patient_firstname      = isset($patient) ? $patient->firstname : null;
        $patient_lastname       = isset($patient) ? $patient->lastname : null;
        $patient_middlename     = isset($patient) ? $patient->middlename : null;

        return view('admin.claims.claimants.create.create',  compact('patient_id', 'associates', 'hospitals', 'patient', 'patients', 'claims', 'claim', 'claim_id', 'associate_partner_id', 'hospital_id', 'patient_title', 'patient_firstname', 'patient_lastname', 'patient_middlename', 'patient_id_proof'));
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
            'patient_id' => 'required',
            'claim_id' => 'required',
            'associate_partner_id' => "required_if:$request->associate_partner_id,'!=',null",
            'hospital_id' => 'required',
            // 'patient_title' => 'required|max:25',
            'patient_firstname' => 'required|max:25',
            'patient_middlename' => 'required|max:25',
            'patient_lastname' => 'required|max:25',
            // 'patient_id_proof' => 'required',
            'are_patient_and_claimant_same' => 'required',
            'title' => 'required',
            'firstname' => 'required|max:25',
            'middlename' => 'required||max:25',
            'lastname' => 'required',
            'pan_no' => 'required|unique:claimants|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u',
            'pan_no_file' => 'required',
            'aadhar_no' => 'required|unique:claimants|alpha_num|size:12',
            'aadhar_no_file' => 'required',
            'patients_relation_with_claimant' => 'required',
            'specify' => ($request->patients_relation_with_claimant == 'Other') ? 'required' : [],
            'address' => 'required|max:100',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'personal_email_id' => 'required|email|max:45',
            'official_email_id' => 'required|email|max:45',
            'mobile_no' => 'required|digits:10',
            // 'estimated_amount' => 'required',
            'cancel_cheque' => 'required',
            'cancel_cheque_file' => 'required',
            'bank_name' => 'required|max:45',
            'bank_address' => 'required|max:80',
            'ac_no' => 'required|max:20',
            'ifs_code' => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                => 'Please Enter Patient Id',
            'claim_id.required'             => 'Please Enter Claim Id',
            'associate_partner_id.required'               => 'Please Enter Associate Partner Id',
            'hospital_id.required'          => 'Please Enter Hospital Id',
            'patient_title.required'             => 'Please Enter Patient Title',
            'patient_firstname.required'            => 'Please Enter Patient Firstname',
            'patient_middlename.required'          => 'Please Enter Patient Middlename',
            'patient_lastname.required'      => 'Please Enter Patient Lastname',
            'patient_id_proof.required'           => 'Please Enter Patient Id Proof',
            'are_patient_and_claimant_same.required'                     => 'Please Enter Are Patient And Claimant Same',
            'title.required'                 => 'Please Enter Title',
            'firstname.required'                       => 'Please Enter Firstname',
            'middlename.required'                    => 'Please Enter Middlename',
            'lastname.required'            => 'Please Enter Lastname',
            'pan_no.required'            => 'Please Enter Pan No',
            'aadhar_no.required'                   => 'Please Enter Aadhar No',
            'patients_relation_with_claimant.required'        => 'Please Enter Patients Relation With Claimant',
            'specify.required'                 => 'Please Enter Specify',
            'address.required'    => 'Please Enter Address',
            'city.required'          => 'Please Enter City',
            'state.required'    => 'Please Enter State',
            'pincode.required'          => 'Please Enter Pincode',
            'personal_email_id.required'        => 'Please Enter Personal Email Id',
            'official_email_id.required'            => 'Please Enter Official Email Id',
            'mobile_no.required'          => 'Please Enter Mobile No',
            'estimated_amount.required'          => 'Please Enter Estimated Amount',
            'cancel_cheque.required'          => 'Please Enter Cancel Cheque',
            'bank_name.required'            => 'Please Enter Bank Name',
            'bank_address.required'        => 'Please Enter Bank Address',
            'ac_no.required'          => 'Please Enter Bank Account No',
            'ifs_code.required'              => 'Please Enter Bank Ifs Code',
            'comments.required'              => 'Please Enter Comments',
        ];

        $this->validate($request, $rules, $messages);

        $cliam = Claim::find($request->claim_id);

        $claimant =  Claimant::Create([
           'patient_id' => $request->patient_id,
           'claim_id' => $cliam ? $cliam->uid : $request->claim_id,
           'associate_partner_id' => $request->associate_partner_id,
           'hospital_id' => $request->hospital_id,
           'patient_title' => $request->patient_title,
           'patient_firstname' => $request->patient_firstname,
           'patient_middlename' => $request->patient_middlename,
           'patient_lastname' => $request->patient_lastname,
           'patient_id_proof' => $request->patient_id_proof,
           'are_patient_and_claimant_same' => $request->are_patient_and_claimant_same,
           'title' => $request->title,
           'firstname' => $request->firstname,
           'middlename' => $request->middlename,
           'lastname' => $request->lastname,
           'pan_no' => $request->pan_no,
           'aadhar_no' => $request->aadhar_no,
           'patients_relation_with_claimant' => $request->patients_relation_with_claimant,
           'specify' => $request->specify,
           'address' => $request->address,
           'city' => $request->city,
           'state' => $request->state,
           'pincode' => $request->pincode,
           'personal_email_id' => $request->personal_email_id,
           'official_email_id' => $request->official_email_id,
           'mobile_no' => $request->mobile_no,
           // 'estimated_amount' => $request->estimated_amount,
           'cancel_cheque' => $request->cancel_cheque,
           'bank_name' => $request->bank_name,
           'bank_address' => $request->bank_address,
           'ac_no' => $request->ac_no,
           'ifs_code' => $request->ifs_code,
           'comments' => $request->comments,
       ]);

        Claimant::where('id', $claimant->id)->update([
            'uid'      => 'CLMT' . substr($claimant->pan_no, 0, 2) . substr($claimant->pan_no, -3)
        ]);

        if ($request->hasfile('patient_id_proof')) {
            $patient_id_proof                    = $request->file('patient_id_proof');
            $name                       = $patient_id_proof->getClientOriginalName();
            $patient_id_proof->storeAs('uploads/claimant/' . $claimant->id . '/', $name, 'public');
            Claimant::where('id', $claimant->id)->update([
                'patient_id_proof'               =>  $name
            ]);
        }

        if ($request->hasfile('pan_no_file')) {
            $pan_no_file                    = $request->file('pan_no_file');
            $rhnname                       = $pan_no_file->getClientOriginalName();
            $pan_no_file->storeAs('uploads/claimant/' . $claimant->id . '/', $rhnname, 'public');
            Claimant::where('id', $claimant->id)->update([
                'pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('aadhar_no_file')) {
            $aadhar_no_file                    = $request->file('aadhar_no_file');
            $name                       = $aadhar_no_file->getClientOriginalName();
            $aadhar_no_file->storeAs('uploads/claimant/' . $claimant->id . '/', $name, 'public');
            Claimant::where('id', $claimant->id)->update([
                'aadhar_no_file'               =>  $name
            ]);
        }

        if ($request->hasfile('cancel_cheque_file')) {
            $cancel_cheque_file                    = $request->file('cancel_cheque_file');
            $rhnname                       = $cancel_cheque_file->getClientOriginalName();
            $cancel_cheque_file->storeAs('uploads/claimant/' . $claimant->id . '/', $rhnname, 'public');
            Claimant::where('id', $claimant->id)->update([
                'cancel_cheque_file'               =>  $rhnname
            ]);
        }

        return redirect()->route('admin.claimants.edit',$claimant->id)->with('success', 'Claimant created successfully');

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
        $claimant       = Claimant::find($id);
        $hospital       = Hospital::where('uid',$claimant->hospital_id)->first();
        $hospitals      = Hospital::get();
        $patient        = Patient::where('uid', $claimant->patient_id)->first();

        $exists         = Borrower::where('claimant_id', $id)->exists();
        if ($exists) {
            $borrower     = Borrower::where('claimant_id', $id)->first();
        }else{
            $borrower = Borrower::create([
                'claimant_id' => $id,
                'patient_id' => $claimant->patient_id,
                'claim_id' => $claimant->claim_id,
                'hospital_id' => $claimant->hospital_id,
                'hospital_name' => @$hospital->name,
                'hospital_address' => @$hospital->address,
                'hospital_city' => @$hospital->city,
                'hospital_state' =>@ $hospital->state,
                'hospital_pincode' => @$hospital->pincode,
                'patient_title' => @$patient->title,
                'patient_firstname' => @$patient->firstname,
                'patient_middlename' => @$patient->middlename,
                'patient_lastname' => @$patient->lastname,
            ]);
        }

        $associates     = AssociatePartner::get();
        $patient_id   = $claimant->patient_id;

        $claim = $claimant->claim;

        return view('admin.claims.claimants.edit.edit',  compact('patient_id', 'associates', 'hospitals', 'patient', 'claimant', 'borrower', 'id', 'claim'));

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
        $claimant =  Claimant::find($id);
        if ($request->hasfile('patient_id_proof')) {
            $patient_id_proof                    = $request->file('patient_id_proof');
            $name                       = $patient_id_proof->getClientOriginalName();
            $patient_id_proof->storeAs('uploads/claimant/' . $claimant->id . '/', $name, 'public');
            Claimant::where('id', $claimant->id)->update([
                'patient_id_proof'               =>  $name
            ]);
        }

        if ($request->hasfile('pan_no_file')) {
            $pan_no_file                    = $request->file('pan_no_file');
            $rhnname                       = $pan_no_file->getClientOriginalName();
            $pan_no_file->storeAs('uploads/claimant/' . $claimant->id . '/', $rhnname, 'public');
            Claimant::where('id', $claimant->id)->update([
                'pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('aadhar_no_file')) {
            $aadhar_no_file                    = $request->file('aadhar_no_file');
            $name                       = $aadhar_no_file->getClientOriginalName();
            $aadhar_no_file->storeAs('uploads/claimant/' . $claimant->id . '/', $name, 'public');
            Claimant::where('id', $claimant->id)->update([
                'aadhar_no_file'               =>  $name
            ]);
        }

        if ($request->hasfile('cancel_cheque_file')) {
            $cancel_cheque_file                    = $request->file('cancel_cheque_file');
            $rhnname                       = $cancel_cheque_file->getClientOriginalName();
            $cancel_cheque_file->storeAs('uploads/claimant/' . $claimant->id . '/', $rhnname, 'public');
            Claimant::where('id', $claimant->id)->update([
                'cancel_cheque_file'               =>  $rhnname
            ]);
        }

        $rules = [
            'patient_id' => 'required',
            'claim_id' => 'required',
            'associate_partner_id' => 'required',
            'hospital_id' => 'required',
            'patient_title' => 'required',
            'patient_firstname' => 'required',
            'patient_middlename' => 'required',
            'patient_lastname' => 'required',
            'patient_id_proof' => 'required',
            'are_patient_and_claimant_same' => 'required',
            'title' => 'required',
            'firstname' => 'required',
            'middlename' => 'required|',
            'lastname' => 'required',
            'pan_no' => 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u',
            'aadhar_no' => 'required|alpha_num|size:10',
            'patients_relation_with_claimant' => 'required',
            'specify' => ($request->patients_relation_with_claimant == 'Other') ? 'required' : [],
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'personal_email_id' => 'required|email|max:45',
            'official_email_id' => 'required|email|max:45',
            'mobile_no' => 'required|digits:10',
            'cancel_cheque' => 'required',
            'bank_name' => 'required',
            'bank_address' => 'required',
            'ac_no' => 'required',
            'ifs_code' => 'required',
            'comments' => 'required',
        ];

        $messages =  [
            'patient_id.required'                => 'Please Enter Patient Id',
            'claim_id.required'             => 'Please Enter Claim Id',
            'associate_partner_id.required'               => 'Please Enter Associate Partner Id',
            'hospital_id.required'          => 'Please Enter Hospital Id',
            'patient_title.required'             => 'Please Enter Patient Title',
            'patient_firstname.required'            => 'Please Enter Patient Firstname',
            'patient_middlename.required'          => 'Please Enter Patient Middlename',
            'patient_lastname.required'      => 'Please Enter Patient Lastname',
            'patient_id_proof.required'           => 'Please Enter Patient Id Proof',
            'are_patient_and_claimant_same.required'                     => 'Please Enter Are Patient And Claimant Same',
            'title.required'                 => 'Please Enter Title',
            'firstname.required'                       => 'Please Enter Firstname',
            'middlename.required'                    => 'Please Enter Middlename',
            'lastname.required'            => 'Please Enter Lastname',
            'pan_no.required'            => 'Please Enter Pan No',
            'aadhar_no.required'                   => 'Please Enter Aadhar No',
            'patients_relation_with_claimant.required'        => 'Please Enter Patients Relation With Claimant',
            'specify.required'                 => 'Please Enter Specify',
            'address.required'    => 'Please Enter Address',
            'city.required'          => 'Please Enter City',
            'state.required'    => 'Please Enter State',
            'pincode.required'          => 'Please Enter Pincode',
            'personal_email_id.required'        => 'Please Enter Personal Email Id',
            'official_email_id.required'            => 'Please Enter Official Email Id',
            'mobile_no.required'          => 'Please Enter Mobile No',
            'estimated_amount.required'          => 'Please Enter Estimated Amount',
            'cancel_cheque.required'          => 'Please Enter Cancel Cheque',
            'bank_name.required'            => 'Please Enter Bank Name',
            'bank_address.required'        => 'Please Enter Bank Address',
            'ac_no.required'          => 'Please Enter Bank Account No',
            'ifs_code.required'              => 'Please Enter Bank Ifs Code',
            'comments.required'              => 'Please Enter Comments',
        ];

        $this->validate($request, $rules, $messages);

        $hospitalT =  Claimant::updateOrCreate(
            [
                'id' => $id
            ],
            [
             'patient_id' => $request->patient_id,
             'claim_id' => $request->claim_id,
             'associate_partner_id' => $request->associate_partner_id,
             'hospital_id' => $request->hospital_id,
             'patient_title' => $request->patient_title,
             'patient_firstname' => $request->patient_firstname,
             'patient_middlename' => $request->patient_middlename,
             'patient_lastname' => $request->patient_lastname,
             'patient_id_proof' => $request->patient_id_proof,
             'are_patient_and_claimant_same' => $request->are_patient_and_claimant_same,
             'title' => $request->title,
             'firstname' => $request->firstname,
             'middlename' => $request->middlename,
             'lastname' => $request->lastname,
             'pan_no' => $request->pan_no,
             'aadhar_no' => $request->aadhar_no,
             'patients_relation_with_claimant' => $request->patients_relation_with_claimant,
             'specify' => $request->specify,
             'address' => $request->address,
             'city' => $request->city,
             'state' => $request->state,
             'pincode' => $request->pincode,
             'personal_email_id' => $request->personal_email_id,
             'official_email_id' => $request->official_email_id,
             'mobile_no' => $request->mobile_no,
             'estimated_amount' => $request->estimated_amount,
             'cancel_cheque' => $request->cancel_cheque,
             'bank_name' => $request->bank_name,
             'bank_address' => $request->bank_address,
             'ac_no' => $request->ac_no,
             'ifs_code' => $request->ifs_code,
             'comments' => $request->comments,
         ]);

        return redirect()->route('admin.claimants.edit',$id)->with('success', 'Claimant updated successfully');
    }

    public function borrowerDetails(Request $request, $id)
    {
        $borrower = Borrower::where('claimant_id',$id)->first();


        if ($request->hasfile('borrower_id_proof_file')) {
            $borrower_id_proof_file                    = $request->file('borrower_id_proof_file');
            $name                       = $borrower_id_proof_file->getClientOriginalName();
            $borrower_id_proof_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_id_proof_file'               =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_no_file')) {
            $borrower_pan_no_file                    = $request->file('borrower_pan_no_file');
            $rhnname                       = $borrower_pan_no_file->getClientOriginalName();
            $borrower_pan_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_aadhar_no_file')) {
            $borrower_aadhar_no_file                    = $request->file('borrower_aadhar_no_file');
            $name                       = $borrower_aadhar_no_file->getClientOriginalName();
            $borrower_aadhar_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_aadhar_no_file'               =>  $name
            ]);
        }

         if ($request->hasfile('bank_statement')) {
            $bank_statement                    = $request->file('bank_statement');
            $rhnname                       = $bank_statement->getClientOriginalName();
            $bank_statement->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement'               =>  $rhnname
            ]);
        }

         if ($request->hasfile('itr_file')) {
            $itr_file                    = $request->file('itr_file');
            $rhnname                       = $itr_file->getClientOriginalName();
            $itr_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'itr_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file                    = $request->file('borrower_cancel_cheque_file');
            $rhnname                       = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_cancel_cheque_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_dob_file')) {
            $co_borrower_nominee_dob_file                    = $request->file('co_borrower_nominee_dob_file');
            $rhnname                       = $co_borrower_nominee_dob_file->getClientOriginalName();
            $co_borrower_nominee_dob_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_dob_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_gender_file')) {
            $co_borrower_nominee_gender_file                    = $request->file('co_borrower_nominee_gender_file');
            $rhnname                       = $co_borrower_nominee_gender_file->getClientOriginalName();
            $co_borrower_nominee_gender_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_gender_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file                    = $request->file('co_borrower_other_documents_file');
            $rhnname                       = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_other_documents_file'               =>  $rhnname
            ]);
        }

        $rules = [
            'patient_id' => 'required',
            'claim_id' => 'required',
            'claimant_id' => 'required',
            'hospital_id' => 'required',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'hospital_city' => 'required',
            'hospital_state' => 'required',
            'hospital_pincode' => 'required',
            'patient_title' => 'required',
            'patient_firstname' => 'required',
            'patient_middlename' => 'required',
            'patient_lastname' => 'required',
            'is_patient_and_borrower_same' => 'required',
            'is_claimant_and_borrower_same' => ($request->is_patient_and_borrower_same == 'No') ? 'required' : [],
            'borrower_title' => 'required|max:25',
            'borrower_firstname' => 'required|max:25',
            'borrower_middlename' => 'required|max:25',
            'borrower_lastname' => 'required|max:25',
            'borrowers_relation_with_patient' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'borrower_address' => 'required|max:100',
            'borrower_city' => 'required',
            'borrower_state' => 'required|max:40',
            'borrower_pincode' => 'required',
            'borrower_id_proof' => 'required',
            'borrower_id_proof_file' => ($request->is_patient_and_borrower_same == '' || $request->is_patient_and_borrower_same == 'No' || empty($borrower->borrower_id_proof_file) ) ? 'required' : [],
            'borrower_mobile_no' => 'required|digits:10',
            // 'borrower_email_id' => 'required|email|max:45',
            'borrower_pan_no' => 'required|alpha_num|unique:borrowers|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u',
            'borrower_pan_no_file' => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_pan_no_file) ) ? 'required' : [],
            'borrower_aadhar_no' => 'required|alpha_num|size:12',
            'borrower_aadhar_no_file' => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_aadhar_no_file) ) ? 'required' : [],
            'borrower_cancel_cheque' => 'required',
            'borrower_cancel_cheque_file' => empty($borrower->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_personal_email_id' => 'required',
            'borrower_bank_name' => 'required|max:45',
            'borrower_bank_address' => 'required|max:80',
            'borrower_ac_no' => 'required|max:20',
            'borrower_ifs_code' => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                => 'Please Enter Patient Id',
            'claim_id.required'             => 'Please Enter Claim Id',
            'claimant_id.required'               => 'Please Enter Claimant Id',
            'hospital_id.required'          => 'Please Enter Hospital Id',
            'hospital_name.required'             => 'Please Enter Hospital Name',
            'hospital_address.required'            => 'Please Enter Hospital Address',
            'hospital_city.required'          => 'Please Enter Hospital City',
            'hospital_state.required'      => 'Please Enter Hospital State',
            'hospital_pincode.required'           => 'Please Enter Hospital Pincode',
            'patient_title.required'                     => 'Please Enter Patient Title',
            'patient_firstname.required'                 => 'Please Enter Patient Firstname',
            'patient_middlename.required'                       => 'Please Enter Patient Middlename',
            'patient_lastname.required'                    => 'Please Enter Patient Lastname',
            'is_patient_and_borrower_same.required'            => 'Please Enter Is Patient And Borrower Same',
            'is_claimant_and_borrower_same.required'            => 'Please Enter Is Claimant And Borrower Same',
            'borrower_title.required'                   => 'Please Enter Title',
            'borrower_firstname.required'        => 'Please Enter Firstname',
            'borrower_middlename.required'                 => 'Please Enter Middlename',
            'borrower_lastname.required'    => 'Please Enter Lastname',
            'borrowers_relation_with_patient.required'          => 'Please Enter Borrowers Relation With Patient',
            'gender.required'    => 'Please Enter Gender',
            'dob.required'          => 'Please Enter Dob',
            'borrower_address.required'        => 'Please Enter Address',
            'borrower_city.required'            => 'Please Enter City',
            'borrower_state.required'          => 'Please Enter State',
            'borrower_pincode.required'          => 'Please Enter Pincode',
            'borrower_id_proof.required'          => 'Please Enter Id Proof',
            'borrower_mobile_no.required'            => 'Please Enter Mobile No',
            // 'borrower_email_id.required'        => 'Please Enter Email Id',
            'borrower_official_email_id.required'          => 'Please Enter Official Email Id',
            'borrower_pan_no.required'              => 'Please Enter Pan No',
            'borrower_aadhar_no.required'              => 'Please Enter Aadhar No',
            'bank_statement.required'          => 'Please Enter Bank Statement',
            'itr.required'          => 'Please Enter Itr',
            'borrower_cancel_cheque.required'          => 'Please Enter Cancel Cheque',
            'borrower_personal_email_id.required'          => 'Please Enter Personal Email Id',
            'borrower_bank_name.required'          => 'Please Enter Bank Name',
            'borrower_bank_address.required'          => 'Please Enter Bank Address',
            'borrower_ac_no.required'          => 'Please Enter Bank Account No',
            'borrower_ifs_code.required'          => 'Please Enter Bank Ifs Code',
            'co_borrower_nominee_name.required'          => 'Please Enter Co Borrower Nominee Name',
            'co_borrower_nominee_dob.required'          => 'Please Enter Co Borrower Nominee Dob',
            'co_borrower_nominee_gender.required'          => 'Please Enter Co Borrower Nominee Gender',
            'co_borrower_nominee_relation.required'          => 'Please Enter Co Borrower Nominee Relation',
            'co_borrower_other_documents.required'          => 'Please Enter Co Borrower Other Documents',
            'borrower_estimated_amount.required'          => 'Please Enter Estimated Amount',
            'co_borrower_comments.required'          => 'Please Enter Co Borrower Comments',
        ];

        $this->validate($request, $rules, $messages);

        $borrower =  Borrower::updateOrCreate(
            [
                'claimant_id' => $id
            ],
            [
                'patient_id' => $request->patient_id,
                'claim_id' => $request->claim_id,
                // 'claimant_id' => $request->claimant_id,
                'hospital_id' => $request->hospital_id,
                'hospital_name' => $request->hospital_name,
                'hospital_address' => $request->hospital_address,
                'hospital_city' => $request->hospital_city,
                'hospital_state' => $request->hospital_state,
                'hospital_pincode' => $request->hospital_pincode,
                'patient_title' => $request->patient_title,
                'patient_firstname' => $request->patient_firstname,
                'patient_middlename' => $request->patient_middlename,
                'patient_lastname' => $request->patient_lastname,
                'is_patient_and_borrower_same' => $request->is_patient_and_borrower_same,
                'is_claimant_and_borrower_same' => $request->is_claimant_and_borrower_same,
                'borrower_title' => $request->borrower_title,
                'borrower_firstname' => $request->borrower_firstname,
                'borrower_middlename' => $request->borrower_middlename,
                'borrower_lastname' => $request->borrower_lastname,
                'borrowers_relation_with_patient' => $request->borrowers_relation_with_patient,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'borrower_address' => $request->borrower_address,
                'borrower_city' => $request->borrower_city,
                'borrower_state' => $request->borrower_state,
                'borrower_pincode' => $request->borrower_pincode,
                'borrower_id_proof' => $request->borrower_id_proof,
                'borrower_mobile_no' => $request->borrower_mobile_no,
                // 'borrower_email_id' => $request->borrower_email_id,
                'borrower_official_email_id' => $request->borrower_official_email_id,
                'borrower_pan_no' => $request->borrower_pan_no,
                'borrower_aadhar_no' => $request->borrower_aadhar_no,
                'bank_statement' => $request->bank_statement,
                'itr' => $request->itr,
                'borrower_cancel_cheque' => $request->borrower_cancel_cheque,
                'borrower_personal_email_id' => $request->borrower_personal_email_id,
                'borrower_bank_name' => $request->borrower_bank_name,
                'borrower_bank_address' => $request->borrower_bank_address,
                'borrower_ac_no' => $request->borrower_ac_no,
                'borrower_ifs_code' => $request->borrower_ifs_code,
                'co_borrower_nominee_name' => $request->co_borrower_nominee_name,
                'co_borrower_nominee_dob' => $request->co_borrower_nominee_dob,
                'co_borrower_nominee_gender' => $request->co_borrower_nominee_gender,
                'co_borrower_nominee_relation' => $request->co_borrower_nominee_relation,
                'co_borrower_other_documents' => $request->co_borrower_other_documents,
                'borrower_estimated_amount' => $request->borrower_estimated_amount,
                'co_borrower_comments' => $request->co_borrower_comments,
            ]);

        $claimant = Claimant::find($id);

        Borrower::where('claimant_id', $id)->update([
            'uid'      => 'BRO' . substr($claimant->pan_no, 0, 2) . substr($borrower->pan_no, -3)
        ]);

        return redirect()->route('admin.claimants.index')->with('success', 'Borrower created successfully');

    }

    public function fetchPaitientData(Request $request, $id)
    {
        $data = Patient::where("uid",$id)->first();
        return response()->json($data);
    }

    public function fetchClaimentData(Request $request, $id)
    {
        $data = Claimant::where("id",$id)->first();
        return response()->json($data);
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
