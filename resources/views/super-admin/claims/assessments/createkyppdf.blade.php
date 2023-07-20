<!DOCTYPE html>
<html>
<head>
<style>
.table{
    width: 100%;
    border-spacing: 0;
}
.table-bordered {
    border: 1px solid !important;
    border-width: 1px 0 0 1px !important;
}
.table-bordered tr, .table-bordered td {
    border: 1px solid !important;
    border-width: 0 1px 1px 0 !important;
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
.text-center{
    text-align: center !important;
}
.text-end{
    text-align: right !important;
}
.float-start{
    float: left !important;
}
</style>
</head>
<body>
<div class="row">
    <table class="table table-bordered mb-0 bg-black">
        {{-- First Row --}}
        <tr>
            <td colspan="6" class="text-center">
            <h4>
                <img src="{{ 'data:image/jpeg;base64,'.base64_encode(file_get_contents(public_path('assets/images/logos/bharat-claims-logo.svg'))) }}" width="100px" class="float-start"/>
                ASSESSMENT FORM - PART - I<br>KNOW YOUR POLICY (KYP)</h4>
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
            <td colspan="2" class="cellColor w-33">Name of the Proposer/ Primary Insured</td>
            <td colspan="2" class="cellColor w-33">Relation with Primary insured</td>
            <td colspan="2" class="cellColor w-33">Patient Mobile No. / Email id</td>
        </tr>
        <tr>
            <td colspan="2" class="w-33">{{ @$claim->policy->primary_insured_firstname }} {{ @$claim->policy->primary_insured_lastname }}</td>
            <td colspan="2" class="w-33">{{  @$claim->policy->primary_insured_relation }}</td>
            <td colspan="2" class="w-33">{{ $claim->patient->phone }} / {{ $claim->patient->email }}</td>
        </tr>

        {{-- Fourth Row --}}
        <tr>
            <td colspan="2" class="cellColor w-33">Patient/ Primary Insured's Age/ Gender</td>
            <td colspan="2" class="cellColor w-33">Claimant PAN No.</td>
            <td colspan="2" class="cellColor w-33">Claimant Aadhar No.</td>
        </tr>
        <tr>
            <td colspan="2" class="w-33">{{  $claim->patient->age }} / {{  $claim->patient->gender }}</td>
            <td colspan="2" class="w-33">{{  @$claim->claimant->pan_no }}</td>
            <td colspan="2" class="w-33">{{  @$claim->claimant->aadhar_no }}</td>
        </tr>
        
        {{-- Fivth Row --}}
        <tr>
            <td colspan="2" class="cellColor w-33">Patient ID Proof</td>
            <td colspan="2" class="cellColor w-33">Patient's / Primary Insured Residential Address</td>
            <td colspan="2" class="cellColor w-33">Hospital Name & Address</td>
        </tr>
        <tr>
            <td colspan="2" class="w-33">{{  $claim->patient->id_proof }}</td>
            <td colspan="2" class="w-33">{{  $claim->patient->patient_current_address }}</td>
            <td colspan="2" class="w-33">{{  $claim->patient->hospital_name }} <br> {{  $claim->patient->hospital_address }}</td>
        </tr>
        
        {{-- Sixth Row --}}
        <tr>
            <td colspan="2" class="cellColor w-33">Policy Type (Group/ Retail)</td>
            <td colspan="2" class="cellColor w-33">Insurance Company Name</td>
            <td colspan="2" class="cellColor w-33">TPA Name</td>
        </tr>
        <tr>
            <td colspan="2" class="w-33">{{ @$claim->policy->policy_type }}</td>
            <td colspan="2" class="w-33">{{ $insurer->name }}</td>
            <td colspan="2" class="w-33">{{ $claim->policy->tpa_name }}</td>
        </tr>

        {{-- Seventh Row --}}
        <tr>
            <td class="cellColor">Policy No.</td>
            <td class="cellColor">Policy Commencement Date (without Break)</td>
            <td class="cellColor">Policy Effective/ Start Date</td>
            <td class="cellColor">Policy Expiry Date</td>
            <td class="cellColor">Date of Admission (DD-MM-YYYY)</td>
            <td class="cellColor">Date of Discharge (DD-MM-YYYY)</td>
        </tr>
        <tr>
            <td>{{ $claim->policy_no }}</td>
            <td>{{ $claim->policy->commencement_date }}</td>
            <td>{{ $claim->policy->start_date }}</td>
            <td>{{ $claim->policy->expiry_date }}</td>
            <td>{{ $claim->admission_date }}</td>
            <td>{{ $claim->discharge_date }}</td>
        </tr>
        
        {{-- Eight Row --}}
        <tr>
            <td class="cellColor">Basis Sum Insured</td>
            <td class="cellColor">Balance Sum Insured</td>
            <td class="cellColor">Co-Payment</td>
            <td class="cellColor">Sub-limit (For the ailment)</td>
            <td class="cellColor">Cumulative Bonus (CB)</td>
            <td class="cellColor">Effective Coverage</td>
        </tr>
        <tr>
            <td>{{ $claim->policy->basic_sum_insured }}</td>
            <td>{{ $claim->policy->primary_insured_balance_sum_insured }}</td>
            {{-- <td>{{ $formData->balance_sum_insured }}</td> --}}
            <td>{{ $formData->co_payment }}</td>
            <td>{{ $formData->sub_limit }}</td>
            <td>{{ $claim->policy->primary_insured_cumulative_bonus }}</td>
            {{-- <td>{{ $formData->no_claim_bonus }}</td> --}}
            <td>{{ $formData->effective_coverage }}</td>
        </tr>
        
        {{-- Ninth Row --}}
        <tr>
            <td class="cellColor">Sum Insured (Other Policy)</td>
            <td class="cellColor">Buffer Limit</td>
            <td class="cellColor">Eligible ICU/CCU Rent (per day)</td>
            <td class="cellColor">Eligible Room (per day)</td>
            <td class="cellColor">Group Name</td>
            <td class="cellColor">Claimant Official Email id</td>
        </tr>
        <tr>
            <td>{{ $claim->policy->sum_insured_other }}</td>
            <td>{{ $formData->buffer_limit }}</td>
            <td>{{ $formData->eligible_icu_ccu_rent }}</td>
            <td>{{ $formData->eligible_room }}</td>
            <td>{{ $claim->policy->group_name }}</td>
            <td>{{ $claim->claimant->official_email_id }}</td>
        </tr>

        <tr><td colspan="6"><strong><u>Declaration:</u></strong></td></tr>
        <tr><td>1</td><td colspan="5" class="p-1">I declare that my health insurance policy is ACTIVE and incase of any discrepancy in the same during the claim settlement and if my claim is denied the responsibility will remain with me to make the full approved amount payment to Bharat Claims/ Arogya Finance or the concerned NBFC/Bank.</td></tr>
        <tr><td>2</td><td colspan="5" class="p-1">I declare that Pre-Existing Disease (PED) or Pre-Existing Conditions or other conditions or habits as mentioned above is true and the same is declared by me at the time of my admission to the hospital. I am aware that the responsibility of making the approved amount payment to Bharat Claims shall remain with me in case the claim is denied by the insurance company due to Pre-Existing Conditions waiting period or Specific Diseases waiting period or due to any discrepancy in the declaration on the Pre-Existing Conditions or other conditions or habits found by them after the physical claim verification.</td></tr>
        <tr><td>3</td><td colspan="5" class="p-1">I declare that Sum Insured (SI), Balance Sum insured, Copay or Sublimit (for the saidailment) will be declared by me at the time of admission and incase the claim is fully denied or short settled by the insurance company citing the sum insured is fully or partially exhausted or limited to sublimit (for the said ai lment) or additionally deducted due to Copay or the said ailment or treatment or drug/implant or procedure or surgery is not covered under my policy then the responsibility will remain with me to make the full a roved amount a ment to Bharat Claims / Arogya Finance or the concerned NBFC/Bank.</td></tr>
        <tr><td>4</td><td colspan="5" class="p-1">I understand that any discrepancy due to declaration on all previous claims made by any member in the policy since the inception of the current policy and if the claim gets denied by the insurance company citing the same then the responsibility will remain with me to make the full approved amount payment to Bharat Claims/ Arogya Finance or the concerned NBFC/Bank.</td></tr>
        <tr><td>5</td><td colspan="5" class="p-1">I have been explained in detail about the non-medical expenses (NME's), copay, sublimit, room rent, proportionate deductions etc. by the Insurance Desk Executive and I agree that I will pay the amount as requested by the Bharat Claims Insurance Desk Team at the time of admission and any additional amount at the time of discharge.</td></tr>
        <tr><td>6</td><td colspan="5" class="p-1">I understand that the Initial Approval is only as per the initial assessment based on the information available/shared by me and the hospital. In case of any discrepancy in the information shared then the initial approval will stand nullified, and I will be treated as a cash patient and can go for reimbursement claim later.</td></tr>
    </table>
    <table class="table">
        <tr><td colspan="3"><strong>I/ we have read and clearly understood all the above terms and conditions.</strong></td></tr>
        <tr>
            <td class="w-33">
                <strong>Name & Signature of Patient/ Attender</strong><br>
                @if (!empty($formData->patient_signature))
                <img src="{{ 'data:image/jpeg;base64,'.base64_encode(file_get_contents(public_path($formData->patient_signature))) }}" width="100%"/><br>
                @endif
                <strong>Date: </strong> {{ $formData->patient_signature_date }}
            </td>
            <td class="w-33 text-center" style="vertical-align: top;">
                <strong>Relationship with the patient: </strong> {{ $formData->relation_with_patient }}
            </td>
            <td class="w-33 text-end">
                <strong>Signature of Admission Officer (Stamp of the hospital)</strong><br>
                @if (!empty($formData->officer_signature))
                <img src="{{ 'data:image/jpeg;base64,'.base64_encode(file_get_contents(public_path($formData->officer_signature))) }}" width="100%"/><br>
                @endif
                <strong>Date: </strong> {{ $formData->officer_signature_date }}
            </td>
        </tr>
        <tr><td colspan="3" class="text-center">Bharat Claims (GREEN LAVA ECO SOLUTIONS PRIVATE LIMITED)<br>
        Corporate office: 1003, DLF Corporate Greens, Sector 74A, Gurugram, HR -122018<br>
        email:info@bharatclaims.com Phone:+91 - 9990301101 Web:www.bharatclaims.com</td></tr>
    </table>            
</div>
</body>
</html>
{{-- {{ die }} --}}