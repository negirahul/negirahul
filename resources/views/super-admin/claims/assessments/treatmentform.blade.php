@extends('layouts.super-admin')
@section('title', 'KNOW YOUR POLICY (KYP)')
@section('content')
<!-- Start Content-->
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">KNOW YOUR POLICY (KYP)</h4>
        </div>
    </div>
</div>
@include('super-admin.sections.flash-message')
<!-- end page title -->

<!-- start page content -->
<style>
.table-bordered {
    border: 1px solid !important;
}
tbody td {
    font-size: 12px !important;
    border-bottom-width: 0 !important;
    padding: 10px !important;
}
.cellColor{
    background: #b4c6e7 !important;
    font-weight: bolder;
}
.w-33{
    width: 33.3% !important;
}
</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card no-shadow">
            <div class="card-body">
                <div class="">
                    {{-- <pre>
                        {{ print_r($claim) }}
                    </pre> --}}
                    {{-- {{phpinfo()}} --}}
                    <form action="{{ route('super-admin.assessment-status.saveparttwo') }}" method="post" id="claim-form" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-bordered mb-0">
                        {{-- First Row --}}
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4><img src="{{ asset('assets/images/logos/bharat-claims-logo.svg') }}" width="100px" class="float-start">
                                    ASSESSMENT FORM - PART - II<br>TREATMENT DETAILS</h4>
                            </td>
                        </tr>
                        
                        {{-- Second Row --}}
                        <tr>
                            <td colspan="2" class="cellColor w-33">Claim UID on KYP Form</td>
                            <td colspan="2" class="cellColor w-33">Hospital IPD/ UHID No</td>
                            <td colspan="2" class="cellColor w-33">Patient Name</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="w-33">{{ $claim->uid }}</td>
                            <td colspan="2" class="w-33">{{ $claim->hospital->uid }} / {{ $claim->patient->hospital_name }}</td>
                            <td colspan="2" class="w-33">{{ $claim->patient->title }} {{ $claim->patient->firstname }} {{ $claim->patient->middlename }} {{ $claim->patient->lastname }}</td>
                        </tr>

                        {{-- Third Row --}}
                        <tr>
                            <td colspan="2" class="cellColor w-33">Name of the Treating Doctor and Registration</td>
                            <td colspan="2" class="cellColor w-33">Policy No.</td>
                            <td class="cellColor">Date of Admission (DD-MM-YYYY)</td>
                            <td class="cellColor">Date of Discharge (DD-MM-YYYY)</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="w-33">{{ $doctor->doctors_firstname }} {{ $doctor->doctors_lastname }} / {{ $doctor->registration_no }}</td>
                            <td colspan="2" class="w-33">{{  $claim->policy_no }}</td>
                            <td>{{ $claim->admission_date }}</td>
                            <td>{{ $claim->discharge_date }}</td>
                        </tr>
                        
                        <tr><td colspan="6"><strong>Provisional Diagnosis Details:</strong></td></tr>
                        {{-- Fourth Row --}}
                        <tr>
                            <td class="cellColor">Estimated Hospital Bill Amount (INR):</td>
                            <td class="cellColor">Disease Name</td>
                            <td class="cellColor">Treatment Category</td>
                            <td colspan="3" class="cellColor">Duration of the Present Ailment and any treatment taken for the same/past:</td>
                        </tr>
                        <tr>
                            <td>{{ $claim->estimated_amount }}</td>
                            <td>{{ $claim->disease_name }}</td>
                            <td>{{ $claim->treatment_category }}</td>
                            <td colspan="3"><input type="text" name="present_ailment_duration" value="@if(!empty($formData->present_ailment_duration)) {{ $formData->present_ailment_duration }} @endif" class="form-control form-control-sm"></td>
                        </tr>

                        <tr>
                            <td colspan="6">
                                <div class="row g-3 align-items-center">
                                    <div class="col-3"><label class="col-form-label"><strong>Past history of any chronic illness:</strong> </label></div>
                                    <?php 
                                    if($claim->chronic_illness == 'N/A')
                                    $pastHitory = 'No';
                                    else
                                    $pastHitory = 'Yes';

                                    if(!empty($formData->pastHitory))
                                    $pastHitory = 'Yes';
                                    ?>
                                    <div class="col-2"><input type="text" name="pastHitory" value="{{ $pastHitory }}" class="form-control form-control-sm" placeholder="Yes / No"></div>
                                </div>
                            </td>
                        </tr>
                        {{-- Fivth Row --}}
                        <tr>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Diabetes" id="Diabetes" 
                                    @if(!empty($formData->Diabetes)) @if($formData->Diabetes == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Diabetes') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Diabetes"><strong>Diabetes</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="HTN" id="HTN" 
                                    @if(!empty($formData->HTN)) @if($formData->HTN == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='HTN') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="HTN"><strong>HTN</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Alcohol" id="Alcohol" 
                                    @if(!empty($formData->Alcohol)) @if($formData->Alcohol == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Alcohol or Drug Abuse') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Alcohol"><strong>Alcohol</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Smoking" id="Smoking" 
                                    @if(!empty($formData->Smoking)) @if($formData->Smoking == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Smoking') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Smoking"><strong>Smoking</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Drug" id="Drug" 
                                    @if(!empty($formData->Drug)) @if($formData->Drug == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Alcohol or Drug Abuse') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Drug"><strong>Drug Abuse</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Heart" id="Heart" 
                                    @if(!empty($formData->Heart)) @if($formData->Heart == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Heart') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Heart"><strong>Heart Condition</strong></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="month" name="DiabetesDate" value="@if(!empty($formData->DiabetesDate)){{ $formData->DiabetesDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="HTNDate" value="@if(!empty($formData->HTNDate)){{ $formData->HTNDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="AlcoholDate" value="@if(!empty($formData->AlcoholDate)){{ $formData->AlcoholDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="SmokingDate" value="@if(!empty($formData->SmokingDate)){{ $formData->SmokingDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="DrugDate" value="@if(!empty($formData->DrugDate)){{ $formData->DrugDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="HeartDate" value="@if(!empty($formData->HeartDate)){{ $formData->HeartDate }}@endif" class="form-control form-control-sm"></td>
                        </tr>

                        {{-- Sixth Row --}}
                        <tr>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Kidney" id="Kidney" 
                                    @if(!empty($formData->Kidney)) @if($formData->Kidney == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Kidney') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Kidney"><strong>Kidney Condition</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Liver" id="Liver" 
                                    @if(!empty($formData->Liver)) @if($formData->Liver == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Liver') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Liver"><strong>Liver Condition</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Arthritis" id="Arthritis" 
                                    @if(!empty($formData->Arthritis)) @if($formData->Arthritis == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Arthritis') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Arthritis"><strong>Arthritis Condition</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Neuro" id="Neuro" 
                                    @if(!empty($formData->Neuro)) @if($formData->Neuro == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Neuro') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Neuro"><strong>Neuro Condition</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Hear" id="Hear" 
                                    @if(!empty($formData->Hear)) @if($formData->Hear == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Hear Disease') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Hear"><strong>Hear Disease</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Hypertension" id="Hypertension" 
                                    @if(!empty($formData->Hypertension)) @if($formData->Hypertension == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Hypertension') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Hypertension"><strong>Hypertension</strong></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="month" name="KidneyDate" value="@if(!empty($formData->KidneyDate)){{ $formData->KidneyDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="LiverDate" value="@if(!empty($formData->LiverDate)){{ $formData->LiverDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="ArthritisDate" value="@if(!empty($formData->ArthritisDate)){{ $formData->ArthritisDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="NeuroDate" value="@if(!empty($formData->NeuroDate)){{ $formData->NeuroDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="HearDate" value="@if(!empty($formData->HearDate)){{ $formData->HearDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="HypertensionDate" value="@if(!empty($formData->HypertensionDate)){{ $formData->HypertensionDate }}@endif" class="form-control form-control-sm"></td>
                        </tr>

                        {{-- Seventh Row --}}
                        <tr>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Hyperlipidaemias" id="Hyperlipidaemias" 
                                    @if(!empty($formData->Hyperlipidaemias)) @if($formData->Hyperlipidaemias == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Hyperlipidaemias') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Hyperlipidaemias"><strong>Hyperlipidaemias</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Osteoarthritis" id="Osteoarthritis" 
                                    @if(!empty($formData->Osteoarthritis)) @if($formData->Osteoarthritis == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Osteoarthritis') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Osteoarthritis"><strong>Osteoarthritis</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Asthma" id="Asthma" 
                                    @if(!empty($formData->Asthma)) @if($formData->Asthma == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Asthma-COPD-Bronchitis') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Asthma"><strong>Asthma-COPD-Bronchitis</strong></label>
                                </div>
                            </td>
                            <td class="cellColor">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="Cancer" id="Cancer" 
                                    @if(!empty($formData->Cancer)) @if($formData->Cancer == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Cancer') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="Cancer"><strong>Cancer</strong></label>
                                </div>
                            </td>
                            <td class="cellColor" colspan="2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" value="yes" name="HIV" id="HIV" 
                                    @if(!empty($formData->HIV)) @if($formData->HIV == 'yes') @checked(true) @endif 
                                    @else @if($claim->chronic_illness=='Any HIV or STD related ailments') @checked(true) @endif @endif>
                                    <label class="form-check-label" for="HIV"><strong>Any HIV or STD related ailments</strong></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="month" name="HyperlipidaemiasDate" value="@if(!empty($formData->HyperlipidaemiasDate)){{ $formData->HyperlipidaemiasDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="OsteoarthritisDate" value="@if(!empty($formData->OsteoarthritisDate)){{ $formData->OsteoarthritisDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="AsthmaDate" value="@if(!empty($formData->AsthmaDate)){{ $formData->AsthmaDate }}@endif" class="form-control form-control-sm"></td>
                            <td><input type="month" name="CancerDate" value="@if(!empty($formData->CancerDate)){{ $formData->CancerDate }}@endif" class="form-control form-control-sm"></td>
                            <td colspan="2"><input type="month" name="HIVDate" value="@if(!empty($formData->HIVDate)){{ $formData->HIVDate }}@endif" class="form-control form-control-sm"></td>
                        </tr>
                        </tr>
                            <td class="cellColor" colspan="6"><strong>Any other ailment details</strong></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <div class="col-10"><textarea name="Any_other_ailment" class="form-control form-control-sm" placeholder="Enter Details">@if(!empty($formData->Any_other_ailment)) {{ $formData->Any_other_ailment }} @endif</textarea></div>
                                    <div class="col-2"><input type="month" name="Any_other_ailment_Date" value="@if(!empty($formData->Any_other_ailment_Date)){{ $formData->Any_other_ailment_Date }}@endif" class="form-control form-control-sm"></div>
                                </div>
                            </td>
                        </tr>


                        <tr><td colspan="6"><strong><u>Terms and Conditions:</u></strong></td></tr>
                        <tr><td>1</td><td colspan="5" class="p-1">I am aware that I am admitted to the hospital as cash patient.</td></tr>
                        <tr><td>2</td><td colspan="5" class="p-1">I have been explained in detail about the Reimbursement Claim Financing Facility provided by Bharat Claims. I undertake not to hold the hospital responsible for any delay in getting approval or extensions from Bharat Claims Team. I understand that the Turn Around Time (TAT) for Final Discharge is 4 Hours from Bharat Claims and in case of any query the same process will take additional time. I am fully aware that the approval will purely depend on terms and conditions of my insurance policy and Hospital / Bharat Claims will not be responsible for the same.</td></tr>
                        <tr><td>3</td><td colspan="5" class="p-1">I have understood that such approvals are my responsibility, and the hospital renders these services as value addition only.</td></tr>
                        <tr><td>4</td><td colspan="5" class="p-1">I will hand over all necessary documents like PAN Card, Aadhar Card, Cancelled cheque etc. or any other KYC documents as per RBI guidelines to the Bharat Claims Team at the time of admission at the Hospital.</td></tr>
                        <tr><td>5</td><td colspan="5" class="p-1">I shall pay all bills related to exclusions as stated by the Bharat Claims Team, like consumables, co-pay, admission charges, food etc. to the Hospital. Further I understand that any bill amount over and above the Approved Amount by Bharat Claims shall be paid to the hospital at the time of discharge.</td></tr>
                        <tr><td>6</td><td colspan="5" class="p-1">I am aware that the original reports, original discharge summary, reports, final bill and payment receipts are handed over to the Insurance Co/ Third Party Administrator (TPA) by Bharat Claims after discharge.</td></tr>
                        <tr><td>7</td><td colspan="5" class="p-1">I/my proposer agree/s to fill the reimbursement claim form of TPA/Insurance company and also complete the e-agreement and e-nach process to complete the discharge which requires the use of me/my proposer's Net Banking I Debit card details on the banking portal through the enach portal.</td></tr>
                        <tr><td>8</td><td colspan="5" class="p-1">I understand that if for any reason I/my proposer chose not to fill the reimbursement claim form of TPA/Insurance co. or do/does not complete the e-nach process, in that case, I will be considered as Cash Patient and all hospital expenses required to be paid by me to the hospital directly to complete the discharge.</td></tr>
                        <tr><td>9</td><td colspan="5" class="p-1">I authorize Bharat Claims team to coordinate with my Insurance Co/TPA on behalf of me for claim settlement process. I shall keep the Bharat Claims team updated on all communications received from the insurance Co./ TPA on the WhatsApp group till the completion of claim settlement process.</td></tr>
                        <tr><td>10</td><td colspan="5" class="p-1">I am aware that the approved amount is a loan financed on the basis of my insurance policy and the same must be returned to the lender once the claim is reimbursed from the insurance company.</td></tr>
                        <tr><td>11</td><td colspan="5" class="p-1">I am aware that Bharat Claims will not be liable for any outcome of the medical treatment.</td></tr>
                    </table>
                    <table class="table">
                        <tr><td colspan="3"><strong>I/ we have read and clearly understood all the above terms and conditions.</strong></td></tr>
                        <tr>
                            <td class="w-33">
                                <strong>Name & Signature of Patient/ Attender</strong><br>
                                @if (!empty($formData->patient_signature))
                                <img src="{{ asset($formData->patient_signature) }}" width="100%"/><br>
                                @endif
                                <input type="file" name="patient_signature" class="form-control-file"><br><br>
                                <div class="row g-3 align-items-center">
                                    <div class="col-2"><label class="col-form-label"><strong>Date:</strong> </label></div>
                                    <div class="col-6"><input type="text" name="patient_signature_date" value="@if(!empty($formData->patient_signature_date)) {{ $formData->patient_signature_date }} @endif" class="form-control" data-provide="datepicker"></div>
                                </div>
                            </td>
                            <td class="w-33">
                                <div class="row g-3 align-items-center">
                                    <div class="col-6"><label class="col-form-label"><strong>Relationship with the patient:</strong> </label></div>
                                    <div class="col-6"><input type="text" name="relation_with_patient" value="@if(!empty($formData->relation_with_patient)) {{ $formData->relation_with_patient }} @endif" class="form-control form-control-sm"></div>
                                </div>
                            </td>
                            <td class="w-33">
                                <strong>Signature of Admission Officer (Stamp of the hospital)</strong><br>
                                @if (!empty($formData->officer_signature))
                                <img src="{{ asset($formData->officer_signature) }}" width="100%"/><br>
                                @endif
                                <input type="file" name="officer_signature" class="form-control-file" name="signature"><br><br>
                                <div class="row g-3 align-items-center">
                                    <div class="col-2"><label class="col-form-label"><strong>Date:</strong> </label></div>
                                    <div class="col-6"><input type="text" name="officer_signature_date" value="@if(!empty($formData->officer_signature_date)) {{ $formData->officer_signature_date }} @endif" class="form-control form-control-sm" data-provide="datepicker"></div>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="3" class="text-center">Bharat Claims (GREEN LAVA ECO SOLUTIONS PRIVATE LIMITED)<br>
                            Corporate office: 1003, DLF Corporate Greens, Sector 74A, Gurugram, HR -122018<br>
                            email:info@bharatclaims.com Phone:+91 - 9990301101 Web:www.bharatclaims.com</td></tr>
                    </table>
                    <div class="d-flex justify-content-between">
                        <input type="hidden" name="claim_id" value="{{ $claim->id }}"/>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        @if(!empty($formData))
                        <a class="btn btn-success" href="{{ route('super-admin.assessment-status.createtreatmentPDF', ['claim_id' => $claim->id]) }}">Download</a>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->

</div> <!-- container -->

@endsection
{{-- @push('filter')
    @include('super-admin.filters.question-filter')
@endpush --}}
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',text: "You won't be able to revert this!",icon: 'warning',showCancelButton: true,confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
@endpush
