@extends('layouts.super-admin')
@section('title', 'New Assessment Status')
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
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.claimants.index') }}">Assessment Status</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($assessment_status) && !empty($assessment_status)) Edit @else New @endif Assessment Status</li>
                        </ol>
                    </div>
                    <h4 class="page-title"> @if(isset($assessment_status) && !empty($assessment_status)) Edit @else New @endif Assessment Status</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
   

                <div class="tab-content">
                    <div class="tab-pane show active" id="assessment_status_tab">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Pre-Assessment
                            </div>
                            <div class="card-body">
                                <form action="{{ route('super-admin.assessment-status.update-assessment-status', $claim->id) }}"
                                    method="POST" id="pre-assessment-status-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="pre-assessment-status-form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mt-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id"
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$claim->patient->uid) }}">
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claim_id"
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$claim->uid) }}">
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="claimant_id">Claimant ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claimant_id"
                                                name="claimant_id" maxlength="60" placeholder="Enter Claimant ID"
                                                value="{{ old('claimant_id', $claim->uid) }}">
                                            @error('claimant_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="hospital_id">Hospital Id <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id"
                                                name="hospital_id" placeholder="Enter Hospital Id"
                                                value="{{ old('hospital_id', @$claim->patient->hospital->uid) }}">
                                            @error('hospital_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$claim->patient->hospital->name) }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="hospital_address">Hospital Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_address"
                                                name="hospital_address" placeholder="Address Line"
                                                value="{{ old('hospital_address', @$claim->patient->hospital->address) }}">
                                            @error('hospital_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" readonly class="form-control" id="hospital_city"
                                                name="hospital_city" placeholder="City"
                                                value="{{ old('hospital_city', @$claim->patient->hospital->city) }}">
                                            @error('hospital_city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" readonly class="form-control" id="hospital_state"
                                                name="hospital_state" placeholder="State"
                                                value="{{ old('hospital_state', @$claim->patient->hospital->state) }}">
                                            @error('hospital_state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="number" readonly class="form-control" id="hospital_pincode"
                                                name="hospital_pincode" placeholder="Pincode"
                                                value="{{ old('hospital_pincode', @$claim->patient->hospital->pincode) }}">
                                            @error('hospital_pincode')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="patient_firstname">Patient Name <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="patient_title" name="patient_title">
                                                <option disabled value="">Select</option>
                                                <option disabled @if (old('patient_title', @$claim->patient->title) == 'Mr.') selected @endif
                                                    value="Mr.">Mr.</option>
                                                <option disabled @if (old('patient_title', @$claim->patient->title) == 'Ms.') selected @endif
                                                    value="Ms.">Ms.</option>
                                            </select>
                                            @error('patient_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_lastname" name="patient_lastname" maxlength="30"
                                                placeholder="Last name"
                                                value="{{ old('patient_lastname', @$claim->patient->lastname) }}">
                                            @error('patient_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_firstname" name="patient_firstname" maxlength="15"
                                                placeholder="First name"
                                                value="{{ old('patient_firstname', @$claim->patient->firstname) }}">
                                            @error('patient_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_middlename" name="patient_middlename" maxlength="30"
                                                placeholder="Middle name"
                                                value="{{ old('patient_middlename', @$claim->patient->middlename) }}">
                                            @error('patient_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="policy_no">Policy No. <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="16" class="form-control"
                                                id="policy_no" name="policy_no" placeholder="Policy No."
                                                value="{{ old('policy_no', @$claim->policy->policy_no) }}">
                                            @error('policy_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="insurance_company">Insurance Company<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" disabled id="insurance_company"
                                                name="insurance_company" data-toggle="select2">
                                                <option value="">Please Select</option>
                                                @foreach ($insurers as $insurer)
                                                    <option value="{{ $insurer->id }}"
                                                        {{ old('insurance_company', @$claim->policy->insurer_id) == $insurer->id ? 'selected' : '' }}>
                                                        {{ $insurer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('insurance_company')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="company_tpa_id_card_no">Company / TPA ID Card No. <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="16" class="form-control"
                                                id="company_tpa_id_card_no" placeholder="Company / TPA ID Card No."
                                                name="company_tpa_id_card_no"
                                                value="{{ old('company_tpa_id_card_no', @$claim->policy->company_tpa_id_card_no) }}">
                                            @error('company_tpa_id_card_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="start_date">Policy Start Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled max="{{ date('Y-m-d') }}" class="form-control"
                                                id="start_date" name="start_date"
                                                value="{{ old('start_date', @$claim->policy->start_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('start_date')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="expiry_date">Policy Expiry Date <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled
                                                class="form-control" id="expiry_date" name="expiry_date"
                                                value="{{ old('expiry_date', @$claim->policy->expiry_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('expiry_date')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="commencement_date">Policy Commencement Date
                                                (without Break) <span class="text-danger">*</span></label>
                                            <input type="text" disabled
                                                placeholder="Enter Policy Commencement Date (without Break)"
                                                class="form-control" id="commencement_date" name="commencement_date"
                                                value="{{ old('commencement_date', @$claim->policy->commencement_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('commencement_date')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_on_the_panel_of_insurance_co">Hospital on the Panel of
                                                Insurance Co. <span class="text-danger"></span></label>
                                            <select class="form-control" id="hospital_on_the_panel_of_insurance_co"
                                                name="hospital_on_the_panel_of_insurance_co" onchange="updateHospitalId('{{ $hospital_id_as_per_the_selected_company }}')">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('hospital_on_the_panel_of_insurance_co', isset($assessment_status) ? $assessment_status->hospital_on_the_panel_of_insurance_co : '') == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('hospital_on_the_panel_of_insurance_co', isset($assessment_status) ? $assessment_status->hospital_on_the_panel_of_insurance_co : '') == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            @error('hospital_on_the_panel_of_insurance_co')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_id_insurance_co">Hospital ID (Insurance Co.) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control"
                                                id="hospital_id_insurance_co" name="hospital_id_insurance_co"
                                                placeholder="Enter Hospital ID (Insurance Co.) "
                                                value="{{ old('hospital_id_insurance_co', isset($assessment_status) ? $assessment_status->hospital_id_insurance_co : '') }}">
                                            @error('hospital_id_insurance_co')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="pre_assessment_status">Pre-Assessment Status <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" onchange="setStatus();" id="pre_assessment_status"
                                                name="pre_assessment_status">
                                                <option value="Waiting for Pre-Assessment"
                                                    {{ old('pre_assessment_status', isset($assessment_status) ? $assessment_status->pre_assessment_status : '') == 'Waiting for Pre-Assessment' ? 'selected' : '' }}>
                                                    Waiting for Pre-Assessment </option>
                                                <option value="Query Raised by BHC Team"
                                                    {{ old('pre_assessment_status', isset($assessment_status) ? $assessment_status->pre_assessment_status : '') == 'Query Raised by BHC Team' ? 'selected' : '' }}>
                                                    Query Raised by BHC Team</option>
                                                <option value="Non Admissible as per the Policy TC"
                                                    {{ old('pre_assessment_status', isset($assessment_status) ? $assessment_status->pre_assessment_status : '') == 'Non Admissible as per the Policy TC' ? 'selected' : '' }}>
                                                    Non Admissible as per the Policy TC</option>
                                                <option value="Non Admissible as per the Treatment Received"
                                                    {{ old('pre_assessment_status', isset($assessment_status) ? $assessment_status->pre_assessment_status : '') == 'Non Admissible as per the Treatment Received' ? 'selected' : '' }}>
                                                    Non Admissible as per the Treatment Received</option>
                                                <option value="Admissible"
                                                    {{ old('pre_assessment_status', isset($assessment_status) ? $assessment_status->pre_assessment_status : '') == 'Admissible' ? 'selected' : '' }}>
                                                    Admissible</option>
                                            </select>
                                            @error('pre_assessment_status')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="query_pre_assessment">Query - Pre-Assessment <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly placeholder="Enter Query - Pre-Assessment"
                                                class="form-control query_pre_assessment" id="query_pre_assessment"
                                                name="query_pre_assessment"
                                                value="{{ old('query_pre_assessment', isset($assessment_status) ? $assessment_status->query_pre_assessment : '') }}">
                                            @error('query_pre_assessment')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="pre_assessment_amount">Pre-Assessment Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" maxlength="8" onkeypress="return isNumberKey(event)"  placeholder="Enter Pre-Assessment Amount"
                                                class="form-control" id="pre_assessment_amount"
                                                name="pre_assessment_amount"
                                                value="{{ old('pre_assessment_amount', isset($assessment_status) ? $assessment_status->pre_assessment_amount : '') }}">
                                            @error('pre_assessment_amount')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="pre_assessment_suspected_fraud">Pre-Assessment Suspected Fraud
                                                <span class="text-danger">*</span></label>

                                            <select onchange="setAssStsus()" class="form-select pre_assessment_suspected_fraud"
                                                id="pre_assessment_suspected_fraud" name="pre_assessment_suspected_fraud">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('pre_assessment_suspected_fraud', isset($assessment_status) ? $assessment_status->pre_assessment_suspected_fraud : '') == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('pre_assessment_suspected_fraud', isset($assessment_status) ? $assessment_status->pre_assessment_suspected_fraud : '') == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>

                                            @error('pre_assessment_suspected_fraud')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="pre_assessment_status_comments">Pre-Assessment Status Comments
                                            </label>
                                            <textarea class="form-control" id="pre_assessment_status_comments" name="pre_assessment_status_comments"
                                                maxlength="250" placeholder="Pre-Assessment Status Comments" rows="5">{{ old('pre_assessment_status_comments', isset($assessment_status) ? $assessment_status->pre_assessment_status_comments : '') }}</textarea>
                                            @error('pre_assessment_status_comments')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success"
                                                form="pre-assessment-status-form">Save / Update Pre-Assessment
                                                Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Final Assessment / Authorization
                            </div>
                            <div class="card-body">
                                <form action="{{ route('super-admin.assessment-status.update-assessment-status', $claim->id) }}"
                                    method="POST" id="final-assessment-status-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="final-assessment-status-form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_status">Final Assessment / Authorization Status <span
                                                    class="text-danger"></span></label>
                                            <select class="form-select final_assessment_status" onchange="setStatusFinal();" id="final_assessment_status"
                                                name="final_assessment_status">
                                                <option value="">Select</option>
                                                <option value="Waiting for Final-Assessment"
                                                    {{ old('final_assessment_status', isset($assessment_status) ? $assessment_status->final_assessment_status : '') == 'Waiting for Pre-Assessment' ? 'selected' : '' }}>
                                                    Waiting for Pre-Assessment </option>
                                                <option value="Query Raised by BHC Team"
                                                    {{ old('final_assessment_status', isset($assessment_status) ? $assessment_status->final_assessment_status : '') == 'Query Raised by BHC Team' ? 'selected' : '' }}>
                                                    Query Raised by BHC Team</option>
                                                    <option value="Non Admissible as per the Policy TC" {{ old('final_assessment_status', isset($assessment_status) ? $assessment_status->final_assessment_status : '') == 'Non Admissible as per the Policy TC' ? 'selected' : '' }}>Non Admissible as per the Policy TC</option>
                                                    <option value="Non Admissible as per the Treatment Received" {{ old('final_assessment_status', isset($assessment_status) ? $assessment_status->final_assessment_status : '') == 'Non Admissible as per the Treatment Received' ? 'selected' : '' }}>Non Admissible as per the Treatment Received</option>
                                                    <option value="Admissible" {{ old('final_assessment_status', isset($assessment_status) ? $assessment_status->final_assessment_status : '') == 'Admissible' ? 'selected' : '' }}>Admissible</option>
                                            </select>
                                            @error('final_assessment_status')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="query_final_assessment">Query - Final Assessment <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Query - Final Assessment" readonly
                                                class="form-control query_final_assessment" id="query_final_assessment"
                                                name="query_final_assessment"
                                                value="{{ old('query_final_assessment', isset($assessment_status) ? $assessment_status->query_final_assessment : @$processing_query) }}">
                                            @error('query_final_assessment')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_amount">Final Assessment / Authorization Amount <span
                                                    class="text-danger"></span></label>
                                            <input type="number" maxlength="8" onkeypress="return isNumberKey(event)" placeholder="Enter Final Assessment / Authorization Amount"
                                                class="form-control" id="final_assessment_amount"
                                                name="final_assessment_amount"
                                                value="{{ old('final_assessment_amount', isset($assessment_status) ? $assessment_status->final_assessment_amount : '0') }}">
                                            @error('final_assessment_amount')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_suspected_fraud">Final Assessment / Authorization Suspected Fraud
                                                <span class="text-danger">*</span></label>

                                            <select class="form-select final_assessment_suspected_fraud"
                                                id="final_assessment_suspected_fraud" onchange="setAssFinaStsus()" name="final_assessment_suspected_fraud">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('final_assessment_suspected_fraud', isset($assessment_status) ? $assessment_status->final_assessment_suspected_fraud : '') == 'Yes' ? 'selected' : '' }}>
                                                    Yes </option>
                                                <option value="No"
                                                    {{ old('final_assessment_suspected_fraud', isset($assessment_status) ? $assessment_status->final_assessment_suspected_fraud : '') == 'No' ? 'selected' : '' }}>
                                                    No</option>
                                            </select>

                                            @error('final_assessment_suspected_fraud')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="final_assessment_status_comments">Final Assessment / Authorization Status Comments
                                            </label>
                                            <textarea class="form-control" id="final_assessment_status_comments" name="final_assessment_status_comments"
                                                maxlength="250" placeholder="Enter Final Assessment / Authorization Status Comments" rows="5">{{ old('final_assessment_status_comments', isset($assessment_status) ? $assessment_status->final_assessment_status_comments : '') }}</textarea>
                                            @error('final_assessment_status_comments')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success"
                                                form="final-assessment-status-form">Authorize Claim</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
     $(document).ready(function() {
            setStatus();
            setAssStsus();
            setAssFinaStsus();
            setStatusFinal();
        });

     function setAssStsus() {
        var status = $("#pre_assessment_suspected_fraud").val();
        if (status == 'Yes') {
            $("#pre_assessment_status").val('Non Admissible as per the Policy TC').trigger('change');
        }
    }

    function setAssFinaStsus() {
        var status = $("#final_assessment_suspected_fraud").val();
        if (status == 'Yes') {
            $("#final_assessment_status").val('Non Admissible as per the Policy TC').trigger('change');
        }
    }

         function setStatus() {
            var status = $("#pre_assessment_status").val();
            switch (status) {
                case 'Query Raised by BHC Team':
                    $("#query_pre_assessment").prop("readonly", false);
                    break;
                default:
                    $("#query_pre_assessment").prop("readonly", true);
                    break;
            }
        }


        function setStatusFinal() {
            var status = $("#final_assessment_status").val();
            switch (status) {
                case 'Query Raised by BHC Team':
                    $("#query_final_assessment").prop("readonly", false);
                    break;
                default:
                    $("#query_final_assessment").prop("readonly", true);
                    break;
            }
        }

         function updateHospitalId(data) {
            var status = $("#hospital_on_the_panel_of_insurance_co").val();

            if(status == 'Yes'){
                $("#hospital_id_insurance_co").val(data);
            }else{
                $("#hospital_id_insurance_co").val('');
            }        
        }


</script>
@endpush
