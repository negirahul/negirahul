<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssessmentStatus;
use App\Models\Claimant;
use App\Models\HospitalEmpanelmentStatus;
use App\Models\ClaimProcessing;
use App\Models\Claim;
use App\Models\Insurer;
use Illuminate\Http\Request;

class AssessmentController extends Controller
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
    public function index()
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
        $claim           = Claim::with('patient','hospital')->find($request->claim_id);
        $processing_query   = ClaimProcessing::where('claim_id', $request->claim_id)->value('processing_query');
        $assessment_exists  = AssessmentStatus::where('claim_id', $request->claim_id)->exists();
        $assessment_status  = $assessment_exists ? AssessmentStatus::where('claim_id', $request->claim_id)->first() : null;
        $insurers           = Insurer::get();

        $policy_id = @$claim->policy->insurer_id;
        $hospital_id = $claim->patient->hospital->id;

       $hospital_id_as_per_the_selected_company = HospitalEmpanelmentStatus::where(['hospital_id' => $hospital_id, 'tpa_id' => $policy_id ])->exists() ?  HospitalEmpanelmentStatus::where(['hospital_id' => $hospital_id, 'tpa_id' => $policy_id ])->value('hospital_id_as_per_the_selected_company') : null;



        return view('admin.claims.assessments.create.create', compact('claim', 'assessment_status', 'insurers', 'processing_query', 'hospital_id_as_per_the_selected_company'));
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
        $claimant           = Claimant::with('claim')->find($id);
        $assessment_exists  = AssessmentStatus::where('claimant_id', $id)->exists();
        $assessment_status  = $assessment_exists ? AssessmentStatus::where('claimant_id', $id)->first() : null;
        $insurers           = Insurer::get();

        return view('admin.claims.claimants.edit.assessment-status', compact('claimant', 'assessment_status', 'insurers'));
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

    public function updateAssessmentStatus(Request $request, $id)
    {
        $claim      = Claim::with(['patient'])->find($id);

        $assessment    = AssessmentStatus::updateOrCreate(
            ['claim_id'  => $id],
            ['patient_id'   => $claim->patient->id,
            'hospital_id'   => $claim->patient->hospital_id]
        );

        switch ($request->form_type) {
            case 'pre-assessment-status-form':
                $rules =  [
                    'patient_id'                                 => 'required|max:255',
                    'claim_id'                                   => 'required|max:255',
                    'claimant_id'                                => 'required|max:255',
                    'hospital_id'                                => 'required|max:255',
                    'hospital_name'                              => 'required|max:255',
                    'hospital_address'                           => 'required|max:255',
                    'hospital_city'                              => 'required|max:255',
                    'hospital_state'                             => 'required|max:255',
                    'hospital_pincode'                           => 'required|numeric',
                    'patient_lastname'                           =>  isset($request->patient_lastname) ? 'max:255' : '',
                    'patient_firstname'                          => 'required|max:255',
                    'patient_middlename'                         =>  isset($request->patient_middlename) ? 'max:255' : '',
                    'hospital_on_the_panel_of_insurance_co'      => 'required',
                    'hospital_id_insurance_co'                   => 'required',
                    'pre_assessment_status'                      => 'required',
                    'query_pre_assessment'                       => ($request->pre_assessment_status == 'Query Raised by BHC Team') ? 'required|max:255' : '',
                    'pre_assessment_amount'                      => 'required|numeric|digits_between:1,8',
                    'pre_assessment_suspected_fraud'             => 'required',
                ];

                $messages =  [
                    'patient_id.required'                               => 'Please select Patient ID',
                    'claim_id.required'                                 => 'Please enter Claim ID',
                    'claimant_id.required'                              => 'Please enter Claimant ID',
                    'hospital_name.required'                            => 'Please enter Hospital Name',
                    'hospital_id.required'                              => 'Please enter Hospital ID.',
                    'hospital_address.required'                         => 'Please enter Hospital address.',
                    'hospital_city.required'                            => 'Please enter Hospital city.',
                    'hospital_state.required'                           => 'Please enter Hospital state.',
                    'hospital_pincode.required'                         => 'Please enter Hospital pincode.',
                    'patient_title.required'                            => 'Please select Patient title',
                    'patient_lastname.required'                         => 'Please enter Patient lastname',
                    'patient_firstname.required'                        => 'Please enter Patient firstname',
                    'policy_no.required'                                => 'Please enter Policy number',
                    'start_date.required'                               => 'Please enter start date',
                    'expiry_date.required'                              => 'Please enter expiry date',
                    'commencement_date.required'                        => 'Please enter commencement date',
                    'hospital_on_the_panel_of_insurance_co.required'    => 'Please select if hospital on the panel',
                    'hospital_id_insurance_co.required'                 => 'Please enter hospital id insurance co',
                    'pre_assessment_status.required'                    => 'Please enter pre assessment status',
                    'query_pre_assessment.required'                     => 'Please enter query pre assessment',
                    'pre_assessment_amount.required'                    => 'Please enter pre assessment amount',
                    'pre_assessment_suspected_fraud.required'           => 'Please enter pre assessment suspected fraud',

                ];

                $this->validate($request, $rules, $messages);

                $claimant   = Claimant::where('claim_id',$id)->first();

                AssessmentStatus::where('claim_id', $id)->update([
                    'patient_id'   => $claim->patient->id,
                    'claimant_id'   => @$claimant->id,
                    'hospital_id'   => $claim->patient->hospital_id,
                    'hospital_on_the_panel_of_insurance_co'     => $request->hospital_on_the_panel_of_insurance_co,
                    'hospital_id_insurance_co'                  => $request->hospital_id_insurance_co,
                    'pre_assessment_status'                     => $request->pre_assessment_status,
                    'query_pre_assessment'                      => $request->query_pre_assessment,
                    'pre_assessment_amount'                     => $request->pre_assessment_amount,
                    'pre_assessment_suspected_fraud'            => $request->pre_assessment_suspected_fraud,
                    'pre_assessment_status_comments'            => $request->pre_assessment_status_comments,
                ]);

                Claim::where('id', $id)->update([
                    'status'   => 1,
                ]);

                break;
            case 'final-assessment-status-form':
                $rules =  [
                    // 'final_assessment_amount'                    => 'required|numeric|digits_between:1,8',
                    'final_assessment_suspected_fraud'           => 'required',


                ];

                $messages =  [
                    'final_assessment_amount.required'            => 'please enter final assessment amount',
                    'final_assessment_suspected_fraud.required'   => 'please enter final assessment suspected fraud',
                ];

                $this->validate($request, $rules, $messages);

                AssessmentStatus::where('claim_id', $id)->update([
                    'final_assessment_status'                   => $request->final_assessment_status,
                    'query_final_assessment'                    => $request->query_final_assessment,
                    'final_assessment_amount'                   => $request->final_assessment_amount,
                    'final_assessment_suspected_fraud'          => $request->final_assessment_suspected_fraud,
                    'final_assessment_status_comments'          => $request->final_assessment_status_comments,
                ]);

                Claim::where('id', $id)->update([
                    'assessment_status'   => 1,
                ]);

                break;
            default:
                # code...
                break;

        }
        return redirect()->back()->with('success', 'Assessment Status updated successfully');
    }

    public function update(Request $request, $id)
    {
        $claimant      = Claimant::with('claim')->find($id);

        $assessment    = AssessmentStatus::updateOrCreate(
            ['claimant_id'  => $id],
            ['patient_id'   => $claimant->patient_id,
            'claim_id'      => $claimant->claim_id,
            'claimant_id'   => $claimant->id,
            'hospital_id'   => $claimant->hospital_id]
        );

        switch ($request->form_type) {
            case 'pre-assessment-status-form':
                $rules =  [
                    'patient_id'                                 => 'required|max:255',
                    'claim_id'                                   => 'required|max:255',
                    'claimant_id'                                => 'required|max:255',
                    'hospital_id'                                => 'required|max:255',
                    'hospital_name'                              => 'required|max:255',
                    'hospital_address'                           => 'required|max:255',
                    'hospital_city'                              => 'required|max:255',
                    'hospital_state'                             => 'required|max:255',
                    'hospital_pincode'                           => 'required|numeric',
                    'patient_lastname'                           =>  isset($request->patient_lastname) ? 'max:255' : '',
                    'patient_firstname'                          => 'required|max:255',
                    'patient_middlename'                         =>  isset($request->patient_middlename) ? 'max:255' : '',
                    'hospital_on_the_panel_of_insurance_co'      => 'required',
                    'hospital_id_insurance_co'                   => 'required',
                    'pre_assessment_status'                      => 'required',
                    'query_pre_assessment'                       => ($request->pre_assessment_status == 'Query Raised by BHC Team') ? 'required|max:255' : '',
                    'pre_assessment_amount'                      => 'required|numeric|digits_between:1,8',
                    'pre_assessment_suspected_fraud'             => 'required',
                ];

                $messages =  [
                    'patient_id.required'                               => 'Please select Patient ID',
                    'claim_id.required'                                 => 'Please enter Claim ID',
                    'claimant_id.required'                              => 'Please enter Claimant ID',
                    'hospital_name.required'                            => 'Please enter Hospital Name',
                    'hospital_id.required'                              => 'Please enter Hospital ID.',
                    'hospital_address.required'                         => 'Please enter Hospital address.',
                    'hospital_city.required'                            => 'Please enter Hospital city.',
                    'hospital_state.required'                           => 'Please enter Hospital state.',
                    'hospital_pincode.required'                         => 'Please enter Hospital pincode.',
                    'patient_title.required'                            => 'Please select Patient title',
                    'patient_lastname.required'                         => 'Please enter Patient lastname',
                    'patient_firstname.required'                        => 'Please enter Patient firstname',
                    'policy_no.required'                                => 'Please enter Policy number',
                    'start_date.required'                               => 'Please enter start date',
                    'expiry_date.required'                              => 'Please enter expiry date',
                    'commencement_date.required'                        => 'Please enter commencement date',
                    'hospital_on_the_panel_of_insurance_co.required'    => 'Please select if hospital on the panel',
                    'hospital_id_insurance_co.required'                 => 'Please enter hospital id insurance co',
                    'pre_assessment_status.required'                    => 'Please enter pre assessment status',
                    'query_pre_assessment.required'                     => 'Please enter query pre assessment',
                    'pre_assessment_amount.required'                    => 'Please enter pre assessment amount',
                    'pre_assessment_suspected_fraud.required'           => 'Please enter pre assessment suspected fraud',

                ];

                $this->validate($request, $rules, $messages);

                AssessmentStatus::where('claimant_id', $id)->update([
                    'patient_id'                                => $claimant->patient_id,
                    'claim_id'                                  => $claimant->claim_id,
                    'claimant_id'                               => $claimant->id,
                    'hospital_id'                               => $claimant->hospital_id,
                    'hospital_on_the_panel_of_insurance_co'     => $request->hospital_on_the_panel_of_insurance_co,
                    'hospital_id_insurance_co'                  => $request->hospital_id_insurance_co,
                    'pre_assessment_status'                     => $request->pre_assessment_status,
                    'query_pre_assessment'                      => $request->query_pre_assessment,
                    'pre_assessment_amount'                     => $request->pre_assessment_amount,
                    'pre_assessment_suspected_fraud'            => $request->pre_assessment_suspected_fraud,
                    'pre_assessment_status_comments'            => $request->pre_assessment_status_comments,

                ]);
                break;
            case 'final-assessment-status-form':
                $rules =  [
                    // 'final_assessment_amount'                    => 'required|numeric|digits_between:1,8',
                    'final_assessment_suspected_fraud'           => 'required',


                ];

                $messages =  [
                    'final_assessment_amount.required'            => 'please enter final assessment amount',
                    'final_assessment_suspected_fraud.required'   => 'please enter final assessment suspected fraud',
                ];

                $this->validate($request, $rules, $messages);

                AssessmentStatus::where('claimant_id', $id)->update([
                    'final_assessment_status'                   => $request->final_assessment_status,
                    'query_final_assessment'                    => $request->query_final_assessment,
                    'final_assessment_amount'                   => $request->final_assessment_amount,
                    'final_assessment_suspected_fraud'          => $request->final_assessment_suspected_fraud,
                    'final_assessment_status_comments'          => $request->final_assessment_status_comments,

                ]);

                break;
            default:
                # code...
                break;

        }
        return redirect()->back()->with('success', 'Assessment Status updated successfully');
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
