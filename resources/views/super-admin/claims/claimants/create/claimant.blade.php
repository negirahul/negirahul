@extends('layouts.super-admin')
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
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.claimants.index') }}">Claimant</a>
                            </li>
                            <li class="breadcrumb-item active">New Claimant</li>
                        </ol>
                    </div>
                    <h4 class="page-title">New Claimant</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
            

                <div class="tab-content">
                    <div class="tab-pane show active" id="claimant_tab">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('super-admin.claimants.store') }}" method="post"
                                    id="claimant-id-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="claim_id" name="claim_id"
                                                data-toggle="select2" onchange="setPatient()">
                                                <option value="">Search Claim ID</option>
                                                @foreach ($claims as $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ old('claim_id', isset($claim) ? $claim->id : '') == $row->id ? 'selected' : '' }}
                                                        data-patient-id="{{ $row->patient->uid }}"
                                                        data-asp-id="{{ $row->patient->associate_partner_id }}"
                                                        data-title="{{ $row->patient->title }}"
                                                        data-firstname="{{ $row->patient->firstname }}"
                                                        data-middlename="{{ $row->patient->middlename }}"
                                                        data-address="{{ $row->patient->patient_current_address }}"
                                                        data-city="{{ $row->patient->patient_current_city }}"
                                                        data-state="{{ $row->patient->patient_current_state }}"
                                                        data-pincode="{{ $row->patient->patient_current_pincode }}"
                                                        data-email="{{ $row->patient->email }}"
                                                        data-mobile="{{ $row->patient->phone }}"
                                                        data-lastname="{{ $row->patient->lastname }}"
                                                        data-hospital="{{ $row->patient->hospital->uid }}"
                                                        data-id-prof="{{ $row->patient->id_proof }}"
                                                        data-id-prof-file="{{ $row->patient->id_proof_file }}">
                                                        {{ $row->uid }}
                                                @endforeach
                                            </select>
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="patient_id" name="patient_id"
                                                maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', isset($claim) ? $claim->patient->uid : '') }}"
                                                readonly>
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="associate_partner_id">Associate Partner ID <span
                                                    class="text-danger"></span></label>
                                            <input type="text" class="form-control" id="associate_partner_id"
                                                name="associate_partner_id" placeholder="Associate Partner ID"
                                                value="{{ old('associate_partner_id', isset($claim) ? $claim->patient->associate_partner_id : '') }}"
                                                readonly>
                                            @error('associate_partner_id')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name">Hospital Id <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id"
                                                name="hospital_id" placeholder="Enter Hospital name"
                                                value="{{ old('hospital_id', isset($claim) ? $claim->patient->hospital->uid : '') }}">
                                            @error('hospital_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="patient_firstname">Patient Name {{ old('patient_title') }}<span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="patient_title" name="patient_title">
                                                <option value="">Select</option>
                                                <option value="Mr."
                                                    @if (old('patient_title', isset($claim) ? $claim->patient->title : '') == 'Mr.') selected @endif>Mr.
                                                </option>
                                                <option value="Ms."
                                                    @if (old('patient_title', isset($claim) ? $claim->patient->title : '') == 'Ms.') selected @endif>Ms.
                                                </option>
                                            </select>
                                            @error('patient_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_lastname" name="patient_lastname" maxlength="30"
                                                placeholder="Last name"
                                                value="{{ old('patient_lastname', isset($claim) ? $claim->patient->lastname : '') }}"readonly>
                                            @error('patient_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_firstname" name="patient_firstname" maxlength="15"
                                                placeholder="First name"
                                                value="{{ old('patient_firstname', isset($claim) ? $claim->patient->firstname : '') }}"
                                                readonly>
                                            @error('patient_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_middlename" name="patient_middlename" maxlength="30"
                                                placeholder="Middle name"
                                                value="{{ old('patient_middlename', isset($claim) ? $claim->patient->middlename : '') }}"
                                                readonly>
                                            @error('patient_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="patient_id_proof">Patient ID Proof <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select" id="patient_id_proof"
                                                    name="patient_id_proof">
                                                    <option value="">Select</option>
                                                    <option value="Aadhar Card"
                                                        {{ old('patient_id_proof', isset($claim) ? $claim->patient->id_proof : '') == 'Aadhar Card' ? 'selected' : '' }}>
                                                        Aadhar Card </option>
                                                    <option value="PAN Card"
                                                        {{ old('patient_id_proof', isset($claim) ? $claim->patient->id_proof : '') == 'PAN Card' ? 'selected' : '' }}>
                                                        PAN
                                                        Card </option>
                                                    <option value="Voter's ID"
                                                        {{ old('patient_id_proof', isset($claim) ? $claim->patient->id_proof : '') == "Voter's ID" ? 'selected' : '' }}>
                                                        Voter's ID</option>
                                                    <option
                                                        value="Driving Licence"{{ old('patient_id_proof', isset($claim) ? $claim->patient->id_proof : '') == 'Driving Licence' ? 'selected' : '' }}>
                                                        Driving Licence </option>
                                                    <option value="Passport"
                                                        {{ old('patient_id_proof', isset($claim) ? $claim->patient->id_proof : '') == 'Passport' ? 'selected' : '' }}>
                                                        Passport</option>
                                                </select>
                                                <a id="id-prof-id" style="display:none;" href=""
                                                        download="" class="btn btn-warning download-label"><i
                                                            class="mdi mdi-download"></i></a>
                                            </div>
                                            @error('patient_id_proof')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="policy_type">Policy Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="policy_type" name="policy_type"
                                                onchange="setGroupName();">
                                                <option value="">Select Policy Type</option>
                                                <option value="Group"
                                                    {{ old('policy_type') == 'Group' ? 'selected' : '' }}>Group
                                                </option>
                                                <option value="Retail"
                                                    {{ old('policy_type') == 'Retail' ? 'selected' : '' }}>Retail
                                                </option>
                                            </select>
                                            @error('policy_type')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="group_name">Group Name <span class="text-danger"></span></label>
                                            <input type="text" class="form-control" id="group_name" name="group_name"
                                                placeholder="Enter Group Name" value="{{ old('group_name') }}"
                                                maxlength="75">
                                            @error('group_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="employee_id_or_member_id">Employee ID / Member ID <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="employee_id_or_member_id"
                                                name="employee_id_or_member_id"
                                                placeholder="Enter Employee ID / Member ID"
                                                value="{{ old('employee_id_or_member_id') }}" maxlength="75">
                                            @error('employee_id_or_member_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="are_patient_and_claimant_same">Is Patient and Claimant Same <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="are_patient_and_claimant_same"
                                                name="are_patient_and_claimant_same">
                                                <option value="">Select Are Patient and Claimant Same</option>
                                                <option value="Yes"
                                                    {{ old('are_patient_and_claimant_same') == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('are_patient_and_claimant_same') == 'No' ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                            @error('are_patient_and_claimant_same')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="firstname">Claimant Name<span class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="title" name="title">
                                                <option value="">Select</option>
                                                <option @if (old('title') == 'Mr.') selected @endif value="Mr.">
                                                    Mr.</option>
                                                <option @if (old('title') == 'Ms.') selected @endif value="Ms.">
                                                    Ms.</option>
                                            </select>
                                            @error('title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control" id="lastname"
                                                name="lastname" placeholder="Last name" value="{{ old('lastname') }}">
                                            @error('lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control" id="firstname"
                                                name="firstname" placeholder="First name"
                                                value="{{ old('firstname') }}">
                                            @error('firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control" id="middlename"
                                                name="middlename" placeholder="Middle name"
                                                value="{{ old('middlename') }}">
                                            @error('middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>




                                        <div class="col-md-6 mt-3">
                                            <label for="pan_no">Claimant Pan No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="pan_no" name="pan_no"
                                                    maxlength="10" placeholder="Enter PAN no."
                                                    value="{{ old('pan_no') }}">
                                                
                                            </div>
                                            @error('pan_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="aadhar_no">Claimant Aadhar No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==12) return false;"
                                                    class="form-control" id="aadhar_no" name="aadhar_no" maxlength="12"
                                                    placeholder="Enter Aadhar no." value="{{ old('aadhar_no') }}">
                                                
                                            </div>
                                            @error('aadhar_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="patients_relation_with_claimant">Patient's Relation with Claimant
                                                <span class="text-danger">*</span></label>
                                            <select class="form-select" id="patients_relation_with_claimant"
                                                name="patients_relation_with_claimant" onchange="setSpecify()">
                                                <option value="">Select Patient's Relation with Claimant</option>
                                                <option value="Self"
                                                    {{ old('patients_relation_with_claimant') == 'Self' ? 'selected' : '' }}>
                                                    Self </option>
                                                <option value="Spouse"
                                                    {{ old('patients_relation_with_claimant') == 'Spouse' ? 'selected' : '' }}>
                                                    Spouse </option>
                                                <option value="Child"
                                                    {{ old('patients_relation_with_claimant') == 'Child' ? 'selected' : '' }}>
                                                    Child</option>
                                                <option value="Father"
                                                    {{ old('patients_relation_with_claimant') == 'Father' ? 'selected' : '' }}>
                                                    Father</option>
                                                <option value="Mother"
                                                    {{ old('patients_relation_with_claimant') == 'Mother' ? 'selected' : '' }}>
                                                    Mother</option>
                                                <option value="Other"
                                                    {{ old('patients_relation_with_claimant') == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('patients_relation_with_claimant')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="specify">Please Specify <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="specify" name="specify"
                                                placeholder="Specify here" value="{{ old('specify') }}">
                                            @error('specify')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="address">Claimant Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Address Line" value="{{ old('address') }}" maxlength="100">
                                            @error('address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="text" class="form-control" id="city" name="city"
                                                placeholder="City" value="{{ old('city') }}">
                                            @error('city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="text" class="form-control" id="state" name="state"
                                                placeholder="State" value="{{ old('state') }}">
                                            @error('state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="number" class="form-control" id="pincode" name="pincode"
                                                placeholder="Pincode" value="{{ old('pincode') }}">
                                            @error('pincode')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="personal_email_id">Claimant Personal email id <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="personal_email_id"
                                                name="personal_email_id" maxlength="45"
                                                placeholder="Enter Claimant Personal email id"
                                                value="{{ old('personal_email_id') }}">
                                            @error('personal_email_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="official_email_id">Claimant official email id<span
                                                    class="text-danger"></span></label>
                                            <input type="email" class="form-control" id="official_email_id"
                                                name="official_email_id" maxlength="45"
                                                placeholder="Enter Claimant official email id"
                                                value="{{ old('official_email_id') }}">
                                            @error('official_email_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="mobile_no">Claimant Mobile No. <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <label class="input-group-text" for="mobile_no">+91</label>
                                                <input type="number" class="form-control" id="mobile_no"
                                                    name="mobile_no" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false;"
                                                    placeholder="Enter Claimant Mobile No."
                                                    value="{{ old('mobile_no') }}">
                                            </div>
                                            @error('mobile_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="estimated_amount">Estimated Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="estimated_amount"
                                                name="estimated_amount" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==8) return false;"
                                                placeholder="Enter Estimated Amount"
                                                value="{{ old('estimated_amount') }}">
                                            @error('estimated_amount')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="address">Claimant Cancel Cheque / Pass Book <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="input-group">
                                                <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                                                    <option value="">Select Claimant Cancel Cheque / Pass Book</option>
                                                    <option value="Yes"
                                                        {{ old('cancel_cheque') == 'Yes' ? 'selected' : '' }}>Yes </option>
                                                    <option value="No"
                                                        {{ old('cancel_cheque', @$hospital->cancel_cheque) == 'No' ? 'selected' : '' }}>
                                                        No </option>
                                                </select>
                                                
                                            </div>

                                            @error('cancel_cheque')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="address">Claimant Bank Details <span
                                                    class="text-danger">*</span></label>
                                        </div>


                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="bank_name" name="bank_name"
                                                maxlength="45" placeholder="Bank Name" value="{{ old('bank_name') }}">
                                            @error('bank_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="bank_address"
                                                name="bank_address" maxlength="80" placeholder="Bank Address"
                                                value="{{ old('bank_address') }}">
                                            @error('bank_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <input type="text" class="form-control" id="ac_no" name="ac_no"
                                                maxlength="20" placeholder="Bank Account No."
                                                value="{{ old('ac_no') }}">
                                            @error('ac_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <input type="text" class="form-control" id="ifs_code" name="ifs_code"
                                                maxlength="11" placeholder="Bank Ifs Code"
                                                value="{{ old('ifs_code') }}">
                                            @error('ifs_code')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="comments">Claimant Comments </label>
                                            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Claimant Comments"
                                                rows="5">{{ old('comments') }}</textarea>
                                            @error('comments')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success" form="claimant-id-form">Create
                                                / Save Claimant ID</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="borrower_creation_tab">
                        <p>...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            setPatient();
            setSpecify();
        });

        function setPatient() {
            var title = $("#claim_id").select2().find(":selected").data("title");
            var id = $("#claim_id").select2().find(":selected").val();
            var patient_id = $("#claim_id").select2().find(":selected").data("patient-id");
            var firstname = $("#claim_id").select2().find(":selected").data("firstname");
            var asp_id = $("#claim_id").select2().find(":selected").data("asp-id");
            var middlename = $("#claim_id").select2().find(":selected").data("middlename");
            var lastname = $("#claim_id").select2().find(":selected").data("lastname");
            var age = $("#claim_id").select2().find(":selected").data("age");
            var gender = $("#claim_id").select2().find(":selected").data("gender");
            var hospital = $("#claim_id").select2().find(":selected").data("hospital");
            var idprof = $("#claim_id").select2().find(":selected").data("id-prof");
            var idproffile = $("#claim_id").select2().find(":selected").data("id-prof-file");
            $('#patient_id').val(patient_id);
            $('#patient_id_proof').val(idprof);
            // $('#id-prof-id').css('display', 'block').attr('href', ff);
            $('#associate_partner_id').val(asp_id);
            $('#patient_title').val(title);
            $('#patient_firstname').val(firstname);
            $('#patient_middlename').val(middlename);
            $('#patient_lastname').val(lastname);
            $('#patient_age').val(age);
            $('#patient_gender').val(gender);
            $('#hospital_id').val(hospital).trigger('change');
            if(patient_id){
            $.ajax({
            url: "{{url('super-admin/claimants/patient/')}}/"+patient_id,
            type: "GET",
            data: {
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function (result) {
                if(result.id_proof_file && result.id_proof_file !=null){
                    var ff = "{{ asset('storage/uploads/patient/') }}"+"/"+id+'/'+result.id_proof_file;
                    $("#id-prof-id").css('display', 'block').attr('href', ff );
                }
            }
        });
    }

        }
    </script>
    <script>
        function setSpecify() {
            var occupation = $('#patients_relation_with_claimant').val();
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

        $('#are_patient_and_claimant_same').on('change', function() {
            var idCountry = this.value;
            if (idCountry == 'Yes') {

                var title = $("#claim_id").select2().find(":selected").data("title");
                var firstname = $("#claim_id").select2().find(":selected").data("firstname");
                var middlename = $("#claim_id").select2().find(":selected").data("middlename");
                var lastname = $("#claim_id").select2().find(":selected").data("lastname");
                var address = $("#claim_id").select2().find(":selected").data("address");
                var city = $("#claim_id").select2().find(":selected").data("city");
                var state = $("#claim_id").select2().find(":selected").data("state");
                var pincode = $("#claim_id").select2().find(":selected").data("pincode");
                var email = $("#claim_id").select2().find(":selected").data("email");
                var mobile = $("#claim_id").select2().find(":selected").data("mobile");

                $('#patients_relation_with_claimant').val('Self').trigger('change');
                $('#title').val(title).trigger('change');
                $('#firstname').val(firstname);
                $('#middlename').val(middlename);
                $('#lastname').val(lastname);
                $('#address').val(address);
                $('#city').val(city);
                $('#state').val(state);
                $('#pincode').val(pincode);
                $('#personal_email_id').val(email);
                $('#mobile_no').val(mobile);

            } else {

                $('#patients_relation_with_claimant').val('').trigger('change');
                $('#title').val('').trigger('change');
                $('#firstname').val('');
                $('#middlename').val('');
                $('#lastname').val('');
                $('#address').val('');
                $('#city').val('');
                $('#state').val('');
                $('#pincode').val('');
                $('#personal_email_id').val('');
                $('#mobile_no').val('');

            }
        });


        function setGroupName() {
            var policy_type = $('#policy_type').val();
            switch (policy_type) {
                case 'Group':
                    $("#employee_id_or_member_id").prop("readonly", false);
                    break;
                case 'Retail':
                    $("#employee_id_or_member_id").prop("readonly", true);
                    break;
                default:
                    $("#employee_id_or_member_id").prop("readonly", true);
                    break;
            }
        }

        $(document).ready(function() {
                setGroupName();
            });
    </script>
@endpush
