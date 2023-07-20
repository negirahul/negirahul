<form action="{{ route('hospital.hospitals.update', $hospital->id) }}" method="post" id="hospital-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">

        <div class="col-md-12 mt-3">
            <label for="uid">Hospital UID </label>
            <input type="text" readonly maxlength="60" class="form-control" id="uid" name="uid"
                placeholder="Enter Hospital UID" value="{{ old('uid', $hospital->uid) }}">
            @error('uid')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="name">Hospital Name <span class="text-danger">*</span></label>
            <input type="text" readonly maxlength="60" class="form-control" id="name" name="name"
                placeholder="Enter Hospital name" value="{{ old('name', $hospital->name) }}">
            @error('name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="onboarding">Hospital Onboarding <span class="text-danger">*</span></label>
            <select class="form-select" id="onboarding" name="onboarding">
                <option value="">Select onboarding</option>
                <option value="Tie Up" {{ old('onboarding', $hospital->onboarding) == 'Tie Up' ? 'selected' : 'disabled' }}>Tie Up
                </option>
                <option value="Non - Tie Up"
                    {{ old('onboarding', $hospital->onboarding) == 'Non - Tie Up' ? 'selected' : 'disabled' }}>Non - Tie Up
                </option>
            </select>
            @error('onboarding')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="by">Hospital By <span class="text-danger">*</span></label>
            <select class="form-select" id="by" name="by">
                <option value="">Select by</option>
                <option value="Direct" {{ old('by', $hospital->by) == 'Direct' ? 'selected' : 'disabled' }}>Direct
                </option>
                <option value="Associate Partner"
                    {{ old('by', $hospital->by) == 'Associate Partner' ? 'selected' : 'disabled' }}>Associate Partner
                </option>
            </select>
            @error('by')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="address">Hospital Address <span class="text-danger">*</span></label>
            <input type="text" readonly class="form-control" id="address" name="address"
                placeholder="Address Line" value="{{ old('address', $hospital->address) }}">
            @error('address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 mt-2">
            <input type="text" readonly class="form-control" id="city" name="city"
                placeholder="City" value="{{ old('city', $hospital->city) }}">
            @error('city')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="text" readonly class="form-control" id="state" name="state"
                placeholder="State" value="{{ old('state', $hospital->state) }}">
            @error('state')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="number" readonly class="form-control" id="pincode" name="pincode" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"
                placeholder="Pincode" value="{{ old('pincode', $hospital->pincode) }}">
            @error('pincode')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <label for="firstname">Hospital Owner's Name <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <input type="text" readonly maxlength="15" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="firstname" name="firstname" maxlength="15"
                placeholder="Firstname" value="{{ old('firstname', $hospital->firstname) }}">
            @error('firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1">
            <input type="text" readonly maxlength="30" class="form-control" id="lastname" name="lastname" maxlength="30" onkeydown="return /[a-z, ]/i.test(event.key)"
                placeholder="Lastname" value="{{ old('lastname', $hospital->lastname) }}">
            @error('lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="pan">Hospital PAN Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" readonly maxlength="10" class="form-control" id="pan" name="pan" maxlength="10"
                    placeholder="Enter Hospital PAN no." value="{{ old('pan', $hospital->pan) }}">
         
            </div>
            @error('pan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner">Hospital email ID <span class="text-danger">*</span></label>
            <input type="email" readonly maxlength="45" required class="form-control" id="email" name="email" maxlength="30"
                placeholder="Enter hospital email ID" value="{{ old('email', $hospital->email) }}">
            @error('email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="landline">Hospital Landline Number <span
                class="text-danger">*</span></label>
                <div class="input-group">
                    <div class="col-3">
                        <input type="text" maxlength="3" readonly onkeypress="return isNumberKey(event)" class="form-control input-md" id="code" name="code"
                        placeholder="Code" value="{{ old('code', $hospital->code) }}">
                    </div>
                    <div class="col-9">
                        <input type="text" readonly maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" id="landline" name="landline"
                        placeholder="Enter hospital landline number" value="{{ old('landline', $hospital->landline) }}">
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
            <label for="phone">Hospital Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="text" maxlength="10" readonly onkeypress="return isNumberKey(event)" class="form-control" id="phone" name="phone"  placeholder="Enter hospital mobile number" value="{{ old('phone', $hospital->phone) }}">
            </div>
            @error('phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="rohini">Rohini Code <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="13" readonly class="form-control" id="rohini" name="rohini"
                    placeholder="Enter rohini code." value="{{ old('rohini', $hospital->rohini) }}">
            </div>
            @error('rohini')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="linked_associate_partner">Associate Partner Company Name <span
                class="text-danger">*</span></label>
                <select class="form-control select2" id="linked_associate_partner" name="linked_associate_partner"
                data-toggle="select2" onchange="setLinkedAssociatePartnerId()">
                <option value="">Select Associate Partner</option>
                @foreach ($associates as $associate)
                <option value="{{ $associate->id }}"
                    {{ old('linked_associate_partner', $hospital->linked_associate_partner) == $associate->name ? 'selected' : '' }}
                    data-id="{{ $associate->associate_partner_id }}">
                    [<strong>Name: </strong>{{ $associate->name }}]
                    [<strong>City: </strong>{{ $associate->city }}]
                    [<strong>State: </strong>{{ $associate->state }}]</option>
                    @endforeach
                </select>
                @error('linked_associate_partner')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <input type="hidden" id="linked_associate_partner_data" value="{{ old('linked_associate_partner', $hospital->linked_associate_partner) }}" name="linked_associate_partner">

            <div class="col-md-6 mt-3">
                <label for="linked_associate_partner_id">Associate Partner ID <span
                    class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="linked_associate_partner_id"
                    name="linked_associate_partner_id" placeholder="Enter Associate Partner Id"
                    value="{{ old('linked_associate_partner_id', $hospital->linked_associate_partner_id) }}">
                    @error('linked_associate_partner_id')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>



                {{-- <div class="col-md-12 mt-3">
            <label for="assigned_employee_department">Assigned To Employee Department <span class="text-danger">*</span></label>
            <select class="form-select" id="assigned_employee_department" name="assigned_employee_department"
                onchange="loadAssignedEmployees()">
                <option value="">Select Department</option>
                <option value="Operations"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Operations' ? 'selected' : '' }}>Operations
                </option>
                <option value="Sales" {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Sales' ? 'selected' : '' }}>Sales
                </option>
                <option value="Accounts" {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Accounts' ? 'selected' : '' }}>
                    Accounts
                </option>
                <option value="Analytics & MIS"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Analytics & MIS' ? 'selected' : '' }}>Analytics & MIS
                </option>
                <option value="IT" {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'IT' ? 'selected' : '' }}>IT
                </option>
                <option value="Product Management"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Product Management' ? 'selected' : '' }}>Product
                    Management
                </option>
                <option value="Provider management"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Provider management' ? 'selected' : '' }}>Provider
                    management
                </option>
                <option value="Insurance"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Insurance' ? 'selected' : '' }}>Insurance
                </option>
                <option value="Claims Processing"
                    {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Claims Processing' ? 'selected' : '' }}>Claims
                    Processing
                </option>
                <option value="Cashless" {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Cashless' ? 'selected' : '' }}>
                    Cashless
                </option>
                <option value="Lending" {{ old('assigned_employee_department', $hospital->assigned_employee_department) == 'Lending' ? 'selected' : '' }}>
                    Lending
                </option>
            </select>
            @error('assigned_employee_department')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        {{-- <div class="col-md-6 mt-3">
            <label for="assigned_employee">Assigned To Employee Name <span class="text-danger">*</span></label>
            <select class="form-control select2" id="assigned_employee" name="assigned_employee"
                data-toggle="select2" onchange="setAssignedEmployeeId()">
                <option value="">Select Assigned To Employee</option>

            </select>
            @error('assigned_employee')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="assigned_employee_id">Assigned To Employee ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="assigned_employee_id" name="assigned_employee_id"
                placeholder="Enter assigned to employee ID"
                value="{{ old('assigned_employee_id', $hospital->assigned_employee_id) }}">
            @error('assigned_employee_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="linked_employee_department">Linked With Employee Department <span class="text-danger">*</span></label>
            <select class="form-select" id="linked_employee_department" name="linked_employee_department"
                onchange="loadLinkedEmployees()">
                <option value="">Select Department</option>
                <option value="Operations"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Operations' ? 'selected' : '' }}>Operations
                </option>
                <option value="Sales" {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Sales' ? 'selected' : '' }}>Sales
                </option>
                <option value="Accounts" {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Accounts' ? 'selected' : '' }}>
                    Accounts
                </option>
                <option value="Analytics & MIS"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Analytics & MIS' ? 'selected' : '' }}>Analytics & MIS
                </option>
                <option value="IT" {{ old('linked_employee_department', $hospital->linked_employee_department) == 'IT' ? 'selected' : '' }}>IT
                </option>
                <option value="Product Management"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Product Management' ? 'selected' : '' }}>Product
                    Management
                </option>
                <option value="Provider management"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Provider management' ? 'selected' : '' }}>Provider
                    management
                </option>
                <option value="Insurance"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Insurance' ? 'selected' : '' }}>Insurance
                </option>
                <option value="Claims Processing"
                    {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Claims Processing' ? 'selected' : '' }}>Claims
                    Processing
                </option>
                <option value="Cashless" {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Cashless' ? 'selected' : '' }}>
                    Cashless
                </option>
                <option value="Lending" {{ old('linked_employee_department', $hospital->linked_employee_department) == 'Lending' ? 'selected' : '' }}>
                    Lending
                </option>
            </select>
            @error('linked_employee_department')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="linked_employee">Linked With Employee Name <span class="text-danger">*</span></label>
            <select class="form-control select2" id="linked_employee" name="linked_employee" data-toggle="select2"
                onchange="setLinkedWithEmployeeId()">
                <option value="">Select Linked With Employee</option>

            </select>
            @error('linked_employee')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="linked_employee_id">Linked With Employee ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="linked_employee_id" name="linked_employee_id"
                placeholder="Enter linked with employee ID"
                value="{{ old('linked_employee_id', $hospital->linked_employee_id) }}">
            @error('linked_employee_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}



        <div class="col-md-6 mt-3">
            <label for="tan">Hospital Tan Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="10" class="form-control" id="tan" name="tan"
                    placeholder="Enter Hospital Tan no." value="{{ old('tan', $hospital->tan) }}">
            </div>
            @error('tan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="gst">Hospital Gst Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="15" class="form-control" id="gst" name="gst"
                    placeholder="Enter Hospital Gst no." value="{{ old('gst', $hospital->gst) }}">
            </div>
            @error('gst')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner">Hospital Owner Email ID <span class="text-danger">*</span></label>
            <input type="email" maxlength="45" class="form-control" id="owner_email" name="owner_email"
                placeholder="Enter hospital Owner Email ID" value="{{ old('owner_email', $hospital->owner_email) }}">
            @error('owner_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner_phone">Hospital Owner Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="text" maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" id="owner_phone" name="owner_phone" placeholder="Enter hospital Owner mobile number" value="{{ old('owner_phone', $hospital->owner_phone) }}">
            </div>
            @error('owner_phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner_pan">Hospital Owner's PAN Number <span class="text-danger">*</span></label>
                <input type="text" maxlength="10" class="form-control" id="owner_pan" name="owner_pan" maxlength="10"
                    placeholder="Enter Hospital Owner's PAN no." value="{{ old('owner_pan', $hospital->owner_pan) }}">            
            @error('owner_pan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner_aadhar">Hospital Owner's Aadhar Number <span class="text-danger">*</span></label>
                <input type="text" maxlength="12" class="form-control" id="owner_aadhar" name="owner_aadhar" maxlength="10"
                    placeholder="Enter Hospital Owner's Aadhar no." value="{{ old('owner_aadhar', $hospital->owner_aadhar) }}">            
            @error('owner_aadhar')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="contact_person_firstname">Contact Person Name <span class="text-danger">*</span></label>
            <div class="input-group">
            <input type="text" maxlength="15" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="contact_person_firstname" name="contact_person_firstname"
                placeholder="Firstname" value="{{ old('contact_person_firstname', $hospital->contact_person_firstname) }}">
            <input type="text" style="margin-left:10px;" maxlength="30" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="contact_person_lastname" name="contact_person_lastname"
                placeholder="Lastname" value="{{ old('contact_person_lastname', $hospital->contact_person_lastname) }}">

            </div>
            @error('contact_person_firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror

            @error('contact_person_lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="contact_person_email">Contact Person Email ID <span class="text-danger">*</span></label>
            <input type="email" maxlength="45" class="form-control" id="contact_person_email" name="contact_person_email"
                placeholder="Enter hospital Owner Email ID" value="{{ old('contact_person_email', $hospital->contact_person_email) }}">
            @error('contact_person_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="contact_person_phone">Contact Person Mobile Number <span class="text-danger">*</span></label>
                <div class="input-group">
                    <label class="input-group-text" for="phone">+91</label>
                    <input type="text" maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" id="contact_person_phone" name="contact_person_phone"  placeholder="Enter hospital Owner mobile number" value="{{ old('contact_person_phone', $hospital->contact_person_phone) }}">
                </div>
            @error('contact_person_phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="registration_no">Registration Number <span
                    class="text-danger">*</span></label>
            <input type="text" onKeyPress="if(this.value.length==20) return false;" class="form-control" id="registration_no" name="registration_no"
                placeholder="Enter Registration Number" value="{{ old('registration_no', $hospital->registration_no) }}">
            @error('registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_firstname">Medical Superintendent Name <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="15" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="medical_superintendent_firstname" name="medical_superintendent_firstname"
                placeholder="Firstname" value="{{ old('medical_superintendent_firstname', $hospital->medical_superintendent_firstname) }}">


                <input type="text" style="margin-left:10px;" maxlength="30" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="medical_superintendent_lastname" name="medical_superintendent_lastname"
                placeholder="Lastname" value="{{ old('medical_superintendent_lastname', $hospital->medical_superintendent_lastname) }}">
            </div>
            @error('medical_superintendent_firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('medical_superintendent_lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_email">Medical Superintendent Email ID <span class="text-danger">*</span></label>
            <input type="email" maxlength="45" class="form-control" id="medical_superintendent_email" name="medical_superintendent_email"
                placeholder="Enter Medical Superintendent Email ID" value="{{ old('medical_superintendent_email', $hospital->medical_superintendent_email) }}">
            @error('medical_superintendent_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_mobile">Medical Superintendent Mobile Number <span  class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="text" maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" id="medical_superintendent_mobile" name="medical_superintendent_mobile" placeholder="Enter Medical Superintendent Mobile Number" value="{{ old('medical_superintendent_mobile', $hospital->medical_superintendent_mobile) }}">
            </div>
            @error('medical_superintendent_mobile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_registration_no">Medical Superintendent Registration No <span
                    class="text-danger">*</span></label>
            <input type="text" maxlength="20" class="form-control" id="medical_superintendent_registration_no" name="medical_superintendent_registration_no"
                placeholder="Enter Medical Superintendent Registration No" value="{{ old('medical_superintendent_registration_no', $hospital->medical_superintendent_registration_no) }}">
            @error('medical_superintendent_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_qualification">Medical Superintendent Qualification <span class="text-danger">*</span></label>
            <input type="text" maxlength="30" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="medical_superintendent_qualification" name="medical_superintendent_qualification"
                placeholder="Enter Medical Superintendent Qualification" value="{{ old('medical_superintendent_qualification', $hospital->medical_superintendent_qualification) }}">
            @error('medical_superintendent_qualification')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="pollution_clearance_certificate">Hospital Pollution Clearance Certificate <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="pollution_clearance_certificate" name="pollution_clearance_certificate">
                <option value="">Select pollution clearance certificate</option>
                <option value="Yes" {{ old('pollution_clearance_certificate', $hospital->pollution_clearance_certificate) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('pollution_clearance_certificate', $hospital->pollution_clearance_certificate) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
          
            </div>
            @error('pollution_clearance_certificate')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="fire_safety_clearance_certificate">Hospital Fire Safety Clearance Certificate <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="fire_safety_clearance_certificate" name="fire_safety_clearance_certificate">
                <option value="">Select Fire Safety Clearance Certificate</option>
                <option value="Yes" {{ old('fire_safety_clearance_certificate', $hospital->fire_safety_clearance_certificate) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('fire_safety_clearance_certificate', $hospital->fire_safety_clearance_certificate) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            </div>
            @error('fire_safety_clearance_certificate')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="certificate_of_incorporation">Hospital Certificate Of Incorporation <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="certificate_of_incorporation" name="certificate_of_incorporation">
                <option value="">Select Certificate Of Incorporation</option>
                <option value="Yes" {{ old('certificate_of_incorporation', $hospital->certificate_of_incorporation) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('certificate_of_incorporation', $hospital->certificate_of_incorporation) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            </div>
            @error('certificate_of_incorporation')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        
        </div>


        <div class="col-md-12 mt-3">
            <label for="address">Hospital Bank Details <span class="text-danger">*</span></label>
        </div>
        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="bank_name" name="bank_name" maxlength="45"
                placeholder="Bank Name" value="{{ old('bank_name', $hospital->bank_name) }}">
            @error('bank_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="bank_address" name="bank_address" maxlength="80"
                placeholder="Bank Address" value="{{ old('bank_address', $hospital->bank_address) }}">
            @error('bank_address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <div class="input-group">
                <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                    <option value="">Cancel Cheque</option>
                    <option value="Yes" {{ old('cancel_cheque', $hospital->cancel_cheque) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('cancel_cheque', $hospital->cancel_cheque) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>

            </div>

            @error('cancel_cheque')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" maxlength="20"
                placeholder="Bank Account No." value="{{ old('bank_account_no', $hospital->bank_account_no) }}">
            @error('bank_account_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <input type="text" class="form-control" id="bank_ifs_code" name="bank_ifs_code" maxlength="11"
                placeholder="Bank Ifs Code" value="{{ old('bank_ifs_code', $hospital->bank_ifs_code) }}">
            @error('bank_ifs_code')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-2">
            <label for="certificate_of_incorporation">Hospital Tariff List / SOC (Printed)* (if yes upload) <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="tariff_list_soc" name="tariff_list_soc">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('tariff_list_soc', $hospital->tariff_list_soc) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('tariff_list_soc', $hospital->tariff_list_soc) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            </div>
            @error('tariff_list_soc')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        
        </div>

        <div class="col-md-6 mt-3">
            <label for="nabh_registration_no">Hospital NABH Registration No. <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="15" class="form-control" id="nabh_registration_no" name="nabh_registration_no"
                    placeholder="Hospital NABH Registration No." value="{{ old('nabh_registration_no', $hospital->nabh_registration_no) }}">
         
            </div>
            @error('nabh_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
           
        </div>


        <div class="col-md-6 mt-3">
            <label for="nabl_registration_no">Hospital NABL Registration No. <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" maxlength="15" class="form-control" id="nabl_registration_no" name="nabl_registration_no"
                    placeholder="Hospital NABL Registration No." value="{{ old('nabl_registration_no', $hospital->nabl_registration_no) }}">
          
            </div>
            @error('nabl_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
         
        </div>


        <div class="col-md-6 mt-2">
            <label for="certificate_of_incorporation">Hospital Signed MOUs with BHC*  (if yes upload) <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="signed_mous" name="signed_mous">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('signed_mous', $hospital->signed_mous) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('signed_mous', $hospital->signed_mous) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
     
            </div>
            @error('signed_mous')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="other_documents">Hospital Other Documents <span class="text-danger">*</span></label>
            <div class="input-group">

                <select class="form-select" id="other_documents" name="other_documents">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('other_documents', $hospital->other_documents) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('other_documents', $hospital->other_documents) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
        
            </div>
            @error('other_documents')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        
        </div>


         <div class="col-md-6 mt-3">
            <label for="hrms_software">HRMS Software <span class="text-danger">*</span></label>
                <select class="form-select" id="hrms_software" name="hrms_software">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('hrms_software', $hospital->hrms_software) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('hrms_software', $hospital->hrms_software) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('hrms_software')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-12 mt-2">
            <label for="iso_status">ISO Status <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="iso_status" name="iso_status">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('iso_status', $hospital->iso_status) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('iso_status', $hospital->iso_status) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
     
            </div>
            @error('iso_status')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
         
        </div>

        <div class="col-md-12 mt-3">
            <label for="comments">Comments </label>
            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments" rows="4">{{ old('comments', $hospital->comments) }}</textarea>
            @error('comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="hospital-form">Update
                Hospital ID</button>
        </div>
    </div>
</form>

@push('scripts')

 <script>
        function setLinkedAssociatePartnerId() {
            var linked_associate_partner = $("#linked_associate_partner").select2().find(":selected").data("id");
            var linked_associate_partner_data = $("#linked_associate_partner").select2().find(":selected").val();
            $('#linked_associate_partner_id').val(linked_associate_partner);
            $('#linked_associate_partner_data').val(linked_associate_partner_data);
        }

        function setAssignedEmployeeId() {
            var assigned_employee = $("#assigned_employee").select2().find(":selected").data("id");
            $('#assigned_employee_id').val(assigned_employee);
        }

        function setLinkedWithEmployeeId() {
            var linked_employee = $("#linked_employee").select2().find(":selected").data("id");
            $('#linked_employee_id').val(linked_employee);
        }

        var byI = "{{ old('by') }}";

        if(byI == 'Direct'){
            $("#linked_associate_partner").attr('disabled',true);
            $("#linked_associate_partner_id").attr('disabled',true);
        }

        $('#by').on('change', function(){
            if($(this).val() == 'Direct'){
                $("#linked_associate_partner").attr('disabled',true);
                $("#linked_associate_partner_id").attr('disabled',true);
            }else{
                $("#linked_associate_partner").attr('disabled',false);
                $("#linked_associate_partner_id").attr('disabled',false);
            }
        });

    </script>

<script>

    var field = "{{ old('cancel_cheque', $hospital->cancel_cheque ?? '')  }}";

    var field_ref = "{{ old('tariff_list_soc', $hospital->tariff_list_soc ?? '')  }}";

    var field_agrr = "{{ old('nabh_registration', $hospital->nabh_registration ?? '')  }}";

    var field_hms = "{{ old('nabl_registration', $hospital->nabl_registration ?? '')  }}";

    var field_hms1 = "{{ old('signed_mous', $hospital->signed_mous ?? '')  }}";

    var field_hms2 = "{{ old('other_documents', $hospital->other_documents ?? '')  }}";

    var field_hms3 = "{{ old('iso_status', $hospital->iso_status ?? '')  }}";

    if( field === 'No'){
        $("#cancel_cheque_file").attr("disabled", 'disabled');
    }

    if( field_ref === 'No'){
        $("#tariff_list_soc_file").attr("disabled", 'disabled');
    }

    if( field_agrr  === 'No'){
        $("#nabh_registration_file").attr("disabled", 'disabled');
    }

    if( field_hms === 'No'){
        $("#nabl_registration_file").attr("disabled", 'disabled');
    }

    if( field_hms1 === 'No'){
        $("#signed_mous_file").attr("disabled", 'disabled');
    }

    if( field_hms2 === 'No'){
        $("#other_documents_file").attr("disabled", 'disabled');
    }

    if( field_hms3 === 'No'){
        $("#iso_status_file").attr("disabled", 'disabled');
    }
</script>

    <script>
        function loadLinkedEmployees() {
            var department = $("#linked_employee_department").val();
            if (!department) {
                department = 'Operations'
            }
            var url = '{{ route('super-admin.get.employees', ':department') }}';
            url = url.replace(':department', department);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#linked_employee').html(data)
                    $('#linked_employee').val('{{ old('linked_employee', $hospital->linked_employee) }}')
                }
            });
        }
    </script>
    <script>
        function loadAssignedEmployees() {
            var department = $("#assigned_employee_department").val();
            if (!department) {
                department = 'Operations'
            }
            var url = '{{ route('super-admin.get.employees', ':department') }}';
            url = url.replace(':department', department);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#assigned_employee').html(data)
                    $('#assigned_employee').val('{{ old('assigned_employee', $hospital->assigned_employee) }}')
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            loadAssignedEmployees();
            loadLinkedEmployees();
            $("#linked_associate_partner").attr('disabled',true);
            $("#linked_associate_partner_id").attr('readonly',true);
        });

        /*$(document).on('blur', "input[type='email']", function(event) {
            event.preventDefault();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(!(regex.test($(this).val()))){
                $(this).parent('div').append('<div style="color:red">Email must required @<div>')
            }else{
                $(this).append('')
            }
        });*/

    </script>

@endpush
