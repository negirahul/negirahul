<?php

namespace App\Http\Controllers\SuperAdmin\Claims;

use App\Http\Controllers\Controller;
use App\Models\Borrower;
use App\Models\Claim;
use App\Models\Claimant;
use App\Models\Insurer;
use App\Models\LendingStatus;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:super-admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_search = $request->search;

        $borrowers = Borrower::query();

        if($filter_search){
            $borrowers->where('patient_id', 'like','%' . $filter_search . '%');
        }

        $borrowers = $borrowers->orderBy('id', 'desc')->paginate(20);

        foreach ($borrowers as $key => $borrower) {

            $lending_status = LendingStatus::where('claim_id', $borrower->claim_id)->exists();

            if ($lending_status) {
                $lending_status = LendingStatus::where('claim_id', $borrower->claim_id)->value('id');
                $borrowers[$key]->lending_status = $lending_status;
            }else{
                $borrowers[$key]->lending_status = '';
            }
        }

        return view('super-admin.claims.borrowers.manage',  compact('borrowers', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $claimants = Claimant::with(['claim','patient'])->whereHas('claim', function ($query){
            $query->where('lending_required', 'Yes')->orWhere('lending_required', 'No');
        })
        ->leftJoin('borrowers','borrowers.claimant_id','claimants.id')
        ->whereNull('borrowers.claimant_id')
        ->select('claimants.*')
        ->get();

        /*$claims = Claim::with(['hospital','patient'])->where('lending_required', 'Yes')->orWhere('lending_required', 'No')
        ->leftJoin('borrowers','borrowers.claim_id','claims.id')
        ->whereNull('borrowers.claim_id')
        ->select('claims.*')
        ->get();*/

        $insurers        = Insurer::get();

        return view('super-admin.claims.borrowers.create.create', compact('claimants', 'insurers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id                                     = $request->claimantId;
        $claimant                               = Claimant::with('claim')->find($id);
        $borrower_exists                        = Borrower::where('claimant_id', $id)->exists();
        $borrower                               = $borrower_exists ? Borrower::where('claimant_id', $id)->first() : null;
        $rules                                  = [
            'patient_id'                        => 'required',
            'claim_id'                          => 'required',
            'claimant_id'                       => 'required',
            'hospital_id'                       => 'required',
            'hospital_name'                     => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            // 'patient_title'                     => 'required',
            'patient_firstname'                 => 'required|max:25',
            'patient_middlename'                => isset($request->patient_middlename) ? 'max:25' : '',
            'patient_lastname'                  => isset($request->patient_lastname) ? 'max:25' : '',
            'is_patient_and_borrower_same'      => 'required',
            'is_claimant_and_borrower_same'     => ($request->is_patient_and_borrower_same == 'No') ? 'required' : [],
            'borrower_title'                    => 'required|max:25',
            'borrower_firstname'                => 'required|max:25',
            'borrower_middlename'               => isset($request->borrower_middlename) ? 'max:25' : '',
            'borrower_lastname'                 => isset($request->borrower_lastname) ? 'max:25' : '',
            'borrowers_relation_with_patient'   => 'required',
            'gender'                            => 'required',
            'borrower_dob'                            => 'required',
            'borrower_address'                  => 'required|max:100',
            'borrower_city'                     => 'required',
            'borrower_state'                    => 'required|max:40',
            'borrower_pincode'                  => 'required',
            'borrower_id_proof'                 => 'required',
            'borrower_id_proof_file'            => (($request->is_patient_and_borrower_same == '' || $request->is_patient_and_borrower_same == 'No') && empty($borrower->borrower_id_proof_file) ) ? 'required' : [],
            'nature_of_income'                  => 'required',
            'organization'                      => 'required',
            // 'member_or_employer_id'             => 'required',
            'borrower_mobile_no'                => 'required|digits:10',
            'borrower_estimated_amount'         => 'required|digits_between:1,8',
            'borrower_pan_no'                   => isset($borrower) ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers,borrower_pan_no,'.$borrower->id : 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers',
            'borrower_pan_no_file'              => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_pan_no_file) ) ? 'required' : [],
            'borrower_aadhar_no'                => 'required|numeric|digits:12',
            'borrower_aadhar_no_file'           => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_aadhar_no_file) ) ? 'required' : [],
            'borrower_cancel_cheque'            => 'required',
             'borrower_cancel_cheque_file'       => ($request->borrower_cancel_cheque != 'No' && empty($borrower->borrower_cancel_cheque_file)) ? 'required' : [],
            'borrower_personal_email_id'        => 'required',
            'borrower_bank_name'                => 'required|max:45',
            'borrower_bank_address'             => 'required|max:80',
            'borrower_ac_no'                    => 'required|max:20',
            'borrower_ifs_code'                 => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                       => 'Please Enter Patient Id',
            'claim_id.required'                         => 'Please Enter Claim Id',
            'claimant_id.required'                      => 'Please Enter Claimant Id',
            'hospital_id.required'                      => 'Please Enter Hospital Id',
            'hospital_name.required'                    => 'Please Enter Hospital Name',
            'hospital_address.required'                 => 'Please Enter Hospital Address',
            'hospital_city.required'                    => 'Please Enter Hospital City',
            'hospital_state.required'                   => 'Please Enter Hospital State',
            'hospital_pincode.required'                 => 'Please Enter Hospital Pincode',
            'patient_title.required'                    => 'Please Enter Patient Title',
            'patient_firstname.required'                => 'Please Enter Patient Firstname',
            'patient_middlename.required'               => 'Please Enter Patient Middlename',
            'patient_lastname.required'                 => 'Please Enter Patient Lastname',
            'is_patient_and_borrower_same.required'     => 'Please Enter Is Patient And Borrower Same',
            'is_claimant_and_borrower_same.required'    => 'Please Enter Is Claimant And Borrower Same',
            'borrower_title.required'                   => 'Please Enter Title',
            'borrower_firstname.required'               => 'Please Enter Firstname',
            'borrower_middlename.required'              => 'Please Enter Middlename',
            'borrower_lastname.required'                => 'Please Enter Lastname',
            'borrowers_relation_with_patient.required'  => 'Please Enter Borrowers Relation With Patient',
            'gender.required'                           => 'Please Enter Gender',
            'borrower_dob.required'                              => 'Please Enter Date of birth',
            'borrower_address.required'                 => 'Please Enter Address',
            'borrower_city.required'                    => 'Please Enter City',
            'borrower_state.required'                   => 'Please Enter State',
            'borrower_pincode.required'                 => 'Please Enter Pincode',
            'borrower_id_proof.required'                => 'Please Enter Id Proof',
            'nature_of_income.required'                 => 'Please select nature of Income',
            'organization.required'                     => 'Please enter name of organization',
            'member_or_employer_id.required'            => 'Please enter Member ID No./Employee ID (Client ID)',
            'borrower_mobile_no.required'               => 'Please Enter Mobile No',
            'borrower_official_email_id.required'       => 'Please Enter Official Email Id',
            'borrower_pan_no.required'                  => 'Please Enter Pan No',
            'borrower_aadhar_no.required'               => 'Please Enter Aadhar No',
            'bank_statement.required'                   => 'Please Enter Bank Statement',
            'itr.required'                              => 'Please Enter Itr',
            'borrower_cancel_cheque.required'           => 'Please Enter Cancel Cheque',
            'borrower_personal_email_id.required'       => 'Please Enter Personal Email Id',
            'borrower_bank_name.required'               => 'Please Enter Bank Name',
            'borrower_bank_address.required'            => 'Please Enter Bank Address',
            'borrower_ac_no.required'                   => 'Please Enter Bank Account No',
            'borrower_ifs_code.required'                => 'Please Enter Bank Ifs Code',
            'co_borrower_nominee_name.required'         => 'Please Enter Co Borrower Nominee Name',
            'co_borrower_nominee_dob.required'          => 'Please Enter Co Borrower Nominee Dob',
            'co_borrower_nominee_gender.required'       => 'Please Enter Co Borrower Nominee Gender',
            'co_borrower_nominee_relation.required'     => 'Please Enter Co Borrower Nominee Relation',
            'co_borrower_other_documents.required'      => 'Please Enter Co Borrower Other Documents',
            'borrower_estimated_amount.required'        => 'Please Enter Estimated Amount',
            'co_borrower_comments.required'             => 'Please Enter Co Borrower Comments',
        ];

        $this->validate($request, $rules, $messages);


        $borrower = Borrower::updateOrCreate([
            'claimant_id'                       => $id
        ],
        [
            'patient_id'                        => $claimant->patient_id,
            'claim_id'                          => $claimant->claim_id,
            'hospital_id'                       => $claimant->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'hospital_pincode'                  => $request->hospital_pincode,
            'patient_title'                     => $request->patient_title,
            'patient_firstname'                 => $request->patient_firstname,
            'patient_middlename'                => $request->patient_middlename,
            'patient_lastname'                  => $request->patient_lastname,
            'is_patient_and_borrower_same'      => $request->is_patient_and_borrower_same,
            'is_claimant_and_borrower_same'     => $request->is_claimant_and_borrower_same,
            'borrower_title'                    => $request->borrower_title,
            'borrower_firstname'                => $request->borrower_firstname,
            'borrower_middlename'               => $request->borrower_middlename,
            'borrower_lastname'                 => $request->borrower_lastname,
            'borrowers_relation_with_patient'   => $request->borrowers_relation_with_patient,
            'gender'                            => $request->gender,
            'borrower_dob'                      => $request->borrower_dob,
            'borrower_address'                  => $request->borrower_address,
            'borrower_city'                     => $request->borrower_city,
            'borrower_state'                    => $request->borrower_state,
            'borrower_pincode'                  => $request->borrower_pincode,
            'borrower_id_proof'                 => $request->borrower_id_proof,
            'nature_of_income'                  => $request->nature_of_income,
            'organization'                      => $request->organization,
            'member_or_employer_id'             => $request->member_or_employer_id,
            'borrower_mobile_no'                => $request->borrower_mobile_no,
            'borrower_official_email_id'        => $request->borrower_official_email_id,
            'borrower_pan_no'                   => $request->borrower_pan_no,
            'borrower_aadhar_no'                => $request->borrower_aadhar_no,
            'bank_statement'                    => $request->bank_statement,
            'itr'                               => $request->itr,
            'borrower_cancel_cheque'            => $request->borrower_cancel_cheque,
            'borrower_personal_email_id'        => $request->borrower_personal_email_id,
            'borrower_bank_name'                => $request->borrower_bank_name,
            'borrower_bank_address'             => $request->borrower_bank_address,
            'borrower_ac_no'                    => $request->borrower_ac_no,
            'borrower_ifs_code'                 => $request->borrower_ifs_code,
            'co_borrower_nominee_name'          => $request->co_borrower_nominee_name,
            'co_borrower_nominee_dob'           => $request->co_borrower_nominee_dob,
            'co_borrower_nominee_gender'        => $request->co_borrower_nominee_gender,
            'co_borrower_nominee_relation'      => $request->co_borrower_nominee_relation,
            'co_borrower_other_documents'       => $request->co_borrower_other_documents,
            'borrower_estimated_amount'         => $request->borrower_estimated_amount,
            'co_borrower_comments'              => $request->co_borrower_comments,
        ]);

        if ($request->hasfile('member_or_employer_id_file')) {
            $member_or_employer_id_file                    = $request->file('member_or_employer_id_file');
            $rhnname                                             = $member_or_employer_id_file->getClientOriginalName();
            $member_or_employer_id_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'member_or_employer_id_file'               =>  $rhnname
            ]);
        }

         if ($request->hasfile('borrower_id_proof_file')) {
            $borrower_id_proof_file                     = $request->file('borrower_id_proof_file');
            $name                                       = $borrower_id_proof_file->getClientOriginalName();
            $borrower_id_proof_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_id_proof_file'               =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_no_file')) {
            $borrower_pan_no_file                    = $request->file('borrower_pan_no_file');
            $rhnname                                 = $borrower_pan_no_file->getClientOriginalName();
            $borrower_pan_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('bank_statement_file')) {
            $bank_statement_file                    = $request->file('bank_statement_file');
            $rhnname                                 = $bank_statement_file->getClientOriginalName();
            $bank_statement_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_aadhar_no_file')) {
            $borrower_aadhar_no_file                    = $request->file('borrower_aadhar_no_file');
            $name                                       = $borrower_aadhar_no_file->getClientOriginalName();
            $borrower_aadhar_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_aadhar_no_file'               =>  $name
            ]);
        }

         if ($request->hasfile('bank_statement')) {
            $bank_statement                     = $request->file('bank_statement');
            $rhnname                            = $bank_statement->getClientOriginalName();
            $bank_statement->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement'               =>  $rhnname
            ]);
        }

         if ($request->hasfile('itr_file')) {
            $itr_file                       = $request->file('itr_file');
            $rhnname                        = $itr_file->getClientOriginalName();
            $itr_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'itr_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file                    = $request->file('borrower_cancel_cheque_file');
            $rhnname                                        = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_cancel_cheque_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_dob_file')) {
            $co_borrower_nominee_dob_file                    = $request->file('co_borrower_nominee_dob_file');
            $rhnname                                         = $co_borrower_nominee_dob_file->getClientOriginalName();
            $co_borrower_nominee_dob_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_dob_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_gender_file')) {
            $co_borrower_nominee_gender_file                    = $request->file('co_borrower_nominee_gender_file');
            $rhnname                                            = $co_borrower_nominee_gender_file->getClientOriginalName();
            $co_borrower_nominee_gender_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_gender_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file                    = $request->file('co_borrower_other_documents_file');
            $rhnname                                             = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_other_documents_file'               =>  $rhnname
            ]);
        }

        Borrower::where('id', $borrower->id)->update([
            'uid'      => 'BRO' . substr($borrower->borrower_pan_no, 0, 2) . substr($borrower->borrower_pan_no, -3)
        ]);

        return redirect(route('super-admin.borrowers.index'))->with('success', 'Borrower Details created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $claimant        = Claimant::with('claim')->find($id);
        $borrower_exists = Borrower::where('claimant_id', $id)->exists();
        $borrower        = $borrower_exists ? Borrower::where('claimant_id', $id)->first() : null;
        $insurers        = Insurer::get();
        
        return view('super-admin.claims.claimants.edit.borrower', compact('claimant', 'borrower', 'insurers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $claim           = Claim::with(['patient', 'hospital'])->find($id);
        $claimant_exists = Claimant::where('claim_id', $id)->exists();
        $claimant        = $claimant_exists ? Claimant::where('claim_id', $id)->first() : null;
        $borrower_exists = Borrower::where('claim_id', $id)->exists();
        $borrower        = $borrower_exists ? Borrower::where('claim_id', $id)->first() : null;
        $insurers        = Insurer::get();
        
        return view('super-admin.claims.borrowers.create', compact('claim', 'borrower', 'insurers', 'claimant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateBorrower(Request $request, $id)
    {
       
        $claim                                  = Claim::with('patient')->find($id);
        $borrower_exists                        = Borrower::where('claim_id', $id)->exists();
        $borrower                               = $borrower_exists ? Borrower::where('claim_id', $id)->first() : null;
        $rules                                  = [
            'patient_id'                        => 'required',
            'claim_id'                          => 'required',
            'hospital_id'                       => 'required',
            'hospital_name'                     => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            'patient_title'                     => 'required',
            'patient_firstname'                 => 'required|max:25',
            'patient_middlename'                => isset($request->patient_middlename) ? 'max:25' : '',
            'patient_lastname'                  => isset($request->patient_lastname) ? 'max:25' : '',
            'is_patient_and_borrower_same'      => 'required',
            'is_claimant_and_borrower_same'     => ($request->is_patient_and_borrower_same == 'No') ? 'required' : [],
            'borrower_title'                    => 'required|max:25',
            'borrower_firstname'                => 'required|max:25',
            'borrower_middlename'               => isset($request->borrower_middlename) ? 'max:25' : '',
            'borrower_lastname'                 => isset($request->borrower_lastname) ? 'max:25' : '',
            'borrowers_relation_with_patient'   => 'required',
            'gender'                            => 'required',
            'borrower_dob'                      => 'required',
            'borrower_address'                  => 'required|max:100',
            'borrower_city'                     => 'required',
            'borrower_state'                    => 'required|max:40',
            'borrower_pincode'                  => 'required',
            'borrower_id_proof'                 => 'required',
            //'borrower_id_proof_file'            => (($request->is_patient_and_borrower_same == '' || $request->is_patient_and_borrower_same == 'No') && empty($borrower->borrower_id_proof_file) ) ? 'required' : [],
            'nature_of_income'                  => 'required',
            'organization'                      => 'required',
            'borrower_mobile_no'                => 'required|digits:10',
            'borrower_estimated_amount'         => 'required|digits_between:1,8',
            'borrower_pan_no'                   => isset($borrower) ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers,borrower_pan_no,'.$borrower->id : 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers',
            //'borrower_pan_no_file'              => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_pan_no_file) ) ? 'required' : [],
            'borrower_aadhar_no'                => 'required|numeric|digits:12',
            //'borrower_aadhar_no_file'           => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_aadhar_no_file) ) ? 'required' : [],
            'borrower_cancel_cheque'            => 'required',
            //'borrower_cancel_cheque_file'       => ($request->borrower_cancel_cheque != 'No' && empty($borrower->borrower_cancel_cheque_file)) ? 'required' : [],
            'borrower_personal_email_id'        => 'required',
            'borrower_bank_name'                => 'required|max:45',
            'borrower_bank_address'             => 'required|max:80',
            'borrower_ac_no'                    => 'required|max:20',
            'borrower_ifs_code'                 => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                       => 'Please Enter Patient Id',
            'claim_id.required'                         => 'Please Enter Claim Id',
            'claimant_id.required'                      => 'Please Enter Claimant Id',
            'hospital_id.required'                      => 'Please Enter Hospital Id',
            'hospital_name.required'                    => 'Please Enter Hospital Name',
            'hospital_address.required'                 => 'Please Enter Hospital Address',
            'hospital_city.required'                    => 'Please Enter Hospital City',
            'hospital_state.required'                   => 'Please Enter Hospital State',
            'hospital_pincode.required'                 => 'Please Enter Hospital Pincode',
            'patient_title.required'                    => 'Please Enter Patient Title',
            'patient_firstname.required'                => 'Please Enter Patient Firstname',
            'patient_middlename.required'               => 'Please Enter Patient Middlename',
            'patient_lastname.required'                 => 'Please Enter Patient Lastname',
            'is_patient_and_borrower_same.required'     => 'Please Enter Is Patient And Borrower Same',
            'is_claimant_and_borrower_same.required'    => 'Please Enter Is Claimant And Borrower Same',
            'borrower_title.required'                   => 'Please Enter Title',
            'borrower_firstname.required'               => 'Please Enter Firstname',
            'borrower_middlename.required'              => 'Please Enter Middlename',
            'borrower_lastname.required'                => 'Please Enter Lastname',
            'borrowers_relation_with_patient.required'  => 'Please Enter Borrowers Relation With Patient',
            'gender.required'                           => 'Please Enter Gender',
            'borrower_dob.required'                              => 'Please Enter Date of birth',
            'borrower_address.required'                 => 'Please Enter Address',
            'borrower_city.required'                    => 'Please Enter City',
            'borrower_state.required'                   => 'Please Enter State',
            'borrower_pincode.required'                 => 'Please Enter Pincode',
            'borrower_id_proof.required'                => 'Please Enter Id Proof',
            'nature_of_income.required'                 => 'Please select nature of Income',
            'organization.required'                     => 'Please enter name of organization',
            'member_or_employer_id.required'            => 'Please enter Member ID No./Employee ID (Client ID)',
            'borrower_mobile_no.required'               => 'Please Enter Mobile No',
            'borrower_official_email_id.required'       => 'Please Enter Official Email Id',
            'borrower_pan_no.required'                  => 'Please Enter Pan No',
            'borrower_aadhar_no.required'               => 'Please Enter Aadhar No',
            'bank_statement.required'                   => 'Please Enter Bank Statement',
            'itr.required'                              => 'Please Enter Itr',
            'borrower_cancel_cheque.required'           => 'Please Enter Cancel Cheque',
            'borrower_personal_email_id.required'       => 'Please Enter Personal Email Id',
            'borrower_bank_name.required'               => 'Please Enter Bank Name',
            'borrower_bank_address.required'            => 'Please Enter Bank Address',
            'borrower_ac_no.required'                   => 'Please Enter Bank Account No',
            'borrower_ifs_code.required'                => 'Please Enter Bank Ifs Code',
            'co_borrower_nominee_name.required'         => 'Please Enter Co Borrower Nominee Name',
            'co_borrower_nominee_dob.required'          => 'Please Enter Co Borrower Nominee Dob',
            'co_borrower_nominee_gender.required'       => 'Please Enter Co Borrower Nominee Gender',
            'co_borrower_nominee_relation.required'     => 'Please Enter Co Borrower Nominee Relation',
            'co_borrower_other_documents.required'      => 'Please Enter Co Borrower Other Documents',
            'borrower_estimated_amount.required'        => 'Please Enter Estimated Amount',
            'co_borrower_comments.required'             => 'Please Enter Co Borrower Comments',
        ];

        $this->validate($request, $rules, $messages);

        $claimant_exists        = Claimant::where('claim_id', $id)->exists();
        $claimant        = $claimant_exists ? Claimant::where('claim_id', $id)->first() : null;

        $borrower = Borrower::updateOrCreate([
            'claim_id'                       => $id
        ],
        [
            'patient_id'                        => $claim->patient_id,
            'claimant_id'                        => @$claimant->id,
            'hospital_id'                       => $claim->patient->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'hospital_pincode'                  => $request->hospital_pincode,
            'patient_title'                     => $request->patient_title,
            'patient_firstname'                 => $request->patient_firstname,
            'patient_middlename'                => $request->patient_middlename,
            'patient_lastname'                  => $request->patient_lastname,
            'is_patient_and_borrower_same'      => $request->is_patient_and_borrower_same,
            'is_claimant_and_borrower_same'     => $request->is_claimant_and_borrower_same,
            'borrower_title'                    => $request->borrower_title,
            'borrower_firstname'                => $request->borrower_firstname,
            'borrower_middlename'               => $request->borrower_middlename,
            'borrower_lastname'                 => $request->borrower_lastname,
            'borrowers_relation_with_patient'   => $request->borrowers_relation_with_patient,
            'gender'                            => $request->gender,
            'borrower_dob'                      => $request->borrower_dob,
            'borrower_address'                  => $request->borrower_address,
            'borrower_city'                     => $request->borrower_city,
            'borrower_state'                    => $request->borrower_state,
            'borrower_pincode'                  => $request->borrower_pincode,
            'borrower_id_proof'                 => $request->borrower_id_proof,
            'nature_of_income'                  => $request->nature_of_income,
            'organization'                      => $request->organization,
            'member_or_employer_id'             => $request->member_or_employer_id,
            'borrower_mobile_no'                => $request->borrower_mobile_no,
            'borrower_official_email_id'        => $request->borrower_official_email_id,
            'borrower_pan_no'                   => $request->borrower_pan_no,
            'borrower_aadhar_no'                => $request->borrower_aadhar_no,
            'bank_statement'                    => $request->bank_statement,
            'itr'                               => $request->itr,
            'borrower_cancel_cheque'            => $request->borrower_cancel_cheque,
            'borrower_personal_email_id'        => $request->borrower_personal_email_id,
            'borrower_bank_name'                => $request->borrower_bank_name,
            'borrower_bank_address'             => $request->borrower_bank_address,
            'borrower_ac_no'                    => $request->borrower_ac_no,
            'borrower_ifs_code'                 => $request->borrower_ifs_code,
            'co_borrower_nominee_name'          => $request->co_borrower_nominee_name,
            'co_borrower_nominee_dob'           => $request->co_borrower_nominee_dob,
            'co_borrower_nominee_gender'        => $request->co_borrower_nominee_gender,
            'co_borrower_nominee_relation'      => $request->co_borrower_nominee_relation,
            'co_borrower_other_documents'       => $request->co_borrower_other_documents,
            'borrower_estimated_amount'         => $request->borrower_estimated_amount,
            'co_borrower_comments'              => $request->co_borrower_comments,
        ]);

        if ($request->hasfile('borrower_id_proof_file')) {
            $borrower_id_proof_file                     = $request->file('borrower_id_proof_file');
            $name                                       = $borrower_id_proof_file->getClientOriginalName();
            $borrower_id_proof_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_id_proof_file'               =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_no_file')) {
            $borrower_pan_no_file                    = $request->file('borrower_pan_no_file');
            $rhnname                                 = $borrower_pan_no_file->getClientOriginalName();
            $borrower_pan_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('bank_statement_file')) {
            $bank_statement_file                    = $request->file('bank_statement_file');
            $rhnname                                 = $bank_statement_file->getClientOriginalName();
            $bank_statement_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_aadhar_no_file')) {
            $borrower_aadhar_no_file                    = $request->file('borrower_aadhar_no_file');
            $name                                       = $borrower_aadhar_no_file->getClientOriginalName();
            $borrower_aadhar_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_aadhar_no_file'               =>  $name
            ]);
        }

         if ($request->hasfile('bank_statement')) {
            $bank_statement                     = $request->file('bank_statement');
            $rhnname                            = $bank_statement->getClientOriginalName();
            $bank_statement->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement'               =>  $rhnname
            ]);
        }

         if ($request->hasfile('itr_file')) {
            $itr_file                       = $request->file('itr_file');
            $rhnname                        = $itr_file->getClientOriginalName();
            $itr_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'itr_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file                    = $request->file('borrower_cancel_cheque_file');
            $rhnname                                        = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_cancel_cheque_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_dob_file')) {
            $co_borrower_nominee_dob_file                    = $request->file('co_borrower_nominee_dob_file');
            $rhnname                                         = $co_borrower_nominee_dob_file->getClientOriginalName();
            $co_borrower_nominee_dob_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_dob_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_gender_file')) {
            $co_borrower_nominee_gender_file                    = $request->file('co_borrower_nominee_gender_file');
            $rhnname                                            = $co_borrower_nominee_gender_file->getClientOriginalName();
            $co_borrower_nominee_gender_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_gender_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file                    = $request->file('co_borrower_other_documents_file');
            $rhnname                                             = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_other_documents_file'               =>  $rhnname
            ]);
        }
        
        if ($request->hasfile('member_or_employer_id_file')) {
            $member_or_employer_id_file                    = $request->file('member_or_employer_id_file');
            $rhnname                                             = $member_or_employer_id_file->getClientOriginalName();
            $member_or_employer_id_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'member_or_employer_id_file'               =>  $rhnname
            ]);
        }

        Borrower::where('id', $borrower->id)->update([
            'uid'      => 'BRO' . substr($borrower->borrower_pan_no, 0, 2) . substr($borrower->borrower_pan_no, -3)
        ]);

        return redirect()->back()->with('success', 'Borrower Details updated successfully');
    }

    public function update(Request $request, $id)
    {
       
        $claimant                               = Claimant::with('claim')->find($id);
        $borrower_exists                        = Borrower::where('claimant_id', $id)->exists();
        $borrower                               = $borrower_exists ? Borrower::where('claimant_id', $id)->first() : null;
        $rules                                  = [
            'patient_id'                        => 'required',
            'claim_id'                          => 'required',
            'claimant_id'                       => 'required',
            'hospital_id'                       => 'required',
            'hospital_name'                     => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            'patient_title'                     => 'required',
            'patient_firstname'                 => 'required|max:25',
            'patient_middlename'                => isset($request->patient_middlename) ? 'max:25' : '',
            'patient_lastname'                  => isset($request->patient_lastname) ? 'max:25' : '',
            'is_patient_and_borrower_same'      => 'required',
            'is_claimant_and_borrower_same'     => ($request->is_patient_and_borrower_same == 'No') ? 'required' : [],
            'borrower_title'                    => 'required|max:25',
            'borrower_firstname'                => 'required|max:25',
            'borrower_middlename'               => isset($request->borrower_middlename) ? 'max:25' : '',
            'borrower_lastname'                 => isset($request->borrower_lastname) ? 'max:25' : '',
            'borrowers_relation_with_patient'   => 'required',
            'gender'                            => 'required',
            'borrower_dob'                      => 'required',
            'borrower_address'                  => 'required|max:100',
            'borrower_city'                     => 'required',
            'borrower_state'                    => 'required|max:40',
            'borrower_pincode'                  => 'required',
            'borrower_id_proof'                 => 'required',
          //  'borrower_id_proof_file'            => (($request->is_patient_and_borrower_same == '' || $request->is_patient_and_borrower_same == 'No') && empty($borrower->borrower_id_proof_file) ) ? 'required' : [],
            'nature_of_income'                  => 'required',
            'organization'                      => 'required',
            'borrower_mobile_no'                => 'required|digits:10',
            'borrower_estimated_amount'         => 'required|digits_between:1,8',
            'borrower_pan_no'                   => isset($borrower) ? 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers,borrower_pan_no,'.$borrower->id : 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:borrowers',
          //  'borrower_pan_no_file'              => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_pan_no_file) ) ? 'required' : [],
            'borrower_aadhar_no'                => 'required|numeric|digits:12',
          //  'borrower_aadhar_no_file'           => (($request->is_claimant_and_borrower_same == '' || $request->is_claimant_and_borrower_same == 'No') && empty($borrower->borrower_aadhar_no_file) ) ? 'required' : [],
            'borrower_cancel_cheque'            => 'required',
          //  'borrower_cancel_cheque_file'       => ($request->borrower_cancel_cheque != 'No' && empty($borrower->borrower_cancel_cheque_file)) ? 'required' : [],
            'borrower_personal_email_id'        => 'required',
            'borrower_bank_name'                => 'required|max:45',
            'borrower_bank_address'             => 'required|max:80',
            'borrower_ac_no'                    => 'required|max:20',
            'borrower_ifs_code'                 => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                       => 'Please Enter Patient Id',
            'claim_id.required'                         => 'Please Enter Claim Id',
            'claimant_id.required'                      => 'Please Enter Claimant Id',
            'hospital_id.required'                      => 'Please Enter Hospital Id',
            'hospital_name.required'                    => 'Please Enter Hospital Name',
            'hospital_address.required'                 => 'Please Enter Hospital Address',
            'hospital_city.required'                    => 'Please Enter Hospital City',
            'hospital_state.required'                   => 'Please Enter Hospital State',
            'hospital_pincode.required'                 => 'Please Enter Hospital Pincode',
            'patient_title.required'                    => 'Please Enter Patient Title',
            'patient_firstname.required'                => 'Please Enter Patient Firstname',
            'patient_middlename.required'               => 'Please Enter Patient Middlename',
            'patient_lastname.required'                 => 'Please Enter Patient Lastname',
            'is_patient_and_borrower_same.required'     => 'Please Enter Is Patient And Borrower Same',
            'is_claimant_and_borrower_same.required'    => 'Please Enter Is Claimant And Borrower Same',
            'borrower_title.required'                   => 'Please Enter Title',
            'borrower_firstname.required'               => 'Please Enter Firstname',
            'borrower_middlename.required'              => 'Please Enter Middlename',
            'borrower_lastname.required'                => 'Please Enter Lastname',
            'borrowers_relation_with_patient.required'  => 'Please Enter Borrowers Relation With Patient',
            'gender.required'                           => 'Please Enter Gender',
            'borrower_dob.required'                              => 'Please Enter Date of birth',
            'borrower_address.required'                 => 'Please Enter Address',
            'borrower_city.required'                    => 'Please Enter City',
            'borrower_state.required'                   => 'Please Enter State',
            'borrower_pincode.required'                 => 'Please Enter Pincode',
            'borrower_id_proof.required'                => 'Please Enter Id Proof',
            'nature_of_income.required'                 => 'Please select nature of Income',
            'organization.required'                     => 'Please enter name of organization',
            'member_or_employer_id.required'            => 'Please enter Member ID No./Employee ID (Client ID)',
            'borrower_mobile_no.required'               => 'Please Enter Mobile No',
            'borrower_official_email_id.required'       => 'Please Enter Official Email Id',
            'borrower_pan_no.required'                  => 'Please Enter Pan No',
            'borrower_aadhar_no.required'               => 'Please Enter Aadhar No',
            'bank_statement.required'                   => 'Please Enter Bank Statement',
            'itr.required'                              => 'Please Enter Itr',
            'borrower_cancel_cheque.required'           => 'Please Enter Cancel Cheque',
            'borrower_personal_email_id.required'       => 'Please Enter Personal Email Id',
            'borrower_bank_name.required'               => 'Please Enter Bank Name',
            'borrower_bank_address.required'            => 'Please Enter Bank Address',
            'borrower_ac_no.required'                   => 'Please Enter Bank Account No',
            'borrower_ifs_code.required'                => 'Please Enter Bank Ifs Code',
            'co_borrower_nominee_name.required'         => 'Please Enter Co Borrower Nominee Name',
            'co_borrower_nominee_dob.required'          => 'Please Enter Co Borrower Nominee Dob',
            'co_borrower_nominee_gender.required'       => 'Please Enter Co Borrower Nominee Gender',
            'co_borrower_nominee_relation.required'     => 'Please Enter Co Borrower Nominee Relation',
            'co_borrower_other_documents.required'      => 'Please Enter Co Borrower Other Documents',
            'borrower_estimated_amount.required'        => 'Please Enter Estimated Amount',
            'co_borrower_comments.required'             => 'Please Enter Co Borrower Comments',
        ];

        $this->validate($request, $rules, $messages);


        $borrower = Borrower::updateOrCreate([
            'claimant_id'                       => $id
        ],
        [
            'patient_id'                        => $claimant->patient_id,
            'claim_id'                          => $claimant->claim_id,
            'hospital_id'                       => $claimant->hospital_id,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'hospital_pincode'                  => $request->hospital_pincode,
            'patient_title'                     => $request->patient_title,
            'patient_firstname'                 => $request->patient_firstname,
            'patient_middlename'                => $request->patient_middlename,
            'patient_lastname'                  => $request->patient_lastname,
            'is_patient_and_borrower_same'      => $request->is_patient_and_borrower_same,
            'is_claimant_and_borrower_same'     => $request->is_claimant_and_borrower_same,
            'borrower_title'                    => $request->borrower_title,
            'borrower_firstname'                => $request->borrower_firstname,
            'borrower_middlename'               => $request->borrower_middlename,
            'borrower_lastname'                 => $request->borrower_lastname,
            'borrowers_relation_with_patient'   => $request->borrowers_relation_with_patient,
            'gender'                            => $request->gender,
            'borrower_dob'                      => $request->borrower_dob,
            'borrower_address'                  => $request->borrower_address,
            'borrower_city'                     => $request->borrower_city,
            'borrower_state'                    => $request->borrower_state,
            'borrower_pincode'                  => $request->borrower_pincode,
            'borrower_id_proof'                 => $request->borrower_id_proof,
            'nature_of_income'                  => $request->nature_of_income,
            'organization'                      => $request->organization,
            'member_or_employer_id'             => $request->member_or_employer_id,
            'borrower_mobile_no'                => $request->borrower_mobile_no,
            'borrower_official_email_id'        => $request->borrower_official_email_id,
            'borrower_pan_no'                   => $request->borrower_pan_no,
            'borrower_aadhar_no'                => $request->borrower_aadhar_no,
            'bank_statement'                    => $request->bank_statement,
            'itr'                               => $request->itr,
            'borrower_cancel_cheque'            => $request->borrower_cancel_cheque,
            'borrower_personal_email_id'        => $request->borrower_personal_email_id,
            'borrower_bank_name'                => $request->borrower_bank_name,
            'borrower_bank_address'             => $request->borrower_bank_address,
            'borrower_ac_no'                    => $request->borrower_ac_no,
            'borrower_ifs_code'                 => $request->borrower_ifs_code,
            'co_borrower_nominee_name'          => $request->co_borrower_nominee_name,
            'co_borrower_nominee_dob'           => $request->co_borrower_nominee_dob,
            'co_borrower_nominee_gender'        => $request->co_borrower_nominee_gender,
            'co_borrower_nominee_relation'      => $request->co_borrower_nominee_relation,
            'co_borrower_other_documents'       => $request->co_borrower_other_documents,
            'borrower_estimated_amount'         => $request->borrower_estimated_amount,
            'co_borrower_comments'              => $request->co_borrower_comments,
        ]);

        if ($request->hasfile('borrower_id_proof_file')) {
            $borrower_id_proof_file                     = $request->file('borrower_id_proof_file');
            $name                                       = $borrower_id_proof_file->getClientOriginalName();
            $borrower_id_proof_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_id_proof_file'               =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_no_file')) {
            $borrower_pan_no_file                    = $request->file('borrower_pan_no_file');
            $rhnname                                 = $borrower_pan_no_file->getClientOriginalName();
            $borrower_pan_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_pan_no_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('bank_statement_file')) {
            $bank_statement_file                    = $request->file('bank_statement_file');
            $rhnname                                 = $bank_statement_file->getClientOriginalName();
            $bank_statement_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_aadhar_no_file')) {
            $borrower_aadhar_no_file                    = $request->file('borrower_aadhar_no_file');
            $name                                       = $borrower_aadhar_no_file->getClientOriginalName();
            $borrower_aadhar_no_file->storeAs('uploads/borrower/' . $borrower->id . '/', $name, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_aadhar_no_file'               =>  $name
            ]);
        }

         if ($request->hasfile('bank_statement')) {
            $bank_statement                     = $request->file('bank_statement');
            $rhnname                            = $bank_statement->getClientOriginalName();
            $bank_statement->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'bank_statement'               =>  $rhnname
            ]);
        }

         if ($request->hasfile('itr_file')) {
            $itr_file                       = $request->file('itr_file');
            $rhnname                        = $itr_file->getClientOriginalName();
            $itr_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'itr_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file                    = $request->file('borrower_cancel_cheque_file');
            $rhnname                                        = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'borrower_cancel_cheque_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_dob_file')) {
            $co_borrower_nominee_dob_file                    = $request->file('co_borrower_nominee_dob_file');
            $rhnname                                         = $co_borrower_nominee_dob_file->getClientOriginalName();
            $co_borrower_nominee_dob_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_dob_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_nominee_gender_file')) {
            $co_borrower_nominee_gender_file                    = $request->file('co_borrower_nominee_gender_file');
            $rhnname                                            = $co_borrower_nominee_gender_file->getClientOriginalName();
            $co_borrower_nominee_gender_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_nominee_gender_file'               =>  $rhnname
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file                    = $request->file('co_borrower_other_documents_file');
            $rhnname                                             = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'co_borrower_other_documents_file'               =>  $rhnname
            ]);
        }
        
        if ($request->hasfile('member_or_employer_id_file')) {
            $member_or_employer_id_file                    = $request->file('member_or_employer_id_file');
            $rhnname                                             = $member_or_employer_id_file->getClientOriginalName();
            $member_or_employer_id_file->storeAs('uploads/borrower/' . $borrower->id . '/', $rhnname, 'public');
            Borrower::where('id', $borrower->id)->update([
                'member_or_employer_id_file'               =>  $rhnname
            ]);
        }

        Borrower::where('id', $borrower->id)->update([
            'uid'      => 'BRO' . substr($borrower->borrower_pan_no, 0, 2) . substr($borrower->borrower_pan_no, -3)
        ]);

        return redirect()->back()->with('success', 'Borrower Details updated successfully');
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
