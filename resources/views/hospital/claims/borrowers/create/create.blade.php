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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">ClaimStack</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claimants.index') }}">Borrowers</a>
                            </li>
                            <li class="breadcrumb-item active">New Borrower</li>
                        </ol>
                    </div>
                    <h4 class="page-title">New Borrower</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                            <form action="{{ route('hospital.borrowers.store') }}" method="post" id="borrower-create-form"
        enctype="multipart/form-data">
        @csrf
        <div class="card-body mb-4">
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                    <input type="text" readonly class="form-control" id="patient_id" name="patient_id" maxlength="60"
                    placeholder="Enter Patient Id" value="{{ old('patient_id') }}">
                    @error('patient_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                    <input type="text" readonly class="form-control" id="claim_id" name="claim_id" maxlength="60"
                    placeholder="Enter Claim ID" value="{{ old('claim_id') }}">
                    @error('claim_id')
                    <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="claimant_id">Claimant ID <span class="text-danger">*</span></label>

                    <select class="form-control select2" id="claimant_id" name="claimant_id" data-toggle="select2" >
                    <option value="">Search Claim ID</option>
                    @foreach ($claimants as $row)
                        <option value="{{ $row->uid }}" {{ old('claimant_id', isset($claim) ? $claim->id : '') == $row->uid ? 'selected' : '' }}
                            data-patient-id="{{ $row->patient->uid }}"
                            data-patient_id="{{ $row->patient->uid }}"
                            data-claimant_id="{{ $row->id }}"
                            data-claim-id="{{ $row->claim->uid }}"
                            data-hospital-id="{{ $row->hospital->uid }}"
                            data-title="{{ $row->patient->title }}"
                            data-firstname="{{ $row->patient->firstname }}"
                            data-middlename="{{ $row->patient->middlename }}"
                            data-lastname="{{ $row->patient->lastname }}"
                            data-hospital-name="{{ $row->patient->hospital->name }}"
                            data-hospital-address="{{ $row->patient->hospital->address }}"
                            data-hospital-city="{{ $row->patient->hospital->city }}"
                            data-hospital-state="{{ $row->patient->hospital->state }}"
                            data-hospital-pincode="{{ $row->patient->hospital->pincode }}" 
                            data-policy-no="{{ $row->claim->policy_no }}" 
                            data-insurer-id="{{ $row->claim->policy->insurer_id }}" 
                            data-policy-id="{{ $row->claim->policy->policy_id }}" 
                            data-certificate_no="{{ $row->claim->policy->certificate_no }}" 
                            data-company-tpa-id-card-no="{{ $row->claim->company_tpa_id_card_no }}" 
                            data-tpa-name="{{ $row->claim->policy->tpa_name }}" 
                            data-policy-type="{{ $row->claim->policy->policy_type }}" 
                            >
                            {{ $row->uid }}
                        @endforeach
                    </select>


                    @error('claimant_id')
                    <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" id="claimantId" name="claimantId" value="{{ old('claimantId') }}">
                <input type="hidden" id="patientId" name="patientId" value="{{ old('patientId') }}">

                <div class="col-md-4">
                    <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                    <input type="text" readonly class="form-control" id="hospital_id" name="hospital_id"
                    placeholder="Enter Hospital Id" value="{{ old('hospital_id') }}">
                    @error('hospital_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" readonly id="hospital_name" name="hospital_name"
                    placeholder="Enter Hospital Name" value="{{ old('hospital_name') }}">
                    @error('hospital_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" readonly id="hospital_address" name="hospital_address"
                    placeholder="Address Line"
                    value="{{ old('hospital_address') }}">
                    @error('hospital_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" readonly class="form-control" id="hospital_city" name="hospital_city"
                    placeholder="City" value="{{ old('hospital_city') }}">
                    @error('hospital_city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" readonly class="form-control" id="hospital_state" name="hospital_state"
                    placeholder="State" value="{{ old('hospital_state') }}">
                    @error('hospital_state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="number" readonly class="form-control" id="hospital_pincode" name="hospital_pincode"
                    placeholder="Pincode" value="{{ old('hospital_pincode') }}">
                    @error('hospital_pincode')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 mt-3">
                    <label for="patient_firstname">Patient Name <span class="text-danger">*</span></label>
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" readonly value="{{old('patient_title') }}"  class="form-control" id="patient_title" name="patient_title" >
                    {{-- <select class="form-control" id="patient_title" name="patient_title">
                        <option value="">Select</option>
                        <option @if( old('patient_title') == 'Mr.') selected @else disabled @endif value="Mr.">Mr.</option>
                        <option @if( old('patient_title') == 'Ms.') selected @else disabled @endif value="Ms.">Ms.</option>
                    </select> --}}
                    @error('patient_title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_lastname"
                    name="patient_lastname" maxlength="30" readonly placeholder="Last name"
                    value="{{ old('patient_lastname') }}">
                    @error('patient_lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_firstname"
                    name="patient_firstname" maxlength="15" readonly placeholder="First name"
                    value="{{ old('patient_firstname') }}">
                    @error('patient_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_middlename"
                    name="patient_middlename" maxlength="30" readonly placeholder="Middle name"
                    value="{{ old('patient_middlename') }}">
                    @error('patient_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label for="policy_no">Policy No. <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="policy_no" name="policy_no"
                        maxlength="16" placeholder="Enter Policy No."
                        value="{{ old('policy_no') }}" readonly>
                    @error('policy_no')
                        <span id="policy-id-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label for="insurance_company">Insurance Company<span
                            class="text-danger">*</span></label>
                            <input type="hidden" id="insurance_company_h" value="{{ old('insurance_company') }}" name="insurance_company">
                    <select class="form-control select2" id="insurance_company"
                        name="insurance_company" data-toggle="select2">
                        <option value="">Select Insurance Company</option>
                        @foreach ($insurers as $insurer)
                            <option value="{{ $insurer->id }}"
                                {{ old('insurance_company') == $insurer->id ? 'selected' : 'disabled' }}>
                                {{ $insurer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('insurance_company')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label for="policy_name">Policy Name <span
                            class="text-danger">*</span></label>
                            <input type="hidden" id="policy_name_h" value="{{ old('policy_name') }}" name="policy_name">
                    <select class="form-control select2" id="policy_name" name="policy_name"
                        data-toggle="select2">
                        <option value="">Select Policy</option>
                        @foreach ($insurers as $insurer)
                            <option value="{{ $insurer->id }}"
                                {{ old('policy_name') == $insurer->id ? 'selected' : 'disabled' }}>
                                {{ $insurer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('policy_name')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label for="certificate_no">SI No. / Certificate No. <span
                            class="text-danger">*</span></label>
                    <input type="text" maxlength="16" class="form-control"
                        id="certificate_no" placeholder="SI No. / Certificate No."
                        name="certificate_no"
                        value="{{ old('certificate_no') }}"
                        readonly>
                    @error('certificate_no')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label for="company_tpa_id_card_no">Company / TPA ID Card No. <span
                            class="text-danger">*</span></label>
                    <input type="text" maxlength="16" class="form-control"
                        id="company_tpa_id_card_no" placeholder="Company / TPA ID Card No."
                        name="company_tpa_id_card_no"
                        value="{{ old('company_tpa_id_card_no') }}"
                        readonly>
                    @error('company_tpa_id_card_no')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mt-3">
                    <label for="tpa_name">TPA Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tpa_name" name="tpa_name"
                        placeholder="Enter TPA Name"
                        value="{{ old('tpa_name') }}"
                        maxlength="75" readonly>
                    @error('tpa_name')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="policy_type">Policy Type <span
                            class="text-danger">*</span></label>
                    <input class="form-select" type="hidden" id="policy_type_h" name="policy_type" value="{{ old('policy_type') }}">
                    <select class="form-select" id="policy_type" name="policy_type">
                        <option value="">Select Policy Type</option>
                        <option value="Group"
                            {{ old('policy_type') == 'Group' ? 'selected' : 'disabled' }}>
                            Group
                        </option>
                        <option value="Retail"
                            {{ old('policy_type') == 'Retail' ? 'selected' : 'disabled' }}>
                            Retail
                        </option>
                    </select>
                    @error('policy_type')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="is_patient_and_borrower_same">Is Patient and Borrower Same <span class="text-danger">*</span></label>
                    <select class="form-select" id="is_patient_and_borrower_same" name="is_patient_and_borrower_same">
                        <option value="">Select Is Patient and Borrower Same</option>
                        <option value="Yes" {{ old('is_patient_and_borrower_same') == 'Yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ old('is_patient_and_borrower_same') == 'No' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('is_patient_and_borrower_same')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="is_claimant_and_borrower_same">Is Claimant and Borrower Same <span class="text-danger">*</span></label>
                    <select class="form-select" id="is_claimant_and_borrower_same" name="is_claimant_and_borrower_same">
                        <option value="">Select Is Claimant and Borrower Same</option>
                        <option value="Yes" {{ old('is_claimant_and_borrower_same') == 'Yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ old('is_claimant_and_borrower_same') == 'No' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('is_claimant_and_borrower_same')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="firstname">Borrower Name<span class="text-danger">*</span></label>
                </div>

                <div class="col-md-3 mt-1">
                    <select class="form-control" id="borrower_title" name="borrower_title">
                        <option value="">Select</option>
                        <option @if( old('borrower_title') == 'Mr.') selected @endif value="Mr.">Mr.</option>
                        <option @if( old('borrower_title') == 'Ms.') selected @endif value="Ms.">Ms.</option>
                    </select>
                    @error('borrower_title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="borrower_lastname"
                    name="borrower_lastname" maxlength="30" placeholder="Last name"  value="{{ old('borrower_lastname') }}">
                    @error('borrower_lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="borrower_firstname"
                    name="borrower_firstname" maxlength="15" placeholder="First name"
                    value="{{ old('borrower_firstname') }}">
                    @error('borrower_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="borrower_middlename"
                    name="borrower_middlename" maxlength="30" placeholder="Middle name"
                    value="{{ old('borrower_middlename') }}">
                    @error('borrower_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>



                <div class="col-md-4 mt-3">
                    <label for="borrowers_relation_with_patient">Borrower's Relation with Patient <span class="text-danger">*</span></label>
                    <select class="form-select" id="borrowers_relation_with_patient" name="borrowers_relation_with_patient">
                        <option value="">Select Borrower's Relation with Patient</option>
                        <option value="Self" {{ old('borrowers_relation_with_patient') == 'Self' ? 'selected' : '' }}>Self </option>
                        <option value="Husband" {{ old('borrowers_relation_with_patient') == 'Husband' ? 'selected' : '' }}>Husband </option>
                        <option value="Wife" {{ old('borrowers_relation_with_patient') == 'Wife' ? 'selected' : '' }}>Wife </option>
                        <option value="Son" {{ old('borrowers_relation_with_patient') == 'Son' ? 'selected' : '' }}>Son</option>
                        <option value="Daughter" {{ old('borrowers_relation_with_patient') == 'Daughter' ? 'selected' : '' }}>Daughter</option>
                        <option value="Father" {{ old('borrowers_relation_with_patient') == 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('borrowers_relation_with_patient') == 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Other" {{ old('borrowers_relation_with_patient') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('borrowers_relation_with_patient')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label for="gender">Borrower Gender <span class="text-danger">*</span></label>
                    <select class="form-select" id="gender" name="gender">
                        <option value="">Select Borrower Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>M
                        </option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>F
                        </option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                        </option>
                    </select>
                    @error('gender')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <label for="borrower_dob">Borrower DOB <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="borrower_dob" name="borrower_dob" max="{{ date('Y-m-d') }}"
                    value="{{ old('borrower_dob') }}" onchange="calculateAge();" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                    @error('borrower_dob')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="borrower_address">Borrower Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="borrower_address" name="borrower_address"
                    placeholder="Address Line"
                    value="{{ old('borrower_address') }}">
                    @error('borrower_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="borrower_city" name="borrower_city"
                    placeholder="City" value="{{ old('borrower_city') }}">
                    @error('borrower_city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="borrower_state" name="borrower_state"
                    placeholder="State" value="{{ old('borrower_state') }}">
                    @error('borrower_state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="number" class="form-control" id="borrower_pincode" name="borrower_pincode"
                    placeholder="Pincode" value="{{ old('borrower_pincode') }}">
                    @error('borrower_pincode')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Borrower ID Proof *</label>
                    <div class="input-group">
                        <select class="form-select" id="borrower_id_proof" name="borrower_id_proof">
                            <option value="">Select Borrower ID Proof</option>
                            <option value="Aadhar Card" {{ old('borrower_id_proof') == 'Aadhar Card' ? 'selected' : '' }}>Aadhar Card </option>
                            <option value="PAN Card" {{ old('borrower_id_proof') == 'PAN Card' ? 'selected' : '' }}>PAN Card  </option>
                            <option value="Voter's ID" {{ old('borrower_id_proof') == "Voter's ID" ? 'selected' : '' }}>Voter's ID</option>
                            <option value="Driving Licence"{{ old('borrower_id_proof') == 'Driving Licence' ? 'selected' : '' }}>Driving Licence </option>
                            <option value="Passport" {{ old('borrower_id_proof') == 'Passport' ? 'selected' : '' }}>Passport</option>
                        </select>
                        <a id="borrower_id_proof_file_download" style="display:none;" href="" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                         <input type="file" name="borrower_id_proof_file" id="borrower_id_proof_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="borrower_id_proof_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>

                    @error('borrower_id_proof')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('borrower_id_proof_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
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
                        ID)</label>
                        <div class="input-group">
                    <input type="text" maxlength="12" class="form-control"
                        id="member_or_employer_id" name="member_or_employer_id"
                        placeholder="Member ID No./Employee ID (Client ID)"
                        value="{{ old('member_or_employer_id', @$borrower->member_or_employer_id) }}">
                    @isset($borrower->member_or_employer_id_file)
                            <a href="{{ asset('storage/uploads/borrower/'.$borrower->id.'/'.@$borrower->member_or_employer_id_file) }}" download=""  class="btn btn-warning download-label"><i  class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="member_or_employer_id_file"
                            id="member_or_employer_id_file" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="member_or_employer_id_file" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('member_or_employer_id')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('member_or_employer_id_file')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_mobile_no">Borrower Mobile No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <label class="input-group-text" for="borrower_mobile_no">+91</label>
                        <input type="number" class="form-control" id="borrower_mobile_no" name="borrower_mobile_no"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                        placeholder="Enter Claimant Mobile No."
                        value="{{ old('borrower_mobile_no') }}">
                    </div>
                    @error('borrower_mobile_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_personal_email_id">Borrower Personal email id <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="borrower_personal_email_id" name="borrower_personal_email_id" maxlength="45"
                    placeholder="Enter Borrower Personal email id" value="{{ old('borrower_personal_email_id') }}">
                    @error('borrower_personal_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_official_email_id">Borrower official email id<span class="text-danger"></span></label>
                    <input type="email" class="form-control" id="borrower_official_email_id" name="borrower_official_email_id" maxlength="45"
                    placeholder="Enter Borrower official email id" value="{{ old('borrower_official_email_id') }}">
                    @error('borrower_official_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_pan_no">Borrower Pan No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="borrower_pan_no" name="borrower_pan_no"
                        maxlength="10" placeholder="Enter PAN no." value="{{ old('borrower_pan_no') }}">
                        <a id="borrower_pan_no_file_download" style="display:none;" href="" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                        <input type="file" name="borrower_pan_no_file" id="borrower_pan_no_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="borrower_pan_no_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('borrower_pan_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('borrower_pan_no_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_aadhar_no">Borrower Aadhar No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==12) return false;" class="form-control" id="borrower_aadhar_no" name="borrower_aadhar_no"
                        maxlength="12" placeholder="Enter Aadhar no." value="{{ old('borrower_aadhar_no') }}">
                        <a id="borrower_aadhar_no_file_download" style="display:none;" href="" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                        <input type="file" name="borrower_aadhar_no_file" id="borrower_aadhar_no_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="borrower_aadhar_no_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('borrower_aadhar_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('borrower_aadhar_no_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Borrower Bank Statement</label>
                    <div class="input-group">
                        <select class="form-select" id="bank_statement" name="bank_statement">
                            <option value="">Select Borrower Bank Statement</option>
                            <option value="Yes" {{ old('bank_statement') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('bank_statement', @$hospital->bank_statement) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                         <input type="file" name="bank_statement_file" id="bank_statement_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="bank_statement_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>

                    @error('bank_statement')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('bank_statement_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Borrower  ITR (Income Tax Return)</label>
                    <div class="input-group">
                        <select class="form-select" id="itr" name="itr">
                            <option value="">Select Borrower  ITR (Income Tax Return)</option>
                            <option value="Yes" {{ old('itr') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('itr', @$hospital->itr) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                         <input type="file" name="itr_file" id="itr_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="itr_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>

                    @error('itr')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('itr_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <label>Borrower Cancel Cheque / Pass Book <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" id="borrower_cancel_cheque" name="borrower_cancel_cheque">
                            <option value="">Select Borrower Cancel Cheque / Pass Book</option>
                            <option value="Yes" {{ old('borrower_cancel_cheque') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('borrower_cancel_cheque', @$hospital->borrower_cancel_cheque) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                        <input type="file" name="borrower_cancel_cheque_file" id="borrower_cancel_cheque_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="borrower_cancel_cheque_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('borrower_cancel_cheque_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('borrower_cancel_cheque')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 mt-2">
                    <label for="address">Borrower Bank Details <span class="text-danger">*</span></label>
                </div>


                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_bank_name" name="borrower_bank_name" maxlength="45"
                    placeholder="Bank Name" value="{{ old('borrower_bank_name') }}">
                    @error('borrower_bank_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_bank_address" name="borrower_bank_address" maxlength="80"
                    placeholder="Bank Address" value="{{ old('borrower_bank_address') }}">
                    @error('borrower_bank_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_ac_no" name="borrower_ac_no" maxlength="20"
                    placeholder="Bank Account No." value="{{ old('borrower_ac_no', @$hospital->borrower_ac_no) }}">
                    @error('borrower_ac_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_ifs_code" name="borrower_ifs_code" maxlength="11"
                    placeholder="Bank Ifs Code" value="{{ old('borrower_ifs_code', @$hospital->borrower_ifs_code) }}">
                    @error('borrower_ifs_code')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="co_borrower_nominee_name">Co-Borrower / Nominee Name <span class="text-danger"></span></label>
                    <select class="form-select" id="co_borrower_nominee_name" name="co_borrower_nominee_name">
                        <option value="">Select Co-Borrower / Nominee Name</option>
                        <option value="Self" {{ old('co_borrower_nominee_name') == 'Self' ? 'selected' : '' }}>Self
                        </option>
                        <option value="Relations" {{ old('co_borrower_nominee_name') == 'Relations' ? 'selected' : '' }}>Relations
                        </option>
                    </select>
                    @error('co_borrower_nominee_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="co_borrower_nominee_dob">Co-Borrower / Nominee DOB <span class="text-danger"></span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="co_borrower_nominee_dob" max="{{ date('Y-m-d') }}" name="co_borrower_nominee_dob"
                        value="{{ old('co_borrower_nominee_dob') }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                        <input type="file" name="co_borrower_nominee_dob_file" id="co_borrower_nominee_dob_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="co_borrower_nominee_dob_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('co_borrower_nominee_dob')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('co_borrower_nominee_dob_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="co_borrower_nominee_gender">Co-Borrower / Nominee Gender <span class="text-danger"></span></label>
                    <div class="input-group">
                        <select class="form-select" id="co_borrower_nominee_gender" name="co_borrower_nominee_gender">
                            <option value="">Select Co-Borrower / Nominee Gender</option>
                            <option value="M" {{ old('co_borrower_nominee_gender') == 'M' ? 'selected' : '' }}>M
                            </option>
                            <option value="F" {{ old('co_borrower_nominee_gender') == 'F' ? 'selected' : '' }}>F
                            </option>
                            <option value="Other" {{ old('co_borrower_nominee_gender') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                        <input type="file" name="co_borrower_nominee_gender_file" id="co_borrower_nominee_gender_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="co_borrower_nominee_gender_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('co_borrower_nominee_gender')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('co_borrower_nominee_gender_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="co_borrower_nominee_relation">Co-Borrower / Nominee Relation <span class="text-danger"></span></label>
                    <select class="form-select" id="co_borrower_nominee_relation" name="co_borrower_nominee_relation">
                        <option value="">Select Co-Borrower / Nominee Relation</option>
                        <option value="Husband" {{ old('co_borrower_nominee_relation') == 'Husband' ? 'selected' : '' }}>Husband </option>
                        <option value="Wife" {{ old('co_borrower_nominee_relation') == 'Wife' ? 'selected' : '' }}>Wife</option>
                        <option value="Son" {{ old('co_borrower_nominee_relation') == 'Son' ? 'selected' : '' }}>Son</option>
                        <option value="Daughter" {{ old('co_borrower_nominee_relation') == 'Daughter' ? 'selected' : '' }}>Daughter</option>
                        <option value="Father" {{ old('co_borrower_nominee_relation') == 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('co_borrower_nominee_relation') == 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Other" {{ old('co_borrower_nominee_relation') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('co_borrower_nominee_relation')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Co-Borrower / Borrower Other Documents</label>
                    <div class="input-group">
                        <select class="form-select" id="co_borrower_other_documents" name="co_borrower_other_documents">
                            <option value="">Select Co-Borrower / Borrower Other Documents</option>
                            <option value="Yes" {{ old('co_borrower_other_documents') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('co_borrower_other_documents', @$hospital->co_borrower_other_documents) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                         <input type="file" name="co_borrower_other_documents_file" id="co_borrower_other_documents_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="co_borrower_other_documents_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>
                    @error('co_borrower_other_documents')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                     @error('co_borrower_other_documents_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_estimated_amount">Estimated Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="borrower_estimated_amount" name="borrower_estimated_amount"
                    pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;"
                    placeholder="Enter Estimated Amount"
                    value="{{ old('borrower_estimated_amount') }}">
                    @error('borrower_estimated_amount')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="co_borrower_comments">Co-Borrower / Borrower Comments </label>
                    <textarea class="form-control" id="co_borrower_comments" name="co_borrower_comments" maxlength="250" placeholder="Claimant Comments"
                    rows="5">{{ old('co_borrower_comments') }}</textarea>
                    @error('co_borrower_comments')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success" form="borrower-create-form">
                    Create / Save Borrower ID</button>
                </div>

            </div>
        </div>
    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var patients_relation_with_claimant = "{{ old('patients_relation_with_claimant') }}";

        if (patients_relation_with_claimant == 'Other') {
            $('#specify').attr('disabled', false);
        }

        $('#patients_relation_with_claimant').on('change', function() {
            if ($(this).val() == 'Other') {
                $('#specify').attr('disabled', false);
            }
        });

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
                console.log(firstname);
                $('#patients_relation_with_claimant').val('Self');
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

        $('select').on('change', function() {
            var id = $(this).attr('id');
            if ($(this).val() == 'No' || $(this).val() == 'NA') {
                $("#" + id + "_file").attr('disabled', true);
            } else {
                $("#" + id + "_file").attr('disabled', false);
            }
        });

        var cancel_cheque = "{{ old('cancel_cheque') }}";
        if (cancel_cheque == 'No') {
            $("#cancel_cheque_file").attr('disabled', true);
        }

    $(document).ready(function () {
        $('#is_patient_and_borrower_same').on('change', function () {
            var idCountry = this.value;
            if(idCountry == 'Yes'){
                $("#is_claimant_and_borrower_same").attr('disabled', true);

                var patientId = $("#patientId").val();

                $.ajax({
                    url: "{{url('hospital/claimants/patient/')}}/"+patientId,
                    type: "GET",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $("#borrower_title").val(result.title);
                        $("#borrower_firstname").val(result.firstname);
                        $("#borrower_lastname").val(result.lastname);
                        $("#borrower_middlename").val(result.middlename);
                        $("#borrower_address").val(result.patient_current_address);
                        $("#borrower_city").val(result.patient_current_city);
                        $("#borrower_state").val(result.patient_current_state);
                        $("#borrower_pincode").val(result.patient_current_pincode);
                        $("#borrower_id_proof").val(result.id_proof);
                        $("#borrower_personal_email_id").val(result.email);
                        $("#borrower_mobile_no").val(result.phone);
                        $("#borrower_id_proof_file_download").css('display', 'block').attr('href', result.id_proof_file);
                    }
                });

            }else{

                $("#borrower_title").val('');
                $("#borrower_firstname").val('');
                $("#borrower_lastname").val('');
                $("#borrower_middlename").val('');
                $("#borrower_address").val('');
                $("#borrower_city").val('');
                $("#borrower_state").val('');
                $("#borrower_pincode").val('');
                $("#borrower_id_proof").val('');
                $("#borrower_personal_email_id").val('');
                $("#borrower_mobile_no").val('');
                $("#borrower_id_proof_file_download").css('display', 'none').attr('href', '');

                $("#is_claimant_and_borrower_same").attr('disabled', false);
                $("#is_claimant_and_borrower_same").val('').trigger('change');
            }

        });
        $('#is_claimant_and_borrower_same').on('change', function () {
            var idState = this.value;
            if(idState == 'Yes'){



             var claimantId = $("#claimantId").val();

                $.ajax({
                    url: "{{url('hospital/claimants/claimant/')}}/"+claimantId,
                    type: "GET",
                    data: {
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $("#borrower_title").val(result.title);
                        $("#borrower_firstname").val(result.firstname);
                        $("#borrower_lastname").val(result.lastname);
                        $("#borrower_middlename").val(result.middlename);
                        $("#borrower_address").val(result.address);
                        $("#borrower_city").val(result.city);
                        $("#borrower_state").val(result.state);
                        $("#borrower_pincode").val(result.pincode);
                        $("#borrower_pincode").val(result.pincode);
                        $("#borrower_id_proof").val(result.id_proof);
                        $("#borrower_personal_email_id").val(result.personal_email_id);
                        $("#borrower_mobile_no").val(result.mobile_no);
                        $("#borrower_pan_no").val(result.pan_no);
                        $("#borrower_aadhar_no").val(result.aadhar_no);
                        $("#borrower_bank_name").val(result.bank_name);
                        $("#borrower_bank_address").val(result.bank_address);
                        $("#borrower_ac_no").val(result.ac_no);
                        $("#borrower_ifs_code").val(result.ifs_code);
                        $("#borrower_pan_no_file_download").css('display', 'block').attr('href', result.pan_no_file);
                        // $("#borrower_id_proof_file_download").css('display', 'block').attr('href', result.id_proof_file);
                        $("#borrower_aadhar_no_file_download").css('display', 'block').attr('href', result.aadhar_no_file);
                    }
                });
            }else{
                $("#borrower_title").val('');
                $("#borrower_firstname").val('');
                $("#borrower_lastname").val('');
                $("#borrower_middlename").val('');
                $("#borrower_address").val('');
                $("#borrower_city").val('');
                $("#borrower_state").val('');
                $("#borrower_pincode").val('');
                $("#borrower_id_proof").val('');
                $("#borrower_personal_email_id").val('');
                $("#borrower_mobile_no").val('');
                $("#borrower_pan_no").val('');
                $("#borrower_aadhar_no").val('');
                $("#borrower_bank_name").val('');
                $("#borrower_bank_address").val('');
                $("#borrower_ac_no").val('');
                $("#borrower_ifs_code").val('');
                $("#borrower_pan_no_file").val('');
                $("#borrower_aadhar_no_file").val('');
                $("#borrower_id_proof_file_download").css('display', 'none').attr('href', '');
            }

        });
    });
</script>

<script>
    $(document).ready(function(){
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });

        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('a[href="' + activeTab + '"]').tab('show');
        }
    });

        

    var bank_statement = "{{ old('bank_statement') }}";
    var itr = "{{ old('itr') }}";
    var borrower_cancel_cheque = "{{ old('borrower_cancel_cheque') }}";

    if(bank_statement == 'No'){
        $("#bank_statement_file").attr('disabled',true);
    }


    if(itr == 'No'){
        $("#itr_file").attr('disabled',true);
    }

    if(borrower_cancel_cheque == 'No'){
        $("#borrower_cancel_cheque_file").attr('disabled',true);
    }

    $('#claimant_id').on('change', function() {

        var title = $("#claimant_id").select2().find(":selected").data("title");
        var firstname = $("#claimant_id").select2().find(":selected").data("firstname");
        var middlename = $("#claimant_id").select2().find(":selected").data("middlename");
        var lastname = $("#claimant_id").select2().find(":selected").data("lastname");
        var address = $("#claimant_id").select2().find(":selected").data("hospital-address");
        var city = $("#claimant_id").select2().find(":selected").data("hospital-city");
        var state = $("#claimant_id").select2().find(":selected").data("hospital-state");
        var pincode = $("#claimant_id").select2().find(":selected").data("hospital-pincode");
        var claim_id = $("#claimant_id").select2().find(":selected").data("claim-id");
        var patient_id = $("#claimant_id").select2().find(":selected").data("patient-id");
        var hospital_id = $("#claimant_id").select2().find(":selected").data("hospital-id");
        var hospital_name = $("#claimant_id").select2().find(":selected").data("hospital-name");
        var patientId = $("#claimant_id").select2().find(":selected").data("patient_id");
        var claimant_id = $("#claimant_id").select2().find(":selected").data("claimant_id");
        var policy_no = $("#claimant_id").select2().find(":selected").data("policy-no");
        var insurer_id = $("#claimant_id").select2().find(":selected").data("insurer-id");
        var policy_id = $("#claimant_id").select2().find(":selected").data("policy-id");
        var certificate_no= $("#claimant_id").select2().find(":selected").data("certificate_no");
        var company_tpa_id_card_no = $("#claimant_id").select2().find(":selected").data("company-tpa-id-card-no");
        var tpa_name = $("#claimant_id").select2().find(":selected").data("tpa-name");
        var policy_type = $("#claimant_id").select2().find(":selected").data("policy-type");

        $('#patients_relation_with_claimant').val('Self');
        $('#patient_title').val(title).trigger('change');
        $('#patient_firstname').val(firstname);
        $('#patient_middlename').val(middlename);
        $('#patient_lastname').val(lastname);
        $('#hospital_address').val(address);
        $('#hospital_city').val(city);
        $('#hospital_state').val(state);
        $('#hospital_pincode').val(pincode);
        $('#hospital_name').val(hospital_name);
        $('#hospital_id').val(hospital_id);
        $('#patient_id').val(patient_id);
        $('#claim_id').val(claim_id);
        $('#policy_no').val(policy_no);
        $('#insurance_company').val(insurer_id).trigger('change');
        $('#insurance_company_h').val(insurer_id);
        $('#policy_name').val(policy_id).trigger('change');
        $('#policy_name_h').val(policy_id);
        $('#certificate_no').val(certificate_no);
        $('#company_tpa_id_card_no').val(company_tpa_id_card_no);
        $('#policy_type').val(policy_type).trigger('change');
        $('#policy_type_h').val(policy_type);
        $('#tpa_name').val(tpa_name);
        $('#patientId').val(patientId);
        $('#claimantId').val(claimant_id);
    });

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

