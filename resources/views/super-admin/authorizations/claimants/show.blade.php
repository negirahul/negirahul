@extends('layouts.super-admin')
@section('title', 'Edit Claimants')
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
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claimant</a></li>
                            <li class="breadcrumb-item active">Pending for Claimant ID Authorization </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pending for Claimant ID Authorization</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')


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
                                        <h5 class="card-title"> Claimant ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Patient ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->patient->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claim ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Associate Partner ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->patient->associate_partner_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Hospital ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->patient->hospital->uid }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Patient Name 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->patient->firstname }} {{ $claimant->claim->patient->middlename }} {{ $claimant->claim->patient->lastname }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Patient ID Proof 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->claim->patient->id_proof }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Policy Type 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->policy_type }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Group Name 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->group_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Employee ID / Member ID 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->employee_id_or_member_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Are Patient and Claimant Same 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->are_patient_and_claimant_same }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Name 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->firstname }} {{ $claimant->middlename }} {{ $claimant->lastname }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant PAN No. 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->pan_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Aadhar No. 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->aadhar_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Patient's Relation with Claimant 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->patients_relation_with_claimant }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Please Specify 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->specify }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Address 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->address }}   {{ $claimant->city }}   {{ $claimant->state }}   {{ $claimant->pincode }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Personal email id 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->personal_email_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant official email id 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->official_email_id }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Mobile No. 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->mobile_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Cancel Cheque / Pass Book 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->cancel_cheque }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Bank Details 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->bank_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Bank Name 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->bank_name }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Bank Address 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->bank_address }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> A/C No. 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->ac_no }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> IFS Code 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->ifs_code }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Estimated Amount 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->estimated_amount }} </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Claimant Comments 
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->comments }} </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Linked Admin Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ @$claimant->linked_employee_data->firstname}} {{ @$claimant->linked_employee_data->lastname}} ({{ @$claimant->linked_employee_data->employee_code}}) </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Assigned Employee's Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $claimant->assigned_employee_data->firstname}} {{ $claimant->assigned_employee_data->lastname}} ({{ $claimant->assigned_employee_data->employee_code}}) </p>
                                    </dd>
                                    
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Authorize Claimant ID 
                                        </h5>
                                    </dt>
                                    

                                    <dd class="col-sm-8">

                                    <button type="button" class="btn btn-danger"  onclick="confirmDelete({{ $claimant->id }})">
                                        <i class="uil-shield-check"></i>
                                    Authorize Claimant ID</button>
                                    <form id='delete-form{{ $claimant->id }}'
                                        action="{{ route('super-admin.claimant-authorizations.update', $claimant->id) }}"
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
                    <form method="POST" id="changePasswordForm" action="{{ route('super-admin.hospitals.change-password') }}">
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
    @include('super-admin.filters.question-filter')
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
