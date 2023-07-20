<?php

namespace App\Http\Controllers\SuperAdmin\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssessmentStatus;
use App\Models\Claimant;
use App\Models\HospitalEmpanelmentStatus;
use App\Models\ClaimProcessing;
use App\Models\Claim;
use App\Models\InsurancePolicy;
use App\Models\Insurer;
use App\Models\Assessment_part_one;
use App\Models\Assessment_part_two;
use App\Models\HospitalDepartment;
use Illuminate\Http\Request;

use PDF;

class AssessmentController extends Controller
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

        return view('super-admin.claims.assessments.create.create', compact('claim', 'assessment_status', 'insurers', 'processing_query', 'hospital_id_as_per_the_selected_company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kypform($id){
        $claim      = Claim::with('patient')->find($id);
        $policy     = InsurancePolicy::find($id);
        $insurer    = Insurer::find($policy->insurer_id);
        $parttow   = Assessment_part_one::where('claim_id',$id)->get();
        if(!empty($parttow[0]))
            $formData = $parttow[0];
        else
            $formData = array();

        return view('super-admin.claims.assessments.kypform', compact('claim','insurer','formData'));
    }

    public function savepartone(Request $request){

        $rules =  [
            'claim_id' => 'required',
        ];

        $messages =  [
            'claim_id.required' => 'Something Went Wrong, Please try again.',
        ];

        $this->validate($request, $rules, $messages);

        $Assessment_part_one = Assessment_part_one::where('claim_id',$request->claim_id)->get();

        if(empty($Assessment_part_one[0])){

            if($request->hasfile('patient_signature')){
                $fileName = time().$request->file('patient_signature')->getClientOriginalName();
                $path = $request->file('patient_signature')->storeAs('assesments', $fileName, 'public');
                $patient_signature = "/storage/".$path;
            }else{
                $patient_signature = '';
            }

            if($request->hasfile('officer_signature')){
                $fileName = time().$request->file('officer_signature')->getClientOriginalName();
                $path = $request->file('officer_signature')->storeAs('officer_signature', $fileName, 'public');
                $officer_signature = "/storage/".$path;
            }else{
                $officer_signature = '';
            }

            $Assessment_part_one = Assessment_part_one::create([
                'claim_id'                  => $request->claim_id,
                // 'balance_sum_insured'       => $request->balance_sum_insured,
                'co_payment'                => $request->co_payment,
                'sub_limit'                 => $request->sub_limit,
                // 'no_claim_bonus'            => $request->no_claim_bonus,
                'effective_coverage'        => $request->effective_coverage,
                'buffer_limit'              => $request->buffer_limit,
                'eligible_icu_ccu_rent'     => $request->eligible_icu_ccu_rent,
                'eligible_room'             => $request->eligible_room,
                'patient_signature'         => $patient_signature,
                'patient_signature_date'    => $request->patient_signature_date,
                'relation_with_patient'     => $request->relation_with_patient,
                'officer_signature'         => $officer_signature,
                'officer_signature_date'    => $request->officer_signature_date,
            ]);
        }else{

            if($request->hasfile('patient_signature')){
                $fileName = time().$request->file('patient_signature')->getClientOriginalName();
                $path = $request->file('patient_signature')->storeAs('assesments', $fileName, 'public');
                $patient_signature = "/storage/".$path;
            }else{
                $patient_signature = $Assessment_part_one[0]->patient_signature;
            }

            if($request->hasfile('officer_signature')){
                $fileName = time().$request->file('officer_signature')->getClientOriginalName();
                $path = $request->file('officer_signature')->storeAs('officer_signature', $fileName, 'public');
                $officer_signature = "/storage/".$path;
            }else{
                $officer_signature = $Assessment_part_one[0]->officer_signature;
            }

            $Assessment_part_one = Assessment_part_one::where('claim_id', $request->claim_id)->update([
                // 'balance_sum_insured'       => $request->balance_sum_insured,
                'co_payment'                => $request->co_payment,
                'sub_limit'                 => $request->sub_limit,
                // 'no_claim_bonus'            => $request->no_claim_bonus,
                'effective_coverage'        => $request->effective_coverage,
                'buffer_limit'              => $request->buffer_limit,
                'eligible_icu_ccu_rent'     => $request->eligible_icu_ccu_rent,
                'eligible_room'             => $request->eligible_room,
                'patient_signature'         => $patient_signature,
                'patient_signature_date'    => $request->patient_signature_date,
                'relation_with_patient'     => $request->relation_with_patient,
                'officer_signature'         => $officer_signature,
                'officer_signature_date'    => $request->officer_signature_date,
            ]);
        }

        return redirect()->route('super-admin.assessment-status.kypform', $request->claim_id)->with('success', 'Data Saved successfully');
        // print_r($Assessment_part_one);
        // die;
    }

    public function createKYPPDF($id) {
        $claim      = Claim::with('patient')->find($id);
        $policy     = InsurancePolicy::find($id);
        $insurer    = Insurer::find($policy->insurer_id);
        $formData   = Assessment_part_one::where('claim_id',$id)->get()[0];

        $pdf = PDF::loadView('super-admin.claims.assessments.createkyppdf', compact('claim','insurer','formData'));
        $pdf->set_option('dpi','150');
        return $pdf->download('Assessment_part_1.pdf');
    }


    public function treatmentform($id){
        $claim      = Claim::with('patient')->find($id);
        $policy     = InsurancePolicy::find($id);
        $insurer    = Insurer::find($policy->insurer_id);
        $doctor     = HospitalDepartment::find($claim->patient->treating_doctor);
        $parttow    = Assessment_part_two::where('claim_id',$id)->get();
        if(!empty($parttow[0]))
            $formData = $parttow[0];
        else
            $formData = array();

        return view('super-admin.claims.assessments.treatmentform', compact('claim','insurer','doctor','formData'));
    }

    public function saveparttwo(Request $request){
        // echo '<pre>';
        // print_r($_POST);
        // die;

        $rules =  [
            'claim_id' => 'required',
        ];

        $messages =  [
            'claim_id.required' => 'Something Went Wrong, Please try again.',
        ];

        $this->validate($request, $rules, $messages);

        $Assessment_part_two = Assessment_part_two::where('claim_id',$request->claim_id)->get();

        if(empty($Assessment_part_two[0])){

            if($request->hasfile('patient_signature')){
                $fileName = time().$request->file('patient_signature')->getClientOriginalName();
                $path = $request->file('patient_signature')->storeAs('assesments', $fileName, 'public');
                $patient_signature = "/storage/".$path;
            }else{
                $patient_signature = '';
            }

            if($request->hasfile('officer_signature')){
                $fileName = time().$request->file('officer_signature')->getClientOriginalName();
                $path = $request->file('officer_signature')->storeAs('officer_signature', $fileName, 'public');
                $officer_signature = "/storage/".$path;
            }else{
                $officer_signature = '';
            }

            $Assessment_part_two = Assessment_part_two::create([
                'claim_id'                  => $request->claim_id,
                'present_ailment_duration'  => $request->present_ailment_duration,
                'pastHitory'                => $request->pastHitory,
                'Diabetes'                  => $request->Diabetes,
                'DiabetesDate'              => $request->DiabetesDate,
                'HTN'                       => $request->HTN,
                'HTNDate'                   => $request->HTNDate,
                'Alcohol'                   => $request->Alcohol,
                'AlcoholDate'               => $request->AlcoholDate,
                'Smoking'                   => $request->Smoking,
                'SmokingDate'               => $request->SmokingDate,
                'Drug'                      => $request->Drug,
                'DrugDate'                  => $request->DrugDate,
                'Heart'                     => $request->Heart,
                'HeartDate'                 => $request->HeartDate,
                'Kidney'                    => $request->Kidney,
                'KidneyDate'                => $request->KidneyDate,
                'Liver'                     => $request->Liver,
                'LiverDate'                 => $request->LiverDate,
                'Arthritis'                 => $request->Arthritis,
                'ArthritisDate'             => $request->ArthritisDate,
                'Neuro'                     => $request->Neuro,
                'NeuroDate'                 => $request->NeuroDate,
                'Hear'                      => $request->Hear,
                'HearDate'                  => $request->HearDate,
                'Hypertension'              => $request->Hypertension,
                'HypertensionDate'          => $request->HypertensionDate,
                'Hyperlipidaemias'          => $request->Hyperlipidaemias,
                'HyperlipidaemiasDate'      => $request->HyperlipidaemiasDate,
                'Osteoarthritis'            => $request->Osteoarthritis,
                'OsteoarthritisDate'        => $request->OsteoarthritisDate,
                'Asthma'                    => $request->Asthma,
                'AsthmaDate'                => $request->AsthmaDate,
                'Cancer'                    => $request->Cancer,
                'CancerDate'                => $request->CancerDate,
                'HIV'                       => $request->HIV,
                'HIVDate'                   => $request->HIVDate,
                'Any_other_ailment'         => $request->Any_other_ailment,
                'Any_other_ailment_Date'    => $request->Any_other_ailment_Date,
                'patient_signature'         => $patient_signature,
                'patient_signature_date'    => $request->patient_signature_date,
                'relation_with_patient'     => $request->relation_with_patient,
                'officer_signature'         => $officer_signature,
                'officer_signature_date'    => $request->officer_signature_date,
            ]);
        }else{

            if($request->hasfile('patient_signature')){
                $fileName = time().$request->file('patient_signature')->getClientOriginalName();
                $path = $request->file('patient_signature')->storeAs('assesments', $fileName, 'public');
                $patient_signature = "/storage/".$path;
            }else{
                $patient_signature = $Assessment_part_two[0]->patient_signature;
            }

            if($request->hasfile('officer_signature')){
                $fileName = time().$request->file('officer_signature')->getClientOriginalName();
                $path = $request->file('officer_signature')->storeAs('officer_signature', $fileName, 'public');
                $officer_signature = "/storage/".$path;
            }else{
                $officer_signature = $Assessment_part_two[0]->officer_signature;
            }

            $Assessment_part_two = Assessment_part_two::where('claim_id', $request->claim_id)->update([
                'present_ailment_duration'  => $request->present_ailment_duration,
                'pastHitory'                => $request->pastHitory,
                'Diabetes'                  => $request->Diabetes,
                'DiabetesDate'              => $request->DiabetesDate,
                'HTN'                       => $request->HTN,
                'HTNDate'                   => $request->HTNDate,
                'Alcohol'                   => $request->Alcohol,
                'AlcoholDate'               => $request->AlcoholDate,
                'Smoking'                   => $request->Smoking,
                'SmokingDate'               => $request->SmokingDate,
                'Drug'                      => $request->Drug,
                'DrugDate'                  => $request->DrugDate,
                'Heart'                     => $request->Heart,
                'HeartDate'                 => $request->HeartDate,
                'Kidney'                    => $request->Kidney,
                'KidneyDate'                => $request->KidneyDate,
                'Liver'                     => $request->Liver,
                'LiverDate'                 => $request->LiverDate,
                'Arthritis'                 => $request->Arthritis,
                'ArthritisDate'             => $request->ArthritisDate,
                'Neuro'                     => $request->Neuro,
                'NeuroDate'                 => $request->NeuroDate,
                'Hear'                      => $request->Hear,
                'HearDate'                  => $request->HearDate,
                'Hypertension'              => $request->Hypertension,
                'HypertensionDate'          => $request->HypertensionDate,
                'Hyperlipidaemias'          => $request->Hyperlipidaemias,
                'HyperlipidaemiasDate'      => $request->HyperlipidaemiasDate,
                'Osteoarthritis'            => $request->Osteoarthritis,
                'OsteoarthritisDate'        => $request->OsteoarthritisDate,
                'Asthma'                    => $request->Asthma,
                'AsthmaDate'                => $request->AsthmaDate,
                'Cancer'                    => $request->Cancer,
                'CancerDate'                => $request->CancerDate,
                'HIV'                       => $request->HIV,
                'HIVDate'                   => $request->HIVDate,
                'Any_other_ailment'         => $request->Any_other_ailment,
                'Any_other_ailment_Date'    => $request->Any_other_ailment_Date,
                'patient_signature'         => $patient_signature,
                'patient_signature_date'    => $request->patient_signature_date,
                'relation_with_patient'     => $request->relation_with_patient,
                'officer_signature'         => $officer_signature,
                'officer_signature_date'    => $request->officer_signature_date,
            ]);
        }

        return redirect()->route('super-admin.assessment-status.treatmentform', $request->claim_id)->with('success', 'Data Saved successfully');
    }

    public function createtreatmentPDF($id) {
        $claim      = Claim::with('patient')->find($id);
        $policy     = InsurancePolicy::find($id);
        $insurer    = Insurer::find($policy->insurer_id);
        $doctor     = HospitalDepartment::find($claim->patient->treating_doctor);
        $formData   = Assessment_part_two::where('claim_id',$id)->get()[0];

        $pdf = PDF::loadView('super-admin.claims.assessments.createtreatmentPDF', compact('claim','insurer','doctor','formData'));
        $pdf->set_option('dpi','150');
        return $pdf->download('Assessment_part_2.pdf');
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

        return view('super-admin.claims.claimants.edit.assessment-status', compact('claimant', 'assessment_status', 'insurers'));
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
