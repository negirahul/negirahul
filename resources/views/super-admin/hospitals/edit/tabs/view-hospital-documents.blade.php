@extends('layouts.super-admin')
@section('title', 'Create Associate Partners')
@section('content')
<style type="text/css">
    a.active {
   background-color: darkseagreen !important ; 
}
</style>
    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Claim Stack</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Documents</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
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
                                            Hospital
                                        </span>
                                    </div>

                                </div>
                                <div class="d-flex flex-row align-items-center m-2 text-white">
                                    <p class="mb-0 me-2"><br> Hospital Documents</p>
                                </div>                        
                            </div>

                            <div class="col-12 nav nav-tabs custom-tab" id="myTab" style="font-size: 17px;">
                                <a  class="px-1 active" href="#tab1" data-bs-toggle="tab">Hospital Documents</a> 
                                <a  class="px-1" href="#tab2" data-bs-toggle="tab">Hospital Tariff</a> 
                                <a  class="px-1" href="#tab3" data-bs-toggle="tab">BCH Agreement</a> 
                                <a  class="px-1" href="#tab6" data-bs-toggle="tab">Hospital Facilities</a> 
                                <a  class="px-1" href="#tab4" data-bs-toggle="tab">Hospital Infrastructure</a> 
                                <a  class="px-1" href="#tab5" data-bs-toggle="tab">Hospital Department</a> 
                                <a  class="px-1" href="#tab7" data-bs-toggle="tab">Hospital Empanelment Status</a> 
                                <a  class="px-1" href="#tab8" data-bs-toggle="tab">Other Documents</a>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab1">
                                        <table class="table">
                                            <tbody>

                                               <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_pan_card) }}" >Hospital PAN No.</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_pan_card) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_pan_card']) && $document_files['hospital_pan_card'])
                                                @foreach($document_files['hospital_pan_card'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital PAN No.{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_rohini_certificate) }}" >Rohini Code</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_rohini_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_rohini_certificate']) && $document_files['hospital_rohini_certificate'])
                                                @foreach($document_files['hospital_rohini_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Rohini Code{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_tan_certificate) }}" >Hospital TAN No.</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_tan_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>

                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_tan_certificate']) && $document_files['hospital_tan_certificate'])
                                                @foreach($document_files['hospital_tan_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital TAN No.{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif    
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_gst_certificate) }}" >Hospital GST No.</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_gst_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_gst_certificate']) && $document_files['hospital_gst_certificate'])
                                                @foreach($document_files['hospital_gst_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital GST No.{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif     

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->medical_superintendents_registration_certificate) }}" >Hospital Medical Superintendent's Registration No.</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->medical_superintendents_registration_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['medical_superintendents_registration_certificate']) && $document_files['medical_superintendents_registration_certificate'])
                                                @foreach($document_files['medical_superintendents_registration_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Medical Superintendent's Registration No.{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif
                                                
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_pollution_clearance_certificate) }}" >Hospital Pollution Clearance Certificate</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_pollution_clearance_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_pollution_clearance_certificate']) && $document_files['hospital_pollution_clearance_certificate'])
                                                @foreach($document_files['hospital_pollution_clearance_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Pollution Clearance Certificate{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_fire_safety_clearance_certificate) }}" >Hospital Fire Safety Clearance Certificate</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_fire_safety_clearance_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_fire_safety_clearance_certificate']) && $document_files['hospital_fire_safety_clearance_certificate'])
                                                @foreach($document_files['hospital_fire_safety_clearance_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Fire Safety Clearance Certificate{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_certificate_of_incorporation) }}" >Hospital Certificate of Incorporation</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_certificate_of_incorporation) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_certificate_of_incorporation']) && $document_files['hospital_certificate_of_incorporation'])
                                                @foreach($document_files['hospital_certificate_of_incorporation'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Certificate of Incorporation{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_cancel_cheque) }}" >Cancel Cheque</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_cancel_cheque) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_cancel_cheque']) && $document_files['hospital_cancel_cheque'])
                                                @foreach($document_files['hospital_cancel_cheque'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Cancel Cheque{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabh_certificate) }}" >Hospital NABH Registration</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabh_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nabh_certificate']) && $document_files['nabh_certificate'])
                                                @foreach($document_files['nabh_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital NABH Registration{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabl_certificate) }}" >Hospital NABL Registration No.</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabl_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nabl_certificate']) && $document_files['nabl_certificate'])
                                                @foreach($document_files['nabl_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital NABL Registration No.{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->iso_certificates) }}" >ISO Status</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->iso_certificates) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['iso_certificates']) && $document_files['iso_certificates'])
                                                @foreach($document_files['iso_certificates'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">ISO Status{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->indoor_care_paper_file) }}" >Indoor Care Paper</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->indoor_care_paper_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['indoor_care_paper_file']) && $document_files['indoor_care_paper_file'])
                                                @foreach($document_files['indoor_care_paper_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Indoor Care Paper{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ecg_report_file) }}" >ECG Report</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ecg_report_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ecg_report_file']) && $document_files['ecg_report_file'])
                                                @foreach($document_files['ecg_report_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">ECG Report{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) }}" >CT/MRI/USG/HPE investigation Report</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ct_mri_usg_hpe_investigation_report_file']) && $document_files['ct_mri_usg_hpe_investigation_report_file'])
                                                @foreach($document_files['ct_mri_usg_hpe_investigation_report_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">CT/MRI/USG/HPE investigation Report{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->diagnostic_or_investigation_reports_file) }}" >Diagnostic / Investigation Reports</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->diagnostic_or_investigation_reports_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['diagnostic_or_investigation_reports_file']) && $document_files['diagnostic_or_investigation_reports_file'])
                                                @foreach($document_files['diagnostic_or_investigation_reports_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Diagnostic / Investigation Reports{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->doctor’s_reference_slip_for_investigation_file) }}" >Doctor’s reference slip for Investigation</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->doctor’s_reference_slip_for_investigation_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['doctor’s_reference_slip_for_investigation_file']) && $document_files['doctor’s_reference_slip_for_investigation_file'])
                                                @foreach($document_files['doctor’s_reference_slip_for_investigation_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Doctor’s reference slip for Investigation{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->operation_theatre_notes_file) }}" >Operation Theatre Notes</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->operation_theatre_notes_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['operation_theatre_notes_file']) && $document_files['operation_theatre_notes_file'])
                                                @foreach($document_files['operation_theatre_notes_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Operation Theatre Notes{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pharmacy_bills_file) }}" >Pharmacy Bills</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pharmacy_bills_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['pharmacy_bills_file']) && $document_files['pharmacy_bills_file'])
                                                @foreach($document_files['pharmacy_bills_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Pharmacy Bills{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->implant_sticker_invoice_file) }}" >Implant Sticker Invoice</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->implant_sticker_invoice_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['implant_sticker_invoice_file']) && $document_files['implant_sticker_invoice_file'])
                                                @foreach($document_files['implant_sticker_invoice_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Implant Sticker Invoice{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_break_up_bills_file) }}" >Hospital Break-up Bills</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_break_up_bills_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_break_up_bills_file']) && $document_files['hospital_break_up_bills_file'])
                                                @foreach($document_files['hospital_break_up_bills_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Break-up Bills{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_main_final_bill_file) }}" >Hospital (Main) Final Bill</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_main_final_bill_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_main_final_bill_file']) && $document_files['hospital_main_final_bill_file'])
                                                @foreach($document_files['hospital_main_final_bill_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital (Main) Final Bill{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->discharge_or_day_care_summary_file) }}" >Discharge / Day-care Summary</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->discharge_or_day_care_summary_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['discharge_or_day_care_summary_file']) && $document_files['discharge_or_day_care_summary_file'])
                                                @foreach($document_files['discharge_or_day_care_summary_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Discharge / Day-care Summary{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->death_summary_from_hospital_where_applicable_file) }}" >Death summary from hospital where applicable</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->death_summary_from_hospital_where_applicable_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['death_summary_from_hospital_where_applicable_file']) && $document_files['death_summary_from_hospital_where_applicable_file'])
                                                @foreach($document_files['death_summary_from_hospital_where_applicable_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Death summary from hospital where applicable{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->payment_receipts_of_the_hospital_file) }}" >Payment Receipts of the Hospital</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->payment_receipts_of_the_hospital_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['payment_receipts_of_the_hospital_file']) && $document_files['payment_receipts_of_the_hospital_file'])
                                                @foreach($document_files['payment_receipts_of_the_hospital_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Payment Receipts of the Hospital{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->other_documents_file) }}" >Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->other_documents_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['other_documents_file']) && $document_files['other_documents_file'])
                                                @foreach($document_files['other_documents_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mou_with_bhc) }}" >Hospital Signed MOUs</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mou_with_bhc) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['mou_with_bhc']) && $document_files['mou_with_bhc'])
                                                @foreach($document_files['mou_with_bhc'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Signed MOUs{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" >BHC Packages for Surgical Procedures Accepted</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_current_address_proof_file']) && $document_files['borrower_current_address_proof_file'])
                                                @foreach($document_files['borrower_current_address_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">BHC Packages for Surgical Procedures Accepted{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" >Lending / Finance Company's Agreement</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['borrower_current_address_proof_file']) && $document_files['borrower_current_address_proof_file'])
                                                @foreach($document_files['borrower_current_address_proof_file'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Lending / Finance Company's Agreement{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pharmacy) }}" >Pharmacy</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pharmacy) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['pharmacy']) && $document_files['pharmacy'])
                                                @foreach($document_files['pharmacy'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Pharmacy{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->lab) }}" >Lab</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->lab) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['lab']) && $document_files['lab'])
                                                @foreach($document_files['lab'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Lab{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ambulance) }}" >Ambulance</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ambulance) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ambulance']) && $document_files['ambulance'])
                                                @foreach($document_files['ambulance'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Ambulance{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->operation_theatre) }}" >Operation</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->operation_theatre) }}" download class=" download-operation_theatreel"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['operation_theatre']) && $document_files['operation_theatre'])
                                                @foreach($document_files['operation_theatre'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Operation{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->icu) }}" >Icu</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->icu) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['icu']) && $document_files['icu'])
                                                @foreach($document_files['icu'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Icu{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->iccu) }}" >ICCU</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->iccu) }}" download class=" download-iccuel"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['iccu']) && $document_files['iccu'])
                                                @foreach($document_files['iccu'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">ICCU{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nicu) }}" >NICU</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nicu) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nicu']) && $document_files['nicu'])
                                                @foreach($document_files['nicu'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">NICU{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->csc_sterilization) }}" >CSC (Sterilization)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->csc_sterilization) }}" download class=" download-csc_sterilizationel"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['csc_sterilization']) && $document_files['csc_sterilization'])
                                                @foreach($document_files['csc_sterilization'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">CSC (Sterilization){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->centralized_gas_ons) }}" >Centralized-Gas (ONS)</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->centralized_gas_ons) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['centralized_gas_ons']) && $document_files['centralized_gas_ons'])
                                                @foreach($document_files['centralized_gas_ons'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Centralized-Gas (ONS){{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->centralized_ac) }}" >Centralized-AC</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->centralized_ac) }}" download class=" download-centralized_acel"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['centralized_ac']) && $document_files['centralized_ac'])
                                                @foreach($document_files['centralized_ac'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Centralized-AC{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->kitchen) }}" >Kitchen</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->kitchen) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['kitchen']) && $document_files['kitchen'])
                                                @foreach($document_files['kitchen'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Kitchen{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->usg_machine) }}" >USG Machine</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->usg_machine) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['usg_machine']) && $document_files['usg_machine'])
                                                @foreach($document_files['usg_machine'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">USG Machine{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->digital_x_ray) }}" >Digital X-Ray</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->digital_x_ray) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['digital_x_ray']) && $document_files['digital_x_ray'])
                                                @foreach($document_files['digital_x_ray'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Digital X-Ray{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ct) }}" >CT</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->ct) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['ct']) && $document_files['ct'])
                                                @foreach($document_files['ct'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">CT{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mri) }}" >MRI</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mri) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['mri']) && $document_files['mri'])
                                                @foreach($document_files['mri'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">MRI{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pet_scan) }}" >PET Scan</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->pet_scan) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['pet_scan']) && $document_files['pet_scan'])
                                                @foreach($document_files['pet_scan'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">PET Scan{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->organ_transplant_unit) }}" >Organ Transplant Unit</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->organ_transplant_unit) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['organ_transplant_unit']) && $document_files['organ_transplant_unit'])
                                                @foreach($document_files['organ_transplant_unit'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Organ Transplant Unit{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif 


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->burn_unit) }}" >Burn Unit</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->burn_unit) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['burn_unit']) && $document_files['burn_unit'])
                                                @foreach($document_files['burn_unit'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Burn Unit{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->dialysis_unit) }}" >Dialysis Unit</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->dialysis_unit) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['dialysis_unit']) && $document_files['dialysis_unit'])
                                                @foreach($document_files['dialysis_unit'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Dialysis Unit{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->blood_bank) }}" >Blood Bank</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->blood_bank) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['blood_bank']) && $document_files['blood_bank'])
                                                @foreach($document_files['blood_bank'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Blood Bank{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabl_certificate) }}" >NABL Approved Lab</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabl_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nabl_certificate']) && $document_files['nabl_certificate'])
                                                @foreach($document_files['nabl_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabh_certificate) }}" >NABH Status</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nabh_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nabh_certificate']) && $document_files['nabh_certificate'])
                                                @foreach($document_files['nabh_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->jci_certificate) }}" >JCI Status</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->jci_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['jci_certificate']) && $document_files['jci_certificate'])
                                                @foreach($document_files['jci_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  


                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nqac_or_nhsrc_certificate) }}" >NQAC/NHSRC Status</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->nqac_or_nhsrc_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['nqac_or_nhsrc_certificate']) && $document_files['nqac_or_nhsrc_certificate'])
                                                @foreach($document_files['nqac_or_nhsrc_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  

                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hippa_certificate) }}" >HIPPA Status</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hippa_certificate) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hippa_certificate']) && $document_files['hippa_certificate'])
                                                @foreach($document_files['hippa_certificate'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Borrower Current Address Proof{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates) }}" >All MoUs and Tariffs IC and TPA*</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['mous_ic_or_tpa_or_govt_or_psu_or_other_corporates']) && $document_files['mous_ic_or_tpa_or_govt_or_psu_or_other_corporates'])
                                                @foreach($document_files['mous_ic_or_tpa_or_govt_or_psu_or_other_corporates'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">All MoUs and Tariffs IC and TPA*{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_other_documents) }}" >Upload</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_other_documents) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_other_documents']) && $document_files['hospital_other_documents'])
                                                @foreach($document_files['hospital_other_documents'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Upload{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif  
                                                
                                                

                                                
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="tab8">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_other_documents) }}" >Hospital Other Documents</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$reimbursementdocument->hospital_other_documents) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr>


                                                @if($document_files && (count($document_files) > 0) && isset($document_files['hospital_other_documents']) && $document_files['hospital_other_documents'])
                                                @foreach($document_files['hospital_other_documents'] as $document_file)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}">Hospital Other Documents{{ $document_file->file_id }}</a></td>
                                                    <td><a href="{{ asset('storage/uploads/hospital/documents/'.$id.'/'.$document_file->file_path) }}" download class=" download-label"><i class="mdi mdi-download"></i></a></td>

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
