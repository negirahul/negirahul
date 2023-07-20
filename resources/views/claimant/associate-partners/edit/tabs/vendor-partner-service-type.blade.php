<form action="{{ route('admin.associate-partners.vendor-services', $associate->id) }}" method="post"
    id="vendor-partner-service-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-12">
            <label for="cashless_claims_management">Cashless Claims Management <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="cashless_claims_management" name="cashless_claims_management" onchange="changeCashlessManagement()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('cashless_claims_management',  isset($associate->service) ? $associate->service->cashless_claims_management : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('cashless_claims_management', isset($associate->service) ? $associate->service->cashless_claims_management : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('cashless_claims_management')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_cashless_claims_management">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="cashless_claims_management_charge"
                name="cashless_claims_management_charge" placeholder="Rs"
                value="{{ old('cashless_claims_management_charge', isset($associate->service) ? $associate->service->cashless_claims_management_charge : '') }}">
            </div>
            @error('cashless_claims_management_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="cashless_claims_management_comment" name="cashless_claims_management_comment"
                placeholder="Comment"
                value="{{ old('cashless_claims_management_comment', isset($associate->service) ? $associate->service->cashless_claims_management_comment : '') }}">
            @error('cashless_claims_management_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="cashless_helpdesk">Cashless Help Desk <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="cashless_helpdesk" name="cashless_helpdesk" onchange="changeCashlessHelpdesk()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('cashless_helpdesk', isset($associate->service) ? $associate->service->cashless_helpdesk : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('cashless_helpdesk', isset($associate->service) ? $associate->service->cashless_helpdesk : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('cashless_helpdesk')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_cashless_helpdesk">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="cashless_helpdesk_charge" name="cashless_helpdesk_charge"
                placeholder="Rs"
                value="{{ old('cashless_helpdesk_charge', isset($associate->service) ? $associate->service->cashless_helpdesk_charge : '') }}">
            </div>
            @error('cashless_helpdesk_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="cashless_helpdesk_comment" name="cashless_helpdesk_comment"
                placeholder="Comment"
                value="{{ old('cashless_helpdesk_comment', isset($associate->service) ? $associate->service->cashless_helpdesk_comment : '') }}">
            @error('cashless_helpdesk_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="claims_assessment">Claims Assessment<span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="claims_assessment" name="claims_assessment" onchange="claimsAssessment()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('claims_assessment', isset($associate->service) ? $associate->service->claims_assessment : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('claims_assessment', isset($associate->service) ? $associate->service->claims_assessment : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('claims_assessment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_claims_assessment">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="claims_assessment_charge" name="claims_assessment_charge"
                placeholder="Rs"
                value="{{ old('claims_assessment_charge', isset($associate->service) ? $associate->service->claims_assessment_charge : '') }}">
            </div>
            @error('claims_assessment_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="claims_assessment_comment" name="claims_assessment_comment"
                placeholder="Comment"
                value="{{ old('claims_assessment_comment', isset($associate->service) ? $associate->service->claims_assessment_comment : '') }}">
            @error('claims_assessment_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="claims_bill_entry">Claims Bill Entry<span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="claims_bill_entry" name="claims_bill_entry" onchange="changeClaimsBill()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('claims_bill_entry', isset($associate->service) ? $associate->service->claims_bill_entry : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('claims_bill_entry', isset($associate->service) ? $associate->service->claims_bill_entry : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('claims_bill_entry')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_claims_bill_entry">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="claims_bill_entry_charge" name="claims_bill_entry_charge"
                placeholder="Rs"
                value="{{ old('claims_bill_entry_charge', isset($associate->service) ? $associate->service->claims_bill_entry_charge : '') }}">
            </div>
            @error('claims_bill_entry_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="claims_bill_entry_comment" name="claims_bill_entry_comment"
                placeholder="Comment"
                value="{{ old('claims_bill_entry_comment', isset($associate->service) ? $associate->service->claims_bill_entry_comment : '') }}">
            @error('claims_bill_entry_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="claims_reimbursement">Claims Reimbursement - Insured <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="claims_reimbursement" name="claims_reimbursement" onchange="claimsReimbursement()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('claims_reimbursement', isset($associate->service) ? $associate->service->claims_reimbursement : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('claims_reimbursement', isset($associate->service) ? $associate->service->claims_reimbursement : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('claims_reimbursement')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_claims_reimbursement">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="claims_reimbursement_charge"
                name="claims_reimbursement_charge" placeholder="Rs"
                value="{{ old('claims_reimbursement_charge', isset($associate->service) ? $associate->service->claims_reimbursement_charge : '') }}">
            </div>
            @error('claims_reimbursement_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="claims_reimbursement_comment" name="claims_reimbursement_comment"
                placeholder="Comment"
                value="{{ old('claims_reimbursement_comment', isset($associate->service) ? $associate->service->claims_reimbursement_comment : '') }}">
            @error('claims_reimbursement_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="doctor_claim_process">Doctor (Claim Processing) <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="doctor_claim_process" name="doctor_claim_process" onchange="doctorClaimsProcess()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('doctor_claim_process', isset($associate->service) ? $associate->service->doctor_claim_process : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('doctor_claim_process', isset($associate->service) ? $associate->service->doctor_claim_process : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('doctor_claim_process')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_doctor_claim_process">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="doctor_claim_process_charge"
                name="doctor_claim_process_charge" placeholder="Rs"
                value="{{ old('doctor_claim_process_charge', isset($associate->service) ? $associate->service->doctor_claim_process_charge : '') }}">
            </div>
            @error('doctor_claim_process_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="doctor_claim_process_comment" name="doctor_claim_process_comment"
                placeholder="Comment"
                value="{{ old('doctor_claim_process_comment', isset($associate->service) ? $associate->service->doctor_claim_process_comment : '') }}">
            @error('doctor_claim_process_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="doctor_honorary_panel">Doctor (Honorary/Panel) <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="doctor_honorary_panel" name="doctor_honorary_panel" onchange="doctorHonoraryPanel()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('doctor_honorary_panel', isset($associate->service) ? $associate->service->doctor_honorary_panel : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('doctor_honorary_panel', isset($associate->service) ? $associate->service->doctor_honorary_panel : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('doctor_honorary_panel')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_doctor_honorary_panel">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="doctor_honorary_panel_charge"
                name="doctor_honorary_panel_charge" placeholder="Rs"
                value="{{ old('doctor_honorary_panel_charge', isset($associate->service) ? $associate->service->doctor_honorary_panel_charge : '') }}">
            </div>
            @error('doctor_honorary_panel_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="doctor_honorary_panel_comment" name="doctor_honorary_panel_comment"
                placeholder="Comment"
                value="{{ old('doctor_honorary_panel_comment', isset($associate->service) ? $associate->service->doctor_honorary_panel_comment : '') }}">
            @error('doctor_honorary_panel_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="doctor_tele_consultation">Doctor (Tele Consultation) <span
                    class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="doctor_tele_consultation" name="doctor_tele_consultation" onchange="doctorTeleConsultation()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('doctor_tele_consultation', isset($associate->service) ? $associate->service->doctor_tele_consultation : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('doctor_tele_consultation', isset($associate->service) ? $associate->service->doctor_tele_consultation : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('doctor_tele_consultation')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_doctor_tele_consultation">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="doctor_tele_consultation_charge"
                name="doctor_tele_consultation_charge" placeholder="Rs"
                value="{{ old('doctor_tele_consultation_charge', isset($associate->service) ? $associate->service->doctor_tele_consultation_charge : '') }}">
            </div>
            @error('doctor_tele_consultation_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="doctor_tele_consultation_comment" name="doctor_tele_consultation_comment"
                placeholder="Comment"
                value="{{ old('doctor_tele_consultation_comment', isset($associate->service) ? $associate->service->doctor_tele_consultation_comment : '') }}">
            @error('doctor_tele_consultation_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="insurance_tpa_coordination">Insaurance Co. / TPA Coordination <span
                    class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="insurance_tpa_coordination" name="insurance_tpa_coordination" onchange="changeInsuranceTpa()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('insurance_tpa_coordination', isset($associate->service) ? $associate->service->insurance_tpa_coordination : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('insurance_tpa_coordination', isset($associate->service) ? $associate->service->insurance_tpa_coordination : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('insurance_tpa_coordination')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_insurance_tpa_coordination">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="insurance_tpa_coordination_charge"
                name="insurance_tpa_coordination_charge" placeholder="Rs"
                value="{{ old('insurance_tpa_coordination_charge', isset($associate->service) ? $associate->service->insurance_tpa_coordination_charge : '') }}">
            </div>
            @error('insurance_tpa_coordination_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="insurance_tpa_coordination_comment" name="insurance_tpa_coordination_comment"
                placeholder="Comment"
                value="{{ old('insurance_tpa_coordination_comment', isset($associate->service) ? $associate->service->insurance_tpa_coordination_comment : '') }}">
            @error('insurance_tpa_coordination_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="medical_lending_bill">Medical Lending for Bill/Invoice Discounting <span
                    class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="medical_lending_bill" name="medical_lending_bill" onchange="medicalLendingBill()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('medical_lending_bill', isset($associate->service) ? $associate->service->medical_lending_bill : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('medical_lending_bill', isset($associate->service) ? $associate->service->medical_lending_bill : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('medical_lending_bill')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_medical_lending_bill">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="medical_lending_bill_charge"
                name="medical_lending_bill_charge" placeholder="Rs"
                value="{{ old('medical_lending_bill_charge', isset($associate->service) ? $associate->service->medical_lending_bill_charge : '') }}">
            </div>
            @error('medical_lending_bill_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="medical_lending_bill_comment" name="medical_lending_bill_comment"
                placeholder="Comment"
                value="{{ old('medical_lending_bill_comment', isset($associate->service) ? $associate->service->medical_lending_bill_comment : '') }}">
            @error('medical_lending_bill_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="medical_lending_patient">Medical Lending for Patient <span
                    class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="medical_lending_patient" name="medical_lending_patient" onchange="medicalLendingPatient()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('medical_lending_patient', isset($associate->service) ? $associate->service->medical_lending_patient : '') == 'yes' ? 'selected' : '' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('medical_lending_patient', isset($associate->service) ? $associate->service->medical_lending_patient : '') == 'no' ? 'selected' : '' }}>
                    No
                </option>
            </select>
            @error('medical_lending_patient')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_medical_lending_patient">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="medical_lending_patient_charge"
                name="medical_lending_patient_charge" placeholder="Rs"
                value="{{ old('medical_lending_patient_charge', isset($associate->service) ? $associate->service->medical_lending_patient_charge : '') }}">
            </div>
            @error('medical_lending_patient_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="medical_lending_patient_comment" name="medical_lending_patient_comment"
                placeholder="Comment"
                value="{{ old('medical_lending_patient_comment', isset($associate->service) ? $associate->service->medical_lending_patient_comment : '') }}">
            @error('medical_lending_patient_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="others">Others <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="others" name="others" onchange="changeOthers()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('others', isset($associate->service) ? $associate->service->others : '') == 'yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="no"
                    {{ old('others', isset($associate->service) ? $associate->service->others : '') == 'no' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('others')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_others">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input type="number" onKeyPress="if(this.value.length==7) return false;" class="form-control" id="others_charge" name="others_charge"
                placeholder="Rs" value="{{ old('others_charge', isset($associate->service) ? $associate->service->others_charge : '') }}">
            </div>
            @error('others_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" maxlength="45" id="others_comment" name="others_comment"
                placeholder="Comment"
                value="{{ old('others_comment', isset($associate->service) ? $associate->service->others_comment : '') }}">
            @error('others_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="vendor_partner_comments">Comments </label>
            <textarea class="form-control" id="vendor_partner_comments" name="vendor_partner_comments" placeholder="Write Comments here" rows="4">{{ old('vendor_partner_comments', isset($associate->service) ? $associate->service->vendor_partner_comments : '') }}</textarea>
            @error('vendor_partner_comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="vendor-partner-service-form">Update</button>
        </div>
    </div>
</form>
