<form action="{{ route('associate-partner.hospitals.facility', $hospital->id) }}" method="post" id="hospital-facility-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">

        <div class="col-md-5 mt-3">
            <label for="pharmacy">Pharmacy<span class="text-danger">*</span></label>
            <select class="form-select" id="pharmacy" name="pharmacy">
                <option value="">Select</option>
                <option value="Yes" {{ old('pharmacy', $hospital_facility->pharmacy ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ old('pharmacy', $hospital_facility->pharmacy ?? '') == 'No' ? 'selected' : '' }}>No</option>
            </select>
            @error('pharmacy')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="pharmacy_file" @if($hospital_facility->pharmacy == 'No') disabled @endif id="pharmacy_file" hidden />
            <label for="pharmacy_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('pharmacy_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="lab">Lab <span class="text-danger">*</span></label>
                <select class="form-select" id="lab" name="lab">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('lab', $hospital_facility->lab?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('lab', $hospital_facility->lab?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('lab')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="lab_file" @if($hospital_facility->lab == 'No') disabled @endif id="lab_file" hidden />
            <label for="lab_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('lab_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="ambulance">Ambulance <span class="text-danger">*</span></label>
                <select class="form-select" id="ambulance" name="ambulance">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('ambulance', $hospital_facility->ambulance??'') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('ambulance', $hospital_facility->ambulance??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('ambulance')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="ambulance_file" @if($hospital_facility->ambulance == 'No') disabled @endif id="ambulance_file" hidden />
            <label for="ambulance_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('ambulance_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="operation_theatre">Operation Theatre <span class="text-danger">*</span></label>
                <select class="form-select" id="operation_theatre" name="operation_theatre">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('operation_theatre', $hospital_facility->operation_theatre??'') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('operation_theatre', $hospital_facility->operation_theatre??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('operation_theatre')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="operation_theatre_file" @if($hospital_facility->operation_theatre == 'No') disabled @endif id="operation_theatre_file" hidden />
            <label for="operation_theatre_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('operation_theatre_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="icu">ICU <span class="text-danger">*</span></label>
                <select class="form-select" id="icu" name="icu">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('icu', $hospital_facility->icu??'') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('icu', $hospital_facility->icu??'') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('icu')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="icu_file" @if($hospital_facility->icu == 'No') disabled @endif id="icu_file" hidden />
            <label for="icu_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('icu_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="iccu">ICCU <span class="text-danger">*</span></label>
                <select class="form-select" id="iccu" name="iccu">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('iccu', $hospital_facility->iccu ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('iccu', $hospital_facility->iccu ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('iccu')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="iccu_file" @if($hospital_facility->iccu == 'No') disabled @endif id="iccu_file" hidden />
            <label for="iccu_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('iccu_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="nicu">NICU <span class="text-danger">*</span></label>
                <select class="form-select" id="nicu" name="nicu">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('nicu', $hospital_facility->nicu ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('nicu', $hospital_facility->nicu ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('nicu')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="nicu_file" @if($hospital_facility->nicu == 'No') disabled @endif id="nicu_file" hidden />
            <label for="nicu_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('nicu_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="csc_sterilization">CSC (Sterilization) <span class="text-danger">*</span></label>
                <select class="form-select" id="csc_sterilization" name="csc_sterilization">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('csc_sterilization', $hospital_facility->csc_sterilization ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('csc_sterilization', $hospital_facility->csc_sterilization ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('csc_sterilization')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="csc_sterilization_file" @if($hospital_facility->csc_sterilization == 'No') disabled @endif id="csc_sterilization_file" hidden />
            <label for="csc_sterilization_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('csc_sterilization_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="centralized_gas_ons">Centralized-Gas (ONS) <span class="text-danger">*</span></label>
                <select class="form-select" id="centralized_gas_ons" name="centralized_gas_ons">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('centralized_gas_ons', $hospital_facility->centralized_gas_ons  ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('centralized_gas_ons', $hospital_facility->centralized_gas_ons  ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('centralized_gas_ons')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="centralized_gas_ons_file" @if($hospital_facility->centralized_gas_ons == 'No') disabled @endif id="centralized_gas_ons_file" hidden />
            <label for="centralized_gas_ons_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('centralized_gas_ons_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="centralized_ac">Centralized-AC <span class="text-danger">*</span></label>
                <select class="form-select" id="centralized_ac" name="centralized_ac">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('centralized_ac', $hospital_facility->centralized_ac ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('centralized_ac', $hospital_facility->centralized_ac ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('centralized_ac')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="centralized_ac_file" @if($hospital_facility->centralized_ac == 'No') disabled @endif id="centralized_ac_file" hidden />
            <label for="centralized_ac_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('centralized_ac_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="kitchen">Kitchen <span class="text-danger">*</span></label>
                <select class="form-select" id="kitchen" name="kitchen">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('kitchen', $hospital_facility->kitchen ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('kitchen', $hospital_facility->kitchen ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('kitchen')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="kitchen_file" @if($hospital_facility->kitchen == 'No') disabled @endif id="kitchen_file" hidden />
            <label for="kitchen_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('kitchen_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="usg_machine">USG Machine <span class="text-danger">*</span></label>
                <select class="form-select" id="usg_machine" name="usg_machine">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('usg_machine', $hospital_facility->usg_machine ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('usg_machine', $hospital_facility->usg_machine ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('usg_machine')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="usg_machine_file" @if($hospital_facility->usg_machine == 'No') disabled @endif id="usg_machine_file" hidden />
            <label for="usg_machine_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('usg_machine_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="digital_xray">Digital X-Ray <span class="text-danger">*</span></label>
                <select class="form-select" id="digital_xray" name="digital_xray">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('digital_xray', $hospital_facility->digital_xray ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('digital_xray', $hospital_facility->digital_xray ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('digital_xray')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="digital_xray_file" @if($hospital_facility->digital_xray == 'No') disabled @endif id="digital_xray_file" hidden />
            <label for="digital_xray_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('digital_xray_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="ct">CT <span class="text-danger">*</span></label>
                <select class="form-select" id="ct" name="ct">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('ct', $hospital_facility->ct ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('ct', $hospital_facility->ct ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('ct')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="ct_file" @if($hospital_facility->ct == 'No') disabled @endif id="ct_file" hidden />
            <label for="ct_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('ct_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="mri">MRI <span class="text-danger">*</span></label>
                <select class="form-select" id="mri" name="mri">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('mri', $hospital_facility->mri ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('mri', $hospital_facility->mri ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('mri')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="mri_file" @if($hospital_facility->mri == 'No') disabled @endif id="mri_file" hidden />
            <label for="mri_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('mri_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="pet_scan">PET Scan <span class="text-danger">*</span></label>
                <select class="form-select" id="pet_scan" name="pet_scan">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('pet_scan', $hospital_facility->pet_scan ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('pet_scan', $hospital_facility->pet_scan ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('pet_scan')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="pet_scan_file" @if($hospital_facility->pet_scan == 'No') disabled @endif id="pet_scan_file" hidden />
            <label for="pet_scan_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('pet_scan_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="organ_transplant_unit">Organ Transplant Unit <span class="text-danger">*</span></label>
                <select class="form-select" id="organ_transplant_unit" name="organ_transplant_unit">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('organ_transplant_unit', $hospital_facility->organ_transplant_unit ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('organ_transplant_unit', $hospital_facility->organ_transplant_unit ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('organ_transplant_unit')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="organ_transplant_unit_file" @if($hospital_facility->organ_transplant_unit == 'No') disabled @endif id="organ_transplant_unit_file" hidden />
            <label for="organ_transplant_unit_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('organ_transplant_unit_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="burn_unit">Burn Unit <span class="text-danger">*</span></label>
                <select class="form-select" id="burn_unit" name="burn_unit">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('burn_unit', $hospital_facility->burn_unit ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('burn_unit', $hospital_facility->burn_unit ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('burn_unit')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="burn_unit_file" @if($hospital_facility->burn_unit == 'No') disabled @endif id="burn_unit_file" hidden />
            <label for="burn_unit_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('burn_unit_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="dialysis_unit">Dialysis Unit <span class="text-danger">*</span></label>
                <select class="form-select" id="dialysis_unit" name="dialysis_unit">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('dialysis_unit', $hospital_facility->dialysis_unit ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('dialysis_unit', $hospital_facility->dialysis_unit ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('dialysis_unit')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="dialysis_unit_file" @if($hospital_facility->dialysis_unit == 'No') disabled @endif id="dialysis_unit_file" hidden />
            <label for="dialysis_unit_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('dialysis_unit_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-5 mt-3">
                <label for="blood_bank">Blood Bank <span class="text-danger">*</span></label>
                <select class="form-select" id="blood_bank" name="blood_bank">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('blood_bank', $hospital_facility->blood_bank ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('blood_bank', $hospital_facility->blood_bank ?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            @error('blood_bank')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>       


        <div class="col-md-1 mt-32" style="margin-top: 45px !important;">
            <input type="file" name="blood_bank_file" @if($hospital_facility->blood_bank == 'No') disabled @endif id="blood_bank_file" hidden />
            <label for="blood_bank_file" class="btn btn-primary upload-label"><i
                class="mdi mdi-upload"></i></label>
                @error('blood_bank_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="col-md-12 mt-3">
            <label for="hospital_facility_comments">Hospital Facility Comments </label>
            <textarea class="form-control" id="hospital_facility_comments" name="hospital_facility_comments" maxlength="250" placeholder="Comments" rows="4">{{ old('hospital_facility_comments', $hospital_facility->hospital_facility_comments??'') }}</textarea>
            @error('hospital_facility_comments')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 text-end mt-3">
            <button type="submit" class="btn btn-success" form="hospital-facility-form">Update
                Hospital Facility</button>
        </div>
    </div>
</form>
@push('scripts')
<script>
    $('select').on('change', function(){
            var id = $(this).attr('id');
        if($(this).val() == 'No'){
            $("#"+id+"_file").attr('disabled',true);
        }else{
            $("#"+id+"_file").attr('disabled',false);
        }
    });
</script>
@endpush