@extends('layouts.hospital')
@section('title', 'Create Patient ID')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claims</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.patients.index') }}">Patients</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Patient ID Creation</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                            <form action="{{ route('hospital.patients.save-documents-reimbursement') }}" method="post" id="hospital-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">

                                <div class="col-md-12 mb-2 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;">  Documents for Initial Assessment  </div>

                                <div class="col-md-12 mb-3">
                                    <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                    <input type="text"  readonly class="form-control" id="patient_id" name="patient_id" maxlength="60"
                                    placeholder="Enter Patient Id" value="{{ old('patient_id', @$patient->uid) }}">
                                    @error('patient_id')
                                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-1">
                                    <label for="firstname">Patient Name <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-3 mt-1">
                                    <select class="form-control" id="title" name="title">
                                        <option disabled value="">Select</option>
                                        <option disabled value="Mr." {{ old('title') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                        <option disabled value="Ms." {{ old('title') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                    </select>
                                    @error('title')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" readonly maxlength="25" class="form-control" id="lastname"
                                    name="lastname" placeholder="Last name"
                                    value="{{ old('lastname') }}">
                                    @error('lastname')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" readonly maxlength="25" class="form-control" id="firstname"
                                    name="firstname" placeholder="First name"
                                    value="{{ old('firstname') }}">
                                    @error('firstname')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" readonly maxlength="25" class="form-control" id="middlename"
                                    name="middlename" placeholder="Middle name"
                                    value="{{ old('middlename') }}">
                                    @error('middlename')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Patient ID Proof">
                                        @isset($reimbursementdocument->patient_id_proof_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->patient_id_proof_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="patient_id_proof_file" id="patient_id_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="patient_id_proof_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('patient_id_proof_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Doctor Prescriptions / Consultation Papers">
                                        @isset($reimbursementdocument->doctor_prescriptions_or_consultation_papers_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor_prescriptions_or_consultation_papers_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="doctor_prescriptions_or_consultation_papers_file" id="doctor_prescriptions_or_consultation_papers_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="doctor_prescriptions_or_consultation_papers_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('doctor_prescriptions_or_consultation_papers_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Insurance Policy Copy *">
                                        @isset($reimbursementdocument->insurance_policy_copy_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->insurance_policy_copy_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="insurance_policy_copy_file" id="insurance_policy_copy_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="insurance_policy_copy_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('insurance_policy_copy_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="TPA Card*">
                                        @isset($reimbursementdocument->tpa_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->tpa_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="tpa_card_file" id="tpa_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="tpa_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('tpa_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Employee / Member ID (Group) *">
                                        @isset($reimbursementdocument->employee_or_member_id_group_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->employee_or_member_id_group_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="employee_or_member_id_group_file" id="employee_or_member_id_group_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="employee_or_member_id_group_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('employee_or_member_id_group_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Photograph of the Patient *">
                                        @isset($reimbursementdocument->photograph_of_the_patient_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->photograph_of_the_patient_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="photograph_of_the_patient_file" id="photograph_of_the_patient_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="photograph_of_the_patient_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('photograph_of_the_patient_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="hospital-form">Save Documents for Initial Assessment</button>
                                </div>

                                <div class="col-md-12 mb-2 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;">  Documents for Final Assessment </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Indoor Care Paper">
                                        @isset($reimbursementdocument->indoor_care_paper_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->indoor_care_paper_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="indoor_care_paper_file" id="indoor_care_paper_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="indoor_care_paper_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('indoor_care_paper_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="ECG Report">
                                        @isset($reimbursementdocument->ecg_report_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ecg_report_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="ecg_report_file" id="ecg_report_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="ecg_report_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('ecg_report_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="CT/MRI/USG/HPE investigation Report">
                                        @isset($reimbursementdocument->ct_mri_usg_hpe_investigation_report_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->ct_mri_usg_hpe_investigation_report_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="ct_mri_usg_hpe_investigation_report_file" id="ct_mri_usg_hpe_investigation_report_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="ct_mri_usg_hpe_investigation_report_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('ct_mri_usg_hpe_investigation_report_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Diagnostic / Investigation Reports">
                                        @isset($reimbursementdocument->diagnostic_or_investigation_reports_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->diagnostic_or_investigation_reports_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="diagnostic_or_investigation_reports_file" id="diagnostic_or_investigation_reports_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="diagnostic_or_investigation_reports_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('diagnostic_or_investigation_reports_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Doctor’s reference slip for Investigation">
                                        @isset($reimbursementdocument->doctor’s_reference_slip_for_investigation_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->doctor’s_reference_slip_for_investigation_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="doctor’s_reference_slip_for_investigation_file" id="doctor’s_reference_slip_for_investigation_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="doctor’s_reference_slip_for_investigation_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('doctor’s_reference_slip_for_investigation_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Operation Theatre Notes">
                                        @isset($reimbursementdocument->operation_theatre_notes_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->operation_theatre_notes_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="operation_theatre_notes_file" id="operation_theatre_notes_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="operation_theatre_notes_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('operation_theatre_notes_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Pharmacy Bills">
                                        @isset($reimbursementdocument->pharmacy_bills_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->pharmacy_bills_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="pharmacy_bills_file" id="pharmacy_bills_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="pharmacy_bills_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('pharmacy_bills_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Implant Sticker Invoice">
                                        @isset($reimbursementdocument->implant_sticker_invoice_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->implant_sticker_invoice_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="implant_sticker_invoice_file" id="implant_sticker_invoice_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="implant_sticker_invoice_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('implant_sticker_invoice_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Hospital Break-up Bills">
                                        @isset($reimbursementdocument->hospital_break_up_bills_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_break_up_bills_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="hospital_break_up_bills_file" id="hospital_break_up_bills_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="hospital_break_up_bills_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('hospital_break_up_bills_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Hospital (Main) Final Bill">
                                        @isset($reimbursementdocument->hospital_main_final_bill_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->hospital_main_final_bill_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="hospital_main_final_bill_file" id="hospital_main_final_bill_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="hospital_main_final_bill_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('hospital_main_final_bill_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Discharge / Day-care Summary *">
                                        @isset($reimbursementdocument->discharge_or_day_care_summary_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->discharge_or_day_care_summary_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="discharge_or_day_care_summary_file" id="discharge_or_day_care_summary_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="discharge_or_day_care_summary_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('discharge_or_day_care_summary_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Death summary from hospital where applicable">
                                        @isset($reimbursementdocument->death_summary_from_hospital_where_applicable_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->death_summary_from_hospital_where_applicable_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="death_summary_from_hospital_where_applicable_file" id="death_summary_from_hospital_where_applicable_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="death_summary_from_hospital_where_applicable_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('death_summary_from_hospital_where_applicable_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Payment Receipts of the Hospital">
                                        @isset($reimbursementdocument->payment_receipts_of_the_hospital_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->payment_receipts_of_the_hospital_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="payment_receipts_of_the_hospital_file" id="payment_receipts_of_the_hospital_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="payment_receipts_of_the_hospital_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('payment_receipts_of_the_hospital_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Other Documents">
                                        @isset($reimbursementdocument->other_documents_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->other_documents_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="other_documents_file" id="other_documents_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="other_documents_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('other_documents_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="hospital-form">Save Documents for Final Assessment</button>
                                </div>



                                <div class="col-md-12 mb-2 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;">  Documents for Insurance Claim </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Claimant PAN Card">
                                        @isset($reimbursementdocument->claimant_pan_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_pan_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="claimant_pan_card_file" id="claimant_pan_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="claimant_pan_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('claimant_pan_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Claimant Aadhar Card">
                                        @isset($reimbursementdocument->claimant_aadhar_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_aadhar_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="claimant_aadhar_card_file" id="claimant_aadhar_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="claimant_aadhar_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('claimant_aadhar_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Claimant Current Address Proof">
                                        @isset($reimbursementdocument->claimant_current_address_proof_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_current_address_proof_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="claimant_current_address_proof_file" id="claimant_current_address_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="claimant_current_address_proof_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('claimant_current_address_proof_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Claimant Cancel Cheque">
                                        @isset($reimbursementdocument->claimant_cancel_cheque_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->claimant_cancel_cheque_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="claimant_cancel_cheque_file" id="claimant_cancel_cheque_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="claimant_cancel_cheque_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('claimant_cancel_cheque_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="ABHA ID Proof">
                                        @isset($reimbursementdocument->abha_id_proof_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->abha_id_proof_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="abha_id_proof_file" id="abha_id_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="abha_id_proof_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('abha_id_proof_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="MLC Report & Police FIR Document">
                                        @isset($reimbursementdocument->mlc_report_and_police_fir_document_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->mlc_report_and_police_fir_document_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="mlc_report_and_police_fir_document_file" id="mlc_report_and_police_fir_document_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="mlc_report_and_police_fir_document_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('mlc_report_and_police_fir_document_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="hospital-form">Save Documents for Insurance Claim</button>
                                </div>


                                <div class="col-md-12 mb-2 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;">  Documents for Medical Loan (Borrower) </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower Current Address Proof">
                                        @isset($reimbursementdocument->borrower_current_address_proof_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_current_address_proof_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_current_address_proof_file" id="borrower_current_address_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_current_address_proof_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_current_address_proof_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower PAN Card">
                                        @isset($reimbursementdocument->borrower_pan_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_pan_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_pan_card_file" id="borrower_pan_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_pan_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_pan_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower Aadhar Card">
                                        @isset($reimbursementdocument->borrower_aadhar_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_aadhar_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_aadhar_card_file" id="borrower_aadhar_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_aadhar_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_aadhar_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower Bank Statement (3 months)">
                                        @isset($reimbursementdocument->borrower_bank_statement_3_months_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_bank_statement_3_months_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_bank_statement_3_months_file" id="borrower_bank_statement_3_months_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_bank_statement_3_months_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_bank_statement_3_months_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower  ITR (Income Tax Return)">
                                        @isset($reimbursementdocument->borrower_itr_income_tax_return_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_itr_income_tax_return_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_itr_income_tax_return_file" id="borrower_itr_income_tax_return_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_itr_income_tax_return_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_itr_income_tax_return_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower Cancel Cheque">
                                        @isset($reimbursementdocument->borrower_cancel_cheque_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_cancel_cheque_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_cancel_cheque_file" id="borrower_cancel_cheque_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_cancel_cheque_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_cancel_cheque_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Borrower Other Documents">
                                        @isset($reimbursementdocument->borrower_other_documents_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->borrower_other_documents_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="borrower_other_documents_file" id="borrower_other_documents_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="borrower_other_documents_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('borrower_other_documents_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="hospital-form">Save Documents of Borrower</button>
                                </div>


                                <div class="col-md-12 mb-2 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;">  Documents for Loan (Co-Borrower) </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower  Current Address Proof">
                                        @isset($reimbursementdocument->co_borrower_current_address_proof_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_current_address_proof_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_current_address_proof_file" id="co_borrower_current_address_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_current_address_proof_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_current_address_proof_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower PAN Card">
                                        @isset($reimbursementdocument->co_borrower_pan_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_pan_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_pan_card_file" id="co_borrower_pan_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_pan_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_pan_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower Aadhar Card">
                                        @isset($reimbursementdocument->co_borrower_aadhar_card_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_aadhar_card_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_aadhar_card_file" id="co_borrower_aadhar_card_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_aadhar_card_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_aadhar_card_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower Bank Statement (3 months)">
                                        @isset($reimbursementdocument->co_borrower_bank_statement_3_months_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_bank_statement_3_months_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_bank_statement_3_months_file" id="co_borrower_bank_statement_3_months_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_bank_statement_3_months_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_bank_statement_3_months_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower  ITR (Income Tax Return)">
                                        @isset($reimbursementdocument->co_borrower_itr_income_tax_return_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_itr_income_tax_return_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_itr_income_tax_return_file" id="co_borrower_itr_income_tax_return_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_itr_income_tax_return_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_itr_income_tax_return_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower Cancel Cheque">
                                        @isset($reimbursementdocument->co_borrower_cancel_cheque_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_cancel_cheque_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_cancel_cheque_file" id="co_borrower_cancel_cheque_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_cancel_cheque_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_cancel_cheque_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly placeholder="Co-Borrower Other Documents">
                                        @isset($reimbursementdocument->co_borrower_other_documents_file)
                                        <a href="{{ asset('storage/uploads/reimbursement/documents/'.$reimbursementdocument->id.'/'.$reimbursementdocument->co_borrower_other_documents_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                        @endisset
                                        <input type="file" name="co_borrower_other_documents_file" id="co_borrower_other_documents_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="co_borrower_other_documents_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('co_borrower_other_documents_file')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="hospital-form">Save Documents of Co-Borrower</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            setHospitalId();
            setSpecify();
            currentPermanentAddressSame();
            setNameField();
            setReferral();
        });

        function setHospitalId() {
            var name = $("#hospital_id").select2().find(":selected").data("name");
            var address = $("#hospital_id").select2().find(":selected").data("address");
            var city = $("#hospital_id").select2().find(":selected").data("city");
            var state = $("#hospital_id").select2().find(":selected").data("state");
            var pincode = $("#hospital_id").select2().find(":selected").data("pincode");
            var associate_partner_id = $("#hospital_id").select2().find(":selected").data("ap");
            console.log(address);
            $('#hospital_name').val(name);
            $('#hospital_address').val(address);
            $('#hospital_city').val(city);
            $('#hospital_state').val(state);
            $('#hospital_pincode').val(pincode);
            $('#hospital_pincode').val(pincode);
            $('#associate_partner_id').val(associate_partner_id);
        }
    </script>
    <script>
        function calculateAge() {
            var dob = $('#dob').val();
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').val(age);
        }
    </script>
    <script>
        function setSpecify() {
            var occupation = $('#occupation').val();
            switch (occupation) {
                case 'Other':
                    $("#specify").prop("readonly", false);
                    break;

                default:
                    $("#specify").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function currentPermanentAddressSame() {
            var current_permanent_address_same = $('#current_permanent_address_same').val();
            switch (current_permanent_address_same) {
                case 'Yes':
                    $("#patient_permanent_address").prop("readonly", true);
                    $("#patient_permanent_city").prop("readonly", true);
                    $("#patient_permanent_state").prop("readonly", true);
                    $("#patient_permanent_pincode").prop("readonly", true);
                    break;

                default:
                    $("#patient_permanent_address").prop("readonly", false);
                    $("#patient_permanent_city").prop("readonly", false);
                    $("#patient_permanent_state").prop("readonly", false);
                    $("#patient_permanent_pincode").prop("readonly", false);
                    break;
            }
        }
    </script>
    <script>
        function setNameField() {
            var admitted_by = $('#admitted_by').val();
            switch (admitted_by) {
                case 'Self':
                    $("#admitted_by_title").prop("disabled", true);
                    $("#admitted_by_firstname").prop("readonly", true);
                    $("#admitted_by_lastname").prop("readonly", true);
                    $("#admitted_by_middlename").prop("readonly", true);
                    break;

                default:
                    $("#admitted_by_title").prop("disabled", false);
                    $("#admitted_by_firstname").prop("readonly", false);
                    $("#admitted_by_lastname").prop("readonly", false);
                    $("#admitted_by_middlename").prop("readonly", false);
                    break;
            }
        }
    </script>
    <script>
        function setReferral() {
            var referred_by = $('#referred_by').val();
            if(referred_by == "BHC Direct"){
                $("input[name='referral_name']").val('BHC');
            }else if(referred_by == "Hospital's Direct Patient"){
                var hospital = $("#hospital_id").select2().find(":selected").data("name");
                        $("input[name='referral_name']").val(hospital);
            }else if(referred_by == "Associate Partner"){
                var apname = $("#hospital_id").select2().find(":selected").data("apname");
                        $("input[name='referral_name']").val(apname);
            }else{
                $("input[name='referral_name']").val({{ old('referral_name') }});
            }
        }
    </script>
@endpush
