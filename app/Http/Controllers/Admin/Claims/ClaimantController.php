<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Claimant;
use App\Models\ICClaimStatus;
use App\Models\Patient;
use Illuminate\Http\Request;

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
        $filter_search  = $request->search;
        $claimants      = Claimant::query();

        if ($filter_search) {
            $claimants->whereHas('patient', function ($q) use ($filter_search) {
                $q->where(function ($q) use ($filter_search) {
                    $q->where('uid', 'like', '%' . $filter_search . '%');
                });
            });
        }

        $claimants      = $claimants->orderBy('id', 'desc')->paginate(20);

        foreach ($claimants as $key => $claimant) {

            $icclaim_status = ICClaimStatus::where('claimant_id', $claimant->id)->exists();

            if ($icclaim_status) {
                $icclaim_status = ICClaimStatus::where('claimant_id', $claimant->id)->value('id');
                $claimants[$key]->icclaim_status = $icclaim_status;
            }else{
                $claimants[$key]->icclaim_status = '';
            }
        }

        return view('admin.claims.claimants.manage',  compact('claimants', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $claim          = isset($request->claim_id) ? Claim::find($request->claim_id) : null;
        $claims         = Claim::with([
            'patient' => function ($query) {
                $query->select('id', 'uid', 'associate_partner_id', 'title', 'firstname', 'middlename', 'lastname', 'patient_current_address', 'patient_current_city', 'patient_current_state', 'patient_current_pincode', 'email', 'phone', 'id_proof', 'hospital_id');
            },
            'patient.hospital' => function ($query) {
                $query->select('id', 'uid');
            },
        ])->get();

        return view('admin.claims.claimants.create.claimant', compact('claim', 'claims'));
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
            'patient_id'                      => 'required',
            'claim_id'                        => 'required',
            'associate_partner_id'            => "required_if:$request->associate_partner_id,'!=',null",
            'hospital_id'                     => 'required',
            'patient_title'                   => 'required',
            'employee_id_or_member_id'        => ($request->policy_type == 'Group') ? 'required' : '',
            'patient_firstname'               => 'required|max:25',
            'patient_middlename'              => isset($request->patient_middlename) ? 'max:25' : '',
            'patient_lastname'                => isset($request->patient_lastname) ? 'max:25' : '',
            'patient_id_proof'                => 'required',
            'are_patient_and_claimant_same'   => 'required',
            'title'                           => 'required',
            'firstname'                       => 'required|max:25',
            'middlename'                      => isset($request->middlename) ? 'max:25' : '',
            'lastname'                        => isset($request->lastname) ? 'max:25' : '',
            'pan_no'                          => 'required|unique:claimants|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u',
            'aadhar_no'                       => 'required|unique:claimants|numeric|digits:12',
            'patients_relation_with_claimant' => 'required',
            'specify'                         => ($request->patients_relation_with_claimant == 'Other') ? 'required' : [],
            'address'                         => 'required|max:100',
            'city'                            => 'required',
            'state'                           => 'required',
            'pincode'                         => 'required',
            'personal_email_id'               => 'required|email|max:45',
            'mobile_no'                       => 'required|digits:10',
            'estimated_amount'                => 'required|digits_between:1,8',
            'cancel_cheque'                   => 'required',
            'bank_name'                       => 'required|max:45',
            'bank_address'                    => 'required|max:80',
            'ac_no'                           => 'required|max:20',
            'ifs_code'                        => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                       => 'Please Enter Patient Id',
            'claim_id.required'                         => 'Please Enter Claim Id',
            'associate_partner_id.required'             => 'Please Enter Associate Partner Id',
            'hospital_id.required'                      => 'Please Enter Hospital Id',
            'patient_title.required'                    => 'Please Enter Patient Title',
            'patient_firstname.required'                => 'Please Enter Patient Firstname',
            'patient_middlename.required'               => 'Please Enter Patient Middlename',
            'patient_lastname.required'                 => 'Please Enter Patient Lastname',
            'patient_id_proof.required'                 => 'Please Enter Patient Id Proof',
            'are_patient_and_claimant_same.required'    => 'Please Enter Are Patient And Claimant Same',
            'title.required'                            => 'Please Enter Title',
            'firstname.required'                        => 'Please Enter Firstname',
            'middlename.required'                       => 'Please Enter Middlename',
            'lastname.required'                         => 'Please Enter Lastname',
            'pan_no.required'                           => 'Please Enter Pan No',
            'aadhar_no.required'                        => 'Please Enter Aadhar No',
            'patients_relation_with_claimant.required'  => 'Please Enter Patients Relation With Claimant',
            'specify.required'                          => 'Please Enter Specify',
            'address.required'                          => 'Please Enter Address',
            'city.required'                             => 'Please Enter City',
            'state.required'                            => 'Please Enter State',
            'pincode.required'                          => 'Please Enter Pincode',
            'personal_email_id.required'                => 'Please Enter Personal Email Id',
            'official_email_id.required'                => 'Please Enter Official Email Id',
            'mobile_no.required'                        => 'Please Enter Mobile No',
            'estimated_amount.required'                 => 'Please Enter Estimated Amount',
            'cancel_cheque.required'                    => 'Please Enter Cancel Cheque',
            'bank_name.required'                        => 'Please Enter Bank Name',
            'bank_address.required'                     => 'Please Enter Bank Address',
            'ac_no.required'                            => 'Please Enter Bank Account No',
            'ifs_code.required'                         => 'Please Enter Bank Ifs Code',
            'comments.required'                         => 'Please Enter Comments',
        ];

        $this->validate($request, $rules, $messages);

        if(auth()->check() && auth()->user()->hasDirectPermission("2nd Level Authorization Required (for User's works)")){
            $status = 0;
        }else{
            $status = 1;
        }

        $claim                                  = Claim::find($request->claim_id);

        $claimant                               =  Claimant::create([
            'patient_id'                         => $claim->patient_id,
            'claim_id'                           => $request->claim_id,
            'associate_partner_id'               => $request->associate_partner_id,
            'hospital_id'                        => $claim->patient->hospital_id,
            'policy_type'                        => $request->policy_type,
            'group_name'                         => $request->group_name,
            'employee_id_or_member_id'           => $request->employee_id_or_member_id,
            'are_patient_and_claimant_same'      => $request->are_patient_and_claimant_same,
            'title'                              => $request->title,
            'firstname'                          => $request->firstname,
            'middlename'                         => $request->middlename,
            'lastname'                           => $request->lastname,
            'pan_no'                             => $request->pan_no,
            'aadhar_no'                          => $request->aadhar_no,
            'patients_relation_with_claimant'    => $request->patients_relation_with_claimant,
            'specify'                            => $request->specify,
            'address'                            => $request->address,
            'city'                               => $request->city,
            'state'                              => $request->state,
            'pincode'                            => $request->pincode,
            'personal_email_id'                  => $request->personal_email_id,
            'official_email_id'                  => $request->official_email_id,
            'mobile_no'                          => $request->mobile_no,
            'estimated_amount'                   => $request->estimated_amount,
            'cancel_cheque'                      => $request->cancel_cheque,
            'bank_name'                          => $request->bank_name,
            'bank_address'                       => $request->bank_address,
            'ac_no'                              => $request->ac_no,
            'ifs_code'                           => $request->ifs_code,
            'comments'                           => $request->comments,
            'status'                             => $status,
        ]);

        Claimant::where('id', $claimant->id)->update([
            'uid'      => 'CLMT' . substr($claimant->pan_no, 0, 2) . substr($claimant->pan_no, -3)
        ]);

        Patient::where('id', $claim->patient_id)->update(['id_proof' => $request->patient_id_proof]);

        return redirect()->route('admin.claimants.edit', $claimant->id)->with('success', 'Claimant created successfully');
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
        $claimant       = Claimant::with('claim')->find($id);
        $claims         = Claim::with([
            'patient' => function ($query) {
                $query->select('id', 'uid', 'associate_partner_id', 'title', 'firstname', 'middlename', 'lastname', 'patient_current_address', 'patient_current_city', 'patient_current_state', 'patient_current_pincode', 'email', 'phone', 'id_proof', 'hospital_id');
            },
            'patient.hospital' => function ($query) {
                $query->select('id', 'uid');
            },
        ])->get();

        return view('admin.claims.claimants.edit.claimant', compact('claimant', 'claims'));
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
        $claim                                = Claim::find($request->claim_id);
        $claimant                             = Claimant::find($id);

        $rules = [
            'patient_id'                      => 'required',
            'claim_id'                        => 'required',
            'associate_partner_id'            => "required_if:$request->associate_partner_id,'!=',null",
            'hospital_id'                     => 'required',
            'employee_id_or_member_id'        => ($request->policy_type == 'Group') ? 'required' : '',
            'patient_title'                   => 'required',
            'patient_firstname'               => 'required|max:25',
            'patient_middlename'              => isset($request->patient_middlename) ? 'max:25' : '',
            'patient_lastname'                => isset($request->patient_lastname) ? 'max:25' : '',
            'patient_id_proof'                => 'required',
            'are_patient_and_claimant_same'   => 'required',
            'title'                           => 'required',
            'firstname'                       => 'required|max:25',
            'middlename'                      => isset($request->middlename) ? 'max:25' : '',
            'lastname'                        => isset($request->lastname) ? 'max:25' : '',
            'pan_no'                          => 'required|alpha_num|size:10|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/u|unique:claimants,pan_no,'.$id,
            'aadhar_no'                       => 'required|numeric|digits:12|unique:claimants,aadhar_no,'.$id,
            'patients_relation_with_claimant' => 'required',
            'specify'                         => ($request->patients_relation_with_claimant == 'Other') ? 'required' : [],
            'address'                         => 'required|max:100',
            'city'                            => 'required',
            'state'                           => 'required',
            'pincode'                         => 'required',
            'personal_email_id'               => 'required|email|max:45',
            'mobile_no'                       => 'required|digits:10',
            'estimated_amount'                => 'required|digits_between:1,8',
            'cancel_cheque'                   => 'required',
            'bank_name'                       => 'required|max:45',
            'bank_address'                    => 'required|max:80',
            'ac_no'                           => 'required|max:20',
            'ifs_code'                        => 'required|max:11',
        ];

        $messages =  [
            'patient_id.required'                       => 'Please Enter Patient Id',
            'claim_id.required'                         => 'Please Enter Claim Id',
            'associate_partner_id.required'             => 'Please Enter Associate Partner Id',
            'hospital_id.required'                      => 'Please Enter Hospital Id',
            'patient_title.required'                    => 'Please Enter Patient Title',
            'patient_firstname.required'                => 'Please Enter Patient Firstname',
            'patient_middlename.required'               => 'Please Enter Patient Middlename',
            'patient_lastname.required'                 => 'Please Enter Patient Lastname',
            'patient_id_proof.required'                 => 'Please Enter Patient Id Proof',
            'are_patient_and_claimant_same.required'    => 'Please Enter Are Patient And Claimant Same',
            'title.required'                            => 'Please Enter Title',
            'firstname.required'                        => 'Please Enter Firstname',
            'middlename.required'                       => 'Please Enter Middlename',
            'lastname.required'                         => 'Please Enter Lastname',
            'pan_no.required'                           => 'Please Enter Pan No',
            'aadhar_no.required'                        => 'Please Enter Aadhar No',
            'patients_relation_with_claimant.required'  => 'Please Enter Patients Relation With Claimant',
            'specify.required'                          => 'Please Enter Specify',
            'address.required'                          => 'Please Enter Address',
            'city.required'                             => 'Please Enter City',
            'state.required'                            => 'Please Enter State',
            'pincode.required'                          => 'Please Enter Pincode',
            'personal_email_id.required'                => 'Please Enter Personal Email Id',
            'official_email_id.required'                => 'Please Enter Official Email Id',
            'mobile_no.required'                        => 'Please Enter Mobile No',
            'estimated_amount.required'                 => 'Please Enter Estimated Amount',
            'cancel_cheque.required'                    => 'Please Enter Cancel Cheque',
            'bank_name.required'                        => 'Please Enter Bank Name',
            'bank_address.required'                     => 'Please Enter Bank Address',
            'ac_no.required'                            => 'Please Enter Bank Account No',
            'ifs_code.required'                         => 'Please Enter Bank Ifs Code',
            'comments.required'                         => 'Please Enter Comments',
        ];

        $this->validate($request, $rules, $messages);



        Claimant::where('id', $id)->update([
            'patient_id'                         => $claim->patient_id,
            'claim_id'                           => $request->claim_id,
            'associate_partner_id'               => $request->associate_partner_id,
            'hospital_id'                        => $claim->patient->hospital_id,
            'policy_type'                        => $request->policy_type,
            'group_name'                         => $request->group_name,
            'employee_id_or_member_id'           => $request->employee_id_or_member_id,
            'are_patient_and_claimant_same'      => $request->are_patient_and_claimant_same,
            'title'                              => $request->title,
            'firstname'                          => $request->firstname,
            'middlename'                         => $request->middlename,
            'lastname'                           => $request->lastname,
            'pan_no'                             => $request->pan_no,
            'aadhar_no'                          => $request->aadhar_no,
            'patients_relation_with_claimant'    => $request->patients_relation_with_claimant,
            'specify'                            => $request->specify,
            'address'                            => $request->address,
            'city'                               => $request->city,
            'state'                              => $request->state,
            'pincode'                            => $request->pincode,
            'personal_email_id'                  => $request->personal_email_id,
            'official_email_id'                  => $request->official_email_id,
            'mobile_no'                          => $request->mobile_no,
            'estimated_amount'                   => $request->estimated_amount,
            'cancel_cheque'                      => $request->cancel_cheque,
            'bank_name'                          => $request->bank_name,
            'bank_address'                       => $request->bank_address,
            'ac_no'                              => $request->ac_no,
            'ifs_code'                           => $request->ifs_code,
            'comments'                           => $request->comments,
        ]);

        Claimant::where('id', $claimant->id)->update([
            'uid'      => 'CLMT' . substr($claimant->pan_no, 0, 2) . substr($claimant->pan_no, -3)
        ]);

        Patient::where('id', $claim->patient_id)->update(['id_proof' => $request->patient_id_proof]);

        return redirect()->back()->with('success', 'Claimant updated successfully');
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


}
