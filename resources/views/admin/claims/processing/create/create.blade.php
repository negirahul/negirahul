@extends('layouts.admin')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.claimants.index') }}">Claim Processing</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($claim_processing) && !empty($claim_processing)) Edit @else New @endif Claim Processing</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if(isset($claim_processing) && !empty($claim_processing)) Edit @else New @endif Claim Processing</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">

                <div class="tab-content">
                    <div class="tab-pane show active" id="claim_processing_tab">

                        <form action="{{ route('admin.claim-processing.claim-processing-update', $claim->id) }}" method="POST"
                            id="claim-processing-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">

                                        <div class="col-md-12 mb-2 bg-primary text-white" style="line-height: 30px; margin-left: 2px; ;"> All Information </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id" name="patient_id" maxlength="60"
                                            placeholder="Enter Patient Id" value="{{ old('patient_id', $patient->uid) }}">
                                            @error('patient_id', 'claim-processing-form')
                                            <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label for="firstname">Patient Name <span class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3">
                                            <select class="form-control" id="patient_title" name="patient_title">
                                                <option disabled value="">Select</option>
                                                <option disabled value="Mr." {{ old('patient_title', $patient->title) == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                                <option disabled value="Ms." {{ old('patient_title', $patient->title) == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                            </select>
                                            @error('patient_title', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" readonly maxlength="25" class="form-control" id="patient_lastname"
                                            name="patient_lastname" placeholder="Last name"
                                            value="{{ old('patient_lastname', $patient->lastname) }}">
                                            @error('patient_lastname', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" readonly maxlength="25" class="form-control" id="patient_firstname"
                                            name="patient_firstname" placeholder="First name"
                                            value="{{ old('patient_firstname', $patient->firstname) }}">
                                            @error('patient_firstname', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" readonly maxlength="25" class="form-control" id="patient_middlename"
                                            name="patient_middlename" placeholder="Middle name"
                                            value="{{ old('patient_middlename', $patient->middlename) }}">
                                            @error('patient_middlename', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="patient_age">Patient Age <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" readonly
                                            id="patient_age" name="patient_age" placeholder="Patient Age"
                                            value="{{ old('patient_age', $patient->age) }}">
                                            @error('patient_age', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="patient_gender">Patient Gender <span class="text-danger">*</span></label>
                                            <select class="form-select" id="patient_gender" name="patient_gender">
                                                <option disabled value="">Please Select</option>
                                                <option disabled value="Male" {{ old('patient_gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option disabled value="Female" {{ old('patient_gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                                <option disabled value="Other" {{ old('patient_gender', $patient->gender) == 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                            @error('patient_gender', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="patient_current_residential_address">Patient Current Resedential Address <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="100" class="form-control"
                                            id="patient_current_residential_address" name="patient_current_residential_address"
                                            placeholder="Address Line" value="{{ old('patient_current_residential_address', $patient->patient_current_address) }}">
                                            @error('patient_current_residential_address', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="text" readonly class="form-control" id="patient_current_city"
                                            name="patient_current_city" placeholder="City"
                                            value="{{ old('patient_current_city', $patient->patient_current_city) }}">
                                            @error('patient_current_city', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="text" readonly class="form-control" id="patient_current_state"
                                            name="patient_current_state" placeholder="State"
                                            value="{{ old('patient_current_state', $patient->patient_current_state) }}">
                                            @error('patient_current_state', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="number" readonly class="form-control" id="patient_current_pincode"
                                            name="patient_current_pincode" pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==6) return false;" placeholder="Pincode"
                                            value="{{ old('patient_current_pincode', $patient->patient_current_pincode) }}">
                                            @error('patient_current_pincode', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id" name="hospital_id"
                                            placeholder="Enter Hospital Id" value="{{ old('hospital_id', $hospital->id) }}">
                                            @error('hospital_id', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name" name="hospital_name"
                                            placeholder="Enter Hospital Name" value="{{ old('hospital_name', $hospital->name) }}">
                                            @error('hospital_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-2 mb-1">
                                            <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_address" name="hospital_address"
                                            placeholder="Address Line"
                                            value="{{ old('hospital_address', $hospital->address) }}">
                                            @error('hospital_address', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-4 mt-2">
                                            <input type="text" readonly class="form-control" id="hospital_city" name="hospital_city" placeholder="City"
                                            value="{{ old('hospital_city', $hospital->city) }}">
                                            @error('hospital_city', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="text" readonly class="form-control" id="hospital_state" name="hospital_state" placeholder="State"
                                            value="{{ old('hospital_state', $hospital->state) }}">
                                            @error('hospital_state', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-2">
                                            <input type="number" readonly class="form-control" id="hospital_pincode" name="hospital_pincode"
                                            placeholder="Pincode" value="{{ old('hospital_pincode', $hospital->pincode) }}">
                                            @error('hospital_pincode', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3 mt-2">
                                            <label for="insurance_company">Insurance Companies<span class="text-danger">*</span></label>
                                            <select disabled class="form-control select2" id="insurance_company" name="insurance_company" data-toggle="select2">
                                                <option value="">Please Select</option>
                                                @foreach ($insurers as $insurer)
                                                <option value="{{ $insurer->id }}"
                                                    {{ old('insurance_company', @$claim->policy->insurer_id) == $insurer->id ? 'selected' : '' }}> {{ $insurer->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('insurance_company', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3 mt-2">
                                            <label for="policy_type">Policy Type <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="policy_type" name="policy_type" onchange="setGroupName();">
                                                <option value="">Please Select</option>
                                                <option value="Group" {{ old('policy_type', @$claim->policy->policy_type) == 'Group' ? 'selected' : '' }}>Group
                                                </option>
                                                <option value="Retail" {{ old('policy_type', @$claim->policy->policy_type) == 'Retail' ? 'selected' : '' }}>Retail
                                                </option>
                                            </select>
                                            @error('policy_type', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="policy_name">Policy Name <span class="text-danger">*</span></label>
                                            <select disabled class="form-control select2" id="policy_name" name="policy_name" data-toggle="select2">
                                                <option value="">Please Select</option>
                                                @foreach ($insurers as $insurer)
                                                <option value="{{ $insurer->id }}"
                                                    {{ old('policy_name', @$claim->policy->policy_id) == $insurer->id ? 'selected' : '' }}>
                                                    {{ $insurer->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('policy_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="policy_start_date">Policy Start Date <span class="text-danger">*</span></label>
                                            <input type="text" disabled placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy" class="form-control" id="policy_start_date"
                                            name="policy_start_date" value="{{ old('policy_start_date', @$claim->policy->start_date) }}">
                                            @error('policy_start_date', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="policy_expiry_date">Policy Expiry Date <span class="text-danger">*</span></label>
                                            <input type="text" disabled placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy" class="form-control" id="policy_expiry_date"
                                            name="policy_expiry_date" value="{{ old('policy_expiry_date', @$claim->policy->expiry_date) }}">
                                            @error('policy_expiry_date', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="policy_commencement_date_without_break">Policy Commencement Date (without Break) <span  class="text-danger">*</span></label>
                                            <input type="text" disabled placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                            class="form-control" id="policy_commencement_date_without_break" name="policy_commencement_date_without_break"
                                            value="{{ old('policy_commencement_date_without_break', @$claim->policy->commencement_date) }}">
                                            @error('policy_commencement_date_without_break', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_admission">Date of Admission (DD-MM-YYYY) <span class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="date_of_admission" name="date_of_admission"
                                            value="{{ old('date_of_admission', @$claim->admission_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('date_of_admission', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="time_of_admission">Time of Admission (HH:MM) <span class="text-danger">*</span></label>
                                            <input type="time" readonly class="form-control" id="time_of_admission" name="time_of_admission"
                                            value="{{ old('time_of_admission', @$claim->admission_time) }}">
                                            @error('time_of_admission', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="discharge_date">Expected Date of Discharge (DD-MM-YYYY) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="discharge_date" name="discharge_date"
                                                value="{{ old('discharge_date', $claim->discharge_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('discharge_date')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="days_in_hospital">Expected No. of Days in Hospital <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="3" onkeypress="return isNumberKey(event)" class="form-control"
                                                id="days_in_hospital" placeholder="Expected No. of Days in Hospital" name="days_in_hospital"
                                                value="{{ old('days_in_hospital', $claim->days_in_hospital) }}">
                                            @error('days_in_hospital')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="hospitalization_due_to">Hospitalization Due To <span class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="injury" value="Injury"
                                                        name="hospitalization_due_to" @if (old('hospitalzation_due_to', $claim->hospitalization_due_to) == 'Injury') checked @endif>
                                                    <label class="form-check-label" for="injury">Injury</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="illness" value="Illness"
                                                        name="hospitalization_due_to" @if (old('hospitalzation_due_to', $claim->hospitalization_due_to) == 'Illness') checked @endif>
                                                    <label class="form-check-label" for="illness">Illness</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="maternity"value="Maternity"
                                                        name="hospitalization_due_to" @if (old('hospitalzation_due_to', $claim->hospitalization_due_to) == 'Maternity') checked @endif>
                                                    <label class="form-check-label" for="maternity">Maternity</label>
                                                </div>
                                            </div>
                                            @error('hospitalization_due_to')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_delivery">Date of Injury / Date Disease first detected / Date of delivery <span class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="date_of_delivery" name="date_of_delivery"
                                                value="{{ old('date_of_delivery', $claim->date_of_delivery) }}"
                                                placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('date_of_delivery')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="consultation_date">Date of First Consultation (DD-MM-YYYY) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="consultation_date" max="{{ date('Y-m-d') }}"
                                                name="consultation_date" value="{{ old('consultation_date', $claim->consultation_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('consultation_date')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mb-3">
                                            <label for="system_of_medicine">System of Medicine <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="system_of_medicine" name="system_of_medicine" onchange=setMedicineOption();>
                                                <option value="">Select</option>
                                                <option value="Allopathy"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Allopathy' ? 'selected' : '' }}>
                                                    Allopathy
                                                </option>
                                                <option value="Ayurveda"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Ayurveda' ? 'selected' : '' }}>
                                                    Ayurveda
                                                </option>
                                                <option value="Homeopathy"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Homeopathy' ? 'selected' : '' }}>
                                                    Homeopathy
                                                </option>
                                                <option value="Naturopathy"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Naturopathy' ? 'selected' : '' }}>
                                                    Naturopathy
                                                </option>
                                                <option value="Siddha"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Siddha' ? 'selected' : '' }}>
                                                    Siddha
                                                </option>
                                                <option value="Unani"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'Unani' ? 'selected' : '' }}>Unani
                                                </option>
                                                <option value="AYUSH"
                                                    {{ old('system_of_medicine', $claim->system_of_medicine) == 'AYUSH' ? 'selected' : '' }}>AYUSH
                                                </option>
                                            </select>
                                            @error('system_of_medicine')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="treatment_type">Treatment Type <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="treatment_type" name="treatment_type">
                                                <option value="">Select</option>
                                                <option value="OPD"
                                                    {{ old('treatment_type', $claim->treatment_type) == 'OPD' ? 'selected' : '' }}>OPD
                                                </option>
                                                <option value="IPD"
                                                    {{ old('treatment_type', $claim->treatment_type) == 'IPD' ? 'selected' : '' }}>IPD
                                                </option>
                                            </select>
                                            @error('treatment_type')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="admission_type_1">Admission Type - 1 <span class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="emergency" value="Emergency"
                                                        name="admission_type_1" @if (old('admission_type_1', $claim->admission_type_1) == 'Emergency') checked @endif>
                                                    <label class="form-check-label" for="emergency">Emergency</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="planned" value="Planned"
                                                        name="admission_type_1" @if (old('admission_type_1', $claim->admission_type_1) == 'Planned') checked @endif>
                                                    <label class="form-check-label" for="planned">Planned</label>
                                                </div>
                                            </div>
                                            @error('admission_type_1')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="admission_type_2">Admission Type - 2 <span class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="day_care" value="Day Care"
                                                        name="admission_type_2" @if (old('admission_type_2', $claim->admission_type_2) == 'Day Care') checked @endif>
                                                    <label class="form-check-label" for="day_care">Day Care</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="hospitalization" value="Hospitalization"
                                                        name="admission_type_2" @if (old('admission_type_2', $claim->admission_type_2) == 'Hospitalization') checked @endif>
                                                    <label class="form-check-label" for="hospitalization">Hospitalization</label>
                                                </div>
                                            </div>
                                            @error('admission_type_2')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="admission_type_3">Admission Type - 3 <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="admission_type_3" name="admission_type_3">
                                                <option value="">Select</option>
                                                <option value="Main"
                                                    {{ old('admission_type_3', $claim->admission_type_3) == 'Main' ? 'selected' : '' }}>Main
                                                </option>
                                                <option value="Pre"
                                                    {{ old('admission_type_3', $claim->admission_type_3) == 'Pre' ? 'selected' : '' }}>
                                                    Pre
                                                </option>
                                                <option value="Post"
                                                    {{ old('admission_type_3', $claim->admission_type_3) == 'Post' ? 'selected' : '' }}>
                                                    Post
                                                </option>
                                            </select>
                                            @error('admission_type_3')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="claim_category">Claim Category <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="claim_category" name="claim_category">
                                                <option value="">Select</option>
                                                <option value="Cashless"
                                                    {{ old('claim_category', $claim->claim_category) == 'Cashless' ? 'selected' : '' }}>Cashless
                                                </option>
                                                <option value="Reimbursement"
                                                    {{ old('claim_category', $claim->claim_category) == 'Reimbursement' ? 'selected' : '' }}>
                                                    Reimbursement
                                                </option>
                                            </select>
                                            @error('claim_category')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       <div class="col-md-6 mb-3">
                                            <label for="treatment_category">Treatment Category <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="treatment_category" name="treatment_category">
                                                <option value="">Select</option>
                                                <option value="Surgical" {{ old('treatment_category', $claim->treatment_category) == 'Surgical' ? 'selected' : '' }}>Surgical
                                                </option>
                                                <option value="Medical Management"
                                                    {{ old('treatment_category', $claim->treatment_category) == 'Medical Management' ? 'selected' : '' }}>Medical Management
                                                </option>
                                                <option value="Intensive Care"
                                                    {{ old('treatment_category', $claim->treatment_category) == 'Intensive Care' ? 'selected' : '' }}>Intensive Care
                                                </option>
                                                <option value="Investigation"
                                                    {{ old('treatment_category', $claim->treatment_category) == 'Investigation' ? 'selected' : '' }}>Investigation
                                                </option>
                                                <option value="Non Allopathic"
                                                    {{ old('treatment_category', $claim->treatment_category) == 'Non Allopathic' ? 'selected' : '' }}>Non Allopathic
                                                </option>
                                            </select>
                                            @error('treatment_category')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="disease_category">Disease Category <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="disease_category" name="disease_category">
                                                <option value="">Select</option>
                                                <option value="Cardiac"
                                                    {{ old('disease_category', $claim->disease_category) == 'Cardiac' ? 'selected' : '' }}>
                                                    Cardiac
                                                </option>
                                                <option value="Dialysis"
                                                    {{ old('disease_category', $claim->disease_category) == 'Dialysis' ? 'selected' : '' }}>
                                                    Dialysis
                                                </option>
                                                <option value="Eye Related"
                                                    {{ old('disease_category', $claim->disease_category) == 'Eye Related' ? 'selected' : '' }}>
                                                    Eye
                                                    Related
                                                </option>
                                                <option value="Infection"
                                                    {{ old('disease_category', $claim->disease_category) == 'Infection' ? 'selected' : '' }}>
                                                    Infection
                                                </option>
                                                <option value="Maternity"
                                                    {{ old('disease_category', $claim->disease_category) == 'Maternity' ? 'selected' : '' }}>
                                                    Maternity
                                                </option>
                                                <option value="Neuro Related"
                                                    {{ old('disease_category', $claim->disease_category) == 'Neuro Related' ? 'selected' : '' }}>
                                                    Neuro Related
                                                </option>
                                                <option value="Injury"
                                                    {{ old('disease_category', $claim->disease_category) == 'Injury' ? 'selected' : '' }}>Injury
                                                </option>
                                                <option value="Other"
                                                    {{ old('disease_category', $claim->disease_category) == 'Other' ? 'selected' : '' }}>Other
                                                </option>
                                            </select>
                                            @error('disease_category')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="disease_name">Disease Name. <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" maxlength="100" id="disease_name" name="disease_name"
                                                value="{{ old('disease_name', $claim->disease_name) }}" placeholder="Disease Name">
                                            @error('disease_name')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="disease_type">Disease Type <span class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="disease_type" name="disease_type">
                                                <option value="">Select</option>
                                                <option value="PED (Pre Existing Disease)"
                                                    {{ old('disease_type', $claim->disease_type) == 'PED (Pre Existing Disease)' ? 'selected' : '' }}>
                                                    PED (Pre Existing
                                                    Disease)
                                                </option>
                                                <option value="Non PED"
                                                    {{ old('disease_type', $claim->disease_type) == 'Non PED' ? 'selected' : '' }}>Non PED
                                                </option>
                                            </select>
                                            @error('disease_type')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="nature_of_illness">Nature of Illness / Disease with presenting complaints <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="100" class="form-control" id="nature_of_illness"
                                                name="nature_of_illness" value="{{ old('nature_of_illness', $claim->nature_of_illness) }}"
                                                placeholder="Nature of Illness / Disease with presenting complaints">
                                            @error('nature_of_illness')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="clinical_finding">Relevant Clinical Findings <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="45" class="form-control" id="clinical_finding"
                                                name="clinical_finding" value="{{ old('clinical_finding', $claim->clinical_finding) }}"
                                                placeholder="Relevant Clinical Findings">
                                            @error('clinical_finding')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="chronic_illness">Past history of any chronic illness <span
                                                    class="text-danger">*</span></label>
                                            <select disabled class="form-select" id="chronic_illness" name="chronic_illness" onchange="ailnessOptions();">
                                                <option value="">Select</option>
                                                <option value="N/A"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'N/A' ? 'selected' : '' }}>N/A
                                                </option>
                                                <option value="Diabetes"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Diabetes' ? 'selected' : '' }}>Diabetes
                                                </option>
                                                <option value="Hear Disease"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Hear Disease' ? 'selected' : '' }}>
                                                    Hear Disease
                                                </option>
                                                <option value="Hypertension"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Hypertension' ? 'selected' : '' }}>
                                                    Hypertension
                                                </option>
                                                <option value="Hyperlipidaemias"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Hyperlipidaemias' ? 'selected' : '' }}>
                                                    Hyperlipidaemias
                                                </option>
                                                <option value="Osteoarthritis"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Osteoarthritis' ? 'selected' : '' }}>
                                                    Osteoarthritis
                                                </option>
                                                <option value="Asthma-COPD-Bronchitis"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Asthma-COPD-Bronchitis' ? 'selected' : '' }}>
                                                    Asthma-COPD-Bronchitis
                                                </option>
                                                <option value="Cancer"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Cancer' ? 'selected' : '' }}>Cancer
                                                </option>
                                                <option value="Alcohol or Drug Abuse"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Alcohol or Drug Abuse' ? 'selected' : '' }}>
                                                    Alcohol or Drug
                                                    Abuse
                                                </option>
                                                <option value="Any HIV or STD related ailments"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Any HIV or STD related ailments' ? 'selected' : '' }}>
                                                    Any HIV or
                                                    STD related ailments
                                                </option>
                                                <option value="Any other ailment"
                                                    {{ old('chronic_illness', $claim->chronic_illness) == 'Any other ailment' ? 'selected' : '' }}>
                                                    Any other ailment
                                                </option>
                                            </select>
                                            @error('chronic_illness')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="ailment_details">Any other ailment details <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="45" class="form-control" id="ailment_details"
                                                name="ailment_details" value="{{ old('ailment_details', $claim->ailment_details) }}"
                                                placeholder="Any other ailment details">
                                            @error('ailment_details')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-md-12 mt-3 bg-primary text-white" style="line-height: 30px; margin-left: 2px; ;"> Disease & ICD </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="disease_name">Disease Name. <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="100" class="form-control" id="disease_name" name="disease_name"
                                            value="{{ old('disease_name', $claim->disease_name) }}" placeholder="Disease Name">
                                            @error('disease_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Primary Diagnosis - ICD </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger">*</span></label>

                                            <select class="form-control select2" data-toggle="select2" id="primary_diagnosis_icd_leveli_disease" name="primary_diagnosis_icd_leveli_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level1 as $icd_code)
                                                    <option value="{{ $icd_code->level1 }}"
                                                        {{ old('primary_diagnosis_icd_leveli_disease', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveli_disease : '') == $icd_code->level1 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level1_code }}">
                                                        {{ $icd_code->level1 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('primary_diagnosis_icd_leveli_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveli_code">ICD - Level - I - Code <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveli_code" name="primary_diagnosis_icd_leveli_code" placeholder="Enter ICD - Level - I - Code" value="{{ old('primary_diagnosis_icd_leveli_code', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveli_code : '') }}">
                                            @error('primary_diagnosis_icd_leveli_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger">*</span></label>

                                            <select class="form-control select2" data-toggle="select2" id="primary_diagnosis_icd_levelii_disease" name="primary_diagnosis_icd_levelii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level2 as $icd_code)
                                                    <option value="{{ $icd_code->level2 }}"
                                                        {{ old('primary_diagnosis_icd_levelii_disease', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_levelii_disease : '') == $icd_code->level2 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level2_code }}">
                                                        {{ $icd_code->level2 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('primary_diagnosis_icd_levelii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_levelii_code">ICD - Level - II - Code <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_levelii_code" name="primary_diagnosis_icd_levelii_code"  placeholder="Enter ICD - Level - II - Code" value="{{ old('primary_diagnosis_icd_levelii_code', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_levelii_code : '') }}">
                                            @error('primary_diagnosis_icd_levelii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger">*</span></label>

                                            <select class="form-control select2" data-toggle="select2" id="primary_diagnosis_icd_leveliii_disease" name="primary_diagnosis_icd_leveliii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level3 as $icd_code)
                                                    <option value="{{ $icd_code->level3 }}"
                                                        {{ old('primary_diagnosis_icd_leveliii_disease', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveliii_disease : '') == trim($icd_code->level3) ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level3_code }}">
                                                        {{ $icd_code->level3 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('primary_diagnosis_icd_leveliii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveliii_code" name="primary_diagnosis_icd_leveliii_code"  placeholder="Enter ICD - Level - III - Code" value="{{ old('primary_diagnosis_icd_leveliii_code', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveliii_code : '') }}">
                                            @error('primary_diagnosis_icd_leveliii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger">*</span></label>

                                            <select class="form-control select2" data-toggle="select2" id="primary_diagnosis_icd_leveliv_disease" name="primary_diagnosis_icd_leveliv_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level4 as $icd_code)
                                                    <option value="{{ $icd_code->level4 }}"
                                                        {{ old('primary_diagnosis_icd_leveliv_disease', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveliv_disease : '') == $icd_code->level4 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level4_code }}">
                                                        {{ $icd_code->level4 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('primary_diagnosis_icd_leveliv_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="primary_diagnosis_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger">*</span></label>
                                            <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveliv_code" name="primary_diagnosis_icd_leveliv_code"
                                            placeholder="Enter ICD - Level - IV - Code" value="{{ old('primary_diagnosis_icd_leveliv_code', isset($claim_processing) ? $claim_processing->primary_diagnosis_icd_leveliv_code : '') }}">
                                            @error('primary_diagnosis_icd_leveliv_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Additional Diagnosis - ICD </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="additional_diagnosis_icd_leveli_disease" name="additional_diagnosis_icd_leveli_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level1 as $icd_code)
                                                    <option value="{{ $icd_code->level1 }}"
                                                        {{ old('additional_diagnosis_icd_leveli_disease', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveli_disease : '') == $icd_code->level1 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level1_code }}">
                                                        {{ $icd_code->level1 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('additional_diagnosis_icd_leveli_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveli_code">ICD - Level - I - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveli_code" name="additional_diagnosis_icd_leveli_code"
                                            placeholder="Enter ICD - Level - I - Code" value="{{ old('additional_diagnosis_icd_leveli_code', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveli_code : '') }}">
                                            @error('additional_diagnosis_icd_leveli_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="additional_diagnosis_icd_levelii_disease" name="additional_diagnosis_icd_levelii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level2 as $icd_code)
                                                    <option value="{{ $icd_code->level2 }}"
                                                        {{ old('additional_diagnosis_icd_levelii_disease', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_levelii_disease : '') == $icd_code->level2 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level2_code }}">
                                                        {{ $icd_code->level2 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('additional_diagnosis_icd_levelii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_levelii_code">ICD - Level - II - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_levelii_code" name="additional_diagnosis_icd_levelii_code"  placeholder="Enter ICD - Level - II - Code" value="{{ old('additional_diagnosis_icd_levelii_code', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_levelii_code : '') }}">
                                            @error('additional_diagnosis_icd_levelii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="additional_diagnosis_icd_leveliii_disease" name="additional_diagnosis_icd_leveliii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level3 as $icd_code)
                                                    <option value="{{ $icd_code->level3 }}"
                                                        {{ old('additional_diagnosis_icd_leveliii_disease', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveliii_disease : '') == trim($icd_code->level3) ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level3_code }}">
                                                        {{ $icd_code->level3 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('additional_diagnosis_icd_leveliii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveliii_code" name="additional_diagnosis_icd_leveliii_code"  placeholder="Enter ICD - Level - III - Code" value="{{ old('additional_diagnosis_icd_leveliii_code', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveliii_code : '') }}">
                                            @error('additional_diagnosis_icd_leveliii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="additional_diagnosis_icd_leveliv_disease" name="additional_diagnosis_icd_leveliv_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level4 as $icd_code)
                                                    <option value="{{ $icd_code->level4 }}"
                                                        {{ old('additional_diagnosis_icd_leveliv_disease', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveliv_disease : '') == $icd_code->level4 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level4_code }}">
                                                        {{ $icd_code->level4 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('additional_diagnosis_icd_leveliv_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="additional_diagnosis_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveliv_code" name="additional_diagnosis_icd_leveliv_code"  placeholder="Enter ICD - Level - IV - Code" value="{{ old('additional_diagnosis_icd_leveliv_code', isset($claim_processing) ? $claim_processing->additional_diagnosis_icd_leveliv_code : '') }}">
                                            @error('additional_diagnosis_icd_leveliv_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Co-Morbidities - ICD </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="co_morbidities_icd_leveli_disease" name="co_morbidities_icd_leveli_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level1 as $icd_code)
                                                    <option value="{{ $icd_code->level1 }}"
                                                        {{ old('co_morbidities_icd_leveli_disease', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveli_disease : '') == $icd_code->level1 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level1_code }}">
                                                        {{ $icd_code->level1 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('co_morbidities_icd_leveli_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveli_code">ICD - Level - I - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveli_code" name="co_morbidities_icd_leveli_code"
                                            placeholder="Enter ICD - Level - I - Code" value="{{ old('co_morbidities_icd_leveli_code', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveli_code : '') }}">
                                            @error('co_morbidities_icd_leveli_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="co_morbidities_icd_levelii_disease" name="co_morbidities_icd_levelii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level2 as $icd_code)
                                                    <option value="{{ $icd_code->level2 }}"
                                                        {{ old('co_morbidities_icd_levelii_disease', isset($claim_processing) ? $claim_processing->co_morbidities_icd_levelii_disease : '') == $icd_code->level2 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level2_code }}">
                                                        {{ $icd_code->level2 }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('co_morbidities_icd_levelii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_levelii_code">ICD - Level - II - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_levelii_code" name="co_morbidities_icd_levelii_code"
                                            placeholder="Enter ICD - Level - II - Code" value="{{ old('co_morbidities_icd_levelii_code', isset($claim_processing) ? $claim_processing->co_morbidities_icd_levelii_code : '') }}">
                                            @error('co_morbidities_icd_levelii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger"></span></label>

                                           <select class="form-control select2" data-toggle="select2" id="co_morbidities_icd_leveliii_disease" name="co_morbidities_icd_leveliii_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level3 as $icd_code)
                                                    <option value="{{ $icd_code->level3 }}"
                                                        {{ old('co_morbidities_icd_leveliii_disease', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveliii_disease : '') == trim($icd_code->level3) ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level3_code }}">
                                                        {{ $icd_code->level3 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('co_morbidities_icd_leveliii_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveliii_code" name="co_morbidities_icd_leveliii_code"
                                            placeholder="Enter ICD - Level - III - Code" value="{{ old('co_morbidities_icd_leveliii_code', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveliii_code : '') }}">
                                            @error('co_morbidities_icd_leveliii_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="co_morbidities_icd_leveliv_disease" name="co_morbidities_icd_leveliv_disease">
                                                <option value="">Please Select</option>
                                                @foreach ($icd_codes_level4 as $icd_code)
                                                    <option value="{{ $icd_code->level4 }}"
                                                        {{ old('co_morbidities_icd_leveliv_disease', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveliv_disease : '') == $icd_code->level4 ? 'selected' : '' }}
                                                        data-code="{{ $icd_code->level4_code }}">
                                                        {{ $icd_code->level4 }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('co_morbidities_icd_leveliv_disease', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="co_morbidities_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveliv_code" name="co_morbidities_icd_leveliv_code"
                                            placeholder="Enter ICD - Level - IV - Code" value="{{ old('co_morbidities_icd_leveliv_code', isset($claim_processing) ? $claim_processing->co_morbidities_icd_leveliv_code : '') }}">
                                            @error('co_morbidities_icd_leveliv_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="co_morbidities_comments">Co-Morbidities - Comments </label>
                                            <textarea class="form-control" id="co_morbidities_comments" name="co_morbidities_comments" maxlength="250" placeholder="Comments"  rows="5">{{ old('co_morbidities_comments', isset($claim_processing) ? $claim_processing->co_morbidities_comments : '') }}</textarea>
                                            @error('co_morbidities_comments', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                         <div class="col-md-12 mt-3 bg-primary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure & PCS Code </div>

                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Details of Procedure Done  </div>



                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_name">Procedure Name <span class="text-danger"></span></label>
                                            <input type="text" maxlength="100" class="form-control" id="procedure_name" name="procedure_name"
                                            placeholder="Enter Procedure Name" value="{{ old('procedure_name', isset($claim_processing) ? $claim_processing->procedure_name : '') }}">
                                            @error('procedure_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - I </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_group_name">PCS Group - Name <span class="text-danger"></span></label>

                                            <select class="form-control select2" data-toggle="select2" id="procedure_i_pcs_group_name" name="procedure_i_pcs_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_group_name }}"
                                                        {{ old('procedure_i_pcs_group_name', isset($claim_processing) ? $claim_processing->procedure_i_pcs_group_name : '') == $pcs_group->pcs_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_group_code }}">
                                                        {{ $pcs_group->pcs_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('procedure_i_pcs_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_group_code">PCS Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_group_code" name="procedure_i_pcs_group_code"
                                            placeholder="Enter PCS Group - Code" value="{{ old('procedure_i_pcs_group_code', isset($claim_processing) ? $claim_processing->procedure_i_pcs_group_code : '') }}">
                                            @error('procedure_i_pcs_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_i_pcs_sub_group_name" name="procedure_i_pcs_sub_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_sub_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_sub_group_name }}"
                                                        {{ old('procedure_i_pcs_sub_group_name', isset($claim_processing) ? $claim_processing->procedure_i_pcs_sub_group_name : '') == $pcs_group->pcs_sub_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_sub_group_code }}">
                                                        {{ $pcs_group->pcs_sub_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_i_pcs_sub_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_sub_group_code" name="procedure_i_pcs_sub_group_code"
                                            placeholder="Enter PCS Group - Code" value="{{ old('procedure_i_pcs_sub_group_code', isset($claim_processing) ? $claim_processing->procedure_i_pcs_sub_group_code : '') }}">
                                            @error('procedure_i_pcs_sub_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_short_name">PCS Short Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_i_pcs_short_name" name="procedure_i_pcs_short_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_short_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_short_name }}"
                                                        {{ old('procedure_i_pcs_short_name', isset($claim_processing) ? $claim_processing->procedure_i_pcs_short_name : '') == $pcs_group->pcs_short_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_code }}" data-long_name="{{ $pcs_group->pcs_long_name }}">
                                                        {{ $pcs_group->pcs_short_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_i_pcs_short_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_i_pcs_code">PCS Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_code" name="procedure_i_pcs_code"
                                            placeholder="Enter PCS Code" value="{{ old('procedure_i_pcs_code', isset($claim_processing) ? $claim_processing->procedure_i_pcs_code : '') }}">
                                            @error('procedure_i_pcs_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="procedure_i_pcs_long_name">PCS Long Name <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_long_name" name="procedure_i_pcs_long_name"
                                            placeholder="Enter PCS Long Name" value="{{ old('procedure_i_pcs_long_name', isset($claim_processing) ? $claim_processing->procedure_i_pcs_long_name : '') }}">
                                            @error('procedure_i_pcs_long_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - II </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_group_name">PCS Group - Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_ii_pcs_group_name" name="procedure_ii_pcs_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_group_name }}"
                                                        {{ old('procedure_ii_pcs_group_name', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_group_name : '') == $pcs_group->pcs_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_group_code }}">
                                                        {{ $pcs_group->pcs_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_ii_pcs_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_group_code">PCS Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_group_code" name="procedure_ii_pcs_group_code"
                                            placeholder="Enter PCS Group - Code" value="{{ old('procedure_ii_pcs_group_code', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_group_code : '') }}">
                                            @error('procedure_ii_pcs_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_ii_pcs_sub_group_name" name="procedure_ii_pcs_sub_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_sub_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_sub_group_name }}"
                                                        {{ old('procedure_ii_pcs_sub_group_name', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_sub_group_name : '') == $pcs_group->pcs_sub_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_sub_group_code }}">
                                                        {{ $pcs_group->pcs_sub_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_ii_pcs_sub_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_sub_group_code" name="procedure_ii_pcs_sub_group_code"
                                            placeholder="Enter PCS Sub-Group - Code " value="{{ old('procedure_ii_pcs_sub_group_code', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_sub_group_code : '') }}">
                                            @error('procedure_ii_pcs_sub_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_short_name">PCS Short Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_ii_pcs_short_name" name="procedure_ii_pcs_short_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_short_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_short_name }}"
                                                        {{ old('procedure_ii_pcs_short_name', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_short_name : '') == $pcs_group->pcs_short_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_code }}" data-long_name="{{ $pcs_group->pcs_long_name }}">
                                                        {{ $pcs_group->pcs_short_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_ii_pcs_short_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_ii_pcs_code">PCS Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_code" name="procedure_ii_pcs_code"
                                            placeholder="Enter PCS Code " value="{{ old('procedure_ii_pcs_code', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_code : '') }}">
                                            @error('procedure_ii_pcs_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="procedure_ii_pcs_long_name">PCS Long Name <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_long_name" name="procedure_ii_pcs_long_name"
                                            placeholder="Enter PCS Long Name" value="{{ old('procedure_ii_pcs_long_name', isset($claim_processing) ? $claim_processing->procedure_ii_pcs_long_name : '') }}">
                                            @error('procedure_ii_pcs_long_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - III </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_group_name">PCS Group - Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_iii_pcs_group_name" name="procedure_iii_pcs_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_group_name }}"
                                                        {{ old('procedure_iii_pcs_group_name', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_group_name : '') == $pcs_group->pcs_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_group_code }}">
                                                        {{ $pcs_group->pcs_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_iii_pcs_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_group_code">PCS Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_group_code" name="procedure_iii_pcs_group_code"
                                            placeholder="Enter PCS Group - Code" value="{{ old('procedure_iii_pcs_group_code', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_group_code : '') }}">
                                            @error('procedure_iii_pcs_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_iii_pcs_sub_group_name" name="procedure_iii_pcs_sub_group_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_sub_group_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_sub_group_name }}"
                                                        {{ old('procedure_iii_pcs_sub_group_name', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_sub_group_name : '') == $pcs_group->pcs_sub_group_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_sub_group_code }}">
                                                        {{ $pcs_group->pcs_sub_group_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_iii_pcs_sub_group_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_sub_group_code" name="procedure_iii_pcs_sub_group_code"
                                            placeholder="Enter PCS Sub-Group - Code" value="{{ old('procedure_iii_pcs_sub_group_code', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_sub_group_code : '') }}">
                                            @error('procedure_iii_pcs_sub_group_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_short_name">PCS Short Name <span class="text-danger"></span></label>
                                            <select class="form-control select2" data-toggle="select2" id="procedure_iii_pcs_short_name" name="procedure_iii_pcs_short_name">
                                                <option value="">Please Select</option>
                                                @foreach ($pcs_short_name as $pcs_group)
                                                    <option value="{{ $pcs_group->pcs_short_name }}"
                                                        {{ old('procedure_iii_pcs_short_name', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_short_name : '') == $pcs_group->pcs_short_name ? 'selected' : '' }}
                                                        data-code="{{ $pcs_group->pcs_code }}" data-long_name="{{ $pcs_group->pcs_long_name }}">
                                                        {{ $pcs_group->pcs_short_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('procedure_iii_pcs_short_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="procedure_iii_pcs_code">PCS Code <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_code" name="procedure_iii_pcs_code"
                                            placeholder="Enter PCS Code" value="{{ old('procedure_iii_pcs_code', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_code : '') }}">
                                            @error('procedure_iii_pcs_code', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="procedure_iii_pcs_long_name">PCS Long Name <span class="text-danger"></span></label>
                                            <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_long_name" name="procedure_iii_pcs_long_name"
                                            placeholder="Enter PCS Long Name" value="{{ old('procedure_iii_pcs_long_name', isset($claim_processing) ? $claim_processing->procedure_iii_pcs_long_name : '') }}">
                                            @error('procedure_iii_pcs_long_name', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="final_assessment_status">Final Assessment Status <span class="text-danger">*</span></label>
                                            <select class="form-select" id="final_assessment_status" name="final_assessment_status">
                                                <option value="Waiting for Final Assessment" {{ old('final_assessment_status', isset($claim_processing) ? $claim_processing->final_assessment_status : '') == 'Waiting for Final Assessment' ? 'selected' : '' }}>Waiting for Final Assessment </option>
                                                <option value="Query Raised by BHC Team" {{ old('final_assessment_status', isset($claim_processing) ? $claim_processing->final_assessment_status : '') == 'Query Raised by BHC Team' ? 'selected' : '' }}>Query Raised by BHC Team </option>
                                                <option value="Non Admissible as per the Policy TC" {{ old('final_assessment_status', isset($claim_processing) ? $claim_processing->final_assessment_status : '') == 'Non Admissible as per the Policy TC' ? 'selected' : '' }}>Non Admissible as per the Policy TC </option>
                                                <option value="Non Admissible as per the Treatment Received" {{ old('final_assessment_status', isset($claim_processing) ? $claim_processing->final_assessment_status : '') == 'Non Admissible as per the Treatment Received' ? 'selected' : '' }}>Non Admissible as per the Treatment Received </option>
                                                <option value="Admissible" {{ old('final_assessment_status', isset($claim_processing) ? $claim_processing->final_assessment_status : '') == 'Admissible' ? 'selected' : '' }}>Admissible </option>
                                            </select>
                                            @error('final_assessment_status', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3 bg-primary text-white" style="line-height: 30px; margin-left: 2px; ;"> Add Query </div>

                                        <div class="col-md-12 text-end mt-3">
                                            <button type="button" class="btn btn-success add-query" disabled >Add Query</button>
                                            <input type="hidden" name="add_query_clicked" id="add_query_clicked" value="0">
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="processing_query">Query <span class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="250" class="form-control"
                                            id="processing_query" placeholder="Enter Query" name="processing_query"
                                            value="{{ old('processing_query', isset($claim_processing) ? $claim_processing->processing_query : '') }}">
                                            @error('processing_query', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3 bg-primary text-white" style="line-height: 30px; margin-left: 2px; ;"> Assessment </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_amount">Final Assessment Amount <span class="text-danger">*</span></label>
                                            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" class="form-control final_assessment_amount"  id="final_assessment_amount" placeholder="Enter Final Assessment Amount" name="final_assessment_amount"
                                            value="{{ old('final_assessment_amount', (isset($claim_processing) && !empty($claim_processing->final_assessment_amount))  ? $claim_processing->final_assessment_amount : $claim->estimated_amount) }}">
                                            @error('final_assessment_amount', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="final_assessment_comments">Final Assessment Comments </label>
                                            <textarea class="form-control" id="final_assessment_comments" name="final_assessment_comments" maxlength="250" placeholder="Enter Final Assessment Comments"  rows="5">{{ old('final_assessment_comments', isset($claim_processing) ? $claim_processing->final_assessment_comments : '') }}</textarea>
                                            @error('final_assessment_comments', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success" form="claim-processing-form">Save / Update Final Assessment</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
<script>

    var final_assessment_status = "{{ old('final_assessment_status', @$claim_processing->final_assessment_status) }}";
    var add_query_clicked = "{{ old('add_query_clicked') }}";

    if(add_query_clicked == 1){
            $("#processing_query").attr('readonly', false);
    }

    if(final_assessment_status == 'Query Raised by BHC Team'){
            $(".add-query").attr('disabled', false);
        }else{
            $(".add-query").attr('disabled', true);
            $("#processing_query").attr('readonly', true);
        }

    $(document).on('change', '#final_assessment_status', function(event) {
        if($(this).val() == 'Query Raised by BHC Team'){
            $(".add-query").attr('disabled', false);
        }else{
            $(".add-query").attr('disabled', true);
            $("#processing_query").attr('readonly', true);
        }
    });

    $(document).on('click', '.add-query', function(event) {
        $("#add_query_clicked").val(1);
        $("#processing_query").attr('readonly', false);
    });

    $('select').change(function(event) {

        var id = $(this).attr('id');

        if(id.includes("disease")){
        var new_id = id.replace("disease", "code");
        }

        if(id.includes("procedure_ii_pcs") || id.includes("procedure_i_pcs") || id.includes("procedure_iii_pcs")){
        var new_id = id.replace("name", "code");
        }

        if(id.includes("short_name")){
        var new_id = id.replace("short_name", "code");
        var new_id_id = id.replace("short_name", "long_name");
        }

        $("#"+new_id).attr('readonly', true);;
        $("#"+new_id_id).attr('readonly', true);;
        $("#"+new_id).val($(this).select2().find(":selected").data("code"));
        $("#"+new_id_id).val($(this).select2().find(":selected").data("long_name"));
    });


    if($('#primary_diagnosis_icd_leveli_disease').val() == ''){
        $('#primary_diagnosis_icd_leveli_disease').val("").trigger('change');
    }

    if($('#additional_diagnosis_icd_leveli_disease').val() == ''){
        $('#additional_diagnosis_icd_leveli_disease').val("").trigger('change');
    }

    if($('#co_morbidities_icd_leveli_disease').val() == ''){
        $('#co_morbidities_icd_leveli_disease').val("").trigger('change');
    }

</script>
@endpush

