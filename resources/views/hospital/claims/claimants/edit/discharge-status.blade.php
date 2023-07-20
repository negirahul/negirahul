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
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claimants.index') }}">Discharge Status</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($discharge_status) && !empty($discharge_status)) Edit @else New @endif Discharge Status</li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if(isset($discharge_status) && !empty($discharge_status)) Edit @else New @endif Discharge Status</h4>
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
                        <a href="{{ route('hospital.borrowers.show', $claimant->id) }}" aria-expanded="false"
                            class="nav-link rounded-0">
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
                        <a href="{{ route('hospital.discharge-status.show', $claimant->id) }}" aria-expanded="true"
                            class="nav-link rounded-0 active">
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
                    <div class="tab-pane show active" id="lending_status_tab">

                        <form action="{{ route('hospital.discharge-status.update', $claimant->id) }}" method="POST"
                            id="discharge-status-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-6 mb-3">
                                            <label for="hospital_id">Hospital ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id"
                                                name="hospital_id" maxlength="60" placeholder="Enter Borrower Id"
                                                value="{{ old('hospital_id', @$claimant->hospital->uid) }}">
                                            @error('hospital_id', 'discharge-status-form')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$claimant->hospital->name) }}">
                                            @error('hospital_name', 'discharge-status-form')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id"
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$claimant->patient->uid) }}">
                                            @error('patient_id', 'discharge-status-form')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claim_id"
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$claimant->claim->uid) }}">
                                            @error('claim_id', 'discharge-status-form')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="insurance_coverage">Insurance Coverage <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="insurance_coverage"
                                                name="insurance_coverage" disabled>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('insurance_coverage', $claimant->claim->insurance_coverage) == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('insurance_coverage', $claimant->claim->insurance_coverage) == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            @error('insurance_coverage')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="lending_required">Lending Required <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="lending_required" name="lending_required" disabled>
                                                <option value="">Select</option>
                                                <option value="Yes"
                                                    {{ old('lending_required', $claimant->claim->lending_required) == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="No"
                                                    {{ old('lending_required', $claimant->claim->lending_required) == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>
                                            @error('lending_required')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_admission">Date of Admission (DD-MM-YYYY) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="date_of_admission"
                                                name="date_of_admission"
                                                value="{{ old('date_of_admission', $claimant->claim->admission_date) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('date_of_admission')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="time_of_admission">Time of Admission (HH:MM) <span
                                                    class="text-danger">*</span></label>
                                            <input type="time" disabled class="form-control" id="time_of_admission"
                                                name="time_of_admission"
                                                value="{{ old('time_of_admission', $claimant->claim->admission_time) }}">
                                            @error('time_of_admission')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="hospitalization_due_to">Hospitalization Due To <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="injury"
                                                        value="Injury" name="hospitalization_due_to"
                                                        @if (old('hospitalization_due_to', $claimant->claim->hospitalization_due_to) == 'Injury') checked @endif>
                                                    <label class="form-check-label" for="injury">Injury</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled id="illness"
                                                        value="Illness" name="hospitalization_due_to"
                                                        @if (old('hospitalization_due_to', $claimant->claim->hospitalization_due_to) == 'Illness') checked @endif>
                                                    <label class="form-check-label" for="illness">Illness</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" disabled type="radio"
                                                        id="maternity"value="Maternity" name="hospitalization_due_to"
                                                        @if (old('hospitalization_due_to', $claimant->claim->hospitalization_due_to) == 'Maternity') checked @endif>
                                                    <label class="form-check-label" for="maternity">Maternity</label>
                                                </div>
                                            </div>
                                            @error('hospitalization_due_to')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="date_of_delivery">Date of Injury / Date Disease first detected /
                                                Date of delivery <span class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="date_of_delivery"
                                                name="date_of_delivery"
                                                value="{{ old('date_of_delivery', $claimant->claim->date_of_delivery) }}"
                                                placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('date_of_delivery')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="injury_reason">If Injury, give Cause/Reason <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input disabled class="form-check-input" type="radio"
                                                        id="injury_reason_self" value="Self Inflected"
                                                        name="injury_reason"
                                                        @if (old('injury_reason', isset($discharge_status) ? $discharge_status->injury_reason : '') == 'Self Inflected') checked @endif>
                                                    <label class="form-check-label" for="injury_reason_self">Self
                                                        Inflected</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input disabled class="form-check-input" type="radio"
                                                        id="injury_reason_road" value="Road Traffic Accident"
                                                        name="injury_reason"
                                                        @if (old('injury_reason', isset($discharge_status) ? $discharge_status->injury_reason : '') == 'Road Traffic Accident') checked @endif>
                                                    <label class="form-check-label" for="injury_reason_road">Road Traffic
                                                        Accident</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="injury_reason_substance"
                                                        value="Substance Abuse-Alcohol Consumption" name="injury_reason"
                                                        @if (old('injury_reason', isset($discharge_status) ? $discharge_status->injury_reason : '') == 'Substance Abuse-Alcohol Consumption') checked @endif>
                                                    <label class="form-check-label" for="injury_reason_substance">
                                                        Substance Abuse-Alcohol Consumption</label>
                                                </div>
                                            </div>
                                            @error('injury_reason')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="injury_due_to_substance_abuse_alcohol_consumption">If Injury due to
                                                Substance Abuse-Alcohol Consumption, Test conducted to establish this <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="injury_due_to_substance_abuse_alcohol_consumption_yes"
                                                        value="Yes"
                                                        name="injury_due_to_substance_abuse_alcohol_consumption"
                                                        @if (old(
                                                                'injury_due_to_substance_abuse_alcohol_consumption',
                                                                isset($discharge_status) ? $discharge_status->injury_due_to_substance_abuse_alcohol_consumption : '') == 'Yes') checked @endif>
                                                    <label class="form-check-label"
                                                        for="injury_due_to_substance_abuse_alcohol_consumption_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="injury_due_to_substance_abuse_alcohol_consumption_no"
                                                        value="No"
                                                        name="injury_due_to_substance_abuse_alcohol_consumption"
                                                        @if (old(
                                                                'injury_due_to_substance_abuse_alcohol_consumption',
                                                                isset($discharge_status) ? $discharge_status->injury_due_to_substance_abuse_alcohol_consumption : '') == 'No') checked @endif>
                                                    <label class="form-check-label"
                                                        for="injury_due_to_substance_abuse_alcohol_consumption_no">No</label>
                                                </div>
                                            </div>
                                            @error('injury_due_to_substance_abuse_alcohol_consumption')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="if_medico_legal_case_mlc">If Medico Legal Case (MLC) <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="if_medico_legal_case_mlc_yes" value="Yes"
                                                        name="if_medico_legal_case_mlc"
                                                        @if (old('if_medico_legal_case_mlc', isset($discharge_status) ? $discharge_status->if_medico_legal_case_mlc : '') ==
                                                                'Yes') checked @endif>
                                                    <label class="form-check-label"
                                                        for="if_medico_legal_case_mlc_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="if_medico_legal_case_mlc_no" value="No"
                                                        name="if_medico_legal_case_mlc"
                                                        @if (old('if_medico_legal_case_mlc', isset($discharge_status) ? $discharge_status->if_medico_legal_case_mlc : '') ==
                                                                'No') checked @endif>
                                                    <label class="form-check-label"
                                                        for="if_medico_legal_case_mlc_no">No</label>
                                                </div>
                                            </div>
                                            @error('if_medico_legal_case_mlc')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="reported_to_police">Reported to Police <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="reported_to_police_yes" value="Yes"
                                                        name="reported_to_police"
                                                        @if (old('reported_to_police', isset($discharge_status) ? $discharge_status->reported_to_police : '') == 'Yes') checked @endif>
                                                    <label class="form-check-label"
                                                        for="reported_to_police_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="reported_to_police_no" value="No"
                                                        name="reported_to_police"
                                                        @if (old('reported_to_police', isset($discharge_status) ? $discharge_status->reported_to_police : '') == 'No') checked @endif>
                                                    <label class="form-check-label" for="reported_to_police_no">No</label>
                                                </div>
                                            </div>
                                            @error('reported_to_police')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="mlc_report_and_police_fir_attached">MLC Report & Police FIR attached <span class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="mlc_report_and_police_fir_attached_yes" value="Yes"
                                                        name="mlc_report_and_police_fir_attached"
                                                        @if (old(
                                                                'mlc_report_and_police_fir_attached',
                                                                isset($discharge_status) ? $discharge_status->mlc_report_and_police_fir_attached : '') == 'Yes') checked @endif>
                                                    <label class="form-check-label"
                                                        for="mlc_report_and_police_fir_attached_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="mlc_report_and_police_fir_attached_no" value="No"
                                                        name="mlc_report_and_police_fir_attached"
                                                        @if (old(
                                                                'mlc_report_and_police_fir_attached',
                                                                isset($discharge_status) ? $discharge_status->mlc_report_and_police_fir_attached : '') == 'No') checked @endif>
                                                    <label class="form-check-label"
                                                        for="mlc_report_and_police_fir_attached_no">No</label>
                                                </div>
                                            </div>
                                            @error('mlc_report_and_police_fir_attached')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="fir_or_mlc_no">FIR No. / MLC No.<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled maxlength="27" class="form-control" id="fir_or_mlc_no"
                                                name="fir_or_mlc_no" placeholder="Enter FIR No. / MLC No"
                                                value="{{ old('fir_or_mlc_no', isset($discharge_status) ? $discharge_status->fir_or_mlc_no : '') }}">
                                            @error('fir_or_mlc_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="not_reported_to_police_reason">If not reported to Police, give
                                                reason </label>
                                            <input type="text"  @if(isset($discharge_status->reported_to_police) && $discharge_status->reported_to_police == "No" && $discharge_status->if_medico_legal_case_mlc == "Yes") disabled @endif class="form-control" id="not_reported_to_police_reason" name="not_reported_to_police_reason" value="{{ old('not_reported_to_police_reason', isset($discharge_status) ? $discharge_status->not_reported_to_police_reason : '') }}" maxlength="100" placeholder="Claimant Comments">
                                            @error('not_reported_to_police_reason')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="maternity_date_of_delivery">If Maternity - Date of Delivery<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="maternity_date_of_delivery"
                                                name="maternity_date_of_delivery" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy"
                                                value="{{ old('maternity_date_of_delivery', isset($discharge_status) ? $discharge_status->maternity_date_of_delivery : '') }}">

                                            @error('maternity_date_of_delivery')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    If Maternity - Gravida Status
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-md-3 mt-1">
                                            <label for="maternity_gravida_status_g">G<span class="text-danger">*</span></label>
                                            <input type="number" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" class="form-control" id="maternity_gravida_status_g"
                                            name="maternity_gravida_status_g" placeholder="Enter G"  value="{{ old('maternity_gravida_status_g', isset($discharge_status) ? $discharge_status->maternity_gravida_status_g : '') }}">
                                            @error('maternity_gravida_status_g')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <label for="maternity_gravida_status_p">P<span class="text-danger">*</span></label>
                                            <input type="number" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" class="form-control" id="maternity_gravida_status_p"
                                            name="maternity_gravida_status_p" placeholder="Enter P"  value="{{ old('maternity_gravida_status_p', isset($discharge_status) ? $discharge_status->maternity_gravida_status_p : '') }}">
                                            @error('maternity_gravida_status_p')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <label for="maternity_gravida_status_l">L<span class="text-danger">*</span></label>
                                            <input type="number" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" class="form-control" id="maternity_gravida_status_l"
                                            name="maternity_gravida_status_l" placeholder="Enter L"  value="{{ old('maternity_gravida_status_l', isset($discharge_status) ? $discharge_status->maternity_gravida_status_l : '') }}">
                                            @error('maternity_gravida_status_l')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <label for="maternity_gravida_status_a">A<span class="text-danger">*</span></label>
                                            <input type="number" disabled pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==2) return false;" class="form-control" id="maternity_gravida_status_a"
                                            name="maternity_gravida_status_a" placeholder="Enter A"  value="{{ old('maternity_gravida_status_a', isset($discharge_status) ? $discharge_status->maternity_gravida_status_a : '') }}">
                                            @error('maternity_gravida_status_a')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3 mt-3">
                                            <label for="premature_baby">Premature Baby <span
                                                    class="text-danger">*</span></label>
                                            <div class="mt-2">
                                                <div class="form-check form-check-inline">
                                                    <input disabled class="form-check-input" type="radio"
                                                        id="premature_baby_yes" value="Yes"
                                                        name="premature_baby"
                                                        @if (old('premature_baby', isset($discharge_status) ? $discharge_status->premature_baby : '') == 'Yes') checked @endif>
                                                    <label class="form-check-label"
                                                        for="premature_baby_yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" disabled
                                                        id="premature_baby_no" value="No"
                                                        name="premature_baby"
                                                        @if (old('premature_baby', isset($discharge_status) ? $discharge_status->premature_baby : '') == 'No') checked @endif>
                                                    <label class="form-check-label" for="premature_baby_no">No</label>
                                                </div>
                                            </div>
                                            @error('premature_baby')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_of_discharge">Date of Discharge<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="date_of_discharge" name="date_of_discharge"
                                            value="{{ old('date_of_discharge', isset($discharge_status) ? $discharge_status->date_of_discharge : '') }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">

                                            @error('date_of_discharge')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="time_of_discharge">Time of Discharge<span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" id="time_of_discharge" name="time_of_discharge"
                                            value="{{ old('time_of_discharge', isset($discharge_status) ? $discharge_status->time_of_discharge : '') }}">

                                            @error('time_of_discharge')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="discharge_status">Discharge Status <span class="text-danger">*</span></label>
                                            <select class="form-select" id="discharge_status" name="discharge_status">
                                                <option value="">Select</option>
                                                <option value="Discharge to Home" {{ old('discharge_status', isset($discharge_status) ? $discharge_status->discharge_status : '') == 'Discharge to Home' ? 'selected' : '' }}>Discharge to Home
                                                </option>
                                                <option value="Discharge to another Hospital" {{ old('discharge_status', isset($discharge_status) ? $discharge_status->discharge_status : '') == 'Discharge to another Hospital' ? 'selected' : '' }}>Discharge to another Hospital
                                                </option>
                                                <option value="Deceased" {{ old('discharge_status', isset($discharge_status) ? $discharge_status->discharge_status : '') == 'Deceased' ? 'selected' : '' }}>Deceased
                                                </option>
                                                <option value="LAMA" {{ old('discharge_status', isset($discharge_status) ? $discharge_status->discharge_status : '') == 'LAMA' ? 'selected' : '' }}>LAMA
                                                </option>
                                            </select>
                                            @error('discharge_status')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-1">
                                            <label for="death_summary">Death Summary<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                            <textarea rows="1" class="form-control" id="death_summary" name="death_summary" maxlength="250" placeholder="Enter Death Summary"
                                            rows="5">{{ old('death_summary', isset($discharge_status) ? $discharge_status->death_summary : '') }}</textarea>
                                            @error('death_summary')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-1">
                                            <label for="discharge_status_comments">Discharge Status Comments<span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="discharge_status_comments" name="discharge_status_comments" maxlength="250" placeholder="Enter Discharge Status Comments"
                                            rows="5">{{ old('discharge_status_comments', isset($discharge_status) ? $discharge_status->discharge_status_comments : '') }}</textarea>

                                            @error('discharge_status_comments')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success" form="discharge-status-form">
                                            Save / Update Discharge Status</button>
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

        let mlc = $('input[name="if_medico_legal_case_mlc"]:checked').val();
        let rtp = $('input[name="reported_to_police"]:checked').val();
        let fat = $('input[name="mlc_report_and_police_fir_attached"]:checked').val();
        let ins = $('input[name="injury_due_to_substance_abuse_alcohol_consumption"]:checked').val();

        if(mlc == 'Yes'){
            $('#reported_to_police_yes').removeAttr('disabled');
            $('#reported_to_police_no').removeAttr('disabled');
        }

        if(rtp == 'Yes'){
            $('#mlc_report_and_police_fir_attached_yes').removeAttr('disabled');
            $('#mlc_report_and_police_fir_attached_no').removeAttr('disabled');
        }

        if(fat == 'Yes'){
            $('#fir_or_mlc_no').removeAttr('disabled');
        }

        if(ins == 'Yes' && mlc  == 'No'){
            $('#not_reported_to_police_reason').removeAttr('disabled');
        }else{
            $('#not_reported_to_police_reason').attr('disabled',true);
        }


        if(rtp == 'No' && mlc  == 'Yes'){
            $('#not_reported_to_police_reason').removeAttr('disabled');
        }else{
            $('#not_reported_to_police_reason').attr('disabled',true);
        }


        //on load
        let hdt = $('input[name="hospitalization_due_to"]:checked').val();
          if(hdt == "Injury") {
            $('#injury_reason_self').removeAttr('disabled');
            $('#injury_reason_road').removeAttr('disabled');
            $('#injury_reason_substance').removeAttr('disabled');
            $('#injury_due_to_substance_abuse_alcohol_consumption_yes').removeAttr('disabled');
            $('#injury_due_to_substance_abuse_alcohol_consumption_no').removeAttr('disabled');
            $('#if_medico_legal_case_mlc_yes').removeAttr('disabled');
            $('#if_medico_legal_case_mlc_no').removeAttr('disabled');

         };
         if(hdt == "Maternity"){
                $('#maternity_date_of_delivery').removeAttr('disabled');
                $('#maternity_gravida_status_g').removeAttr('disabled');
                $('#maternity_gravida_status_p').removeAttr('disabled');
                $('#maternity_gravida_status_l').removeAttr('disabled');
                $('#maternity_gravida_status_a').removeAttr('disabled');
                $('#premature_baby_yes').removeAttr('disabled');
                $('#premature_baby_no').removeAttr('disabled');
         }

         //after change
        $('input[name="hospitalization_due_to"]').on('change',function(e){
            if($(this).val() == 'Injury'){
                $('#injury_reason_self').removeAttr('disabled');
                $('#injury_reason_road').removeAttr('disabled');
                $('#injury_reason_substance').removeAttr('disabled');
                $('#injury_due_to_substance_abuse_alcohol_consumption_yes').removeAttr('disabled');
                $('#injury_due_to_substance_abuse_alcohol_consumption_no').removeAttr('disabled');
                $('#if_medico_legal_case_mlc_yes').removeAttr('disabled');
                $('#if_medico_legal_case_mlc_no').removeAttr('disabled');

            } else if($(this).val() == 'Maternity'){

                $('#maternity_date_of_delivery').removeAttr('disabled');
                $('#maternity_gravida_status_g').removeAttr('disabled');
                $('#maternity_gravida_status_p').removeAttr('disabled');
                $('#maternity_gravida_status_l').removeAttr('disabled');
                $('#maternity_gravida_status_a').removeAttr('disabled');
                $('#premature_baby_yes').removeAttr('disabled');
                $('#premature_baby_no').removeAttr('disabled');

            }
            else {
                $('#injury_reason_self').attr('disabled',true);
                $('#injury_reason_road').attr('disabled',true);
                $('#injury_reason_substance').attr('disabled',true);
                $('#injury_due_to_substance_abuse_alcohol_consumption_yes').attr('disabled',true);
                $('#injury_due_to_substance_abuse_alcohol_consumption_no').attr('disabled',true);
                $('#if_medico_legal_case_mlc_yes').attr('disabled',true);
                $('#if_medico_legal_case_mlc_no').attr('disabled',true);
                $('#reported_to_police_yes').attr('disabled',true);
               $('#reported_to_police_no').attr('disabled',true);
               $('#mlc_report_and_police_fir_attached_yes').attr('disabled',true);
                $('#mlc_report_and_police_fir_attached_no').attr('disabled',true);
                $('#maternity_date_of_delivery').attr('disabled',true);
                $('#maternity_gravida_status_g').attr('disabled',true);
                $('#maternity_gravida_status_p').attr('disabled',true);
                $('#maternity_gravida_status_l').attr('disabled',true);
                $('#maternity_gravida_status_a').attr('disabled',true);
                $('#premature_baby').removeAttr('disabled');
            }
        });
        $('input[name="if_medico_legal_case_mlc"]').on('change',function(e){

            if($(this).val() == 'Yes'){
               $('#reported_to_police_yes').removeAttr('disabled');
               $('#reported_to_police_no').removeAttr('disabled');
               // $('#reported_to_police_yes').prop('checked',true);
            } else {
               $('#reported_to_police_yes').attr('disabled',true);
               $('#reported_to_police_no').attr('disabled',true);
            }

            if($('input[name="injury_due_to_substance_abuse_alcohol_consumption"]:checked').val() == 'Yes' && $(this).val() == 'No'){
                $("#not_reported_to_police_reason").removeAttr('disabled');
            }

        });

        $('input[name="reported_to_police"]').on('change',function(e){
            if($(this).val() == 'Yes'){
                $('#mlc_report_and_police_fir_attached_yes').removeAttr('disabled');
                $('#mlc_report_and_police_fir_attached_no').removeAttr('disabled');
            } else {
                $('#mlc_report_and_police_fir_attached_yes').attr('disabled',true);
                $('#mlc_report_and_police_fir_attached_no').attr('disabled',true);
            }
        });

        $('input[name="mlc_report_and_police_fir_attached"]').on('change',function(e){
            if($(this).val() == 'Yes'){
                $('#fir_or_mlc_no').removeAttr('disabled');
            } else {
                $('#fir_or_mlc_no').attr('disabled',true);
            }
        });

        $('input[name="reported_to_police"]').on('change',function(){

            if($('input[name="reported_to_police"]:checked').val() == 'No'){
               $('#not_reported_to_police_reason').removeAttr('disabled');
            } else {
               $('#not_reported_to_police_reason').attr('disabled',true);
            }
        });

        $('#discharge_status').on('change',function(){
            if($(this).val()=="Deceased"){
                $('#death_summary').removeAttr('readonly');
            } else {
                $('#death_summary').attr('readonly',true);
            }
        });

        var discharge_status = "{{ old('discharge_status', @$discharge_status->discharge_status) }}";

        if(discharge_status =="Deceased"){
            $('#death_summary').removeAttr('readonly');
        } else {
            $('#death_summary').attr('readonly',true);
        }

         $('#maternity_date_of_delivery').datepicker({
                endDate: '+0d',
                autoclose: true,
            });



</script>
@endpush
