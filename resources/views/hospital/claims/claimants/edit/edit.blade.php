@extends('layouts.hospital')
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
                            <li class="breadcrumb-item"><a href="{{ route('hospital.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claimants</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claims.index') }}">Claimants</a>
                            </li>
                            <li class="breadcrumb-item active">New Claimant</li>
                        </ol>
                    </div>
                    <h4 class="page-title">New Claimant</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        @if (@$claim->insurance_coverage == 'Yes' && @$claim->lending_required == 'Yes')
                            <li class="nav-item">
                                <a href="#claimant_creation_tab" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claimant ID Creation / Intimation</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#borrower_id_creation_tab" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Borrower ID Creation</span>
                                </a>
                            </li>
                        @endif

                        @if (@$claim->insurance_coverage == 'Yes' && @$claim->lending_required == 'No')
                            <li class="nav-item">
                                <a href="#claimant_creation_tab" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claimant ID Creation / Intimation</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#borrower_id_creation_tab" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0" disabled>
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Borrower ID Creation</span>
                                </a>
                            </li>
                        @endif

                        @if (@$claim->insurance_coverage == 'No' && @$claim->lending_required == 'Yes')
                            <li class="nav-item">
                                <a href="#claimant_creation_tab" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0" disabled>
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claimant ID Creation / Intimation</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#borrower_id_creation_tab" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Borrower ID Creation</span>
                                </a>
                            </li>
                        @endif

                        @if (@$claim->insurance_coverage == 'No' && @$claim->lending_required == 'No')
                            <li class="nav-item">
                                <a href="#claimant_no_tab" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">No Tab Found</span>
                                </a>
                            </li>
                        @endif



                    </ul>

                    <div class="tab-content">
                        @if (@$claim->insurance_coverage == 'Yes' && @$claim->lending_required == 'Yes')
                            <div class="tab-pane show active" id="claimant_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.claimant-id-creation')
                            </div>

                            <div class="tab-pane" id="borrower_id_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.borrower-id-creation')
                            </div>
                        @endif
                        @if (@$claim->insurance_coverage == 'Yes' && @$claim->lending_required == 'No')
                            <div class="tab-pane show active" id="claimant_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.claimant-id-creation')
                            </div>

                            <div class="tab-pane" id="borrower_id_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.borrower-id-creation')
                            </div>
                        @endif
                        @if (@$claim->insurance_coverage == 'No' && @$claim->lending_required == 'Yes')
                            <div class="tab-pane" id="claimant_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.claimant-id-creation')
                            </div>

                            <div class="tab-pane show active" id="borrower_id_creation_tab">
                                @include('hospital.claims.claimants.edit.tabs.borrower-id-creation')
                            </div>
                        @endif
                        @if (@$claim->insurance_coverage == 'No' && @$claim->lending_required == 'No')
                            <div class="tab-pane show active" id="claimant_no_tab">
                                @include('hospital.claims.claimants.edit.tabs.notab')
                            </div>
                        @endif
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
            setClaimIntimationNumber();
        });

        @if (@$claim->insurance_coverage == 'Yes')
            $(document).ready(function() {
                setGroupName();
                setPrimaryInsuredAddress();
                setAdditionalPolicy();
                setCurrentlyCovered();
                setHospitalizedOption();
            });
        @endif

        function setPatient() {
            var title = $("#patient_id").select2().find(":selected").data("title");
            var firstname = $("#patient_id").select2().find(":selected").data("firstname");
            var middlename = $("#patient_id").select2().find(":selected").data("middlename");
            var lastname = $("#patient_id").select2().find(":selected").data("lastname");
            var age = $("#patient_id").select2().find(":selected").data("age");
            var gender = $("#patient_id").select2().find(":selected").data("gender");
            var hospital = $("#patient_id").select2().find(":selected").data("hospital");
            var registrationno = $("#patient_id").select2().find(":selected").data("registrationno");


            $('#title').val(title);
            $('#firstname').val(firstname);
            $('#middlename').val(middlename);
            $('#lastname').val(lastname);
            $('#age').val(age);
            $('#gender').val(gender);
            $('#hospital_name').val(hospital).trigger('change');
            $('#registration_no').val(registrationno);
        }

        function setHospitalId() {
            var uid = $("#hospital_name").select2().find(":selected").data("id");
            var address = $("#hospital_name").select2().find(":selected").data("address");
            var city = $("#hospital_name").select2().find(":selected").data("city");
            var state = $("#hospital_name").select2().find(":selected").data("state");
            var pincode = $("#hospital_name").select2().find(":selected").data("pincode");
            var associate_partner_id = $("#hospital_name").select2().find(":selected").data("ap");

            $('#hospital_id').val(uid);
            $('#hospital_address').val(address);
            $('#hospital_city').val(city);
            $('#hospital_state').val(state);
            $('#hospital_pincode').val(pincode);
            $('#hospital_pincode').val(pincode);
            $('#associate_partner_id').val(associate_partner_id);
        }
    </script>
    <script>
        function setInsuranceCoverageOptions() {
            var insurance_coverage = $('#insurance_coverage').val();
            switch (insurance_coverage) {
                case 'Yes':
                    $("#policy_no").prop("readonly", false);
                    $("#company_tpa_id_card_no").prop("readonly", false);
                    $("#claim_intimation_done").prop("disabled", false);
                    break;
                case 'No':
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    $("#claim_intimation_done").prop("disabled", true);
                    break;
                default:
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    $("#claim_intimation_done").prop("disabled", true);
                    break;
            }
        }
    </script>
    <script>
        function setClaimIntimationNumber() {
            var claim_intimation_done = $('#claim_intimation_done').val();
            switch (claim_intimation_done) {
                case 'Yes':
                    $("#claim_intimation_number_mail").prop("readonly", false);
                    break;
                case 'No':
                    $("#claim_intimation_number_mail").prop("readonly", true);
                    break;
                default:
                    $("#claim_intimation_number_mail").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function setGroupName() {
            var policy_type = $('#policy_type').val();
            switch (policy_type) {
                case 'Group':
                    $("#group_name").prop("readonly", false);
                    break;
                case 'Retail':
                    $("#group_name").prop("readonly", true);
                    break;
                default:
                    $("#group_name").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function setPrimaryInsuredAddress() {
            var is_primary_insured_and_patient_same = $('#is_primary_insured_and_patient_same').val();
            var address = {!! json_encode(@$claim->patient->patient_current_address) !!};
            switch (is_primary_insured_and_patient_same) {
                case 'Yes':
                    $("#primary_insured_address").val(address);
                    $("#primary_insured_city").val("{{ @$claim->patient->patient_current_city }}");
                    $("#primary_insured_state").val("{{ @$claim->patient->patient_current_state }}");
                    $("#primary_insured_pincode").val("{{ @$claim->patient->patient_current_pincode }}");
                    break;
                case 'No':
                    $("#primary_insured_address").val("");
                    $("#primary_insured_city").val("");
                    $("#primary_insured_state").val("");
                    $("#primary_insured_pincode").val("");
                    break;
                default:
                    $("#primary_insured_address").val("");
                    $("#primary_insured_city").val("");
                    $("#primary_insured_state").val("");
                    $("#primary_insured_pincode").val("");
                    break;
            }
        }
    </script>
    <script>
        function setAdditionalPolicy() {
            $("#policy_no_additional").prop("readonly", true);
            var additional_policy = $('input[name="additional_policy"]:checked').val();
            switch (additional_policy) {
                case 'Yes':
                    $("#policy_no_additional").prop("readonly", false);
                    break;
                case 'No':
                    $("#policy_no_additional").prop("readonly", true);
                    break;
                default:
                    $("#policy_no_additional").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function setCurrentlyCovered() {
            $("#commencement_date_other").prop("readonly", true);
            $("#insurance_company_other").prop("readonly", true);
            $("#policy_no_other").prop("readonly", true);
            $("#sum_insured_other").prop("readonly", true);
            var currentlycovered = $('input[name="currently_covered"]:checked').val();
            switch (currentlycovered) {
                case 'Yes':
                    $("#commencement_date_other").prop("readonly", false);
                    $("#insurance_company_other").prop("readonly", false);
                    $("#policy_no_other").prop("readonly", false);
                    $("#sum_insured_other").prop("readonly", false);
                    break;
                case 'No':
                    $("#commencement_date_other").prop("readonly", true);
                    $("#insurance_company_other").prop("readonly", true);
                    $("#policy_no_other").prop("readonly", true);
                    $("#sum_insured_other").prop("readonly", true);
                    break;
                default:
                    $("#commencement_date_other").prop("readonly", true);
                    $("#insurance_company_other").prop("readonly", true);
                    $("#policy_no_other").prop("readonly", true);
                    $("#sum_insured_other").prop("readonly", true);
                    break;
            }
        }
    </script>
    <script>
        function setHospitalizedOption() {
            $("#admission_date_past").prop("readonly", true);
            $("#diagnosis").prop("readonly", true);
            var additional_policy = $('input[name="hospitalized"]:checked').val();
            switch (additional_policy) {
                case 'Yes':
                    $("#admission_date_past").prop("readonly", false);
                    $("#diagnosis").prop("readonly", false);
                    break;
                case 'No':
                    $("#admission_date_past").prop("readonly", true);
                    $("#diagnosis").prop("readonly", true);
                    break;
                default:
                    $("#admission_date_past").prop("readonly", true);
                    $("#diagnosis").prop("readonly", true);
                    break;
            }
        }
    </script>
@endpush
