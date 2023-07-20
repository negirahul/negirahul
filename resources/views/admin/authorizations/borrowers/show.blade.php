@extends('layouts.admin')
@section('title', 'Edit Borrowers')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Borrower</a></li>
                            <li class="breadcrumb-item active">Pending for Borrower ID Authorization </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pending for Borrower ID Authorization</h4>
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

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Patient ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->patient->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Claim ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Claimant ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$borrower->claim->claimant->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Hospital ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->patient->hospital->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Hospital Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->patient->hospital->name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Hospital Address
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->patient->hospital->address }}  {{ $borrower->claim->patient->hospital->city }}  {{ $borrower->claim->patient->hospital->state }}   {{ $borrower->claim->patient->hospital->pincode }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Patient Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->patient->firstname }} {{ $borrower->claim->patient->middlename }} {{ $borrower->claim->patient->lastname }}  </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Policy No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$borrower->claim->policy_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Insurance Company
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        @php
                                        $insurar = \DB::table('insurers')->where('id', @$borrower->claim->policy->insurer_id)->value('name');
                                        @endphp
                                        <p class="card-text">: {{ @$insurar }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Policy Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        @php
                                        $poloo = \DB::table('insurers')->where('id', @$borrower->claim->policy->policy_id)->value('name');
                                        @endph
                                        <p class="card-text">: {{ @$poloo }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Sl. No./Certificate No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->claim->certificate_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Company/TPA ID Card No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$borrower->claim->policy->company_tpa_id_card_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            TPA Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$borrower->claim->policy->tpa_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Policy Type
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$borrower->claim->policy->policy_type }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Is Patient and Borrower Same
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->is_patient_and_borrower_same }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Is Claimant and Borrower Same
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->is_claimant_and_borrower_same }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_firstname }} {{ $borrower->borrower_middlename }} {{ $borrower->borrower_lastname }}</p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower's Relation with Patient
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrowers_relation_with_patient }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower DOB
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_dob }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Gender
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->gender }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Address
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_address }} {{ $borrower->borrower_city }} {{ $borrower->borrower_state }} {{ $borrower->borrower_pincode }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower ID Proof
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_id_proof }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Nature of Income
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->nature_of_income }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Name of the Organization
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->organization }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Member ID No./Employee ID (Client ID)
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->member_or_employer_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower email id
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_personal_email_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower official email id
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_official_email_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Mobile No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_mobile_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower PAN No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_pan_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Aadhar No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_aadhar_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Bank Statement (3 months)
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->bank_statement }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower  ITR (Income Tax Return)
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->itr }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Cancel Cheque / Pass Book
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_cancel_cheque }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Borrower Bank Details
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_bank_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Bank Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_bank_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Bank Address
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_bank_address }}  </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            A/C No.
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_ac_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            IFS Code
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_ifs_code }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Nominee Name
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->co_borrower_nominee_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Nominee DOB
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->co_borrower_nominee_dob }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Nominee Gender
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Nominee Relation
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->co_borrower_nominee_gender }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Borrower Other Documents
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->co_borrower_other_documents }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Co-Borrower / Borrower Comments
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->co_borrower_comments }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Estimated Amount
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->borrower_estimated_amount }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Linked Admin Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->linked_employee_data->firstname}} {{ $borrower->linked_employee_data->lastname}} ({{ $borrower->linked_employee_data->employee_code}}) </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Assigned Employee's Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $borrower->assigned_employee_data->firstname}} {{ $borrower->assigned_employee_data->lastname}} ({{ $borrower->assigned_employee_data->employee_code}}) </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Authorize Hospital ID
                                        </h5>
                                    </dt>
       
                                    <dd class="col-sm-8">

                                    <button type="button" class="btn btn-danger"  onclick="confirmDelete({{ $borrower->id }})">
                                        <i class="uil-shield-check"></i>
                                    Authorize Borrower ID</button>
                                    <form id='delete-form{{ $borrower->id }}'
                                        action="{{ route('admin.borrower-authorizations.update', $borrower->id) }}"
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
