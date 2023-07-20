@extends('layouts.associate')
@section('title', 'Edit User')
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
                            <li class="breadcrumb-item"><a href="{{ route('associate-partner.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit User</h4>
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
                        <form action="{{ route('associate-partner.users.update', $user->id) }}" method="post" id="userForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="firstname">Employee Name <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <input type="text" class="form-control" id="firstname" name="firstname" maxlength="15"
                                        placeholder="Firstname" value="{{ old('firstname', $user->firstname) }}">
                                    @error('firstname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-1">
                                    <input type="text" class="form-control" id="lastname" name="lastname" maxlength="30"
                                        placeholder="Lastname" value="{{ old('lastname', $user->lastname) }}">
                                    @error('lastname')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="uid">Employee Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="uid" name="uid" maxlength="8"
                                        placeholder="Enter employee code"
                                        value="{{ old('uid', $user->uid) }}">
                                    @error('uid')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="designation">Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="designation" name="designation" maxlength="30"
                                        placeholder="Enter designation"
                                        value="{{ old('designation', $user->designation) }}">
                                    @error('designation')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="owner">Official Mail ID <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" maxlength="30"
                                        placeholder="Enter official mail ID" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="phone">Mobile Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <label class="input-group-text" for="phone">+91</label>
                                        <input type="number" class="form-control" id="phone" name="phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Enter mobile number" value="{{ old('phone', $user->phone) }}">
                                    </div>
                                    @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="linked_with_superadmin">Linked With Super Admin <span class="text-danger">*</span></label>
                                    <select class="form-select" id="linked_with_superadmin" name="linked_with_superadmin">
                                        <option value="">Select</option>
                                        <option value="yes"
                                            {{ old('linked_with_superadmin', $user->linked_with_superadmin) == 'yes' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="no" {{ old('linked_with_superadmin', $user->linked_with_superadmin) == 'no' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                    @error('linked_with_superadmin')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label for="department">Department <span class="text-danger">*</span></label>
                                    <select class="form-select" id="department" name="department" onchange="loadEmployees()">
                                        <option value="">Select Department</option>
                                        <option value="Operations"
                                            {{ old('department', $user->department) == 'Operations' ? 'selected' : '' }}>
                                            Operations
                                        </option>
                                        <option value="Sales"
                                            {{ old('department', $user->department) == 'Sales' ? 'selected' : '' }}>Sales
                                        </option>
                                        <option value="Accounts"
                                            {{ old('department', $user->department) == 'Accounts' ? 'selected' : '' }}>
                                            Accounts
                                        </option>
                                        <option value="Analytics & MIS"
                                            {{ old('department', $user->department) == 'Analytics & MIS' ? 'selected' : '' }}>
                                            Analytics & MIS
                                        </option>
                                        <option value="IT"
                                            {{ old('department', $user->department) == 'IT' ? 'selected' : '' }}>IT
                                        </option>
                                        <option value="Product Management"
                                            {{ old('department', $user->department) == 'Product Management' ? 'selected' : '' }}>
                                            Product Management
                                        </option>
                                        <option value="Provider management"
                                            {{ old('department', $user->department) == 'Provider management' ? 'selected' : '' }}>
                                            Provider management
                                        </option>
                                        <option value="Insurance"
                                            {{ old('department', $user->department) == 'Insurance' ? 'selected' : '' }}>
                                            Insurance
                                        </option>
                                        <option value="Claims Processing"
                                            {{ old('department', $user->department) == 'Claims Processing' ? 'selected' : '' }}>
                                            Claims Processing
                                        </option>
                                        <option value="Cashless"
                                            {{ old('department', $user->department) == 'Cashless' ? 'selected' : '' }}>
                                            Cashless
                                        </option>
                                        <option value="Lending" {{ old('department') == 'Lending' ? 'selected' : '' }}>
                                            Lending
                                        </option>
                                    </select>
                                    @error('department')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mt-3 div_linked_employee">
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
                                <div class="col-md-6 mt-3 div_linked_employee">
                                    <label for="linked_employee_id">Linked With Employee ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="linked_employee_id"
                                        name="linked_employee_id" placeholder="Enter linked with employee ID"
                                        value="{{ old('linked_employee_id', $user->linked_employee_id) }}">
                                    @error('linked_employee_id')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="kra">KRA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kra" name="kra" maxlength="40"
                                        placeholder="Enter kra" value="{{ old('kra', $user->kra) }}">
                                    @error('kra')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label>Role Based Access Control <span class="text-danger">*</span></label>
                                    @include('admin.users.edit.permission')
                                </div>



                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="userForm">Update
                                        User</button>
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
        function setLinkedWithEmployeeId() {
            var linked_employee = $("#linked_employee").select2().find(":selected").data("id");
            $('#linked_employee_id').val(linked_employee);
        }
    </script>
        <script>
            function loadEmployees(){
                var department  = $("#department").val();
                var url         = '{{ route("admin.get.employees", ":department") }}';
                url             = url.replace(':department', department);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                       $('#linked_employee').html(data)
                       $('#linked_employee').val('{{ old("linked_employee", $user->linked_employee) }}')
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function () {
                loadEmployees();
            });
        </script>
@endpush
