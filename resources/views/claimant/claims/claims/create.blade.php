@extends('layouts.admin')
@section('title', 'Create Claim')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claims</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.patients.index') }}">Claims</a>
                            </li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Claim ID Creation / Claim Intimation</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                        <form action="{{ route('admin.patients.update', $patient->id) }}" method="post" id="hospital-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="hospital_name">Hospital Name <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="hospital_name" name="hospital_name"
                                        data-toggle="select2" onchange="setHospitalId()">
                                        <option value="">Select Associate Partner</option>
                                        @foreach ($hospitals as $hospital)
                                            <option value="{{ $hospital->id }}"
                                                {{ old('hospital_name', $patient->hospital_id) == $hospital->id ? 'selected' : '' }}
                                                data-name="{{ $hospital->name }}" data-id="{{ $hospital->uid }}"
                                                data-address="{{ $hospital->address }}" data-city="{{ $hospital->city }}"
                                                data-state="{{ $hospital->state }}"
                                                data-pincode="{{ $hospital->pincode }}"
                                                data-ap="{{ $hospital->linked_associate_partner_id }}"
                                                data-apname="{{ $hospital->ap_name }}">
                                                {{ $hospital->name }}
                                                [<strong>UID: </strong>{{ $hospital->uid }}]
                                                [<strong>City: </strong>{{ $hospital->city }}]
                                                [<strong>State: </strong>{{ $hospital->state }}]
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hospital_name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="name">Hospital Id <span class="text-danger">*</span></label>
                                    <input type="text" readonly class="form-control" id="hospital_id" name="hospital_id"
                                        placeholder="Enter Hospital name" value="{{ old('hospital_id') }}">
                                    @error('hospital_id')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="hospital_address">Hospital Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hospital_address" name="hospital_address"
                                        placeholder="Address Line"
                                        value="{{ old('hospital_address') }}">
                                    @error('hospital_address')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="hospital_city" name="hospital_city"
                                        placeholder="City" value="{{ old('hospital_city') }}">
                                    @error('hospital_city')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="hospital_state" name="hospital_state"
                                        placeholder="State" value="{{ old('hospital_state') }}">
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
                                    <label for="associate_partner_id">Associate Partner ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="associate_partner_id"
                                        name="associate_partner_id" placeholder="Associate Partner ID"
                                        value="{{ old('associate_partner_id') }}">
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
                                        name="lastname" maxlength="30" placeholder="Last name"
                                        value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="dob">Patient DOB <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ old('dob') }}" onchange="calculateAge();">
                                        <input type="file" name="dobfile" id="dobfile" hidden
                                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="dobfile" class="btn btn-primary upload-label"><i
                                                class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('dob')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('dobfile')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="age">Patient Age <span class="text-danger">*</span></label>
                                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control"
                                        id="age" name="age" placeholder="Patient Age"
                                        value="{{ old('age') }}">
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
                                    <label for="occupation">Patient Occupation <span class="text-danger">*</span></label>
                                    <select class="form-select" id="occupation" name="occupation"
                                        onchange="setSpecify();">
                                        <option value="">Select Occupation</option>
                                        <option value="Service" {{ old('occupation') == 'Service' ? 'selected' : '' }}>
                                            Service
                                        </option>
                                        <option value="Self Employed"
                                            {{ old('occupation') == 'Self Employed' ? 'selected' : '' }}>Self Employed
                                        </option>
                                        <option value="Homemaker"
                                            {{ old('occupation') == 'Homemaker' ? 'selected' : '' }}>Homemaker
                                        </option>
                                        <option value="Student" {{ old('occupation') == 'Student' ? 'selected' : '' }}>
                                            Student
                                        </option>
                                        <option value="Retired" {{ old('occupation') == 'Retired' ? 'selected' : '' }}>
                                            Retired
                                        </option>
                                        <option value="Other" {{ old('occupation') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('occupation')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="specify">Please Specify <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="specify" name="specify"
                                        placeholder="Specify here" value="{{ old('specify') }}">
                                    @error('specify')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="patient_current_address">Patient Current Resedential Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control"
                                        id="patient_current_address" name="patient_current_address"
                                        placeholder="Address Line" value="{{ old('patient_current_address') }}">
                                    @error('patient_current_address')
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

                                <div class="col-md-12 mt-3">
                                    <label for="current_permanent_address_same">Are current and permanent address
                                        same?<span class="text-danger">*</span></label>
                                    <select class="form-select" id="current_permanent_address_same"
                                        name="current_permanent_address_same" onchange="currentPermanentAddressSame();">
                                        <option value="">Select</option>
                                        <option value="Yes"
                                            {{ old('current_permanent_address_same') == 'Yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="No"
                                            {{ old('current_permanent_address_same') == 'No' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('current_permanent_address_same')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="patient_permanent_address">Patient Permanent Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control"
                                        id="patient_permanent_address" name="patient_permanent_address"
                                        placeholder="Address Line" value="{{ old('patient_permanent_address') }}">
                                    @error('patient_permanent_address')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="patient_permanent_city"
                                        name="patient_permanent_city" placeholder="City"
                                        value="{{ old('patient_permanent_city') }}">
                                    @error('patient_permanent_city')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="text" class="form-control" id="patient_permanent_state"
                                        name="patient_permanent_state" placeholder="State"
                                        value="{{ old('patient_permanent_state') }}">
                                    @error('patient_permanent_state')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mt-2">
                                    <input type="number" class="form-control" id="patient_permanent_pincode"
                                        name="patient_permanent_pincode" pattern="/^-?\d+\.?\d*$/"
                                        onKeyPress="if(this.value.length==6) return false;" placeholder="Pincode"
                                        value="{{ old('patient_permanent_pincode') }}">
                                    @error('patient_permanent_pincode')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="id_proof">Patient ID Proof <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select" id="id_proof" name="id_proof">
                                            <option value="">Select</option>
                                            <option value="Aadhar Card"
                                                {{ old('id_proof') == 'Aadhar Card' ? 'selected' : '' }}>Aadhar Card
                                            </option>
                                            <option value="PAN Card"
                                                {{ old('id_proof') == 'PAN Card' ? 'selected' : '' }}>PAN Card
                                            </option>
                                            <option value="Voter's ID"
                                                {{ old('id_proof') == "Voter's ID" ? 'selected' : '' }}>Voter's ID
                                            </option>
                                            <option value="Driving Licence"
                                                {{ old('id_proof') == 'Driving Licence' ? 'selected' : '' }}>Driving
                                                Licence
                                            </option>
                                            <option value="Passport"
                                                {{ old('id_proof') == 'Passport' ? 'selected' : '' }}>Passport
                                            </option>
                                        </select>
                                        <input type="file" name="id_proof_file" id="upload" hidden
                                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                        <label for="upload" class="btn btn-primary upload-label"><i
                                                class="mdi mdi-upload"></i></label>
                                    </div>
                                    @error('id_proof')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('id_proof_file')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="email">Patient email ID <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email"
                                        name="email" maxlength="30" placeholder="Enter Patient email ID"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="phone">Patient Mobile Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="phone">+91</label>
                                        <input type="text" maxlength="10" onkeypress="return isNumberKey(event)"
                                            class="form-control" id="phone" name="phone"
                                            placeholder="Enter Patient mobile number" value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="landline">Patient Landline Number <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="col-3">
                                            <input type="number" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length>=3) return false;"
                                                class="form-control input-md" id="code" name="code"
                                                placeholder="Code" value="{{ old('code') }}">
                                        </div>
                                        <div class="col-9">
                                            <input type="text" maxlength="10" onkeypress="return isNumberKey(event)"
                                                class="form-control" id="landline" name="landline"
                                                placeholder="Enter Patient landline number"
                                                value="{{ old('landline') }}">
                                        </div>
                                    </div>
                                    @error('code')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @error('landline')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="referred_by">Patient Referred By* <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="referred_by" name="referred_by"
                                        onchange="setReferral();">
                                        <option value="">Select</option>
                                        <option value="BHC Direct"
                                            {{ old('referred_by') == 'BHC Direct' ? 'selected' : '' }}>
                                            BHC Direct
                                        </option>
                                        <option value="Hospital's Direct Patient"
                                            {{ old('referred_by') == "Hospital's Direct Patient" ? 'selected' : '' }}>
                                            Hospital's Direct Patient
                                        </option>
                                        <option value="Associate Partner"
                                            {{ old('referred_by') == 'Associate Partner' ? 'selected' : '' }}>Associate
                                            Partner
                                        </option>
                                        <option value="Other" {{ old('referred_by') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('referred_by')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="referral_name">Referral Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="referral_name" name="referral_name"
                                        maxlength="45" placeholder="Referral Name" value="{{ old('referral_name') }}">
                                    @error('referral_name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="admitted_by">Patient Admitted By* <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="admitted_by" name="admitted_by"
                                        onchange="setNameField();">
                                        <option value="">Select</option>

                                        <option value="Self" {{ old('admitted_by') == 'Self' ? 'selected' : '' }}>
                                            Self
                                        </option>
                                        <option value="Spouse" {{ old('admitted_by') == 'Spouse' ? 'selected' : '' }}>
                                            Spouse
                                        </option>
                                        <option value="Child" {{ old('admitted_by') == 'Child' ? 'selected' : '' }}>
                                            Child
                                        </option>
                                        <option value="Father" {{ old('admitted_by') == 'Father' ? 'selected' : '' }}>
                                            Father
                                        </option>
                                        <option value="Mother" {{ old('admitted_by') == 'Mother' ? 'selected' : '' }}>
                                            Mother
                                        </option>
                                        <option value="Friend" {{ old('admitted_by') == 'Friend' ? 'selected' : '' }}>
                                            Friend
                                        </option>
                                        <option value="Other" {{ old('admitted_by') == 'Other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('admitted_by')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="admitted_by_firstname">Name <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-3 mt-1">
                                    <select class="form-control" id="admitted_by_title" name="admitted_by_title">
                                        <option value="">Select</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Ms.">Ms.</option>
                                    </select>
                                    @error('admitted_by_title')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" maxlength="25" class="form-control" id="admitted_by_firstname"
                                        name="admitted_by_firstname" maxlength="15" placeholder="First name"
                                        value="{{ old('admitted_by_firstname') }}">
                                    @error('admitted_by_firstname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" maxlength="25" class="form-control"
                                        id="admitted_by_middlename" name="admitted_by_middlename" maxlength="30"
                                        placeholder="Middle name" value="{{ old('admitted_by_middlename') }}">
                                    @error('admitted_by_middlename')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mt-1">
                                    <input type="text" maxlength="25" class="form-control" id="admitted_by_lastname"
                                        name="admitted_by_lastname" maxlength="30" placeholder="Last name"
                                        value="{{ old('admitted_by_lastname') }}">
                                    @error('admitted_by_lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="comments">Patient Comments </label>
                                    <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments"
                                        rows="5">{{ old('comments') }}</textarea>
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
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            setHospitalId();
            setSpecify();
            currentPermanentAddressSame();
            setNameField();
            setReferral();
        });

        function setHospitalId() {
            var uid = $("#hospital_name").select2().find(":selected").data("id");
            var address = $("#hospital_name").select2().find(":selected").data("address");
            var city = $("#hospital_name").select2().find(":selected").data("city");
            var state = $("#hospital_name").select2().find(":selected").data("state");
            var pincode = $("#hospital_name").select2().find(":selected").data("pincode");
            var associate_partner_id = $("#hospital_name").select2().find(":selected").data("ap");
            console.log(address);
            $('#hospital_id').val(uid);
            $('#hospital_address').val(address);
            $('#hospital_city').val(city);
            $('#hospital_state').val(state);
            $('#hospital_pincode').val(pincode);
            $('#hospital_pincode').val(pincode);
            $('#associate_partner_id').val(associate_partner_id);
        }
    </script>
    <script>
        function calculateAge() {
            var dob = $('#dob').val();
            dob = new Date(dob);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').val(age);
        }
    </script>
    <script>
        function setSpecify() {
            var occupation = $('#occupation').val();
            switch (occupation) {
                case 'Other':
                    $("#specify").prop("readonly", false);
                    break;

                default:
                    $("#specify").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function currentPermanentAddressSame() {
            var current_permanent_address_same = $('#current_permanent_address_same').val();
            switch (current_permanent_address_same) {
                case 'Yes':
                    $("#patient_permanent_address").prop("readonly", true);
                    $("#patient_permanent_city").prop("readonly", true);
                    $("#patient_permanent_state").prop("readonly", true);
                    $("#patient_permanent_pincode").prop("readonly", true);
                    break;

                default:
                    $("#patient_permanent_address").prop("readonly", false);
                    $("#patient_permanent_city").prop("readonly", false);
                    $("#patient_permanent_state").prop("readonly", false);
                    $("#patient_permanent_pincode").prop("readonly", false);
                    break;
            }
        }
    </script>
    <script>
        function setNameField() {
            var admitted_by = $('#admitted_by').val();
            switch (admitted_by) {
                case 'Self':
                    $("#admitted_by_title").prop("disabled", true);
                    $("#admitted_by_firstname").prop("readonly", true);
                    $("#admitted_by_lastname").prop("readonly", true);
                    $("#admitted_by_middlename").prop("readonly", true);
                    break;

                default:
                    $("#admitted_by_title").prop("disabled", false);
                    $("#admitted_by_firstname").prop("readonly", false);
                    $("#admitted_by_lastname").prop("readonly", false);
                    $("#admitted_by_middlename").prop("readonly", false);
                    break;
            }
        }
    </script>
    <script>
        function setReferral() {
            var referred_by = $('#referred_by').val();
            if(referred_by == "BHC Direct"){
                $("input[name='referral_name']").val('BHC');
            }else if(referred_by == "Hospital's Direct Patient"){
                var hospital = $("#hospital_name").select2().find(":selected").data("name");
                        $("input[name='referral_name']").val(hospital);
            }else if(referred_by == "Associate Partner"){
                var apname = $("#hospital_name").select2().find(":selected").data("apname");
                        $("input[name='referral_name']").val(apname);
            }else{
                $("input[name='referral_name']").val('');
            }
        }
    </script>
@endpush
