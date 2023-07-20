{{-- <div class="card-body">
        <form action="{{ route('admin.claimants.update-borrower-details',1) }}" method="post" id="borrower-details-form"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
            <div class="col-md-6 mb-3">
                <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="patient_id" name="patient_id" maxlength="60"
                placeholder="Enter Patient Id" value="{{ old('patient_id') }}">
                @error('patient_id')
                <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="claim_id">Cliam ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="claim_id" name="claim_id" maxlength="60"
                placeholder="Enter Claim Id" value="{{ old('claim_id') }}">
                @error('claim_id')
                <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="claimant_id">Claimant ID <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="claimant_id" name="claimant_id" maxlength="60"
                placeholder="Enter Claimant ID" value="{{ old('claimant_id') }}">
                @error('claimant_id')
                <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="hospital_id" name="hospital_id"
                placeholder="Enter Hospital Id" value="{{ old('hospital_id') }}">
                @error('hospital_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
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
                placeholder="Address Line"
                value="{{ old('hospital_address') }}">
                @error('hospital_address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="text" class="form-control" id="hospital_city" name="hospital_city"
                placeholder="City" value="{{ old('hospital_city') }}">
                @error('hospital_city')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="text" class="form-control" id="hospital_state" name="hospital_state"
                placeholder="State" value="{{ old('hospital_state') }}">
                @error('hospital_state')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="number" class="form-control" id="hospital_pincode" name="hospital_pincode"
                placeholder="Pincode" value="{{ old('hospital_pincode') }}">
                @error('hospital_pincode')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-12 mt-3">
                <label for="patient_firstname">Patient Name <span class="text-danger">*</span></label>
            </div>

            <div class="col-md-3 mt-1">
                <select class="form-control" id="patient_title" name="patient_title">
                    <option value="">Select</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                </select>
                @error('patient_title')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="patient_firstname"
                name="patient_firstname" maxlength="15" placeholder="First name"
                value="{{ old('patient_firstname') }}">
                @error('patient_firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="patient_middlename"
                name="patient_middlename" maxlength="30" placeholder="Last name"
                value="{{ old('patient_middlename') }}">
                @error('patient_middlename')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="patient_lastname"
                name="patient_lastname" maxlength="30" placeholder="Last name"
                value="{{ old('patient_lastname') }}">
                @error('patient_lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
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
                <select class="form-control" id="title" name="title">
                    <option value="">Select</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                </select>
                @error('title')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="firstname"
                name="firstname" maxlength="15" placeholder="First name"
                value="{{ old('firstname') }}">
                @error('firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="middlename"
                name="middlename" maxlength="30" placeholder="Middle name"
                value="{{ old('middlename') }}">
                @error('middlename')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-3 mt-1">
                <input type="text" maxlength="25" class="form-control" id="lastname"
                name="lastname" maxlength="30" placeholder="Last name"  value="{{ old('lastname') }}">
                @error('lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <label for="borrowers_relation_with_patient">Borrower's Relation with Patient <span class="text-danger">*</span></label>
                <select class="form-select" id="borrowers_relation_with_patient" name="borrowers_relation_with_patient">
                    <option value="">Select Borrower's Relation with Patient</option>
                    <option value="Spouse" {{ old('borrowers_relation_with_patient') == 'Spouse' ? 'selected' : '' }}>Spouse </option>
                    <option value="Child" {{ old('borrowers_relation_with_patient') == 'Child' ? 'selected' : '' }}>Child</option>
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
                <label for="dob">Borrower DOB <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="dob" name="dob"
                value="{{ old('dob') }}" onchange="calculateAge();">

                @error('dob')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mt-3">
                <label for="address">Borrower Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address"
                placeholder="Address Line"
                value="{{ old('address') }}">
                @error('address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="text" class="form-control" id="city" name="city"
                placeholder="City" value="{{ old('city') }}">
                @error('city')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="text" class="form-control" id="state" name="state"
                placeholder="State" value="{{ old('state') }}">
                @error('state')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <input type="number" class="form-control" id="pincode" name="pincode"
                placeholder="Pincode" value="{{ old('pincode') }}">
                @error('pincode')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label>Borrower ID Proof</label>
                <div class="input-group">
                    <select class="form-select" id="id_proof" name="id_proof">
                        <option value="">Select Borrower ID Proof</option>
                        <option value="Yes" {{ old('id_proof') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                        <option value="No" {{ old('id_proof', @$hospital->id_proof) == 'No' ? 'selected' : '' }}>No </option>
                    </select>
                    <input type="file" name="id_proof_file" id="id_proof_file" hidden />
                    <label for="id_proof_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>

                @error('id_proof')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('id_proof_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

             <div class="col-md-6 mt-3">
                <label for="mobile_no">Borrower Mobile No. <span class="text-danger">*</span></label>
                <div class="input-group">
                    <label class="input-group-text" for="mobile_no">+91</label>
                    <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                    pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                    placeholder="Enter Claimant Mobile No."
                    value="{{ old('mobile_no') }}">
                </div>
                @error('mobile_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="personal_email_id">Borrower email id <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email_id" name="email_id" maxlength="45"
                placeholder="Enter Borrower email id" value="{{ old('email_id') }}">
                @error('email_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="official_email_id">Borrower official email id<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="official_email_id" name="official_email_id" maxlength="45"
                placeholder="Enter Borrower official email id" value="{{ old('official_email_id') }}">
                @error('official_email_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>          

            <div class="col-md-6 mt-3">
                <label for="pan_no">Borrower Pan No. <span class="text-danger">*</span></label>
                <div class="input-group">
                <input type="text" class="form-control" id="pan_no" name="pan_no"
                maxlength="10" placeholder="Enter PAN no." value="{{ old('pan_no') }}">
                <input type="file" name="pan_no_file" id="pan_no_file" hidden />
                    <label for="pan_no_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>
                @error('pan_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('pan_no_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="aadhar_no">Borrower Aadhar No. <span class="text-danger">*</span></label>
                <div class="input-group">
                <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                maxlength="10" placeholder="Enter Aadhar no." value="{{ old('aadhar_no') }}">
                <input type="file" name="aadhar_no_file" id="aadhar_no_file" hidden />
                    <label for="aadhar_no_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>
                @error('aadhar_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('aadhar_no_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <label>Borrower Bank Statement</label>
                <div class="input-group">
                    <select class="form-select" id="bank_statement" name="bank_statement">
                        <option value="">Select Borrower Bank Statement</option>
                        <option value="Yes" {{ old('bank_statement') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                        <option value="No" {{ old('bank_statement', @$hospital->bank_statement) == 'No' ? 'selected' : '' }}>No </option>
                    </select>
                    <input type="file" name="bank_statement_file" id="bank_statement_file" hidden />
                    <label for="bank_statement_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>

                @error('bank_statement')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('bank_statement_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4 mt-3">
                <label>Borrower  ITR (Income Tax Return)</label>
                <div class="input-group">
                    <select class="form-select" id="itr" name="itr">
                        <option value="">Select Borrower  ITR (Income Tax Return)</option>
                        <option value="Yes" {{ old('itr') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                        <option value="No" {{ old('itr', @$hospital->itr) == 'No' ? 'selected' : '' }}>No </option>
                    </select>
                    <input type="file" name="itr_file" id="itr_file" hidden />
                    <label for="itr_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>

                @error('itr')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('itr_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-4 mt-3">
                <label>Borrower Cancel Cheque</label>
                <div class="input-group">
                    <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                        <option value="">Select Borrower Cancel Cheque</option>
                        <option value="Yes" {{ old('cancel_cheque') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                        <option value="No" {{ old('cancel_cheque', @$hospital->cancel_cheque) == 'No' ? 'selected' : '' }}>No </option>
                    </select>
                    <input type="file" name="cancel_cheque_file" id="cancel_cheque_file" hidden />
                    <label for="cancel_cheque_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                </div>

                @error('cancel_cheque')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('cancel_cheque_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="col-md-6 mt-3">
                <label for="personal_email_id">Claimant Personal email id <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="personal_email_id" name="personal_email_id" maxlength="45"
                placeholder="Enter Claimant Personal email id" value="{{ old('personal_email_id') }}">
                @error('personal_email_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="official_email_id">Claimant official email id<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="official_email_id" name="official_email_id" maxlength="45"
                placeholder="Enter Claimant official email id" value="{{ old('official_email_id') }}">
                @error('official_email_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 mt-2">
                <label for="address">Borrower Bank Details <span class="text-danger">*</span></label>
            </div>


            <div class="col-md-6 mt-2">
                <input type="text" class="form-control" id="bank_name" name="bank_name" maxlength="45"
                placeholder="Bank Name" value="{{ old('bank_name') }}">
                @error('bank_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>            

            <div class="col-md-6 mt-2">
                <input type="text" class="form-control" id="bank_address" name="bank_address" maxlength="80"
                placeholder="Bank Address" value="{{ old('bank_address') }}">
                @error('bank_address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-2">
                <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" maxlength="20"
                placeholder="Bank Account No." value="{{ old('bank_account_no', @$hospital->bank_account_no) }}">
                @error('bank_account_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-2">
                <input type="text" class="form-control" id="bank_ifs_code" name="bank_ifs_code" maxlength="11"
                placeholder="Bank Ifs Code" value="{{ old('bank_ifs_code', @$hospital->bank_ifs_code) }}">
                @error('bank_ifs_code')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <label for="co_borrower_nominee_name">Co-Borrower / Nominee Name <span class="text-danger">*</span></label>
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
                <label for="co_borrower_nominee_dob">Co-Borrower / Nominee DOB <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="date" class="form-control" id="co_borrower_nominee_dob" name="co_borrower_nominee_dob" placeholder="Enter Co-Borrower / Nominee DOB" 
                    value="{{ old('co_borrower_nominee_dob') }}" >
                    <input type="file" name="co_borrower_nominee_dob_file" id="co_borrower_nominee_dob_file" hidden />
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
                <label for="co_borrower_nominee_gender">Co-Borrower / Nominee Gender <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="co_borrower_nominee_gender" name="co_borrower_nominee_gender">
                        <option value="">Select Co-Borrower / Nominee Gender</option>
                        <option value="Male" {{ old('co_borrower_nominee_gender') == 'Male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="Female" {{ old('co_borrower_nominee_gender') == 'Female' ? 'selected' : '' }}>Female
                        </option>
                        <option value="Other" {{ old('co_borrower_nominee_gender') == 'Other' ? 'selected' : '' }}>Other
                        </option>
                    </select>
                    <input type="file" name="co_borrower_nominee_gender_file" id="co_borrower_nominee_gender_file" hidden />
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
                <label for="co_borrower_nominee_relation">Co-Borrower / Nominee Relation <span class="text-danger">*</span></label>
                <select class="form-select" id="co_borrower_nominee_relation" name="co_borrower_nominee_relation">
                    <option value="">Select Co-Borrower / Nominee Relation</option>
                    <option value="Spouse" {{ old('co_borrower_nominee_relation') == 'Spouse' ? 'selected' : '' }}>Spouse </option>
                    <option value="Child" {{ old('co_borrower_nominee_relation') == 'Child' ? 'selected' : '' }}>Child</option>
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
                    <input type="file" name="co_borrower_other_documents_file" id="co_borrower_other_documents_file" hidden />
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
                <label for="estimated_amount">Estimated Amount <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="estimated_amount" name="estimated_amount"
                pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                placeholder="Enter Estimated Amount"
                value="{{ old('estimated_amount') }}">
                @error('estimated_amount')
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
                <button type="submit" class="btn btn-success" form="borrower-details-form">
                Create / Save Borrower ID</button>
            </div>

        </div>
    </form>
</div> --}}
@push('scripts')
<script>
    $(document).on('change', '#is_patient_and_borrower_same', function(event) {
        event.preventDefault();
        if($(this).val() == 'Yes'){
            setPatient();
            $("#is_claimant_and_borrower_same").attr('disabled', true);
        }else{
            $("#is_claimant_and_borrower_same").attr('disabled', false);
        }
    });

    $(document).on('change', '#is_claimant_and_borrower_same', function(event) {
        event.preventDefault();
        if($(this).val() == 'Yes'){
            setClaimant();
            $("#is_claimant_and_borrower_same").attr('disabled', true);
        }else{
            $("#is_claimant_and_borrower_same").attr('disabled', false);
        }
    });

    function setPatient() {
        var title               = $("#title");
        var firstname           = $("#firstname");
        var middlename          = $("#middlename");
        var lastname            = $("#lastname");
        var age                 = $("#age");
        var gender              = $("#gender");
        var hospital            = $("#hospital");
        var registrationno      = $("#registrationno");

        $('#title').val(title);
        $('#firstname').val(firstname);
        $('#middlename').val(middlename);
        $('#lastname').val(lastname);
        $('#age').val(age);
        $('#gender').val(gender);
        $('#hospital_name').val(hospital).trigger('change');
        $('#registration_no').val(registrationno);
    }

    function setPatient() {
        var title               = $("#title");
        var firstname           = $("#firstname");
        var middlename          = $("#middlename");
        var lastname            = $("#lastname");
        var age                 = $("#age");
        var gender              = $("#gender");
        var hospital            = $("#hospital");
        var registrationno      = $("#registrationno");

        $('#title').val(title);
        $('#firstname').val(firstname);
        $('#middlename').val(middlename);
        $('#lastname').val(lastname);
        $('#age').val(age);
        $('#gender').val(gender);
        $('#hospital_name').val(hospital).trigger('change');
        $('#registration_no').val(registrationno);
    }
</script>
@endpush

