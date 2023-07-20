        <form action="{{ route('hospital.claimants.update-borrower-details',$id) }}" method="post" id="borrower-details-form"
        enctype="multipart/form-data">
        @csrf
     {{--    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif --}}
        <div class="card-body mb-4">
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="patient_id" name="patient_id" maxlength="60"
                    placeholder="Enter Patient Id" value="{{ old('patient_id',$borrower->patient_id) }}">
                    @error('patient_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="claim_id">Cliam ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="claim_id" name="claim_id" maxlength="60"
                    placeholder="Enter Claim Id" value="{{ old('claim_id',$borrower->claim_id) }}">
                    @error('claim_id')
                    <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="claimant_id">Claimant ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="claimant_id" name="claimant_id" maxlength="60"
                    placeholder="Enter Claimant ID" value="{{ old('claimant_id',$claimant->uid) }}">
                    @error('claimant_id')
                    <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="hospital_id">Hospital Id <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="hospital_id" name="hospital_id"
                    placeholder="Enter Hospital Id" value="{{ old('hospital_id',$borrower->hospital_id) }}">
                    @error('hospital_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="hospital_name" name="hospital_name"
                    placeholder="Enter Hospital Name" value="{{ old('hospital_name',$borrower->hospital_name) }}">
                    @error('hospital_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="hospital_address" name="hospital_address"
                    placeholder="Address Line"
                    value="{{ old('hospital_address',$borrower->hospital_address) }}">
                    @error('hospital_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="hospital_city" name="hospital_city"
                    placeholder="City" value="{{ old('hospital_city',$borrower->hospital_city) }}">
                    @error('hospital_city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="hospital_state" name="hospital_state"
                    placeholder="State" value="{{ old('hospital_state',$borrower->hospital_state) }}">
                    @error('hospital_state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="number" class="form-control" id="hospital_pincode" name="hospital_pincode"
                    placeholder="Pincode" value="{{ old('hospital_pincode',$borrower->hospital_pincode) }}">
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
                        <option @if( old('patient_title', $borrower->patient_title) == 'Mr.') selected @endif value="Mr.">Mr.</option>
                        <option @if( old('patient_title', $borrower->patient_title) == 'Ms.') selected @endif value="Ms.">Ms.</option>
                    </select>
                    @error('patient_title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_firstname"
                    name="patient_firstname" maxlength="15" placeholder="First name"
                    value="{{ old('patient_firstname',$borrower->patient_firstname) }}">
                    @error('patient_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_middlename"
                    name="patient_middlename" maxlength="30" placeholder="Last name"
                    value="{{ old('patient_middlename',$borrower->patient_middlename) }}">
                    @error('patient_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_lastname"
                    name="patient_lastname" maxlength="30" placeholder="Last name"
                    value="{{ old('patient_lastname',$borrower->patient_lastname) }}">
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
                    <input type="text" maxlength="25" class="form-control" id="borrower_firstname"
                    name="borrower_firstname" maxlength="15" placeholder="First name"
                    value="{{ old('borrower_firstname',$borrower->borrower_firstname) }}">
                    @error('borrower_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="borrower_middlename"
                    name="borrower_middlename" maxlength="30" placeholder="Middle name"
                    value="{{ old('borrower_middlename',$borrower->borrower_middlename) }}">
                    @error('borrower_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="borrower_lastname"
                    name="borrower_lastname" maxlength="30" placeholder="Last name"  value="{{ old('borrower_lastname',$borrower->borrower_lastname) }}">
                    @error('borrower_lastname')
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
                    value="{{ old('dob',$borrower->dob) }}" onchange="calculateAge();">

                    @error('dob')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="borrower_address">Borrower Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="borrower_address" name="borrower_address"
                    placeholder="Address Line"
                    value="{{ old('borrower_address',$borrower->borrower_address) }}">
                    @error('borrower_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="borrower_city" name="borrower_city"
                    placeholder="City" value="{{ old('borrower_city',$borrower->borrower_city) }}">
                    @error('borrower_city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="text" class="form-control" id="borrower_state" name="borrower_state"
                    placeholder="State" value="{{ old('borrower_state',$borrower->borrower_state) }}">
                    @error('borrower_state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-3">
                    <input type="number" class="form-control" id="borrower_pincode" name="borrower_pincode"
                    placeholder="Pincode" value="{{ old('borrower_pincode',$borrower->borrower_pincode) }}">
                    @error('borrower_pincode')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label>Borrower ID Proof *{{ old('borrower_id_proof', $borrower->borrower_id_proof)  }}</label>
                    <div class="input-group">
                        <select class="form-select" id="borrower_id_proof" name="borrower_id_proof">
                            <option value="">Select Borrower ID Proof</option>
                            <option value="Aadhar Card" {{ old('borrower_id_proof', $borrower->borrower_id_proof) == 'Aadhar Card' ? 'selected' : '' }}>Aadhar Card </option>
                            <option value="PAN Card" {{ old('borrower_id_proof', $borrower->borrower_id_proof) == 'PAN Card' ? 'selected' : '' }}>PAN Card  </option>
                            <option value="Voter's ID" {{ old('borrower_id_proof', $borrower->borrower_id_proof) == "Voter's ID" ? 'selected' : '' }}>Voter's ID</option>
                            <option value="Driving Licence"{{ old('borrower_id_proof', $borrower->borrower_id_proof) == 'Driving Licence' ? 'selected' : '' }}>Driving Licence </option>
                            <option value="Passport" {{ old('borrower_id_proof', $borrower->patient_id_proof) == 'Passport' ? 'selected' : '' }}>Passport</option>
                        </select>
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
                    <label for="borrower_mobile_no">Borrower Mobile No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <label class="input-group-text" for="borrower_mobile_no">+91</label>
                        <input type="number" class="form-control" id="borrower_mobile_no" name="borrower_mobile_no"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                        placeholder="Enter Claimant Mobile No."
                        value="{{ old('borrower_mobile_no',$borrower->borrower_mobile_no) }}">
                    </div>
                    @error('borrower_mobile_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_personal_email_id">Borrower Personal email id <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="borrower_personal_email_id" name="borrower_personal_email_id" maxlength="45"
                    placeholder="Enter Borrower Personal email id" value="{{ old('borrower_personal_email_id',$borrower->borrower_personal_email_id) }}">
                    @error('borrower_personal_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="borrower_official_email_id">Borrower official email id<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="borrower_official_email_id" name="borrower_official_email_id" maxlength="45"
                    placeholder="Enter Borrower official email id" value="{{ old('borrower_official_email_id',$borrower->borrower_official_email_id) }}">
                    @error('borrower_official_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>         

                <div class="col-md-6 mt-3">
                    <label for="borrower_pan_no">Borrower Pan No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="borrower_pan_no" name="borrower_pan_no"
                        maxlength="10" placeholder="Enter PAN no." value="{{ old('borrower_pan_no',$borrower->borrower_pan_no) }}">
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
                        <input type="text" class="form-control" id="borrower_aadhar_no" name="borrower_aadhar_no"
                        maxlength="10" placeholder="Enter Aadhar no." value="{{ old('borrower_aadhar_no',$borrower->borrower_aadhar_no) }}">
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

                <div class="col-md-4 mt-3">
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

                <div class="col-md-4 mt-3">
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


                <div class="col-md-4 mt-3">
                    <label>Borrower Cancel Cheque</label>
                    <div class="input-group">
                        <select class="form-select" id="borrower_cancel_cheque" name="borrower_cancel_cheque">
                            <option value="">Select Borrower Cancel Cheque</option>
                            <option value="Yes" {{ old('borrower_cancel_cheque') == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('borrower_cancel_cheque', @$hospital->borrower_cancel_cheque) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                        <input type="file" name="borrower_cancel_cheque_file" id="borrower_cancel_cheque_file" hidden  onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="borrower_cancel_cheque_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>

                    @error('borrower_cancel_cheque')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('borrower_cancel_cheque_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>               
                

                <div class="col-md-12 mt-2">
                    <label for="address">Borrower Bank Details <span class="text-danger">*</span></label>
                </div>


                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_bank_name" name="borrower_bank_name" maxlength="45"
                    placeholder="Bank Name" value="{{ old('borrower_bank_name',$borrower->borrower_bank_name) }}">
                    @error('borrower_bank_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>            

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_bank_address" name="borrower_bank_address" maxlength="80"
                    placeholder="Bank Address" value="{{ old('borrower_bank_address',$borrower->borrower_bank_address) }}">
                    @error('borrower_bank_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_ac_no" name="borrower_ac_no" maxlength="20"
                    placeholder="Bank Account No." value="{{ old('borrower_ac_no',$borrower->borrower_ac_no, @$hospital->borrower_ac_no) }}">
                    @error('borrower_ac_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="borrower_ifs_code" name="borrower_ifs_code" maxlength="11"
                    placeholder="Bank Ifs Code" value="{{ old('borrower_ifs_code',$borrower->borrower_ifs_code, @$hospital->borrower_ifs_code) }}">
                    @error('borrower_ifs_code')
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
                        value="{{ old('co_borrower_nominee_dob',$borrower->co_borrower_nominee_dob) }}" >
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
                    pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                    placeholder="Enter Estimated Amount"
                    value="{{ old('borrower_estimated_amount',$borrower->borrower_estimated_amount) }}">
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
                    <button type="submit" class="btn btn-success" form="borrower-details-form">
                    Create / Save Borrower ID</button>
                </div>

            </div>
        </div>
    </form>
@push('scripts')
<script>
    /*$(document).on('change', '#is_patient_and_borrower_same', function(event) {
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
    });*/

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

    function setClaimant() {
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

<script>

    $(document).ready(function () {
        $('#is_patient_and_borrower_same').on('change', function () {
            var idCountry = this.value;
            if(idCountry == 'Yes'){
                $("#is_claimant_and_borrower_same").attr('disabled', true);

                $.ajax({
                    url: "{{route('hospital.claimants.fetch-patient', $claimant->patient_id)}}",
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
                        $("#borrower_id_proof_file").val(result.id_proof_file);
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
                $("#borrower_id_proof_file").val('');

                $("#is_claimant_and_borrower_same").attr('disabled', false);
                $("#is_claimant_and_borrower_same").val('').trigger('change');
            }

        });
        $('#is_claimant_and_borrower_same').on('change', function () {
            var idState = this.value;
            if(idState == 'Yes'){
                $.ajax({
                    url: "{{route('hospital.claimants.fetch-claimant', $id)}}",
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
                        $("#borrower_pan_no_file").val(result.pan_no_file);
                        $("#borrower_id_proof_file").val(result.id_proof_file);
                        $("#borrower_aadhar_no_file").val(result.aadhar_no_file);
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
                $("#borrower_id_proof_file").val('');
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

        // var is_patient_and_borrower_same = "{{ old('is_patient_and_borrower_same', $borrower->is_patient_and_borrower_same) }}";
        var is_patient_and_borrower_same = "{{ old('is_patient_and_borrower_same') }}";

    // var is_claimant_and_borrower_same = "{{ old('is_claimant_and_borrower_same', $borrower->is_claimant_and_borrower_same) }}";
    var is_claimant_and_borrower_same = "{{ old('is_claimant_and_borrower_same') }}";

    if(is_patient_and_borrower_same == 'Yes'){

        $("#is_claimant_and_borrower_same").attr('disabled', true);

        $.ajax({
            url: "{{route('hospital.claimants.fetch-patient', $claimant->patient_id)}}",
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
                $("#borrower_id_proof_file").val(result.id_proof_file);
            }
        });


    }

    if(is_patient_and_borrower_same == 'No'){
        $("#borrower_title").val('');
        $("#borrower_firstname").val('');
        $("#borrower_lastname").val('');
        $("#borrower_middlename").val('');
        $("#borrower_address").val('');
        $("#borrower_city").val('');
        $("#borrower_state").val('');
        $("#borrower_pincode").val('');
        $("#borrower_personal_email_id").val('');
        $("#borrower_mobile_no").val('');
        $("#borrower_id_proof_file").val('');

        $("#is_claimant_and_borrower_same").attr('disabled', false);
        // $("#is_claimant_and_borrower_same").val('').trigger('change');
    }

    if(is_claimant_and_borrower_same == 'No'){
        $("#borrower_title").val('');
        $("#borrower_firstname").val('');
        $("#borrower_lastname").val('');
        $("#borrower_middlename").val('');
        $("#borrower_address").val('');
        $("#borrower_city").val('');
        $("#borrower_state").val('');
        $("#borrower_pincode").val('');
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
        $("#borrower_id_proof_file").val('');

    }

    if(is_claimant_and_borrower_same == 'Yes'){


        $.ajax({
            url: "{{route('hospital.claimants.fetch-claimant', $id)}}",
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
                $("#borrower_id_proof").val(result.id_proof);
                $("#borrower_personal_email_id").val(result.personal_email_id);
                $("#borrower_mobile_no").val(result.mobile_no);
                $("#borrower_pan_no").val(result.pan_no);
                $("#borrower_aadhar_no").val(result.aadhar_no);
                $("#borrower_bank_name").val(result.bank_name);
                $("#borrower_bank_address").val(result.bank_address);
                $("#borrower_ac_no").val(result.ac_no);
                $("#borrower_ifs_code").val(result.ifs_code);
                $("#borrower_pan_no_file").val(result.pan_no_file);
                $("#borrower_aadhar_no_file").val(result.aadhar_no_file);
                $("#borrower_id_proof_file").val(result.id_proof_file);
            }
        });


    }

</script>
@endpush

