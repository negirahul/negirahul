@extends('layouts.associate')
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
                            <li class="breadcrumb-item"><a href="{{ route('associate-partner.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Associate Partner</h4>
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
                        <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab">
                            <li class="nav-item">
                                <a href="#home" class="nav-link active" data-bs-toggle="tab">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile" class="nav-link" data-bs-toggle="tab">Profile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="home">
                                <h5 class="card-title">Home tab content</h5>
                                <p class="card-text">Here is some example text to make up the tab's content. Replace it with your own text anytime.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h5 class="card-title">Profile tab content</h5>
                                <p class="card-text">Here is some example text to make up the tab's content. Replace it with your own text anytime.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
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
            var url = '{{ route('associate-partner.get.employees', ':department') }}';
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
            var url = '{{ route('associate-partner.get.employees', ':department') }}';
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
                    $('.linked').css('display', 'none');
                    break;
                case "Sub AP":
                    $('.linked').css('display', 'block');
                    break;
                case "Agency":
                    $('.linked').css('display', 'block');
                    break;
                default:
                    $('.linked').css('display', 'none');
                    break;
            }
        });
    </script>
@endpush
