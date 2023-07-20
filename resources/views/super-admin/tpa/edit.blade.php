@extends('layouts.super-admin')
@section('title', 'Edit Company')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Company</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Company</h4>
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
                        <form action="{{ route('super-admin.tpa.update', $tpa->id) }}" method="post" id="adminForm"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label for="company">Company Name <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-12 mt-1">
                                    <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control"
                                        id="company" name="company" maxlength="90" placeholder="Company Name"
                                        value="{{ old('company', $tpa->company) }}">
                                    @error('company')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="company">Company Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="company_type" name="company_type">
                                        <option value="">Select </option>
                                        <option value="Insurance Co." {{ old('company_type', $tpa->company_type) == 'Insurance Co.' ? 'selected' : '' }}>Insurance Co.</option>
                                        <option value="TPA" {{ old('company_type', $tpa->company_type) == 'TPA' ? 'selected' : '' }}>TPA</option>
                                        <option value="BHC" {{ old('company_type', $tpa->company_type) == 'BHC' ? 'selected' : '' }}>BHC</option>
                                        <option value="Self" {{ old('company_type', $tpa->company_type) == 'Self' ? 'selected' : '' }}>Self</option>
                                        <option value="Government" {{ old('company_type', $tpa->company_type) == 'Government' ? 'selected' : '' }}>Government</option>
                                        <option value="PSU" {{ old('company_type', $tpa->company_type) == 'PSU' ? 'selected' : '' }}>PSU</option>
                                        <option value="Private Corporate" {{ old('company_type', $tpa->company_type) == 'Private Corporate' ? 'selected' : '' }}>Private Corporate</option>
\                                </select>
                                @error('company_type')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                                

                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Hospital ID (as per the selected company) </div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Empanelled </div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Signed MoU </div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Packages and Tariff (PDF & Other Images)</div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Upload - Packages and Tariff (Excel / CSV) </div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Edit/Update - Packages and Tariff </div>
                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> 
                                    <div class="input-group" style="line-height:36px;" >
                                        Claim Form for Reimbursement
                                        <div style="margin-left: 59%;">
                                            <input type="file" name="claim_reimbursement_form" id="claim_reimbursement_form_upload" hidden onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                            <label for="claim_reimbursement_form_upload" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                            @isset($tpa->claim_reimbursement_form)
                                            <a href="{{ asset('storage/uploads/tpa/'.$tpa->id.'/'.$tpa->claim_reimbursement_form) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                            @endisset
                                            <a href="{{ route('super-admin.delete-tpa-file',['id' => $tpa->id, 'field' => 'claim_reimbursement_form']) }}" class="btn btn-warning download-label"><i class="mdi mdi-trash-can"></i></a>
                                        </div>
                                    </div> 
                                </div>

                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> 
                                    <div class="input-group" style="line-height:36px;" >
                                        Cashless Pre - Authorization Request Form
                                        <div style="margin-left: 50%;">
                                            <input type="file" name="cashless_pre_authorization_request_form" id="cashless_pre_authorization_request_form_upload" hidden onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                                            <label for="cashless_pre_authorization_request_form_upload" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i></label>
                                            @isset($tpa->cashless_pre_authorization_request_form)
                                            <a href="{{ asset('storage/uploads/tpa/'.$tpa->id.'/'.$tpa->cashless_pre_authorization_request_form) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                                            @endisset
                                            <a href="{{ route('super-admin.delete-tpa-file',['id' => $tpa->id, 'field' => 'cashless_pre_authorization_request_form']) }}" class="btn btn-warning download-label"><i class="mdi mdi-trash-can"></i></a>
                                        </div>
                                    </div> 
                                </div>

                                <div class="card-header bg-secondary text-white mt-3 show-hide-empanelment"> Negative Listing Status</div>

                                <div class="col-md-12 mt-3">
                                    <label for="comment">Hospital Empanelment Status Comments <span class="text-danger">*</span></label>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <textarea class="form-control"
                                        id="comment" name="comment" maxlength="255" rows="4" placeholder="Enter Hospital Empanelment Status Comments">{{ old('comment', $tpa->comment) }}</textarea>
                                    @error('comment')
                                        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-12 text-end mt-3">
                                    <button type="submit" class="btn btn-success" form="adminForm">Update
                                        Company</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
