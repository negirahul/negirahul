<form action="{{ route('associate-partner.associate-partners.sales-services', $associate->id) }}" method="post"
    id="sales-partner-service-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">
        <div class="col-md-12">
            <label for="consulting">Consulting <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="consulting" name="consulting" onchange="changeConsulting()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('consulting', isset($associate->service) ? $associate->service->consulting : '') == 'yes' ? 'selected' : 'disabled' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('consulting', isset($associate->service) ? $associate->service->consulting : '') == 'no' ? 'selected' : 'disabled' }}>
                    No
                </option>
            </select>
            @error('consulting')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_consulting">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input readonly type="number" onKeyPress="if(this.value.length==7) return false;"
                class="form-control" id="consulting_charge" name="consulting_charge" placeholder="Rs"
                value="{{ old('consulting_charge', isset($associate->service) ? $associate->service->consulting_charge : '') }}">
            </div>
            @error('consulting_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input readonly type="text" class="form-control" maxlength="45" id="consulting_comment" name="consulting_comment"
                placeholder="Comment"
                value="{{ old('consulting_comment', isset($associate->service) ? $associate->service->consulting_comment : '') }}">
            @error('consulting_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="dealer_distributor">Dealer / Distributor (Hospital) <span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="dealer_distributor" name="dealer_distributor"
                onchange="changeDealerDistributor()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('dealer_distributor', isset($associate->service) ? $associate->service->dealer_distributor : '') == 'yes' ? 'selected' : 'disabled' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('dealer_distributor', isset($associate->service) ? $associate->service->dealer_distributor : '') == 'no' ? 'selected' : 'disabled' }}>
                    No
                </option>
            </select>
            @error('dealer_distributor')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_dealer_distributor">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input readonly type="number" onKeyPress="if(this.value.length==7) return false;"
                class="form-control" id="dealer_distributor_charge" name="dealer_distributor_charge" placeholder="Rs"
                value="{{ old('dealer_distributor_charge', isset($associate->service) ? $associate->service->dealer_distributor_charge : '') }}">
            </div>
            @error('dealer_distributor_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input readonly type="text" class="form-control" maxlength="45" id="dealer_distributor_comment"
                name="dealer_distributor_comment" placeholder="Comment"
                value="{{ old('dealer_distributor_comment', isset($associate->service) ? $associate->service->dealer_distributor_comment : '') }}">
            @error('dealer_distributor_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="hospital_empanelment_agent">Hospital Empanelment - Agent<span
                    class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="hospital_empanelment_agent" name="hospital_empanelment_agent"
                onchange="changeHospitalEmpanelmentAgent()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('hospital_empanelment_agent', isset($associate->service) ? $associate->service->hospital_empanelment_agent : '') == 'yes' ? 'selected' : 'disabled' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('hospital_empanelment_agent', isset($associate->service) ? $associate->service->hospital_empanelment_agent : '') == 'no' ? 'selected' : 'disabled' }}>
                    No
                </option>
            </select>
            @error('hospital_empanelment_agent')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_hospital_empanelment_agent">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input readonly type="number" onKeyPress="if(this.value.length==7) return false;"
                class="form-control" id="hospital_empanelment_agent_charge" name="hospital_empanelment_agent_charge"
                placeholder="Rs"
                value="{{ old('hospital_empanelment_agent_charge', isset($associate->service) ? $associate->service->hospital_empanelment_agent_charge : '') }}">
            </div>
            @error('hospital_empanelment_agent_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input readonly type="text" class="form-control" maxlength="45" id="hospital_empanelment_agent_comment"
                name="hospital_empanelment_agent_comment" placeholder="Comment"
                value="{{ old('hospital_empanelment_agent_comment', isset($associate->service) ? $associate->service->hospital_empanelment_agent_comment : '') }}">
            @error('hospital_empanelment_agent_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="software_sales">Software Sales<span class="text-danger">*</span></label>
        </div>

        <div class="col-md-6 mt-1">
            <select class="form-select" id="software_sales" name="software_sales" onchange="changeSoftwareSales()">
                <option value="">Select</option>
                <option value="yes"
                    {{ old('software_sales', isset($associate->service) ? $associate->service->software_sales : '') == 'yes' ? 'selected' : 'disabled' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('software_sales', isset($associate->service) ? $associate->service->software_sales : '') == 'no' ? 'selected' : 'disabled' }}>
                    No
                </option>
            </select>
            @error('software_sales')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_software_sales">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input readonly type="number" onKeyPress="if(this.value.length==7) return false;"
                class="form-control" id="software_sales_charge" name="software_sales_charge" placeholder="Rs"
                value="{{ old('software_sales_charge', isset($associate->service) ? $associate->service->software_sales_charge : '') }}">
            </div>
            @error('software_sales_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-12 mt-2">
            <input readonly type="text" class="form-control" maxlength="45" id="software_sales_comment"
                name="software_sales_comment" placeholder="Comment"
                value="{{ old('software_sales_comment', isset($associate->service) ? $associate->service->software_sales_comment : '') }}">
            @error('software_sales_comment')
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
                    {{ old('others', isset($associate->service) ? $associate->service->others : '') == 'yes' ? 'selected' : 'disabled' }}>
                    Yes
                </option>
                <option value="no"
                    {{ old('others', isset($associate->service) ? $associate->service->others : '') == 'no' ? 'selected' : 'disabled' }}>
                    No
                </option>
            </select>
            @error('others')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-1 div_others">
            <div class="input-group">
                <label class="input-group-text" for="phone">Rs.</label>
                <input readonly type="number" onKeyPress="if(this.value.length==7) return false;"
                class="form-control" id="others_charge" name="others_charge" placeholder="Rs"
                value="{{ old('others_charge', isset($associate->service) ? $associate->service->others_charge : '') }}">
            </div>
            @error('others_charge')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-2">
            <input readonly type="text" class="form-control" maxlength="45" id="others_comment" name="others_comment"
                placeholder="Comment"
                value="{{ old('others_comment', isset($associate->service) ? $associate->service->others_comment : '') }}">
            @error('others_comment')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mt-3">
            <label for="sales_partner_comments">Sales Partner Comments </label>
            <textarea maxlength="250" readonly class="form-control" id="sales_partner_comments" name="sales_partner_comments"
                placeholder="Comments" rows="4">{{ old('sales_partner_comments', isset($associate->service) ? $associate->service->sales_partner_comments : '') }}</textarea>
            @error('sales_partner_comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="sales-partner-service-form">Update</button>
        </div>
    </div>
</form>
s
