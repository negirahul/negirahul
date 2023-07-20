@extends('layouts.super-admin')
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
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pending for Hospital Empanelment Status Authorization </li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pending for Hospital Empanelment Status </h4>
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
                                        <h5 class="card-title">  Hospital ID  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->hospital->uid }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Hospital Name  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->hospital->name }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Company Name  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->company->company }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Company Type  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->company_type }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Empanelled  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->empanelled }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Hospital ID (as per the selected company)  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->hospital_id_as_per_the_selected_company }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Signed MoU  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->signed_mou }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Agreed Packages and Tariff (PDF & Other Images)  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->agreed_packages_and_tariff_pdf_other_images }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Upload - Packages and Tariff (Excel / CSV)  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->upload_packages_and_tariff_excel_or_csv }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Edit/Update - Packages and Tariff  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->agreed_packages_and_tariff_pdf_other_images }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-12">
                                        <h5 class="card-title">  Claim Form for Reimbursement  </h5>
                                    </dt>
                                    <dt class="col-sm-12">
                                        <h5 class="card-title">  Cashless Pre - Authorization Request Form  </h5>
                                    </dt>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Negative Listing Status  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->negative_listing_status }} 
                                        </p>
                                    </dd>
                                    <dt class="col-sm-4">
                                        <h5 class="card-title">  Hospital Empanelment Status Comments  </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->hospital_empanelment_status_comments }} 
                                        </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Linked Admin Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->linked_employee_data->firstname}} {{ $hospital_empanelment->linked_employee_data->lastname}} ({{ $hospital_empanelment->linked_employee_data->employee_code}}) </p>
                                    </dd>

                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> 
                                            Assigned Employee's Name & ID
                                        </h5>
                                    </dt>
                                    <dd class="col-sm-8">
                                        <p class="card-text">: {{ $hospital_empanelment->assigned_employee_data->firstname}} {{ $hospital_empanelment->assigned_employee_data->lastname}} ({{ $hospital_empanelment->assigned_employee_data->employee_code}}) </p>
                                    </dd>
                                    
                                    <dt class="col-sm-4">
                                        <h5 class="card-title"> Authorize Hospital ID </h5>
                                    </dt>
                                    <dd class="col-sm-8">

                                    <button type="button" class="btn btn-danger"  onclick="confirmDelete({{ $hospital_empanelment->id }})">
                                        <i class="uil-shield-check"></i>
                                    Hospital Empanelment Status Authorize</button>
                                    <form id='delete-form{{ $hospital_empanelment->id }}'
                                        action="{{ route('super-admin.hospital-authorizations.update', $hospital_empanelment->id) }}"
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
