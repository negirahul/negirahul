<?php

namespace App\Http\Controllers\Hospital\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Claim;
use App\Models\Claimant;
use App\Models\Tpa;
use App\Models\Borrower;
use App\Models\DischargeStatus;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\ClaimProcessing;
use App\Models\InsurancePolicy;
use App\Models\Insurer;
use App\Models\AssessmentStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hospital');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function assessmentStatus(Request $request)
    {

        $patient_id     = $request->patient_id;
        $hospitals      = Hospital::get();
        $insurers       = Insurer::get();
        $patient        = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $patients       = Patient::get();
        return view('hospital.claims.claims.create.assessment-status',  compact('hospitals', 'patient_id', 'patient', 'patients', 'insurers'));
    }

    public function assisment(Request $request)
    {
        $patient_id     = $request->patient_id;
        $hospitals      = Hospital::get();
        $insurers       = Insurer::get();
        $patient        = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $patients       = Patient::get();
        return view('hospital.claims.claims.create.processing',  compact('hospitals', 'patient_id', 'patient', 'patients', 'insurers'));
    }

    public function processing(Request $request)
    {
        $patient_id     = $request->patient_id;
        $hospitals      = Hospital::get();
        $insurers       = Insurer::get();
        $patient        = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $patients       = Patient::get();
        return view('hospital.claims.claims.create.processing',  compact('hospitals', 'patient_id', 'patient', 'patients', 'insurers'));
    }


    public function saveClaimProcessing(Request $request)
    {
        $rules = [
            /*'patient_id' => 'required',
            'patient_title' => 'required',
            'patient_lastname' => 'required',
            'patient_firstname' => 'required',
            'patient_middlename' => 'required',
            'patient_age' => 'required',
            'patient_gender' => 'required',
            'patient_current_residential_address' => 'required',
            'patient_current_city' => 'required',
            'patient_current_state' => 'required',
            'patient_current_pincode' => 'required',
            'hospital_id' => 'required',
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'hospital_city' => 'required',
            'hospital_state' => 'required',
            'hospital_pincode' => 'required',
            'insurance_company' => 'required',
            'policy_type' => 'required',
            'policy_name' => 'required',
            'policy_start_date' => 'required',
            'policy_expiry_date' => 'required',
            'policy_commencement_date_without_break' => 'required',
            'date_of_admission' => 'required',
            'time_of_admission' => 'required',
            'expected_date_of_discharge' => 'required',
            'expected_no_of_days_in_hospital' => 'required',
            'hospitalization_due_to' => 'required',
            'date_of_delivery' => 'required',
            'date_of_first_consultation' => 'required',
            'system_of_medicine' => 'required',
            'treatment_type' => 'required',
            'admission_type_1' => 'required',
            'admission_type_2' => 'required',
            'admission_type_3' => 'required',
            'claim_category' => 'required',
            'treatment_category' => 'required',
            'disease_category' => 'required',
            'disease_name' => 'required',
            'disease_type' => 'required',
            'nature_of_illness_disease_with_presenting_complaints' => 'required',
            'relevant_clinical_findings' => 'required',
            'past_history_of_any_chronic_illness' => 'required',
            'any_other_aliment_details' => 'required',*/
            /*'primary_diagnosis_icd_leveli_disease' => 'required',
            'primary_diagnosis_icd_leveli_code' => 'required',
            'primary_diagnosis_icd_levelii_disease' => 'required',
            'primary_diagnosis_icd_levelii_code' => 'required',
            'primary_diagnosis_icd_leveliii_disease' => 'required',
            'primary_diagnosis_icd_leveliii_code' => 'required',
            'primary_diagnosis_icd_leveliv_disease' => 'required',
            'primary_diagnosis_icd_leveliv_code' => 'required',
            'additional_diagnosis_icd_leveli_disease' => 'required',
            'additional_diagnosis_icd_leveli_code' => 'required',
            'additional_diagnosis_icd_levelii_disease' => 'required',
            'additional_diagnosis_icd_levelii_code' => 'required',
            'additional_diagnosis_icd_leveliii_disease' => 'required',
            'additional_diagnosis_icd_leveliii_code' => 'required',
            'additional_diagnosis_icd_leveliv_disease' => 'required',
            'additional_diagnosis_icd_leveliv_code' => 'required',
            'co_morbidities_icd_leveli_disease' => 'required',
            'co_morbidities_icd_leveli_code' => 'required',
            'co_morbidities_icd_levelii_disease' => 'required',
            'co_morbidities_icd_levelii_code' => 'required',
            'co_morbidities_icd_leveliii_disease' => 'required',
            'co_morbidities_icd_leveliii_code' => 'required',
            'co_morbidities_icd_leveliv_disease' => 'required',
            'co_morbidities_icd_leveliv_code' => 'required',
            'co_morbidities_comments' => 'required',
            'procedure_name' => 'required',
            'procedure_i_pcs_group_name' => 'required',
            'procedure_i_pcs_group_code' => 'required',
            'procedure_i_pcs_sub_group_name' => 'required',
            'procedure_i_pcs_sub_group_code' => 'required',
            'procedure_i_pcs_short_name' => 'required',
            'procedure_i_pcs_code' => 'required',
            'procedure_i_pcs_long_name' => 'required',
            'procedure_ii_pcs_group_name' => 'required',
            'procedure_ii_pcs_group_code' => 'required',
            'procedure_ii_pcs_sub_group_name' => 'required',
            'procedure_ii_pcs_sub_group_code' => 'required',
            'procedure_ii_pcs_short_name' => 'required',
            'procedure_ii_pcs_code' => 'required',
            'procedure_ii_pcs_long_name' => 'required',
            'procedure_iii_pcs_group_name' => 'required',
            'procedure_iii_pcs_group_code' => 'required',
            'procedure_iii_pcs_sub_group_name' => 'required',
            'procedure_iii_pcs_sub_group_code' => 'required',
            'procedure_iii_pcs_short_name' => 'required',
            'procedure_iii_pcs_code' => 'required',
            'procedure_iii_pcs_long_name' => 'required',*/
            'final_assessment_status' => 'required',
            'processing_query' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
            'final_assessment_amount' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
            // 'final_assessment_comments' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
        ];

        $messages = [
            'patient_id.required' => 'Please enter Patient Id',
            'patient_title.required' => 'Please enter Patient Title',
            'patient_lastname.required' => 'Please enter Patient Lastname',
            'patient_firstname.required' => 'Please enter Patient Firstname',
            'patient_middlename.required' => 'Please enter Patient Middlename',
            'patient_age.required' => 'Please enter Patient Age',
            'patient_gender.required' => 'Please enter Patient Gender',
            'patient_current_residential_address.required' => 'Please enter Patient Current Residential Address',
            'patient_current_city.required' => 'Please enter Patient Current City',
            'patient_current_state.required' => 'Please enter Patient Current State',
            'patient_current_pincode.required' => 'Please enter Patient Current Pincode',
            'hospital_id.required' => 'Please enter Hospital Id',
            'hospital_name.required' => 'Please enter Hospital Name',
            'hospital_address.required' => 'Please enter Hospital Address',
            'hospital_city.required' => 'Please enter Hospital City',
            'hospital_state.required' => 'Please enter Hospital State',
            'hospital_pincode.required' => 'Please enter Hospital Pincode',
            'insurance_company.required' => 'Please enter Insurance Company',
            'policy_type.required' => 'Please enter Policy Type',
            'policy_name.required' => 'Please enter Policy Name',
            'policy_start_date.required' => 'Please enter Policy Start Date',
            'policy_expiry_date.required' => 'Please enter Policy Expiry Date',
            'policy_commencement_date_without_break.required' => 'Please enter Policy Commencement Date Without Break',
            'date_of_admission.required' => 'Please enter Date Of Admission',
            'time_of_admission.required' => 'Please enter Time Of Admission',
            'expected_date_of_discharge.required' => 'Please enter Expected Date Of Discharge',
            'expected_no_of_days_in_hospital.required' => 'Please enter Expected No Of Days In Hospital',
            'hospitalization_due_to.required' => 'Please enter Hospitalization Due To',
            'date_of_delivery.required' => 'Please enter Date Of Delivery',
            'date_of_first_consultation.required' => 'Please enter Date Of First Consultation',
            'system_of_medicine.required' => 'Please enter System Of Medicine',
            'treatment_type.required' => 'Please enter Treatment Type',
            'admission_type_1.required' => 'Please enter Admission Type 1',
            'admission_type_2.required' => 'Please enter Admission Type 2',
            'admission_type_3.required' => 'Please enter Admission Type 3',
            'claim_category.required' => 'Please enter Claim Category',
            'treatment_category.required' => 'Please enter Treatment Category',
            'disease_category.required' => 'Please enter Disease Category',
            'disease_name.required' => 'Please enter Disease Name',
            'disease_type.required' => 'Please enter Disease Type',
            'nature_of_illness_disease_with_presenting_complaints.required' => 'Please enter Nature Of Illness Disease With Presenting Complaints',
            'relevant_clinical_findings.required' => 'Please enter Relevant Clinical Findings',
            'past_history_of_any_chronic_illness.required' => 'Please enter Past History Of Any Chronic Illness',
            'any_other_aliment_details.required' => 'Please enter Any Other Aliment Details',
            'primary_diagnosis_icd_leveli_disease.required' => 'Please enter Primary Diagnosis Icd Level I Disease',
            'primary_diagnosis_icd_leveli_code.required' => 'Please enter Primary Diagnosis Icd Level I Code',
            'primary_diagnosis_icd_levelii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_levelii_code.required' => 'Please enter Primary Diagnosis Icd Level II Code',
            'primary_diagnosis_icd_leveliii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_leveliii_code.required' => 'Please enter Primary Diagnosis Icd Level III Code',
            'primary_diagnosis_icd_leveliv_disease.required' => 'Please enter Primary Diagnosis Icd Level IV Disease',
            'primary_diagnosis_icd_leveliv_code.required' => 'Please enter Primary Diagnosis Icd Level IV Code',
            'additional_diagnosis_icd_leveli_disease.required' => 'Please enter Additional Diagnosis Icd Level I Disease',
            'additional_diagnosis_icd_leveli_code.required' => 'Please enter Additional Diagnosis Icd Level I Code',
            'additional_diagnosis_icd_levelii_disease.required' => 'Please enter Additional Diagnosis Icd Level II Disease',
            'additional_diagnosis_icd_levelii_code.required' => 'Please enter Additional Diagnosis Icd Level II Code',
            'additional_diagnosis_icd_leveliii_disease.required' => 'Please enter Additional Diagnosis Icd Level III Disease',
            'additional_diagnosis_icd_leveliii_code.required' => 'Please enter Additional Diagnosis Icd Level III Code',
            'additional_diagnosis_icd_leveliv_disease.required' => 'Please enter Additional Diagnosis Icd Level IV Disease',
            'additional_diagnosis_icd_leveliv_code.required' => 'Please enter Additional Diagnosis Icd Level IV Code',
            'co_morbidities_icd_leveli_disease.required' => 'Please enter Co Morbidities Icd Level I Disease',
            'co_morbidities_icd_leveli_code.required' => 'Please enter Co Morbidities Icd Level I Code',
            'co_morbidities_icd_levelii_disease.required' => 'Please enter Co Morbidities Icd Level II Disease',
            'co_morbidities_icd_levelii_code.required' => 'Please enter Co Morbidities Icd Level II Code',
            'co_morbidities_icd_leveliii_disease.required' => 'Please enter Co Morbidities Icd Level III Disease',
            'co_morbidities_icd_leveliii_code.required' => 'Please enter Co Morbidities Icd Level III Code',
            'co_morbidities_icd_leveliv_disease.required' => 'Please enter Co Morbidities Icd Level IV Disease',
            'co_morbidities_icd_leveliv_code.required' => 'Please enter Co Morbidities Icd Level IV Code',
            'co_morbidities_comments.required' => 'Please enter Co Morbidities Comments',
            'procedure_name.required' => 'Please enter Procedure Name',
            'procedure_i_pcs_group_name.required' => 'Please enter Procedure I Pcs Group Name',
            'procedure_i_pcs_group_code.required' => 'Please enter Procedure I Pcs Group Code',
            'procedure_i_pcs_sub_group_name.required' => 'Please enter Procedure I Pcs Sub Group Name',
            'procedure_i_pcs_sub_group_code.required' => 'Please enter Procedure I Pcs Sub Group Code',
            'procedure_i_pcs_short_name.required' => 'Please enter Procedure I Pcs Short Name',
            'procedure_i_pcs_code.required' => 'Please enter Procedure I Pcs Code',
            'procedure_i_pcs_long_name.required' => 'Please enter Procedure I Pcs Long Name',
            'procedure_ii_pcs_group_name.required' => 'Please enter Procedure II Pcs Group Name',
            'procedure_ii_pcs_group_code.required' => 'Please enter Procedure II Pcs Group Code',
            'procedure_ii_pcs_sub_group_name.required' => 'Please enter Procedure II Pcs Sub Group Name',
            'procedure_ii_pcs_sub_group_code.required' => 'Please enter Procedure II Pcs Sub Group Code',
            'procedure_ii_pcs_short_name.required' => 'Please enter Procedure II Pcs Short Name',
            'procedure_ii_pcs_code.required' => 'Please enter Procedure II Pcs Code',
            'procedure_ii_pcs_long_name.required' => 'Please enter Procedure II Pcs Long Name',
            'procedure_iii_pcs_group_name.required' => 'Please enter Procedure III Pcs Group Name',
            'procedure_iii_pcs_group_code.required' => 'Please enter Procedure III Pcs Group Code',
            'procedure_iii_pcs_sub_group_name.required' => 'Please enter Procedure III Pcs Sub Group Name',
            'procedure_iii_pcs_sub_group_code.required' => 'Please enter Procedure III Pcs Sub Group Code',
            'procedure_iii_pcs_short_name.required' => 'Please enter Procedure III Pcs Short Name',
            'procedure_iii_pcs_code.required' => 'Please enter Procedure III Pcs Code',
            'procedure_iii_pcs_long_name.required' => 'Please enter Procedure III Pcs Long Name',
            'final_assessment_status.required' => 'Please enter Final Assessment Status',
            'query.required' => 'Please enter query',
            'final_assessment_amount.required' => 'Please enter Final Assessment Amount',
            'final_assessment_comments.required' => 'Please enter Final Assessment Comments',
        ];

        $this->validateWithBag('claim-processing-form', $request, $rules, $messages);

        $details = ClaimProcessing::updateOrCreate([
            'patient_id' => $request->patient_id,
        ],[

            'patient_title' => $request->patient_title,
            'patient_lastname' => $request->patient_lastname,
            'patient_firstname' => $request->patient_firstname,
            'patient_middlename' => $request->patient_middlename,
            'patient_age' => $request->patient_age,
            'patient_gender' => $request->patient_gender,
            'patient_current_residential_address' => $request->patient_current_residential_address,
            'patient_current_city' => $request->patient_current_city,
            'patient_current_state' => $request->patient_current_state,
            'patient_current_pincode' => $request->patient_current_pincode,
            'hospital_id' => $request->hospital_id,
            'hospital_name' => $request->hospital_name,
            'hospital_address' => $request->hospital_address,
            'hospital_city' => $request->hospital_city,
            'hospital_state' => $request->hospital_state,
            'hospital_pincode' => $request->hospital_pincode,
            'insurance_company' => $request->insurance_company,
            'policy_type' => $request->policy_type,
            'policy_name' => $request->policy_name,
            'policy_start_date' => $request->policy_start_date,
            'policy_expiry_date' => $request->policy_expiry_date,
            'policy_commencement_date_without_break' => $request->policy_commencement_date_without_break,
            'date_of_admission' => $request->date_of_admission,
            'time_of_admission' => $request->time_of_admission,
            'expected_date_of_discharge' => $request->expected_date_of_discharge,
            'expected_no_of_days_in_hospital' => $request->expected_no_of_days_in_hospital,
            'hospitalization_due_to' => $request->hospitalization_due_to,
            'date_of_delivery' => $request->date_of_delivery,
            'date_of_first_consultation' => $request->date_of_first_consultation,
            'system_of_medicine' => $request->system_of_medicine,
            'treatment_type' => $request->treatment_type,
            'admission_type_1' => $request->admission_type_1,
            'admission_type_2' => $request->admission_type_2,
            'admission_type_3' => $request->admission_type_3,
            'claim_category' => $request->claim_category,
            'treatment_category' => $request->treatment_category,
            'disease_category' => $request->disease_category,
            'disease_name' => $request->disease_name,
            'disease_type' => $request->disease_type,
            'nature_of_illness_disease_with_presenting_complaints' => $request->nature_of_illness_disease_with_presenting_complaints,
            'relevant_clinical_findings' => $request->relevant_clinical_findings,
            'past_history_of_any_chronic_illness' => $request->past_history_of_any_chronic_illness,
            'any_other_aliment_details' => $request->any_other_aliment_details,
            'primary_diagnosis_icd_leveli_disease' => $request->primary_diagnosis_icd_leveli_disease,
            'primary_diagnosis_icd_leveli_code' => $request->primary_diagnosis_icd_leveli_code,
            'primary_diagnosis_icd_levelii_disease' => $request->primary_diagnosis_icd_levelii_disease,
            'primary_diagnosis_icd_levelii_code' => $request->primary_diagnosis_icd_levelii_code,
            'primary_diagnosis_icd_leveliii_disease' => $request->primary_diagnosis_icd_leveliii_disease,
            'primary_diagnosis_icd_leveliii_code' => $request->primary_diagnosis_icd_leveliii_code,
            'primary_diagnosis_icd_leveliv_disease' => $request->primary_diagnosis_icd_leveliv_disease,
            'primary_diagnosis_icd_leveliv_code' => $request->primary_diagnosis_icd_leveliv_code,
            'additional_diagnosis_icd_leveli_disease' => $request->additional_diagnosis_icd_leveli_disease,
            'additional_diagnosis_icd_leveli_code' => $request->additional_diagnosis_icd_leveli_code,
            'additional_diagnosis_icd_levelii_disease' => $request->additional_diagnosis_icd_levelii_disease,
            'additional_diagnosis_icd_levelii_code' => $request->additional_diagnosis_icd_levelii_code,
            'additional_diagnosis_icd_leveliii_disease' => $request->additional_diagnosis_icd_leveliii_disease,
            'additional_diagnosis_icd_leveliii_code' => $request->additional_diagnosis_icd_leveliii_code,
            'additional_diagnosis_icd_leveliv_disease' => $request->additional_diagnosis_icd_leveliv_disease,
            'additional_diagnosis_icd_leveliv_code' => $request->additional_diagnosis_icd_leveliv_code,
            'co_morbidities_icd_leveli_disease' => $request->co_morbidities_icd_leveli_disease,
            'co_morbidities_icd_leveli_code' => $request->co_morbidities_icd_leveli_code,
            'co_morbidities_icd_levelii_disease' => $request->co_morbidities_icd_levelii_disease,
            'co_morbidities_icd_levelii_code' => $request->co_morbidities_icd_levelii_code,
            'co_morbidities_icd_leveliii_disease' => $request->co_morbidities_icd_leveliii_disease,
            'co_morbidities_icd_leveliii_code' => $request->co_morbidities_icd_leveliii_code,
            'co_morbidities_icd_leveliv_disease' => $request->co_morbidities_icd_leveliv_disease,
            'co_morbidities_icd_leveliv_code' => $request->co_morbidities_icd_leveliv_code,
            'co_morbidities_comments' => $request->co_morbidities_comments,
            'procedure_name' => $request->procedure_name,
            'procedure_i_pcs_group_name' => $request->procedure_i_pcs_group_name,
            'procedure_i_pcs_group_code' => $request->procedure_i_pcs_group_code,
            'procedure_i_pcs_sub_group_name' => $request->procedure_i_pcs_sub_group_name,
            'procedure_i_pcs_sub_group_code' => $request->procedure_i_pcs_sub_group_code,
            'procedure_i_pcs_short_name' => $request->procedure_i_pcs_short_name,
            'procedure_i_pcs_code' => $request->procedure_i_pcs_code,
            'procedure_i_pcs_long_name' => $request->procedure_i_pcs_long_name,
            'procedure_ii_pcs_group_name' => $request->procedure_ii_pcs_group_name,
            'procedure_ii_pcs_group_code' => $request->procedure_ii_pcs_group_code,
            'procedure_ii_pcs_sub_group_name' => $request->procedure_ii_pcs_sub_group_name,
            'procedure_ii_pcs_sub_group_code' => $request->procedure_ii_pcs_sub_group_code,
            'procedure_ii_pcs_short_name' => $request->procedure_ii_pcs_short_name,
            'procedure_ii_pcs_code' => $request->procedure_ii_pcs_code,
            'procedure_ii_pcs_long_name' => $request->procedure_ii_pcs_long_name,
            'procedure_iii_pcs_group_name' => $request->procedure_iii_pcs_group_name,
            'procedure_iii_pcs_group_code' => $request->procedure_iii_pcs_group_code,
            'procedure_iii_pcs_sub_group_name' => $request->procedure_iii_pcs_sub_group_name,
            'procedure_iii_pcs_sub_group_code' => $request->procedure_iii_pcs_sub_group_code,
            'procedure_iii_pcs_short_name' => $request->procedure_iii_pcs_short_name,
            'procedure_iii_pcs_code' => $request->procedure_iii_pcs_code,
            'procedure_iii_pcs_long_name' => $request->procedure_iii_pcs_long_name,
            'final_assessment_status' => $request->final_assessment_status,
            'processing_query' => $request->processing_query,
            'final_assessment_amount' => $request->final_assessment_amount,
            'final_assessment_comments' => $request->final_assessment_comments,
        ]);

        return redirect()->back()->with('success', 'Claim created successfully');

    }

    public function index(Request $request)
    {
        $filter_search = $request->search;
        $claims = Claim::where('hospital_id',auth()->user()->id)->with('patient');
        if ($filter_search) {
            $claims->whereHas('patient', function ($q) use ($filter_search) {
                $q->where(function ($q) use ($filter_search) {
                    $q->where('uid', 'like', '%' . $filter_search . '%');
                });
            });
        }

        $claims = $claims->orderBy('id', 'desc')->paginate(20);

        foreach ($claims as $key => $claim) {
            $claimant = Claimant::where('claim_id', $claim->id)->exists();

            $borrower = Borrower::where('claim_id', $claim->id)->exists();

            $assessment = AssessmentStatus::where('claim_id', $claim->id)->exists();
            $discharge = DischargeStatus::where('claim_id', $claim->id)->exists();
            $claim_processing = ClaimProcessing::where('claim_id', $claim->id)->exists();

            if ($claimant) {
                $claimant = Claimant::where('claim_id', $claim->id)->value('id');
                $claimant_status = Claimant::where('claim_id', $claim->id)->value('status');
                $claims[$key]->claimant = $claimant;
                $claims[$key]->claimant_status = $claimant_status;
            }else{
                $claims[$key]->claimant = '';
            }

            if ($borrower) {
                $borrower = Borrower::where('claim_id', $claim->id)->value('id');
                $borrower_status = Borrower::where('claim_id', $claim->id)->value('status');
                $claims[$key]->borrower = $claim->id;
                $claims[$key]->borrower_status = $borrower_status;
            }else{
                $claims[$key]->borrower = '';
            }

            if ($assessment) {
                $assessment = AssessmentStatus::where('claim_id', $claim->id)->value('id');
                $claims[$key]->assessment = $claim->id;
            }else{
                $claims[$key]->assessment = '';
            }

            if ($discharge) {
                $discharge = DischargeStatus::where('claim_id', $claim->id)->value('id');
                $claims[$key]->discharge = $claim->id;
            }else{
                $claims[$key]->discharge = '';
            }

            if ($claim_processing) {
                $claim_processing = ClaimProcessing::where('claim_id', $claim->id)->value('id');
                $claims[$key]->claim_processing = $claim->id;
            }else{
                $claims[$key]->claim_processing = '';
            }

        }

        // echo "<pre>";print_r($claims->toArray());"</pre>";exit;

        return view('hospital.claims.claims.manage',  compact('claims', 'filter_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patient_id     = $request->patient_id;
        $hospitals      = Hospital::get();
        $patient        = isset($patient_id) ? Patient::find($request->patient_id) : null;
        $patients       = Patient::where('hospital_id',auth()->user()->id)->get();
        return view('hospital.claims.claims.create.create',  compact('hospitals', 'patient_id', 'patient', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules =  [
            'patient_id'                => 'required',
            'hospital_name'             => 'required',
            'hospital_address'          => 'required',
            'hospital_city'             => 'required',
            'hospital_state'            => 'required',
            'hospital_pincode'          => 'required|numeric',
            'associate_partner_id'      => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'           => 'required|max:20',
            'title'                     => 'required',
            'firstname'                 => 'required|max:25',
            'lastname'                  => isset($request->lastname) ? 'max:25' : '',
            'middlename'                => isset($request->middlename) ? 'max:25' : '',
            'age'                       => 'required',
            'gender'                    => 'required',
            'admission_date'            => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'admission_time'            => 'required',
            'abha_id'                   => isset($request->abha_id) ? 'max:45' : '',
            'insurance_coverage'        => 'required',
            'policy_no'                 => $request->insurance_coverage == 'Yes' ? 'required|max:16' : '',
            'company_tpa_id_card_no'    => $request->insurance_coverage == 'Yes' ? 'required|max:16' : '',
            'lending_required'          => 'required',
            'hospitalization_due_to'    => 'required',
            'date_of_delivery'          => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'system_of_medicine'        => 'required',
            'treatment_type'            => 'required',
            'admission_type_1'          => 'required',
            'admission_type_2'          => 'required',
            'admission_type_3'          => 'required',
            'claim_category'            => 'required',
            'treatment_category'        => $request->system_of_medicine == 'Allopathy' ? 'required' : '',
            'disease_category'          => 'required',
            'disease_name'              => 'required',
            'disease_type'              => 'required',
            'estimated_amount'          => 'required|max:8',
            'comments'                  => isset($request->comments) ? 'max:250' : '',
            'discharge_date'            => 'required|date|after_or_equal:admission_date',
            'days_in_hospital'          => 'required',
            'room_category'             => 'required',
            'consultation_date'         => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'nature_of_illness'         => 'required',
            'clinical_finding'          => 'required',
            'chronic_illness'           => 'required',
            'ailment_details'           => $request->chronic_illness == 'Any other ailment' ? 'required' : '',
            'has_family_physician'      => $request->claim_category == 'Cashless' ? 'required' : '',
            'family_physician'          => $request->has_family_physician == 'Yes' ? 'required' : '',
            'family_physician_contact_no'=> $request->has_family_physician == 'Yes' ? 'required' : '',
        ];

        $messages =  [
            'patient_id.required'                => 'Please select Patient ID',
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
            'age.required'                       => 'Please enter Age',
            'gender.required'                    => 'Please select Gender',
            'admission_date.required'            => 'Please enter Admission date',
            'admission_time.required'            => 'Please enter Admission time',
            'abha_id.required'                   => 'Please enter ABHA ID',
            'insurance_coverage.required'        => 'Please select Insurance Coverage',
            'policy_no.required'                 => 'Please enter Policy No.',
            'policy_file.required'               => 'Please upload Policy',
            'company_tpa_id_card_no.required'    => 'Please enter Company / TPA ID Card No.',
            'company_tpa_id_card_file.required'  => 'Please upload Company / TPA ID Card.',
            'lending_required.required'          => 'Please select Lending required',
            'hospitalization_due_to.required'    => 'Please select Hospitalization due to',
            'date_of_delivery.required'          => 'Please enter Date of delivery',
            'system_of_medicine.required'        => 'Please select System of medicine',
            'treatment_type.required'            => 'Please select Treatment type',
            'admission_type_1.required'          => 'Please select Admission type 1',
            'admission_type_2.required'          => 'Please select Admission type 2',
            'admission_type_3.required'          => 'Please select Admission type 3',
            'claim_category.required'            => 'Please select claim category',
            'treatment_category.required'        => 'Please select treatment category',
            'disease_category.required'          => 'Please select disease category',
            'disease_name.required'              => 'Please enter disease name',
            'disease_type.required'              => 'Please select disease type',
            'estimated_amount.required'          => 'Please enter estimated amount',
        ];

        $this->validate($request, $rules, $messages);

        $claim = Claim::create([
            'patient_id'                => $request->patient_id,
            'hospital_id'               => auth()->user()->id,
            'admission_date'            => $request->admission_date,
            'admission_time'            => $request->admission_time,
            'abha_id'                   => $request->abha_id,
            'insurance_coverage'        => $request->insurance_coverage,
            'policy_no'                 => $request->policy_no,
            'company_tpa_id_card_no'    => $request->company_tpa_id_card_no,
            'lending_required'          => $request->lending_required,
            'hospitalization_due_to'    => $request->hospitalization_due_to,
            'date_of_delivery'          => $request->date_of_delivery,
            'system_of_medicine'        => $request->system_of_medicine,
            'treatment_type'            => $request->treatment_type,
            'admission_type_1'          => $request->admission_type_1,
            'admission_type_2'          => $request->admission_type_2,
            'admission_type_3'          => $request->admission_type_3,
            'claim_category'            => $request->claim_category,
            'treatment_category'        => $request->treatment_category,
            'disease_category'          => $request->disease_category,
            'disease_name'              => $request->disease_name,
            'disease_type'              => $request->disease_type,
            'estimated_amount'          => $request->estimated_amount,
            'comments'                  => $request->comments,
            'discharge_date'            => $request->discharge_date,
            'days_in_hospital'          => $request->days_in_hospital,
            'room_category'             => $request->room_category,
            'consultation_date'         => $request->consultation_date,
            'nature_of_illness'         => $request->nature_of_illness,
            'clinical_finding'          => $request->clinical_finding,
            'chronic_illness'           => $request->chronic_illness,
            'ailment_details'           => $request->ailment_details,
            'has_family_physician'      => $request->has_family_physician,
            'family_physician'          => $request->family_physician,
            'family_physician_contact_no' => $request->family_physician_contact_no,
        ]);

        Claim::where('id', $claim->id)->update([
            'uid'      => 'C-' . Carbon::parse($claim->created_at)->format('Y-m-d') . '-' . $claim->id
        ]);

        Patient::where('id', $claim->patient_id)->update([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
        ]);

        return redirect()->route('hospital.claims.edit', $claim->id)->with('success', 'Claim created successfully');
    }

    public function saveAssesmentStatus(Request $request)
    {

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
            'patient_title'                              => 'required|max:20',
            'patient_lastname'                           => 'required|max:255',
            'patient_firstname'                          => 'required|max:255',
            'policy_no'                                  => 'required|max:255',
            'start_date'                                 => 'required',
            'expiry_date'                                => 'required',
            'commencement_date'                          => 'required',
            'hospital_on_the_panel_of_insurance_co'      => 'required',
            'hospital_id_insurance_co'                   => 'required',
            'pre_assessment_status'                      => 'required',
            'query_pre_assessment'                       => 'required|max:255',
            'pre_assessment_amount'                      => 'required|max:255',
            'pre_assessment_suspected_fraud'             => 'required',
            'final_assessment_status'                    => 'required',
            'query_final_assessment'                     => 'required',
            'final_assessment_amount'                    => 'required|max:255',
            'final_assessment_suspected_fraud'           => 'required',


        ];

        $messages =  [
            'patient_id.required'                         => 'Please select Patient ID',
            'claim_id.required'                           => 'please enter claim ID',
            'claimant_id.required'                        => 'please enter claimant ID',
            'hospital_name.required'                      => 'Please enter Hospital Name',
            'hospital_id.required'                        => 'Please enter Hospital ID.',
            'hospital_address.required'                   => 'Please enter Hospital address.',
            'hospital_city.required'                      => 'Please enter Hospital city.',
            'hospital_state.required'                     => 'Please enter Hospital state.',
            'hospital_pincode.required'                   => 'Please enter Hospital pincode.',
            'patient_title.required'                      => 'Please select patient title',
            'patient_lastname.required'                   => 'please enter patient lastname',
            'patient_firstname.required'                  => 'please enter patient firstname',
            'policy_no.required'                          => 'please enter policy number',
            'start_date.required'                         => 'please enter start date',
            'expiry_date.required'                        => 'please enter expiry date',
            'commencement_date.required'                  => 'please enter commencement date',
            'hospital_on_the_panel_of_insurance_co.required'   => 'please enter hospital on the panel',
            'hospital_id_insurance_co.required'           => 'please enter hospital id insurance co',
            'pre_assessment_status.required'              => 'please enter pre assessment status',
            'query_pre_assessment.required'               => 'please enter query pre assessment',
            'pre_assessment_amount.required'              => 'please enter pre assessment amount',
            'pre_assessment_suspected_fraud.required'     => 'please enter pre assessment suspected fraud',
            'final_assessment_status.required'            => 'please enter final assessment status',
            'final_assessment_amount.required'            => 'please enter final assessment amount',
            'final_assessment_suspected_fraud.required'   => 'please enter final assessment suspected fraud',


        ];

        $this->validateWithBag('assisment-status-form', $request, $rules, $messages);

        $request = $request->except('_token');
        $request['patient_name'] = $request['patient_firstname']." ".$request['patient_middlename']." ".$request['patient_lastname'];
        AssessmentStatus::create($request);
        return redirect()->route('hospital.claims.assessment-status')->with('success', 'Assessment status saved successfully');

    }

    public function updateInsurancePolicy(Request $request, $id)
    {
        $rules = [
            'patient_id'                                => 'required',
            'claim_id'                                  => 'required',
            'policy_no'                                 => 'required|max:16',
            'insurance_company'                         => 'required',
            'policy_name'                               => $request->policy_type != 'Group' ? 'required' : '',
            'certificate_no'                            => 'required|max:16',
            'company_tpa_id_card_no'                    => 'required|max:16',
            'tpa_name'                                  => 'required|max:75',
            'policy_type'                               => 'required',
            'group_name'                                => $request->policy_type == 'Group' ? 'required|max:75' : '',
            'previous_policy_no'                        => $request->policy_type == 'Retail' ? 'required|max:16' : '',
            'start_date'                                => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'expiry_date'                               => 'required|after:start_date',
            'commencement_date'                         => 'required',
            'proposer_title'                            => 'required',
            'proposer_firstname'                        => 'required|max:25',
            'proposer_middlename'                       => isset($request->proposer_middlename) ? 'max:25' : '',
            'proposer_lastname'                         => isset($request->proposer_lastname) ? 'max:25' : '',
            'is_primary_insured_and_patient_same'       => 'required',
            'primary_insured_address'                   => $request->is_primary_insured_and_patient_same == 'Yes' ? 'required' : 'required|max:100',
            'primary_insured_city'                      => 'required',
            'primary_insured_state'                     => 'required',
            'primary_insured_pincode'                   => 'required',
            'no_of_person_insured'                      => 'required|max:2',
            'basic_sum_insured'                         => 'required|max:8',
            'cumulative_bonus_cv'                       => 'required|max:8',
            'agent_broker_code'                         => isset($request->agent_broker_code) ? 'max:10' : '',
            'agent_broker_name'                         => isset($request->agent_broker_name) ? 'max:60' : '',
            'additional_policy'                         => 'required',
            'policy_no_additional'                      => $request->additional_policy == 'Yes' ? 'required' : '',
            'currently_covered'                         => 'required',
            'commencement_date_other'                   => $request->currently_covered == 'Yes' ? 'required' : '',
            'insurance_company_other'                   => $request->currently_covered == 'Yes' ? 'required|max:60' : '',
            'policy_no_other'                           => $request->currently_covered == 'Yes' ? 'required|max:16' : '',
            'sum_insured_other'                         => $request->currently_covered == 'Yes' ? 'required|max:8' : '',
            // 'hospitalized'                              => 'required',
            'admission_date_past'                       => $request->hospitalized == 'Yes' ? 'required|before:today' : '',
            'diagnosis'                                 => $request->hospitalized == 'Yes' ? 'required|max:60' : '',
            'primary_insured_firstname'                 => 'required|max:15',
            'primary_insured_gender'                    => 'required',
            'primary_insured_age'                       => 'required|max:3',
            'primary_insured_relation'                  => 'required',
            'primary_insured_sum_insured'               => 'required|max:8',
            'primary_insured_cumulative_bonus'          => 'required|max:8',
            'primary_insured_balance_sum_insured'       => 'required|max:8',
            'dependent_insured_firstname'               => 'required|max:15',
            'dependent_insured_gender'                  => 'required',
            'dependent_insured_age'                     => 'required|max:3',
            'dependent_insured_relation'                => 'required',
            'dependent_insured_sum_insured'             => 'required|max:8',
            'dependent_insured_cumulative_bonus'        => 'required|max:8',
            'dependent_insured_balance_sum_insured'     => 'required|max:8',
        ];

        $messages = [
            'patient_id.required'                                => 'Please enter Patient UID',
            'claim_id.required'                                  => 'Please enter Claim UID',
            'policy_no.required'                                 => 'Please enter Policy No.',
            'insurance_company.required'                         => 'Please select Insurance Company',
            'policy_name.required'                               => 'Please select Policy Name',
            'certificate_no.required'                            => 'Please enter SI No. / Certificate No.',
            'company_tpa_id_card_no.required'                    => 'Please enter Company / TPA ID Card No.',
            'tpa_name.required'                                  => 'Please enter TPA Name.',
            'policy_type.required'                               => 'Please select Policy Type',
            'group_name.required'                                => 'Please enter Group Name.',
            'previous_policy_no.required'                        => 'Please enter Previous Policy No.',
            'start_date.required'                                => 'Please enter Policy Start Date.',
            'expiry_date.required'                               => 'Please enter Policy Expiry Date.',
            'commencement_date.required'                         => 'Please enter Policy Commencement Date.',
            'proposer_title.required'                            => 'Please select Title.',
            'proposer_firstname.required'                        => 'Please select Title.',
            'is_primary_insured_and_patient_same.required'       => 'Please select If Primary insured and Patient are same.',
            'primary_insured_address.required'                   => 'Please enter Address.',
            'primary_insured_city.required'                      => 'Please enter City.',
            'primary_insured_state.required'                     => 'Please enter State.',
            'primary_insured_pincode.required'                   => 'Please enter Pincode.',
            'no_of_person_insured.required'                      => 'Please enter No. of person insured',
            'basic_sum_insured.required'                         => 'Please enter Basic sum insured.',
            'cumulative_bonus_cv.required'                       => 'Please enter Cumulative Bonus.',
            'agent_broker_code.required'                         => 'Please enter Agent Broker Code.',
            'agent_broker_name.required'                         => 'Please enter Agent Broker Name.',
            'additional_policy.required'                         => 'Please select if covered under any Top-up/Additional Policy.',
            'policy_no_additional.required'                      => 'Please enter Policy No. (Top Up / Additional)',
            'currently_covered.required'                         => 'Please select if currently covered by any other Mediclaim/Health Insurance.',
            'commencement_date_other.required'                   => 'Please enter Policy Commencement Date (Other Policy).',
            'insurance_company_other.required'                   => 'Please enter Insurance Company Name (Other Policy).',
            'policy_no_other.required'                           => 'Please enter Policy No. (Other Policy)',
            'sum_insured_other.required'                         => 'Please enter Sum Insured (Other Policy)',
            'hospitalized.required'                              => 'Please select if patient ever been hospitalized in the last 4 years since the inception of the contract',
            'admission_date_past.required'                       => 'Please enter Admission Date (Past)',
            'diagnosis.required'                                 => 'Please enter Diagnosis (Previous)',
            'primary_insured_firstname.required'                 => 'Please enter First name',
            'primary_insured_gender.required'                    => 'Please select Gender',
            'primary_insured_age.required'                       => 'Please enter age',
            'primary_insured_relation.required'                  => 'Please select Relation',
            'primary_insured_sum_insured.required'               => 'Please enter sum insured',
            'primary_insured_cumulative_bonus.required'          => 'Please enter cumulative bonus',
            'primary_insured_balance_sum_insured.required'       => 'Please enter balance sum insured',
            'dependent_insured_firstname.required'               => 'Please enter First name',
            'dependent_insured_gender.required'                  => 'Please select Gender',
            'dependent_insured_age.required'                     => 'Please enter age',
            'dependent_insured_relation.required'                => 'Please select Relation',
            'dependent_insured_sum_insured.required'             => 'Please enter sum insured',
            'dependent_insured_cumulative_bonus.required'        => 'Please enter cumulative bonus',
            'dependent_insured_balance_sum_insured.required'     => 'Please enter balance sum insured',

        ];

        $this->validate($request, $rules, $messages);
        $claim            = Claim::find($id);
        $insurance_policy = InsurancePolicy::updateOrCreate([
            'claim_id'                                  => $id,
        ],
        [
            'patient_id'                                => $claim->patient_id,
            'policy_no'                                 => $request->policy_no,
            'insurer_id'                                => $request->insurance_company,
            'policy_id'                                 => $request->policy_name,
            'certificate_no'                            => $request->certificate_no,
            'company_tpa_id_card_no'                    => $request->company_tpa_id_card_no,
            'tpa_name'                                  => $request->tpa_name,
            'policy_type'                               => $request->policy_type,
            'group_name'                                => $request->group_name,
            'previous_policy_no'                        => $request->previous_policy_no,
            'start_date'                                => $request->start_date,
            'expiry_date'                               => $request->expiry_date,
            'commencement_date'                         => $request->commencement_date,
            'title'                                     => $request->proposer_title,
            'firstname'                                 => $request->proposer_firstname,
            'middlename'                                => $request->proposer_middlename,
            'lastname'                                  => $request->proposer_lastname,
            'is_primary_insured_and_patient_same'       => $request->is_primary_insured_and_patient_same,
            'primary_insured_address'                   => $request->primary_insured_address,
            'primary_insured_city'                      => $request->primary_insured_city,
            'primary_insured_state'                     => $request->primary_insured_state,
            'primary_insured_pincode'                   => $request->primary_insured_pincode,
            'no_of_person_insured'                      => $request->no_of_person_insured,
            'basic_sum_insured'                         => $request->basic_sum_insured,
            'cumulative_bonus_cv'                       => $request->cumulative_bonus_cv,
            'agent_broker_code'                         => $request->agent_broker_code,
            'agent_broker_name'                         => $request->agent_broker_name,
            'additional_policy'                         => $request->additional_policy,
            'policy_no_additional'                      => $request->policy_no_additional,
            'currently_covered'                         => $request->currently_covered,
            'commencement_date_other'                   => $request->commencement_date_other,
            'insurance_company_other'                   => $request->has('insurance_company_other') ? $request->insurance_company_other : null,
            'policy_no_other'                           => $request->policy_no_other,
            'sum_insured_other'                         => $request->sum_insured_other,
            'hospitalized'                              => $request->hospitalized,
            'admission_date_past'                       => $request->admission_date_past,
            'diagnosis'                                 => $request->diagnosis,
            'comments'                                  => $request->comments,
            'primary_insured_firstname'                 => $request->primary_insured_firstname,
            'primary_insured_lastname'                  => $request->primary_insured_lastname,
            'primary_insured_gender'                    => $request->primary_insured_gender,
            'primary_insured_age'                       => $request->primary_insured_age,
            'primary_insured_relation'                  => $request->primary_insured_relation,
            'primary_insured_sum_insured'               => $request->primary_insured_sum_insured,
            'primary_insured_cumulative_bonus'          => $request->primary_insured_cumulative_bonus,
            'primary_insured_balance_sum_insured'       => $request->primary_insured_balance_sum_insured,
            'primary_insured_comment'                   => $request->primary_insured_comment,
            'dependent_insured_firstname'               => $request->dependent_insured_firstname,
            'dependent_insured_lastname'                => $request->dependent_insured_lastname,
            'dependent_insured_gender'                  => $request->dependent_insured_gender,
            'dependent_insured_age'                     => $request->dependent_insured_age,
            'dependent_insured_relation'                => $request->dependent_insured_relation,
            'dependent_insured_sum_insured'             => $request->dependent_insured_sum_insured,
            'dependent_insured_cumulative_bonus'        => $request->dependent_insured_cumulative_bonus,
            'dependent_insured_balance_sum_insured'     => $request->dependent_insured_balance_sum_insured,
            'dependent_insured_comment'                 => $request->dependent_insured_comment,
        ]);

        return redirect()->route('hospital.claims.index')->with('success', 'Claim updated successfully');

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
        $hospitals      = Hospital::get();
        $insurers       = Insurer::get();
        $tpas            = Tpa::get();
        $claim          = Claim::with('patient')->find($id);
        $patients       = Patient::get();
        return view('hospital.claims.claims.edit.edit',  compact('hospitals', 'claim', 'patients', 'insurers', 'tpas'));
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
        $claim = Claim::find($id);

        switch ($request->form_type) {
            case 'claim-edit-form':

        $rules =  [
            'patient_id'                => 'required',
            'hospital_name'             => 'required',
            'hospital_address'          => 'required',
            'hospital_city'             => 'required',
            'hospital_state'            => 'required',
            'hospital_pincode'          => 'required|numeric',
            'associate_partner_id'      => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'           => 'required|max:20',
            'title'                     => 'required',
            'firstname'                 => 'required|max:25',
            'lastname'                  => isset($request->lastname) ? 'max:25' : '',
            'middlename'                => isset($request->middlename) ? 'max:25' : '',
            'age'                       => 'required',
            'gender'                    => 'required',
            'admission_date'            => 'required',
            'admission_time'            => 'required',
            'abha_id'                   => isset($request->abha_id) ? 'max:45' : '',
            'insurance_coverage'        => 'required',
            'policy_no'                 => $request->insurance_coverage == 'Yes' ? 'required|max:16' : '',
            'company_tpa_id_card_no'    => $request->insurance_coverage == 'Yes' ? 'required|max:16' : '',
            'lending_required'          => 'required',
            'hospitalization_due_to'    => 'required',
            'date_of_delivery'          => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'system_of_medicine'        => 'required',
            'treatment_type'            => 'required',
            'admission_type_1'          => 'required',
            'admission_type_2'          => 'required',
            'admission_type_3'          => 'required',
            'claim_category'            => 'required',
            'treatment_category'        => $request->system_of_medicine == 'Allopathy' ? 'required' : '',
            'disease_category'          => 'required',
            'disease_name'              => 'required',
            'disease_type'              => 'required',
            'estimated_amount'          => 'required|max:8',
            'discharge_date'            => 'required|date|after_or_equal:admission_date',
            'days_in_hospital'          => 'required',
            'room_category'             => 'required',
            'consultation_date'         => 'required|before_or_equal:' . now()->format('Y-m-d'),
            'nature_of_illness'         => 'required',
            'clinical_finding'          => 'required',
            'chronic_illness'           => 'required',
            'ailment_details'           => $request->chronic_illness == 'Any other ailment' ? 'required' : '',
            'has_family_physician'      => $request->claim_category == 'Cashless' ? 'required' : '',
            'family_physician'          => $request->has_family_physician == 'Yes' ? 'required' : '',
            'family_physician_contact_no'=> $request->has_family_physician == 'Yes' ? 'required' : '',
            'comments'                  => isset($request->comments) ? 'max:250' : '',
        ];

        $messages =  [
            'patient_id.required'                   => 'Please select Patient ID',
            'hospital_name.required'                => 'Please enter Hospital  Name',
            'hospital_id.required'                  => 'Please enter Hospital ID.',
            'hospital_address.required'             => 'Please enter Hospital address.',
            'hospital_city.required'                => 'Please enter Hospital city.',
            'hospital_state.required'               => 'Please enter Hospital state.',
            'hospital_pincode.required'             => 'Please enter Hospital pincode.',
            'associate_partner_id.required'         => 'Please enter Associate Partner Id.',
            'registration_no.required'              => 'Please enter IP (In-patient) Registration No.',
            'title.required'                        => 'Please select Title',
            'firstname.required'                    => 'Please enter Firstname',
            'age.required'                          => 'Please enter Age',
            'gender.required'                       => 'Please select Gender',
            'admission_date.required'               => 'Please enter Admission date',
            'admission_time.required'               => 'Please enter Admission time',
            'abha_id.required'                      => 'Please enter ABHA ID',
            'insurance_coverage.required'           => 'Please select Insurance Coverage',
            'policy_no.required'                 => 'Please enter Policy No.',
            'policy_file.required'               => 'Please upload Policy',
            'company_tpa_id_card_no.required'    => 'Please enter Company / TPA ID Card No.',
            'company_tpa_id_card_file.required'  => 'Please upload Company / TPA ID Card.',
            'lending_required.required'             => 'Please select Lending required',
            'hospitalization_due_to.required'       => 'Please select Hospitalization due to',
            'date_of_delivery.required'             => 'Please enter Date of delivery',
            'system_of_medicine.required'           => 'Please select System of medicine',
            'treatment_type.required'               => 'Please select Treatment type',
            'admission_type_1.required'             => 'Please select Admission type 1',
            'admission_type_2.required'             => 'Please select Admission type 2',
            'admission_type_3.required'             => 'Please select Admission type 3',
            'claim_category.required'               => 'Please select claim category',
            'treatment_category.required'           => 'Please select treatment category',
            'disease_category.required'             => 'Please select disease category',
            'disease_name.required'                 => 'Please enter disease name',
            'disease_type.required'                 => 'Please select disease type',
            'estimated_amount.required'             => 'Please enter estimated amount',
        ];

        $this->validate($request, $rules, $messages);

        $claim = Claim::where('id', $id)->update([
            'admission_date'                        => $request->admission_date,
            'admission_time'                        => $request->admission_time,
            'abha_id'                               => $request->abha_id,
            'insurance_coverage'                    => $request->insurance_coverage,
            'policy_no'                             => $request->policy_no,
            'company_tpa_id_card_no'                => $request->company_tpa_id_card_no,
            'lending_required'                      => $request->lending_required,
            'hospitalization_due_to'                => $request->hospitalization_due_to,
            'date_of_delivery'                      => $request->date_of_delivery,
            'system_of_medicine'                    => $request->system_of_medicine,
            'treatment_type'                        => $request->treatment_type,
            'admission_type_1'                      => $request->admission_type_1,
            'admission_type_2'                      => $request->admission_type_2,
            'admission_type_3'                      => $request->admission_type_3,
            'claim_category'                        => $request->claim_category,
            'treatment_category'                    => $request->treatment_category,
            'disease_category'                      => $request->disease_category,
            'disease_name'                          => $request->disease_name,
            'disease_type'                          => $request->disease_type,
            'estimated_amount'                      => $request->estimated_amount,
            'comments'                              => $request->comments,
            'discharge_date'                        => $request->discharge_date,
            'days_in_hospital'                      => $request->days_in_hospital,
            'room_category'                         => $request->room_category,
            'consultation_date'                     => $request->consultation_date,
            'nature_of_illness'                     => $request->nature_of_illness,
            'clinical_finding'                      => $request->clinical_finding,
            'chronic_illness'                       => $request->chronic_illness,
            'ailment_details'                       => $request->ailment_details,
            'has_family_physician'                  => $request->has_family_physician,
            'family_physician'                      => $request->family_physician,
            'family_physician_contact_no'           => $request->family_physician_contact_no,
        ]);


        Patient::where('id', $request->patient_id)->update([
            'title'                             => $request->title,
            'firstname'                         => $request->firstname,
            'middlename'                        => $request->middlename,
            'lastname'                          => $request->lastname,
            'age'                               => $request->age,
            'gender'                            => $request->gender,
            'hospital_name'                     => $request->hospital_name,
            'hospital_address'                  => $request->hospital_address,
            'hospital_city'                     => $request->hospital_city,
            'hospital_state'                    => $request->hospital_state,
            'registration_number'               => $request->registration_no,
            'hospital_pincode'                  => $request->hospital_pincode,
            'associate_partner_id'              => $request->associate_partner_id,
        ]);

        break;

        case 'claim-intimation-form':
        
        $rules =  [
            'claim_intimation_done'         => $request->insurance_coverage == 'Yes' ? 'required' : '',
            'claim_intimation_number_mail'  => $request->claim_intimation_done == 'Yes' ? 'required' : '',
        ];

        $messages =  [
            'claim_intimation_done.required'        => 'Please select if claim intimation is done or not',
            'claim_intimation_number_mail.required' => 'Please enter claim intimation number / mail',
        ];

        $this->validate($request, $rules, $messages);

        $claim = Claim::where('id', $id)->update([
            'claim_intimation_done'                 => $request->claim_intimation_done,
            'claim_intimation_number_mail'          => $request->claim_intimation_number_mail,
        ]);
                
        break;
            
        default:
            // code...
            break;
        }



        return redirect()->route('hospital.claims.edit', $id)->with('success', 'Claim updated successfully');
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
