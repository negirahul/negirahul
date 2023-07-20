<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\Claimant;
use App\Models\ClaimProcessing;
use App\Models\Insurer;
use App\Models\Claim;
use Illuminate\Http\Request;
use App\Models\IcdCode;
use App\Models\PcsCode;

class ClaimProcessingController extends Controller
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
        $claim                          = Claim::with('patient')->find($request->claim_id);
        $patient                        = $claim->patient;
        $hospital                       = $claim->patient->hospital;
        $claim_processing_exists        = ClaimProcessing::where('claim_id', $claim->id)->exists();
        $claim_processing               = $claim_processing_exists ? ClaimProcessing::where('claim_id', $claim->id)->first() : null;
        $insurers                       = Insurer::get();
        $icd_codes_level1               = IcdCode::distinct('level1_code')->get(['level1','level1_code']);
        $icd_codes_level2               = IcdCode::distinct('level2_code')->get(['level2','level2_code']);
        $icd_codes_level3               = IcdCode::distinct('level3_code')->get(['level3','level3_code']);
        $icd_codes_level4               = IcdCode::distinct('level4_code')->get(['level4','level4_code']);
        $pcs_group_name                 = PcsCode::distinct('pcs_group_code')->get(['pcs_group_name','pcs_group_code']);
        $pcs_sub_group_name             = PcsCode::distinct('pcs_sub_group_code')->get(['pcs_sub_group_name','pcs_sub_group_code']);
        $pcs_short_name                 = PcsCode::distinct('pcs_code')->get(['pcs_short_name', 'pcs_long_name', 'pcs_code']);
        $pcs_codes                      = PcsCode::get();

        return view('admin.claims.processing.create.create', compact('claim', 'claim_processing', 'insurers', 'icd_codes_level1', 'icd_codes_level2', 'icd_codes_level3', 'icd_codes_level4', 'pcs_group_name', 'pcs_sub_group_name', 'pcs_short_name' , 'pcs_codes', 'patient', 'hospital'));
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
        $claimant                       = Claimant::with('claim')->find($id);
        $patient                        = $claimant->patient;
        $claim                          = $claimant->claim;
        $hospital                       = $claimant->hospital;
        $claim_processing_exists        = ClaimProcessing::where('patient_id', $claimant->patient_id)->exists();
        $claim_processing               = $claim_processing_exists ? ClaimProcessing::where('claimant_id', $claimant->id)->first() : null;
        $insurers                       = Insurer::get();
        $icd_codes_level1               = IcdCode::distinct('level1_code')->get(['level1','level1_code']);
        $icd_codes_level2               = IcdCode::distinct('level2_code')->get(['level2','level2_code']);
        $icd_codes_level3               = IcdCode::distinct('level3_code')->get(['level3','level3_code']);
        $icd_codes_level4               = IcdCode::distinct('level4_code')->get(['level4','level4_code']);
        $pcs_group_name                 = PcsCode::distinct('pcs_group_code')->get(['pcs_group_name','pcs_group_code']);
        $pcs_sub_group_name             = PcsCode::distinct('pcs_sub_group_code')->get(['pcs_sub_group_name','pcs_sub_group_code']);
        $pcs_short_name                 = PcsCode::distinct('pcs_code')->get(['pcs_short_name', 'pcs_long_name', 'pcs_code']);
        $pcs_codes                      = PcsCode::get();

        return view('admin.claims.claimants.edit.claim-processing', compact('claimant', 'claim_processing', 'insurers', 'icd_codes_level1', 'icd_codes_level2', 'icd_codes_level3', 'icd_codes_level4', 'pcs_group_name', 'pcs_sub_group_name', 'pcs_short_name' , 'pcs_codes', 'patient', 'hospital', 'claim'));
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

    public function updateClaimProcessing(Request $request, $id)
    {
        $claim  = Claim::with('patient')->find($id);

        $rules = [
            'primary_diagnosis_icd_leveli_disease' => 'required',
            'primary_diagnosis_icd_leveli_code' => 'required',
            'primary_diagnosis_icd_levelii_disease' => 'required',
            'primary_diagnosis_icd_levelii_code' => 'required',
            'primary_diagnosis_icd_leveliii_disease' => 'required',
            'primary_diagnosis_icd_leveliii_code' => 'required',
            'primary_diagnosis_icd_leveliv_disease' => 'required',
            'primary_diagnosis_icd_leveliv_code' => 'required',
            'final_assessment_status' => 'required',
            'processing_query' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
            'final_assessment_amount' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
        ];

        $messages = [
            'primary_diagnosis_icd_leveli_disease.required' => 'Please enter Primary Diagnosis Icd Level I Disease',
            'primary_diagnosis_icd_leveli_code.required' => 'Please enter Primary Diagnosis Icd Level I Code',
            'primary_diagnosis_icd_levelii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_levelii_code.required' => 'Please enter Primary Diagnosis Icd Level II Code',
            'primary_diagnosis_icd_leveliii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_leveliii_code.required' => 'Please enter Primary Diagnosis Icd Level III Code',
            'primary_diagnosis_icd_leveliv_disease.required' => 'Please enter Primary Diagnosis Icd Level IV Disease',
            'primary_diagnosis_icd_leveliv_code.required' => 'Please enter Primary Diagnosis Icd Level IV Code',
            'final_assessment_status.required' => 'Please enter Final Assessment Status',
            'query.required' => 'Please enter query',
            'final_assessment_amount.required' => 'Please enter Final Assessment Amount',
        ];

        $this->validateWithBag('claim-processing-form', $request, $rules, $messages);

        $details = ClaimProcessing::updateOrCreate([
            'claim_id' => $id,
        ],[
            'claimant_id' => $id,
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

        Claim::where('id', $id)->update([
            'claim_processing_status'   => 1,
        ]);

        return redirect()->back()->with('success', 'Claim Processing created/updated successfully');

    }

    public function update(Request $request, $id)
    {
        $claimant  = Claimant::with('claim')->find($id);

        $rules = [
            'primary_diagnosis_icd_leveli_disease' => 'required',
            'primary_diagnosis_icd_leveli_code' => 'required',
            'primary_diagnosis_icd_levelii_disease' => 'required',
            'primary_diagnosis_icd_levelii_code' => 'required',
            'primary_diagnosis_icd_leveliii_disease' => 'required',
            'primary_diagnosis_icd_leveliii_code' => 'required',
            'primary_diagnosis_icd_leveliv_disease' => 'required',
            'primary_diagnosis_icd_leveliv_code' => 'required',
            'final_assessment_status' => 'required',
            'processing_query' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
            'final_assessment_amount' => ($request->final_assessment_status == 'Query Raised by BHC Team') ? 'required' : [],
        ];

        $messages = [
            'primary_diagnosis_icd_leveli_disease.required' => 'Please enter Primary Diagnosis Icd Level I Disease',
            'primary_diagnosis_icd_leveli_code.required' => 'Please enter Primary Diagnosis Icd Level I Code',
            'primary_diagnosis_icd_levelii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_levelii_code.required' => 'Please enter Primary Diagnosis Icd Level II Code',
            'primary_diagnosis_icd_leveliii_disease.required' => 'Please enter Primary Diagnosis Icd Level II Disease',
            'primary_diagnosis_icd_leveliii_code.required' => 'Please enter Primary Diagnosis Icd Level III Code',
            'primary_diagnosis_icd_leveliv_disease.required' => 'Please enter Primary Diagnosis Icd Level IV Disease',
            'primary_diagnosis_icd_leveliv_code.required' => 'Please enter Primary Diagnosis Icd Level IV Code',
            'final_assessment_status.required' => 'Please enter Final Assessment Status',
            'query.required' => 'Please enter query',
            'final_assessment_amount.required' => 'Please enter Final Assessment Amount',
        ];

        $this->validateWithBag('claim-processing-form', $request, $rules, $messages);

        $details = ClaimProcessing::updateOrCreate([
            'patient_id' => $claimant->patient_id,
        ],[
            'claimant_id' => $id,
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

        return redirect()->back()->with('success', 'Claim Processing created/updated successfully');

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
