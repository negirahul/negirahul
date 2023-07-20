@extends('layouts.hospital')
@section('title', 'Create Associate Partners')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Claim Stack</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Documents</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body p-0" >
                        <div class="" style="background:#3E4097">
                            <div class="d-flex align-items-center mb-2" >
                                <div class="flex-shrink-0">
                                    <div class="avatar-md" style="margin-top: 10px;margin-left:20px ;">
                                        <span class="avatar-title bg-success  rounded-circle"style="background: white;">
                                            Claims
                                        </span>
                                    </div>

                                </div>
                                <div class="d-flex flex-row align-items-center m-2 text-white">
                                    <p class="mb-0 me-2"><br> Claims Documents</p>
                                </div>                        
                            </div>
                            <div class="col-12 nav nav-tabs custom-tab" id="myTab" style="font-size: 17px;" >
                                <a class="px-1 active" href="#tab1" c data-bs-toggle="tab">Pre-Assessment Documents</a>
                                <a class="px-1" href="#tab2" data-bs-toggle="tab">Final Assessment Documents</a>
                                <a class="px-1" href="#tab3" data-bs-toggle="tab">Insurance Claim Documents</a>
                                <a class="px-1" href="#tab6" data-bs-toggle="tab">Insurance Settlement Documents</a>
                                <a class="px-1" href="#tab4" data-bs-toggle="tab">Medical Loan (Borrower) Documents</a>
                                <a class="px-1" href="#tab5" data-bs-toggle="tab">Loan (Co-Borrower) Documents</a>
                                <a class="px-1" href="#tab7" data-bs-toggle="tab">Lending Status Documents</a>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab1">
                                        <table class="table">
                                            <tbody>

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->patient_id_proof_file) }}" >Patient ID Proof</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->patient_id_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['patient_id_proof_file']) && $document_files['patient_id_proof_file'])
                                                @foreach($document_files['patient_id_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Patient ID Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) }}" >Doctor Prescriptions / Consultation Papers</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['doctor_prescriptions_or_consultation_papers_file']) && $document_files['doctor_prescriptions_or_consultation_papers_file'])
                                                @foreach($document_files['doctor_prescriptions_or_consultation_papers_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Doctor Prescriptions / Consultation Papers{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_policy_copy_file) }}" >Insurance Policy Copy</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_policy_copy_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['insurance_policy_copy_file']) && $document_files['insurance_policy_copy_file'])
                                                @foreach($document_files['insurance_policy_copy_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Insurance Policy Copy{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif    
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->tpa_card_file) }}" >TPA Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->tpa_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['tpa_card_file']) && $document_files['tpa_card_file'])
                                                @foreach($document_files['tpa_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">TPA Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->employee_or_member_id_group_file) }}" >Employee / Member ID (Group)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->employee_or_member_id_group_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['employee_or_member_id_group_file']) && $document_files['employee_or_member_id_group_file'])
                                                @foreach($document_files['employee_or_member_id_group_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Employee / Member ID (Group){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif
                                                
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->photograph_of_the_patient_file) }}" >Photograph of the Patient</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->photograph_of_the_patient_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['photograph_of_the_patient_file']) && $document_files['photograph_of_the_patient_file'])
                                                @foreach($document_files['photograph_of_the_patient_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Photograph of the Patient{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claim_intimation_documents) }}" >Claim Intimation Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claim_intimation_documents) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claim_intimation_documents']) && $document_files['claim_intimation_documents'])
                                                @foreach($document_files['claim_intimation_documents'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Claim Intimation Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->bhc_assessment_formsi_and_ii_signed_stamped_file) }}" >BHC Assessment Forms - I & II (Signed & Stamped)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->bhc_assessment_formsi_and_ii_signed_stamped_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['bhc_assessment_formsi_and_ii_signed_stamped_file']) && $document_files['bhc_assessment_formsi_and_ii_signed_stamped_file'])
                                                @foreach($document_files['bhc_assessment_formsi_and_ii_signed_stamped_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">BHC Assessment Forms - I & II (Signed & Stamped){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claim_other_documents_file) }}" >Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claim_other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claim_other_documents_file']) && $document_files['claim_other_documents_file'])
                                                @foreach($document_files['claim_other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif
                                        

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tab2">
                                        <table class="table">
                                            <tbody>
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->indoor_care_paper_file) }}" >Indoor Care Paper</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->indoor_care_paper_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['indoor_care_paper_file']) && $document_files['indoor_care_paper_file'])
                                                @foreach($document_files['indoor_care_paper_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Indoor Care Paper{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ecg_report_file) }}" >ECG Report</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ecg_report_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ecg_report_file']) && $document_files['ecg_report_file'])
                                                @foreach($document_files['ecg_report_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">ECG Report{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) }}" >CT/MRI/USG/HPE investigation Report</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ct_mri_usg_hpe_investigation_report_file']) && $document_files['ct_mri_usg_hpe_investigation_report_file'])
                                                @foreach($document_files['ct_mri_usg_hpe_investigation_report_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">CT/MRI/USG/HPE investigation Report{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->diagnostic_or_investigation_reports_file) }}" >Diagnostic / Investigation Reports</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->diagnostic_or_investigation_reports_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['diagnostic_or_investigation_reports_file']) && $document_files['diagnostic_or_investigation_reports_file'])
                                                @foreach($document_files['diagnostic_or_investigation_reports_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Diagnostic / Investigation Reports{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor’s_reference_slip_for_investigation_file) }}" >Doctor’s reference slip for Investigation</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor’s_reference_slip_for_investigation_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['doctor’s_reference_slip_for_investigation_file']) && $document_files['doctor’s_reference_slip_for_investigation_file'])
                                                @foreach($document_files['doctor’s_reference_slip_for_investigation_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Doctor’s reference slip for Investigation{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->operation_theatre_notes_file) }}" >Operation Theatre Notes</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->operation_theatre_notes_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['operation_theatre_notes_file']) && $document_files['operation_theatre_notes_file'])
                                                @foreach($document_files['operation_theatre_notes_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Operation Theatre Notes{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->pharmacy_bills_file) }}" >Pharmacy Bills</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->pharmacy_bills_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['pharmacy_bills_file']) && $document_files['pharmacy_bills_file'])
                                                @foreach($document_files['pharmacy_bills_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Pharmacy Bills{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->implant_sticker_invoice_file) }}" >Implant Sticker Invoice</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->implant_sticker_invoice_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['implant_sticker_invoice_file']) && $document_files['implant_sticker_invoice_file'])
                                                @foreach($document_files['implant_sticker_invoice_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Implant Sticker Invoice{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_break_up_bills_file) }}" >Hospital Break-up Bills</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_break_up_bills_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_break_up_bills_file']) && $document_files['hospital_break_up_bills_file'])
                                                @foreach($document_files['hospital_break_up_bills_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Hospital Break-up Bills{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_main_final_bill_file) }}" >Hospital (Main) Final Bill</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_main_final_bill_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_main_final_bill_file']) && $document_files['hospital_main_final_bill_file'])
                                                @foreach($document_files['hospital_main_final_bill_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Hospital (Main) Final Bill{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->discharge_or_day_care_summary_file) }}" >Discharge / Day-care Summary</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->discharge_or_day_care_summary_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['discharge_or_day_care_summary_file']) && $document_files['discharge_or_day_care_summary_file'])
                                                @foreach($document_files['discharge_or_day_care_summary_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Discharge / Day-care Summary{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->death_summary_from_hospital_where_applicable_file) }}" >Death summary from hospital where applicable</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->death_summary_from_hospital_where_applicable_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['death_summary_from_hospital_where_applicable_file']) && $document_files['death_summary_from_hospital_where_applicable_file'])
                                                @foreach($document_files['death_summary_from_hospital_where_applicable_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Death summary from hospital where applicable{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->payment_receipts_of_the_hospital_file) }}" >Payment Receipts of the Hospital</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->payment_receipts_of_the_hospital_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['payment_receipts_of_the_hospital_file']) && $document_files['payment_receipts_of_the_hospital_file'])
                                                @foreach($document_files['payment_receipts_of_the_hospital_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Payment Receipts of the Hospital{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->other_documents_file) }}" >Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['other_documents_file']) && $document_files['other_documents_file'])
                                                @foreach($document_files['other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tab3">
                                        <table class="table">
                                            <tbody>
                                              
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_pan_card_file) }}" >Claimant PAN Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_pan_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claimant_pan_card_file']) && $document_files['claimant_pan_card_file'])
                                                @foreach($document_files['claimant_pan_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Claimant PAN Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_aadhar_card_file) }}" >Claimant Aadhar Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_aadhar_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claimant_aadhar_card_file']) && $document_files['claimant_aadhar_card_file'])
                                                @foreach($document_files['claimant_aadhar_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Claimant Aadhar Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_current_address_proof_file) }}" >Claimant Current Address Proof</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_current_address_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claimant_current_address_proof_file']) && $document_files['claimant_current_address_proof_file'])
                                                @foreach($document_files['claimant_current_address_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Claimant Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_cancel_cheque_file) }}" >Claimant Cancel Cheque / Pass Book</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_cancel_cheque_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['claimant_cancel_cheque_file']) && $document_files['claimant_cancel_cheque_file'])
                                                @foreach($document_files['claimant_cancel_cheque_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Claimant Cancel Cheque / Pass Book{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->abha_id_proof_file) }}" >ABHA ID Proof</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->abha_id_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['abha_id_proof_file']) && $document_files['abha_id_proof_file'])
                                                @foreach($document_files['abha_id_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">ABHA ID Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->mlc_report_and_police_fir_document_file) }}" >MLC Report & Police FIR Document</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->mlc_report_and_police_fir_document_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['mlc_report_and_police_fir_document_file']) && $document_files['mlc_report_and_police_fir_document_file'])
                                                @foreach($document_files['mlc_report_and_police_fir_document_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">MLC Report & Police FIR Document{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_co_tpa_claim_form_signed_and_stamped_file) }}" >Insurance Co. TPA Claim Form (Signed & Stamped)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_co_tpa_claim_form_signed_and_stamped_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['insurance_co_tpa_claim_form_signed_and_stamped_file']) && $document_files['insurance_co_tpa_claim_form_signed_and_stamped_file'])
                                                @foreach($document_files['insurance_co_tpa_claim_form_signed_and_stamped_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Insurance Co. TPA Claim Form (Signed & Stamped){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tab6">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->settllement_letter_file) }}" >Settllement Letter</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->settllement_letter_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['settllement_letter_file']) && $document_files['settllement_letter_file'])
                                                @foreach($document_files['settllement_letter_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Settllement Letter{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_other_documents_file) }}" >Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['insurance_other_documents_file']) && $document_files['insurance_other_documents_file'])
                                                @foreach($document_files['insurance_other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tab4">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" >Borrower Current Address Proof</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_current_address_proof_file']) && $document_files['borrower_current_address_proof_file'])
                                                @foreach($document_files['borrower_current_address_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_pan_card_file) }}" >Borrower PAN Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_pan_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_pan_card_file']) && $document_files['borrower_pan_card_file'])
                                                @foreach($document_files['borrower_pan_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower PAN Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_aadhar_card_file) }}" >Borrower Aadhar Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_aadhar_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_aadhar_card_file']) && $document_files['borrower_aadhar_card_file'])
                                                @foreach($document_files['borrower_aadhar_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower Aadhar Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_bank_statement_3_months_file) }}" >Borrower Bank Statement (3 months)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_bank_statement_3_months_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_bank_statement_3_months_file']) && $document_files['borrower_bank_statement_3_months_file'])
                                                @foreach($document_files['borrower_bank_statement_3_months_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower Bank Statement (3 months){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_itr_income_tax_return_file) }}" >Borrower  ITR (Income Tax Return)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_itr_income_tax_return_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_itr_income_tax_return_file']) && $document_files['borrower_itr_income_tax_return_file'])
                                                @foreach($document_files['borrower_itr_income_tax_return_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower  ITR (Income Tax Return){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_cancel_cheque_file) }}" >Borrower Cancel Cheque / Pass Book</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_cancel_cheque_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_cancel_cheque_file']) && $document_files['borrower_cancel_cheque_file'])
                                                @foreach($document_files['borrower_cancel_cheque_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower Cancel Cheque / Pass Book{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_other_documents_file) }}" >Borrower Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_other_documents_file']) && $document_files['borrower_other_documents_file'])
                                                @foreach($document_files['borrower_other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Borrower Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="tab5">
                                        <table class="table">
                                            <tbody>
                                                 <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_current_address_proof_file) }}" >Co-Borrower  Current Address Proof</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_current_address_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_current_address_proof_file']) && $document_files['co_borrower_current_address_proof_file'])
                                                @foreach($document_files['co_borrower_current_address_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower  Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_pan_card_file) }}" >Co-Borrower PAN Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_pan_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_pan_card_file']) && $document_files['co_borrower_pan_card_file'])
                                                @foreach($document_files['co_borrower_pan_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower PAN Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_aadhar_card_file) }}" >Co-Borrower Aadhar Card</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_aadhar_card_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_aadhar_card_file']) && $document_files['co_borrower_aadhar_card_file'])
                                                @foreach($document_files['co_borrower_aadhar_card_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower Aadhar Card{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_bank_statement_3_months_file) }}" >Co-Borrower Bank Statement (3 months)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_bank_statement_3_months_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_bank_statement_3_months_file']) && $document_files['co_borrower_bank_statement_3_months_file'])
                                                @foreach($document_files['co_borrower_bank_statement_3_months_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower Bank Statement (3 months){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_itr_income_tax_return_file) }}" >Co-Borrower  ITR (Income Tax Return)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_itr_income_tax_return_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_itr_income_tax_return_file']) && $document_files['co_borrower_itr_income_tax_return_file'])
                                                @foreach($document_files['co_borrower_itr_income_tax_return_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower  ITR (Income Tax Return){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_cancel_cheque_file) }}" >Co-Borrower Cancel Cheque / Pass Book</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_cancel_cheque_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_cancel_cheque_file']) && $document_files['co_borrower_cancel_cheque_file'])
                                                @foreach($document_files['co_borrower_cancel_cheque_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower Cancel Cheque / Pass Book{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_other_documents_file) }}" >Co-Borrower Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['co_borrower_other_documents_file']) && $document_files['co_borrower_other_documents_file'])
                                                @foreach($document_files['co_borrower_other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Co-Borrower Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="tab7">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->loan_approval_letter_file) }}" >Loan Approval Letter</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->loan_approval_letter_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['loan_approval_letter_file']) && $document_files['loan_approval_letter_file'])
                                                @foreach($document_files['loan_approval_letter_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Loan Approval Letter{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->loan_disbursement_letter_file) }}" >Loan Disbursement Letter</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->loan_disbursement_letter_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['loan_disbursement_letter_file']) && $document_files['loan_disbursement_letter_file'])
                                                @foreach($document_files['loan_disbursement_letter_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}">Loan Disbursement Letter{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 

                                                
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        
    </script>
@endpush
