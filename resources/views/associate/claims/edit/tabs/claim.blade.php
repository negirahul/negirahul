<div class="form-group row">
    <div class="col-12">
        <div class="card no-shadow">
            <div class="card-body">
                <form action="{{ route('associate-partner.patients.store') }}" method="post" id="hospital-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="firstname">Patient Name <span class="text-danger">*</span></label>
                        </div>

                        <div class="col-md-6 mt-1">
                            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="15"
                                placeholder="Firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-1">
                            <input type="text" class="form-control" id="lastname" name="lastname" maxlength="30"
                                placeholder="Lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-4 mt-3">
                            <label for="patient_id">Patient ID <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="patient_id" name="patient_id"
                                placeholder="Enter Patient ID "
                                value="{{ old('patient_id') }}">
                            @error('patient_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="dob">Patient DOB <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                placeholder="Associate partner agreement end date"
                                value="{{ old('dob') }}">
                            @error('dob')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="gender">Patient Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('gender')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="patient_address">Patient Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="patient_address" name="patient_address"
                                placeholder="Address Line" value="{{ old('patient_address') }}">
                            @error('patient_address')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="text" class="form-control" id="patient_city" name="patient_city"
                                placeholder="City" value="{{ old('patient_city') }}">
                            @error('patient_city')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="text" class="form-control" id="patient_state" name="patient_state"
                                placeholder="State" value="{{ old('patient_state') }}">
                            @error('patient_state')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="number" class="form-control" id="patient_pincode" name="patient_pincode" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"
                                placeholder="Pincode" value="{{ old('patient_pincode') }}">
                            @error('patient_pincode')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 mt-3">
                            <label for="patient_id_proof">Patient ID Proof <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="patient_id_proof" name="patient_id_proof"
                                    placeholder="Enter Patient ID Proof no." value="{{ old('patient_id_proof') }}">
                                    <input type="file" name="patient_id_proof_file" id="upload" hidden />
                                    <label for="upload" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                            </div>
                            @error('pan')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                            @error('panfile')
                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="name">Hospital Id <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="hospital_id" name="hospital_id"
                                placeholder="Enter Hospital name" value="{{ old('hospital_id', $hospital_id) }}">
                            @error('hospital_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>                                

                        <div class="col-md-6 mt-3">
                            <label for="name">Hospital Name <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="hospital_name" name="hospital_name"
                                placeholder="Enter Hospital name" value="{{ old('hospital_name', $hospital->name) }}">
                            @error('hospital_name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="by">Associate Partner ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="associate_partner_id" name="associate_partner_id"
                                placeholder="Associate Partner ID" value="{{ old('associate_partner_id') }}">
                            @error('associate_partner_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="hospital_address">Hospital Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="hospital_address" name="hospital_address"
                                placeholder="Address Line" value="{{ old('hospital_address', $hospital->address) }}">
                            @error('hospital_address')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="text" class="form-control" id="hospital_city" name="hospital_city"
                                placeholder="City" value="{{ old('hospital_city' ,$hospital->city)}}">
                            @error('hospital_city')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="text" class="form-control" id="hospital_state" name="hospital_state"
                                placeholder="State" value="{{ old('hospital_state', $hospital->state)}}">
                            @error('hospital_state')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-2">
                            <input type="number" class="form-control" id="hospital_pincode" name="hospital_pincode"
                                placeholder="Pincode" value="{{ old('hospital_pincode', $hospital->pincode) }}">
                            @error('hospital_pincode')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="owner">Patient email ID <span class="text-danger">*</span></label>
                            <input type="patient_email" class="form-control" id="patient_email" name="patient_email" maxlength="30"
                                placeholder="Enter hospital patient_email ID" value="{{ old('patient_email') }}">
                            @error('patient_email')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="patient_mobile">Patient Mobile Number <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="patient_mobile" name="patient_mobile"
                                placeholder="Enter hospital patient_mobile number" value="{{ old('patient_mobile') }}">
                            @error('patient_mobile')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="referred_by">Patient Referred By* <span class="text-danger">*</span></label>
                            <select class="form-select" id="referred_by" name="referred_by">
                                <option value="">Select Patient Referred By*</option>
                                <option value="Direct" {{ old('referred_by') == 'Direct' ? 'selected' : '' }}>Direct
                                </option>
                                <option value="Hospital"
                                    {{ old('referred_by') == 'Hospital' ? 'selected' : '' }}>Hospital
                                </option>
                                <option value="Associate Partner"
                                    {{ old('referred_by') == 'Associate Partner' ? 'selected' : '' }}>Associate Partner
                                </option>
                            </select>
                            @error('referred_by')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="patient_comments">Patient Comments </label>
                            <textarea class="form-control" id="patient_comments" name="patient_comments" maxlength="250" placeholder="Comments" rows="1">{{ old('patient_comments') }}</textarea>
                            @error('patient_comments')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="abha_id">ABHA ID <span class="text-danger">*</span></label>
                            <input type="text" readonly class="form-control" id="hospital_id" name="abha_id"
                                placeholder="Enter ABHA ID" value="{{ old('abha_id') }}">
                            @error('abha_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>    

                        <div class="col-md-6 mt-3">
                            <label for="probable_date_of_admission">Probable Date of Admission</label>
                            <input class="form-control" value="{{ old('probable_date_of_admission') }}" id="probable_date_of_admission" name="probable_date_of_admission"  placeholder="Probable Date of Admission"></input>
                            @error('probable_date_of_admission')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="probable_date_of_discharge">Probable Date of Discharge </label>
                            <input class="form-control" {{ old('probable_date_of_discharge') }} id="probable_date_of_discharge" name="probable_date_of_discharge"  placeholder="Probable Date of Discharge"></input>
                            @error('probable_date_of_discharge')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>                                 

                        <div class="col-md-6 mt-3">
                            <label for="lending_required">Lending Required<span class="text-danger">*</span></label>
                            <select class="form-select" id="lending_required" name="lending_required">
                                <option value="">Select lending_required</option>
                                <option value="Male" {{ old('lending_required') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('lending_required') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('lending_required')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="treatment_type">Treatment Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="treatment_type" name="treatment_type">
                                <option value="">Select</option>
                                <option value="Male" {{ old('treatment_type') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('treatment_type') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('treatment_type')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="admission_type">Admission Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="admission_type" name="admission_type">
                                <option value="">Select Admission Type</option>
                                <option value="Male" {{ old('admission_type') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('admission_type') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('admission_type')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="claim_category">Claim Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="claim_category" name="claim_category">
                                <option value="">Select Claim Category</option>
                                <option value="Male" {{ old('claim_category') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('claim_category') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('claim_category')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="treatment_category">Treatment Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="treatment_category" name="treatment_category">
                                <option value="">Select Treatment Category</option>
                                <option value="Male" {{ old('treatment_category') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('treatment_category') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('treatment_category')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="disease_category">Disease Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="disease_category" name="disease_category">
                                <option value="">Select Disease Category</option>
                                <option value="Male" {{ old('disease_category') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('disease_category') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('disease_category')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="disease_type">Disease Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="disease_type" name="disease_type">
                                <option value="">Select Disease Type</option>
                                <option value="Male" {{ old('disease_type') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('disease_type') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            @error('disease_type')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="disease_name">Disease Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="disease_name"
                                name="disease_name" placeholder="Enter Disease Name"
                                value="{{ old('disease_name') }}">
                            @error('disease_name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="intimation_comments">Intimation Comments </label>
                            <textarea class="form-control" id="intimation_comments" name="intimation_comments" maxlength="250" placeholder="Comments" rows="4">{{ old('intimation_comments') }}</textarea>
                            @error('intimation_comments')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 text-end mt-3">
                            <button type="submit" class="btn btn-success" form="hospital-form">Create
                                Claim ID</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>