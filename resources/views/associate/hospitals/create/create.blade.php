@extends('layouts.associate')
@section('title', 'Create Hospital ID')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Hospital</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Hospital ID</h4>
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
                        <form action="{{ route('associate-partner.hospitals.store') }}" method="post" id="hospital-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12 mt-3">
                                    <label for="name">Hospital Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Hospital name" value="{{ old('name') }}">
                                    @error('name')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="onboarding">Hospital Onboarding <span class="text-danger">*</span></label>
                                    <select class="form-select" id="onboarding" name="onboarding">
                                        <option value="">Select onboarding</option>
                                        <option value="Tie Up" {{ old('onboarding') == 'Tie Up' ? 'selected' : '' }}>Tie Up
                                        </option>
                                        <option value="Non - Tie Up"
                                            {{ old('onboarding') == 'Non - Tie Up' ? 'selected' : '' }}>Non - Tie Up
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
                                        <option value="Direct" {{ old('by') == 'Direct' ? 'selected' : '' }}>Direct
                                        </option>
                                        <option value="Associate Partner"
                                            {{ old('by') == 'Associate Partner' ? 'selected' : '' }}>Associate Partner
                                        </option>
                                    </select>
                                    @error('by')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="address">Hospital Address <span class="text-danger">*</span></label>
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

                                <div class="col-md-12 mt-2">
                                    <label for="firstname">Hospital Owner's Name <span class="text-danger">*</span></label>
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
                                    <label for="pan">Hospital PAN Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="pan" name="pan" maxlength="10"
                                            placeholder="Enter Hospital PAN no." value="{{ old('pan') }}">
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
                                    <input type="text" class="form-control" id="email" name="email" maxlength="30"
                                        placeholder="Enter hospital email ID" value="{{ old('email') }}">
                                    @error('email')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="landline">Hospital Landline Number <span
                                        class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="col-3">
                                                <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>=3) return false;" class="form-control input-md" id="code" name="code"
                                                placeholder="Code" value="{{ old('code') }}">
                                            </div>
                                            <div class="col-9">
                                                <input type="number" class="form-control" id="landline" name="landline"
                                                placeholder="Enter hospital landline number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length >= 10) return false;" value="{{ old('landline') }}">
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
                                    <label for="phone">Hospital Mobile Number <span
                                        class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <label class="input-group-text" for="phone">+91</label>
                                            <input type="number" class="form-control" id="phone" name="phone"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Enter hospital mobile number" value="{{ old('phone') }}">
                                        </div>
                                        @error('phone')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                <div class="col-md-12 mt-3">
                                    <label for="rohini">Rohini Code <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rohini" name="rohini"
                                            placeholder="Enter rohini code." value="{{ old('rohini') }}">
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
                                    <label for="linked_associate_partner">Associate Partner Company Name <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control select2" id="linked_associate_partner" name="linked_associate_partner"
                                        data-toggle="select2" onchange="setLinkedAssociatePartnerId()">
                                        <option value="">Select Associate Partner</option>
                                        @foreach ($associates as $associate)
                                            <option value="{{ $associate->name }}"
                                                {{ old('linked_associate_partner') == $associate->name ? 'selected' : '' }}
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
                                <div class="col-md-6 mt-3">
                                    <label for="linked_associate_partner_id">Associate Partner ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="linked_associate_partner_id"
                                        name="linked_associate_partner_id" placeholder="Enter Associate Partner Id"
                                        value="{{ old('linked_associate_partner_id') }}">
                                    @error('linked_associate_partner_id')
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
                                        Hospital ID</button>
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
@endpush
