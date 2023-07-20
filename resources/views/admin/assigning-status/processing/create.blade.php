@extends('layouts.admin')
@section('title', 'New Assessment Status')
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
                            <li class="breadcrumb-item active">Assigning Status for Claim Processing </li>
                        </ol>
                    </div>
                    <h4 class="page-title"> Assigning Status for Claim Processing</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">  

                <div class="tab-content">
                    <div class="tab-pane show active" id="assessment_status_tab">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.assigning-claim-processing.update', $claim->id) }}"
                                    method="POST" id="pre-assessment-assign-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="pre_assessment_assign_form">
                                    <div class="form-group row">
                                        <div class="col-md-6 mt-3">
                                            <label for="patient_id">Patient ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="patient_id"
                                                name="patient_id" maxlength="60" placeholder="Enter Patient Id"
                                                value="{{ old('patient_id', @$claim->patient->uid) }}">
                                            @error('patient_id')
                                                <span id="patient-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="claim_id">Claim ID <span class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="claim_id"
                                                name="claim_id" maxlength="60" placeholder="Enter Claim Id"
                                                value="{{ old('claim_id', @$claim->uid) }}">
                                            @error('claim_id')
                                                <span id="claim-id-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                               


                                        <div class="col-md-12 mt-3">
                                            <label for="patient_firstname">Patient Name <span
                                                    class="text-danger">*</span></label>
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <select class="form-control" id="patient_title" name="patient_title">
                                                <option disabled value="">Select</option>
                                                <option disabled @if (old('patient_title', @$claim->patient->title) == 'Mr.') selected @endif
                                                    value="Mr.">Mr.</option>
                                                <option disabled @if (old('patient_title', @$claim->patient->title) == 'Ms.') selected @endif
                                                    value="Ms.">Ms.</option>
                                            </select>
                                            @error('patient_title')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_lastname" name="patient_lastname" maxlength="30"
                                                placeholder="Last name"
                                                value="{{ old('patient_lastname', @$claim->patient->lastname) }}">
                                            @error('patient_lastname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_firstname" name="patient_firstname" maxlength="15"
                                                placeholder="First name"
                                                value="{{ old('patient_firstname', @$claim->patient->firstname) }}">
                                            @error('patient_firstname')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mt-1">
                                            <input type="text" readonly maxlength="25" class="form-control"
                                                id="patient_middlename" name="patient_middlename" maxlength="30"
                                                placeholder="Middle name"
                                                value="{{ old('patient_middlename', @$claim->patient->middlename) }}">
                                            @error('patient_middlename')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_id">Hospital Id <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_id"
                                                name="hospital_id" placeholder="Enter Hospital Id"
                                                value="{{ old('hospital_id', @$claim->patient->hospital->uid) }}">
                                            @error('hospital_id')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>                     

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_name">Hospital Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ old('hospital_name', @$claim->patient->hospital->name) }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="hospital_address">Hospital Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" readonly class="form-control" id="hospital_address"
                                                name="hospital_address" placeholder="Address Line"
                                                value="{{ old('hospital_address', @$claim->patient->hospital->address) }}">
                                            @error('hospital_address')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" readonly class="form-control" id="hospital_city"
                                                name="hospital_city" placeholder="City"
                                                value="{{ old('hospital_city', @$claim->patient->hospital->city) }}">
                                            @error('hospital_city')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="text" readonly class="form-control" id="hospital_state"
                                                name="hospital_state" placeholder="State"
                                                value="{{ old('hospital_state', @$claim->patient->hospital->state) }}">
                                            @error('hospital_state')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mt-3">
                                            <input type="number" readonly class="form-control" id="hospital_pincode"
                                                name="hospital_pincode" placeholder="Pincode"
                                                value="{{ old('hospital_pincode', @$claim->patient->hospital->pincode) }}">
                                            @error('hospital_pincode')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-6 mt-3">
                                            <label for="associate_partner_id">Associate Partner ID (Name) <span
                                                    class="text-danger">*</span></label>
                                            @if($claim->hospital->associate)
                                            <input type="text" readonly class="form-control" id="associate_partner_id"
                                                name="associate_partner_id" placeholder="Associate Partner ID"
                                                value="{{ old('associate_partner_id',@$claim->hospital->associate->associate_partner_id. ' ('.@$claim->hospital->associate->name.')') }}">
                                            @else
                                            <input type="text" readonly class="form-control" id="associate_partner_id"
                                                name="associate_partner_id" placeholder="Associate Partner ID"
                                                value="N/A">
                                            @endif
                                            @error('associate_partner_id')
                                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_status">Pre-Assessment Status <span
                                                    class="text-danger"></span></label>
                                            <select disabled class="form-select final_assessment_status" id="final_assessment_status"
                                                name="final_assessment_status">
                                                @if($claim->assessmentStatus)
                                                <option>{{ $claim->assessmentStatus->pre_assessment_status }}</option>
                                                @else
                                                <option> Waiting for Assigning for Pre-Assessment </option>
                                                @endif                                                
                                            </select>
                                        </div>  


                                        <div class="col-md-6 mt-3">
                                            <label for="date_of_admission">Discharge Status Saved Date & Time <span class="text-danger">*</span></label>
                                            <input type="text" disabled class="form-control" id="date_of_admission" name="date_of_admission"
                                            value="{{ old('date_of_admission', @$claim->dischargeStatus->created_at) }}" placeholder="DD-MM-YYYY" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                                            @error('date_of_admission', 'claim-processing-form')
                                            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_status">Discharge Status <span
                                                    class="text-danger"></span></label>
                                            <select disabled class="form-select final_assessment_status" id="final_assessment_status"
                                                name="final_assessment_status">
                                                @if($claim->dischargeStatus)
                                                <option>{{ @$claim->dischargeStatus->discharge_status }}</option>
                                                @else
                                                <option> </option>
                                                @endif                                                
                                            </select>
                                        </div> 

                                        @php
                                            use Carbon\Carbon;

                                            if($claim->assigned_at && !empty($claim->assigned_at)){
                                                $startDate = Carbon::parse(@$claim->assigned_at);
                                            }else{
                                                $startDate = Carbon::parse($claim->dischargeStatus ? $claim->dischargeStatus->created_at : Carbon::now()->toDateTimeString());
                                            }                                        
                                           
                                            $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                        @endphp

                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_name">Assigning Pending TAT <span
                                                    class="text-danger"></span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ $startDate->diff($endDate)->format('%D days : %H hours : %I minutes'); }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="assign_to_claim_processing">Assign to <span
                                                    class="text-danger">*</span></label>
                                            <select @if($claim->assign_to_claim_processing) disabled @endif class="form-select" id="assign_to_claim_processing"  name="assign_to_claim_processing">
                                                <option value="">Please Select</option>
                                                @foreach($admins as $admin)
                                                <option {{ old('assign_to_claim_processing', $claim->assign_to_claim_processing) == $admin->id ? 'selected' : '' }} value="{{ $admin->id }}" >{{ $admin->employee_code.'['. $admin->name .']'  }} </option>
                                               @endforeach
                                            </select>
                                            @error('assign_to_claim_processing')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>                                                                     

                                        <div class="col-md-12 text-end mt-3">
                                            <button @if($claim->assign_to_claim_processing) disabled @endif type="submit" class="btn btn-success"
                                                form="pre-assessment-assign-form">Assign for Claim Processing
                                                </button>
                                        </div>

                                    </form>

                                    <form action="{{ route('admin.assigning-claim-processing.update', $claim->id) }}"
                                    method="POST" id="pre-assessment-re-assign-form-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="form_type" value="pre_assessment_re_assign_form">

                                    <div class="form-group row">
                                        <div class="col-md-6 mt-3">
                                            <label for="final_assessment_status">Final Assessment Status <span
                                                    class="text-danger"></span></label>
                                            <select disabled class="form-select final_assessment_status" id="final_assessment_status"
                                                name="final_assessment_status">
                                                @if(@$claim->claimProcessing->final_assessment_status)
                                                <option>{{ @$claim->claimProcessing->final_assessment_status }}</option>
                                                @else
                                                <option> </option>
                                                @endif                                                
                                            </select>
                                        </div> 

                                        @php
                                        if($claim->assigned_at_claim_processing && !empty($claim->assigned_at_claim_processing)){
                                            $startDate = Carbon::parse(@$claim->assigned_at_claim_processing);
                                        }else{
                                            $startDate = Carbon::parse(@$claim->claimProcessing->created_at);
                                        }
                                            $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                        @endphp


                                        <div class="col-md-6 mt-3">
                                            <label for="hospital_name">Final-Assessment Pending TAT <span
                                                    class="text-danger"></span></label>
                                            <input type="text" readonly class="form-control" id="hospital_name"
                                                name="hospital_name" placeholder="Enter Hospital Name"
                                                value="{{ $startDate->diff($endDate)->format('%D days : %H hours : %I minutes'); }}">
                                            @error('hospital_name')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <label for="re_assign_to_claim_processing">Re-Assign to <span
                                                    class="text-danger">*</span></label>
                                            <select @if(!$claim->assign_to_claim_processing) disabled @endif class="form-select" id="re_assign_to_claim_processing"  name="re_assign_to_claim_processing">
                                                <option value="">Please Select</option>
                                                @foreach($admins as $admin)
                                                <option {{ old('re_assign_to_claim_processing', $claim->re_assign_to_claim_processing) == $admin->id ? 'selected' : '' }} value="{{ $admin->id }}" >{{ $admin->employee_code.'['. $admin->name .']'  }} </option>
                                               @endforeach
                                            </select>
                                            @error('re_assign_to_claim_processing')
                                                <span id="name-error"
                                                    class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 text-end mt-3">
                                            <button type="submit" @if(!$claim->assign_to_claim_processing) disabled @endif class="btn btn-success"
                                                form="pre-assessment-re-assign-form-form">Re-Assign
                                                </button>
                                        </div>
                                    </div>

                                    </form>


                                    </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-12 mt-3">
                                        <label for="final_assessment_status">Status <span
                                                class="text-danger"></span></label>
                                        <select disabled class="form-select final_assessment_status" id="final_assessment_status"
                                            name="final_assessment_status">
                                            @if($claim->assign_to_claim_processing)
                                            <option>{{ @$claim->claimProcessing->final_assessment_status }}</option>
                                            @else
                                            <option> Waiting for Assigning for Final-Assessment </option>
                                            @endif                                                
                                        </select>
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

</script>
@endpush
