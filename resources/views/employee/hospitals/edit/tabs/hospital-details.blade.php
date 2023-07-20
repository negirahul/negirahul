<form action="{{ route('employee.hospitals.update', $hospital->id) }}" method="post" id="hospital-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-12 mt-3">
            <label for="name">Hospital Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Enter Hospital name" value="{{ old('name', $hospital->name) }}">
            @error('name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="onboarding">Hospital Onboarding <span class="text-danger">*</span></label>
            <select class="form-select" id="onboarding" name="onboarding">
                <option value="">Select onboarding</option>
                <option value="Tie Up" {{ old('onboarding', $hospital->onboarding) == 'Tie Up' ? 'selected' : '' }}>Tie Up
                </option>
                <option value="Non - Tie Up"
                    {{ old('onboarding', $hospital->onboarding) == 'Non - Tie Up' ? 'selected' : '' }}>Non - Tie Up
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
                <option value="Direct" {{ old('by', $hospital->by) == 'Direct' ? 'selected' : '' }}>Direct
                </option>
                <option value="Associate Partner"
                    {{ old('by', $hospital->by) == 'Associate Partner' ? 'selected' : '' }}>Associate Partner
                </option>
            </select>
            @error('by')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="address">Hospital Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" name="address"
                placeholder="Address Line" value="{{ old('address', $hospital->address) }}">
            @error('address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="city" name="city"
                placeholder="City" value="{{ old('city', $hospital->city) }}">
            @error('city')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="state" name="state"
                placeholder="State" value="{{ old('state', $hospital->state) }}">
            @error('state')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="number" class="form-control" id="pincode" name="pincode" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"
                placeholder="Pincode" value="{{ old('pincode', $hospital->pincode) }}">
            @error('pincode')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <label for="firstname">Hospital Owner's Name <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <input type="text" class="form-control" id="firstname" name="firstname" maxlength="15"
                placeholder="Firstname" value="{{ old('firstname', $hospital->firstname) }}">
            @error('firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1">
            <input type="text" class="form-control" id="lastname" name="lastname" maxlength="30"
                placeholder="Lastname" value="{{ old('lastname', $hospital->lastname) }}">
            @error('lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="pan">Hospital PAN Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="pan" name="pan" maxlength="10"
                    placeholder="Enter Hospital PAN no." value="{{ old('pan', $hospital->pan) }}">
                <input type="file" name="panfile" id="upload" hidden />
                <label for="upload" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('pan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('panfile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner">Hospital email ID <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" maxlength="30"
                placeholder="Enter hospital email ID" value="{{ old('email', $hospital->email) }}">
            @error('email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="landline">Hospital Landline Number <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="landline" name="landline"
                placeholder="Enter hospital landline number" value="{{ old('landline', $hospital->landline) }}">
            @error('landline')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>



        <div class="col-md-6 mt-3">
            <label for="phone">Hospital Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="number" class="form-control" id="phone" name="phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" placeholder="Enter hospital mobile number" value="{{ old('phone', $hospital->phone) }}">
            </div>
            @error('phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="rohini">Rohini Code <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="rohini" name="rohini"
                    placeholder="Enter rohini code." value="{{ old('rohini', $hospital->rohini) }}">
                <input type="file" name="rohinifile" id="rohinifile" hidden />
                <label for="rohinifile" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('rohini')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('rohinifile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="associate_partner_id">Associate Partner ID <span
                class="text-danger">*</span></label>
            <input type="text" class="form-control" id="associate_partner_id"
                name="associate_partner_id" placeholder="Enter associate partner ID"
                value="{{ old('associate_partner_id', $hospital->linked_associate_partner_id) }}">
            @error('associate_partner_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="associate_partner_name">Associate Partner Name <span
                class="text-danger">*</span></label>
            <input type="text" class="form-control" id="associate_partner_id"
                name="associate_partner_name" placeholder="Enter associate partner name"
                value="{{ old('associate_partner_name', $hospital->linked_associate_partner) }}">
            @error('associate_partner_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="tan">Hospital Tan Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="tan" name="tan"
                    placeholder="Enter Hospital Tan no." value="{{ old('tan', $hospital->tan) }}">
                <input type="file" name="tanfile" id="tanfile" hidden />
                <label for="tanfile" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('tan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('tanfile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="gst">Hospital Gst Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="gst" name="gst"
                    placeholder="Enter Hospital Gst no." value="{{ old('gst', $hospital->gst) }}">
                <input type="file" name="gstfile" id="gstfile" hidden />
                <label for="gstfile" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('gst')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('gstfile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner">Hospital Owner Email ID <span class="text-danger">*</span></label>
            <input type="owner_email" class="form-control" id="owner_email" name="owner_email"
                placeholder="Enter hospital Owner Email ID" value="{{ old('owner_email', $hospital->owner_email) }}">
            @error('owner_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner_phone">Hospital Owner Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="number" class="form-control" id="owner_phone" name="owner_phone" placeholder="Enter hospital Owner mobile number" value="{{ old('owner_phone', $hospital->owner_phone) }}">
            </div>
            @error('owner_phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-12 mt-3">
            <label for="contact_person_name">Contact Person Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="contact_person_name" name="contact_person_name"
                placeholder="Enter contact person  name" value="{{ old('contact_person_name', $hospital->contact_person_name) }}">
            @error('contact_person_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="contact_person_email">Contact Person Email ID <span class="text-danger">*</span></label>
            <input type="contact_person_email" class="form-control" id="contact_person_email" name="contact_person_email"
                placeholder="Enter hospital Owner Email ID" value="{{ old('contact_person_email', $hospital->contact_person_email) }}">
            @error('contact_person_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="contact_person_phone">Contact Person Mobile Number <span class="text-danger">*</span></label>
                <div class="input-group">
                    <label class="input-group-text" for="phone">+91</label>
                    <input type="number" class="form-control" id="contact_person_phone" name="contact_person_phone"  placeholder="Enter hospital Owner mobile number" value="{{ old('contact_person_phone', $hospital->contact_person_phone) }}">
                </div>
            @error('contact_person_phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="registration_no">Registration Number <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="registration_no" name="registration_no"
                placeholder="Enter hospital Owner mobile number" value="{{ old('registration_no', $hospital->registration_no) }}">
            @error('registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_name">Medical Superintendent Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="medical_superintendent_name" name="medical_superintendent_name"
                placeholder="Enter Medical Superintendent Name" value="{{ old('medical_superintendent_name', $hospital->medical_superintendent_name) }}">
            @error('medical_superintendent_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_email">Medical Superintendent Email ID <span class="text-danger">*</span></label>
            <input type="medical_superintendent_email" class="form-control" id="medical_superintendent_email" name="medical_superintendent_email"
                placeholder="Enter Medical Superintendent Email ID" value="{{ old('medical_superintendent_email', $hospital->medical_superintendent_email) }}">
            @error('medical_superintendent_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_mobile">Medical Superintendent Mobile Number <span  class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
                <input type="number" class="form-control" id="medical_superintendent_mobile" name="medical_superintendent_mobile" placeholder="Enter Medical Superintendent Mobile Number" value="{{ old('medical_superintendent_mobile', $hospital->medical_superintendent_mobile) }}">
            </div>
            @error('medical_superintendent_mobile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_registration_no">Medical Superintendent Registration No <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="medical_superintendent_registration_no" name="medical_superintendent_registration_no"
                placeholder="Enter Medical Superintendent Registration No" value="{{ old('medical_superintendent_registration_no', $hospital->medical_superintendent_registration_no) }}">
            @error('medical_superintendent_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="medical_superintendent_qualification">Medical Superintendent Qualification Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="medical_superintendent_qualification" name="medical_superintendent_qualification"
                placeholder="Enter Medical Superintendent Qualification Name" value="{{ old('medical_superintendent_qualification', $hospital->medical_superintendent_qualification) }}">
            @error('medical_superintendent_qualification')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="pollution_clearance_certificate">Hospital Pollution Clearance Certificate <span class="text-danger">*</span></label>
            <select class="form-select" id="pollution_clearance_certificate" name="pollution_clearance_certificate">
                <option value="">Select pollution clearance certificate</option>
                <option value="Yes" {{ old('pollution_clearance_certificate', $hospital->pollution_clearance_certificate) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('pollution_clearance_certificate', $hospital->pollution_clearance_certificate) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('pollution_clearance_certificate')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="fire_safety_clearance_certificate">Hospital Fire Safety Clearance Certificate <span class="text-danger">*</span></label>
            <select class="form-select" id="fire_safety_clearance_certificate" name="fire_safety_clearance_certificate">
                <option value="">Select Fire Safety Clearance Certificate</option>
                <option value="Yes" {{ old('fire_safety_clearance_certificate', $hospital->fire_safety_clearance_certificate) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('fire_safety_clearance_certificate', $hospital->fire_safety_clearance_certificate) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('fire_safety_clearance_certificate')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="certificate_of_incorporation">Hospital Certificate Of Incorporation <span class="text-danger">*</span></label>
            <select class="form-select" id="certificate_of_incorporation" name="certificate_of_incorporation">
                <option value="">Select Certificate Of Incorporation</option>
                <option value="Yes" {{ old('certificate_of_incorporation', $hospital->certificate_of_incorporation) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('certificate_of_incorporation', $hospital->certificate_of_incorporation) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
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

        <div class="col-md-3 mt-2">
            <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                <option value="">Cancel Cheque</option>
                <option value="Yes" {{ old('cancel_cheque', $hospital->cancel_cheque) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('cancel_cheque', $hospital->cancel_cheque) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>

            @error('cancel_cheque')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-2">
                <input type="file" name="cancel_cheque_file" id="cancel_cheque_file" hidden />
                <label for="cancel_cheque_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            @error('cancel_cheque_file')
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

        <div class="col-md-5 mt-2">
            <label for="certificate_of_incorporation">Hospital Tariff List / SOC (Printed)* (if yes upload) <span class="text-danger">*</span></label>
            <select class="form-select" id="tariff_list_soc" name="tariff_list_soc">
                <option value="">Select</option>
                <option value="Yes" {{ old('tariff_list_soc', $hospital->tariff_list_soc) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('tariff_list_soc', $hospital->tariff_list_soc) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>

            @error('tariff_list_soc')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 32px !important;">
                <input type="file" name="tariff_list_soc_file" id="tariff_list_soc_file" hidden />
                <label for="tariff_list_soc_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            @error('tariff_list_soc_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="nabh_registration_no">Hospital NABH Registration No. <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="nabh_registration_no" name="nabh_registration_no"
                    placeholder="Hospital NABH Registration No." value="{{ old('nabh_registration_no', $hospital->nabh_registration_no) }}">
                <input type="file" name="nabh_registration_file" id="nabh_registration_file" hidden />
                <label for="nabh_registration_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('nabh_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('nabh_registration_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="nabl_registration_no">Hospital NABL Registration No. <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="nabl_registration_no" name="nabl_registration_no"
                    placeholder="Hospital NABL Registration No." value="{{ old('nabl_registration_no', $hospital->nabl_registration_no) }}">
                <input type="file" name="nabl_registration_file" id="nabl_registration_file" hidden />
                <label for="nabl_registration_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('nabl_registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('nabh_registration_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-5 mt-2">
            <label for="certificate_of_incorporation">Hospital Signed MOUs*  (if yes upload) <span class="text-danger">*</span></label>
            <select class="form-select" id="signed_mous" name="signed_mous">
                <option value="">Select</option>
                <option value="Yes" {{ old('signed_mous', $hospital->signed_mous) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('signed_mous', $hospital->signed_mous) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>

            @error('signed_mous')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 32px !important;">
                <input type="file" name="signed_mous_file" id="signed_mous_file" hidden />
                <label for="signed_mous_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            @error('signed_mous_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="other_documents">Hospital Hospital Other Documents <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="other_documents" name="other_documents"
                    placeholder="Hospital Hospital Other Documents" value="{{ old('other_documents', $hospital->other_documents) }}">
                <input type="file" name="other_documents_file" id="other_documents_file" hidden />
                <label for="other_documents_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            </div>
            @error('other_documents')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('other_documents_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


         <div class="col-md-6 mt-3">
            <label for="hrms_software">HRMS Software <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="hrms_software" name="hrms_software"
                    placeholder="HRMS Software" value="{{ old('hrms_software', $hospital->hrms_software) }}">
            </div>
            @error('hrms_software')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-11 mt-2">
            <label for="iso_status">ISO Status <span class="text-danger">*</span></label>
            <select class="form-select" id="iso_status" name="iso_status">
                <option value="">Select</option>
                <option value="Yes" {{ old('iso_status', $hospital->iso_status) == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('iso_status', $hospital->iso_status) == 'No' ? 'selected' : '' }}>No
                </option>
            </select>

            @error('iso_status')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 32px !important;">
                <input type="file" name="iso_status_file" id="iso_status_file" hidden />
                <label for="iso_status_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
            @error('iso_status_file')
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

@endpush
