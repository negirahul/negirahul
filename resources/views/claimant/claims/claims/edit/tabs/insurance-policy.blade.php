<form action="{{ route('admin.claims.update-insurance-policy', $claim->id) }}" method="post" id="insurance-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body mb-4">
        <div class="form-group row">
            <div class="col-md-6 mb-3">
                <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" maxlength="60"
                    placeholder="Enter Patient ID" value="{{ old('patient_id', $claim->patient->uid) }}" readonly>
                @error('patient_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="claim_id" name="claim_id" maxlength="60"
                    placeholder="Enter Claim ID" value="{{ old('claim_id', $claim->uid) }}" readonly>
                @error('claim_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="policy_no">Policy No. <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="policy_no" name="policy_no" maxlength="16"
                    placeholder="Enter Policy No." value="{{ old('policy_no', $claim->policy_no) }}">
                @error('policy_no')
                    <span id="policy-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="insurance_company">Insurance Company<span class="text-danger">*</span></label>
                <select class="form-control select2" id="insurance_company" name="insurance_company"
                    data-toggle="select2">
                    <option value="">Select Insurance Company</option>
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

            <div class="col-md-4 mb-3">
                <label for="policy_name">Policy Name <span class="text-danger">*</span></label>
                <select class="form-control select2" id="policy_name" name="policy_name" data-toggle="select2">
                    <option value="">Select Policy</option>
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
                <label for="certificate_no">SI No. / Certificate No. <span class="text-danger">*</span></label>
                <input type="text" maxlength="16" class="form-control" id="certificate_no"
                    placeholder="SI No. / Certificate No." name="certificate_no" value="{{ old('certificate_no') }}">
                @error('certificate_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="company_tpa_id_card_no">Company / TPA ID Card No. <span class="text-danger">*</span></label>
                <input type="text" maxlength="16" class="form-control" id="company_tpa_id_card_no"
                    placeholder="Company / TPA ID Card No." name="company_tpa_id_card_no"
                    value="{{ old('company_tpa_id_card_no', $claim->company_tpa_id_card_no) }}">
                @error('company_tpa_id_card_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="tpa_name">TPA Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tpa_name" name="tpa_name" placeholder="Enter TPA Name"
                    value="{{ old('tpa_name') }}" maxlength="75">
                @error('tpa_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="policy_type">Policy Type <span class="text-danger">*</span></label>
                <select class="form-select" id="policy_type" name="policy_type" onchange="setGroupName();">
                    <option value="">Select Policy Type</option>
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
                <label for="group_name">Group Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="group_name" name="group_name"
                    placeholder="Enter Group Name" value="{{ old('group_name') }}" maxlength="75">
                @error('group_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="start_date">Policy Start Date <span class="text-danger">*</span></label>
                <input type="date" placeholder="Enter Policy Start Date" class="form-control" id="start_date"
                    name="start_date" value="{{ old('start_date') }}">
                @error('start_date')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="expiry_date">Policy Expiry Date <span class="text-danger">*</span></label>
                <input type="date" placeholder="Enter Policy Expiry Date" class="form-control" id="expiry_date"
                    name="expiry_date" value="{{ old('expiry_date') }}">
                @error('expiry_date')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="commencement_date">Policy Commencement Date (without Break) <span
                        class="text-danger">*</span></label>
                <input type="date" placeholder="Enter Policy Commencement Date (without Break)"
                    class="form-control" id="commencement_date" name="commencement_date"
                    value="{{ old('commencement_date') }}">
                @error('commencement_date')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-1">
                <label for="firstname">Name of the Proposer / Primary Insured <span
                        class="text-danger">*</span></label>
            </div>

            <div class="col-md-3 mb-3">
                <select class="form-control" id="proposer_title" name="proposer_title">
                    <option value="">Select</option>
                    <option value="Mr." {{ old('proposer_title') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                    <option value="Ms." {{ old('proposer_title') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                </select>
                @error('proposer_title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <input type="text" maxlength="25" class="form-control" id="proposer_firstname" name="proposer_firstname" placeholder="First name" value="{{ old('proposer_firstname') }}">
                @error('proposer_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <input type="text" maxlength="25" class="form-control" id="proposer_middlename" name="proposer_middlename" placeholder="Middle name" value="{{ old('proposer_middlename') }}">
                @error('proposer_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <input type="text" maxlength="25" class="form-control" id="proposer_lastname" name="proposer_lastname" placeholder="Last name" value="{{ old('proposer_lastname') }}">
                @error('proposer_lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="is_primary_insured_and_patient_same">Is Primary Insured and Patient Same <span
                        class="text-danger">*</span></label>
                <select class="form-select" id="is_primary_insured_and_patient_same"
                    name="is_primary_insured_and_patient_same" onchange="setPrimaryInsuredAddress();">
                    <option value="">Select</option>
                    <option value="Yes"
                        {{ old('is_primary_insured_and_patient_same') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No" {{ old('is_primary_insured_and_patient_same') == 'No' ? 'selected' : '' }}>
                        No
                    </option>
                </select>
                @error('is_primary_insured_and_patient_same')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-2">
                <label for="primary_insured_address">Address of the Primary Insured <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="primary_insured_address"
                    name="primary_insured_address" placeholder="Address Line"
                    value="{{ old('primary_insured_address') }}">
                @error('primary_insured_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="primary_insured_city" name="primary_insured_city"
                    placeholder="City" value="{{ old('primary_insured_city') }}">
                @error('primary_insured_city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" id="primary_insured_state" name="primary_insured_state"
                    placeholder="State" value="{{ old('primary_insured_state') }}">
                @error('primary_insured_state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <input type="number" class="form-control" id="primary_insured_pincode"
                    name="primary_insured_pincode" placeholder="Pincode"
                    value="{{ old('primary_insured_pincode') }}">
                @error('primary_insured_pincode')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="no_of_person_insured">No. of Person Insured <span class="text-danger">*</span></label>
                <input type="text" maxlength="2" onkeypress="return isNumberKey(event)" class="form-control"
                    id="no_of_person_insured" name="no_of_person_insured" placeholder="No. of Person Insured"
                    value="{{ old('no_of_person_insured') }}">
                @error('no_of_person_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="basic_sum_insured">Basic Sum Insured <span class="text-danger">*</span></label>
                <input type="text" maxlength="8" onkeypress="return isNumberKey(event)" class="form-control"
                    id="basic_sum_insured" name="basic_sum_insured" placeholder="Basic Sum Insured"
                    value="{{ old('basic_sum_insured') }}">
                @error('basic_sum_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="cumulative_bonus_cv">Cumulative Bonus (CV) <span class="text-danger">*</span></label>
                <input type="text" maxlength="8" onkeypress="return isNumberKey(event)" class="form-control"
                    id="cumulative_bonus_cv" name="cumulative_bonus_cv" placeholder="Cumulative Bonus (CV)"
                    value="{{ old('cumulative_bonus_cv') }}">
                @error('cumulative_bonus_cv')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="agent_broker_code">Agent / Broker Code <span class="text-danger">*</span></label>
                <input type="text" maxlength="10" class="form-control" id="agent_broker_code"
                    name="agent_broker_code" placeholder="Agent/Broker Code" value="{{ old('agent_broker_code') }}">
                @error('agent_broker_code')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="agent_broker_name">Agent / Broker Name <span class="text-danger">*</span></label>
                <input type="text" maxlength="60" class="form-control" id="agent_broker_name"
                    name="agent_broker_name" placeholder="Agent/Broker Name" value="{{ old('agent_broker_name') }}">
                @error('agent_broker_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="additional_policy">Are you covered under any Top-up / Additional Policy <span
                        class="text-danger">*</span></label>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="additional_policy_yes" value="Yes"
                            name="additional_policy" @if (old('additional_policy') == 'Yes') checked @endif onchange="setAdditionalPolicy()">
                        <label class="form-check-label" for="additional_policy_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="additional_policy_no" value="No"
                            name="additional_policy" @if (old('additional_policy') == 'No') checked @endif onchange="setAdditionalPolicy()">
                        <label class="form-check-label" for="additional_policy_no">No</label>
                    </div>
                </div>
                @error('additional_policy')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="policy_no_additional">Policy No. (Top Up / Additional) <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="policy_no_additional" name="policy_no_additional"
                    maxlength="16" placeholder="Enter Policy No. (Top Up / Additional)"
                    value="{{ old('policy_no_additional', $claim->policy_no_additional) }}">
                @error('policy_no_additional')
                    <span id="policy-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="currently_covered">Currently Covered by any other Mediclaim / Health Insurance <span
                        class="text-danger">*</span></label>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="currently_covered_yes" value="Yes"
                            name="currently_covered" @if (old('currently_covered') == 'Yes') checked @endif onchange="setCurrentlyCovered()">
                        <label class="form-check-label" for="currently_covered_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="currently_covered_no" value="No"
                            name="currently_covered" @if (old('currently_covered') == 'No') checked @endif onchange="setCurrentlyCovered()">
                        <label class="form-check-label" for="currently_covered_no">No</label>
                    </div>
                </div>
                @error('currently_covered')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="commencement_date_other">Policy Commencement Date (without Break - Other Policy) <span
                        class="text-danger">*</span></label>
                <input type="date" placeholder="Enter Policy Commencement Date (without Break)"
                    class="form-control" id="commencement_date_other" name="commencement_date_other"
                    value="{{ old('commencement_date_other') }}">
                @error('commencement_date_other')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="insurance_company_other">Insurance Company Name (Other Policy)<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="insurance_company_other"
                    name="insurance_company_other" maxlength="60"
                    placeholder="Enter Insurance Company Name (Other Policy)"
                    value="{{ old('insurance_company_other', $claim->insurance_company_other) }}">
                @error('insurance_company_other')
                    <span id="policy-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="policy_no_other">Policy No. (Other Policy) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="policy_no_other" name="policy_no_other"
                    maxlength="16" placeholder="Enter Policy No. (Other Policy)"
                    value="{{ old('policy_no_other', $claim->policy_no_other) }}">
                @error('policy_no_other')
                    <span id="policy-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="sum_insured_other">Sum Insured (Other Policy) <span class="text-danger">*</span></label>
                <input type="text" maxlength="8" onkeypress="return isNumberKey(event)" class="form-control"
                    id="sum_insured_other" name="sum_insured_other" placeholder="Sum Insured (Other Policy)"
                    value="{{ old('sum_insured_other') }}">
                @error('sum_insured_other')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="hospitalized">Patient ever been hospitalized in the last 4 years since the inception of the
                    contract <span class="text-danger">*</span></label>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="hospitalized_yes" value="Yes"
                            name="hospitalized"  onchange="setHospitalizedOption()"  @if (old('hospitalized') == 'Yes') checked @endif>

                        <label class="form-check-label" for="hospitalized_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="hospitalized_no" value="No"
                            name="hospitalized" @if (old('hospitalized') == 'No') checked @endif  onchange="setHospitalizedOption()">
                        <label class="form-check-label" for="hospitalized_no">No</label>
                    </div>
                </div>
                @error('hospitalized')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="admission_date_past">Date of Admission (Past) (DD-MM-YYYY) <span
                        class="text-danger">*</span></label>
                <input type="date" class="form-control" id="admission_date_past" name="admission_date_past"
                    value="{{ old('admission_date_past') }}">
                @error('admission_date_past')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="diagnosis">Diagnosis (Previous) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="diagnosis" name="diagnosis" maxlength="60"
                    placeholder="Enter Diagnosis (Previous)" value="{{ old('diagnosis', $claim->diagnosis) }}">
                @error('diagnosis')
                    <span id="policy-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="comments">Policy Detail Comments </label>
                <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments"
                    rows="5">{{ old('comments') }}</textarea>
                @error('comments')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div class="form-group text-end">
            <button type="button" id="addInsured" class="btn btn-sm btn-success"><i class="mdi mdi-plus"></i>  Add Insured</button>
        </div>
    </div>

    {{-- Primary Insured --}}
    <div class="card-body bg-white mb-4 addInsured" style="display:none">
        <div class="form-group row">
           <h4>Primary Insured</h4>
           <div class="form-group row">
            <div class="col-md-4 mb-2">
                <label>Name <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="First name" name="primary_insured_firstname" id="primary_insured_firstname" maxlength="15" value="{{ old('primary_insured_firstname') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Last name" name="primary_insured_lastname" id="primary_insured_lastname"  maxlength="30" value="{{ old('primary_insured_lastname') }}"/>
                    </div>
                </div>
                @error('primary_insured_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Gender <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-control" name="primary_insured_gender" id="primary_insured_gender">
                            <option value="">Select</option>
                            <option value="Male" {{ old('primary_insured_gender') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('primary_insured_gender') == 'Female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="Other" {{ old('primary_insured_gender') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>
                @error('primary_insured_gender')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Age <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Age" name="primary_insured_age" id="primary_insured_age" maxlength="3" onkeypress="return isNumberKey(event)" value="{{ old('primary_insured_age') }}"/>
                    </div>
                </div>
                @error('primary_insured_age')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label>Relation <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-control" name="primary_insured_relation" id="primary_insured_relation">
                            <option value="">Select</option>
                            <option value="Self" {{ old('primary_insured_relation') == 'Self' ? 'selected' : '' }}>Self
                            </option>
                            <option value="Husband" {{ old('primary_insured_relation') == 'Husband' ? 'selected' : '' }}>Husband
                            </option>
                            <option value="Wife" {{ old('primary_insured_relation') == 'Wife' ? 'selected' : '' }}>Wife
                            </option>
                            <option value="Son" {{ old('primary_insured_relation') == 'Son' ? 'selected' : '' }}>Son
                            </option>
                            <option value="Daughter" {{ old('primary_insured_relation') == 'Daughter' ? 'selected' : '' }}>Daughter
                            </option>
                            <option value="Father" {{ old('primary_insured_relation') == 'Father' ? 'selected' : '' }}>Father
                            </option>
                            <option value="Mother" {{ old('primary_insured_relation') == 'Mother' ? 'selected' : '' }}>Mother
                            </option>
                            <option value="Other" {{ old('primary_insured_relation') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>
                @error('primary_insured_relation')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-2">
                <label>Sum Insured <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Sum Insured" name="primary_insured_sum_insured" id="primary_insured_sum_insured"  maxlength="8" onkeypress="return isNumberKey(event)" value="{{ old('primary_insured_sum_insured') }}"/>
                    </div>
                </div>
                @error('primary_insured_sum_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Cumulative Bonus <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Cumulative Bonus" name="primary_insured_cumulative_bonus" id="primary_insured_cumulative_bonus" maxlength="8" onkeypress="return isNumberKey(event)" value="{{ old('primary_insured_cumulative_bonus') }}"/>
                    </div>
                </div>
                @error('primary_insured_cumulative_bonus')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Balance Sum Insured <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Balance Sum Insured" name="primary_insured_balance_sum_insured" id="primary_insured_balance_sum_insured" maxlength="8" onkeypress="return isNumberKey(event)" value="{{ old('primary_insured_balance_sum_insured') }}"/>
                    </div>
                </div>
                @error('primary_insured_balance_sum_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label>Comment <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" maxlength="250" class="form-control" name="primary_insured_comment" id="primary_insured_comment" placeholder="Enter Comment" value="{{ old('primary_insured_comment') }}">
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>

    {{-- Dependent Insured --}}
    <div class="card-body bg-white mb-4 addInsured" style="display:none">
        <div class="form-group row">
           <h4>Dependent Insured</h4>
           <div class="form-group row">
            <div class="col-md-4 mb-2">
                <label>Name <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="First name" name="dependent_insured_firstname" id="dependent_insured_firstname" maxlength="15"  value="{{ old('dependent_insured_firstname') }}"/>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Last name" name="dependent_insured_lastname" id="dependent_insured_lastname"  maxlength="30"  value="{{ old('dependent_insured_lastname') }}"/>
                    </div>
                </div>
                @error('dependent_insured_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Gender <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-control" name="dependent_insured_gender" id="dependent_insured_gender">
                            <option value="">Select</option>
                            <option value="Male" {{ old('dependent_insured_gender') == 'Male' ? 'selected' : '' }}>Male
                            </option>
                            <option value="Female" {{ old('dependent_insured_gender') == 'Female' ? 'selected' : '' }}>Female
                            </option>
                            <option value="Other" {{ old('dependent_insured_gender') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>
                @error('dependent_insured_gender')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Age <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Age" name="dependent_insured_age" id="dependent_insured_age" maxlength="3" onkeypress="return isNumberKey(event)" value="{{ old('dependent_insured_age') }}"/>
                    </div>
                </div>
                @error('dependent_insured_age')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label>Relation <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <select class="form-control" name="dependent_insured_relation" id="dependent_insured_relation">
                            <option value="">Select</option>
                            <option value="Self" {{ old('dependent_insured_relation') == 'Self' ? 'selected' : '' }}>Self
                            </option>
                            <option value="Husband" {{ old('dependent_insured_relation') == 'Husband' ? 'selected' : '' }}>Husband
                            </option>
                            <option value="Wife" {{ old('dependent_insured_relation') == 'Wife' ? 'selected' : '' }}>Wife
                            </option>
                            <option value="Son" {{ old('dependent_insured_relation') == 'Son' ? 'selected' : '' }}>Son
                            </option>
                            <option value="Daughter" {{ old('dependent_insured_relation') == 'Daughter' ? 'selected' : '' }}>Daughter
                            </option>
                            <option value="Father" {{ old('dependent_insured_relation') == 'Father' ? 'selected' : '' }}>Father
                            </option>
                            <option value="Mother" {{ old('dependent_insured_relation') == 'Mother' ? 'selected' : '' }}>Mother
                            </option>
                            <option value="Other" {{ old('dependent_insured_relation') == 'Other' ? 'selected' : '' }}>Other
                            </option>
                        </select>
                    </div>
                </div>
                @error('dependent_insured_relation')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mb-2">
                <label>Sum Insured <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Sum Insured" name="dependent_insured_sum_insured" id="dependent_insured_sum_insured"  maxlength="8" onkeypress="return isNumberKey(event)"  value="{{ old('dependent_insured_sum_insured') }}"/>
                    </div>
                </div>
                @error('dependent_insured_sum_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Cumulative Bonus <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Cumulative Bonus" name="dependent_insured_cumulative_bonus" id="dependent_insured_cumulative_bonus" maxlength="8" onkeypress="return isNumberKey(event)" value="{{ old('dependent_insured_cumulative_bonus') }}"/>
                    </div>
                </div>
                @error('dependent_insured_cumulative_bonus')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label>Balance Sum Insured <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" class="form-control" placeholder="Balance Sum Insured" name="dependent_insured_balance_sum_insured" id="dependent_insured_balance_sum_insured" maxlength="8" onkeypress="return isNumberKey(event)" value="{{ old('dependent_insured_balance_sum_insured') }}"/>
                    </div>
                </div>
                @error('dependent_insured_balance_sum_insured')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label>Comment <span class="text-danger">*</span></label>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="text" maxlength="250" class="form-control" name="dependent_insured_comment" id="dependent_insured_comment" placeholder="Enter Comment" value="{{ old('dependent_insured_comment') }}">
                    </div>
                </div>
            </div>
           </div>
        </div>
    </div>

    <div class="card-body">
        <div class="form-group text-end">
            <button type="submit" class="btn btn-success" form="insurance-form">Update</button>
        </div>
    </div>
</form>
