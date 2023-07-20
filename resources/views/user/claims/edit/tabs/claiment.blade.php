<div class="form-group row">
    <div class="col-12">
        <div class="card no-shadow">
            <div class="card-body">
                <form action="{{ route('admin.patients.store') }}" method="post" id="hospital-form"
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

                        <div class="col-md-6 mt-3">
                            <label for="dob">Patient DOB <span
                                    class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                placeholder="Associate partner agreement end date"
                                value="{{ old('dob') }}">
                            @error('dob')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
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
                            <label for="address">Patient Address <span class="text-danger">*</span></label>
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
                            <label for="id_proof">Patient ID Proof <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="id_proof" name="id_proof"
                                    placeholder="Enter Patient ID Proof no." value="{{ old('id_proof') }}">
                                    <input type="file" name="id_proof_file" id="upload" hidden />
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
                            <label for="by">Associate Partner ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="associate_partner_id" name="associate_partner_id"
                                placeholder="Associate Partner ID" value="{{ old('associate_partner_id') }}">
                            @error('associate_partner_id')
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

                        <div class="col-md-12 mt-2">
                            <label for="firstname">Patient Owner's Name <span class="text-danger">*</span></label>
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

                        <div class="col-md-6 mt-3">
                            <label for="pan">Patient PAN Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="pan" name="pan" maxlength="10"
                                    placeholder="Enter Patient PAN no." value="{{ old('pan') }}">
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
                            <label for="owner">Patient email ID <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" maxlength="30"
                                placeholder="Enter hospital email ID" value="{{ old('email') }}">
                            @error('email')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-6 mt-3">
                            <label for="mobile">Patient Mobile Number <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter hospital mobile number" value="{{ old('mobile') }}">
                            @error('mobile')
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
                            <label for="assigned_employee_id">Assigned To Employee ID <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="assigned_employee_id"
                                name="assigned_employee_id" placeholder="Enter assigned to employee ID"
                                value="{{ old('assigned_employee_id') }}">
                            @error('assigned_employee_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="linked_employee_id">Linked With Employee ID <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="linked_employee_id"
                                name="linked_employee_id" placeholder="Enter linked with employee ID"
                                value="{{ old('linked_employee_id') }}">
                            @error('linked_employee_id')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="comments">Comments </label>
                            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments" rows="4">{{ old('comments') }}</textarea>
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
    
@push('scripts')
    <script>
        function setLinkedAssociatePartnerId() {
            var linked_associate_partner = $("#linked_associate_partner").select2().find(":selected").data("id");
            $('#linked_associate_partner_id').val(linked_associate_partner);
        }

        function setAssignedEmployeeId() {
            var assigned_employee = $("#assigned_employee").select2().find(":selected").data("id");
            $('#assigned_employee_id').val(assigned_employee);
        }

        function setLinkedWithEmployeeId() {
            var linked_employee = $("#linked_employee").select2().find(":selected").data("id");
            $('#linked_employee_id').val(linked_employee);
        }
    </script>
@endpush
