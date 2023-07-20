<div class="form-group row">
<div class="col-12">
    <div class="card no-shadow">
        <div class="card-body">
            <form action="{{ route('associate-partner.patients.store') }}" method="post" id="hospital-form"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    
                    <div class="col-md-6 mt-3">
                        <label for="patient_id">Patient Id <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="patient_id" name="patient_id"
                            placeholder="Enter Hospital name" value="{{ old('patient_id') }}">
                        @error('patient_id')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-5 mt-3">
                        <label for="policy_copy">Policy Copy <span class="text-danger">*</span></label>
                        <select class="form-select" id="policy_copy" name="policy_copy">
                            <option value="">Select Policy Copy</option>
                            <option value="Yes" {{ old('policy_copy') == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No"
                                {{ old('policy_copy') == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                        @error('policy_copy')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-1 mt-3">
                        <div class="input-group">
                                <input type="file" name="policy_copy_file" id="policy_copy_upload" hidden />
                                <label for="policy_copy_upload" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                        </div>
                        @error('panfile')
                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6 mt-3">
                        <label for="tpa_card">TPA Card <span class="text-danger">*</span></label>
                        <select class="form-select" id="tpa_card" name="tpa_card">
                            <option value="">Select TPA Card</option>
                            <option value="Yes" {{ old('tpa_card') == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No"
                                {{ old('tpa_card') == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                        @error('tpa_card')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="tpa_card_no">TPA Card No. <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tpa_card_no" name="tpa_card_no"
                            placeholder="Enter TPA Card No."
                            value="{{ old('tpa_card_no') }}">
                        @error('tpa_card_no')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6 mt-3">
                        <label for="insurance_company">Insurance Company <span class="text-danger">*</span></label>
                        <select class="form-select" id="insurance_company" name="insurance_company">
                            <option value="">Select Insurance Company</option>
                            <option value="Yes" {{ old('insurance_company') == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No"
                                {{ old('insurance_company') == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                        @error('insurance_company')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="policy_name">Policy Name <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="policy_name" name="policy_name"
                            placeholder="Enter Policy Name"
                            value="{{ old('policy_name') }}">
                        @error('policy_name')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="policy_no">Policy No. <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="policy_no" name="policy_no"
                            placeholder="Enter Policy No."
                            value="{{ old('policy_no') }}">
                        @error('policy_no')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="policy_start_date">Policy Start Date</label>
                        <input type="date" class="form-control" value="{{ old('policy_start_date') }}" id="policy_start_date" name="Enter Policy Start Date"  placeholder="Probable Date of Admission"></input>
                        @error('policy_start_date')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="policy_expiry_date">Policy Expiry Date </label>
                        <input type="date" class="form-control" {{ old('policy_expiry_date') }} id="policy_expiry_date" name="policy_expiry_date"  placeholder="Enter Policy Expiry Date"></input>
                        @error('policy_expiry_date')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>  

                    <div class="col-md-6 mt-3">
                        <label for="policy_inception_date">Policy Inception Date</label>
                        <input type="date" class="form-control" value="{{ old('policy_inception_date') }}" id="policy_inception_date" name="Policy Inception Date"  placeholder="Probable Date of Admission"></input>
                        @error('policy_inception_date')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="no_of_insured_person">No. of Insured Person <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="no_of_insured_person" name="no_of_insured_person"
                            placeholder="Enter No. of Insured Person" value="{{ old('no_of_insured_person') }}">
                        @error('no_of_insured_person')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="basic_sum_insured">Basic Sum Insured <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="basic_sum_insured" name="basic_sum_insured"
                            placeholder="Enter Basic Sum Insured" value="{{ old('basic_sum_insured') }}">
                        @error('basic_sum_insured')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="cumulative_bonus">Cumulative Bonus <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cumulative_bonus" name="cumulative_bonus"
                            placeholder="Enter Cumulative Bonus" value="{{ old('cumulative_bonus') }}">
                        @error('cumulative_bonus')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="policy_type">Policy Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="policy_type" name="policy_type">
                            <option value="">Select Policy Type</option>
                            <option value="Yes" {{ old('policy_type') == 'Yes' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="No"
                                {{ old('policy_type') == 'No' ? 'selected' : '' }}>No
                            </option>
                        </select>
                        @error('policy_type')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="group_proposer_name">Group/Proposer Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="group_proposer_name" name="group_proposer_name"
                            placeholder="Enter Basic Sum Insured" value="{{ old('group_proposer_name') }}">
                        @error('group_proposer_name')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="email">Email ID <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="30"
                            placeholder="Enter email ID" value="{{ old('email') }}">
                        @error('email')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-6 mt-3">
                        <label for="mobile">Mobile Number <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="mobile" name="mobile"
                            placeholder="Enter mobile number" value="{{ old('mobile') }}">
                        @error('mobile')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="tpa">TPA <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="tpa" name="tpa"
                            placeholder="Enter hospital tpa number" value="{{ old('tpa') }}">
                        @error('tpa')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address"
                            placeholder="Address Line" value="{{ old('address') }}">
                        @error('address')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" id="city" name="city"
                            placeholder="City" value="{{ old('city') }}">
                        @error('city')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mt-2">
                        <input type="text" class="form-control" id="state" name="state"
                            placeholder="State" value="{{ old('state') }}">
                        @error('state')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mt-2">
                        <input type="number" class="form-control" id="pincode" name="pincode" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"
                            placeholder="Pincode" value="{{ old('pincode') }}">
                        @error('pincode')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="agent_broker_code">Agent/Broker Code <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="agent_broker_code" name="agent_broker_code"
                            placeholder="Enter Agent/Broker Code" value="{{ old('agent_broker_code', @$agent_broker_code) }}">
                        @error('agent_broker_code')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="agent_broker_name">Agent/Broker Name <span class="text-danger">*</span></label>
                        <input type="text" readonly class="form-control" id="agent_broker_name" name="agent_broker_name"
                            placeholder="Enter Agent/Broker Name " value="{{ old('agent_broker_name', @$agent_broker_name) }}">
                        @error('agent_broker_name')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="comments">Comments </label>
                        <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Policy Details Comments" rows="4">{{ old('comments') }}</textarea>
                        @error('comments')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 text-end mt-3">
                        <button type="submit" class="btn btn-success" form="hospital-form">Create
                            Patient ID</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>