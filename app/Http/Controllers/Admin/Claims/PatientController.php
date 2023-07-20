<?php

namespace App\Http\Controllers\Admin\Claims;

use App\Http\Controllers\Controller;
use App\Models\AssociatePartner;
use App\Models\Hospital;
use App\Models\Claimant;
use App\Models\HospitalDepartment;
use App\Models\Patient;
use App\Models\ReimbursementDocument;
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

    public function documentsReimbursement(Request $request)
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

        $exists = ReimbursementDocument::where('patient_id', 'P-10001')->exists();

        if (!$exists) {
            ReimbursementDocument::create(['patient_id' => 'P-10001']);
            $reimbursementdocument = ReimbursementDocument::where('patient_id', 'P-10001')->first();
        }else{
            $reimbursementdocument = ReimbursementDocument::where('patient_id', 'P-10001')->first();
        }

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals', 'reimbursementdocument'));
    }


    public function saveDocumentsReimbursement(Request $request, $id)
    {
        $claimant = Claimant::find($id);

        $exists = ReimbursementDocument::where('patient_id', $claimant->patient_id)->exists();

        if (!$exists) {
           ReimbursementDocument::create(['patient_id' => $claimant->patient_id]);
       }

       $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

       $id = $reimbursementdocument->id;

        if ($request->hasfile('patient_id_proof_file')) {
            $patient_id_proof_file = $request->file('patient_id_proof_file');
            $name = $patient_id_proof_file->getClientOriginalName();
            $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'patient_id_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
            $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
            $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
            $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor_prescriptions_or_consultation_papers_file' =>  $name
            ]);
        }

        if ($request->hasfile('insurance_policy_copy_file')) {
            $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
            $name = $insurance_policy_copy_file->getClientOriginalName();
            $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'insurance_policy_copy_file' =>  $name
            ]);
        }


        if ($request->hasfile('tpa_card_file')) {
            $tpa_card_file = $request->file('tpa_card_file');
            $name = $tpa_card_file->getClientOriginalName();
            $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'tpa_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('employee_or_member_id_group_file')) {
            $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
            $name = $employee_or_member_id_group_file->getClientOriginalName();
            $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'employee_or_member_id_group_file' =>  $name
            ]);
        }


        if ($request->hasfile('photograph_of_the_patient_file')) {
            $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
            $name = $photograph_of_the_patient_file->getClientOriginalName();
            $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'photograph_of_the_patient_file' =>  $name
            ]);
        }


        if ($request->hasfile('indoor_care_paper_file')) {
            $indoor_care_paper_file = $request->file('indoor_care_paper_file');
            $name = $indoor_care_paper_file->getClientOriginalName();
            $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'indoor_care_paper_file' =>  $name
            ]);
        }

        if ($request->hasfile('ecg_report_file')) {
            $ecg_report_file = $request->file('ecg_report_fileile');
            $name = $ecg_report_file->getClientOriginalName();
            $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ecg_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
            $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
            $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
            $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ct_mri_usg_hpe_investigation_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
            $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
            $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
            $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'diagnostic_or_investigation_reports_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
            $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
            $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
            $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor’s_reference_slip_for_investigation_file' =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_notes_file')) {
            $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
            $name = $operation_theatre_notes_file->getClientOriginalName();
            $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'operation_theatre_notes_file' =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_bills_file')) {
            $pharmacy_bills_file = $request->file('pharmacy_bills_file');
            $name = $pharmacy_bills_file->getClientOriginalName();
            $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'pharmacy_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('implant_sticker_invoice_file')) {
            $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
            $name = $implant_sticker_invoice_file->getClientOriginalName();
            $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'implant_sticker_invoice_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_break_up_bills_file')) {
            $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
            $name = $hospital_break_up_bills_file->getClientOriginalName();
            $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_break_up_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_main_final_bill_file')) {
            $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
            $name = $hospital_main_final_bill_file->getClientOriginalName();
            $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_main_final_bill_file' =>  $name
            ]);
        }


        if ($request->hasfile('discharge_or_day_care_summary_file')) {
            $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
            $name = $discharge_or_day_care_summary_file->getClientOriginalName();
            $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'discharge_or_day_care_summary_file' =>  $name
            ]);
        }

        if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
            $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
            $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
            $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'death_summary_from_hospital_where_applicable_file' =>  $name
            ]);
        }

        if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
            $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
            $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
            $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'payment_receipts_of_the_hospital_file' =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file = $request->file('other_documents_file');
            $name = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_pan_card_file')) {
            $claimant_pan_card_file = $request->file('claimant_pan_card_file');
            $name = $claimant_pan_card_file->getClientOriginalName();
            $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_aadhar_card_file')) {
            $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
            $name = $claimant_aadhar_card_file->getClientOriginalName();
            $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_current_address_proof_file')) {
            $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
            $name = $claimant_current_address_proof_file->getClientOriginalName();
            $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_cancel_cheque_file')) {
            $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
            $name = $claimant_cancel_cheque_file->getClientOriginalName();
            $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_cancel_cheque_file' =>  $name
            ]);
        }


        if ($request->hasfile('abha_id_proof_file')) {
            $abha_id_proof_file = $request->file('abha_id_proof_file');
            $name = $abha_id_proof_file->getClientOriginalName();
            $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'abha_id_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
            $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
            $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
            $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'mlc_report_and_police_fir_document_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_current_address_proof_file')) {
            $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
            $name = $borrower_current_address_proof_file->getClientOriginalName();
            $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_current_address_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_card_file')) {
            $borrower_pan_card_file = $request->file('borrower_pan_card_file');
            $name = $borrower_pan_card_file->getClientOriginalName();
            $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_aadhar_card_file')) {
            $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
            $name = $borrower_aadhar_card_file->getClientOriginalName();
            $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_bank_statement_3_months_file')) {
            $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
            $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
            $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_bank_statement_3_months_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_itr_income_tax_return_file')) {
            $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
            $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
            $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
            $name = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_other_documents_file')) {
            $borrower_other_documents_file = $request->file('borrower_other_documents_file');
            $name = $borrower_other_documents_file->getClientOriginalName();
            $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_current_address_proof_file')) {
            $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
            $name = $co_borrower_current_address_proof_file->getClientOriginalName();
            $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_pan_card_file')) {
            $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
            $name = $co_borrower_pan_card_file->getClientOriginalName();
            $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_pan_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_aadhar_card_file')) {
            $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
            $name = $co_borrower_aadhar_card_file->getClientOriginalName();
            $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_aadhar_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
            $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
            $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
            $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_bank_statement_3_months_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
            $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
            $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
            $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_cancel_cheque_file')) {
            $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
            $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
            $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
            $name = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_other_documents_file' =>  $name
            ]);
        }

        $rules = [
            'patient_id' => empty($reimbursementdocument->patient_id) ? 'required' : [],
            'patient_title' => empty($reimbursementdocument->patient_title) ? 'required' : [],
            'patient_firstname' => empty($reimbursementdocument->patient_firstname) ? 'required' : [],
            'patient_middlename' => empty($reimbursementdocument->patient_middlename) ? 'required' : [],
            'patient_lastname' => empty($reimbursementdocument->patient_lastname) ? 'required' : [],
            'patient_id_proof_file' => empty($reimbursementdocument->patient_id_proof_file) ? 'required' : [],
            'doctor_prescriptions_or_consultation_papers_file' => empty($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
            'insurance_policy_copy_file' => empty($reimbursementdocument->insurance_policy_copy_file) ? 'required' : [],
            'tpa_card_file' => empty($reimbursementdocument->tpa_card_file) ? 'required' : [],
            'employee_or_member_id_group_file' => empty($reimbursementdocument->employee_or_member_id_group_file) ? 'required' : [],
            'photograph_of_the_patient_file' => empty($reimbursementdocument->photograph_of_the_patient_file) ? 'required' : [],
            // 'indoor_care_paper_file' => empty($reimbursementdocument->indoor_care_paper_file) ? 'required' : [],
            // 'ecg_report_file' => empty($reimbursementdocument->ecg_report_file) ? 'required' : [],
            // 'ct_mri_usg_hpe_investigation_report_file' => empty($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) ? 'required' : [],
            'diagnostic_or_investigation_reports_file' => empty($reimbursementdocument->diagnostic_or_investigation_reports_file) ? 'required' : [],
            // 'doctor’s_reference_slip_for_investigation_file' => empty($reimbursementdocument->doctor’s_reference_slip_for_investigation_file) ? 'required' : [],
            // 'operation_theatre_notes_file' => empty($reimbursementdocument->operation_theatre_notes_file) ? 'required' : [],
            'pharmacy_bills_file' => empty($reimbursementdocument->pharmacy_bills_file) ? 'required' : [],
            // 'implant_sticker_invoice_file' => empty($reimbursementdocument->implant_sticker_invoice_file) ? 'required' : [],
            'hospital_break_up_bills_file' => empty($reimbursementdocument->hospital_break_up_bills_file) ? 'required' : [],
            'hospital_main_final_bill_file' => empty($reimbursementdocument->hospital_main_final_bill_file) ? 'required' : [],
            'discharge_or_day_care_summary_file' => empty($reimbursementdocument->discharge_or_day_care_summary_file) ? 'required' : [],
            // 'death_summary_from_hospital_where_applicable_file' => empty($reimbursementdocument->death_summary_from_hospital_where_applicable_file) ? 'required' : [],
            'payment_receipts_of_the_hospital_file' => empty($reimbursementdocument->payment_receipts_of_the_hospital_file) ? 'required' : [],
            // 'other_documents_file' => empty($reimbursementdocument->other_documents_file) ? 'required' : [],
            'claimant_pan_card_file' => empty($reimbursementdocument->claimant_pan_card_file) ? 'required' : [],
            'claimant_aadhar_card_file' => empty($reimbursementdocument->claimant_aadhar_card_file) ? 'required' : [],
            'claimant_current_address_proof_file' => empty($reimbursementdocument->claimant_current_address_proof_file) ? 'required' : [],
            'claimant_cancel_cheque_file' => empty($reimbursementdocument->claimant_cancel_cheque_file) ? 'required' : [],
            // 'abha_id_proof_file' => empty($reimbursementdocument->abha_id_proof_file) ? 'required' : [],
            // 'mlc_report_and_police_fir_document_file' => empty($reimbursementdocument->mlc_report_and_police_fir_document_file) ? 'required' : [],
            'borrower_current_address_proof_file' => empty($reimbursementdocument->borrower_current_address_proof_file) ? 'required' : [],
            'borrower_pan_card_file' => empty($reimbursementdocument->borrower_pan_card_file) ? 'required' : [],
            'borrower_aadhar_card_file' => empty($reimbursementdocument->borrower_aadhar_card_file) ? 'required' : [],
            'borrower_bank_statement_3_months_file' => empty($reimbursementdocument->borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'borrower_itr_income_tax_return_file' => empty($reimbursementdocument->borrower_itr_income_tax_return_file) ? 'required' : [],
            'borrower_cancel_cheque_file' => empty($reimbursementdocument->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_other_documents_file' => empty($reimbursementdocument->borrower_other_documents_file) ? 'required' : [],
            'co_borrower_current_address_proof_file' => empty($reimbursementdocument->co_borrower_current_address_proof_file) ? 'required' : [],
            'co_borrower_pan_card_file' => empty($reimbursementdocument->co_borrower_pan_card_file) ? 'required' : [],
            'co_borrower_aadhar_card_file' => empty($reimbursementdocument->co_borrower_aadhar_card_file) ? 'required' : [],
            'co_borrower_bank_statement_3_months_file' => empty($reimbursementdocument->co_borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'co_borrower_itr_income_tax_return_file' => empty($reimbursementdocument->co_borrower_itr_income_tax_return_file) ? 'required' : [],
            'co_borrower_cancel_cheque_file' => empty($reimbursementdocument->co_borrower_cancel_cheque_file) ? 'required' : [],
            'co_borrower_other_documents_file' => empty($reimbursementdocument->co_borrower_other_documents_file) ? 'required' : [],

        ];

        $messages = [
            'patient_id.required' => 'Please select Patient Id',
            'patient_title.required' => 'Please select Patient Title',
            'patient_firstname.required' => 'Please select Patient Firstname',
            'patient_middlename.required' => 'Please select Patient Middlename',
            'patient_lastname.required' => 'Please select Patient Lastname',
            'patient_id_proof_file.required' => 'Please select Patient Id Proof File',
            'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
            'insurance_policy_copy_file.required' => 'Please select Insurance Policy Copy File',
            'tpa_card_file.required' => 'Please select Tpa Card File',
            'employee_or_member_id_group_file.required' => 'Please select Employee Or Member Id Group File',
            'photograph_of_the_patient_file.required' => 'Please select Photograph Of The Patient File',
            'indoor_care_paper_file.required' => 'Please select Indoor Care Paper File',
            'ecg_report_file.required' => 'Please select Ecg Report File',
            'ct_mri_usg_hpe_investigation_report_file.required' => 'Please select Ct Mri Usg Hpe Investigation Report File',
            'diagnostic_or_investigation_reports_file.required' => 'Please select Diagnostic Or Investigation Reports File',
            'doctor’s_reference_slip_for_investigation_file.required' => 'Please select Doctor’s Reference Slip For Investigation File',
            'operation_theatre_notes_file.required' => 'Please select Operation Theatre Notes File',
            'pharmacy_bills_file.required' => 'Please select Pharmacy Bills File',
            'implant_sticker_invoice_file.required' => 'Please select Implant Sticker Invoice File',
            'hospital_break_up_bills_file.required' => 'Please select Hospital Break Up Bills File',
            'hospital_main_final_bill_file.required' => 'Please select Hospital Main Final Bill File',
            'discharge_or_day_care_summary_file.required' => 'Please select Discharge Or Day Care Summary File',
            'death_summary_from_hospital_where_applicable_file.required' => 'Please select Death Summary From Hospital Where Applicable File',
            'payment_receipts_of_the_hospital_file.required' => 'Please select Payment Receipts Of The Hospital File',
            'other_documents_file.required' => 'Please select Other Documents File',
            'claimant_pan_card_file.required' => 'Please select Claimant Pan Card File',
            'claimant_aadhar_card_file.required' => 'Please select Claimant Aadhar Card File',
            'claimant_current_address_proof_file.required' => 'Please select Claimant Current Address Proof File',
            'claimant_cancel_cheque_file.required' => 'Please select Claimant Cancel Cheque File',
            'abha_id_proof_file.required' => 'Please select Abha Id Proof File',
            'mlc_report_and_police_fir_document_file.required' => 'Please select Mlc Report And Police Fir Document File',
            'borrower_current_address_proof_file.required' => 'Please select Borrower Current Address Proof File',
            'borrower_pan_card_file.required' => 'Please select Borrower Pan Card File',
            'borrower_aadhar_card_file.required' => 'Please select Borrower Aadhar Card File',
            'borrower_bank_statement_3_months_file.required' => 'Please select Borrower Bank Statement 3 Months File',
            'borrower_itr_income_tax_return_file.required' => 'Please select Borrower Itr Income Tax Return File',
            'borrower_cancel_cheque_file.required' => 'Please select Borrower Cancel Cheque File',
            'borrower_other_documents_file.required' => 'Please select Borrower Other Documents File',
            'co_borrower_current_address_proof_file.required' => 'Please select Co Borrower Current Address Proof File',
            'co_borrower_pan_card_file.required' => 'Please select Co Borrower Pan Card File',
            'co_borrower_aadhar_card_file.required' => 'Please select Co Borrower Aadhar Card File',
            'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',
            'co_borrower_itr_income_tax_return_file.required' => 'Please select Co Borrower Itr Income Tax Return File',
            'co_borrower_cancel_cheque_file.required' => 'Please select Co Borrower Cancel Cheque File',
            'co_borrower_other_documents_file.required' => 'Please select Co Borrower Other Documents File',

        ];

        $this->validateWithBag('initial-assessment-form', $request, $rules, $messages);

       $reimbursementdocument =  ReimbursementDocument::where('patient_id', 'P-10001')->update($request->except('_token','patient_id'));

        return redirect()->back()->with('success', 'Patient added successfully');

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals'));
    }


    public function saveDocumentsReimbursement1(Request $request, $id)
    {
        $claimant = Claimant::find($id);

        $exists = ReimbursementDocument::where('patient_id', $claimant->patient_id)->exists();

        if (!$exists) {
           ReimbursementDocument::create(['patient_id' => $claimant->patient_id]);
       }

       $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

       $id = $reimbursementdocument->id;

        if ($request->hasfile('patient_id_proof_file')) {
            $patient_id_proof_file = $request->file('patient_id_proof_file');
            $name = $patient_id_proof_file->getClientOriginalName();
            $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'patient_id_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
            $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
            $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
            $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor_prescriptions_or_consultation_papers_file' =>  $name
            ]);
        }

        if ($request->hasfile('insurance_policy_copy_file')) {
            $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
            $name = $insurance_policy_copy_file->getClientOriginalName();
            $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'insurance_policy_copy_file' =>  $name
            ]);
        }


        if ($request->hasfile('tpa_card_file')) {
            $tpa_card_file = $request->file('tpa_card_file');
            $name = $tpa_card_file->getClientOriginalName();
            $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'tpa_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('employee_or_member_id_group_file')) {
            $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
            $name = $employee_or_member_id_group_file->getClientOriginalName();
            $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'employee_or_member_id_group_file' =>  $name
            ]);
        }


        if ($request->hasfile('photograph_of_the_patient_file')) {
            $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
            $name = $photograph_of_the_patient_file->getClientOriginalName();
            $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'photograph_of_the_patient_file' =>  $name
            ]);
        }


        if ($request->hasfile('indoor_care_paper_file')) {
            $indoor_care_paper_file = $request->file('indoor_care_paper_file');
            $name = $indoor_care_paper_file->getClientOriginalName();
            $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'indoor_care_paper_file' =>  $name
            ]);
        }

        if ($request->hasfile('ecg_report_file')) {
            $ecg_report_file = $request->file('ecg_report_fileile');
            $name = $ecg_report_file->getClientOriginalName();
            $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ecg_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
            $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
            $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
            $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ct_mri_usg_hpe_investigation_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
            $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
            $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
            $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'diagnostic_or_investigation_reports_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
            $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
            $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
            $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor’s_reference_slip_for_investigation_file' =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_notes_file')) {
            $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
            $name = $operation_theatre_notes_file->getClientOriginalName();
            $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'operation_theatre_notes_file' =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_bills_file')) {
            $pharmacy_bills_file = $request->file('pharmacy_bills_file');
            $name = $pharmacy_bills_file->getClientOriginalName();
            $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'pharmacy_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('implant_sticker_invoice_file')) {
            $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
            $name = $implant_sticker_invoice_file->getClientOriginalName();
            $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'implant_sticker_invoice_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_break_up_bills_file')) {
            $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
            $name = $hospital_break_up_bills_file->getClientOriginalName();
            $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_break_up_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_main_final_bill_file')) {
            $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
            $name = $hospital_main_final_bill_file->getClientOriginalName();
            $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_main_final_bill_file' =>  $name
            ]);
        }


        if ($request->hasfile('discharge_or_day_care_summary_file')) {
            $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
            $name = $discharge_or_day_care_summary_file->getClientOriginalName();
            $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'discharge_or_day_care_summary_file' =>  $name
            ]);
        }

        if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
            $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
            $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
            $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'death_summary_from_hospital_where_applicable_file' =>  $name
            ]);
        }

        if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
            $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
            $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
            $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'payment_receipts_of_the_hospital_file' =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file = $request->file('other_documents_file');
            $name = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_pan_card_file')) {
            $claimant_pan_card_file = $request->file('claimant_pan_card_file');
            $name = $claimant_pan_card_file->getClientOriginalName();
            $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_aadhar_card_file')) {
            $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
            $name = $claimant_aadhar_card_file->getClientOriginalName();
            $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_current_address_proof_file')) {
            $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
            $name = $claimant_current_address_proof_file->getClientOriginalName();
            $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_cancel_cheque_file')) {
            $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
            $name = $claimant_cancel_cheque_file->getClientOriginalName();
            $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_cancel_cheque_file' =>  $name
            ]);
        }


        if ($request->hasfile('abha_id_proof_file')) {
            $abha_id_proof_file = $request->file('abha_id_proof_file');
            $name = $abha_id_proof_file->getClientOriginalName();
            $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'abha_id_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
            $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
            $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
            $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'mlc_report_and_police_fir_document_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_current_address_proof_file')) {
            $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
            $name = $borrower_current_address_proof_file->getClientOriginalName();
            $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_current_address_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_card_file')) {
            $borrower_pan_card_file = $request->file('borrower_pan_card_file');
            $name = $borrower_pan_card_file->getClientOriginalName();
            $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_aadhar_card_file')) {
            $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
            $name = $borrower_aadhar_card_file->getClientOriginalName();
            $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_bank_statement_3_months_file')) {
            $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
            $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
            $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_bank_statement_3_months_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_itr_income_tax_return_file')) {
            $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
            $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
            $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
            $name = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_other_documents_file')) {
            $borrower_other_documents_file = $request->file('borrower_other_documents_file');
            $name = $borrower_other_documents_file->getClientOriginalName();
            $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_current_address_proof_file')) {
            $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
            $name = $co_borrower_current_address_proof_file->getClientOriginalName();
            $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_pan_card_file')) {
            $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
            $name = $co_borrower_pan_card_file->getClientOriginalName();
            $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_pan_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_aadhar_card_file')) {
            $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
            $name = $co_borrower_aadhar_card_file->getClientOriginalName();
            $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_aadhar_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
            $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
            $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
            $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_bank_statement_3_months_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
            $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
            $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
            $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_cancel_cheque_file')) {
            $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
            $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
            $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
            $name = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_other_documents_file' =>  $name
            ]);
        }

        $rules = [
            'patient_id' => empty($reimbursementdocument->patient_id) ? 'required' : [],
            'patient_title' => empty($reimbursementdocument->patient_title) ? 'required' : [],
            'patient_firstname' => empty($reimbursementdocument->patient_firstname) ? 'required' : [],
            'patient_middlename' => empty($reimbursementdocument->patient_middlename) ? 'required' : [],
            'patient_lastname' => empty($reimbursementdocument->patient_lastname) ? 'required' : [],
            'patient_id_proof_file' => empty($reimbursementdocument->patient_id_proof_file) ? 'required' : [],
            'doctor_prescriptions_or_consultation_papers_file' => empty($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
            'insurance_policy_copy_file' => empty($reimbursementdocument->insurance_policy_copy_file) ? 'required' : [],
            'tpa_card_file' => empty($reimbursementdocument->tpa_card_file) ? 'required' : [],
            'employee_or_member_id_group_file' => empty($reimbursementdocument->employee_or_member_id_group_file) ? 'required' : [],
            'photograph_of_the_patient_file' => empty($reimbursementdocument->photograph_of_the_patient_file) ? 'required' : [],
            // 'indoor_care_paper_file' => empty($reimbursementdocument->indoor_care_paper_file) ? 'required' : [],
            // 'ecg_report_file' => empty($reimbursementdocument->ecg_report_file) ? 'required' : [],
            // 'ct_mri_usg_hpe_investigation_report_file' => empty($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) ? 'required' : [],
            'diagnostic_or_investigation_reports_file' => empty($reimbursementdocument->diagnostic_or_investigation_reports_file) ? 'required' : [],
            // 'doctor’s_reference_slip_for_investigation_file' => empty($reimbursementdocument->doctor’s_reference_slip_for_investigation_file) ? 'required' : [],
            // 'operation_theatre_notes_file' => empty($reimbursementdocument->operation_theatre_notes_file) ? 'required' : [],
            'pharmacy_bills_file' => empty($reimbursementdocument->pharmacy_bills_file) ? 'required' : [],
            // 'implant_sticker_invoice_file' => empty($reimbursementdocument->implant_sticker_invoice_file) ? 'required' : [],
            'hospital_break_up_bills_file' => empty($reimbursementdocument->hospital_break_up_bills_file) ? 'required' : [],
            'hospital_main_final_bill_file' => empty($reimbursementdocument->hospital_main_final_bill_file) ? 'required' : [],
            'discharge_or_day_care_summary_file' => empty($reimbursementdocument->discharge_or_day_care_summary_file) ? 'required' : [],
            // 'death_summary_from_hospital_where_applicable_file' => empty($reimbursementdocument->death_summary_from_hospital_where_applicable_file) ? 'required' : [],
            'payment_receipts_of_the_hospital_file' => empty($reimbursementdocument->payment_receipts_of_the_hospital_file) ? 'required' : [],
            // 'other_documents_file' => empty($reimbursementdocument->other_documents_file) ? 'required' : [],
            'claimant_pan_card_file' => empty($reimbursementdocument->claimant_pan_card_file) ? 'required' : [],
            'claimant_aadhar_card_file' => empty($reimbursementdocument->claimant_aadhar_card_file) ? 'required' : [],
            'claimant_current_address_proof_file' => empty($reimbursementdocument->claimant_current_address_proof_file) ? 'required' : [],
            'claimant_cancel_cheque_file' => empty($reimbursementdocument->claimant_cancel_cheque_file) ? 'required' : [],
            // 'abha_id_proof_file' => empty($reimbursementdocument->abha_id_proof_file) ? 'required' : [],
            // 'mlc_report_and_police_fir_document_file' => empty($reimbursementdocument->mlc_report_and_police_fir_document_file) ? 'required' : [],
            'borrower_current_address_proof_file' => empty($reimbursementdocument->borrower_current_address_proof_file) ? 'required' : [],
            'borrower_pan_card_file' => empty($reimbursementdocument->borrower_pan_card_file) ? 'required' : [],
            'borrower_aadhar_card_file' => empty($reimbursementdocument->borrower_aadhar_card_file) ? 'required' : [],
            'borrower_bank_statement_3_months_file' => empty($reimbursementdocument->borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'borrower_itr_income_tax_return_file' => empty($reimbursementdocument->borrower_itr_income_tax_return_file) ? 'required' : [],
            'borrower_cancel_cheque_file' => empty($reimbursementdocument->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_other_documents_file' => empty($reimbursementdocument->borrower_other_documents_file) ? 'required' : [],
            'co_borrower_current_address_proof_file' => empty($reimbursementdocument->co_borrower_current_address_proof_file) ? 'required' : [],
            'co_borrower_pan_card_file' => empty($reimbursementdocument->co_borrower_pan_card_file) ? 'required' : [],
            'co_borrower_aadhar_card_file' => empty($reimbursementdocument->co_borrower_aadhar_card_file) ? 'required' : [],
            'co_borrower_bank_statement_3_months_file' => empty($reimbursementdocument->co_borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'co_borrower_itr_income_tax_return_file' => empty($reimbursementdocument->co_borrower_itr_income_tax_return_file) ? 'required' : [],
            'co_borrower_cancel_cheque_file' => empty($reimbursementdocument->co_borrower_cancel_cheque_file) ? 'required' : [],
            'co_borrower_other_documents_file' => empty($reimbursementdocument->co_borrower_other_documents_file) ? 'required' : [],

        ];

        $messages = [
            'patient_id.required' => 'Please select Patient Id',
            'patient_title.required' => 'Please select Patient Title',
            'patient_firstname.required' => 'Please select Patient Firstname',
            'patient_middlename.required' => 'Please select Patient Middlename',
            'patient_lastname.required' => 'Please select Patient Lastname',
            'patient_id_proof_file.required' => 'Please select Patient Id Proof File',
            'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
            'insurance_policy_copy_file.required' => 'Please select Insurance Policy Copy File',
            'tpa_card_file.required' => 'Please select Tpa Card File',
            'employee_or_member_id_group_file.required' => 'Please select Employee Or Member Id Group File',
            'photograph_of_the_patient_file.required' => 'Please select Photograph Of The Patient File',
            'indoor_care_paper_file.required' => 'Please select Indoor Care Paper File',
            'ecg_report_file.required' => 'Please select Ecg Report File',
            'ct_mri_usg_hpe_investigation_report_file.required' => 'Please select Ct Mri Usg Hpe Investigation Report File',
            'diagnostic_or_investigation_reports_file.required' => 'Please select Diagnostic Or Investigation Reports File',
            'doctor’s_reference_slip_for_investigation_file.required' => 'Please select Doctor’s Reference Slip For Investigation File',
            'operation_theatre_notes_file.required' => 'Please select Operation Theatre Notes File',
            'pharmacy_bills_file.required' => 'Please select Pharmacy Bills File',
            'implant_sticker_invoice_file.required' => 'Please select Implant Sticker Invoice File',
            'hospital_break_up_bills_file.required' => 'Please select Hospital Break Up Bills File',
            'hospital_main_final_bill_file.required' => 'Please select Hospital Main Final Bill File',
            'discharge_or_day_care_summary_file.required' => 'Please select Discharge Or Day Care Summary File',
            'death_summary_from_hospital_where_applicable_file.required' => 'Please select Death Summary From Hospital Where Applicable File',
            'payment_receipts_of_the_hospital_file.required' => 'Please select Payment Receipts Of The Hospital File',
            'other_documents_file.required' => 'Please select Other Documents File',
            'claimant_pan_card_file.required' => 'Please select Claimant Pan Card File',
            'claimant_aadhar_card_file.required' => 'Please select Claimant Aadhar Card File',
            'claimant_current_address_proof_file.required' => 'Please select Claimant Current Address Proof File',
            'claimant_cancel_cheque_file.required' => 'Please select Claimant Cancel Cheque File',
            'abha_id_proof_file.required' => 'Please select Abha Id Proof File',
            'mlc_report_and_police_fir_document_file.required' => 'Please select Mlc Report And Police Fir Document File',
            'borrower_current_address_proof_file.required' => 'Please select Borrower Current Address Proof File',
            'borrower_pan_card_file.required' => 'Please select Borrower Pan Card File',
            'borrower_aadhar_card_file.required' => 'Please select Borrower Aadhar Card File',
            'borrower_bank_statement_3_months_file.required' => 'Please select Borrower Bank Statement 3 Months File',
            'borrower_itr_income_tax_return_file.required' => 'Please select Borrower Itr Income Tax Return File',
            'borrower_cancel_cheque_file.required' => 'Please select Borrower Cancel Cheque File',
            'borrower_other_documents_file.required' => 'Please select Borrower Other Documents File',
            'co_borrower_current_address_proof_file.required' => 'Please select Co Borrower Current Address Proof File',
            'co_borrower_pan_card_file.required' => 'Please select Co Borrower Pan Card File',
            'co_borrower_aadhar_card_file.required' => 'Please select Co Borrower Aadhar Card File',
            'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',
            'co_borrower_itr_income_tax_return_file.required' => 'Please select Co Borrower Itr Income Tax Return File',
            'co_borrower_cancel_cheque_file.required' => 'Please select Co Borrower Cancel Cheque File',
            'co_borrower_other_documents_file.required' => 'Please select Co Borrower Other Documents File',

        ];

        $this->validateWithBag('final-assessment-form',$request, $rules, $messages);

       $reimbursementdocument =  ReimbursementDocument::where('patient_id', 'P-10001')->update($request->except('_token','patient_id'));

        return redirect()->back()->with('success', 'Patient added successfully');

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals'));
    }


    public function saveDocumentsReimbursement2(Request $request, $id)
    {
        $claimant = Claimant::find($id);

        $exists = ReimbursementDocument::where('patient_id', $claimant->patient_id)->exists();

        if (!$exists) {
           ReimbursementDocument::create(['patient_id' => $claimant->patient_id]);
       }

       $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

       $id = $reimbursementdocument->id;

        if ($request->hasfile('patient_id_proof_file')) {
            $patient_id_proof_file = $request->file('patient_id_proof_file');
            $name = $patient_id_proof_file->getClientOriginalName();
            $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'patient_id_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
            $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
            $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
            $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor_prescriptions_or_consultation_papers_file' =>  $name
            ]);
        }

        if ($request->hasfile('insurance_policy_copy_file')) {
            $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
            $name = $insurance_policy_copy_file->getClientOriginalName();
            $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'insurance_policy_copy_file' =>  $name
            ]);
        }


        if ($request->hasfile('tpa_card_file')) {
            $tpa_card_file = $request->file('tpa_card_file');
            $name = $tpa_card_file->getClientOriginalName();
            $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'tpa_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('employee_or_member_id_group_file')) {
            $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
            $name = $employee_or_member_id_group_file->getClientOriginalName();
            $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'employee_or_member_id_group_file' =>  $name
            ]);
        }


        if ($request->hasfile('photograph_of_the_patient_file')) {
            $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
            $name = $photograph_of_the_patient_file->getClientOriginalName();
            $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'photograph_of_the_patient_file' =>  $name
            ]);
        }


        if ($request->hasfile('indoor_care_paper_file')) {
            $indoor_care_paper_file = $request->file('indoor_care_paper_file');
            $name = $indoor_care_paper_file->getClientOriginalName();
            $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'indoor_care_paper_file' =>  $name
            ]);
        }

        if ($request->hasfile('ecg_report_file')) {
            $ecg_report_file = $request->file('ecg_report_fileile');
            $name = $ecg_report_file->getClientOriginalName();
            $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ecg_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
            $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
            $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
            $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ct_mri_usg_hpe_investigation_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
            $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
            $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
            $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'diagnostic_or_investigation_reports_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
            $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
            $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
            $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor’s_reference_slip_for_investigation_file' =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_notes_file')) {
            $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
            $name = $operation_theatre_notes_file->getClientOriginalName();
            $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'operation_theatre_notes_file' =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_bills_file')) {
            $pharmacy_bills_file = $request->file('pharmacy_bills_file');
            $name = $pharmacy_bills_file->getClientOriginalName();
            $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'pharmacy_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('implant_sticker_invoice_file')) {
            $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
            $name = $implant_sticker_invoice_file->getClientOriginalName();
            $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'implant_sticker_invoice_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_break_up_bills_file')) {
            $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
            $name = $hospital_break_up_bills_file->getClientOriginalName();
            $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_break_up_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_main_final_bill_file')) {
            $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
            $name = $hospital_main_final_bill_file->getClientOriginalName();
            $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_main_final_bill_file' =>  $name
            ]);
        }


        if ($request->hasfile('discharge_or_day_care_summary_file')) {
            $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
            $name = $discharge_or_day_care_summary_file->getClientOriginalName();
            $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'discharge_or_day_care_summary_file' =>  $name
            ]);
        }

        if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
            $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
            $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
            $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'death_summary_from_hospital_where_applicable_file' =>  $name
            ]);
        }

        if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
            $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
            $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
            $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'payment_receipts_of_the_hospital_file' =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file = $request->file('other_documents_file');
            $name = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_pan_card_file')) {
            $claimant_pan_card_file = $request->file('claimant_pan_card_file');
            $name = $claimant_pan_card_file->getClientOriginalName();
            $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_aadhar_card_file')) {
            $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
            $name = $claimant_aadhar_card_file->getClientOriginalName();
            $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_current_address_proof_file')) {
            $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
            $name = $claimant_current_address_proof_file->getClientOriginalName();
            $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_cancel_cheque_file')) {
            $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
            $name = $claimant_cancel_cheque_file->getClientOriginalName();
            $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_cancel_cheque_file' =>  $name
            ]);
        }


        if ($request->hasfile('abha_id_proof_file')) {
            $abha_id_proof_file = $request->file('abha_id_proof_file');
            $name = $abha_id_proof_file->getClientOriginalName();
            $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'abha_id_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
            $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
            $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
            $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'mlc_report_and_police_fir_document_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_current_address_proof_file')) {
            $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
            $name = $borrower_current_address_proof_file->getClientOriginalName();
            $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_current_address_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_card_file')) {
            $borrower_pan_card_file = $request->file('borrower_pan_card_file');
            $name = $borrower_pan_card_file->getClientOriginalName();
            $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_aadhar_card_file')) {
            $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
            $name = $borrower_aadhar_card_file->getClientOriginalName();
            $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_bank_statement_3_months_file')) {
            $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
            $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
            $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_bank_statement_3_months_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_itr_income_tax_return_file')) {
            $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
            $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
            $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
            $name = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_other_documents_file')) {
            $borrower_other_documents_file = $request->file('borrower_other_documents_file');
            $name = $borrower_other_documents_file->getClientOriginalName();
            $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_current_address_proof_file')) {
            $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
            $name = $co_borrower_current_address_proof_file->getClientOriginalName();
            $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_pan_card_file')) {
            $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
            $name = $co_borrower_pan_card_file->getClientOriginalName();
            $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_pan_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_aadhar_card_file')) {
            $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
            $name = $co_borrower_aadhar_card_file->getClientOriginalName();
            $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_aadhar_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
            $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
            $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
            $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_bank_statement_3_months_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
            $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
            $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
            $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_cancel_cheque_file')) {
            $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
            $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
            $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
            $name = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_other_documents_file' =>  $name
            ]);
        }

        $rules = [
            'patient_id' => empty($reimbursementdocument->patient_id) ? 'required' : [],
            'patient_title' => empty($reimbursementdocument->patient_title) ? 'required' : [],
            'patient_firstname' => empty($reimbursementdocument->patient_firstname) ? 'required' : [],
            'patient_middlename' => empty($reimbursementdocument->patient_middlename) ? 'required' : [],
            'patient_lastname' => empty($reimbursementdocument->patient_lastname) ? 'required' : [],
            'patient_id_proof_file' => empty($reimbursementdocument->patient_id_proof_file) ? 'required' : [],
            'doctor_prescriptions_or_consultation_papers_file' => empty($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
            'insurance_policy_copy_file' => empty($reimbursementdocument->insurance_policy_copy_file) ? 'required' : [],
            'tpa_card_file' => empty($reimbursementdocument->tpa_card_file) ? 'required' : [],
            'employee_or_member_id_group_file' => empty($reimbursementdocument->employee_or_member_id_group_file) ? 'required' : [],
            'photograph_of_the_patient_file' => empty($reimbursementdocument->photograph_of_the_patient_file) ? 'required' : [],
            // 'indoor_care_paper_file' => empty($reimbursementdocument->indoor_care_paper_file) ? 'required' : [],
            // 'ecg_report_file' => empty($reimbursementdocument->ecg_report_file) ? 'required' : [],
            // 'ct_mri_usg_hpe_investigation_report_file' => empty($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) ? 'required' : [],
            'diagnostic_or_investigation_reports_file' => empty($reimbursementdocument->diagnostic_or_investigation_reports_file) ? 'required' : [],
            // 'doctor’s_reference_slip_for_investigation_file' => empty($reimbursementdocument->doctor’s_reference_slip_for_investigation_file) ? 'required' : [],
            // 'operation_theatre_notes_file' => empty($reimbursementdocument->operation_theatre_notes_file) ? 'required' : [],
            'pharmacy_bills_file' => empty($reimbursementdocument->pharmacy_bills_file) ? 'required' : [],
            // 'implant_sticker_invoice_file' => empty($reimbursementdocument->implant_sticker_invoice_file) ? 'required' : [],
            'hospital_break_up_bills_file' => empty($reimbursementdocument->hospital_break_up_bills_file) ? 'required' : [],
            'hospital_main_final_bill_file' => empty($reimbursementdocument->hospital_main_final_bill_file) ? 'required' : [],
            'discharge_or_day_care_summary_file' => empty($reimbursementdocument->discharge_or_day_care_summary_file) ? 'required' : [],
            // 'death_summary_from_hospital_where_applicable_file' => empty($reimbursementdocument->death_summary_from_hospital_where_applicable_file) ? 'required' : [],
            'payment_receipts_of_the_hospital_file' => empty($reimbursementdocument->payment_receipts_of_the_hospital_file) ? 'required' : [],
            // 'other_documents_file' => empty($reimbursementdocument->other_documents_file) ? 'required' : [],
            'claimant_pan_card_file' => empty($reimbursementdocument->claimant_pan_card_file) ? 'required' : [],
            'claimant_aadhar_card_file' => empty($reimbursementdocument->claimant_aadhar_card_file) ? 'required' : [],
            'claimant_current_address_proof_file' => empty($reimbursementdocument->claimant_current_address_proof_file) ? 'required' : [],
            'claimant_cancel_cheque_file' => empty($reimbursementdocument->claimant_cancel_cheque_file) ? 'required' : [],
            // 'abha_id_proof_file' => empty($reimbursementdocument->abha_id_proof_file) ? 'required' : [],
            // 'mlc_report_and_police_fir_document_file' => empty($reimbursementdocument->mlc_report_and_police_fir_document_file) ? 'required' : [],
            'borrower_current_address_proof_file' => empty($reimbursementdocument->borrower_current_address_proof_file) ? 'required' : [],
            'borrower_pan_card_file' => empty($reimbursementdocument->borrower_pan_card_file) ? 'required' : [],
            'borrower_aadhar_card_file' => empty($reimbursementdocument->borrower_aadhar_card_file) ? 'required' : [],
            'borrower_bank_statement_3_months_file' => empty($reimbursementdocument->borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'borrower_itr_income_tax_return_file' => empty($reimbursementdocument->borrower_itr_income_tax_return_file) ? 'required' : [],
            'borrower_cancel_cheque_file' => empty($reimbursementdocument->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_other_documents_file' => empty($reimbursementdocument->borrower_other_documents_file) ? 'required' : [],
            'co_borrower_current_address_proof_file' => empty($reimbursementdocument->co_borrower_current_address_proof_file) ? 'required' : [],
            'co_borrower_pan_card_file' => empty($reimbursementdocument->co_borrower_pan_card_file) ? 'required' : [],
            'co_borrower_aadhar_card_file' => empty($reimbursementdocument->co_borrower_aadhar_card_file) ? 'required' : [],
            'co_borrower_bank_statement_3_months_file' => empty($reimbursementdocument->co_borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'co_borrower_itr_income_tax_return_file' => empty($reimbursementdocument->co_borrower_itr_income_tax_return_file) ? 'required' : [],
            'co_borrower_cancel_cheque_file' => empty($reimbursementdocument->co_borrower_cancel_cheque_file) ? 'required' : [],
            'co_borrower_other_documents_file' => empty($reimbursementdocument->co_borrower_other_documents_file) ? 'required' : [],

        ];

        $messages = [
            'patient_id.required' => 'Please select Patient Id',
            'patient_title.required' => 'Please select Patient Title',
            'patient_firstname.required' => 'Please select Patient Firstname',
            'patient_middlename.required' => 'Please select Patient Middlename',
            'patient_lastname.required' => 'Please select Patient Lastname',
            'patient_id_proof_file.required' => 'Please select Patient Id Proof File',
            'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
            'insurance_policy_copy_file.required' => 'Please select Insurance Policy Copy File',
            'tpa_card_file.required' => 'Please select Tpa Card File',
            'employee_or_member_id_group_file.required' => 'Please select Employee Or Member Id Group File',
            'photograph_of_the_patient_file.required' => 'Please select Photograph Of The Patient File',
            'indoor_care_paper_file.required' => 'Please select Indoor Care Paper File',
            'ecg_report_file.required' => 'Please select Ecg Report File',
            'ct_mri_usg_hpe_investigation_report_file.required' => 'Please select Ct Mri Usg Hpe Investigation Report File',
            'diagnostic_or_investigation_reports_file.required' => 'Please select Diagnostic Or Investigation Reports File',
            'doctor’s_reference_slip_for_investigation_file.required' => 'Please select Doctor’s Reference Slip For Investigation File',
            'operation_theatre_notes_file.required' => 'Please select Operation Theatre Notes File',
            'pharmacy_bills_file.required' => 'Please select Pharmacy Bills File',
            'implant_sticker_invoice_file.required' => 'Please select Implant Sticker Invoice File',
            'hospital_break_up_bills_file.required' => 'Please select Hospital Break Up Bills File',
            'hospital_main_final_bill_file.required' => 'Please select Hospital Main Final Bill File',
            'discharge_or_day_care_summary_file.required' => 'Please select Discharge Or Day Care Summary File',
            'death_summary_from_hospital_where_applicable_file.required' => 'Please select Death Summary From Hospital Where Applicable File',
            'payment_receipts_of_the_hospital_file.required' => 'Please select Payment Receipts Of The Hospital File',
            'other_documents_file.required' => 'Please select Other Documents File',
            'claimant_pan_card_file.required' => 'Please select Claimant Pan Card File',
            'claimant_aadhar_card_file.required' => 'Please select Claimant Aadhar Card File',
            'claimant_current_address_proof_file.required' => 'Please select Claimant Current Address Proof File',
            'claimant_cancel_cheque_file.required' => 'Please select Claimant Cancel Cheque File',
            'abha_id_proof_file.required' => 'Please select Abha Id Proof File',
            'mlc_report_and_police_fir_document_file.required' => 'Please select Mlc Report And Police Fir Document File',
            'borrower_current_address_proof_file.required' => 'Please select Borrower Current Address Proof File',
            'borrower_pan_card_file.required' => 'Please select Borrower Pan Card File',
            'borrower_aadhar_card_file.required' => 'Please select Borrower Aadhar Card File',
            'borrower_bank_statement_3_months_file.required' => 'Please select Borrower Bank Statement 3 Months File',
            'borrower_itr_income_tax_return_file.required' => 'Please select Borrower Itr Income Tax Return File',
            'borrower_cancel_cheque_file.required' => 'Please select Borrower Cancel Cheque File',
            'borrower_other_documents_file.required' => 'Please select Borrower Other Documents File',
            'co_borrower_current_address_proof_file.required' => 'Please select Co Borrower Current Address Proof File',
            'co_borrower_pan_card_file.required' => 'Please select Co Borrower Pan Card File',
            'co_borrower_aadhar_card_file.required' => 'Please select Co Borrower Aadhar Card File',
            'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',
            'co_borrower_itr_income_tax_return_file.required' => 'Please select Co Borrower Itr Income Tax Return File',
            'co_borrower_cancel_cheque_file.required' => 'Please select Co Borrower Cancel Cheque File',
            'co_borrower_other_documents_file.required' => 'Please select Co Borrower Other Documents File',

        ];

        $this->validateWithBag('insurance-claim-form', $request, $rules, $messages);

       $reimbursementdocument =  ReimbursementDocument::where('patient_id', 'P-10001')->update($request->except('_token','patient_id'));

        return redirect()->back()->with('success', 'Patient added successfully');

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals'));
    }


    public function saveDocumentsReimbursement3(Request $request, $id)
    {
        $claimant = Claimant::find($id);

        $exists = ReimbursementDocument::where('patient_id', $claimant->patient_id)->exists();

        if (!$exists) {
           ReimbursementDocument::create(['patient_id' => $claimant->patient_id]);
       }

       $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

       $id = $reimbursementdocument->id;

        if ($request->hasfile('patient_id_proof_file')) {
            $patient_id_proof_file = $request->file('patient_id_proof_file');
            $name = $patient_id_proof_file->getClientOriginalName();
            $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'patient_id_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
            $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
            $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
            $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor_prescriptions_or_consultation_papers_file' =>  $name
            ]);
        }

        if ($request->hasfile('insurance_policy_copy_file')) {
            $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
            $name = $insurance_policy_copy_file->getClientOriginalName();
            $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'insurance_policy_copy_file' =>  $name
            ]);
        }


        if ($request->hasfile('tpa_card_file')) {
            $tpa_card_file = $request->file('tpa_card_file');
            $name = $tpa_card_file->getClientOriginalName();
            $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'tpa_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('employee_or_member_id_group_file')) {
            $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
            $name = $employee_or_member_id_group_file->getClientOriginalName();
            $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'employee_or_member_id_group_file' =>  $name
            ]);
        }


        if ($request->hasfile('photograph_of_the_patient_file')) {
            $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
            $name = $photograph_of_the_patient_file->getClientOriginalName();
            $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'photograph_of_the_patient_file' =>  $name
            ]);
        }


        if ($request->hasfile('indoor_care_paper_file')) {
            $indoor_care_paper_file = $request->file('indoor_care_paper_file');
            $name = $indoor_care_paper_file->getClientOriginalName();
            $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'indoor_care_paper_file' =>  $name
            ]);
        }

        if ($request->hasfile('ecg_report_file')) {
            $ecg_report_file = $request->file('ecg_report_fileile');
            $name = $ecg_report_file->getClientOriginalName();
            $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ecg_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
            $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
            $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
            $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ct_mri_usg_hpe_investigation_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
            $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
            $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
            $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'diagnostic_or_investigation_reports_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
            $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
            $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
            $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor’s_reference_slip_for_investigation_file' =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_notes_file')) {
            $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
            $name = $operation_theatre_notes_file->getClientOriginalName();
            $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'operation_theatre_notes_file' =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_bills_file')) {
            $pharmacy_bills_file = $request->file('pharmacy_bills_file');
            $name = $pharmacy_bills_file->getClientOriginalName();
            $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'pharmacy_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('implant_sticker_invoice_file')) {
            $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
            $name = $implant_sticker_invoice_file->getClientOriginalName();
            $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'implant_sticker_invoice_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_break_up_bills_file')) {
            $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
            $name = $hospital_break_up_bills_file->getClientOriginalName();
            $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_break_up_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_main_final_bill_file')) {
            $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
            $name = $hospital_main_final_bill_file->getClientOriginalName();
            $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_main_final_bill_file' =>  $name
            ]);
        }


        if ($request->hasfile('discharge_or_day_care_summary_file')) {
            $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
            $name = $discharge_or_day_care_summary_file->getClientOriginalName();
            $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'discharge_or_day_care_summary_file' =>  $name
            ]);
        }

        if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
            $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
            $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
            $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'death_summary_from_hospital_where_applicable_file' =>  $name
            ]);
        }

        if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
            $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
            $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
            $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'payment_receipts_of_the_hospital_file' =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file = $request->file('other_documents_file');
            $name = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_pan_card_file')) {
            $claimant_pan_card_file = $request->file('claimant_pan_card_file');
            $name = $claimant_pan_card_file->getClientOriginalName();
            $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_aadhar_card_file')) {
            $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
            $name = $claimant_aadhar_card_file->getClientOriginalName();
            $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_current_address_proof_file')) {
            $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
            $name = $claimant_current_address_proof_file->getClientOriginalName();
            $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_cancel_cheque_file')) {
            $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
            $name = $claimant_cancel_cheque_file->getClientOriginalName();
            $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_cancel_cheque_file' =>  $name
            ]);
        }


        if ($request->hasfile('abha_id_proof_file')) {
            $abha_id_proof_file = $request->file('abha_id_proof_file');
            $name = $abha_id_proof_file->getClientOriginalName();
            $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'abha_id_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
            $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
            $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
            $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'mlc_report_and_police_fir_document_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_current_address_proof_file')) {
            $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
            $name = $borrower_current_address_proof_file->getClientOriginalName();
            $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_current_address_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_card_file')) {
            $borrower_pan_card_file = $request->file('borrower_pan_card_file');
            $name = $borrower_pan_card_file->getClientOriginalName();
            $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_aadhar_card_file')) {
            $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
            $name = $borrower_aadhar_card_file->getClientOriginalName();
            $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_bank_statement_3_months_file')) {
            $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
            $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
            $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_bank_statement_3_months_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_itr_income_tax_return_file')) {
            $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
            $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
            $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
            $name = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_other_documents_file')) {
            $borrower_other_documents_file = $request->file('borrower_other_documents_file');
            $name = $borrower_other_documents_file->getClientOriginalName();
            $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_current_address_proof_file')) {
            $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
            $name = $co_borrower_current_address_proof_file->getClientOriginalName();
            $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_pan_card_file')) {
            $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
            $name = $co_borrower_pan_card_file->getClientOriginalName();
            $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_pan_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_aadhar_card_file')) {
            $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
            $name = $co_borrower_aadhar_card_file->getClientOriginalName();
            $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_aadhar_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
            $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
            $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
            $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_bank_statement_3_months_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
            $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
            $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
            $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_cancel_cheque_file')) {
            $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
            $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
            $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
            $name = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_other_documents_file' =>  $name
            ]);
        }

        $rules = [
            'patient_id' => empty($reimbursementdocument->patient_id) ? 'required' : [],
            'patient_title' => empty($reimbursementdocument->patient_title) ? 'required' : [],
            'patient_firstname' => empty($reimbursementdocument->patient_firstname) ? 'required' : [],
            'patient_middlename' => empty($reimbursementdocument->patient_middlename) ? 'required' : [],
            'patient_lastname' => empty($reimbursementdocument->patient_lastname) ? 'required' : [],
            'patient_id_proof_file' => empty($reimbursementdocument->patient_id_proof_file) ? 'required' : [],
            'doctor_prescriptions_or_consultation_papers_file' => empty($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
            'insurance_policy_copy_file' => empty($reimbursementdocument->insurance_policy_copy_file) ? 'required' : [],
            'tpa_card_file' => empty($reimbursementdocument->tpa_card_file) ? 'required' : [],
            'employee_or_member_id_group_file' => empty($reimbursementdocument->employee_or_member_id_group_file) ? 'required' : [],
            'photograph_of_the_patient_file' => empty($reimbursementdocument->photograph_of_the_patient_file) ? 'required' : [],
            // 'indoor_care_paper_file' => empty($reimbursementdocument->indoor_care_paper_file) ? 'required' : [],
            // 'ecg_report_file' => empty($reimbursementdocument->ecg_report_file) ? 'required' : [],
            // 'ct_mri_usg_hpe_investigation_report_file' => empty($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) ? 'required' : [],
            'diagnostic_or_investigation_reports_file' => empty($reimbursementdocument->diagnostic_or_investigation_reports_file) ? 'required' : [],
            // 'doctor’s_reference_slip_for_investigation_file' => empty($reimbursementdocument->doctor’s_reference_slip_for_investigation_file) ? 'required' : [],
            // 'operation_theatre_notes_file' => empty($reimbursementdocument->operation_theatre_notes_file) ? 'required' : [],
            'pharmacy_bills_file' => empty($reimbursementdocument->pharmacy_bills_file) ? 'required' : [],
            // 'implant_sticker_invoice_file' => empty($reimbursementdocument->implant_sticker_invoice_file) ? 'required' : [],
            'hospital_break_up_bills_file' => empty($reimbursementdocument->hospital_break_up_bills_file) ? 'required' : [],
            'hospital_main_final_bill_file' => empty($reimbursementdocument->hospital_main_final_bill_file) ? 'required' : [],
            'discharge_or_day_care_summary_file' => empty($reimbursementdocument->discharge_or_day_care_summary_file) ? 'required' : [],
            // 'death_summary_from_hospital_where_applicable_file' => empty($reimbursementdocument->death_summary_from_hospital_where_applicable_file) ? 'required' : [],
            'payment_receipts_of_the_hospital_file' => empty($reimbursementdocument->payment_receipts_of_the_hospital_file) ? 'required' : [],
            // 'other_documents_file' => empty($reimbursementdocument->other_documents_file) ? 'required' : [],
            'claimant_pan_card_file' => empty($reimbursementdocument->claimant_pan_card_file) ? 'required' : [],
            'claimant_aadhar_card_file' => empty($reimbursementdocument->claimant_aadhar_card_file) ? 'required' : [],
            'claimant_current_address_proof_file' => empty($reimbursementdocument->claimant_current_address_proof_file) ? 'required' : [],
            'claimant_cancel_cheque_file' => empty($reimbursementdocument->claimant_cancel_cheque_file) ? 'required' : [],
            // 'abha_id_proof_file' => empty($reimbursementdocument->abha_id_proof_file) ? 'required' : [],
            // 'mlc_report_and_police_fir_document_file' => empty($reimbursementdocument->mlc_report_and_police_fir_document_file) ? 'required' : [],
            'borrower_current_address_proof_file' => empty($reimbursementdocument->borrower_current_address_proof_file) ? 'required' : [],
            'borrower_pan_card_file' => empty($reimbursementdocument->borrower_pan_card_file) ? 'required' : [],
            'borrower_aadhar_card_file' => empty($reimbursementdocument->borrower_aadhar_card_file) ? 'required' : [],
            'borrower_bank_statement_3_months_file' => empty($reimbursementdocument->borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'borrower_itr_income_tax_return_file' => empty($reimbursementdocument->borrower_itr_income_tax_return_file) ? 'required' : [],
            'borrower_cancel_cheque_file' => empty($reimbursementdocument->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_other_documents_file' => empty($reimbursementdocument->borrower_other_documents_file) ? 'required' : [],
            'co_borrower_current_address_proof_file' => empty($reimbursementdocument->co_borrower_current_address_proof_file) ? 'required' : [],
            'co_borrower_pan_card_file' => empty($reimbursementdocument->co_borrower_pan_card_file) ? 'required' : [],
            'co_borrower_aadhar_card_file' => empty($reimbursementdocument->co_borrower_aadhar_card_file) ? 'required' : [],
            'co_borrower_bank_statement_3_months_file' => empty($reimbursementdocument->co_borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'co_borrower_itr_income_tax_return_file' => empty($reimbursementdocument->co_borrower_itr_income_tax_return_file) ? 'required' : [],
            'co_borrower_cancel_cheque_file' => empty($reimbursementdocument->co_borrower_cancel_cheque_file) ? 'required' : [],
            'co_borrower_other_documents_file' => empty($reimbursementdocument->co_borrower_other_documents_file) ? 'required' : [],

        ];

        $messages = [
            'patient_id.required' => 'Please select Patient Id',
            'patient_title.required' => 'Please select Patient Title',
            'patient_firstname.required' => 'Please select Patient Firstname',
            'patient_middlename.required' => 'Please select Patient Middlename',
            'patient_lastname.required' => 'Please select Patient Lastname',
            'patient_id_proof_file.required' => 'Please select Patient Id Proof File',
            'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
            'insurance_policy_copy_file.required' => 'Please select Insurance Policy Copy File',
            'tpa_card_file.required' => 'Please select Tpa Card File',
            'employee_or_member_id_group_file.required' => 'Please select Employee Or Member Id Group File',
            'photograph_of_the_patient_file.required' => 'Please select Photograph Of The Patient File',
            'indoor_care_paper_file.required' => 'Please select Indoor Care Paper File',
            'ecg_report_file.required' => 'Please select Ecg Report File',
            'ct_mri_usg_hpe_investigation_report_file.required' => 'Please select Ct Mri Usg Hpe Investigation Report File',
            'diagnostic_or_investigation_reports_file.required' => 'Please select Diagnostic Or Investigation Reports File',
            'doctor’s_reference_slip_for_investigation_file.required' => 'Please select Doctor’s Reference Slip For Investigation File',
            'operation_theatre_notes_file.required' => 'Please select Operation Theatre Notes File',
            'pharmacy_bills_file.required' => 'Please select Pharmacy Bills File',
            'implant_sticker_invoice_file.required' => 'Please select Implant Sticker Invoice File',
            'hospital_break_up_bills_file.required' => 'Please select Hospital Break Up Bills File',
            'hospital_main_final_bill_file.required' => 'Please select Hospital Main Final Bill File',
            'discharge_or_day_care_summary_file.required' => 'Please select Discharge Or Day Care Summary File',
            'death_summary_from_hospital_where_applicable_file.required' => 'Please select Death Summary From Hospital Where Applicable File',
            'payment_receipts_of_the_hospital_file.required' => 'Please select Payment Receipts Of The Hospital File',
            'other_documents_file.required' => 'Please select Other Documents File',
            'claimant_pan_card_file.required' => 'Please select Claimant Pan Card File',
            'claimant_aadhar_card_file.required' => 'Please select Claimant Aadhar Card File',
            'claimant_current_address_proof_file.required' => 'Please select Claimant Current Address Proof File',
            'claimant_cancel_cheque_file.required' => 'Please select Claimant Cancel Cheque File',
            'abha_id_proof_file.required' => 'Please select Abha Id Proof File',
            'mlc_report_and_police_fir_document_file.required' => 'Please select Mlc Report And Police Fir Document File',
            'borrower_current_address_proof_file.required' => 'Please select Borrower Current Address Proof File',
            'borrower_pan_card_file.required' => 'Please select Borrower Pan Card File',
            'borrower_aadhar_card_file.required' => 'Please select Borrower Aadhar Card File',
            'borrower_bank_statement_3_months_file.required' => 'Please select Borrower Bank Statement 3 Months File',
            'borrower_itr_income_tax_return_file.required' => 'Please select Borrower Itr Income Tax Return File',
            'borrower_cancel_cheque_file.required' => 'Please select Borrower Cancel Cheque File',
            'borrower_other_documents_file.required' => 'Please select Borrower Other Documents File',
            'co_borrower_current_address_proof_file.required' => 'Please select Co Borrower Current Address Proof File',
            'co_borrower_pan_card_file.required' => 'Please select Co Borrower Pan Card File',
            'co_borrower_aadhar_card_file.required' => 'Please select Co Borrower Aadhar Card File',
            'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',
            'co_borrower_itr_income_tax_return_file.required' => 'Please select Co Borrower Itr Income Tax Return File',
            'co_borrower_cancel_cheque_file.required' => 'Please select Co Borrower Cancel Cheque File',
            'co_borrower_other_documents_file.required' => 'Please select Co Borrower Other Documents File',

        ];

        $this->validateWithBag('medical-loan-form', $request, $rules, $messages);

       $reimbursementdocument =  ReimbursementDocument::where('patient_id', 'P-10001')->update($request->except('_token','patient_id'));

        return redirect()->back()->with('success', 'Patient added successfully');

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals'));
    }


    public function saveDocumentsReimbursement4(Request $request, $id)
    {
        $claimant = Claimant::find($id);

        $exists = ReimbursementDocument::where('patient_id', $claimant->patient_id)->exists();

        if (!$exists) {
           ReimbursementDocument::create(['patient_id' => $claimant->patient_id]);
       }

       $reimbursementdocument = ReimbursementDocument::where('patient_id', $claimant->patient_id)->first();

       $id = $reimbursementdocument->id;

        if ($request->hasfile('patient_id_proof_file')) {
            $patient_id_proof_file = $request->file('patient_id_proof_file');
            $name = $patient_id_proof_file->getClientOriginalName();
            $patient_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'patient_id_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor_prescriptions_or_consultation_papers_file')) {
            $doctor_prescriptions_or_consultation_papers_file = $request->file('doctor_prescriptions_or_consultation_papers_file');
            $name = $doctor_prescriptions_or_consultation_papers_file->getClientOriginalName();
            $doctor_prescriptions_or_consultation_papers_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor_prescriptions_or_consultation_papers_file' =>  $name
            ]);
        }

        if ($request->hasfile('insurance_policy_copy_file')) {
            $insurance_policy_copy_file = $request->file('insurance_policy_copy_file');
            $name = $insurance_policy_copy_file->getClientOriginalName();
            $insurance_policy_copy_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'insurance_policy_copy_file' =>  $name
            ]);
        }


        if ($request->hasfile('tpa_card_file')) {
            $tpa_card_file = $request->file('tpa_card_file');
            $name = $tpa_card_file->getClientOriginalName();
            $tpa_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'tpa_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('employee_or_member_id_group_file')) {
            $employee_or_member_id_group_file = $request->file('employee_or_member_id_group_file');
            $name = $employee_or_member_id_group_file->getClientOriginalName();
            $employee_or_member_id_group_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'employee_or_member_id_group_file' =>  $name
            ]);
        }


        if ($request->hasfile('photograph_of_the_patient_file')) {
            $photograph_of_the_patient_file = $request->file('photograph_of_the_patient_file');
            $name = $photograph_of_the_patient_file->getClientOriginalName();
            $photograph_of_the_patient_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'photograph_of_the_patient_file' =>  $name
            ]);
        }


        if ($request->hasfile('indoor_care_paper_file')) {
            $indoor_care_paper_file = $request->file('indoor_care_paper_file');
            $name = $indoor_care_paper_file->getClientOriginalName();
            $indoor_care_paper_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'indoor_care_paper_file' =>  $name
            ]);
        }

        if ($request->hasfile('ecg_report_file')) {
            $ecg_report_file = $request->file('ecg_report_fileile');
            $name = $ecg_report_file->getClientOriginalName();
            $ecg_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ecg_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('ct_mri_usg_hpe_investigation_report_file')) {
            $ct_mri_usg_hpe_investigation_report_file = $request->file('ct_mri_usg_hpe_investigation_report_file');
            $name = $ct_mri_usg_hpe_investigation_report_file->getClientOriginalName();
            $ct_mri_usg_hpe_investigation_report_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'ct_mri_usg_hpe_investigation_report_file' =>  $name
            ]);
        }

        if ($request->hasfile('diagnostic_or_investigation_reports_file')) {
            $diagnostic_or_investigation_reports_file = $request->file('diagnostic_or_investigation_reports_file');
            $name = $diagnostic_or_investigation_reports_file->getClientOriginalName();
            $diagnostic_or_investigation_reports_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'diagnostic_or_investigation_reports_file' =>  $name
            ]);
        }

        if ($request->hasfile('doctor’s_reference_slip_for_investigation_file')) {
            $doctor’s_reference_slip_for_investigation_file = $request->file('doctor’s_reference_slip_for_investigation_file');
            $name = $doctor’s_reference_slip_for_investigation_file->getClientOriginalName();
            $doctor’s_reference_slip_for_investigation_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'doctor’s_reference_slip_for_investigation_file' =>  $name
            ]);
        }

        if ($request->hasfile('operation_theatre_notes_file')) {
            $operation_theatre_notes_file = $request->file('operation_theatre_notes_file');
            $name = $operation_theatre_notes_file->getClientOriginalName();
            $operation_theatre_notes_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'operation_theatre_notes_file' =>  $name
            ]);
        }

        if ($request->hasfile('pharmacy_bills_file')) {
            $pharmacy_bills_file = $request->file('pharmacy_bills_file');
            $name = $pharmacy_bills_file->getClientOriginalName();
            $pharmacy_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'pharmacy_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('implant_sticker_invoice_file')) {
            $implant_sticker_invoice_file = $request->file('implant_sticker_invoice_file');
            $name = $implant_sticker_invoice_file->getClientOriginalName();
            $implant_sticker_invoice_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'implant_sticker_invoice_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_break_up_bills_file')) {
            $hospital_break_up_bills_file = $request->file('hospital_break_up_bills_file');
            $name = $hospital_break_up_bills_file->getClientOriginalName();
            $hospital_break_up_bills_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_break_up_bills_file' =>  $name
            ]);
        }


        if ($request->hasfile('hospital_main_final_bill_file')) {
            $hospital_main_final_bill_file = $request->file('hospital_main_final_bill_file');
            $name = $hospital_main_final_bill_file->getClientOriginalName();
            $hospital_main_final_bill_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'hospital_main_final_bill_file' =>  $name
            ]);
        }


        if ($request->hasfile('discharge_or_day_care_summary_file')) {
            $discharge_or_day_care_summary_file = $request->file('discharge_or_day_care_summary_file');
            $name = $discharge_or_day_care_summary_file->getClientOriginalName();
            $discharge_or_day_care_summary_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'discharge_or_day_care_summary_file' =>  $name
            ]);
        }

        if ($request->hasfile('death_summary_from_hospital_where_applicable_file')) {
            $death_summary_from_hospital_where_applicable_file = $request->file('death_summary_from_hospital_where_applicable_file');
            $name = $death_summary_from_hospital_where_applicable_file->getClientOriginalName();
            $death_summary_from_hospital_where_applicable_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'death_summary_from_hospital_where_applicable_file' =>  $name
            ]);
        }

        if ($request->hasfile('payment_receipts_of_the_hospital_file')) {
            $payment_receipts_of_the_hospital_file = $request->file('payment_receipts_of_the_hospital_file');
            $name = $payment_receipts_of_the_hospital_file->getClientOriginalName();
            $payment_receipts_of_the_hospital_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'payment_receipts_of_the_hospital_file' =>  $name
            ]);
        }

        if ($request->hasfile('other_documents_file')) {
            $other_documents_file = $request->file('other_documents_file');
            $name = $other_documents_file->getClientOriginalName();
            $other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_pan_card_file')) {
            $claimant_pan_card_file = $request->file('claimant_pan_card_file');
            $name = $claimant_pan_card_file->getClientOriginalName();
            $claimant_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_aadhar_card_file')) {
            $claimant_aadhar_card_file = $request->file('claimant_aadhar_card_file');
            $name = $claimant_aadhar_card_file->getClientOriginalName();
            $claimant_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('claimant_current_address_proof_file')) {
            $claimant_current_address_proof_file = $request->file('claimant_current_address_proof_file');
            $name = $claimant_current_address_proof_file->getClientOriginalName();
            $claimant_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('claimant_cancel_cheque_file')) {
            $claimant_cancel_cheque_file = $request->file('claimant_cancel_cheque_file');
            $name = $claimant_cancel_cheque_file->getClientOriginalName();
            $claimant_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'claimant_cancel_cheque_file' =>  $name
            ]);
        }


        if ($request->hasfile('abha_id_proof_file')) {
            $abha_id_proof_file = $request->file('abha_id_proof_file');
            $name = $abha_id_proof_file->getClientOriginalName();
            $abha_id_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'abha_id_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('mlc_report_and_police_fir_document_file')) {
            $mlc_report_and_police_fir_document_file = $request->file('mlc_report_and_police_fir_document_file');
            $name = $mlc_report_and_police_fir_document_file->getClientOriginalName();
            $mlc_report_and_police_fir_document_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'mlc_report_and_police_fir_document_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_current_address_proof_file')) {
            $borrower_current_address_proof_file = $request->file('borrower_current_address_proof_file');
            $name = $borrower_current_address_proof_file->getClientOriginalName();
            $borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_current_address_proof_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_pan_card_file')) {
            $borrower_pan_card_file = $request->file('borrower_pan_card_file');
            $name = $borrower_pan_card_file->getClientOriginalName();
            $borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_pan_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_aadhar_card_file')) {
            $borrower_aadhar_card_file = $request->file('borrower_aadhar_card_file');
            $name = $borrower_aadhar_card_file->getClientOriginalName();
            $borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_aadhar_card_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_bank_statement_3_months_file')) {
            $borrower_bank_statement_3_months_file = $request->file('borrower_bank_statement_3_months_file');
            $name = $borrower_bank_statement_3_months_file->getClientOriginalName();
            $borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_bank_statement_3_months_file' =>  $name
            ]);
        }


        if ($request->hasfile('borrower_itr_income_tax_return_file')) {
            $borrower_itr_income_tax_return_file = $request->file('borrower_itr_income_tax_return_file');
            $name = $borrower_itr_income_tax_return_file->getClientOriginalName();
            $borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_cancel_cheque_file')) {
            $borrower_cancel_cheque_file = $request->file('borrower_cancel_cheque_file');
            $name = $borrower_cancel_cheque_file->getClientOriginalName();
            $borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('borrower_other_documents_file')) {
            $borrower_other_documents_file = $request->file('borrower_other_documents_file');
            $name = $borrower_other_documents_file->getClientOriginalName();
            $borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'borrower_other_documents_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_current_address_proof_file')) {
            $co_borrower_current_address_proof_file = $request->file('co_borrower_current_address_proof_file');
            $name = $co_borrower_current_address_proof_file->getClientOriginalName();
            $co_borrower_current_address_proof_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_current_address_proof_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_pan_card_file')) {
            $co_borrower_pan_card_file = $request->file('co_borrower_pan_card_file');
            $name = $co_borrower_pan_card_file->getClientOriginalName();
            $co_borrower_pan_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_pan_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_aadhar_card_file')) {
            $co_borrower_aadhar_card_file = $request->file('co_borrower_aadhar_card_file');
            $name = $co_borrower_aadhar_card_file->getClientOriginalName();
            $co_borrower_aadhar_card_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_aadhar_card_file' =>  $name
            ]);
        }


        if ($request->hasfile('co_borrower_bank_statement_3_months_file')) {
            $co_borrower_bank_statement_3_months_file = $request->file('co_borrower_bank_statement_3_months_file');
            $name = $co_borrower_bank_statement_3_months_file->getClientOriginalName();
            $co_borrower_bank_statement_3_months_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_bank_statement_3_months_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_itr_income_tax_return_file')) {
            $co_borrower_itr_income_tax_return_file = $request->file('co_borrower_itr_income_tax_return_file');
            $name = $co_borrower_itr_income_tax_return_file->getClientOriginalName();
            $co_borrower_itr_income_tax_return_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_itr_income_tax_return_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_cancel_cheque_file')) {
            $co_borrower_cancel_cheque_file = $request->file('co_borrower_cancel_cheque_file');
            $name = $co_borrower_cancel_cheque_file->getClientOriginalName();
            $co_borrower_cancel_cheque_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_cancel_cheque_file' =>  $name
            ]);
        }

        if ($request->hasfile('co_borrower_other_documents_file')) {
            $co_borrower_other_documents_file = $request->file('co_borrower_other_documents_file');
            $name = $co_borrower_other_documents_file->getClientOriginalName();
            $co_borrower_other_documents_file->storeAs('uploads/reimbursement/documents/' . $id . '/', $name, 'public');
            ReimbursementDocument::where('id', $id)->update([
                'co_borrower_other_documents_file' =>  $name
            ]);
        }

        $rules = [
            'patient_id' => empty($reimbursementdocument->patient_id) ? 'required' : [],
            'patient_title' => empty($reimbursementdocument->patient_title) ? 'required' : [],
            'patient_firstname' => empty($reimbursementdocument->patient_firstname) ? 'required' : [],
            'patient_middlename' => empty($reimbursementdocument->patient_middlename) ? 'required' : [],
            'patient_lastname' => empty($reimbursementdocument->patient_lastname) ? 'required' : [],
            'patient_id_proof_file' => empty($reimbursementdocument->patient_id_proof_file) ? 'required' : [],
            'doctor_prescriptions_or_consultation_papers_file' => empty($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) ? 'required'  : [],
            'insurance_policy_copy_file' => empty($reimbursementdocument->insurance_policy_copy_file) ? 'required' : [],
            'tpa_card_file' => empty($reimbursementdocument->tpa_card_file) ? 'required' : [],
            'employee_or_member_id_group_file' => empty($reimbursementdocument->employee_or_member_id_group_file) ? 'required' : [],
            'photograph_of_the_patient_file' => empty($reimbursementdocument->photograph_of_the_patient_file) ? 'required' : [],
            // 'indoor_care_paper_file' => empty($reimbursementdocument->indoor_care_paper_file) ? 'required' : [],
            // 'ecg_report_file' => empty($reimbursementdocument->ecg_report_file) ? 'required' : [],
            // 'ct_mri_usg_hpe_investigation_report_file' => empty($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) ? 'required' : [],
            'diagnostic_or_investigation_reports_file' => empty($reimbursementdocument->diagnostic_or_investigation_reports_file) ? 'required' : [],
            // 'doctor’s_reference_slip_for_investigation_file' => empty($reimbursementdocument->doctor’s_reference_slip_for_investigation_file) ? 'required' : [],
            // 'operation_theatre_notes_file' => empty($reimbursementdocument->operation_theatre_notes_file) ? 'required' : [],
            'pharmacy_bills_file' => empty($reimbursementdocument->pharmacy_bills_file) ? 'required' : [],
            // 'implant_sticker_invoice_file' => empty($reimbursementdocument->implant_sticker_invoice_file) ? 'required' : [],
            'hospital_break_up_bills_file' => empty($reimbursementdocument->hospital_break_up_bills_file) ? 'required' : [],
            'hospital_main_final_bill_file' => empty($reimbursementdocument->hospital_main_final_bill_file) ? 'required' : [],
            'discharge_or_day_care_summary_file' => empty($reimbursementdocument->discharge_or_day_care_summary_file) ? 'required' : [],
            // 'death_summary_from_hospital_where_applicable_file' => empty($reimbursementdocument->death_summary_from_hospital_where_applicable_file) ? 'required' : [],
            'payment_receipts_of_the_hospital_file' => empty($reimbursementdocument->payment_receipts_of_the_hospital_file) ? 'required' : [],
            // 'other_documents_file' => empty($reimbursementdocument->other_documents_file) ? 'required' : [],
            'claimant_pan_card_file' => empty($reimbursementdocument->claimant_pan_card_file) ? 'required' : [],
            'claimant_aadhar_card_file' => empty($reimbursementdocument->claimant_aadhar_card_file) ? 'required' : [],
            'claimant_current_address_proof_file' => empty($reimbursementdocument->claimant_current_address_proof_file) ? 'required' : [],
            'claimant_cancel_cheque_file' => empty($reimbursementdocument->claimant_cancel_cheque_file) ? 'required' : [],
            // 'abha_id_proof_file' => empty($reimbursementdocument->abha_id_proof_file) ? 'required' : [],
            // 'mlc_report_and_police_fir_document_file' => empty($reimbursementdocument->mlc_report_and_police_fir_document_file) ? 'required' : [],
            'borrower_current_address_proof_file' => empty($reimbursementdocument->borrower_current_address_proof_file) ? 'required' : [],
            'borrower_pan_card_file' => empty($reimbursementdocument->borrower_pan_card_file) ? 'required' : [],
            'borrower_aadhar_card_file' => empty($reimbursementdocument->borrower_aadhar_card_file) ? 'required' : [],
            'borrower_bank_statement_3_months_file' => empty($reimbursementdocument->borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'borrower_itr_income_tax_return_file' => empty($reimbursementdocument->borrower_itr_income_tax_return_file) ? 'required' : [],
            'borrower_cancel_cheque_file' => empty($reimbursementdocument->borrower_cancel_cheque_file) ? 'required' : [],
            'borrower_other_documents_file' => empty($reimbursementdocument->borrower_other_documents_file) ? 'required' : [],
            'co_borrower_current_address_proof_file' => empty($reimbursementdocument->co_borrower_current_address_proof_file) ? 'required' : [],
            'co_borrower_pan_card_file' => empty($reimbursementdocument->co_borrower_pan_card_file) ? 'required' : [],
            'co_borrower_aadhar_card_file' => empty($reimbursementdocument->co_borrower_aadhar_card_file) ? 'required' : [],
            'co_borrower_bank_statement_3_months_file' => empty($reimbursementdocument->co_borrower_bank_statement_3_months_file) ? 'required' : [],
            // 'co_borrower_itr_income_tax_return_file' => empty($reimbursementdocument->co_borrower_itr_income_tax_return_file) ? 'required' : [],
            'co_borrower_cancel_cheque_file' => empty($reimbursementdocument->co_borrower_cancel_cheque_file) ? 'required' : [],
            'co_borrower_other_documents_file' => empty($reimbursementdocument->co_borrower_other_documents_file) ? 'required' : [],

        ];

        $messages = [
            'patient_id.required' => 'Please select Patient Id',
            'patient_title.required' => 'Please select Patient Title',
            'patient_firstname.required' => 'Please select Patient Firstname',
            'patient_middlename.required' => 'Please select Patient Middlename',
            'patient_lastname.required' => 'Please select Patient Lastname',
            'patient_id_proof_file.required' => 'Please select Patient Id Proof File',
            'doctor_prescriptions_or_consultation_papers_file.required' => 'Please select Doctor Prescriptions Or Consultation Papers File',
            'insurance_policy_copy_file.required' => 'Please select Insurance Policy Copy File',
            'tpa_card_file.required' => 'Please select Tpa Card File',
            'employee_or_member_id_group_file.required' => 'Please select Employee Or Member Id Group File',
            'photograph_of_the_patient_file.required' => 'Please select Photograph Of The Patient File',
            'indoor_care_paper_file.required' => 'Please select Indoor Care Paper File',
            'ecg_report_file.required' => 'Please select Ecg Report File',
            'ct_mri_usg_hpe_investigation_report_file.required' => 'Please select Ct Mri Usg Hpe Investigation Report File',
            'diagnostic_or_investigation_reports_file.required' => 'Please select Diagnostic Or Investigation Reports File',
            'doctor’s_reference_slip_for_investigation_file.required' => 'Please select Doctor’s Reference Slip For Investigation File',
            'operation_theatre_notes_file.required' => 'Please select Operation Theatre Notes File',
            'pharmacy_bills_file.required' => 'Please select Pharmacy Bills File',
            'implant_sticker_invoice_file.required' => 'Please select Implant Sticker Invoice File',
            'hospital_break_up_bills_file.required' => 'Please select Hospital Break Up Bills File',
            'hospital_main_final_bill_file.required' => 'Please select Hospital Main Final Bill File',
            'discharge_or_day_care_summary_file.required' => 'Please select Discharge Or Day Care Summary File',
            'death_summary_from_hospital_where_applicable_file.required' => 'Please select Death Summary From Hospital Where Applicable File',
            'payment_receipts_of_the_hospital_file.required' => 'Please select Payment Receipts Of The Hospital File',
            'other_documents_file.required' => 'Please select Other Documents File',
            'claimant_pan_card_file.required' => 'Please select Claimant Pan Card File',
            'claimant_aadhar_card_file.required' => 'Please select Claimant Aadhar Card File',
            'claimant_current_address_proof_file.required' => 'Please select Claimant Current Address Proof File',
            'claimant_cancel_cheque_file.required' => 'Please select Claimant Cancel Cheque File',
            'abha_id_proof_file.required' => 'Please select Abha Id Proof File',
            'mlc_report_and_police_fir_document_file.required' => 'Please select Mlc Report And Police Fir Document File',
            'borrower_current_address_proof_file.required' => 'Please select Borrower Current Address Proof File',
            'borrower_pan_card_file.required' => 'Please select Borrower Pan Card File',
            'borrower_aadhar_card_file.required' => 'Please select Borrower Aadhar Card File',
            'borrower_bank_statement_3_months_file.required' => 'Please select Borrower Bank Statement 3 Months File',
            'borrower_itr_income_tax_return_file.required' => 'Please select Borrower Itr Income Tax Return File',
            'borrower_cancel_cheque_file.required' => 'Please select Borrower Cancel Cheque File',
            'borrower_other_documents_file.required' => 'Please select Borrower Other Documents File',
            'co_borrower_current_address_proof_file.required' => 'Please select Co Borrower Current Address Proof File',
            'co_borrower_pan_card_file.required' => 'Please select Co Borrower Pan Card File',
            'co_borrower_aadhar_card_file.required' => 'Please select Co Borrower Aadhar Card File',
            'co_borrower_bank_statement_3_months_file.required' => 'Please select Co Borrower Bank Statement 3 Months File',
            'co_borrower_itr_income_tax_return_file.required' => 'Please select Co Borrower Itr Income Tax Return File',
            'co_borrower_cancel_cheque_file.required' => 'Please select Co Borrower Cancel Cheque File',
            'co_borrower_other_documents_file.required' => 'Please select Co Borrower Other Documents File',

        ];

        $this->validateWithBag('borrower-loan-form', $request, $rules, $messages);

       $reimbursementdocument =  ReimbursementDocument::where('patient_id', 'P-10001')->update($request->except('_token','patient_id'));

        return redirect()->back()->with('success', 'Patient added successfully');

        return view('admin.claims.patients.documents-reimbursement',  compact('hospital_id', 'associates', 'hospitals'));
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
        $doctors = HospitalDepartment::get();
        foreach ($hospitals as $hospital) {
            if (isset($hospital->linked_associate_partner_id)) {
                $hospital->ap_name = AssociatePartner::where('associate_partner_id', $hospital->linked_associate_partner_id)->value('name');
            } else {
                $hospital->ap_name = 'N/A';
            }
        }


        return view('admin.claims.patients.create',  compact('hospital_id', 'doctors','associates', 'hospitals'));
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
            'treating_doctor'                   => 'required',
            'qualification'                     => 'required',
            'doctor_registration_no'            => 'required|max:20',
            'doctor_mobile_no'                  => 'required|numeric|digits:10',
            'title'                             => 'required',
            'firstname'                         => 'required|max:25',
            'lastname'                          => isset($request->lastname) ? 'max:25' : '',
            'middlename'                        => isset($request->middlename) ? 'max:25' : '',
            'dob'                               => 'required',
            'age'                               => 'required',
            'gender'                            => 'required',
            'occupation'                        => 'required',
            'specify'                           => $request->occupation == 'Other' ? 'required' : '',
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
            'dobfile.required'                   => 'Please upload Aadhar Card/PAN Card/Driving Licence/Passport',
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
            'treating_doctor'                   => $request->treating_doctor,
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

    public function edit(Request $request, $id)
    {
        $hospital_id = $request->hospital_id;
        $associates = AssociatePartner::get();
        $hospitals = Hospital::get();
        $doctors = HospitalDepartment::get();
        $reimbursementdocument = ReimbursementDocument::where('patient_id', $id)->first();
        foreach ($hospitals as $hospital) {
            if (isset($hospital->linked_associate_partner_id)) {
                $hospital->ap_name = AssociatePartner::where('associate_partner_id', $hospital->linked_associate_partner_id)->value('name');
            } else {
                $hospital->ap_name = 'N/A';
            }
        }

        $patient = Patient::with('hospital')->find($id);

        return view('admin.claims.patients.edit',  compact('patient', 'hospital_id', 'doctors', 'associates', 'hospitals', 'reimbursementdocument'));
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
        $patient = Patient::find($id);

        $rules = [
            'hospital_name'                     => 'required',
            'hospital_id'                       => 'required',
            'hospital_address'                  => 'required',
            'hospital_city'                     => 'required',
            'hospital_state'                    => 'required',
            'hospital_pincode'                  => 'required',
            'associate_partner_id'              => "required_if:$request->associate_partner_id,'!=',null",
            'registration_no'                   => 'required|max:20',
            'treating_doctor'                   => 'required',
            'qualification'                     => 'required',
            'doctor_registration_no'            => 'required|max:20',
            'doctor_mobile_no'                  => 'required|numeric|digits:10',
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
            'code'                              => 'required|numeric|digits:3',
            'landline'                          => 'required|numeric|digits_between:1,10',
            'email'                             => 'required|email|min:1|max:45|unique:patients,email,'.$id,
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
            'treating_doctor'                   => $request->treating_doctor,
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
