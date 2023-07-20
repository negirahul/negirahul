@extends('layouts.associate')
@section('title', 'Edit Associate Partners')
@section('head')
@endsection
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Associate Partner</h4>
                </div>
            </div>
        </div>
        @include('associate.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                            <li class="nav-item">
                                <a href="#associate_partner_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Associate Partner Details</span>
                                </a>
                            </li>
                            @if ($associate->type == 'vendor')
                                <li class="nav-item">
                                    <a href="#vendor_partner_service_type" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0 ">
                                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Vendor Partner Service Type</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#vendor_partner_reports" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Reports</span>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="#sales_partner_service_type" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Sales Partner Service Type</span>
                                    </a>
                                </li>
                                <li class="nav-item" style="display:none;">
                                    <a href="#sub_sales_partner_status" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Sub-Sales Partner Status</span>
                                    </a>
                                </li>
                                <li class="nav-item" style="display:none;">
                                    <a href="#sales_partner_hospital_status" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Sales Partner Hospital Status</span>
                                    </a>
                                </li>
                                <li class="nav-item" style="display:none;">
                                    <a href="#sales_partner_claim_status" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Sales Partner Claim Status</span>
                                    </a>
                                </li>                                
                                <li class="nav-item">
                                    <a href="#sales_partner_reports" data-bs-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Reports</span>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="#sales_partner_view" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-settings-outline d-md-none d-block"></i>
                                    <span class="d-none d-md-block">View Document </span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="associate_partner_details">
                                @include('associate.associate-partners.edit.tabs.associate-partner-details')
                            </div>
                            @if ($associate->type == 'vendor')
                                <div class="tab-pane" id="vendor_partner_service_type">
                                    @include('associate.associate-partners.edit.tabs.vendor-partner-service-type')
                                </div>
                                <div class="tab-pane" id="vendor_partner_reports">
                                    @include('associate.associate-partners.edit.tabs.vendor-partner-reports')
                                </div>
                            @else
                                <div class="tab-pane" id="sales_partner_service_type">
                                    @include('associate.associate-partners.edit.tabs.sales-partner-service-type')
                                </div>
                                <div class="tab-pane" id="sub_sales_partner_status">
                                    @include('associate.associate-partners.edit.tabs.sub-sales-partner-status')
                                </div>
                                <div class="tab-pane" id="sales_partner_hospital_status">
                                    @include('associate.associate-partners.edit.tabs.sales-partner-hospital-status')
                                </div>
                                <div class="tab-pane" id="sales_partner_claim_status">
                                    @include('associate.associate-partners.edit.tabs.sales-partner-claim-status')
                                </div>                                
                                <div class="tab-pane" id="sales_partner_reports">
                                    @include('associate.associate-partners.edit.tabs.sales-partner-reports')
                                </div>                                
                            @endif
                            <div class="tab-pane" id="sales_partner_view">
                                @include('associate.associate-partners.edit.tabs.show')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
@include('associate.associate-partners.edit.script')
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
                    $('#linked_employee').val('{{ old('linked_employee', $associate->linked_employee) }}')
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
                    $('#assigned_employee').val('{{ old('assigned_employee', $associate->assigned_employee) }}')
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
        $("#mou").change(function() {
            var value = $(this).val();
            switch (value) {
                case "no":
                    document.getElementById("moufile").disabled = true;
                    break;
                case "yes":
                    document.getElementById("moufile").disabled = false;
                    break;
                default:
                    break;
            }
        });
    </script>    
@endpush
