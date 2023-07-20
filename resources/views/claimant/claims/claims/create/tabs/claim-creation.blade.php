<div class="card-body">
    <form action="{{ route('admin.claims.store') }}" method="post" id="claim-form" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <div class="col-md-12 mb-3">
                <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                <select class="form-control select2" id="patient_id" name="patient_id" data-toggle="select2"
                    onchange="setPatient()">
                    <option value="">Enter Patient ID</option>
                    @foreach ($patients as $row)
                        <option value="{{ $row->id }}" {{ old('patient_id', isset($patient) ? $patient->id : '') == $row->id ? 'selected' : '' }}
                            data-title="{{ $row->title }}" data-firstname="{{ $row->firstname }}"
                            data-middlename="{{ $row->middlename }}" data-lastname="{{ $row->lastname }}"
                            data-age="{{ $row->age }}" data-gender="{{ $row->gender }}"
                            data-hospital="{{ $row->hospital_id }}"
                            data-registrationno="{{ $row->registration_number }}">
                            {{ $row->uid }}
                    @endforeach
                </select>
                @error('patient_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="hospital_id">Hospital ID <span class="text-danger">*</span></label>
                <select class="form-control select2" id="hospital_id" name="hospital_id" data-toggle="select2"
                    onchange="setHospitalId()">
                    <option value="">Select Hospital</option>
                    @foreach ($hospitals as $hospital)
                        <option value="{{ $hospital->id }}"
                            {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}
                            data-name="{{ $hospital->name }}" data-id="{{ $hospital->uid }}"
                            data-address="{{ $hospital->address }}" data-city="{{ $hospital->city }}"
                            data-state="{{ $hospital->state }}" data-pincode="{{ $hospital->pincode }}"
                            data-ap="{{ $hospital->linked_associate_partner_id }}"
                            data-apname="{{ $hospital->ap_name }}">
                            {{ $hospital->uid }}
                            [<strong>Name: </strong>{{ $hospital->name }}]
                            [<strong>City: </strong>{{ $hospital->city }}]
                            [<strong>State: </strong>{{ $hospital->state }}]
                        </option>
                    @endforeach
                </select>
                @error('hospital_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hospital_name" name="hospital_name"
                    placeholder="Enter Hospital Name" value="{{ old('hospital_name') }}">
                @error('hospital_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mt-3">
                <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hospital_address" name="hospital_address"
                    placeholder="Address Line" value="{{ old('hospital_address') }}">
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

            <div class="col-md-6 mt-3">
                <label for="associate_partner_id">Associate Partner ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="associate_partner_id" name="associate_partner_id"
                    placeholder="Associate Partner ID" value="{{ old('associate_partner_id') }}">
                @error('associate_partner_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="registration_no">IP (In-patient) Registration No. <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="20" id="registration_no"
                    name="registration_no" placeholder="Enter IP Registration No."
                    value="{{ old('registration_no') }}">
                @error('registration_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mt-3">
                <label for="firstname">Patient Name <span class="text-danger">*</span></label>
            </div>

            <div class="col-md-3 mt-1">
                <select class="form-control" id="title" name="title">
                    <option value="">Select</option>
                    <option value="Mr." {{ old('title') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                    <option value="Ms." {{ old('title') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                </select>
                @error('title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="firstname" name="firstname"
                    maxlength="15" placeholder="First name" value="{{ old('firstname') }}">
                @error('firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="middlename" name="middlename"
                    maxlength="30" placeholder="Middle name" value="{{ old('middlename') }}">
                @error('middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="lastname" name="lastname"
                    maxlength="30" placeholder="Last name" value="{{ old('lastname') }}">
                @error('lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="age">Patient Age <span class="text-danger">*</span></label>
                <input type="text" onkeypress="return isNumberKey(event)" class="form-control" id="age"
                    name="age" placeholder="Patient Age" value="{{ old('age') }}">
                @error('age')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="gender">Patient Gender <span class="text-danger">*</span></label>
                <select class="form-select" id="gender" name="gender">
                    <option value="">Select gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                    </option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other
                    </option>
                </select>
                @error('gender')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="admission_date">Date of Admission (DD-MM-YYYY) <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="admission_date" name="admission_date"
                    value="{{ old('admission_date') }}">
                @error('admission_date')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="admission_time">Time of Admission (HH:MM) <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="admission_time" name="admission_time"
                    value="{{ old('admission_time') }}">
                @error('admission_time')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 mt-3">
                <label for="abha_id">ABHA ID <span class="text-danger">*</span></label>
                <input type="text" maxlength="45" class="form-control" id="abha_id" name="abha_id"
                    placeholder="ABHA ID" value="{{ old('abha_id') }}">
                @error('abha_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="insurance_coverage">Insurance Coverage <span class="text-danger">*</span></label>
                <select class="form-select" id="insurance_coverage" name="insurance_coverage" onchange="setInsuranceCoverageOptions()">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('insurance_coverage') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No" {{ old('insurance_coverage') == 'No' ? 'selected' : '' }}>No
                    </option>
                </select>
                @error('insurance_coverage')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="policy_no">Policy No. <span class="text-danger">*</span></label>
                <input type="text" maxlength="16" class="form-control" id="policy_no" name="policy_no"
                    placeholder="Policy No." value="{{ old('policy_no') }}">
                @error('policy_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="company_tpa_id_card_no">Company / TPA ID Card No. <span
                        class="text-danger">*</span></label>
                <input type="text" maxlength="16" class="form-control" id="company_tpa_id_card_no"
                    placeholder="Company / TPA ID Card No." name="company_tpa_id_card_no"
                    value="{{ old('company_tpa_id_card_no') }}">
                @error('company_tpa_id_card_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="lending_required">Lending Required <span class="text-danger">*</span></label>
                <select class="form-select" id="lending_required" name="lending_required">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('lending_required') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No" {{ old('lending_required') == 'No' ? 'selected' : '' }}>No
                    </option>
                </select>
                @error('lending_required')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 mt-3">
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
            <div class="col-md-6 mt-3">
                <label for="date_of_delivery">Date of Injury / Date Disease first detected / Date of delivery
                    (DD-MM-YYYY) <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date_of_delivery" name="date_of_delivery"
                    value="{{ old('date_of_delivery') }}"
                    placeholder="Date of Injury / Date Disease first detected / Date of delivery (DD-MM-YYYY)">
                @error('date_of_delivery')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
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
            <div class="col-md-6 mt-3">
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
            <div class="col-md-6 mt-3">
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
            <div class="col-md-6 mt-3">
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
                <input type="text" maxlength="45" class="form-control" id="disease_name" name="disease_name"
                    value="{{ old('disease_name') }}" placeholder="Disease Name">
                @error('disease_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="disease_type">Disease Type <span class="text-danger">*</span></label>
                <select class="form-select" id="disease_type" name="disease_type">
                    <option value="">Select</option>
                    <option value="PED (Pre Existing Disease)"
                        {{ old('disease_type') == 'PED (Pre Existing Disease)' ? 'selected' : '' }}>PED (Pre Existing
                        Disease)
                    </option>
                    <option value="Non PED" {{ old('disease_type') == 'Non PED' ? 'selected' : '' }}>Non PED
                    </option>
                </select>
                @error('disease_type')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-3">
                <label for="estimated_amount">Estimated Amount <span class="text-danger">*</span></label>
                <input type="text" maxlength="8" onkeypress="return isNumberKey(event)" class="form-control"
                    id="estimated_amount" placeholder="Estimated Amount" name="estimated_amount"
                    value="{{ old('estimated_amount') }}">
                @error('estimated_amount')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 mt-3">
                <label for="comments">Claim Intimation Comment </label>
                <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments"
                    rows="5">{{ old('comments') }}</textarea>
                @error('comments')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 text-end mt-3">
                <button type="submit" class="btn btn-success" form="claim-form">Create
                    Claim ID</button>
            </div>
        </div>
    </form>
</div>
