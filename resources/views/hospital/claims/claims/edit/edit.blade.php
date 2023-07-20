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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Claims</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('hospital.claims.index') }}">Claims</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Claim</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Claim ID Edit</h4>
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
                        <li class="nav-item">
                            <a href="#claim_creation_tab" data-bs-toggle="tab" aria-expanded="true"
                                class="nav-link rounded-0 active">
                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                <span class="d-none d-md-block">Claim ID Creation / Intimation</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            @if (old('insurance_coverage', $claim->insurance_coverage) == 'Yes')
                                <a href="#insurance_policy_tab" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Insurance Policy Details</span>
                                </a>
                            @else
                                <a href="javascript:void(0)" class="nav-link rounded-0">
                                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Insurance Policy Details</span>
                                </a>
                            @endif
                        </li>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="claim_creation_tab">
                            @include('hospital.claims.claims.edit.tabs.claim-creation')
                        </div>

                        <div class="tab-pane" id="insurance_policy_tab">
                            @include('hospital.claims.claims.edit.tabs.insurance-policy')
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
            setClaimIntimationNumber();
            setMedicineOption();
            setPhysicinOptions();
            ailnessOptions();
            setAdditionalPolicy();
            setHospitalizedOption();
            setCurrentlyCovered();
            $('#addInsured').click(function() {
                $('.addInsured').toggle("slide");
            });
            $('input[name="proposer_firstname"]').change(function() {
                $('#primary_insured_firstname').val($(this).val());
            });
            $('input[name="proposer_lastname"]').change(function() {
                $('#primary_insured_lastname').val($(this).val());
            });
        });

        @if ($claim->insurance_coverage == 'Yes')
            $(document).ready(function() {
                setGroupName();
                setPrimaryInsuredAddress();
                setAdditionalPolicy();
                setCurrentlyCovered();
                setHospitalizedOption();
                calculateExpectedDays();
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
            $('#hospital_id').val(hospital).trigger('change');
            $('#hospital_id').prop('disabled', true);
            $('#registration_no').val(registrationno);
        }

        function setHospitalId() {
            var name = $("#hospital_id").select2().find(":selected").data("name");
            var address = $("#hospital_id").select2().find(":selected").data("address");
            var city = $("#hospital_id").select2().find(":selected").data("city");
            var state = $("#hospital_id").select2().find(":selected").data("state");
            var pincode = $("#hospital_id").select2().find(":selected").data("pincode");
            var associate_partner_id = $("#hospital_id").select2().find(":selected").data("ap");

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
                    $("#policy_file").prop("disabled", false);
                    $("#company_tpa_id_card_file").prop("disabled", false);
                    $(".show-hide-intimation").css('display', 'block');
                    break;
                case 'No':
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    $("#policy_file").prop("disabled", true);
                    $("#company_tpa_id_card_file").prop("disabled", true);
                    $(".show-hide-intimation").css('display', 'none');
                    break;
                default:
                    $("#policy_no").prop("readonly", true);
                    $("#company_tpa_id_card_no").prop("readonly", true);
                    $("#policy_file").prop("disabled", true);
                    $("#company_tpa_id_card_file").prop("disabled", true);
                    $(".show-hide-intimation").css('display', 'none');
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
                    $("#previous_policy_no").prop("readonly", true);
                    $("#policy_name").prop("disabled", true);
                    break;
                case 'Retail':
                    loadRetailPolicies();
                    $("#group_name").prop("readonly", true);
                    $("#previous_policy_no").prop("readonly", false);
                    $("#policy_name").prop("disabled", false);
                    break;
                default:
                    $("#group_name").prop("readonly", true);
                    $("#previous_policy_no").prop("readonly", true);
                    $("#policy_name").prop("disabled", false);
                    break;
            }
        }
    </script>
    <script>
        function loadRetailPolicies() {
            var insurance_company = $("#insurance_company").select2().find(":selected").text();
            var url = '{{ url('super-admin/get-retail-policies') }}/'+insurance_company;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#policy_name').html()
                    $('#policy_name').html(data)
                    $('#policy_name').val('{{ old('policy_name', @$claim->policy->policy_id) }}')
                    $('#policy_name').select2().trigger('change');
                }
            });
        }

        $("#insurance_company").change(function(event) {
            $("#policy_type").val('').change('');
        });
    </script>
    <script>
        function setPrimaryInsuredAddress() {
            var is_primary_insured_and_patient_same = $('#is_primary_insured_and_patient_same').val();
            var address = {!! json_encode($claim->patient->patient_current_address) !!};
            switch (is_primary_insured_and_patient_same) {
                case 'Yes':
                    $("#primary_insured_address").val(address);
                    $("#primary_insured_city").val("{{ $claim->patient->patient_current_city }}");
                    $("#primary_insured_state").val("{{ $claim->patient->patient_current_state }}");
                    $("#primary_insured_pincode").val("{{ $claim->patient->patient_current_pincode }}");
                    break;
                case 'No':
                    $("#primary_insured_address").val({{ old('primary_insured_address') }});
                    $("#primary_insured_city").val({{ old('primary_insured_city') }});
                    $("#primary_insured_state").val({{ old('primary_insured_state') }});
                    $("#primary_insured_pincode").val({{ old('primary_insured_pincode') }});
                    break;
                default:
                    $("#primary_insured_address").val({{ old('primary_insured_address') }});
                    $("#primary_insured_city").val({{ old('primary_insured_city') }});
                    $("#primary_insured_state").val({{ old('primary_insured_state') }});
                    $("#primary_insured_pincode").val({{ old('primary_insured_pincode') }});
                    break;
            }
        }
    </script>
    <script>
        function setAdditionalPolicy() {
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
            var currentlycovered = $('input[name="currently_covered"]:checked').val();
            switch (currentlycovered) {
                case 'Yes':
                    $("#commencement_date_other").prop("readonly", false);
                    $("#insurance_company_other").prop("disabled", false);
                    $("#policy_no_other").prop("readonly", false);
                    $("#sum_insured_other").prop("readonly", false);
                    break;
                case 'No':
                    $("#commencement_date_other").prop("readonly", true);
                    $("#insurance_company_other").prop("disabled", true);
                    $("#policy_no_other").prop("readonly", true);
                    $("#sum_insured_other").prop("readonly", true);
                    break;
                default:
                    $("#commencement_date_other").prop("readonly", true);
                    $("#insurance_company_other").prop("disabled", true);
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

        $(document).ready(function(){
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });

            var activeTab = localStorage.getItem('activeTab');
            if(activeTab){
                $('a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
    <script>

    function setMedicineOption(){
        var category_option = $('#system_of_medicine').val();
        switch (category_option) {
                case 'Allopathy':
                    $("#treatment_category").val("{{ old('treatment_category', @$claim->treatment_category) }}").removeAttr('disabled');
                    break;
                default:
                    $("#treatment_category").val("Non Allopathic").attr('disabled', true);
                    $("#treatment_category_id").val("Non Allopathic");
                    break;
            }
    }

</script>
<script>
    function setPhysicinOptions(){
        var category_option = $('#has_family_physician').val();
        switch (category_option) {
                case 'Yes':
                   $("#family_physician").prop("readonly", false);
                    $("#family_physician_contact_no").prop("readonly", false);
                    break;
                case 'No':
                   $("#family_physician").prop("readonly", true);
                    $("#family_physician_contact_no").prop("readonly", true);
                    break;
                default:
                     $("#family_physician").prop("readonly", false);
                      $("#family_physician_contact_no").prop("readonly", false);
                    break;
            }
    }
</script>
<script>
    function ailnessOptions(){
        var category_option = $('#chronic_illness').val();
        switch (category_option) {
                case 'Any other ailment':
                    $("#ailment_details").prop("readonly", false);
                    break;
                default:
                     $("#ailment_details").prop("readonly", true);
                    break;
            }
    }
</script>
<script>
    $(function(){
        $('#admission_date').datepicker({
            endDate: '+0d',
            autoclose: true
        });
    });

    $(function(){
        $('#start_date').datepicker({
            endDate: '+0d',
            autoclose: true
        });
    });
</script>
<script>
    function calculateExpectedDays(){
        var d1 = $('#admission_date').datepicker('getDate'),
            d2 = $('#discharge_date').datepicker('getDate'),
            diff = 0;

        if (d1 && d2) {
            diff = Math.floor((d2.getTime() - d1.getTime()) / 86400000); // ms per day
        }
        $('#days_in_hospital').val(diff);
    }
</script>
@endpush
