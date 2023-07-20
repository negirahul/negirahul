<form action="{{ route('hospital.hospitals.infrastructures', $hospital->id) }}" method="post" id="hospital-infrastructures-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">

        <div class="col-md-6 mt-3">
            <label for="city_category">City Category <span class="text-danger">*</span></label>
            <select class="form-select" id="city_category" name="city_category">
                <option value="">Select</option>
                <option value="I" {{ old('city_category', $hospital_nfrastructure->city_category??'') == 'I' ? 'selected' : '' }}>I
                </option>
                <option value="II"
                    {{ old('city_category', $hospital_nfrastructure->city_category??'') == 'II' ? 'selected' : '' }}>II
                </option>
                <option value="III"
                    {{ old('city_category', $hospital_nfrastructure->city_category??'') == 'III' ? 'selected' : '' }}>III
                </option>
                <option value="Other"
                    {{ old('city_category', $hospital_nfrastructure->city_category??'') == 'Other' ? 'selected' : '' }}>Other
                </option>
            </select>
            @error('city_category')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="hospital_type">Hospital Type <span class="text-danger">*</span></label>
            <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="25" class="form-control" id="hospital_type" name="hospital_type"
                placeholder="Enter Hospital Type" value="{{ old('hospital_type', $hospital_nfrastructure->hospital_type ?? '') }}">
            @error('hospital_type')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="hospital_category">Hospital Category  <span class="text-danger">*</span></label>
            <input type="text" onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="25" class="form-control" id="hospital_category" name="hospital_category"
                placeholder="Enter Hospital Category" value="{{ old('hospital_category', $hospital_nfrastructure->hospital_category ?? '') }}">
            @error('hospital_category')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_beds">No. of Beds <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>4) return false;" class="form-control" id="no_of_beds" name="no_of_beds"
                placeholder="Enter No. of Beds" value="{{ old('no_of_beds', $hospital_nfrastructure->no_of_beds ?? '') }}">
            @error('no_of_beds')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_ots">No. of OT's <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_ots" name="no_of_ots"
                placeholder="Enter No. of OT's" value="{{ old('no_of_ots', $hospital_nfrastructure->no_of_ots ?? '') }}">
            @error('no_of_ots')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="no_of_modular_ots">No. of Modular OT's <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_modular_ots" name="no_of_modular_ots"
                placeholder="Enter No. of Modular OT's" value="{{ old('no_of_modular_ots', $hospital_nfrastructure->no_of_modular_ots ?? '') }}">
            @error('no_of_modular_ots')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="no_of_icus">No. of ICU's <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_icus" name="no_of_icus"
                placeholder="Enter No. of ICU's" value="{{ old('no_of_icus', $hospital_nfrastructure->no_of_icus ?? '') }}">
            @error('no_of_icus')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_iccus">No. of ICCU's <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_iccus" name="no_of_iccus"
                placeholder="Enter No. of ICCU's" value="{{ old('no_of_iccus', $hospital_nfrastructure->no_of_iccus ?? '') }}">
            @error('no_of_iccus')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_nicus">No. of NICU's<span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_nicus" name="no_of_nicus"
                placeholder="Enter No. of NICU's" value="{{ old('no_of_nicus', $hospital_nfrastructure->no_of_nicus ?? '') }}">
            @error('no_of_nicus')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_rmos">No. of RMO's<span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>3) return false;" class="form-control" id="no_of_rmos" name="no_of_rmos"
                placeholder="Enter No. of RMO's" value="{{ old('no_of_rmos', $hospital_nfrastructure->no_of_rmos ?? '') }}">
            @error('no_of_rmos')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_nurses">No. of Nurses <span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>3) return false;" class="form-control" id="no_of_nurses" name="no_of_nurses"
                placeholder="Enter No. of Nurses " value="{{ old('no_of_nurses', $hospital_nfrastructure->no_of_nurses ?? '') }}">
            @error('no_of_nurses')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="nabl_approved_lab">NABL Approved Lab <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="nabl_approved_lab" name="nabl_approved_lab">
                <option value="">Select</option>
                <option value="Yes" {{ old('nabl_approved_lab', $hospital_nfrastructure->nabl_approved_lab ?? '') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('nabl_approved_lab', $hospital_nfrastructure->nabl_approved_lab ?? '') == 'No' ? 'selected' : '' }}>No
                </option>            
            </select>
       
        </div>
            @error('nabl_approved_lab')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_of_dialysis_units">No. of Dialysis Units<span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_of_dialysis_units" name="no_of_dialysis_units"
                placeholder="Enter No. of Dialysis Units" value="{{ old('no_of_dialysis_units', $hospital_nfrastructure->no_of_dialysis_units ?? '') }}">
            @error('no_of_dialysis_units')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_ambulance_normal">No. Ambulance - Normal<span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_ambulance_normal" name="no_ambulance_normal"
                placeholder="Enter No. Ambulance - Normal" value="{{ old('no_ambulance_normal', $hospital_nfrastructure->no_ambulance_normal ?? '') }}">
            @error('no_ambulance_normal')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 mt-3">
            <label for="no_ambulance_acls">No. Ambulance - ACLS<span class="text-danger">*</span></label>
            <input type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length>2) return false;" class="form-control" id="no_ambulance_acls" name="no_ambulance_acls"
                placeholder="Enter No. Ambulance - ACLS" value="{{ old('no_ambulance_acls', $hospital_nfrastructure->no_ambulance_acls ?? '') }}">
            @error('no_ambulance_acls')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 mt-3">
            <label for="nabh_status">NABH Status <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="nabh_status" name="nabh_status">
                <option value="">Select</option>
                <option value="Approved" {{ old('nabh_status', $hospital_nfrastructure->nabh_status?? '') == 'Approved' ? 'selected' : '' }}>Approved
                </option>
                <option value="Pre Approved"
                    {{ old('nabh_status', $hospital_nfrastructure->nabh_status?? '') == 'Pre Approved' ? 'selected' : '' }}>Pre Approved
                </option>
                <option value="Applied" {{ old('nabh_status', $hospital_nfrastructure->nabh_status?? '') == 'Applied' ? 'selected' : '' }}>Applied
                </option>
                <option value="NA" {{ old('nabh_status', $hospital_nfrastructure->nabh_status?? '') == 'NA' ? 'selected' : '' }}>NA
                </option>
            </select>
            
            </div>
            @error('nabh_status')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
         
        </div>

        <div class="col-md-6 mt-3">
            <label for="jci_status">JCI Status <span class="text-danger">*</span></label>
            <div class="input-group">
            <select class="form-select" id="jci_status" name="jci_status">
                <option value="">Select</option>
                <option value="Yes" {{ old('jci_status', $hospital_nfrastructure->jci_status?? '') == 'Yes' ? 'selected' : '' }}>Yes
                </option>
                <option value="No"
                    {{ old('jci_status', $hospital_nfrastructure->jci_status?? '') == 'No' ? 'selected' : '' }}>No
                </option>
                <option value="Applied" {{ old('jci_status', $hospital_nfrastructure->jci_status?? '') == 'Applied' ? 'selected' : '' }}>Applied
                </option>
            </select>
            
      
            </div>
            @error('jci_status')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="nqac_nhsrc_status">NQAC/NHSRC Status<span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="nqac_nhsrc_status" name="nqac_nhsrc_status">
                    <option value="">Select</option>
                    <option value="Approved" {{ old('nqac_nhsrc_status', $hospital_nfrastructure->nqac_nhsrc_status?? '') == 'Approved' ? 'selected' : '' }}>Approved
                    </option>
                    <option value="Pre Approved"
                    {{ old('nqac_nhsrc_status', $hospital_nfrastructure->nqac_nhsrc_status?? '') == 'Pre Approved' ? 'selected' : '' }}>Pre Approved
                </option>
                <option value="Applied" {{ old('nqac_nhsrc_status', $hospital_nfrastructure->nqac_nhsrc_status?? '') == 'Applied' ? 'selected' : '' }}>Applied
                </option>
                <option value="NA" {{ old('nqac_nhsrc_status', $hospital_nfrastructure->nqac_nhsrc_status?? '') == 'NA' ? 'selected' : '' }}>NA
                </option>
            </select>
            
        
            </div>
            @error('nqac_nhsrc_status')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
          
        </div>

        <div class="col-md-6 mt-3">
            <label for="hippa_status">HIPPA Status <span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="hippa_status" name="hippa_status">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('hippa_status', $hospital_nfrastructure->hippa_status?? '') == 'Yes' ? 'selected' : '' }}>Yes
                    </option>
                    <option value="No"
                    {{ old('hippa_status', $hospital_nfrastructure->hippa_status?? '') == 'No' ? 'selected' : '' }}>No
                </option>
            </select>
            
          
            </div>
            @error('hippa_status')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
           
        </div>

        <div class="col-md-12 mt-3">
            <label for="comments">Comments </label>
            <textarea class="form-control" id="comments" name="comments" maxlength="250" placeholder="Comments" rows="4">{{ old('comments', $hospital_nfrastructure->comments??'') }}</textarea>
            @error('comments')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="hospital-infrastructures-form">Update
                Hospital Tie Ups</button>
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