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
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claimants.index') }}">Borrower</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($borrower) && !empty($borrower)) Edit @else New @endif Borrower</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if(isset($borrower) && !empty($borrower)) Edit @else New @endif Borrower</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills  bg-nav-pills  nav-justified mb-3">
                    <li class="nav-item">
                        <a href="{{ route('hospital.claimants.edit', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-home-variant d-md-none d-block"></i>
                            <span class="d-none d-md-block">Claimant ID Creation / Intimation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hospital.borrowers.show', $claimant->id) }}" aria-expanded="true"
                            class="nav-link rounded-0 active">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Borrower ID Creation</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('hospital.lending-status.show', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Lending Status</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('hospital.assessment-status.show', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Assessment Status</span>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('hospital.discharge-status.show', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Discharge Status</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hospital.claim-processing.show', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
                            <i class="mdi mdi-account-circle d-md-none d-block"></i>
                            <span class="d-none d-md-block">Claim Processing</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane show active" id="borrower_creation_tab">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('hospital.borrowers.update', $claimant->id) }}" method="POST"
                                    id="borrower-details-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id"
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$claimant->patient->uid) }}">
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claim_id"
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$claimant->claim->uid) }}">
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="claimant_id">Claimant ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claimant_id"
                                                name="claimant_id" maxlength="60" placeholder="Enter Claimant ID"
                                                value="{{ old('claimant_id', $claimant->uid) }}">
                                            @error('claimant_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id"
                                                name="hospital_id" placeholder="Enter Hospital Id"
                                                value="{{ old('hospital_id', $claimant->hospital->uid) }}">
                                            @error('hospital_id')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$claimant->hospital->name) }}" readonly>
                                            @error('hospital_name')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="hospital_address">Hospital Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hospital_address"
                                                name="hospital_address" placeholder="Address Line"
                                                value="{{ old('hospital_address', @$claimant->hospital->address) }}"
                                                readonly>
                                            @error('hospital_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="hospital_city"
                                                name="hospital_city" placeholder="City"
                                                value="{{ old('hospital_city', @$claimant->hospital->city) }}" readonly>
                                            @error('hospital_city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="hospital_state"
                                                name="hospital_state" placeholder="State"
                                                value="{{ old('hospital_state', @$claimant->hospital->state) }}" readonly>
                                            @error('hospital_state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="number" class="form-control" id="hospital_pincode"
                                                name="hospital_pincode" placeholder="Pincode"
                                                value="{{ old('hospital_pincode', @$claimant->hospital->pincode) }}"
                                                readonly>
                                            @error('hospital_pincode')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="patient_firstname">Patient Name <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1 mb-3">
                                            <select class="form-control" id="patient_title" name="patient_title">
                                                <option value="">Select</option>
                                                <option @if (old('patient_title', @$claimant->patient->title) == 'Mr.') selected @else disabled @endif
                                                    value="Mr.">Mr.</option>
                                                <option @if (old('patient_title', @$claimant->patient->title) == 'Ms.') selected @else disabled @endif
                                                    value="Ms.">Ms.</option>
                                            </select>
                                            @error('patient_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1 mb-3">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_lastname" name="patient_lastname" maxlength="30"
                                                placeholder="Last name"
                                                value="{{ old('patient_lastname', @$claimant->patient->lastname) }}"
                                                readonly>
                                            @error('patient_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1 mb-3">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_firstname" name="patient_firstname" maxlength="15"
                                                placeholder="First name"
                                                value="{{ old('patient_firstname', @$claimant->patient->firstname) }}"
                                                readonly>
                                            @error('patient_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1 mb-3">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="patient_middlename" name="patient_middlename" maxlength="30"
                                                placeholder="Middle name"
                                                value="{{ old('patient_middlename', @$claimant->patient->middlename) }}"
                                                readonly>
                                            @error('patient_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="policy_no">Policy No. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="policy_no" name="policy_no"
                                                maxlength="16" placeholder="Enter Policy No."
                                                value="{{ old('policy_no', $claimant->claim->policy_no) }}" readonly>
                                            @error('policy_no')
                                                <span id="policy-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="insurance_company">Insurance Company<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="insurance_company"
                                                name="insurance_company" data-toggle="select2">
                                                <option value="">Select Insurance Company</option>
                                                @foreach ($insurers as $insurer)
                                                    <option value="{{ $insurer->id }}"
                                                        {{ old('insurance_company', @$claimant->claim->policy->insurer_id) == $insurer->id ? 'selected' : 'disabled' }}>
                                                        {{ $insurer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('insurance_company')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="policy_name">Policy Name <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control select2" id="policy_name" name="policy_name"
                                                data-toggle="select2">
                                                <option value="">Select Policy</option>
                                                @foreach ($insurers as $insurer)
                                                    <option value="{{ $insurer->id }}"
                                                        {{ old('policy_name', @$claimant->claim->policy->policy_id) == $insurer->id ? 'selected' : 'disabled' }}>
                                                        {{ $insurer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('policy_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="certificate_no">SI No. / Certificate No. <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control"
                                                id="certificate_no" placeholder="SI No. / Certificate No."
                                                name="certificate_no"
                                                value="{{ old('certificate_no', @$claimant->claim->policy->certificate_no) }}"
                                                readonly>
                                            @error('certificate_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="company_tpa_id_card_no">Company / TPA ID Card No. <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control"
                                                id="company_tpa_id_card_no" placeholder="Company / TPA ID Card No."
                                                name="company_tpa_id_card_no"
                                                value="{{ old('company_tpa_id_card_no', @$claimant->claim->company_tpa_id_card_no) }}"
                                                readonly>
                                            @error('company_tpa_id_card_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tpa_name">TPA Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tpa_name" name="tpa_name"
                                                placeholder="Enter TPA Name"
                                                value="{{ old('tpa_name', @$claimant->claim->policy->tpa_name) }}"
                                                maxlength="75" readonly>
                                            @error('tpa_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="policy_type">Policy Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="policy_type" name="policy_type"
                                                onchange="setGroupName();">
                                                <option value="">Select Policy Type</option>
                                                <option value="Group"
                                                    {{ old('policy_type', @$claimant->claim->policy->policy_type) == 'Group' ? 'selected' : 'disabled' }}>
                                                    Group
                                                </option>
                                                <option value="Retail"
                                                    {{ old('policy_type', @$claimant->claim->policy->policy_type) == 'Retail' ? 'selected' : 'disabled' }}>
                                                    Retail
                                                </option>
                                            </select>
                                            @error('policy_type')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6 mt-3">
                                            <label for="is_patient_and_borrower_same">Is Patient and Borrower Same
                                                <span class="text-danger">*</span></label>
                                            <select class="form-select" id="is_patient_and_borrower_same"
                                                name="is_patient_and_borrower_same"
                                                onchange="patientBorrowerSameOptions();">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('is_patient_and_borrower_same', @$borrower->is_patient_and_borrower_same) == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('is_patient_and_borrower_same', @$borrower->is_patient_and_borrower_same) == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            @error('is_patient_and_borrower_same')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="is_claimant_and_borrower_same">Is Claimant and Borrower Same
                                                <span class="text-danger">*</span></label>
                                            <select class="form-select" id="is_claimant_and_borrower_same"
                                                name="is_claimant_and_borrower_same"
                                                onchange="claimantBorrowerSameOptions();">
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('is_claimant_and_borrower_same', @$borrower->is_claimant_and_borrower_same) == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('is_claimant_and_borrower_same', @$borrower->is_claimant_and_borrower_same) == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            @error('is_claimant_and_borrower_same')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="firstname">Borrower Name<span class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="borrower_title" name="borrower_title">
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
                                                id="borrower_lastname" name="borrower_lastname" maxlength="30"
                                                placeholder="Last name"
                                                value="{{ old('borrower_lastname', @$borrower->borrower_lastname) }}">
                                            @error('borrower_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="borrower_firstname" name="borrower_firstname" maxlength="15"
                                                placeholder="First name"
                                                value="{{ old('borrower_firstname', @$borrower->borrower_firstname) }}">
                                            @error('borrower_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" maxlength="25" class="form-control"
                                                id="borrower_middlename" name="borrower_middlename" maxlength="30"
                                                placeholder="Middle name"
                                                value="{{ old('borrower_middlename', @$borrower->borrower_middlename) }}">
                                            @error('borrower_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-4 mt-3">
                                            <label for="borrowers_relation_with_patient">Borrower's Relation with
                                                Patient <span class="text-danger">*</span></label>
                                            <select class="form-select" id="borrowers_relation_with_patient"
                                                name="borrowers_relation_with_patient">
                                                <option value="">Select Borrower's Relation with Patient</option>
                                                <option value="Self"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Self' ? 'selected' : '' }}>
                                                    Self </option>
                                                <option value="Husband"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Husband' ? 'selected' : '' }}>
                                                    Husband </option>
                                                <option value="Wife"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Wife' ? 'selected' : '' }}>
                                                    Wife </option>
                                                <option value="Son"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Son' ? 'selected' : '' }}>
                                                    Son</option>
                                                <option value="Daughter"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Daughter' ? 'selected' : '' }}>
                                                    Daughter</option>
                                                <option value="Father"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Father' ? 'selected' : '' }}>
                                                    Father</option>
                                                <option value="Mother"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Mother' ? 'selected' : '' }}>
                                                    Mother</option>
                                                <option value="Other"
                                                    {{ old('borrowers_relation_with_patient', @$borrower->borrowers_relation_with_patient) == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('borrowers_relation_with_patient')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="gender">Borrower Gender <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="gender" name="gender">
                                                <option value="">Select Borrower Gender</option>
                                                <option value="M"
                                                    {{ old('gender', @$borrower->gender) == 'M' ? 'selected' : '' }}>M
                                                </option>
                                                <option value="F"
                                                    {{ old('gender', @$borrower->gender) == 'F' ? 'selected' : '' }}>F
                                                </option>
                                                <option value="Other"
                                                    {{ old('gender', @$borrower->gender) == 'Other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            @error('gender')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <label for="borrower_dob">Borrower DOB <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="borrower_dob" name="borrower_dob"
                                                max="{{ date('Y-m-d') }}" value="{{ old('borrower_dob', @$borrower->borrower_dob) }}"
                                                onchange="calculateAge();" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                                            @error('borrower_dob')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="borrower_address">Borrower Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="borrower_address"
                                                name="borrower_address" placeholder="Address Line"
                                                value="{{ old('borrower_address', @$borrower->borrower_address) }}">
                                            @error('borrower_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="borrower_city"
                                                name="borrower_city" placeholder="City"
                                                value="{{ old('borrower_city', @$borrower->borrower_city) }}">
                                            @error('borrower_city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" class="form-control" id="borrower_state"
                                                name="borrower_state" placeholder="State"
                                                value="{{ old('borrower_state', @$borrower->borrower_state) }}">
                                            @error('borrower_state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="number" class="form-control" id="borrower_pincode"
                                                name="borrower_pincode" placeholder="Pincode"
                                                value="{{ old('borrower_pincode', @$borrower->borrower_pincode) }}">
                                            @error('borrower_pincode')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Borrower ID Proof *</label>
                                            <div class="input-group">
                                                <select class="form-select" id="borrower_id_proof"
                                                    name="borrower_id_proof">
                                                    <option value="">Select Borrower ID Proof</option>
                                                    <option value="Aadhar Card"
                                                        {{ old('borrower_id_proof', @$borrower->borrower_id_proof) == 'Aadhar Card' ? 'selected' : '' }}>
                                                        Aadhar Card </option>
                                                    <option value="PAN Card"
                                                        {{ old('borrower_id_proof', @$borrower->borrower_id_proof) == 'PAN Card' ? 'selected' : '' }}>
                                                        PAN Card </option>
                                                    <option value="Voter's ID"
                                                        {{ old('borrower_id_proof', @$borrower->borrower_id_proof) == "Voter's ID" ? 'selected' : '' }}>
                                                        Voter's ID</option>
                                                    <option
                                                        value="Driving Licence"{{ old('borrower_id_proof', @$borrower->borrower_id_proof) == 'Driving Licence' ? 'selected' : '' }}>
                                                        Driving Licence </option>
                                                    <option value="Passport"
                                                        {{ old('borrower_id_proof', @$borrower->patient_id_proof) == 'Passport' ? 'selected' : '' }}>
                                                        Passport</option>
                                                </select>
                                              
                                            </div>

                                            @error('borrower_id_proof')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                          
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="nature_of_income">Nature of Income <span class="text-danger">*</span></label>
                                            <select class="form-control" id="nature_of_income" name="nature_of_income">
                                                <option value="">Select</option>
                                                <option @if (old('nature_of_income', @$borrower->nature_of_income) == 'Salaried') selected @endif value="Salaried">
                                                    Salaried</option>
                                                <option @if (old('nature_of_income', @$borrower->nature_of_income) == 'Self Employed') selected @endif
                                                    value="Self Employed">Self Employed</option>
                                            </select>
                                            @error('nature_of_income')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="organization">Name of the Organization <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="60" class="form-control" id="organization"
                                                name="organization" placeholder="Name of the Organization"
                                                value="{{ old('organization', @$borrower->organization) }}">
                                            @error('organization')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="member_or_employer_id">Member ID No./Employee ID (Client
                                                ID) </label>
                                                <div class="input-group">
                                            <input type="text" maxlength="12" class="form-control"
                                                id="member_or_employer_id" name="member_or_employer_id"
                                                placeholder="Member ID No./Employee ID (Client ID)"
                                                value="{{ old('member_or_employer_id', @$borrower->member_or_employer_id) }}">
                                               
                                            </div>
                                            @error('member_or_employer_id')
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
                                                    name="borrower_mobile_no" pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==10) return false;"
                                                    placeholder="Enter Claimant Mobile No."
                                                    value="{{ old('borrower_mobile_no', @$borrower->borrower_mobile_no) }}">
                                            </div>
                                            @error('borrower_mobile_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_personal_email_id">Borrower Personal email id <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="borrower_personal_email_id"
                                                name="borrower_personal_email_id" maxlength="45"
                                                placeholder="Enter Borrower Personal email id"
                                                value="{{ old('borrower_personal_email_id', @$borrower->borrower_personal_email_id) }}">
                                            @error('borrower_personal_email_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_official_email_id">Borrower official email id<span
                                                    class="text-danger"></span></label>
                                            <input type="email" class="form-control" id="borrower_official_email_id"
                                                name="borrower_official_email_id" maxlength="45"
                                                placeholder="Enter Borrower official email id"
                                                value="{{ old('borrower_official_email_id', @$borrower->borrower_official_email_id) }}">
                                            @error('borrower_official_email_id')
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
                                                    placeholder="Enter Aadhar no."
                                                    value="{{ old('borrower_aadhar_no', @$borrower->borrower_aadhar_no) }}">
                                              
                                            </div>
                                            @error('borrower_aadhar_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                          
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Borrower Bank Statement</label>
                                            <div class="input-group">
                                                <select class="form-select" id="bank_statement" name="bank_statement">
                                                    <option value="">Select Borrower Bank Statement</option>
                                                    <option value="Yes"
                                                        {{ old('bank_statement', @$borrower->bank_statement) == 'Yes' ? 'selected' : '' }}>
                                                        Yes </option>
                                                    <option value="No"
                                                        {{ old('bank_statement', @$borrower->bank_statement) == 'No' ? 'selected' : '' }}>
                                                        No </option>
                                                </select>
                                              
                                            </div>

                                            @error('bank_statement')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                         
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Borrower ITR (Income Tax Return)</label>
                                            <div class="input-group">
                                                <select class="form-select" id="itr" name="itr">
                                                    <option value="">Select Borrower ITR (Income Tax Return)
                                                    </option>
                                                    <option value="Yes"
                                                        {{ old('itr', @$borrower->itr) == 'Yes' ? 'selected' : '' }}>Yes
                                                    </option>
                                                    <option value="No"
                                                        {{ old('itr', @$borrower->itr) == 'No' ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                              
                                            </div>

                                            @error('itr')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label>Borrower Cancel Cheque / Pass Book <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select" id="borrower_cancel_cheque"
                                                    name="borrower_cancel_cheque">
                                                    <option value="">Select Borrower Cancel Cheque</option>
                                                    <option value="Yes"
                                                        {{ old('borrower_cancel_cheque', @$borrower->borrower_cancel_cheque) == 'Yes' ? 'selected' : '' }}>
                                                        Yes </option>
                                                    <option value="No"
                                                        {{ old('borrower_cancel_cheque', @$borrower->borrower_cancel_cheque) == 'No' ? 'selected' : '' }}>
                                                        No </option>
                                                </select>
                                              
                                            </div>

                                            @error('borrower_cancel_cheque')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                          
                                        </div>


                                        <div class="col-md-12 mt-2">
                                            <label for="address">Borrower Bank Details <span
                                                    class="text-danger">*</span></label>
                                        </div>


                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="borrower_bank_name"
                                                name="borrower_bank_name" maxlength="45" placeholder="Bank Name"
                                                value="{{ old('borrower_bank_name', @$borrower->borrower_bank_name) }}">
                                            @error('borrower_bank_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="borrower_bank_address"
                                                name="borrower_bank_address" maxlength="80" placeholder="Bank Address"
                                                value="{{ old('borrower_bank_address', @$borrower->borrower_bank_address) }}">
                                            @error('borrower_bank_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="borrower_ac_no"
                                                name="borrower_ac_no" maxlength="20" placeholder="Bank Account No."
                                                value="{{ old('borrower_ac_no', @$borrower->borrower_ac_no) }}">
                                            @error('borrower_ac_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <input type="text" class="form-control" id="borrower_ifs_code"
                                                name="borrower_ifs_code" maxlength="11" placeholder="Bank Ifs Code"
                                                value="{{ old('borrower_ifs_code', @$borrower->borrower_ifs_code) }}">
                                            @error('borrower_ifs_code')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_borrower_nominee_name">Co-Borrower / Nominee Name <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="co_borrower_nominee_name"
                                                name="co_borrower_nominee_name">
                                                <option value="">Select Co-Borrower / Nominee Name</option>
                                                <option value="Self"
                                                    {{ old('co_borrower_nominee_name', @$borrower->co_borrower_nominee_name) == 'Self' ? 'selected' : '' }}>
                                                    Self
                                                </option>
                                                <option value="Relations"
                                                    {{ old('co_borrower_nominee_name', @$borrower->co_borrower_nominee_name) == 'Relations' ? 'selected' : '' }}>
                                                    Relations
                                                </option>
                                            </select>
                                            @error('co_borrower_nominee_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_borrower_nominee_dob">Co-Borrower / Nominee DOB <span
                                                    class="text-danger"></span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="co_borrower_nominee_dob"
                                                    max="{{ date('Y-m-d') }}" name="co_borrower_nominee_dob"
                                                    value="{{ old('co_borrower_nominee_dob', @$borrower->co_borrower_nominee_dob) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                                  
                                            </div>
                                            @error('co_borrower_nominee_dob')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                          
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_borrower_nominee_gender">Co-Borrower / Nominee Gender <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select class="form-select" id="co_borrower_nominee_gender"
                                                    name="co_borrower_nominee_gender">
                                                    <option value="">Select Co-Borrower / Nominee Gender</option>
                                                    <option value="M"
                                                        {{ old('co_borrower_nominee_gender', @$borrower->co_borrower_nominee_gender) == 'M' ? 'selected' : '' }}>
                                                        M
                                                    </option>
                                                    <option value="F"
                                                        {{ old('co_borrower_nominee_gender', @$borrower->co_borrower_nominee_gender) == 'F' ? 'selected' : '' }}>
                                                        F
                                                    </option>
                                                    <option value="Other"
                                                        {{ old('co_borrower_nominee_gender', @$borrower->co_borrower_nominee_gender) == 'Other' ? 'selected' : '' }}>
                                                        Other
                                                    </option>
                                                </select>
                                             
                                            </div>
                                            @error('co_borrower_nominee_gender')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                         
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_borrower_nominee_relation">Co-Borrower / Nominee Relation
                                                <span class="text-danger">*</span></label>
                                            <select class="form-select" id="co_borrower_nominee_relation"
                                                name="co_borrower_nominee_relation">
                                                <option value="">Select Co-Borrower / Nominee Relation</option>
                                                <option value="Husband"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Husband' ? 'selected' : '' }}>
                                                    Husband </option>
                                                <option value="Wife"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Wife' ? 'selected' : '' }}>
                                                    Wife</option>
                                                <option value="Son"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Son' ? 'selected' : '' }}>
                                                    Son</option>
                                                <option value="Daughter"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Daughter' ? 'selected' : '' }}>
                                                    Daughter</option>
                                                <option value="Father"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Father' ? 'selected' : '' }}>
                                                    Father</option>
                                                <option value="Mother"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Mother' ? 'selected' : '' }}>
                                                    Mother</option>
                                                <option value="Other"
                                                    {{ old('co_borrower_nominee_relation', @$borrower->co_borrower_nominee_relation) == 'Other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('co_borrower_nominee_relation')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label>Co-Borrower / Borrower Other Documents</label>
                                            <div class="input-group">
                                                <select class="form-select" id="co_borrower_other_documents"
                                                    name="co_borrower_other_documents">
                                                    <option value="">Select Co-Borrower / Borrower Other
                                                        Documents</option>
                                                    <option value="Yes"
                                                        {{ old('co_borrower_other_documents', @$borrower->co_borrower_other_documents) == 'Yes' ? 'selected' : '' }}>
                                                        Yes </option>
                                                    <option value="No"
                                                        {{ old('co_borrower_other_documents', @$borrower->co_borrower_other_documents) == 'No' ? 'selected' : '' }}>
                                                        No </option>
                                                </select>
                                               
                                            </div>

                                            @error('co_borrower_other_documents')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                           
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="borrower_estimated_amount">Estimated Amount <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="borrower_estimated_amount"
                                                name="borrower_estimated_amount" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==8) return false;"
                                                placeholder="Enter Estimated Amount"
                                                value="{{ old('borrower_estimated_amount', @$borrower->borrower_estimated_amount) }}">
                                            @error('borrower_estimated_amount')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="co_borrower_comments">Co-Borrower / Borrower Comments </label>
                                            <textarea class="form-control" id="co_borrower_comments" name="co_borrower_comments" maxlength="250"
                                                placeholder="Co-Borrower / Borrower Comments" rows="5">{{ old('co_borrower_comments', @$borrower->co_borrower_comments) }}</textarea>
                                            @error('co_borrower_comments')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success" form="borrower-details-form">
                                                Update Borrower Details</button>
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
    <script>
        function patientBorrowerSameOptions() {
            var is_patient_and_borrower_same    = $('#is_patient_and_borrower_same').val();
            var address                         = {!! json_encode($claimant->patient->patient_current_address) !!};
            var city                            = {!! json_encode($claimant->patient->patient_current_city) !!};
            var state                           = {!! json_encode($claimant->patient->patient_current_state) !!};
            var pincode                         = {!! json_encode($claimant->patient->patient_current_pincode) !!};
            var id_proof                        = {!! json_encode($claimant->patient->id_proof) !!};
            var borrower_personal_email_id      = {!! json_encode($claimant->patient->email) !!};
            var borrower_mobile_number          = {!! json_encode($claimant->patient->phone) !!};
            switch (is_patient_and_borrower_same) {
                case 'Yes':
                    $('#is_claimant_and_borrower_same').val('');
                    $('#is_claimant_and_borrower_same').attr('disabled', true);
                    $('#borrower_title').val("{{ $claimant->patient->title }}");
                    $('#borrower_firstname').val("{{ $claimant->patient->firstname }}");
                    $('#borrower_lastname').val("{{ $claimant->patient->lastname }}");
                    $('#borrower_middlename').val("{{ $claimant->patient->middlename }}");
                    $('#borrower_address').val(address);
                    $('#borrower_city').val(city);
                    $('#borrower_state').val(state);
                    $('#borrower_pincode').val(pincode);
                    $('#borrower_id_proof').val(id_proof);
                    $('#borrower_personal_email_id').val(borrower_personal_email_id);
                    $('#borrower_mobile_no').val(borrower_mobile_number);
                    break;
                case 'No':
                    $('#is_claimant_and_borrower_same').attr('disabled', false);
                    $('#is_claimant_and_borrower_same').val('');
                    $('#borrower_title').val("");
                    $('#borrower_firstname').val("");
                    $('#borrower_lastname').val("");
                    $('#borrower_middlename').val("");
                    $('#borrower_address').val("");
                    $('#borrower_city').val("");
                    $('#borrower_state').val("");
                    $('#borrower_pincode').val("");
                    $('#borrower_id_proof').val("");
                    $('#borrower_personal_email_id').val("");
                    $('#borrower_mobile_no').val("");
                    break;
                default:
                    $('#is_claimant_and_borrower_same').attr('disabled', true);
                    $('#is_claimant_and_borrower_same').val('');
                    $('#borrower_title').val("");
                    $('#borrower_firstname').val("");
                    $('#borrower_lastname').val("");
                    $('#borrower_middlename').val("");
                    $('#borrower_address').val("");
                    $('#borrower_city').val("");
                    $('#borrower_state').val("");
                    $('#borrower_pincode').val("");
                    $('#borrower_id_proof').val("");
                    $('#borrower_personal_email_id').val("");
                    $('#borrower_mobile_no').val("");
                    break;
            }
        }
    </script>
    <script>
        function claimantBorrowerSameOptions() {
            var is_claimant_and_borrower_same = $('#is_claimant_and_borrower_same').val();
            var address                         = {!! json_encode($claimant->address) !!};
            var city                            = {!! json_encode($claimant->city) !!};
            var state                           = {!! json_encode($claimant->state) !!};
            var pincode                         = {!! json_encode($claimant->pincode) !!};
            var id_proof                        = {!! json_encode($claimant->patient->id_proof) !!};
            var borrower_personal_email_id      = {!! json_encode($claimant->personal_email_id) !!};
            var borrower_official_email_id      = {!! json_encode($claimant->official_email_id) !!};
            var borrower_mobile_number          = {!! json_encode($claimant->mobile_no) !!};
            var borrower_pan_no                 = {!! json_encode($claimant->pan_no) !!};
            var borrower_aadhar_no              = {!! json_encode($claimant->aadhar_no) !!};
            var borrower_bank_name              = {!! json_encode($claimant->bank_name) !!};
            var borrower_bank_address           = {!! json_encode($claimant->bank_address) !!};
            var borrower_ac_no                  = {!! json_encode($claimant->ac_no) !!};
            var borrower_ifs_code               = {!! json_encode($claimant->ifs_code) !!};

            switch (is_claimant_and_borrower_same) {
                case 'Yes':
                    $('#borrower_title').val("{{ $claimant->title }}");
                    $('#borrower_firstname').val("{{ $claimant->firstname }}");
                    $('#borrower_lastname').val("{{ $claimant->lastname }}");
                    $('#borrower_middlename').val("{{ $claimant->middlename }}");
                    $('#borrower_address').val(address);
                    $('#borrower_city').val(city);
                    $('#borrower_state').val(state);
                    $('#borrower_pincode').val(pincode);
                    $('#borrower_id_proof').val(id_proof);
                    $('#borrower_personal_email_id').val(borrower_personal_email_id);
                    $('#borrower_official_email_id').val(borrower_official_email_id);
                    $('#borrower_mobile_no').val(borrower_mobile_number);
                    $('#borrower_pan_no').val(borrower_pan_no);
                    $('#borrower_aadhar_no').val(borrower_aadhar_no);
                    $("#borrower-details-form #borrower_bank_name").val(borrower_bank_name);
                    $("#borrower-details-form #borrower_bank_address").val(borrower_bank_address);
                    $("#borrower_ac_no").val(borrower_ac_no);
                    $("#borrower_ifs_code").val(borrower_ifs_code);
                    break;
                case 'No':
                    $('#borrower_title').val("");
                    $('#borrower_firstname').val("");
                    $('#borrower_lastname').val("");
                    $('#borrower_middlename').val("");
                    $('#borrower_address').val("");
                    $('#borrower_city').val("");
                    $('#borrower_state').val("");
                    $('#borrower_pincode').val("");
                    $('#borrower_id_proof').val("");
                    $('#borrower_personal_email_id').val("");
                    $('#borrower_official_email_id').val("");
                    $('#borrower_mobile_no').val("");
                    $('#borrower_pan_no').val("");
                    $('#borrower_aadhar_no').val("");
                    $("#borrower_bank_name").val();
                    $("#borrower_bank_address").val();
                    $("#borrower_ac_no").val();
                    $("#borrower_ifs_code").val();
                    break;
                default:
                    $('#borrower_title').val("");
                    $('#borrower_firstname').val("");
                    $('#borrower_lastname').val("");
                    $('#borrower_middlename').val("");
                    $('#borrower_address').val("");
                    $('#borrower_city').val("");
                    $('#borrower_state').val("");
                    $('#borrower_pincode').val("");
                    $('#borrower_id_proof').val("");
                    $('#borrower_personal_email_id').val("");
                    $('#borrower_official_email_id').val("");
                    $('#borrower_mobile_no').val("");
                    $('#borrower_pan_no').val("");
                    $('#borrower_aadhar_no').val("");
                    $("#borrower_bank_name").val();
                    $("#borrower_bank_address").val();
                    $("#borrower_ac_no").val();
                    $("#borrower_ifs_code").val();
                    break;
            }
        }

        $('select').on('change', function(){
            var id = $(this).attr('id');
            if($(this).val() == 'No' || $(this).val() == 'NA'){
                $("#"+id+"_file").attr('disabled',true);
            }else{
                $("#"+id+"_file").attr('disabled',false);
            }
        });

        $( document ).ready(function() {
            if($("#itr").val() == 'No'){
                $("#itr_file").attr('disabled',true);
            }else{
                $("#itr_file").attr('disabled',false);
            }

            if($("#borrower_cancel_cheque").val() == 'No' || $("#borrower_cancel_cheque").val() == 'NA'){
                $("#borrower_cancel_cheque_file").attr('disabled',true);
            }else{
                $("#borrower_cancel_cheque_file").attr('disabled',false);
            }

            if($("#co_borrower_other_documents").val() == 'No' || $("#co_borrower_other_documents").val() == 'NA'){
                $("#co_borrower_other_documents_file").attr('disabled',true);
            }else{
                $("#co_borrower_other_documents_file").attr('disabled',false);
            }

            if($("#bank_statement").val() == 'No' || $("#bank_statement").val() == 'NA'){
                $("#bank_statement_file").attr('disabled',true);
            }else{
                $("#bank_statement_file").attr('disabled',false);
            }
        });

        $('#co_borrower_nominee_dob').datepicker({
            endDate: '+0d',
            autoclose: true,
        });

        $('#borrower_dob').datepicker({
            endDate: '+0d',
            autoclose: true,
        });


</script>
@endpush
