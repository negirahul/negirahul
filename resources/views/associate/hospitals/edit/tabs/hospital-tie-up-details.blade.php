<form action="{{ route('associate-partner.hospitals.tie-ups', $hospital->id) }}" method="post" id="hospital-tie-up-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-12 mt-3">
            <label for="mou_inception_date">MoU Inception Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" @if($hospital->signed_mous_file) disabled @endif id="mou_inception_date" name="mou_inception_date"
                placeholder="Enter MoU Inception Date" value="{{ old('mou_inception_date', $hospital_tie_ups->mou_inception_date ?? '') }}">
            @error('mou_inception_date')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="bhc_packages_for_surgical_procedures_accepted">BHC Packages for Surgical Procedures Accepted <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="bhc_packages_for_surgical_procedures_accepted" name="bhc_packages_for_surgical_procedures_accepted">
                <option value="">Select</option>
                <option value="Yes" {{ old('bhc_packages_for_surgical_procedures_accepted', $hospital_tie_ups->bhc_packages_for_surgical_procedures_accepted ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('bhc_packages_for_surgical_procedures_accepted', $hospital_tie_ups->bhc_packages_for_surgical_procedures_accepted ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            <input type="file" name="bhc_packages_for_surgical_procedures_accepted_file" @if($hospital_tie_ups->bhc_packages_for_surgical_procedures_accepted == 'No') disabled @endif id="bhc_packages_for_surgical_procedures_accepted_file" hidden />
            <label for="bhc_packages_for_surgical_procedures_accepted_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
            </div>
            @error('bhc_packages_for_surgical_procedures_accepted')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('bhc_packages_for_surgical_procedures_accepted_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="discount_on_medical_management_cases">Discount on Medical Management Cases <span class="text-danger">*</span></label>
            <select class="form-select" id="discount_on_medical_management_cases" name="discount_on_medical_management_cases">
                <option value="">Select</option>
                <option value="Yes" {{ old('discount_on_medical_management_cases', $hospital_tie_ups->discount_on_medical_management_cases?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('discount_on_medical_management_cases', $hospital_tie_ups->discount_on_medical_management_cases?? '') == 'No' ? 'selected' : '' }}>No</option>
            </select>
            @error('discount_on_medical_management_cases')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-field">
            <label for="discount_on_final_bill">Discount on final bill % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="discount_on_final_bill" name="discount_on_final_bill"
                placeholder="Enter Discount on final bill %" value="{{ old('discount_on_final_bill', $hospital_tie_ups->discount_on_final_bill??'') }}">
            @error('discount_on_final_bill')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-field">
            <label for="discount_on_room_rent">Discount on room rent % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="discount_on_room_rent" name="discount_on_room_rent"
                placeholder="Enter Discount on final bill %" value="{{ old('discount_on_room_rent', $hospital_tie_ups->discount_on_room_rent??'') }}">
            @error('discount_on_room_rent')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-field">
            <label for="discount_on_medicines">Discount on medicines % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="discount_on_medicines" name="discount_on_medicines"
                placeholder="Enter Discount on medicines % " value="{{ old('discount_on_medicines', $hospital_tie_ups->discount_on_medicines??'') }}">
            @error('discount_on_medicines')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-field">
            <label for="discount_on_consumables">Discount on consumables % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="discount_on_consumables" name="discount_on_consumables"
                placeholder="Enter Discount on consumables %" value="{{ old('discount_on_consumables', $hospital_tie_ups->discount_on_consumables??'') }}">
            @error('discount_on_consumables')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="referral_commission_offered">Referral Commission Offered <span class="text-danger">*</span></label>
            <select class="form-select" id="referral_commission_offered" name="referral_commission_offered">
                <option value="">Select</option>
                <option value="Yes" {{ old('referral_commission_offered', $hospital_tie_ups->referral_commission_offered??'') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('referral_commission_offered', $hospital_tie_ups->referral_commission_offered??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('referral_commission_offered')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3 show-hide-referral">
            <label for="referral">Referral % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="referral" name="referral"
                placeholder="Enter Referral % " value="{{ old('referral', $hospital_tie_ups->referral??'') }}">
            @error('referral')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="claimstag_usage_services">ClaimStag Usage Services <span class="text-danger">*</span></label>
            <select class="form-select" id="claimstag_usage_services" name="claimstag_usage_services">
                <option value="">Select</option>
                <option value="Monthly" {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'Monthly' ? 'selected' : '' }}>Monthly
                </option>
                <option value="Half Yearly"
                    {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'Half Yearly' ? 'selected' : '' }}>Half Yearly
                </option>
                <option value="Quarterly" {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'Quarterly' ? 'selected' : '' }}>Quarterly
                </option>
                <option value="Yearly" {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'Yearly' ? 'selected' : '' }}>Yearly
                </option>
                <option value="Pre Use" {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'Pre Use' ? 'selected' : '' }}>Pre Use
                </option>
                <option value="No" {{ old('claimstag_usage_services', $hospital_tie_ups->claimstag_usage_services??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('claimstag_usage_services')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="claimstag_installation_charges">ClaimStag Installation Charges (One Time Payment) <span
                    class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" class="form-control" id="claimstag_installation_charges" name="claimstag_installation_charges"
                placeholder="Enter ClaimStag Installation Charges (One Time Payment) " value="{{ old('claimstag_installation_charges', $hospital_tie_ups->claimstag_installation_charges??'') }}">
            </div>
            @error('claimstag_installation_charges')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="claimstag_usage_charges">ClaimStag Usage Charges <span
                    class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" class="form-control" id="claimstag_usage_charges" name="claimstag_usage_charges"
                placeholder="Enter ClaimStag Usage Charges" value="{{ old('claimstag_usage_charges', $hospital_tie_ups->claimstag_usage_charges??'') }}">
            </div>
            @error('claimstag_usage_charges')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="claims_reimbursement_insured_services">ClaimStag Usage Services <span class="text-danger">*</span></label>
            <select class="form-select" id="claims_reimbursement_insured_services" name="claims_reimbursement_insured_services">
                <option value="">Select</option>
                <option value="Monthly" {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'Monthly' ? 'selected' : '' }}>Monthly
                </option>
                <option value="Half Yearly"
                    {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'Half Yearly' ? 'selected' : '' }}>Half Yearly
                </option>
                <option value="Quarterly" {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'Quarterly' ? 'selected' : '' }}>Quarterly
                </option>
                <option value="Yearly" {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'Yearly' ? 'selected' : '' }}>Yearly
                </option>
                <option value="Pre Use" {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'Pre Use' ? 'selected' : '' }}>Pre Use
                </option>
                <option value="No" {{ old('claims_reimbursement_insured_services', $hospital_tie_ups->claims_reimbursement_insured_services??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('claims_reimbursement_insured_services')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="claims_reimbursement_insured_service_charges">Claims Reimbursement - Insured Service Charges <span
                    class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" class="form-control" id="claims_reimbursement_insured_service_charges" name="claims_reimbursement_insured_service_charges"
                placeholder="Enter Claims Reimbursement - Insured Service Charges" value="{{ old('claims_reimbursement_insured_service_charges', $hospital_tie_ups->claims_reimbursement_insured_service_charges??'') }}">
            </div>
            @error('claims_reimbursement_insured_service_charges')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="cashless_claims_management_services">Cashless Claims Management Services <span class="text-danger">*</span></label>
            <select class="form-select" id="cashless_claims_management_services" name="cashless_claims_management_services">
                <option value="">Select</option>
                <option value="Monthly" {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'Monthly' ? 'selected' : '' }}>Monthly
                </option>
                <option value="Half Yearly"
                    {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'Half Yearly' ? 'selected' : '' }}>Half Yearly
                </option>
                <option value="Quarterly" {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'Quarterly' ? 'selected' : '' }}>Quarterly
                </option>
                <option value="Yearly" {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'Yearly' ? 'selected' : '' }}>Yearly
                </option>
                <option value="Pre Use" {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'Pre Use' ? 'selected' : '' }}>Pre Use
                </option>
                <option value="No" {{ old('cashless_claims_management_services', $hospital_tie_ups->cashless_claims_management_services??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('cashless_claims_management_services')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="cashless_claims_management_services_charges">Claims Reimbursement - Insured Service Charges <span
                    class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" class="form-control" id="cashless_claims_management_services_charges" name="cashless_claims_management_services_charges"
                placeholder="Enter Claims Reimbursement - Insured Service Charges" value="{{ old('cashless_claims_management_services_charges', $hospital_tie_ups->cashless_claims_management_services_charges??'') }}">
            </div>
            @error('cashless_claims_management_services_charges')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="lending_finance_company_agreement">Lending / Finance Company's Agreement <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="lending_finance_company_agreement" name="lending_finance_company_agreement">
                <option value="">Select</option>
                <option value="Yes" {{ old('lending_finance_company_agreement', $hospital_tie_ups->lending_finance_company_agreement ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('lending_finance_company_agreement', $hospital_tie_ups->lending_finance_company_agreement ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            <input type="file" name="lending_finance_company_agreement_file" @if($hospital_tie_ups->lending_finance_company_agreement == 'No') disabled @endif id="lending_finance_company_agreement_file" hidden />
            <label for="lending_finance_company_agreement_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
            </div>
            @error('lending_finance_company_agreement')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('lending_finance_company_agreement_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="lending_finance_company_agreement_date">Lending / Finance Company's Agreement Date <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="lending_finance_company_agreement_date" name="lending_finance_company_agreement_date"
                placeholder="Enter Lending / Finance Company's Agreement Date" value="{{ old('lending_finance_company_agreement_date', $hospital_tie_ups->lending_finance_company_agreement_date??'') }}">
            @error('lending_finance_company_agreement_date')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="medical_lending_for_patients">Medical Lending for Patients <span class="text-danger">*</span></label>
            <select class="form-select" id="medical_lending_for_patients" name="medical_lending_for_patients">
                <option value="">Select</option>
                <option value="Yes" {{ old('medical_lending_for_patients', $hospital_tie_ups->medical_lending_for_patients??'') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('medical_lending_for_patients', $hospital_tie_ups->medical_lending_for_patients??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('medical_lending_for_patients')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="medical_lending_service_type">Medical Lending Service Type <span class="text-danger">*</span></label>
            <select class="form-select" id="medical_lending_service_type" name="medical_lending_service_type">
                <option value="">Select</option>
                <option value="Bridge" {{ old('medical_lending_service_type', $hospital_tie_ups->medical_lending_service_type ??'') == 'Bridge' ? 'selected' : '' }}>Bridge
                </option>
                <option value="Term"
                    {{ old('medical_lending_service_type', $hospital_tie_ups->medical_lending_service_type ??'') == 'Term' ? 'selected' : '' }}>Term
                </option>
                <option value="Both"
                    {{ old('medical_lending_service_type', $hospital_tie_ups->medical_lending_service_type ??'') == 'Both' ? 'selected' : '' }}>Both
                </option>
            </select>
            @error('medical_lending_service_type')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="subvention">Subvention % <span
                    class="text-danger">*</span></label>
            <input type="number" class="form-control" id="subvention" name="subvention"
                placeholder="Enter " value="{{ old('subvention', $hospital_tie_ups->subvention??'') }}">
            @error('subvention')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="medical_lending_for_bill_invoice_discounting">Medical Lending for Bill/ Invoice Discounting <span class="text-danger">*</span></label>
            <select class="form-select" id="medical_lending_for_bill_invoice_discounting" name="medical_lending_for_bill_invoice_discounting">
                <option value="">Select</option>
                <option value="Yes" {{ old('medical_lending_for_bill_invoice_discounting', $hospital_tie_ups->medical_lending_for_bill_invoice_discounting??'') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('medical_lending_for_bill_invoice_discounting', $hospital_tie_ups->medical_lending_for_bill_invoice_discounting??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('medical_lending_for_bill_invoice_discounting')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-agrrement">
            <label for="comments_on_invoice_discounting">Comments on Invoice Discounting <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="comments_on_invoice_discounting" name="comments_on_invoice_discounting"
                placeholder="Enter Comments on Invoice Discounting" value="{{ old('comments_on_invoice_discounting', $hospital_tie_ups->comments_on_invoice_discounting??'') }}">
            @error('comments_on_invoice_discounting')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="hospital_management_system_installation">Hospital Management System Installation (HMS) <span class="text-danger">*</span></label>
            <select class="form-select" id="hospital_management_system_installation" name="hospital_management_system_installation">
                <option value="">Select</option>
                <option value="Yes" {{ old('hospital_management_system_installation', $hospital_tie_ups->hospital_management_system_installation ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('hospital_management_system_installation', $hospital_tie_ups->hospital_management_system_installation ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('hospital_management_system_installation')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-hms">
            <label for="hms_services">HMS Services<span class="text-danger">*</span></label>
            <select class="form-select" id="hms_services" name="hms_services">
                <option value="">Select</option>
                <option value="Monthly" {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'Monthly' ? 'selected' : '' }}>Monthly
                </option>
                <option value="Half Yearly"
                    {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'Half Yearly' ? 'selected' : '' }}>Half Yearly
                </option>
                <option value="Quarterly" {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'Quarterly' ? 'selected' : '' }}>Quarterly
                </option>
                <option value="Yearly" {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'Yearly' ? 'selected' : '' }}>Yearly
                </option>
                <option value="Pre Use" {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'Pre Use' ? 'selected' : '' }}>Pre Use
                </option>
                <option value="No" {{ old('hms_services', $hospital_tie_ups->hms_services??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('hms_services')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3 show-hide-hms">
            <label for="hms_charges">HMS Charges<span class="text-danger">*</span></label>
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" class="form-control" id="hms_charges" name="hms_charges"
                placeholder="Enter HMS Charges" value="{{ old('hms_charges', $hospital_tie_ups->hms_charges??'') }}">
            </div>
            @error('hms_charges')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="comments">Comments </label>
            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments" rows="4">{{ old('comments', $hospital_tie_ups->comments??'') }}</textarea>
            @error('comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="hospital-tie-up-form">Update
                Hospital Tie Ups</button>
        </div>
    </div>
</form>
@push('scripts')
<script>

var field = "{{ old('discount_on_medical_management_cases', $hospital_tie_ups->discount_on_medical_management_cases ?? '')  }}";

var field_ref = "{{ old('referral_commission_offered', $hospital_tie_ups->referral_commission_offered ?? '')  }}";

var field_agrr = "{{ old('lending_finance_company_agreement', $hospital_tie_ups->lending_finance_company_agreement ?? '')  }}";

var field_hms = "{{ old('hospital_management_system_installation', $hospital_tie_ups->hospital_management_system_installation ?? '')  }}";

    if( field === 'No'){
        $(".show-hide-field").hide();
    }

    if( field_agrr === 'No'){
        $(".show-hide-agrrement").hide();
    }

    if( field_ref === 'No'){
        $(".show-hide-referral").hide();
    }

    if( field_hms === 'No'){
        $(".show-hide-hms").hide();
    }


    $('#discount_on_medical_management_cases').on('change', function(){
        if($(this).val() == 'No'){
            $(".show-hide-field").hide();
        }else{
            $(".show-hide-field").show();
        }
    });

    $('#referral_commission_offered').on('change', function(){
        if($(this).val() == 'No'){
            $(".show-hide-referral").hide();
        }else{
            $(".show-hide-referral").show();
        }
    });

     $('#hospital_management_system_installation').on('change', function(){
        if($(this).val() == 'No'){
            $(".show-hide-hms").hide();
        }else{
            $(".show-hide-hms").show();
        }
    });

    $('#lending_finance_company_agreement').on('change', function(){
        if($(this).val() == 'No'){
            $(".show-hide-referral").hide();
        }else{
            $(".show-hide-referral").show();
        }
    });
</script>
@endpush

