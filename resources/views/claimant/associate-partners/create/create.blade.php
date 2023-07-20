@extends('layouts.admin')
@section('title', 'Create Associate Partners')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Associate Partner</h4>
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
                        <form action="{{ route('admin.associate-partners.store') }}" method="post"
                            id="associate-partner-form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="name">Associate Partner Company's Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        maxlength="60" placeholder="Enter company name" value="{{ old('name') }}">
                                    @error('name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="type">Associate Partner Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="type" name="type">
                                        <option value="">Select Type</option>
                                        <option value="vendor" {{ old('type') == 'vendor' ? 'selected' : '' }}>Vendor Partner
                                        </option>
                                        <option value="sales" {{ old('type') == 'sales' ? 'selected' : '' }}>Sales Partner
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
                                        maxlength="15" placeholder="Enter firstname" value="{{ old('owner_firstname') }}">
                                    @error('owner_firstname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-1">
                                    <input type="text"  onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="owner_lastname" name="owner_lastname" maxlength="30"
                                        placeholder="Enter lastname" value="{{ old('owner_lastname') }}">
                                    @error('owner_lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="pan">PAN Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pan" name="pan"
                                            maxlength="10" placeholder="Enter PAN no." value="{{ old('pan') }}">
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
                                    <label for="owner">Official email ID <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="45"
                                        placeholder="Enter official emailID" value="{{ old('email') }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="address">Associate Partner Address <span class="text-danger">*</span></label>
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
                                    <input type="number" class="form-control" id="pincode" name="pincode"
                                        pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;"
                                        placeholder="Pincode" value="{{ old('pincode') }}">
                                    @error('pincode')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phone">Associate Partner Mobile Number <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="phone">+91</label>
                                        <input type="number" class="form-control" id="phone" name="phone"
                                            pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Enter associate partner mobile number"
                                            value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="reference">Reference <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="reference" name="reference"
                                        placeholder="Enter reference" value="{{ old('reference') }}">
                                    @error('reference')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="statuses">Associate Partner Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="statuses" name="status">
                                        <option value="">Select Status</option>
                                        <option value="Main" {{ old('status') == 'Main' ? 'selected' : '' }}>Main
                                        </option>
                                        <option value="Sub AP" {{ old('status') == 'Sub AP' ? 'selected' : '' }}>Sub AP
                                        </option>
                                        <option value="Agency" {{ old('status') == 'Agency' ? 'selected' : '' }}>Agency
                                        </option>
                                    </select>
                                    @error('status')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="linked_associate_partner">Linked Associate Partner Name </label>
                                    <select class="form-control select2 linked" id="linked_associate_partner"
                                        name="linked_associate_partner" data-toggle="select2"
                                        onchange="setLinkedAssociatePartnerId()">
                                        <option value="">Select Associate Partner</option>
                                        @foreach ($associates as $associate)
                                            <option value="{{ $associate->id }}"
                                                {{ old('linked_associate_partner') == $associate->id ? 'selected' : '' }}
                                                data-id="{{ $associate->associate_partner_id }}">
                                                [<strong>Name:
                                                </strong>{{ $associate->name }}]
                                                [<strong>UID: </strong>{{ $associate->associate_partner_id }}]
                                                [<strong>City: </strong>{{ $associate->city }}]
                                                [<strong>State: </strong>{{ $associate->state }}]
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
                                        value="{{ old('linked_associate_partner_id') }}">
                                    @error('linked_associate_partner_id')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="assigned_employee_department">Assigned To Employee Department <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="assigned_employee_department"
                                        name="assigned_employee_department" onchange="loadAssignedEmployees()">
                                        <option value="">Select Department</option>
                                        <option value="Operations"
                                            {{ old('assigned_employee_department') == 'Operations' ? 'selected' : '' }}>
                                            Operations
                                        </option>
                                        <option value="Sales"
                                            {{ old('assigned_employee_department') == 'Sales' ? 'selected' : '' }}>Sales
                                        </option>
                                        <option value="Accounts"
                                            {{ old('assigned_employee_department') == 'Accounts' ? 'selected' : '' }}>
                                            Accounts
                                        </option>
                                        <option value="Analytics & MIS"
                                            {{ old('assigned_employee_department') == 'Analytics & MIS' ? 'selected' : '' }}>
                                            Analytics & MIS
                                        </option>
                                        <option value="IT"
                                            {{ old('assigned_employee_department') == 'IT' ? 'selected' : '' }}>IT
                                        </option>
                                        <option value="Product Management"
                                            {{ old('assigned_employee_department') == 'Product Management' ? 'selected' : '' }}>
                                            Product
                                            Management
                                        </option>
                                        <option value="Provider management"
                                            {{ old('assigned_employee_department') == 'Provider management' ? 'selected' : '' }}>
                                            Provider
                                            management
                                        </option>
                                        <option value="Insurance"
                                            {{ old('assigned_employee_department') == 'Insurance' ? 'selected' : '' }}>
                                            Insurance
                                        </option>
                                        <option value="Claims Processing"
                                            {{ old('assigned_employee_department') == 'Claims Processing' ? 'selected' : '' }}>
                                            Claims
                                            Processing
                                        </option>
                                        <option value="Cashless"
                                            {{ old('assigned_employee_department') == 'Cashless' ? 'selected' : '' }}>
                                            Cashless
                                        </option>
                                        <option value="Lending"
                                            {{ old('assigned_employee_department') == 'Lending' ? 'selected' : '' }}>
                                            Lending
                                        </option>
                                    </select>
                                    @error('assigned_employee_department')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="assigned_employee">Assigned To Employee Name <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="assigned_employee" name="assigned_employee"
                                        data-toggle="select2" onchange="setAssignedEmployeeId()">
                                        <option value="">Select Assigned To Employee</option>
                                    </select>
                                    @error('assigned_employee')
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
                                <div class="col-md-12 mt-3">
                                    <label for="linked_employee_department">Linked With Employee Department <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="linked_employee_department"
                                        name="linked_employee_department" onchange="loadLinkedEmployees()">
                                        <option value="">Select Department</option>
                                        <option value="Operations"
                                            {{ old('linked_employee_department') == 'Operations' ? 'selected' : '' }}>
                                            Operations
                                        </option>
                                        <option value="Sales"
                                            {{ old('linked_employee_department') == 'Sales' ? 'selected' : '' }}>Sales
                                        </option>
                                        <option value="Accounts"
                                            {{ old('linked_employee_department') == 'Accounts' ? 'selected' : '' }}>
                                            Accounts
                                        </option>
                                        <option value="Analytics & MIS"
                                            {{ old('linked_employee_department') == 'Analytics & MIS' ? 'selected' : '' }}>
                                            Analytics & MIS
                                        </option>
                                        <option value="IT"
                                            {{ old('linked_employee_department') == 'IT' ? 'selected' : '' }}>IT
                                        </option>
                                        <option value="Product Management"
                                            {{ old('linked_employee_department') == 'Product Management' ? 'selected' : '' }}>
                                            Product
                                            Management
                                        </option>
                                        <option value="Provider management"
                                            {{ old('linked_employee_department') == 'Provider management' ? 'selected' : '' }}>
                                            Provider
                                            management
                                        </option>
                                        <option value="Insurance"
                                            {{ old('linked_employee_department') == 'Insurance' ? 'selected' : '' }}>
                                            Insurance
                                        </option>
                                        <option value="Claims Processing"
                                            {{ old('linked_employee_department') == 'Claims Processing' ? 'selected' : '' }}>
                                            Claims
                                            Processing
                                        </option>
                                        <option value="Cashless"
                                            {{ old('linked_employee_department') == 'Cashless' ? 'selected' : '' }}>
                                            Cashless
                                        </option>
                                        <option value="Lending"
                                            {{ old('linked_employee_department') == 'Lending' ? 'selected' : '' }}>
                                            Lending
                                        </option>
                                    </select>
                                    @error('linked_employee_department')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="linked_employee">Linked With Employee Name <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="linked_employee" name="linked_employee"
                                        data-toggle="select2" onchange="setLinkedWithEmployeeId()">
                                        <option value="">Select Linked With Employee</option>
                                    </select>
                                    @error('linked_employee')
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
                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="associate-partner-form">Create
                                        Associate Partner</button>
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
    <script>
        function loadLinkedEmployees() {
            var department = $("#linked_employee_department").val();
            if (!department) {
                department = 'Operations'
            }
            var url = '{{ route('admin.get.employees', ':department') }}';
            url = url.replace(':department', department);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#linked_employee').html(data)
                    $('#linked_employee').val('{{ old('linked_employee') }}')
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
            var url = '{{ route('admin.get.employees', ':department') }}';
            url = url.replace(':department', department);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#assigned_employee').html(data)
                    $('#assigned_employee').val('{{ old('assigned_employee') }}')
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            loadAssignedEmployees();
            loadLinkedEmployees();
        });
    </script>
    <script>
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
