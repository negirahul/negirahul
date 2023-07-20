<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\Claimant;
use App\Models\Patient;
use App\Models\ReimbursementDocument;
use App\Models\DocumentReimbursementFileHistory;
use Illuminate\Http\Request;

class DocumentReimbursementController extends Controller
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
    public function create()
    {
        //
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

    public function updateDocument(Request $request, $id)
    {        
        $reimbursement  = ReimbursementDocument::updateOrCreate(
            ['patient_id' => $id],
            []
        );
        switch ($request->form_type) {
            case 'initial_assessment':
                

                if ($request->hasfile('patient_id_proof_file')) {
                    $patient_id_proof_file = $request->file('patient_id_proof_file');
                    $name = $patient_id_proof_file->getClientOriginalName();
                    $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->patient_id_proof_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'patient_id_proof_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'patient_id_proof_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'patient_id_proof_file', 'file_path' => $reimbursement->patient_id_proof_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'patient_id_proof_file' =>  $name
                    ]);
                }

                if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
                    $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
                    $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
                    $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->doctor_prescriptions_or_consultation_papers_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'doctor_prescriptions_or_consultation_papers_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'doctor_prescriptions_or_consultation_papers_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'doctor_prescriptions_or_consultation_papers_file', 'file_path' => $reimbursement->doctor_prescriptions_or_consultation_papers_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'doctor_prescriptions_or_consultation_papers_file' =>  $name
                    ]);
                }

                if ($request->hasfile('insurance_policy_copy_file')) {
                    $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
                    $name = $insurance_policy_copy_file->getClientOriginalName();
                    $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->insurance_policy_copy_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'insurance_policy_copy_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'insurance_policy_copy_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'insurance_policy_copy_file', 'file_path' => $reimbursement->insurance_policy_copy_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }


                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'insurance_policy_copy_file' =>  $name
                    ]);
                }


                if ($request->hasfile('tpa_card_file')) {
                    $tpa_card_file = $request->file('tpa_card_file');
                    $name = $tpa_card_file->getClientOriginalName();
                    $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->tpa_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'tpa_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'tpa_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'tpa_card_file', 'file_path' => $reimbursement->tpa_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }


                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'tpa_card_file' =>  $name
                    ]);
                }


                if ($request->hasfile('employee_or_member_id_group_file')) {
                    $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
                    $name = $employee_or_member_id_group_file->getClientOriginalName();
                    $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->employee_or_member_id_group_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'employee_or_member_id_group_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'employee_or_member_id_group_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'employee_or_member_id_group_file', 'file_path' => $reimbursement->employee_or_member_id_group_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'employee_or_member_id_group_file' =>  $name
                    ]);
                }


                if ($request->hasfile('photograph_of_the_patient_file')) {
                    $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
                    $name = $photograph_of_the_patient_file->getClientOriginalName();
                    $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->photograph_of_the_patient_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_patient_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_patient_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'photograph_of_the_patient_file', 'file_path' => $reimbursement->photograph_of_the_patient_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'photograph_of_the_patient_file' =>  $name
                    ]);
                }


                if ($request->hasfile('claim_intimation_documents')) {
                    $claim_intimation_documents = $request->file('claim_intimation_documents');
                    $name = $claim_intimation_documents->getClientOriginalName();
                    $claim_intimation_documents->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claim_intimation_documents)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claim_intimation_documents', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claim_intimation_documents', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claim_intimation_documents', 'file_path' => $reimbursement->claim_intimation_documents, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claim_intimation_documents' =>  $name
                    ]);
                }

                if ($request->hasfile('bhc_assessment_formsi_and_ii_signed_stamped_file')) {
                    $bhc_assessment_formsi_and_ii_signed_stamped_file = $request->file('bhc_assessment_formsi_and_ii_signed_stamped_file');
                    $name = $bhc_assessment_formsi_and_ii_signed_stamped_file->getClientOriginalName();
                    $bhc_assessment_formsi_and_ii_signed_stamped_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->bhc_assessment_formsi_and_ii_signed_stamped_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'bhc_assessment_formsi_and_ii_signed_stamped_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'bhc_assessment_formsi_and_ii_signed_stamped_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'bhc_assessment_formsi_and_ii_signed_stamped_file', 'file_path' => $reimbursement->bhc_assessment_formsi_and_ii_signed_stamped_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'bhc_assessment_formsi_and_ii_signed_stamped_file' =>  $name
                    ]);
                }


                if ($request->hasfile('claim_other_documents_file')) {
                    $claim_other_documents_file = $request->file('claim_other_documents_file');
                    $name = $claim_other_documents_file->getClientOriginalName();
                    $claim_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claim_other_documents_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claim_other_documents_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claim_other_documents_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claim_other_documents_file', 'file_path' => $reimbursement->claim_other_documents_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claim_other_documents_file' =>  $name
                    ]);
                }


                break;
            case 'final_assessment':

                $rules = [ 
                    'discharge_or_day_care_summary_file'           => empty($reimbursement->discharge_or_day_care_summary_file) ? 'required' : [],
                    'hospital_main_final_bill_file'           => empty($reimbursement->hospital_main_final_bill_file) ? 'required' : [],
                ];
                
                $messages = [
                    'hospital_main_final_bill_file.required'          => 'Please select Hospital Main Final Bill File',
                    'discharge_or_day_care_summary_file.required'          => 'Please select Discharge Or Day Care Summary File',
                ];
                
                $this->validate($request, $rules, $messages);
                
                if ($request->hasfile('indoor_care_paper_file')) {
                    $indoor_care_paper_file = $request->file('indoor_care_paper_file');
                    $name = $indoor_care_paper_file->getClientOriginalName();
                    $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->indoor_care_paper_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'indoor_care_paper_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'indoor_care_paper_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'indoor_care_paper_file', 'file_path' => $reimbursement->indoor_care_paper_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'indoor_care_paper_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('ecg_report_file')) {
                    $ecg_report_file = $request->file('ecg_report_file');
                    $name = $ecg_report_file->getClientOriginalName();
                    $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->ecg_report_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'ecg_report_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'ecg_report_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'ecg_report_file', 'file_path' => $reimbursement->ecg_report_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'ecg_report_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
                    $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
                    $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
                    $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->ct_mri_usg_hpe_investigation_report_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'ct_mri_usg_hpe_investigation_report_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'ct_mri_usg_hpe_investigation_report_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'ct_mri_usg_hpe_investigation_report_file', 'file_path' => $reimbursement->ct_mri_usg_hpe_investigation_report_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'ct_mri_usg_hpe_investigation_report_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
                    $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
                    $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
                    $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->diagnostic_or_investigation_reports_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'diagnostic_or_investigation_reports_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'diagnostic_or_investigation_reports_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'diagnostic_or_investigation_reports_file', 'file_path' => $reimbursement->diagnostic_or_investigation_reports_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'diagnostic_or_investigation_reports_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
                    $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
                    $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
                    $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->doctor’s_reference_slip_for_investigation_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'doctor’s_reference_slip_for_investigation_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'doctor’s_reference_slip_for_investigation_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'doctor’s_reference_slip_for_investigation_file', 'file_path' => $reimbursement->doctor’s_reference_slip_for_investigation_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'doctor’s_reference_slip_for_investigation_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('operation_theatre_notes_file')) {
                    $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
                    $name = $operation_theatre_notes_file->getClientOriginalName();
                    $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->operation_theatre_notes_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'operation_theatre_notes_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'operation_theatre_notes_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'operation_theatre_notes_file', 'file_path' => $reimbursement->operation_theatre_notes_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'operation_theatre_notes_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('pharmacy_bills_file')) {
                    $pharmacy_bills_file = $request->file('pharmacy_bills_file');
                    $name = $pharmacy_bills_file->getClientOriginalName();
                    $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->pharmacy_bills_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'pharmacy_bills_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'pharmacy_bills_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'pharmacy_bills_file', 'file_path' => $reimbursement->pharmacy_bills_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'pharmacy_bills_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('implant_sticker_invoice_file')) {
                    $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
                    $name = $implant_sticker_invoice_file->getClientOriginalName();
                    $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->implant_sticker_invoice_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'implant_sticker_invoice_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'implant_sticker_invoice_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'implant_sticker_invoice_file', 'file_path' => $reimbursement->implant_sticker_invoice_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'implant_sticker_invoice_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('hospital_break_up_bills_file')) {
                    $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
                    $name = $hospital_break_up_bills_file->getClientOriginalName();
                    $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->hospital_break_up_bills_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'hospital_break_up_bills_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'hospital_break_up_bills_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'hospital_break_up_bills_file', 'file_path' => $reimbursement->hospital_break_up_bills_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'hospital_break_up_bills_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('hospital_main_final_bill_file')) {
                    $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
                    $name = $hospital_main_final_bill_file->getClientOriginalName();
                    $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->hospital_main_final_bill_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'hospital_main_final_bill_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'hospital_main_final_bill_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'hospital_main_final_bill_file', 'file_path' => $reimbursement->hospital_main_final_bill_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'hospital_main_final_bill_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('discharge_or_day_care_summary_file')) {
                    $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
                    $name = $discharge_or_day_care_summary_file->getClientOriginalName();
                    $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->discharge_or_day_care_summary_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'discharge_or_day_care_summary_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'discharge_or_day_care_summary_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'discharge_or_day_care_summary_file', 'file_path' => $reimbursement->discharge_or_day_care_summary_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'discharge_or_day_care_summary_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
                    $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
                    $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
                    $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->death_summary_from_hospital_where_applicable_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'death_summary_from_hospital_where_applicable_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'death_summary_from_hospital_where_applicable_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'death_summary_from_hospital_where_applicable_file', 'file_path' => $reimbursement->death_summary_from_hospital_where_applicable_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'death_summary_from_hospital_where_applicable_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
                    $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
                    $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
                    $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->payment_receipts_of_the_hospital_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'payment_receipts_of_the_hospital_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'payment_receipts_of_the_hospital_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'payment_receipts_of_the_hospital_file', 'file_path' => $reimbursement->payment_receipts_of_the_hospital_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'payment_receipts_of_the_hospital_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('other_documents_file')) {
                    $other_documents_file = $request->file('other_documents_file');
                    $name = $other_documents_file->getClientOriginalName();
                    $other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->other_documents_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'other_documents_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'other_documents_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'other_documents_file', 'file_path' => $reimbursement->other_documents_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'other_documents_file' =>  $name
                    ]);
                }
                break;
            case 'insurance_claim':
                $rules = [   
                    'insurance_co_tpa_claim_form_signed_and_stamped_file'           => empty($reimbursement->insurance_co_tpa_claim_form_signed_and_stamped_file) ? 'required' : [],
                ];
                
                $messages = [
                    'insurance_co_tpa_claim_form_signed_and_stamped_file.required'          => 'Please select Insurance Co. TPA Claim Form (Signed & Stamped) File',
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('claimant_pan_card_file')) {
                    $claimant_pan_card_file = $request->file('claimant_pan_card_file');
                    $name = $claimant_pan_card_file->getClientOriginalName();
                    $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claimant_pan_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claimant_pan_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claimant_pan_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claimant_pan_card_file', 'file_path' => $reimbursement->claimant_pan_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_pan_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('claimant_aadhar_card_file')) {
                    $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
                    $name = $claimant_aadhar_card_file->getClientOriginalName();
                    $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claimant_aadhar_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claimant_aadhar_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claimant_aadhar_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claimant_aadhar_card_file', 'file_path' => $reimbursement->claimant_aadhar_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_aadhar_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('claimant_current_address_proof_file')) {
                    $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
                    $name = $claimant_current_address_proof_file->getClientOriginalName();
                    $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claimant_current_address_proof_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claimant_current_address_proof_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claimant_current_address_proof_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claimant_current_address_proof_file', 'file_path' => $reimbursement->claimant_current_address_proof_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }
                    
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_current_address_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('claimant_cancel_cheque_file')) {
                    $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
                    $name = $claimant_cancel_cheque_file->getClientOriginalName();
                    $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->claimant_cancel_cheque_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'claimant_cancel_cheque_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'claimant_cancel_cheque_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'claimant_cancel_cheque_file', 'file_path' => $reimbursement->claimant_cancel_cheque_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_cancel_cheque_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('abha_id_proof_file')) {
                    $abha_id_proof_file = $request->file('abha_id_proof_file');
                    $name = $abha_id_proof_file->getClientOriginalName();
                    $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->abha_id_proof_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'abha_id_proof_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'abha_id_proof_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'abha_id_proof_file', 'file_path' => $reimbursement->abha_id_proof_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'abha_id_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
                    $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
                    $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
                    $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->mlc_report_and_police_fir_document_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'mlc_report_and_police_fir_document_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'mlc_report_and_police_fir_document_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'mlc_report_and_police_fir_document_file', 'file_path' => $reimbursement->mlc_report_and_police_fir_document_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'mlc_report_and_police_fir_document_file' =>  $name
                    ]);
                }

                if ($request->hasfile('insurance_co_tpa_claim_form_signed_and_stamped_file')) {
                    $insurance_co_tpa_claim_form_signed_and_stamped_file = $request->file('insurance_co_tpa_claim_form_signed_and_stamped_file');
                    $name = $insurance_co_tpa_claim_form_signed_and_stamped_file->getClientOriginalName();
                    $insurance_co_tpa_claim_form_signed_and_stamped_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->insurance_co_tpa_claim_form_signed_and_stamped_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'insurance_co_tpa_claim_form_signed_and_stamped_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'insurance_co_tpa_claim_form_signed_and_stamped_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'insurance_co_tpa_claim_form_signed_and_stamped_file', 'file_path' => $reimbursement->insurance_co_tpa_claim_form_signed_and_stamped_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'insurance_co_tpa_claim_form_signed_and_stamped_file' =>  $name
                    ]);
                }

                break;
            case 'insurance_settlement_documents':

                if ($request->hasfile('settllement_letter_file')) {
                    $settllement_letter_file = $request->file('settllement_letter_file');
                    $name = $settllement_letter_file->getClientOriginalName();
                    $settllement_letter_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->settllement_letter_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'settllement_letter_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'settllement_letter_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'settllement_letter_file', 'file_path' => $reimbursement->settllement_letter_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'settllement_letter_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('insurance_other_documents_file')) {
                    $insurance_other_documents_file = $request->file('insurance_other_documents_file');
                    $name = $insurance_other_documents_file->getClientOriginalName();
                    $insurance_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->insurance_other_documents_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'insurance_other_documents_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'insurance_other_documents_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'insurance_other_documents_file', 'file_path' => $reimbursement->insurance_other_documents_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'insurance_other_documents_file' =>  $name
                    ]);
                }
            break;
            case 'medical_loan_form':
                $rules = [
                    'photograph_of_the_borrower_file'   => empty($reimbursement->photograph_of_the_borrower_file) ? 'required' : [],
                    'borrower_pan_card_file'                => empty($reimbursement->borrower_pan_card_file) ? 'required' : [],
                    'borrower_aadhar_card_file'             => empty($reimbursement->borrower_aadhar_card_file) ? 'required' : [],
                    'borrower_cancel_cheque_file'           => empty($reimbursement->borrower_cancel_cheque_file) ? 'required' : [],
                    
                ];
                
                $messages = [    
                    'photograph_of_the_borrower_file.required'          => 'Please select Borrower Photograph File',
                    'borrower_current_address_proof_file.required'      => 'Please select Borrower Current Address Proof File',
                    'borrower_pan_card_file.required'                   => 'Please select Borrower Pan Card File',
                    'borrower_aadhar_card_file.required'                => 'Please select Borrower Aadhar Card File',
                    'borrower_bank_statement_3_months_file.required'    => 'Please select Borrower Bank Statement 3 Months File',   
                    'borrower_cancel_cheque_file.required'              => 'Please select Borrower Cancel Cheque File',
                    'borrower_other_documents_file.required'            => 'Please select Borrower Other Documents File',   
                
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('photograph_of_the_borrower_file')) {
                    $photograph_of_the_borrower_file = $request->file('photograph_of_the_borrower_file');
                    $name = $photograph_of_the_borrower_file->getClientOriginalName();
                    $photograph_of_the_borrower_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->photograph_of_the_borrower_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_borrower_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_borrower_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'photograph_of_the_borrower_file', 'file_path' => $reimbursement->photograph_of_the_borrower_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'photograph_of_the_borrower_file' =>  $name
                    ]);
                }

                if ($request->hasfile('borrower_current_address_proof_file')) {
                    $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
                    $name = $borrower_current_address_proof_file->getClientOriginalName();
                    $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_current_address_proof_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_current_address_proof_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_current_address_proof_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_current_address_proof_file', 'file_path' => $reimbursement->borrower_current_address_proof_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_current_address_proof_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_pan_card_file')) {
                    $borrower_pan_card_file = $request->file('borrower_pan_card_file');
                    $name = $borrower_pan_card_file->getClientOriginalName();
                    $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_pan_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_pan_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_pan_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_pan_card_file', 'file_path' => $reimbursement->borrower_pan_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_pan_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_aadhar_card_file')) {
                    $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
                    $name = $borrower_aadhar_card_file->getClientOriginalName();
                    $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_aadhar_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_aadhar_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_aadhar_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_aadhar_card_file', 'file_path' => $reimbursement->borrower_aadhar_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_aadhar_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_bank_statement_3_months_file')) {
                    $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
                    $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
                    $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_bank_statement_3_months_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_bank_statement_3_months_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_bank_statement_3_months_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_bank_statement_3_months_file', 'file_path' => $reimbursement->borrower_bank_statement_3_months_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_bank_statement_3_months_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('borrower_itr_income_tax_return_file')) {
                    $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
                    $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
                    $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_itr_income_tax_return_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_itr_income_tax_return_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_itr_income_tax_return_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_itr_income_tax_return_file', 'file_path' => $reimbursement->borrower_itr_income_tax_return_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_itr_income_tax_return_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_cancel_cheque_file')) {
                    $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
                    $name = $borrower_cancel_cheque_file->getClientOriginalName();
                    $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_cancel_cheque_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_cancel_cheque_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_cancel_cheque_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_cancel_cheque_file', 'file_path' => $reimbursement->borrower_cancel_cheque_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_cancel_cheque_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_other_documents_file')) {
                    $borrower_other_documents_file = $request->file('borrower_other_documents_file');
                    $name = $borrower_other_documents_file->getClientOriginalName();
                    $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->borrower_other_documents_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'borrower_other_documents_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'borrower_other_documents_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'borrower_other_documents_file', 'file_path' => $reimbursement->borrower_other_documents_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_other_documents_file' =>  $name
                    ]);
                }
                break;
            case 'borrower_loan_form':
                $rules = [   
                    'photograph_of_the_co_borrower_file'    => empty($reimbursement->photograph_of_the_co_borrower_file) ? 'required' : [], 
                    'co_borrower_pan_card_file'                 => empty($reimbursement->co_borrower_pan_card_file) ? 'required' : [],
                    'co_borrower_aadhar_card_file'              => empty($reimbursement->co_borrower_aadhar_card_file) ? 'required' : [],                    
                ];
                
                $messages = [   
                    'photograph_of_the_co_borrower_file.required'       => 'Please select Co Borrower Photograph File',
                    'co_borrower_current_address_proof_file.required'   => 'Please select Co Borrower Current Address Proof File',
                    'co_borrower_pan_card_file.required'                => 'Please select Co Borrower Pan Card File',
                    'co_borrower_aadhar_card_file.required'             => 'Please select Co Borrower Aadhar Card File',
                    'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',    
                    'co_borrower_cancel_cheque_file.required'           => 'Please select Co Borrower Cancel Cheque File',
                    'co_borrower_other_documents_file.required'         => 'Please select Co Borrower Other Documents File',
                
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('photograph_of_the_co_borrower_file')) {
                    $photograph_of_the_co_borrower_file = $request->file('photograph_of_the_co_borrower_file');
                    $name = $photograph_of_the_co_borrower_file->getClientOriginalName();
                    $photograph_of_the_co_borrower_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->photograph_of_the_co_borrower_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_co_borrower_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'photograph_of_the_co_borrower_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'photograph_of_the_co_borrower_file', 'file_path' => $reimbursement->photograph_of_the_co_borrower_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'photograph_of_the_co_borrower_file' =>  $name
                    ]);
                }
                
                if ($request->hasfile('co_borrower_current_address_proof_file')) {
                    $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
                    $name = $co_borrower_current_address_proof_file->getClientOriginalName();
                    $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_current_address_proof_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_current_address_proof_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_current_address_proof_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_current_address_proof_file', 'file_path' => $reimbursement->co_borrower_current_address_proof_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_current_address_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_pan_card_file')) {
                    $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
                    $name = $co_borrower_pan_card_file->getClientOriginalName();
                    $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_pan_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_pan_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_pan_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_pan_card_file', 'file_path' => $reimbursement->co_borrower_pan_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_pan_card_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_aadhar_card_file')) {
                    $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
                    $name = $co_borrower_aadhar_card_file->getClientOriginalName();
                    $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_aadhar_card_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_aadhar_card_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_aadhar_card_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_aadhar_card_file', 'file_path' => $reimbursement->co_borrower_aadhar_card_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_aadhar_card_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
                    $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
                    $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
                    $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_bank_statement_3_months_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_bank_statement_3_months_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_bank_statement_3_months_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_bank_statement_3_months_file', 'file_path' => $reimbursement->co_borrower_bank_statement_3_months_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_bank_statement_3_months_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
                    $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
                    $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
                    $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_itr_income_tax_return_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_itr_income_tax_return_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_itr_income_tax_return_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_itr_income_tax_return_file', 'file_path' => $reimbursement->co_borrower_itr_income_tax_return_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_itr_income_tax_return_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_cancel_cheque_file')) {
                    $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
                    $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
                    $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_cancel_cheque_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_cancel_cheque_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_cancel_cheque_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_cancel_cheque_file', 'file_path' => $reimbursement->co_borrower_cancel_cheque_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_cancel_cheque_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_other_documents_file')) {
                    $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
                    $name = $co_borrower_other_documents_file->getClientOriginalName();
                    $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->co_borrower_other_documents_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_other_documents_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'co_borrower_other_documents_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'co_borrower_other_documents_file', 'file_path' => $reimbursement->co_borrower_other_documents_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_other_documents_file' =>  $name
                    ]);
                }
                break;
            case 'lending_status_document':

                if ($request->hasfile('loan_approval_letter_file')) {
                    $loan_approval_letter_file = $request->file('loan_approval_letter_file');
                    $name = $loan_approval_letter_file->getClientOriginalName();
                    $loan_approval_letter_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->loan_approval_letter_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'loan_approval_letter_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'loan_approval_letter_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'loan_approval_letter_file', 'file_path' => $reimbursement->loan_approval_letter_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'loan_approval_letter_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('loan_disbursement_letter_file')) {
                    $loan_disbursement_letter_file = $request->file('loan_disbursement_letter_file');
                    $name = $loan_disbursement_letter_file->getClientOriginalName();
                    $loan_disbursement_letter_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');

                    if (!empty($reimbursement->loan_disbursement_letter_file)) {
                        $exists = DocumentReimbursementFileHistory::where(['file_name' => 'loan_disbursement_letter_file', 'patient_id' => $id])->exists();
                        if (!$exists) {
                            $file_id = 0;
                        }else{
                            $file_id1 =  DocumentReimbursementFileHistory::where(['file_name' => 'loan_disbursement_letter_file', 'patient_id' => $id])->latest('id')->first();
                            $file_id = $file_id1->file_id;
                        }
                        DocumentReimbursementFileHistory::insert(
                            ['file_name' => 'loan_disbursement_letter_file', 'file_path' => $reimbursement->loan_disbursement_letter_file, 'patient_id' => $id, 'created_at' => now(), 'file_id' => $file_id+1]
                        );
                    }

                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'loan_disbursement_letter_file' =>  $name
                    ]);
                }
            break;
            default:
                # code...
                break;
        }

        return redirect()->back()->with('success', 'Documents updated successfully');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showDocument($id)
    {
        $reimbursementdocument = ReimbursementDocument::where('patient_id', $id)->exists();

        if (!$reimbursementdocument) {
            ReimbursementDocument::create(['patient_id' => $id]);
        }

        $reimbursementdocument = ReimbursementDocument::where('patient_id', $id)->first();

        $patient = Patient::where('id', $id)->first();

        $document_files = DocumentReimbursementFileHistory::where('patient_id', $id)->get()
        ->groupBy('file_name')
        ->map(function ($pb) { return $pb->keyBy('file_id'); });

        return view('admin.claims.patients.tabs.view-document-reimbursement', compact('reimbursementdocument', 'patient', 'document_files'));
    }

    public function show($id)
    {
        $claimant              = Claimant::find($id);
        $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

        return view('admin.claims.claimants.edit.document-reimbursement', compact('reimbursementdocument', 'claimant'));
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
        $claimant       = Claimant::find($id);
        $reimbursement  = ReimbursementDocument::updateOrCreate(
            ['patient_id' => $claimant->patient_id],
            []
        );
        switch ($request->form_type) {
            case 'initial_assessment':
                $rules = [                    
                    'patient_id_proof_file'                             => empty($reimbursement->patient_id_proof_file) ? 'required' : [],
                    'doctor_prescriptions_or_consultation_papers_file'  => empty($reimbursement->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
                    'insurance_policy_copy_file'                        => empty($reimbursement->insurance_policy_copy_file) ? 'required' : [],
                    'tpa_card_file'                                     => empty($reimbursement->tpa_card_file) ? 'required' : [],
                    'employee_or_member_id_group_file'                  => empty($reimbursement->employee_or_member_id_group_file) ? 'required' : [],
                    'photograph_of_the_patient_file'                    => empty($reimbursement->photograph_of_the_patient_file) ? 'required' : [],                       
                ];
                
                $messages = [                   
                    'patient_id_proof_file.required'                            => 'Please select Patient Id Proof File',
                    'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
                    'insurance_policy_copy_file.required'                       => 'Please select Insurance Policy Copy File',
                    'tpa_card_file.required'                                    => 'Please select Tpa Card File',
                    'employee_or_member_id_group_file.required'                 => 'Please select Employee Or Member Id Group File',
                    'photograph_of_the_patient_file.required'                   => 'Please select Photograph Of The Patient File',   
                
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('patient_id_proof_file')) {
                    $patient_id_proof_file = $request->file('patient_id_proof_file');
                    $name = $patient_id_proof_file->getClientOriginalName();
                    $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'patient_id_proof_file' =>  $name
                    ]);
                }

                if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
                    $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
                    $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
                    $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'doctor_prescriptions_or_consultation_papers_file' =>  $name
                    ]);
                }

                if ($request->hasfile('insurance_policy_copy_file')) {
                    $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
                    $name = $insurance_policy_copy_file->getClientOriginalName();
                    $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'insurance_policy_copy_file' =>  $name
                    ]);
                }


                if ($request->hasfile('tpa_card_file')) {
                    $tpa_card_file = $request->file('tpa_card_file');
                    $name = $tpa_card_file->getClientOriginalName();
                    $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'tpa_card_file' =>  $name
                    ]);
                }


                if ($request->hasfile('employee_or_member_id_group_file')) {
                    $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
                    $name = $employee_or_member_id_group_file->getClientOriginalName();
                    $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'employee_or_member_id_group_file' =>  $name
                    ]);
                }


                if ($request->hasfile('photograph_of_the_patient_file')) {
                    $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
                    $name = $photograph_of_the_patient_file->getClientOriginalName();
                    $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'photograph_of_the_patient_file' =>  $name
                    ]);
                }
                break;
            case 'final_assessment':
                $rules = [       
                    'diagnostic_or_investigation_reports_file'              => empty($reimbursement->diagnostic_or_investigation_reports_file) ? 'required' : [],   
                    'pharmacy_bills_file'                                   => empty($reimbursement->pharmacy_bills_file) ? 'required' : [],   
                    'hospital_break_up_bills_file'                          => empty($reimbursement->hospital_break_up_bills_file) ? 'required' : [],
                    'hospital_main_final_bill_file'                         => empty($reimbursement->hospital_main_final_bill_file) ? 'required' : [],
                    'discharge_or_day_care_summary_file'                    => empty($reimbursement->discharge_or_day_care_summary_file) ? 'required' : [],   
                    'payment_receipts_of_the_hospital_file'                 => empty($reimbursement->payment_receipts_of_the_hospital_file) ? 'required' : [], 
                ];

                $messages = [   
                    'diagnostic_or_investigation_reports_file.required'     => 'Please select Diagnostic Or Investigation Reports File',    
                    'pharmacy_bills_file.required'                          => 'Please select Pharmacy Bills File',    
                    'hospital_break_up_bills_file.required'                 => 'Please select Hospital Break Up Bills File',
                    'hospital_main_final_bill_file.required'                => 'Please select Hospital Main Final Bill File',
                    'discharge_or_day_care_summary_file.required'           => 'Please select Discharge Or Day Care Summary File',
                    'payment_receipts_of_the_hospital_file.required'        => 'Please select Payment Receipts Of The Hospital File',  
                ];

                $this->validate($request, $rules, $messages);
                if ($request->hasfile('indoor_care_paper_file')) {
                    $indoor_care_paper_file = $request->file('indoor_care_paper_file');
                    $name = $indoor_care_paper_file->getClientOriginalName();
                    $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'indoor_care_paper_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('ecg_report_file')) {
                    $ecg_report_file = $request->file('ecg_report_file');
                    $name = $ecg_report_file->getClientOriginalName();
                    $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'ecg_report_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
                    $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
                    $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
                    $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'ct_mri_usg_hpe_investigation_report_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
                    $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
                    $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
                    $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'diagnostic_or_investigation_reports_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
                    $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
                    $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
                    $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'doctor’s_reference_slip_for_investigation_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('operation_theatre_notes_file')) {
                    $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
                    $name = $operation_theatre_notes_file->getClientOriginalName();
                    $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'operation_theatre_notes_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('pharmacy_bills_file')) {
                    $pharmacy_bills_file = $request->file('pharmacy_bills_file');
                    $name = $pharmacy_bills_file->getClientOriginalName();
                    $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'pharmacy_bills_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('implant_sticker_invoice_file')) {
                    $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
                    $name = $implant_sticker_invoice_file->getClientOriginalName();
                    $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'implant_sticker_invoice_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('hospital_break_up_bills_file')) {
                    $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
                    $name = $hospital_break_up_bills_file->getClientOriginalName();
                    $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'hospital_break_up_bills_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('hospital_main_final_bill_file')) {
                    $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
                    $name = $hospital_main_final_bill_file->getClientOriginalName();
                    $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'hospital_main_final_bill_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('discharge_or_day_care_summary_file')) {
                    $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
                    $name = $discharge_or_day_care_summary_file->getClientOriginalName();
                    $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'discharge_or_day_care_summary_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
                    $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
                    $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
                    $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'death_summary_from_hospital_where_applicable_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
                    $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
                    $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
                    $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'payment_receipts_of_the_hospital_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('other_documents_file')) {
                    $other_documents_file = $request->file('other_documents_file');
                    $name = $other_documents_file->getClientOriginalName();
                    $other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'other_documents_file' =>  $name
                    ]);
                }
                break;
            case 'insurance_claim':
                $rules = [   
                    'claimant_pan_card_file'                => empty($reimbursement->claimant_pan_card_file) ? 'required' : [],
                    'claimant_aadhar_card_file'             => empty($reimbursement->claimant_aadhar_card_file) ? 'required' : [],
                    'claimant_current_address_proof_file'   => empty($reimbursement->claimant_current_address_proof_file) ? 'required' : [],
                    'claimant_cancel_cheque_file'           => empty($reimbursement->claimant_cancel_cheque_file) ? 'required' : [],
                ];
                
                $messages = [    
                    'claimant_pan_card_file.required'               => 'Please select Claimant Pan Card File',
                    'claimant_aadhar_card_file.required'            => 'Please select Claimant Aadhar Card File',
                    'claimant_current_address_proof_file.required'  => 'Please select Claimant Current Address Proof File',
                    'claimant_cancel_cheque_file.required'          => 'Please select Claimant Cancel Cheque File',
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('claimant_pan_card_file')) {
                    $claimant_pan_card_file = $request->file('claimant_pan_card_file');
                    $name = $claimant_pan_card_file->getClientOriginalName();
                    $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_pan_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('claimant_aadhar_card_file')) {
                    $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
                    $name = $claimant_aadhar_card_file->getClientOriginalName();
                    $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_aadhar_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('claimant_current_address_proof_file')) {
                    $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
                    $name = $claimant_current_address_proof_file->getClientOriginalName();
                    $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_current_address_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('claimant_cancel_cheque_file')) {
                    $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
                    $name = $claimant_cancel_cheque_file->getClientOriginalName();
                    $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'claimant_cancel_cheque_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('abha_id_proof_file')) {
                    $abha_id_proof_file = $request->file('abha_id_proof_file');
                    $name = $abha_id_proof_file->getClientOriginalName();
                    $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'abha_id_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
                    $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
                    $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
                    $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'mlc_report_and_police_fir_document_file' =>  $name
                    ]);
                }
                break;
            case 'medical_loan_form':
                $rules = [
                    'borrower_current_address_proof_file'   => empty($reimbursement->borrower_current_address_proof_file) ? 'required' : [],
                    'borrower_pan_card_file'                => empty($reimbursement->borrower_pan_card_file) ? 'required' : [],
                    'borrower_aadhar_card_file'             => empty($reimbursement->borrower_aadhar_card_file) ? 'required' : [],
                    'borrower_bank_statement_3_months_file' => empty($reimbursement->borrower_bank_statement_3_months_file) ? 'required' : [],   
                    'borrower_cancel_cheque_file'           => empty($reimbursement->borrower_cancel_cheque_file) ? 'required' : [],
                    'borrower_other_documents_file'         => empty($reimbursement->borrower_other_documents_file) ? 'required' : [],   
                    
                ];
                
                $messages = [    
                    'borrower_current_address_proof_file.required'      => 'Please select Borrower Current Address Proof File',
                    'borrower_pan_card_file.required'                   => 'Please select Borrower Pan Card File',
                    'borrower_aadhar_card_file.required'                => 'Please select Borrower Aadhar Card File',
                    'borrower_bank_statement_3_months_file.required'    => 'Please select Borrower Bank Statement 3 Months File',   
                    'borrower_cancel_cheque_file.required'              => 'Please select Borrower Cancel Cheque File',
                    'borrower_other_documents_file.required'            => 'Please select Borrower Other Documents File',   
                
                ];
                
                $this->validate($request, $rules, $messages);

                if ($request->hasfile('borrower_current_address_proof_file')) {
                    $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
                    $name = $borrower_current_address_proof_file->getClientOriginalName();
                    $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_current_address_proof_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_pan_card_file')) {
                    $borrower_pan_card_file = $request->file('borrower_pan_card_file');
                    $name = $borrower_pan_card_file->getClientOriginalName();
                    $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_pan_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_aadhar_card_file')) {
                    $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
                    $name = $borrower_aadhar_card_file->getClientOriginalName();
                    $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_aadhar_card_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_bank_statement_3_months_file')) {
                    $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
                    $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
                    $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_bank_statement_3_months_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('borrower_itr_income_tax_return_file')) {
                    $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
                    $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
                    $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_itr_income_tax_return_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_cancel_cheque_file')) {
                    $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
                    $name = $borrower_cancel_cheque_file->getClientOriginalName();
                    $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_cancel_cheque_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('borrower_other_documents_file')) {
                    $borrower_other_documents_file = $request->file('borrower_other_documents_file');
                    $name = $borrower_other_documents_file->getClientOriginalName();
                    $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'borrower_other_documents_file' =>  $name
                    ]);
                }
                break;
            case 'borrower_loan_form':
                $rules = [    
                    'co_borrower_current_address_proof_file'    => empty($reimbursement->co_borrower_current_address_proof_file) ? 'required' : [],
                    'co_borrower_pan_card_file'                 => empty($reimbursement->co_borrower_pan_card_file) ? 'required' : [],
                    'co_borrower_aadhar_card_file'              => empty($reimbursement->co_borrower_aadhar_card_file) ? 'required' : [],
                    'co_borrower_bank_statement_3_months_file'  => empty($reimbursement->co_borrower_bank_statement_3_months_file) ? 'required' : [],   
                    'co_borrower_cancel_cheque_file'            => empty($reimbursement->co_borrower_cancel_cheque_file) ? 'required' : [],
                    'co_borrower_other_documents_file'          => empty($reimbursement->co_borrower_other_documents_file) ? 'required' : [],
                    
                ];
                
                $messages = [   
                    'co_borrower_current_address_proof_file.required'   => 'Please select Co Borrower Current Address Proof File',
                    'co_borrower_pan_card_file.required'                => 'Please select Co Borrower Pan Card File',
                    'co_borrower_aadhar_card_file.required'             => 'Please select Co Borrower Aadhar Card File',
                    'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',    
                    'co_borrower_cancel_cheque_file.required'           => 'Please select Co Borrower Cancel Cheque File',
                    'co_borrower_other_documents_file.required'         => 'Please select Co Borrower Other Documents File',
                
                ];
                
                $this->validate($request, $rules, $messages);
                if ($request->hasfile('co_borrower_current_address_proof_file')) {
                    $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
                    $name = $co_borrower_current_address_proof_file->getClientOriginalName();
                    $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_current_address_proof_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_pan_card_file')) {
                    $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
                    $name = $co_borrower_pan_card_file->getClientOriginalName();
                    $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_pan_card_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_aadhar_card_file')) {
                    $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
                    $name = $co_borrower_aadhar_card_file->getClientOriginalName();
                    $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_aadhar_card_file' =>  $name
                    ]);
                }
        
        
                if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
                    $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
                    $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
                    $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_bank_statement_3_months_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
                    $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
                    $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
                    $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_itr_income_tax_return_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_cancel_cheque_file')) {
                    $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
                    $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
                    $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_cancel_cheque_file' =>  $name
                    ]);
                }
        
                if ($request->hasfile('co_borrower_other_documents_file')) {
                    $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
                    $name = $co_borrower_other_documents_file->getClientOriginalName();
                    $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $reimbursement->id . '/', $name, 'public');
                    ReimbursementDocument::where('id', $reimbursement->id)->update([
                        'co_borrower_other_documents_file' =>  $name
                    ]);
                }
                break;
            default:
                # code...
                break;
        }

        return redirect()->back()->with('success', 'Documents updated successfully');
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
