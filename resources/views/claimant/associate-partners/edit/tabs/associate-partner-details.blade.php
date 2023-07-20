<form action="{{ route('admin.associate-partners.update', $associate->id) }}" method="post" id="associate-partner-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-6">
            <label for="name">Associate Partner Company's Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name"
                maxlength="60" placeholder="Enter company name" value="{{ old('name', $associate->name) }}">
            @error('name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="type">Associate Partner Type <span class="text-danger">*</span></label>
            <select class="form-select" id="type" name="type">
                <option value="">Select Type</option>
                <option value="vendor" {{ old('type', $associate->type) == 'vendor' ? 'selected' : '' }}>Vendor Partner
                </option>
                <option value="sales" {{ old('type', $associate->type) == 'sales' ? 'selected' : '' }}>Sales Partner
                </option>
            </select>
            @error('type')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="owner_firstname">Associate Partner Owner Name <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <input type="text"  onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="owner_firstname" name="owner_firstname"
                maxlength="15" placeholder="Enter firstname" value="{{ old('owner_firstname', $associate->owner_firstname) }}">
            @error('owner_firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1">
            <input type="text"  onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="owner_lastname" name="owner_lastname" maxlength="30"
                placeholder="Enter lastname" value="{{ old('owner_lastname', $associate->owner_lastname) }}">
            @error('owner_lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="pan">PAN Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control" id="pan" name="pan" maxlength="10" placeholder="Enter PAN no."
                    value="{{ old('pan', $associate->pan) }}">
                    @isset($associate->panfile)
                        <a href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->panfile) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                    @endisset
                    <input type="file" name="panfile" hidden id="panfile"/>
                    <label for="panfile" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
            </div>
            @error('pan')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('panfile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="owner">Official email ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="email" name="email" maxlength="45"
                placeholder="Enter official emailID" value="{{ old('email', $associate->email) }}">
            @error('email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="address">Associate Partner Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address Line"
                value="{{ old('address', $associate->address) }}">
            @error('address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="city" name="city" placeholder="City"
                value="{{ old('city', $associate->city) }}">
            @error('city')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="state" name="state" placeholder="State"
                value="{{ old('state', $associate->state) }}">
            @error('state')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="number" class="form-control" id="pincode" name="pincode" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;" placeholder="Pincode"
                value="{{ old('pincode', $associate->pincode) }}">
            @error('pincode')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="phone">Associate Partner Mobile Number <span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">+91</label>
            <input type="number" class="form-control" id="phone" name="phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                placeholder="Enter associate partner mobile number" value="{{ old('phone', $associate->phone) }}">
            </div>
            @error('phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="reference">Reference <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="reference" name="reference"
                placeholder="Enter reference" value="{{ old('reference', $associate->reference) }}">
            @error('reference')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="statuses">Associate Partner Status <span class="text-danger">*</span></label>
            <select class="form-select" id="statuses" name="status">
                <option value="">Select Status</option>
                <option value="Main" {{ old('status', $associate->status) == 'Main' ? 'selected' : '' }}>Main
                </option>
                <option value="Sub AP" {{ old('status', $associate->status) == 'Sub AP' ? 'selected' : '' }}>Sub AP
                </option>
                <option value="Agency" {{ old('status', $associate->status) == 'Agency' ? 'selected' : '' }}>Agency
                </option>
            </select>
            @error('status')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="linked_associate_partner">Linked Associate Partner Name </label>
            <select class="form-control select2 linked" id="linked_associate_partner" name="linked_associate_partner"
                data-toggle="select2" onchange="setLinkedAssociatePartnerId()">
                <option value="">Select Associate Partner</option>
                @foreach ($associates as $row)
                    <option value="{{ $row->id }}"
                        {{ old('linked_associate_partner', $associate->linked_associate_partner) == $row->id ? 'selected' : '' }}
                        data-id="{{ $row->associate_partner_id }}">
                        [<strong>Name: </strong>{{ $row->name }}]
                        [<strong>UID: </strong>{{ $row->associate_partner_id }}]
                        [<strong>City: </strong>{{ $row->city }}]
                        [<strong>State: </strong>{{ $row->state }}]
                    </option>
                @endforeach
            </select>
            @error('linked_associate_partner')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="linked_associate_partner_id">Linked Associate Partner ID </label>
            <input type="text" class="form-control linked" id="linked_associate_partner_id"
                name="linked_associate_partner_id" placeholder="Enter linked associate partner ID"
                value="{{ old('linked_associate_partner_id', $associate->linked_associate_partner_id) }}">
            @error('linked_associate_partner_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="assigned_employee_department">Assigned To Employee Department <span class="text-danger">*</span></label>
            <select class="form-select" id="assigned_employee_department" name="assigned_employee_department"
                onchange="loadAssignedEmployees()">
                <option value="">Select Department</option>
                <option value="Operations"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Operations' ? 'selected' : '' }}>Operations
                </option>
                <option value="Sales" {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Sales' ? 'selected' : '' }}>Sales
                </option>
                <option value="Accounts" {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Accounts' ? 'selected' : '' }}>
                    Accounts
                </option>
                <option value="Analytics & MIS"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Analytics & MIS' ? 'selected' : '' }}>Analytics & MIS
                </option>
                <option value="IT" {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'IT' ? 'selected' : '' }}>IT
                </option>
                <option value="Product Management"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Product Management' ? 'selected' : '' }}>Product
                    Management
                </option>
                <option value="Provider management"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Provider management' ? 'selected' : '' }}>Provider
                    management
                </option>
                <option value="Insurance"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Insurance' ? 'selected' : '' }}>Insurance
                </option>
                <option value="Claims Processing"
                    {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Claims Processing' ? 'selected' : '' }}>Claims
                    Processing
                </option>
                <option value="Cashless" {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Cashless' ? 'selected' : '' }}>
                    Cashless
                </option>
                <option value="Lending" {{ old('assigned_employee_department', $associate->assigned_employee_department) == 'Lending' ? 'selected' : '' }}>
                    Lending
                </option>
            </select>
            @error('assigned_employee_department')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
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
                value="{{ old('assigned_employee_id', $associate->assigned_employee_id) }}">
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
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Operations' ? 'selected' : '' }}>Operations
                </option>
                <option value="Sales" {{ old('linked_employee_department', $associate->linked_employee_department) == 'Sales' ? 'selected' : '' }}>Sales
                </option>
                <option value="Accounts" {{ old('linked_employee_department', $associate->linked_employee_department) == 'Accounts' ? 'selected' : '' }}>
                    Accounts
                </option>
                <option value="Analytics & MIS"
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Analytics & MIS' ? 'selected' : '' }}>Analytics & MIS
                </option>
                <option value="IT" {{ old('linked_employee_department', $associate->linked_employee_department) == 'IT' ? 'selected' : '' }}>IT
                </option>
                <option value="Product Management"
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Product Management' ? 'selected' : '' }}>Product
                    Management
                </option>
                <option value="Provider management"
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Provider management' ? 'selected' : '' }}>Provider
                    management
                </option>
                <option value="Insurance"
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Insurance' ? 'selected' : '' }}>Insurance
                </option>
                <option value="Claims Processing"
                    {{ old('linked_employee_department', $associate->linked_employee_department) == 'Claims Processing' ? 'selected' : '' }}>Claims
                    Processing
                </option>
                <option value="Cashless" {{ old('linked_employee_department', $associate->linked_employee_department) == 'Cashless' ? 'selected' : '' }}>
                    Cashless
                </option>
                <option value="Lending" {{ old('linked_employee_department', $associate->linked_employee_department) == 'Lending' ? 'selected' : '' }}>
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
                value="{{ old('linked_employee_id', $associate->linked_employee_id) }}">
            @error('linked_employee_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="mou">Associate Partner MOU <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="mou" name="mou">
                    <option value="">Select Status</option>
                    <option value="yes" {{ old('mou', $associate->mou) == 'yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="no" {{ old('mou', $associate->mou) == 'no' ? 'selected' : '' }}>No
                    </option>
                </select>
                 @isset($associate->moufile)
                        <a href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->moufile) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                    @endisset
                    <input type="file" name="moufile" hidden id="moufile"  />
                    <label for="moufile" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
            </div>
            @error('mou')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('moufile')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="agreement_start_date">Associate Partner Agreement Start Date <span
                    class="text-danger">*</span></label>

                <input type="date" class="form-control" id="agreement_start_date" name="agreement_start_date"
                    placeholder="Associate partner agreement start date"
                    value="{{ old('agreement_start_date', $associate->agreement_start_date) }}">

            @error('agreement_start_date')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="agreement_end_date">Associate Partner Agreement End Date <span
                    class="text-danger">*</span></label>
            <input type="date" class="form-control" id="agreement_end_date" name="agreement_end_date"
                placeholder="Associate partner agreement end date"
                value="{{ old('agreement_end_date', $associate->agreement_end_date) }}">
            @error('agreement_end_date')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- <div class="col-md-6 mt-3">
            <label for="contact_person">Associate Partner Contact Person's Name <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control" id="contact_person" name="contact_person"
                placeholder="Associate partner contact person's name"
                value="{{ old('contact_person', $associate->contact_person) }}">
            @error('contact_person')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="contact_person_phone">Associate Partner Contact Person's Mobile No. <span
                    class="text-danger">*</span></label>
                    <div class="input-group">
                        <label class="input-group-text" for="phone">+91</label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" class="form-control" id="contact_person_phone" name="contact_person_phone"
                placeholder="Associate partner contact person's mobile no."
                value="{{ old('contact_person_phone', $associate->contact_person_phone) }}">
                    </div>
            @error('contact_person_phone')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mt-3">
            <label for="contact_person_email">Associate Partner Contact Person's email ID. <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control" id="contact_person_email" name="contact_person_email"
                placeholder="Associate partner contact person's email ID."
                value="{{ old('contact_person_email', $associate->contact_person_email) }}">
            @error('contact_person_email')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div> --}}
        <div class="col-md-12 mt-3">
            <label for="address">Associate Partner's Bank Details <span class="text-danger">*</span></label>
        </div>
        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="bank_name" name="bank_name" maxlength="45"
                placeholder="Bank Name" value="{{ old('bank_name', $associate->bank_name) }}">
            @error('bank_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <input type="text" class="form-control" id="bank_address" name="bank_address" maxlength="80"
                placeholder="Bank Address" value="{{ old('bank_address', $associate->bank_address) }}">
            @error('bank_address')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-4 mt-2">
            <div class="input-group">
                <select class="form-select" id="cancel_cheque" name="cancel_cheque">
                    <option value="">Cancel Cheque</option>
                    <option value="Yes"
                        {{ old('cancel_cheque', $associate->cancel_cheque) == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                        {{ old('cancel_cheque', $associate->cancel_cheque) == 'No' ? 'selected' : '' }}>No
                    </option>
                </select>
                @isset($associate->cancel_cheque_file)
                    <a href="{{ asset('storage/uploads/associate-partners/' . $associate->id . '/' . $associate->cancel_cheque_file) }}"
                        download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
                <input type="file" name="cancel_cheque_file" @if(old('cancel_cheque',$associate->cancel_cheque) == 'No') disabled @endif id="cancel_cheque_file" hidden />

                <label for="cancel_cheque_file" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
            </div>

            @error('cancel_cheque')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('cancel_cheque_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" maxlength="20"
                placeholder="Bank Account No." value="{{ old('bank_account_no', $associate->bank_account_no) }}">
            @error('bank_account_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <input type="text" class="form-control" id="bank_ifs_code" name="bank_ifs_code" maxlength="11"
                placeholder="Bank IFSC Code" value="{{ old('bank_ifs_code', $associate->bank_ifs_code) }}">
            @error('bank_ifs_code')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="comments">Associate Partner Comments </label>
            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments" rows="4">{{ old('comments', $associate->comments) }}</textarea>
            @error('comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="associate-partner-form">Update
                Associate Partner</button>
        </div>
    </div>
</form>


@push('scripts')
<script>

    var status = "{{ old('status', $associate->status) }}";

    if(status == 'Main'){
        $('.linked').attr('disabled', true);
    }else{
        $('.linked').attr('disabled', false);
    }

    $("select").change(function() {
        if($(this).val() == 'No'){
            $("#"+$(this).attr('id')+'_file').attr('disabled', true);
        }else{
            $("#"+$(this).attr('id')+'_file').attr('disabled', false);
        }
    });

     $("#statuses").change(function() {
            var value = $(this).val();
            switch (value) {
                case "Main":
                    $('.linked').attr('disabled', true);
                    break;
                case "Sub AP":
                    $('.linked').attr('disabled', false);
                    break;
                case "Agency":
                    $('.linked').attr('disabled', false);
                    break;
                default:
                    $('.linked').attr('disabled', true);
                    break;
            }
        });
    </script>

    @endpush
