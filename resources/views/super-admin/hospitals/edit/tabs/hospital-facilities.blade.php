<form action="{{ route('super-admin.hospitals.facility', $hospital->id) }}" method="post" id="hospital-facility-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">

        <div class="col-md-4 mt-3">
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




            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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




            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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


            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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




            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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


            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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



            <div class="col-md-4 mt-3">
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
        if($(this).val() == 'No' || $(this).val() == 'NA'){
            $("#"+id+"_file").attr('disabled',true);
        }else{
            $("#"+id+"_file").attr('disabled',false);
        }
    });
</script>
@endpush