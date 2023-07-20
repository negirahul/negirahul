@extends('layouts.hospital')
@section('title', 'New Claimant')
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
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claimants.index') }}">Lending Status</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($lending_status) && !empty($lending_status)) Edit @else New @endif Lending Status</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if(isset($lending_status) && !empty($lending_status)) Edit @else New @endif Lending Status</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">


                <div class="tab-content">
                    <div class="tab-pane show active" id="lending_status_tab">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Loan Application
                            </div>
                            <div class="card-body">
                                <form action="{{ route('hospital.lending-status.lending-status-update', $borrower->id) }}"
                                    method="POST" id="loan-application-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="loan-application-form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <label for="borrower_id">Borrower ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="borrower_id"
                                                name="borrower_id" maxlength="60" placeholder="Enter Borrower Id"
                                                value="{{ old('borrower_id', @$borrower->uid) }}">
                                            @error('borrower_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id" readonly
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$borrower->patient->uid) }}">
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claim_id" readonly
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$borrower->claim->uid) }}">
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hospital_name" readonly
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$borrower->hospital->name) }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="hospital_address">Hospital Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hospital_address" readonly
                                                name="hospital_address" placeholder="Address Line"
                                                value="{{ old('hospital_address', @$borrower->hospital->address) }}">
                                            @error('hospital_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="hospital_city" readonly
                                                name="hospital_city" placeholder="City"
                                                value="{{ old('hospital_city', @$borrower->hospital->city) }}">
                                            @error('hospital_city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="hospital_state" readonly
                                                name="hospital_state" placeholder="State"
                                                value="{{ old('hospital_state', @$borrower->hospital->state) }}">
                                            @error('hospital_state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="number" class="form-control" id="hospital_pincode" readonly
                                                name="hospital_pincode" placeholder="Pincode"
                                                value="{{ old('hospital_pincode', @$borrower->hospital->pincode) }}">
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
                                            <select class="form-control" id="patient_title" name="patient_title"
                                                readonly>
                                                <option value="">Select</option>
                                                <option @if (old('patient_title', @$borrower->patient->title) == 'Mr.') selected @endif value="Mr.">
                                                    Mr.</option>
                                                <option @if (old('patient_title', @$borrower->patient->title) == 'Ms.') selected @endif value="Ms.">
                                                    Ms.</option>
                                            </select>
                                            @error('patient_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_lastname" name="patient_lastname" maxlength="30" readonly
                                                placeholder="Last name"
                                                value="{{ old('patient_lastname', @$borrower->patient->lastname) }}">
                                            @error('patient_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_firstname" name="patient_firstname" maxlength="15" readonly
                                                placeholder="First name"
                                                value="{{ old('patient_firstname', @$borrower->patient->firstname) }}">
                                            @error('patient_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_middlename" name="patient_middlename" maxlength="30" readonly
                                                placeholder="Middle name"
                                                value="{{ old('patient_middlename', @$borrower->patient->middlename) }}">
                                            @error('patient_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="patient_firstname">Borrower Name <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="borrower_title" name="borrower_title"
                                                readonly>
                                                <option value="">Select</option>
                                                <option @if (old('borrower_title', @$borrower->borrower_title) == 'Mr.') selected @endif value="Mr.">
                                                    Mr.</option>
                                                <option @if (old('borrower_title', @$borrower->borrower_title) == 'Ms.') selected @endif value="Ms.">
                                                    Ms.</option>
                                            </select>
                                            @error('borrower_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="borrower_lastname" name="borrower_lastname" maxlength="30" readonly
                                                placeholder="Last name"
                                                value="{{ old('borrower_lastname', @$borrower->borrower_lastname) }}">
                                            @error('borrower_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="borrower_firstname" name="borrower_firstname" maxlength="15" readonly
                                                placeholder="First name"
                                                value="{{ old('borrower_firstname', @$borrower->borrower_firstname) }}">
                                            @error('borrower_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="borrower_middlename" name="borrower_middlename" maxlength="30" readonly
                                                placeholder="Middle name"
                                                value="{{ old('borrower_middlename', @$borrower->borrower_middlename) }}">
                                            @error('borrower_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_email_id">Borrower Personal email id <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" readonly id="borrower_email_id"
                                                name="borrower_email_id" maxlength="45"
                                                placeholder="Enter Borrower Personal email id"
                                                value="{{ old('borrower_email_id', @$borrower->borrower_personal_email_id) }}">
                                            @error('borrower_email_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_official_email_id">Borrower official email id<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" readonly
                                                id="borrower_official_email_id" name="borrower_official_email_id"
                                                maxlength="45" placeholder="Enter Borrower official email id"
                                                value="{{ old('borrower_official_email_id', @$borrower->borrower_official_email_id) }}">
                                            @error('borrower_official_email_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_mobile_no">Borrower Mobile No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <label class="input-group-text" for="borrower_mobile_no">+91</label>
                                                <input type="number" class="form-control" id="borrower_mobile_no"
                                                    readonly name="borrower_mobile_no" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false;"
                                                    placeholder="Borrower Mobile No."
                                                    value="{{ old('borrower_mobile_no', @$borrower->borrower_mobile_no) }}">
                                            </div>
                                            @error('borrower_mobile_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_pan_no">Borrower Pan No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="borrower_pan_no"
                                                    name="borrower_pan_no" maxlength="10" placeholder="Enter PAN no."
                                                    readonly
                                                    value="{{ old('borrower_pan_no', @$borrower->borrower_pan_no) }}">

                                            </div>
                                            @error('borrower_pan_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_aadhar_no">Borrower Aadhar No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==12) return false;"
                                                    class="form-control" id="borrower_aadhar_no"
                                                    name="borrower_aadhar_no" maxlength="12"
                                                    placeholder="Enter Aadhar no." readonly
                                                    value="{{ old('borrower_aadhar_no', @$borrower->borrower_aadhar_no) }}">
                                            </div>
                                            @error('borrower_aadhar_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="estimated_amount">Estimated Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="estimated_amount" readonly
                                                name="estimated_amount" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==8) return false;"
                                                placeholder="Enter Estimated Amount"
                                                value="{{ old('estimated_amount', @$borrower->borrower_estimated_amount) }}">
                                            @error('estimated_amount')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_amount">Final Assessment Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" readonly class="form-control"
                                                id="final_assessment_amount" name="final_assessment_amount"
                                                pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==8) return false;"
                                                placeholder="Enter Estimated Amount"
                                                value="{{ old('final_assessment_amount', @$assessment->final_assessment_amount) }}">
                                            @error('final_assessment_amount')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="medical_lending_type">Medical Lending Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" disabled id="medical_lending_type"
                                                name="medical_lending_type">
                                                <option value="">Select</option>
                                                <option value="Bridge"
                                                    {{ old('medical_lending_type', isset($lending_status) ? $lending_status->medical_lending_type : '') == 'Bridge' ? 'selected' : '' }}>Bridge
                                                </option>
                                                <option value="Term"
                                                    {{ old('medical_lending_type', isset($lending_status) ? $lending_status->medical_lending_type : '') == 'Term' ? 'selected' : '' }}>Term
                                                </option>
                                                <option value="Both"
                                                    {{ old('medical_lending_type', isset($lending_status) ? $lending_status->medical_lending_type : '') == 'Both' ? 'selected' : '' }}>Both
                                                </option>
                                            </select>
                                            @error('medical_lending_type')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="vendor_partner_name_nbfc_or_bank">Vendor Partner Name (NBFC/Bank)
                                                <span class="text-danger">*</span></label>
                                            <select class="form-control select2" disabled data-toggle="select2" id="vendor_partner_name_nbfc_or_bank" name="vendor_partner_name_nbfc_or_bank">
                                                <option value="">Please Select</option>
                                                @foreach ($associates as $associates)
                                                    <option value="{{ $associates->name }}"
                                                        {{ old('vendor_partner_name_nbfc_or_bank', isset($lending_status) ? $lending_status->vendor_partner_name_nbfc_or_bank : '') == $associates->name ? 'selected' : '' }}
                                                        data-code="{{ $associates->associate_partner_id }}">
                                                        {{ $associates->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('vendor_partner_name_nbfc_or_bank')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="vendor_partner_id">Vendor Partner ID<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="vendor_partner_id" name="vendor_partner_id" maxlength="30"
                                                placeholder="Vendor Partner ID"
                                                value="{{ old('vendor_partner_id', isset($lending_status) ? $lending_status->vendor_partner_id : '') }}">
                                            @error('vendor_partner_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3" style="display:none;">
                                            <label for="loan_application_comments">Loan application Comments </label>
                                            <textarea readonly class="form-control" id="loan_application_comments" name="loan_application_comments" maxlength="250"
                                                placeholder="Loan application Comments" rows="5">{{ old('loan_application_comments', isset($lending_status) ? $lending_status->loan_application_comments : '') }}</textarea>
                                            @error('loan_application_comments')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3" style="display:none;">
                                            <button type="submit" disabled class="btn btn-success"
                                                form="loan-application-form">
                                                Save Lending Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 text-end mt-3" style="display:none;">
                                <button type="submit" disabled class="btn btn-success" id="apply_loan"
                                form="loan-application-form"> Apply Loan</button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Loan Application Status
                            </div>
                            <div class="card-body">
                                <form action="{{ route('hospital.lending-status.lending-status-update', $borrower->id) }}"
                                    method="POST" id="loan-application-status-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="loan-application-status-form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mt-3">
                                            <label for="date_of_loan_application">Date of Loan Application (DD/MM/YYYY)<span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" disabled id="date_of_loan_application" name="date_of_loan_application"
                                            value="{{ old('date_of_loan_application', isset($lending_status) ? ( !empty($lending_status->date_of_loan_application) ? $lending_status->date_of_loan_application : date('d-m-Y') ) : date('d-m-Y')) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                                            @error('date_of_loan_application')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="time_of_loan_application">Time of Loan Application (HH:MM) <span class="text-danger">*</span></label>
                                            <input type="time" readonly class="form-control" id="time_of_loan_application" disabled name="time_of_loan_application" value="{{ old('time_of_loan_application', isset($lending_status) ? ( !empty($lending_status->time_of_loan_application) ? $lending_status->time_of_loan_application : date('H:i') ) : date('H:i')) }}" >

                                            @error('time_of_loan_application')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_of_loan_re_application">Date of Loan Re-Application (DD/MM/YYYY)</label>
                                            <input type="text" readonly class="form-control" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy" id="date_of_loan_re_application" @if(empty(@$lending_status->loan_id_or_no)) disabled @endif name="date_of_loan_re_application" value="{{ old('date_of_loan_re_application', isset($lending_status) ? ( !empty($lending_status->date_of_loan_re_application) ? $lending_status->date_of_loan_re_application : date('d-m-Y') ) : date('d-m-Y')) }}">

                                            @error('date_of_loan_re_application')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="time_of_loan_re_application">Time of Loan Re-Application (HH:MM) </label>
                                            <input type="time" readonly class="form-control" id="time_of_loan_re_application" @if(empty(@$lending_status->loan_id_or_no)) disabled @endif name="time_of_loan_re_application" value="{{ old('time_of_loan_re_application', isset($lending_status) ? ( !empty($lending_status->time_of_loan_re_application) ? $lending_status->time_of_loan_re_application : date('H:i') ) : date('H:i')) }}" >

                                            @error('time_of_loan_re_application')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_id_or_no">Loan ID / No.<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" readonly maxlength="20" class="form-control" id="loan_id_or_no"
                                                name="loan_id_or_no" placeholder="Enter Loan ID / No." readonly  value="{{ old('loan_id_or_no', isset($lending_status) ? $lending_status->loan_id_or_no : '') }}">
                                            </div>
                                            @error('loan_id_or_no')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_status">Loan Status {{ old('loan_status') }}<span class="text-danger">*</span></label>
                                            <select class="form-select" disabled id="loan_status" name="loan_status" >
                                                {{-- <option value="">Select</option> --}}
                                                <option value="Waiting for the Approval" {{ old('loan_status', isset($lending_status) ? $lending_status->loan_status : 'Waiting for the Approval') == 'Waiting for the Approval' ? 'selected' : '' }}>Waiting for the Approval </option>
                                                <option value="Approved" {{ old('loan_status', isset($lending_status) ? $lending_status->loan_status : '') == 'Approved' ? 'selected' : '' }}>Approved </option>
                                                <option value="Rejected" {{ old('loan_status', isset($lending_status) ? $lending_status->loan_status : '') == 'Rejected' ? 'selected' : '' }}>Rejected </option>
                                                <option value="Re-applied" {{ old('loan_status', isset($lending_status) ? $lending_status->loan_status : '') == 'Re-applied' ? 'selected' : '' }} @if(isset($lending_status) && !empty($lending_status->date_of_loan_re_application)) selected @endif>Re-applied </option>
                                            </select>
                                            @error('loan_status')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_approved_amount">Loan Approved Amount </label>
                                            <div class="input-group">
                                                <input type="text" readonly maxlength="8" onkeypress="return isNumberKey(event)" class="form-control" id="loan_approved_amount"
                                                name="loan_approved_amount" maxlength="30" readonly placeholder="Enter Loan Approved Amount"  value="{{ old('loan_approved_amount', isset($lending_status) ? $lending_status->loan_approved_amount : '') }}">
                                            </div>
                                            @error('loan_approved_amount')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_disbursed_amount">Loan Disbursed Amount</label>
                                            <input type="text" readonly maxlength="8" onkeypress="return isNumberKey(event)" class="form-control" id="loan_disbursed_amount" readonly 
                                            name="loan_disbursed_amount" maxlength="30" placeholder="Loan Disbursed Amount"  value="{{ old('loan_disbursed_amount', isset($lending_status) ? $lending_status->loan_disbursed_amount : '') }}">
                                            @error('loan_disbursed_amount')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_of_loan_disbursement">Date of Loan Disbursement (DD/MM/YYYY)</label>
                                            <input type="text" readonly class="form-control" id="date_of_loan_disbursement" disabled name="date_of_loan_disbursement"
                                            value="{{ old('date_of_loan_disbursement', isset($lending_status) ? $lending_status->date_of_loan_disbursement : '') }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                                            @error('date_of_loan_disbursement')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="loan_tenure">Loan Tenure</label>
                                            <input type="text" readonly readonly maxlength="2" onkeypress="return isNumberKey(event)" placeholder="Loan Tenure" class="form-control" id="loan_tenure" name="loan_tenure"
                                            value="{{ old('loan_tenure', isset($lending_status) ? $lending_status->loan_tenure : '') }}">

                                            @error('loan_tenure')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_instalments">Loan Installments</label>
                                            <input type="text" readonly maxlength="2" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Enter Loan Installments" readonly id="loan_instalments" name="loan_instalments"
                                            value="{{ old('loan_instalments', isset($lending_status) ? $lending_status->loan_instalments : '') }}">

                                            @error('loan_instalments')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 mt-3">
                                            <label for="loan_start_date">Loan Start Date  (DD/MM/YYYY)</label>
                                            <input type="text" readonly class="form-control" disabled id="loan_start_date" name="loan_start_date"
                                            value="{{ old('loan_start_date', isset($lending_status) ? $lending_status->loan_start_date : '') }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                                            @error('loan_start_date')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="loan_end_date">Loan End Date  (DD/MM/YYYY)</label>
                                            <input type="text" readonly class="form-control" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy" disabled id="loan_end_date" name="loan_end_date"
                                            value="{{ old('loan_end_date', isset($lending_status) ? $lending_status->loan_end_date : '') }}">

                                            @error('loan_end_date')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="insurance_claim_settlement_date">Insurance Claim Settlement Date (DD/MM/YYYY)</label>
                                            <input type="text" readonly class="form-control" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy"  disabled id="insurance_claim_settlement_date" name="insurance_claim_settlement_date"
                                            value="{{ old('insurance_claim_settlement_date', isset($lending_status) ? $lending_status->insurance_claim_settlement_date : '') }}">

                                            @error('insurance_claim_settlement_date')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="insurance_claim_settled_amount">Insurance Claim Settled Amount</label>
                                            <div class="input-group">
                                                <input type="number" readonly class="form-control" id="insurance_claim_settled_amount" placeholder="Enter Insurance Claim Settled Amount" name="insurance_claim_settled_amount" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;"
                                                value="{{ old('insurance_claim_settled_amount', isset($lending_status) ? $lending_status->insurance_claim_settled_amount : '') }}">
                                            </div>
                                            @error('insurance_claim_settled_amount')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 mt-3">
                                            <label for="insurance_claim_amount_disbursement_date">Insurance Claim Amount Disbursement Date(DD/MM/YYYY)</label>
                                            <div class="input-group">
                                            <input type="text" readonly placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy" class="form-control" disabled id="insurance_claim_amount_disbursement_date" name="insurance_claim_amount_disbursement_date"
                                            value="{{ old('insurance_claim_amount_disbursement_date', isset($lending_status) ? $lending_status->insurance_claim_amount_disbursement_date : '') }}">
                                            </div>
                                            @error('insurance_claim_amount_disbursement_date')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3" style="display:none;">
                                            <label for="loan_application_status_comments">Loan Application Status comments </label>
                                            <textarea class="form-control" readonly id="loan_application_status_comments" name="loan_application_status_comments" maxlength="250" placeholder="Loan Application Status comments"
                                            rows="5">{{ old('loan_application_status_comments', isset($lending_status) ? $lending_status->loan_application_status_comments : '') }}</textarea>
                                            @error('loan_application_status_comments')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="applyloan" id="applyloan" value="{{ old('applyloan', 0) }}">

                                        <div class="col-md-12 text-end mt-3 mb-2" style="display:none;">
                                            <button type="submit" class="btn btn-success" disabled form="loan-application-status-form">
                                            Save / Update Loan Application Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Loan Re-application Status
                            </div>
                            <div class="card-body">
                                <form action="{{ route('hospital.lending-status.lending-status-update', $borrower->id) }}"
                                    method="POST" id="loan-reapplication-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="loan-reapplication-form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mt-1">
                                            <label for="re_apply_loan_amount">Re-apply Loan Amount</label>
                                            <input type="text" readonly maxlength="8" onkeypress="return isNumberKey(event)" class="form-control" @if(empty(@$lending_status->loan_id_or_no)) readonly @endif id="re_apply_loan_amount" name="re_apply_loan_amount"
                                            value="{{ old('re_apply_loan_amount', isset($lending_status) ? $lending_status->re_apply_loan_amount : '') }}">

                                            @error('re_apply_loan_amount')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-1" style="display:none;">
                                            <label for="loan_re_application_status_comments">Loan Re-application Status comments</label>
                                            <input type="text" readonly class="form-control" @if(empty(@$lending_status->loan_id_or_no)) readonly @endif  id="loan_re_application_status_comments" name="loan_re_application_status_comments"
                                            value="{{ old('loan_re_application_status_comments', isset($lending_status) ? $lending_status->loan_re_application_status_comments : '') }}">

                                            @error('loan_re_application_status_comments')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3"  style="display:none;">
                                            <button type="submit" disabled @if(empty(@$lending_status->loan_id_or_no)) disabled @endif class="btn btn-success" form="loan-reapplication-form">
                                            Re-apply Loan</button>
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
$(document).on('change', '#vendor_partner_name_nbfc_or_bank', function(event) {
    event.preventDefault();
    $('#vendor_partner_id').val($(this).select2().find(":selected").data("code"));
});

if($("#applyloan").val() == 1){
         setClaimant();
}

function setClaimant() {

          $('#applyloan').val(1);
          $('#date_of_loan_application').removeAttr('disabled');
          $('#date_of_loan_disbursement').removeAttr('disabled');
          $('#time_of_loan_application').removeAttr('disabled');
          // $('#date_of_loan_re_application').removeAttr('disabled');
          // $('#time_of_loan_re_application').removeAttr('disabled');
          $('#loan_id_or_no').removeAttr('readonly');
          $('#loan_status').removeAttr('disabled');
          $('#loan_approved_amount').removeAttr('readonly');
          $('#loan_disbursed_amount').removeAttr('readonly');
          $('#loan_tenure').removeAttr('readonly');
          $('#loan_instalments').removeAttr('readonly');
          $('#loan_start_date').removeAttr('disabled');
          $('#loan_end_date').removeAttr('disabled');
          $('#insurance_claim_settlement_date').removeAttr('disabled');
          $('#insurance_claim_settled_amount').removeAttr('readonly');
          $('#insurance_claim_amount_disbursement_date').removeAttr('disabled');
          $('#loan_application_status_comments').removeAttr('readonly');
          // $('#re_apply_loan_amount').removeAttr('readonly');
          // $('#loan_re_application_status_comments').removeAttr('readonly');

}
        $('#apply_loan').on('click',function(e){
         e.preventDefault();
         setClaimant();

        });
</script>

<script>
        $(function(){

            $('#date_of_loan_application').datepicker({
                startDate: '+0d',
                autoclose: true,
            });

             $('#loan_start_date').datepicker({
                endDate: '+0d',
                autoclose: true,
            });

              $('#insurance_claim_settlement_date').datepicker({
                endDate: '+0d',
                autoclose: true,
            });

            $('#date_of_loan_re_application').datepicker({
                startDate: '+0d',
                autoclose: true,
            });

        });
    </script>

@endpush
