        <form action="{{ route('admin.claimants.update',$id) }}" method="post" id="claimant-id-form"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body mb-4">
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="patient_id" name="patient_id" maxlength="60"
                    placeholder="Enter Patient Id" value="{{ old('patient_id',$claimant->patient_id) }}">
                    @error('patient_id')
                    <span id="patient-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="claim_id">Cliam ID <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="claim_id" name="claim_id" maxlength="60"
                    placeholder="Enter Claim Id" value="{{ old('claim_id',$claimant->claim_id) }}">
                    @error('claim_id')
                    <span id="claim-id-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="associate_partner_id">Associate Partner ID <span  class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="associate_partner_id"
                    name="associate_partner_id" placeholder="Associate Partner ID"
                    value="{{ old('associate_partner_id',$claimant->associate_partner_id) }}">
                    @error('associate_partner_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="name">Hospital Id <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="hospital_id" name="hospital_id"
                    placeholder="Enter Hospital name" value="{{ old('hospital_id',$claimant->hospital_id) }}">
                    @error('hospital_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 mt-3">
                    <label for="patient_firstname">Patient Name <span class="text-danger">*</span></label>
                </div>

                <div class="col-md-3 mt-1">
                    <select class="form-control" id="patient_title" name="patient_title">
                        <option value="">Select</option>
                        <option @if(old('patient_title',$claimant->patient_title) == 'Mr.') selected @endif value="Mr.">Mr.</option>
                        <option @if(old('patient_title',$claimant->patient_title) == 'Ms.') selected @endif value="Ms.">Ms.</option>
                    </select>
                    @error('patient_title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_firstname"
                    name="patient_firstname" maxlength="15" placeholder="First name"
                    value="{{ old('patient_firstname',$claimant->patient_firstname) }}">
                    @error('patient_firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_middlename"
                    name="patient_middlename" maxlength="30" placeholder="Last name"
                    value="{{ old('patient_middlename',$claimant->patient_middlename) }}">
                    @error('patient_middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="patient_lastname"
                    name="patient_lastname" maxlength="30" placeholder="Last name"
                    value="{{ old('patient_lastname',$claimant->patient_lastname) }}">
                    @error('patient_lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <label for="patient_id_proof">Patient ID Proof <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select class="form-select" id="patient_id_proof" name="patient_id_proof">
                            <option value="">Select</option>
                            <option value="Aadhar Card" {{ old('patient_id_proof', $claimant->patient_id_proof) == 'Aadhar Card' ? 'selected' : '' }}>Aadhar Card </option>
                            <option value="PAN Card" {{ old('patient_id_proof', $claimant->patient_id_proof) == 'PAN Card' ? 'selected' : '' }}>PAN Card  </option>
                            <option value="Voter's ID" {{ old('patient_id_proof', $claimant->patient_id_proof) == "Voter's ID" ? 'selected' : '' }}>Voter's ID</option>
                            <option value="Driving Licence"{{ old('patient_id_proof', $claimant->patient_id_proof) == 'Driving Licence' ? 'selected' : '' }}>Driving Licence </option>
                            <option value="Passport" {{ old('patient_id_proof', $claimant->patient_id_proof) == 'Passport' ? 'selected' : '' }}>Passport</option>
                        </select>
                        <input type="file" name="patient_id_proof_file" id="upload" hidden
                        onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="upload" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                    </div>
                    @error('patient_id_proof')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('patient_id_proof_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="are_patient_and_claimant_same">Are Patient and Claimant Same <span class="text-danger">*</span></label>
                    <select class="form-select" id="are_patient_and_claimant_same" name="are_patient_and_claimant_same">
                        <option value="">Select Are Patient and Claimant Same</option>
                        <option value="Yes" {{ old('are_patient_and_claimant_same', $claimant->are_patient_and_claimant_same) == 'Yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ old('are_patient_and_claimant_same', $claimant->are_patient_and_claimant_same) == 'No' ? 'selected' : '' }}>No
                        </option>
                    </select>
                    @error('are_patient_and_claimant_same')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="firstname">Claimant Name<span class="text-danger">*</span></label>
                </div>

                <div class="col-md-3 mt-1">
                    <select class="form-control" id="title" name="title">
                        <option value="">Select</option>
                        <option @if(old('title',$claimant->title) == 'Mr.') selected @endif value="Mr.">Mr.</option>
                        <option @if(old('title',$claimant->title) == 'Ms.') selected @endif value="Ms.">Ms.</option>
                    </select>
                    @error('title')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="firstname"
                    name="firstname" placeholder="First name"
                    value="{{ old('firstname',$claimant->firstname) }}">
                    @error('firstname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="middlename"
                    name="middlename" placeholder="Middle name"
                    value="{{ old('middlename',$claimant->middlename) }}">
                    @error('middlename')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-3 mt-1">
                    <input type="text" maxlength="25" class="form-control" id="lastname"
                    name="lastname" placeholder="Last name"
                    value="{{ old('lastname',$claimant->lastname) }}">
                    @error('lastname')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <label for="pan_no">Claimant Pan No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="pan_no" name="pan_no"
                        maxlength="10" placeholder="Enter PAN no." value="{{ old('pan_no',$claimant->pan_no) }}">
                        <input type="file" name="pan_no_file" id="pan_no_file" hidden
                        onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="pan_no_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                    </div>
                    @error('pan_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('pan_no_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="aadhar_no">Claimant Aadhar No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="aadhar_no" name="aadhar_no"
                        maxlength="12" placeholder="Enter Aadhar no." value="{{ old('aadhar_no',$claimant->aadhar_no) }}">
                        <input type="file" name="aadhar_no_file" id="aadhar_no_file" hidden
                        onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="aadhar_no_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                    </div>
                    @error('aadhar_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('aadhar_no_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="patients_relation_with_claimant">Patient's Relation with Claimant <span class="text-danger">*</span></label>
                    <select class="form-select" id="patients_relation_with_claimant" name="patients_relation_with_claimant">
                        <option value="">Select Patient's Relation with Claimant</option>
                        <option value="Self" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Self' ? 'selected' : '' }}>Self </option>
                        <option value="Spouse" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Spouse' ? 'selected' : '' }}>Spouse </option>
                        <option value="Child" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Child' ? 'selected' : '' }}>Child</option>
                        <option value="Father" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Other" {{ old('patients_relation_with_claimant', $claimant->patients_relation_with_claimant) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('patients_relation_with_claimant')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <label for="specify">Please Specify <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="specify" name="specify"
                    placeholder="Specify here" value="{{ old('specify',$claimant->specify) }}">
                    @error('specify')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="address">Claimant Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address Line" value="{{ old('address',$claimant->address) }}" maxlength="100">
                    @error('address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" id="city" name="city"
                    placeholder="City" value="{{ old('city',$claimant->city) }}">
                    @error('city')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-2">
                    <input type="text" class="form-control" id="state" name="state"
                    placeholder="State" value="{{ old('state',$claimant->state) }}">
                    @error('state')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-4 mt-2">
                    <input type="number" class="form-control" id="pincode" name="pincode"
                    placeholder="Pincode" value="{{ old('pincode',$claimant->pincode) }}">
                    @error('pincode')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="personal_email_id">Claimant Personal email id <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="personal_email_id" name="personal_email_id" maxlength="45"
                    placeholder="Enter Claimant Personal email id" value="{{ old('personal_email_id',$claimant->personal_email_id) }}">
                    @error('personal_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="official_email_id">Claimant official email id<span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="official_email_id" name="official_email_id" maxlength="45"
                    placeholder="Enter Claimant official email id" value="{{ old('official_email_id',$claimant->official_email_id) }}">
                    @error('official_email_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="mobile_no">Claimant Mobile No. <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <label class="input-group-text" for="mobile_no">+91</label>
                        <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                        placeholder="Enter Claimant Mobile No."
                        value="{{ old('mobile_no',$claimant->mobile_no) }}">
                    </div>
                    @error('mobile_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <label for="estimated_amount">Estimated Amount <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="estimated_amount" name="estimated_amount"
                    pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                    placeholder="Enter Estimated Amount"
                    value="{{ old('estimated_amount',$claimant->estimated_amount) }}">
                    @error('estimated_amount')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="address">Claimant Cancel Cheque <span class="text-danger">*</span></label>
                </div>

                <div class="col-md-12 mt-2">
                    <div class="input-group">
                        <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                            <option value="">Cancel Cheque</option>
                            <option value="Yes" {{ old('cancel_cheque', $claimant->cancel_cheque) == 'Yes' ? 'selected' : '' }}>Yes  </option>
                            <option value="No" {{ old('cancel_cheque', $claimant->cancel_cheque) == 'No' ? 'selected' : '' }}>No </option>
                        </select>
                        <input type="file" name="cancel_cheque_file" id="cancel_cheque_file" hidden onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="cancel_cheque_file" class="btn btn-primary upload-label"><i  class="mdi mdi-upload"></i></label>
                    </div>

                    @error('cancel_cheque')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                    @error('cancel_cheque_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 mt-3">
                    <label for="address">Claimant Bank Details <span class="text-danger">*</span></label>
                </div>


                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="bank_name" name="bank_name" maxlength="45"
                    placeholder="Bank Name" value="{{ old('bank_name',$claimant->bank_name) }}">
                    @error('bank_name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>            

                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" id="bank_address" name="bank_address" maxlength="80"
                    placeholder="Bank Address" value="{{ old('bank_address',$claimant->bank_address) }}">
                    @error('bank_address')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <input type="text" class="form-control" id="ac_no" name="ac_no" maxlength="20"
                    placeholder="Bank Account No." value="{{ old('ac_no',$claimant->ac_no) }}">
                    @error('ac_no')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <input type="text" class="form-control" id="ifs_code" name="ifs_code" maxlength="11"
                    placeholder="Bank Ifs Code" value="{{ old('ifs_code',$claimant->ifs_code) }}">
                    @error('ifs_code')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 mt-3">
                    <label for="comments">Claimant Comments </label>
                    <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Claimant Comments"
                    rows="5">{{ old('comments', $claimant->comments ) }}</textarea>
                    @error('comments')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success" form="claimant-id-form">Create / Save Borrower ID</button>
                </div>

            </div>
        </div>
    </form>

   @push('scripts')
<script>
    $('#patients_relation_with_claimant').on('change', function () {
        if($(this).val() == 'Other'){
            $('#specify').attr('disabled', false);
        }
    });

    $('#are_patient_and_claimant_same').on('change', function () {
        var idCountry = this.value;
        if(idCountry == 'Yes'){

            var title            = $("#claim_id").select2().find(":selected").data("title");
            var firstname           = $("#claim_id").select2().find(":selected").data("firstname");
            var middlename          = $("#claim_id").select2().find(":selected").data("middlename");
            var lastname            = $("#claim_id").select2().find(":selected").data("lastname");
            var address            = $("#claim_id").select2().find(":selected").data("address");
            var city            = $("#claim_id").select2().find(":selected").data("city");
            var state            = $("#claim_id").select2().find(":selected").data("state");
            var pincode            = $("#claim_id").select2().find(":selected").data("pincode");
            var email            = $("#claim_id").select2().find(":selected").data("email");
            var mobile            = $("#claim_id").select2().find(":selected").data("mobile");

            $('#patients_relation_with_claimant').val('Self').trigger('change');
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

        }else{

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

</script>
@endpush