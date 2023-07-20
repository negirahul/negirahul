@extends('layouts.super-admin')
@section('title', 'New Claim')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claims</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.claims.index') }}">Claims</a>
                            </li>
                            <li class="breadcrumb-item active">New Claim</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Claim Processing</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                        <form action="{{ route('super-admin.claims.processing') }}" method="post" id="claim-form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12 mb-3">
                                    <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="patient_id" name="patient_id" maxlength="60"
                                    placeholder="Enter Patient Id" value="{{ old('patient_id') }}">
                                    @error('patient_id')
                                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="firstname">Patient Name <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" id="patient_title" name="patient_title">
                                        <option value="">Select</option>
                                        <option value="Mr." {{ old('patient_title') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                                        <option value="Ms." {{ old('patient_title') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                                    </select>
                                    @error('patient_title')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <input type="text" maxlength="25" class="form-control" id="patient_lastname"
                                    name="patient_lastname" placeholder="Last name"
                                    value="{{ old('patient_lastname') }}">
                                    @error('patient_lastname')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <input type="text" maxlength="25" class="form-control" id="patient_firstname"
                                    name="patient_firstname" placeholder="First name"
                                    value="{{ old('patient_firstname') }}">
                                    @error('patient_firstname')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <input type="text" maxlength="25" class="form-control" id="patient_middlename"
                                    name="patient_middlename" placeholder="Middle name"
                                    value="{{ old('patient_middlename') }}">
                                    @error('patient_middlename')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="patient_age">Patient Age <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control"
                                    id="patient_age" name="patient_age" placeholder="Patient Age"
                                    value="{{ old('patient_age') }}">
                                    @error('patient_age')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="patient_gender">Patient Gender <span class="text-danger">*</span></label>
                                    <select class="form-select" id="patient_gender" name="patient_gender">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('patient_gender') == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ old('patient_gender') == 'Female' ? 'selected' : '' }}>Female
                                        </option>
                                        <option value="Other" {{ old('patient_gender') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('patient_gender')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3">
                                    <label for="patient_current_residential_address">Patient Current Resedential Address <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control"
                                    id="patient_current_residential_address" name="patient_current_residential_address"
                                    placeholder="Address Line" value="{{ old('patient_current_residential_address') }}">
                                    @error('patient_current_residential_address')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="patient_current_city"
                                    name="patient_current_city" placeholder="City"
                                    value="{{ old('patient_current_city') }}">
                                    @error('patient_current_city')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="patient_current_state"
                                    name="patient_current_state" placeholder="State"
                                    value="{{ old('patient_current_state') }}">
                                    @error('patient_current_state')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="number" class="form-control" id="patient_current_pincode"
                                    name="patient_current_pincode" pattern="/^-?\d+\.?\d*$/"
                                    onKeyPress="if(this.value.length==6) return false;" placeholder="Pincode"
                                    value="{{ old('patient_current_pincode') }}">
                                    @error('patient_current_pincode')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hospital_id" name="hospital_id"
                                    placeholder="Enter Hospital Id" value="{{ old('hospital_id') }}">
                                    @error('hospital_id')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hospital_name" name="hospital_name"
                                    placeholder="Enter Hospital Name" value="{{ old('hospital_name') }}">
                                    @error('hospital_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-2 mb-1">
                                    <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hospital_address" name="hospital_address"
                                    placeholder="Address Line"
                                    value="{{ old('hospital_address') }}">
                                    @error('hospital_address')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="hospital_city" name="hospital_city" placeholder="City"
                                    value="{{ old('hospital_city') }}">
                                    @error('hospital_city')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="hospital_state" name="hospital_state" placeholder="State"
                                    value="{{ old('hospital_state') }}">
                                    @error('hospital_state')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="number" class="form-control" id="hospital_pincode" name="hospital_pincode"
                                    placeholder="Pincode" value="{{ old('hospital_pincode') }}">
                                    @error('hospital_pincode')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 mt-2">
                                    <label for="insurance_company">Insurance Company<span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="insurance_company" name="insurance_company" data-toggle="select2">
                                        <option value="">Please Select</option>
                                        @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}"
                                            {{ old('insurance_company') == $insurer->id ? 'selected' : '' }}> {{ $insurer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('insurance_company')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 mt-2">
                                    <label for="policy_type">Policy Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="policy_type" name="policy_type" onchange="setGroupName();">
                                        <option value="">Please Select</option>
                                        <option value="Group" {{ old('policy_type') == 'Group' ? 'selected' : '' }}>Group
                                        </option>
                                        <option value="Retail" {{ old('policy_type') == 'Retail' ? 'selected' : '' }}>Retail
                                        </option>
                                    </select>
                                    @error('policy_type')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="policy_name">Policy Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="policy_name" name="policy_name" data-toggle="select2">
                                        <option value="">Please Select</option>
                                        @foreach ($insurers as $insurer)
                                        <option value="{{ $insurer->id }}"
                                            {{ old('policy_name') == $insurer->id ? 'selected' : '' }}>
                                            {{ $insurer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('policy_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="policy_start_date">Policy Start Date <span class="text-danger">*</span></label>
                                    <input type="date" placeholder="Enter Policy Start Date" class="form-control" id="policy_start_date"
                                    name="policy_start_date" value="{{ old('policy_start_date') }}">
                                    @error('policy_start_date')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="policy_expiry_date">Policy Expiry Date <span class="text-danger">*</span></label>
                                    <input type="date" placeholder="Enter Policy Expiry Date" class="form-control" id="policy_expiry_date"
                                    name="policy_expiry_date" value="{{ old('policy_expiry_date') }}">
                                    @error('policy_expiry_date')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="policy_commencement_date_without_break">Policy Commencement Date (without Break) <span  class="text-danger">*</span></label>
                                    <input type="date" placeholder="Enter Policy Commencement Date (without Break)"
                                    class="form-control" id="policy_commencement_date_without_break" name="policy_commencement_date_without_break"
                                    value="{{ old('policy_commencement_date_without_break') }}">
                                    @error('policy_commencement_date_without_break')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_of_admission">Date of Admission (DD-MM-YYYY) <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_of_admission" name="date_of_admission"
                                    value="{{ old('date_of_admission') }}">
                                    @error('date_of_admission')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="time_of_admission">Time of Admission (HH:MM) <span class="text-danger">*</span></label>
                                    <input type="time" class="form-control" id="time_of_admission" name="time_of_admission"
                                    value="{{ old('time_of_admission') }}">
                                    @error('time_of_admission')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="expected_date_of_discharge">Expected Date of Discharge </label>
                                    <input class="form-control" {{ old('expected_date_of_discharge') }} id="expected_date_of_discharge" name="expected_date_of_discharge"  placeholder="Probable Date of Discharge"></input>
                                    @error('expected_date_of_discharge')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>   

                                <div class="col-md-6 mb-3">
                                    <label for="expected_no_of_days_in_hospital">Expected No. of Days in Hospital </label>
                                    <input type="number" class="form-control" {{ old('expected_no_of_days_in_hospital') }} id="expected_no_of_days_in_hospital" name="expected_no_of_days_in_hospital"  placeholder="Probable Date of Discharge"></input>
                                    @error('expected_no_of_days_in_hospital')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>   

                                <div class="col-md-12 mb-3">
                                    <label for="hospitalization_due_to">Hospitalization Due To <span class="text-danger">*</span></label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="injury" value="Injury"
                                            name="hospitalization_due_to" {{ old('hospitalization_due_to') == 'Injury' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="injury">Injury</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="illness" value="Illness"
                                            name="hospitalization_due_to" {{ old('hospitalization_due_to') == 'Illness' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="illness">Illness</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="maternity" value="Maternity"
                                            name="hospitalization_due_to" {{ old('hospitalization_due_to') == 'Maternity' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="maternity">Maternity</label>
                                        </div>
                                    </div>
                                    @error('hospitalization_due_to')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_of_delivery">Date of Injury / Date Disease first detected / Date of delivery   (DD-MM-YYYY) <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_of_delivery" name="date_of_delivery"
                                    value="{{ old('date_of_delivery') }}"
                                    placeholder="Date of Injury / Date Disease first detected / Date of delivery (DD-MM-YYYY)">
                                    @error('date_of_delivery')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3 mt-3">
                                    <label for="date_of_first_consultation">Date of First Consultation  (DD-MM-YYYY) <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_of_first_consultation" name="date_of_first_consultation"
                                    value="{{ old('date_of_first_consultation') }}"
                                    placeholder="Date of Injury / Date Disease first detected / Date of delivery (DD-MM-YYYY)">
                                    @error('date_of_first_consultation')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="system_of_medicine">System of Medicine <span class="text-danger">*</span></label>
                                    <select class="form-select" id="system_of_medicine" name="system_of_medicine">
                                        <option value="">Select</option>
                                        <option value="Allopathy" {{ old('system_of_medicine') == 'Allopathy' ? 'selected' : '' }}>
                                            Allopathy
                                        </option>
                                        <option value="Ayurveda" {{ old('system_of_medicine') == 'Ayurveda' ? 'selected' : '' }}>Ayurveda
                                        </option>
                                        <option value="Homeopathy" {{ old('system_of_medicine') == 'Homeopathy' ? 'selected' : '' }}>
                                            Homeopathy
                                        </option>
                                        <option value="Naturopathy" {{ old('system_of_medicine') == 'Naturopathy' ? 'selected' : '' }}>
                                            Naturopathy
                                        </option>
                                        <option value="Siddha" {{ old('system_of_medicine') == 'Siddha' ? 'selected' : '' }}>Siddha
                                        </option>
                                        <option value="Unani" {{ old('system_of_medicine') == 'Unani' ? 'selected' : '' }}>Unani
                                        </option>
                                        <option value="AYUSH" {{ old('system_of_medicine') == 'AYUSH' ? 'selected' : '' }}>AYUSH
                                        </option>
                                    </select>
                                    @error('system_of_medicine')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="treatment_type">Treatment Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="treatment_type" name="treatment_type">
                                        <option value="">Select</option>
                                        <option value="OPD" {{ old('treatment_type') == 'OPD' ? 'selected' : '' }}>OPD
                                        </option>
                                        <option value="IPD" {{ old('treatment_type') == 'IPD' ? 'selected' : '' }}>IPD
                                        </option>
                                    </select>
                                    @error('treatment_type')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-1">
                                    <label for="admission_type_1">Admission Type - 1 <span class="text-danger">*</span></label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="emergency" value="Emergency"
                                            name="admission_type_1" {{ old('admission_type_1') == 'Emergency' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="emergency">Emergency</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="planned" value="Planned"
                                            name="admission_type_1" {{ old('admission_type_1') == 'Planned' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="planned">Planned</label>
                                        </div>
                                    </div>
                                    @error('admission_type_1')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="admission_type_2">Admission Type - 2 <span class="text-danger">*</span></label>
                                    <div class="mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="day_care" value="Day Care"
                                            name="admission_type_2" {{ old('admission_type_2') == 'Day Care' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="day_care">Day Care</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="hospitalization" value="Hospitalization"
                                            name="admission_type_2" {{ old('admission_type_2') == 'Hospitalization' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hospitalization">Hospitalization</label>
                                        </div>
                                    </div>
                                    @error('admission_type_2')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="admission_type_3">Admission Type - 3 <span class="text-danger">*</span></label>
                                    <select class="form-select" id="admission_type_3" name="admission_type_3">
                                        <option value="">Select</option>
                                        <option value="Main" {{ old('admission_type_3') == 'Main' ? 'selected' : '' }}>Main
                                        </option>
                                        <option value="Pre-Post" {{ old('admission_type_3') == 'Pre-Post' ? 'selected' : '' }}>Pre-Post
                                        </option>
                                    </select>
                                    @error('admission_type_3')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="claim_category">Claim Category <span class="text-danger">*</span></label>
                                    <select class="form-select" id="claim_category" name="claim_category">
                                        <option value="">Select</option>
                                        <option value="Cashless" {{ old('claim_category') == 'Cashless' ? 'selected' : '' }}>Cashless
                                        </option>
                                        <option value="Reimbursement" {{ old('claim_category') == 'Reimbursement' ? 'selected' : '' }}>
                                            Reimbursement
                                        </option>
                                    </select>
                                    @error('claim_category')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="treatment_category">Treatment Category <span class="text-danger">*</span></label>
                                    <select class="form-select" id="treatment_category" name="treatment_category">
                                        <option value="">Select</option>
                                        <option value="OPD" {{ old('treatment_category') == 'OPD' ? 'selected' : '' }}>OPD
                                        </option>
                                        <option value="IPD" {{ old('treatment_category') == 'IPD' ? 'selected' : '' }}>IPD
                                        </option>
                                    </select>
                                    @error('treatment_category')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="disease_category">Disease Category <span class="text-danger">*</span></label>
                                    <select class="form-select" id="disease_category" name="disease_category">
                                        <option value="">Select</option>
                                        <option value="Cardiac" {{ old('disease_category') == 'Cardiac' ? 'selected' : '' }}>Cardiac
                                        </option>
                                        <option value="Dialysis" {{ old('disease_category') == 'Dialysis' ? 'selected' : '' }}>Dialysis
                                        </option>
                                        <option value="Eye Related" {{ old('disease_category') == 'Eye Related' ? 'selected' : '' }}>Eye
                                            Related
                                        </option>
                                        <option value="Infection" {{ old('disease_category') == 'Infection' ? 'selected' : '' }}>Infection
                                        </option>
                                        <option value="Maternity" {{ old('disease_category') == 'Maternity' ? 'selected' : '' }}>
                                            Maternity
                                        </option>
                                        <option value="Neuro Related" {{ old('disease_category') == 'Neuro Related' ? 'selected' : '' }}>
                                            Neuro Related
                                        </option>
                                        <option value="Injury" {{ old('disease_category') == 'Injury' ? 'selected' : '' }}>Injury
                                        </option>
                                        <option value="Other" {{ old('disease_category') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('disease_category')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="disease_name">Disease Name. <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" id="disease_name" name="disease_name"
                                    value="{{ old('disease_name') }}" placeholder="Disease Name">
                                    @error('disease_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="disease_type">Disease Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="disease_type" name="disease_type">
                                        <option value="">Select</option>
                                        <option value="PED (Pre Existing Disease)"  {{ old('disease_type') == 'PED (Pre Existing Disease)' ? 'selected' : '' }}>PED (Pre Existing Disease)  </option>
                                        <option value="Non PED" {{ old('disease_type') == 'Non PED' ? 'selected' : '' }}>Non PED </option>
                                    </select>
                                    @error('disease_type')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="nature_of_illness_disease_with_presenting_complaints">Nature of Illness/Disease with presenting complaints <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nature_of_illness_disease_with_presenting_complaints" name="nature_of_illness_disease_with_presenting_complaints"
                                    placeholder="Associate Partner ID" value="{{ old('nature_of_illness_disease_with_presenting_complaints') }}">
                                    @error('nature_of_illness_disease_with_presenting_complaints')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="relevant_clinical_findings">Relevant Clinical Findings <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="relevant_clinical_findings" name="relevant_clinical_findings"
                                    placeholder="Associate Partner ID" value="{{ old('relevant_clinical_findings') }}">
                                    @error('relevant_clinical_findings')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="past_history_of_any_chronic_illness">Past history of any chronic illness </label>
                                    <input class="form-control" {{ old('past_history_of_any_chronic_illness') }} id="past_history_of_any_chronic_illness" name="past_history_of_any_chronic_illness"  placeholder="Probable Date of Discharge"></input>
                                    @error('past_history_of_any_chronic_illness')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>     

                                <div class="col-md-6 mt-3">
                                    <label for="any_other_aliment_details">Any other ailment details</label>
                                    <input type="text" class="form-control" {{ old('any_other_aliment_details') }} id="any_other_aliment_details" name="any_other_aliment_details"  placeholder="Probable Date of Discharge"></input>
                                    @error('any_other_aliment_details')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>     

                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Primary Diagnosis - ICD </div>


                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="primary_diagnosis_icd_leveli_disease" name="primary_diagnosis_icd_leveli_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('primary_diagnosis_icd_leveli_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('primary_diagnosis_icd_leveli_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('primary_diagnosis_icd_leveli_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('primary_diagnosis_icd_leveli_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveli_code">ICD - Level - I - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveli_code" name="primary_diagnosis_icd_leveli_code" placeholder="Enter ICD - Level - I - Code" value="{{ old('primary_diagnosis_icd_leveli_code') }}">
                                    @error('primary_diagnosis_icd_leveli_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="primary_diagnosis_icd_levelii_disease" name="primary_diagnosis_icd_levelii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('primary_diagnosis_icd_levelii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('primary_diagnosis_icd_levelii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('primary_diagnosis_icd_levelii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('primary_diagnosis_icd_levelii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_levelii_code">ICD - Level - II - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_levelii_code" name="primary_diagnosis_icd_levelii_code"  placeholder="Enter ICD - Level - II - Code" value="{{ old('primary_diagnosis_icd_levelii_code') }}">
                                    @error('primary_diagnosis_icd_levelii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="primary_diagnosis_icd_leveliii_disease" name="primary_diagnosis_icd_leveliii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('primary_diagnosis_icd_leveliii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('primary_diagnosis_icd_leveliii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('primary_diagnosis_icd_leveliii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('primary_diagnosis_icd_leveliii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveliii_code" name="primary_diagnosis_icd_leveliii_code"  placeholder="Enter ICD - Level - III - Code" value="{{ old('primary_diagnosis_icd_leveliii_code') }}">
                                    @error('primary_diagnosis_icd_leveliii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="primary_diagnosis_icd_leveliv_disease" name="primary_diagnosis_icd_leveliv_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('primary_diagnosis_icd_leveliv_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('primary_diagnosis_icd_leveliv_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('primary_diagnosis_icd_leveliv_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('primary_diagnosis_icd_leveliv_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="primary_diagnosis_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="primary_diagnosis_icd_leveliv_code" name="primary_diagnosis_icd_leveliv_code"
                                    placeholder="Enter ICD - Level - IV - Code" value="{{ old('primary_diagnosis_icd_leveliv_code') }}">
                                    @error('primary_diagnosis_icd_leveliv_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Additional Diagnosis - ICD </div>


                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="additional_diagnosis_icd_leveli_disease" name="additional_diagnosis_icd_leveli_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('additional_diagnosis_icd_leveli_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('additional_diagnosis_icd_leveli_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('additional_diagnosis_icd_leveli_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('additional_diagnosis_icd_leveli_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveli_code">ICD - Level - I - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveli_code" name="additional_diagnosis_icd_leveli_code"
                                    placeholder="Enter ICD - Level - I - Code" value="{{ old('additional_diagnosis_icd_leveli_code') }}">
                                    @error('additional_diagnosis_icd_leveli_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="additional_diagnosis_icd_levelii_disease" name="additional_diagnosis_icd_levelii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('additional_diagnosis_icd_levelii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('additional_diagnosis_icd_levelii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('additional_diagnosis_icd_levelii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('additional_diagnosis_icd_levelii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_levelii_code">ICD - Level - II - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_levelii_code" name="additional_diagnosis_icd_levelii_code"  placeholder="Enter ICD - Level - II - Code" value="{{ old('additional_diagnosis_icd_levelii_code') }}">
                                    @error('additional_diagnosis_icd_levelii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="additional_diagnosis_icd_leveliii_disease" name="additional_diagnosis_icd_leveliii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('additional_diagnosis_icd_leveliii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('additional_diagnosis_icd_leveliii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('additional_diagnosis_icd_leveliii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('additional_diagnosis_icd_leveliii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveliii_code" name="additional_diagnosis_icd_leveliii_code"  placeholder="Enter ICD - Level - III - Code" value="{{ old('additional_diagnosis_icd_leveliii_code') }}">
                                    @error('additional_diagnosis_icd_leveliii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="additional_diagnosis_icd_leveliv_disease" name="additional_diagnosis_icd_leveliv_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('additional_diagnosis_icd_leveliv_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('additional_diagnosis_icd_leveliv_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('additional_diagnosis_icd_leveliv_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('additional_diagnosis_icd_leveliv_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="additional_diagnosis_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="additional_diagnosis_icd_leveliv_code" name="additional_diagnosis_icd_leveliv_code"  placeholder="Enter ICD - Level - IV - Code" value="{{ old('additional_diagnosis_icd_leveliv_code') }}">
                                    @error('additional_diagnosis_icd_leveliv_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Co-Morbidities - ICD </div>


                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveli_disease">ICD - Level - I - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="co_morbidities_icd_leveli_disease" name="co_morbidities_icd_leveli_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('co_morbidities_icd_leveli_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('co_morbidities_icd_leveli_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('co_morbidities_icd_leveli_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('co_morbidities_icd_leveli_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveli_code">ICD - Level - I - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveli_code" name="co_morbidities_icd_leveli_code"
                                    placeholder="Enter ICD - Level - I - Code" value="{{ old('co_morbidities_icd_leveli_code') }}">
                                    @error('co_morbidities_icd_leveli_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_levelii_disease">ICD - Level - II - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="co_morbidities_icd_levelii_disease" name="co_morbidities_icd_levelii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('co_morbidities_icd_levelii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('co_morbidities_icd_levelii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('co_morbidities_icd_levelii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('co_morbidities_icd_levelii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_levelii_code">ICD - Level - II - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_levelii_code" name="co_morbidities_icd_levelii_code"
                                    placeholder="Enter ICD - Level - II - Code" value="{{ old('co_morbidities_icd_levelii_code') }}">
                                    @error('co_morbidities_icd_levelii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveliii_disease">ICD - Level - III - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="co_morbidities_icd_leveliii_disease" name="co_morbidities_icd_leveliii_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('co_morbidities_icd_leveliii_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('co_morbidities_icd_leveliii_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('co_morbidities_icd_leveliii_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('co_morbidities_icd_leveliii_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveliii_code">ICD - Level - III - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveliii_code" name="co_morbidities_icd_leveliii_code"
                                    placeholder="Enter ICD - Level - III - Code" value="{{ old('co_morbidities_icd_leveliii_code') }}">
                                    @error('co_morbidities_icd_leveliii_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveliv_disease">ICD - Level - IV - Disease <span class="text-danger">*</span></label>
                                    <select class="form-select" id="co_morbidities_icd_leveliv_disease" name="co_morbidities_icd_leveliv_disease">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('co_morbidities_icd_leveliv_disease') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('co_morbidities_icd_leveliv_disease') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('co_morbidities_icd_leveliv_disease') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('co_morbidities_icd_leveliv_disease')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="co_morbidities_icd_leveliv_code">ICD - Level - IV - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="co_morbidities_icd_leveliv_code" name="co_morbidities_icd_leveliv_code"
                                    placeholder="Enter ICD - Level - IV - Code" value="{{ old('co_morbidities_icd_leveliv_code') }}">
                                    @error('co_morbidities_icd_leveliv_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3">
                                    <label for="co_morbidities_comments">Co-Morbidities - Comments </label>
                                    <textarea class="form-control" id="co_morbidities_comments" name="co_morbidities_comments" maxlength="250" placeholder="Comments"  rows="5">{{ old('co_morbidities_comments') }}</textarea>
                                    @error('co_morbidities_comments')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Details of Procedure Done  </div>



                                <div class="col-md-6 mt-3">
                                    <label for="procedure_name">Procedure Name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" id="procedure_name" name="procedure_name"
                                    placeholder="Enter Procedure Name" value="{{ old('procedure_name') }}">
                                    @error('procedure_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - I </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_group_name">PCS Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_i_pcs_group_name" name="procedure_i_pcs_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_i_pcs_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_i_pcs_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_i_pcs_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_i_pcs_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_group_code">PCS Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_group_code" name="procedure_i_pcs_group_code"
                                    placeholder="Enter PCS Group - Code" value="{{ old('procedure_i_pcs_group_code') }}">
                                    @error('procedure_i_pcs_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_i_pcs_sub_group_name" name="procedure_i_pcs_sub_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_i_pcs_sub_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_i_pcs_sub_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_i_pcs_sub_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_i_pcs_sub_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_sub_group_code" name="procedure_i_pcs_sub_group_code"
                                    placeholder="Enter PCS Group - Code" value="{{ old('procedure_i_pcs_sub_group_code') }}">
                                    @error('procedure_i_pcs_sub_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_short_name">PCS Short Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_i_pcs_short_name" name="procedure_i_pcs_short_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_i_pcs_short_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_i_pcs_short_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_i_pcs_short_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_i_pcs_short_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_i_pcs_code">PCS Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_code" name="procedure_i_pcs_code"
                                    placeholder="Enter PCS Code" value="{{ old('procedure_i_pcs_code') }}">
                                    @error('procedure_i_pcs_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="procedure_i_pcs_long_name">PCS Long Name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_i_pcs_long_name" name="procedure_i_pcs_long_name"
                                    placeholder="Enter PCS Long Name" value="{{ old('procedure_i_pcs_long_name') }}">
                                    @error('procedure_i_pcs_long_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - II </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_group_name">PCS Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_ii_pcs_group_name" name="procedure_ii_pcs_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_ii_pcs_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_ii_pcs_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_ii_pcs_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_ii_pcs_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_group_code">PCS Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_group_code" name="procedure_ii_pcs_group_code"
                                    placeholder="Enter PCS Group - Code" value="{{ old('procedure_ii_pcs_group_code') }}">
                                    @error('procedure_ii_pcs_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_ii_pcs_sub_group_name" name="procedure_ii_pcs_sub_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_ii_pcs_sub_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_ii_pcs_sub_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_ii_pcs_sub_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_ii_pcs_sub_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_sub_group_code" name="procedure_ii_pcs_sub_group_code"
                                    placeholder="Enter PCS Sub-Group - Code " value="{{ old('procedure_ii_pcs_sub_group_code') }}">
                                    @error('procedure_ii_pcs_sub_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_short_name">PCS Short Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_ii_pcs_short_name" name="procedure_ii_pcs_short_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_ii_pcs_short_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_ii_pcs_short_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_ii_pcs_short_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_ii_pcs_short_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_ii_pcs_code">PCS Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_code" name="procedure_ii_pcs_code"
                                    placeholder="Enter PCS Code " value="{{ old('procedure_ii_pcs_code') }}">
                                    @error('procedure_ii_pcs_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="procedure_ii_pcs_long_name">PCS Long Name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_ii_pcs_long_name" name="procedure_ii_pcs_long_name"
                                    placeholder="Enter PCS Long Name" value="{{ old('procedure_ii_pcs_long_name') }}">
                                    @error('procedure_ii_pcs_long_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3 bg-secondary text-white" style="line-height: 30px; margin-left: 2px; ;"> Procedure - III </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_group_name">PCS Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_iii_pcs_group_name" name="procedure_iii_pcs_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_iii_pcs_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_iii_pcs_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_iii_pcs_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_iii_pcs_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_group_code">PCS Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_group_code" name="procedure_iii_pcs_group_code"
                                    placeholder="Enter PCS Group - Code" value="{{ old('procedure_iii_pcs_group_code') }}">
                                    @error('procedure_iii_pcs_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_sub_group_name">PCS Sub-Group - Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_iii_pcs_sub_group_name" name="procedure_iii_pcs_sub_group_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_iii_pcs_sub_group_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_iii_pcs_sub_group_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_iii_pcs_sub_group_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_iii_pcs_sub_group_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_sub_group_code">PCS Sub-Group - Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_sub_group_code" name="procedure_iii_pcs_sub_group_code"
                                    placeholder="Enter PCS Sub-Group - Code" value="{{ old('procedure_iii_pcs_sub_group_code') }}">
                                    @error('procedure_iii_pcs_sub_group_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_short_name">PCS Short Name <span class="text-danger">*</span></label>
                                    <select class="form-select" id="procedure_iii_pcs_short_name" name="procedure_iii_pcs_short_name">
                                        <option value="">Please Select</option>
                                        <option value="Male" {{ old('procedure_iii_pcs_short_name') == 'Male' ? 'selected' : '' }}>Male </option>
                                        <option value="Female" {{ old('procedure_iii_pcs_short_name') == 'Female' ? 'selected' : '' }}>Female </option>
                                        <option value="Other" {{ old('procedure_iii_pcs_short_name') == 'Other' ? 'selected' : '' }}>Other </option>
                                    </select>
                                    @error('procedure_iii_pcs_short_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="procedure_iii_pcs_code">PCS Code <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_code" name="procedure_iii_pcs_code"
                                    placeholder="Enter PCS Code" value="{{ old('procedure_iii_pcs_code') }}">
                                    @error('procedure_iii_pcs_code')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="procedure_iii_pcs_long_name">PCS Long Name <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="16" class="form-control" id="procedure_iii_pcs_long_name" name="procedure_iii_pcs_long_name"
                                    placeholder="Enter PCS Long Name" value="{{ old('procedure_iii_pcs_long_name') }}">
                                    @error('procedure_iii_pcs_long_name')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 mt-3">
                                    <label for="final_assessment_status">Final Assessment Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="final_assessment_status" name="final_assessment_status">
                                        <option value="">Please Select</option>
                                        <option value="Waiting for Pre-Assessment" {{ old('final_assessment_status') == 'Waiting for Pre-Assessment' ? 'selected' : '' }}>Waiting for Pre-Assessment </option>
                                        <option value="Query Raised by BHC Team" {{ old('final_assessment_status') == 'Query Raised by BHC Team' ? 'selected' : '' }}>Query Raised by BHC Team </option>
                                        <option value="Non Admissible as per the Policy TC" {{ old('final_assessment_status') == 'Non Admissible as per the Policy TC' ? 'selected' : '' }}>Non Admissible as per the Policy TC </option>
                                        <option value="Non Admissible as per the Treatment Received" {{ old('final_assessment_status') == 'Non Admissible as per the Treatment Received' ? 'selected' : '' }}>Non Admissible as per the Treatment Received </option>
                                        <option value="Admissible" {{ old('final_assessment_status') == 'Admissible' ? 'selected' : '' }}>Admissible </option>
                                    </select>
                                    @error('final_assessment_status')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="claim-form">Add Query</button>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="processing_query">Query <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="250" class="form-control"
                                    id="processing_query" placeholder="Estimated Amount" name="processing_query"
                                    value="{{ old('processing_query') }}">
                                    @error('processing_query')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="final_assessment_amount">Final Assessment Amount <span class="text-danger">*</span></label>
                                    <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==8) return false;" class="form-control"  id="final_assessment_amount" placeholder="Estimated Amount" name="final_assessment_amount"
                                    value="{{ old('final_assessment_amount') }}">
                                    @error('final_assessment_amount')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="final_assessment_comments">Final Assessment Comments </label>
                                    <textarea class="form-control" id="final_assessment_comments" name="final_assessment_comments" maxlength="250" placeholder="Comments"  rows="5">{{ old('final_assessment_comments') }}</textarea>
                                    @error('final_assessment_comments')
                                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="claim-form">Save / Update Final Assessment</button>
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
        setPatient();
        setHospitalId();
        setInsuranceCoverageOptions();
    });

    function setPatient() {
        var title               = $("#patient_id").select2().find(":selected").data("title");
        var firstname           = $("#patient_id").select2().find(":selected").data("firstname");
        var middlename          = $("#patient_id").select2().find(":selected").data("middlename");
        var lastname            = $("#patient_id").select2().find(":selected").data("lastname");
        var age                 = $("#patient_id").select2().find(":selected").data("age");
        var gender              = $("#patient_id").select2().find(":selected").data("gender");
        var hospital            = $("#patient_id").select2().find(":selected").data("hospital");
        var registrationno      = $("#patient_id").select2().find(":selected").data("registrationno");


        $('#title').val(title);
        $('#firstname').val(firstname);
        $('#middlename').val(middlename);
        $('#lastname').val(lastname);
        $('#age').val(age);
        $('#gender').val(gender);
        $('#hospital_id').val(hospital).trigger('change');
        $('#registration_no').val(registrationno);
    }

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
    function setInsuranceCoverageOptions(){
        var insurance_coverage = $('#insurance_coverage').val();
        switch (insurance_coverage) {
                case 'Yes':
                    $("#policy_no").prop("readonly", false);
                    $("#company_tpa_id_card_no").prop("readonly", false);
                    break;
                case 'No':
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    break;
                default:
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    break;
            }
    }
</script>
@endpush
