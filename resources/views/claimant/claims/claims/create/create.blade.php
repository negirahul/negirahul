@extends('layouts.admin')
@section('title', 'New Claim')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claims</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.claims.index') }}">Claims</a>
                            </li>
                            <li class="breadcrumb-item active">New Claim</li>
                        </ol>
                    </div>
                    <h4 class="page-title">New Claim</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#claim_creation_tab" data-bs-toggle="tab" aria-expanded="true"
                                class="nav-link rounded-0 active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Claim ID Creation / Intimation</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="javascript:void(0)" aria-expanded="false"
                                class="nav-link rounded-0">
                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                <span class="d-none d-md-block">Insurance Policy Details</span>
                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="claim_creation_tab">
                            @include('admin.claims.claims.create.tabs.claim-creation')
                        </div>

                        <div class="tab-pane" id="insurance_policy_tab">
                            @include('admin.claims.claims.create.tabs.insurance-policy')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        setPatient();
        setHospitalId();
        setInsuranceCoverageOptions();
    });

    function setPatient() {
        var title               = $("#patient_id").select2().find(":selected").data("title");
        var firstname           = $("#patient_id").select2().find(":selected").data("firstname");
        var middlename          = $("#patient_id").select2().find(":selected").data("middlename");
        var lastname            = $("#patient_id").select2().find(":selected").data("lastname");
        var age                 = $("#patient_id").select2().find(":selected").data("age");
        var gender              = $("#patient_id").select2().find(":selected").data("gender");
        var hospital            = $("#patient_id").select2().find(":selected").data("hospital");
        var registrationno      = $("#patient_id").select2().find(":selected").data("registrationno");


        $('#title').val(title);
        $('#firstname').val(firstname);
        $('#middlename').val(middlename);
        $('#lastname').val(lastname);
        $('#age').val(age);
        $('#gender').val(gender);
        $('#hospital_id').val(hospital).trigger('change');
        $('#registration_no').val(registrationno);
    }

    function setHospitalId() {
        var name = $("#hospital_id").select2().find(":selected").data("name");
        var address = $("#hospital_id").select2().find(":selected").data("address");
        var city = $("#hospital_id").select2().find(":selected").data("city");
        var state = $("#hospital_id").select2().find(":selected").data("state");
        var pincode = $("#hospital_id").select2().find(":selected").data("pincode");
        var associate_partner_id = $("#hospital_id").select2().find(":selected").data("ap");
        console.log(address);
        $('#hospital_name').val(name);
        $('#hospital_address').val(address);
        $('#hospital_city').val(city);
        $('#hospital_state').val(state);
        $('#hospital_pincode').val(pincode);
        $('#hospital_pincode').val(pincode);
        $('#associate_partner_id').val(associate_partner_id);
    }
</script>
<script>
    function setInsuranceCoverageOptions(){
        var insurance_coverage = $('#insurance_coverage').val();
        switch (insurance_coverage) {
                case 'Yes':
                    $("#policy_no").prop("readonly", false);
                    $("#company_tpa_id_card_no").prop("readonly", false);
                    break;
                case 'No':
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    break;
                default:
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    break;
            }
    }
</script>
@endpush
