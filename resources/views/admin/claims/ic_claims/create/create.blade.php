@extends('layouts.admin')
@section('title', 'New Claimant')
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.claimants.index') }}">IC Claim Status</a>
                            </li>
                            <li class="breadcrumb-item active">@if(isset($icclaim_status) && !empty($icclaim_status)) Edit @else New @endif IC Claim Status </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@if(isset($icclaim_status) && !empty($icclaim_status)) Edit @else New @endif IC Claim Status </h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">


                <div class="tab-content">
                    <div class="tab-pane show active" id="icclaim_status_tab">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.icclaim-status.update', $claimant->id) }}"
                                    method="POST" id="loan-application-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="loan-application-form">
                                    <div class="form-group row">

                                        <div class="col-md-6 mt-1">
                                            <label for="claim_id">Claim ID </label>
                                            <input type="text" readonly class="form-control" id="claim_id" readonly
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$claimant->claim->uid) }}">
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-1">
                                            <label for="patient_id">Patient ID </label>
                                            <input type="text" readonly class="form-control" id="patient_id" readonly
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$claimant->patient->uid) }}">
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="firstname">Patient Name </label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select disabled class="form-control" id="title" name="title">
                                                <option value="">Please select</option>
                                                @isset($claimant->patient)
                                                    <option value="Mr."
                                                        {{ old('title', isset($claimant->patient) ? $claimant->patient->title : '') == 'Mr.' ? 'selected' : 'disabled' }}>
                                                        Mr.</option>
                                                    <option value="Ms."
                                                        {{ old('title', isset($claimant->patient) ? $claimant->patient->title : '') == 'Ms.' ? 'selected' : 'disabled' }}>
                                                        Ms.</option>
                                                @else
                                                    <option value="Mr."
                                                        {{ old('title', isset($claimant->patient) ? $claimant->patient->title : '') == 'Mr.' ? 'selected' : '' }}>Mr.
                                                    </option>
                                                    <option value="Ms."
                                                        {{ old('title', isset($claimant->patient) ? $claimant->patient->title : '') == 'Ms.' ? 'selected' : '' }}>Ms.
                                                    </option>
                                                @endisset

                                            </select>
                                            @error('title')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <input type="hidden" value="{{ old('title', isset($claimant->patient) ? $claimant->patient->title : '') }}" id="patient_title" name="title">

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control" id="lastname" name="lastname"
                                                maxlength="30" placeholder="Last name" value="{{ old('lastname',$claimant->patient->lastname) }}"
                                                @isset($claimant->patient) readonly @endisset>
                                            @error('lastname')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control" id="firstname" name="firstname"
                                                maxlength="15" placeholder="First name" value="{{ old('firstname',$claimant->patient->firstname) }}"
                                                @isset($claimant->patient) readonly @endisset>
                                            @error('firstname')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control" id="middlename" name="middlename"
                                                maxlength="30" placeholder="Middle name" value="{{ old('middlename',$claimant->patient->middlename) }}"
                                                @isset($claimant->patient) readonly @endisset>
                                            @error('middlename')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_id">Hospital ID </label>
                                            <input type="text" class="form-control" id="hospital_id" readonly
                                            name="hospital_id" placeholder="Enter Hospital Name"
                                            value="{{ old('hospital_id', @$claimant->hospital->uid) }}">
                                            @error('hospital_id')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="hospital_name" readonly
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$claimant->hospital->name) }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="associate_partner_name">Associate Partner Name </label>
                                            @if(isset($claimant->hospital->associate))
                                            <input type="text" readonly class="form-control" id="associate_partner_id"
                                                name="associate_partner_name" placeholder="Enter associate partner name"
                                                value="{{ old('associate_partner_name', '[Name: '.$claimant->hospital->associate->name.'][City: '.$claimant->hospital->associate->city. '][State: '.$claimant->hospital->associate->state.']') }}">
                                                @else
                                                <input type="text" readonly class="form-control" id="associate_partner_id"
                                                name="associate_partner_name" placeholder="Enter associate partner name"
                                                value="{{ old('associate_partner_name', '') }}">
                                                @endif
                                            @error('associate_partner_name')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="insurance_co_name">Insurance Co. Name<span
                                                    class="text-danger">*</span></label>
                                                    <input type="hidden" id="insurance_co_name_h" value="{{ old('insurance_co_name') }}" name="insurance_co_name">
                                            <select class="form-control select2" disabled id="insurance_co_name"
                                                name="insurance_co_name" data-toggle="select2">
                                                <option value="">Select IC</option>
                                                @foreach ($insurers as $insurer)
                                                    <option value="{{ $insurer->id }}"
                                                        {{ old('insurance_co_name', @$claimant->claim->policy->insurer_id) == $insurer->id ? 'selected' : 'disabled' }}>
                                                        {{ $insurer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('insurance_co_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="policy_no">Policy No. </label>
                                            <input type="text" class="form-control" id="policy_no" name="policy_no"
                                                maxlength="16" placeholder="Enter Policy No."
                                                value="{{ old('policy_no', @$claimant->claim->policy->policy_no) }}" readonly>
                                            @error('policy_no')
                                                <span id="policy-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>                                     


                                        
                                        <div class="col-md-6 mt-3">
                                            <label for="tpa_name">TPA Name </label>
                                            <input type="text" class="form-control" id="tpa_name" name="tpa_name"
                                                placeholder="Enter TPA Name"
                                                value="{{ old('tpa_name', @$claimant->claim->policy->tpa_name) }}"
                                                maxlength="75" readonly>
                                            @error('tpa_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="tpa_card_no">TPA Card No. <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly maxlength="16" class="form-control"
                                                id="tpa_card_no" placeholder="Company / TPA ID Card No."
                                                name="tpa_card_no"
                                                value="{{ old('tpa_card_no', @$claimant->claim->company_tpa_id_card_no) }}"
                                                readonly>
                                            @error('tpa_card_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>                                        

                                        <div class="col-md-6 mt-3">
                                            <label for="claim_intimation_no">Claim Intimation No.<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" maxlength="25" readonly class="form-control"
                                                id="claim_intimation_no" name="claim_intimation_no" maxlength="30"
                                                placeholder="Claim Intimation No."
                                                value="{{ old('claim_intimation_no', isset($icclaim_status) ? $claimant->claim->claim_intimation_number_mail : '') }}">
                                            @error('claim_intimation_no')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_main_claim_documents">Date of Receiving (Main Claim) Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_main_claim_documents"
                                                name="date_receiving_main_claim_documents" value="{{ old('date_receiving_main_claim_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_main_claim_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_main_claim_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_main_claim_documents_to_ic_or_tpa">Date of Dispatching (Main Claim) Documents to IC/TPA </label>
                                            <input type="text"  class="form-control" id="date_dispatching_main_claim_documents_to_ic_or_tpa"
                                                name="date_dispatching_main_claim_documents_to_ic_or_tpa" value="{{ old('date_dispatching_main_claim_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_main_claim_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_main_claim_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_pre_claim_documents">Date of Receiving (Pre Claim) Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_pre_claim_documents"
                                                name="date_receiving_pre_claim_documents" value="{{ old('date_receiving_pre_claim_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_pre_claim_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_pre_claim_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_pre_claim_documents_to_ic_or_tpa">Date of Dispatching (Pre Claim) Documents to IC/TPA</label>
                                            <input type="text"  class="form-control" id="date_dispatching_pre_claim_documents_to_ic_or_tpa"
                                                name="date_dispatching_pre_claim_documents_to_ic_or_tpa" value="{{ old('date_dispatching_pre_claim_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_pre_claim_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_pre_claim_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_post_claim_documents">Date of Receiving (Post Claim) Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_post_claim_documents"
                                                name="date_receiving_post_claim_documents" value="{{ old('date_receiving_post_claim_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_post_claim_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_post_claim_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_post_claim_documents_to_ic_or_tpa">Date of Dispatching (Post Claim) Documents to IC/TPA </label>
                                            <input type="text"  class="form-control" id="date_dispatching_post_claim_documents_to_ic_or_tpa"
                                                name="date_dispatching_post_claim_documents_to_ic_or_tpa" value="{{ old('date_dispatching_post_claim_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_post_claim_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_post_claim_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_query1_documents">Date of Receiving Query - 1 Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_query1_documents"
                                                name="date_receiving_query1_documents" value="{{ old('date_receiving_query1_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_query1_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_query1_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_query1_documents_to_ic_or_tpa">Date of Dispatching Query - 1 Documents to IC/TPA </label>
                                            <input type="text"  class="form-control" id="date_dispatching_query1_documents_to_ic_or_tpa"
                                                name="date_dispatching_query1_documents_to_ic_or_tpa" value="{{ old('date_dispatching_query1_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_query1_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_query1_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_query2_documents">Date of Receiving Query - 2 Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_query2_documents"
                                                name="date_receiving_query2_documents" value="{{ old('date_receiving_query2_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_query2_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_query2_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_query2_documents_to_ic_or_tpa">Date of Dispatching Query - 2 Documents to IC/TPA</label>
                                            <input type="text"  class="form-control" id="date_dispatching_query2_documents_to_ic_or_tpa"
                                                name="date_dispatching_query2_documents_to_ic_or_tpa" value="{{ old('date_dispatching_query2_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_query2_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_query2_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_receiving_query3_documents">Date of Receiving Query - 3 Documents </label>
                                            <input type="text"  class="form-control" id="date_receiving_query3_documents"
                                                name="date_receiving_query3_documents" value="{{ old('date_receiving_query3_documents', isset($icclaim_status) ? $icclaim_status->date_receiving_query3_documents : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_receiving_query3_documents')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_dispatching_query3_documents_to_ic_or_tpa">Date of Dispatching Query - 3 Documents to IC/TPA </label>
                                            <input type="text"  class="form-control" id="date_dispatching_query3_documents_to_ic_or_tpa"
                                                name="date_dispatching_query3_documents_to_ic_or_tpa" value="{{ old('date_dispatching_query3_documents_to_ic_or_tpa', isset($icclaim_status) ? $icclaim_status->date_dispatching_query3_documents_to_ic_or_tpa : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_dispatching_query3_documents_to_ic_or_tpa')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="ic_claim_status">IC Claim Status <span class="text-danger">*</span></label>
                                            <select class="form-select" id="ic_claim_status" name="ic_claim_status">
                                                <option value="Waiting for the Claim Documents" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Waiting for the Claim Documents' ? 'selected' : '' }}>Waiting for the Claim Documents </option>
                                                <option value="Claim Documents Dispatched to IC-TPA" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Claim Documents Dispatched to IC-TPA' ? 'selected' : '' }}>Claim Documents Dispatched to IC-TPA </option>
                                                <option value="Waiting for Query Reply from Insured" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Waiting for Query Reply from Insured' ? 'selected' : '' }}>Waiting for Query Reply from Insured </option>
                                                <option value="Query Reply Dispatched to IC-TPA" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Query Reply Dispatched to IC-TPA' ? 'selected' : '' }}>Query Reply Dispatched to IC-TPA </option>
                                                <option value="Claim Settled" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Claim Settled' ? 'selected' : '' }}>Claim Settled </option>
                                                <option value="Claim Paid" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Claim Paid' ? 'selected' : '' }}>Claim Paid </option>
                                                <option value="Claim Rejected" {{ old('ic_claim_status', @$icclaim_status->ic_claim_status) == 'Claim Rejected' ? 'selected' : '' }}>Claim Rejected </option>
                                            </select>
                                            @error('ic_claim_status', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_settlement">Date of Settlement </label>
                                            <input type="text"  class="form-control" id="date_settlement"
                                                name="date_settlement" value="{{ old('date_settlement', isset($icclaim_status) ? $icclaim_status->date_settlement : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_settlement')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="settled_amount">Settled Amount </label>
                                            <input type="number"pattern="/^-?\d+\.?\d*$/"
                                                    onKeyPress="if(this.value.length==8) return false;" onkeypress="return isNumberKey(event)" class="form-control"
                                                id="settled_amount" placeholder="Settled Amount" name="settled_amount"
                                                value="{{ old('settled_amount', isset($icclaim_status) ? $icclaim_status->settled_amount : '') }}">
                                            @error('settled_amount')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="date_disbursement">Date of Disbursement </label>
                                            <input type="text"  class="form-control" id="date_disbursement"
                                                name="date_disbursement" value="{{ old('date_disbursement', isset($icclaim_status) ? $icclaim_status->date_disbursement : '') }}" placeholder="DD/MM/YYYY"
                                                data-provide="datepicker" data-date-format="dd/mm/yyyy">
                                            @error('date_disbursement')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mt-3">
                                            <label for="ic_claim_status_comments">IC Claim Status Comments </label>
                                            <textarea class="form-control" id="ic_claim_status_comments" name="ic_claim_status_comments" maxlength="250"
                                                placeholder="IC Claim Status Comments" rows="5">{{ old('ic_claim_status_comments', isset($icclaim_status) ? $icclaim_status->ic_claim_status_comments : '') }}</textarea>
                                            @error('ic_claim_status_comments')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" class="btn btn-success"
                                                form="loan-application-form">
                                                Save IC Claim Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).on('change', '#vendor_partner_name_nbfc_or_bank', function(event) {
    event.preventDefault();
    $('#vendor_partner_id').val($(this).select2().find(":selected").data("code"));
});

if($("#applyloan").val() == 1){
         setClaimant();
}

function setClaimant() {

          $('#applyloan').val(1);
          $('#date_of_loan_application').removeAttr('disabled');
          $('#date_of_loan_disbursement').removeAttr('disabled');
          $('#time_of_loan_application').removeAttr('disabled');
          $('#date_of_loan_re_application').removeAttr('disabled');
          $('#time_of_loan_re_application').removeAttr('disabled');
          $('#loan_id_or_no').removeAttr('readonly');
          $('#loan_status').removeAttr('disabled');
          $('#loan_approved_amount').removeAttr('readonly');
          $('#loan_disbursed_amount').removeAttr('readonly');
          $('#loan_tenure').removeAttr('readonly');
          $('#loan_instalments').removeAttr('readonly');
          $('#loan_start_date').removeAttr('disabled');
          $('#loan_end_date').removeAttr('disabled');
          $('#insurance_claim_settlement_date').removeAttr('disabled');
          $('#insurance_claim_settled_amount').removeAttr('readonly');
          $('#insurance_claim_amount_disbursement_date').removeAttr('disabled');
          $('#loan_application_status_comments').removeAttr('readonly');
          $('#re_apply_loan_amount').removeAttr('readonly');
          $('#loan_re_application_status_comments').removeAttr('readonly');

}
        $('#apply_loan').on('click',function(e){
         e.preventDefault();
         setClaimant();

        });
</script>

<script>
        $(function(){

            $('#date_of_loan_application').datepicker({
                startDate: '+0d',
                autoclose: true,
            });

             $('#loan_start_date').datepicker({
                endDate: '+0d',
                autoclose: true,
            });

              $('#insurance_claim_settlement_date').datepicker({
                endDate: '+0d',
                autoclose: true,
            });

            $('#date_of_loan_re_application').datepicker({
                startDate: '+0d',
                autoclose: true,
            });

        });
    </script>

@endpush
