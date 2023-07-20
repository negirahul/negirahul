@extends('layouts.admin')
@section('title', 'Edit Hospitals')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Hospital</a></li>
                            <li class="breadcrumb-item active">Pending for Hospital Tie-up Authorization </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pending for Hospital Tie-up Authorization</h4>
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
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <dl class="row mb-0">

                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Hospital UID </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->hospital->uid }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Hospital Name </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->hospital->name }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  MoU Inception Date </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->mou_inception_date }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  BHC Packages for Surgical Procedures Accepted </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->bhc_packages_for_surgical_procedures_accepted }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Discount on Medical Management Cases </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->discount_on_medical_management_cases }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Discount on final bill % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->discount_on_final_bill }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Discount on room rent % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->discount_on_room_rent }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Discount on medicines % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->discount_on_medicines }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Discount on consumables % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->discount_on_consumables }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Referral Commission Offered </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->referral_commission_offered }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Referral % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->referral }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Agreed for </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->agreed_for }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  ClaimStack Usage Services </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->claimstag_usage_services }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  ClaimStack Installation Charges (One Time Payment) </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->claimstag_installation_charges }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  ClaimStack Usage Charges </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->claimstag_usage_charges }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Claims Reimbursement - Insured Services </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->claims_reimbursement_insured_services }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Claims Reimbursement - Insured Service Charges </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->claims_reimbursement_insured_service_charges }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Cashless Claims Management Services </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->cashless_claims_management_services }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Cashless Claims Management Services Charges </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->cashless_claims_management_services_charges }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Lending / Finance Company's Agreement </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->lending_finance_company_agreement }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Lending / Finance Company's Agreement Date </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->lending_finance_company_agreement_date }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Medical Lending for Patients </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->medical_lending_for_patients }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Medical Lending Service Type </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->medical_lending_service_type }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Subvention % </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->subvention }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Medical Lending for Cashless Bill/ Invoice Discounting </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->medical_lending_for_bill_invoice_discounting }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Comments on Invoice Discounting </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->medical_lending_for_bill_invoice_discounting }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Hospital Management System Installation (HMS) </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->hospital_management_system_installation }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  HMS Services </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->hms_services }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  HMS Charges </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->hms_charges }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-6">
                                        <h5 class="card-title">  Comments on Tie-up </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ $hospital_tie_up->comments }} 
                                        </p>
                                    </dd>

                                    <dt class="col-sm-6">
                                        <h5 class="card-title"> 
                                            Linked Admin Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ @$hospital_tie_up->assigned_employee_data->firstname}} {{ @$hospital_tie_up->assigned_employee_data->lastname}} ({{ @$hospital_tie_up->assigned_employee_data->employee_code}}) </p>
                                    </dd>

                                    <dt class="col-sm-6">
                                        <h5 class="card-title"> 
                                            Assigned Employee's Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-6">
                                        <p class="card-text">: {{ @$hospital_tie_up->hospital->assignedEmployee->firstname}} {{ @$hospital_tie_up->hospital->assignedEmployee->lastname}} ({{ @$hospital_tie_up->hospital->assignedEmployee->employee_code}}) </p>
                                    </dd>
                                    
                                    <dt class="col-sm-6">
                                        <h5 class="card-title"> Authorize Hospital ID </h5>
                                    </dt>
                                    <dd class="col-sm-6">

                                    <button type="button" class="btn btn-danger"  onclick="confirmDelete({{ $hospital_tie_up->id }})">
                                        <i class="uil-shield-check"></i>
                                    Hospital Tie-up Updates Authorize</button>
                                    <form id='delete-form{{ $hospital_tie_up->id }}'
                                        action="{{ route('admin.hospital-tie-up-authorizations.update', $hospital_tie_up->id) }}"
                                        method='POST'>
                                        <input type='hidden' name='_token'
                                        value='{{ csrf_token() }}'>
                                        <input type='hidden' name='_method' value='PUT'>
                                    </form>

                                    </dd>

                                </dl>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->
    <div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-passwordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <p class="modal-title text-center" id="primary-header-modalLabel"><strong>Want to Change Password of UMP-</strong><span id="uid">{{ old('uid') }}</span></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="changePasswordForm" action="{{ route('admin.hospitals.change-password') }}">
                        @csrf
                        <input type="hidden" value="{{ old('id') }}" name="id" id="id">
                        <input type="hidden" value="{{ old('uid') }}" name="uid" id="employee_code">
                        <div class="form-group mb-2 {{ $errors->has('new_password') ? 'has-error' : '' }}">
                            <label for="new_password">New password *</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" class="form-control">
                            @error('new_password')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-2 {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                            <label for="new_password_confirmation">Confirm password *</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="form-control" placeholder="Re-enter new password">                           
                        </div>
                    </form>
                </div>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="changePasswordForm" class="btn btn-sm btn-success">Confirm</button>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @push('filter')
    @include('admin.filters.question-filter')
@endpush --}}
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        localStorage.setItem('activeTab', '');
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Authorize it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
     <script>
        $(".change-password").click(function () {
                var id = $(this).data('id');
                var uid = $(this).data('uid');
                $('#uid').text(uid);
                $('#employee_code').val(uid);                
                $('#id').val(id);
            });
    </script>
    @error('new_password')
    <script>
        $(document).ready(function () {
            $('#modal-password').modal('show');
        });       
    </script>
    @enderror
@endpush
