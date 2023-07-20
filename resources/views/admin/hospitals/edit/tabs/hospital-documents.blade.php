<div class="card">
    <div class="card-header bg-dark text-white">
        Hospital Documents
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="hospital-documents-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="hospital_documents">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="Hospital PAN Card*">
                        @isset($hospital_document->hospital_pan_card)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_pan_card) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_pan_card"
                            id="hospital_pan_card" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_pan_card" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_pan_card')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Cancel Cheque">
                        @isset($hospital_document->hospital_cancel_cheque)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_cancel_cheque) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="hospital_cancel_cheque"
                            id="hospital_cancel_cheque" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_cancel_cheque"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_cancel_cheque')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Owner's PAN Card *">
                        @isset($hospital_document->hospital_owners_pan_card)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_owners_pan_card) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_owners_pan_card"
                            id="hospital_owners_pan_card" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_owners_pan_card"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_owners_pan_card')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Owner's Aadhar Card*">
                        @isset($hospital_document->hospital_owners_aadhar_card)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_owners_aadhar_card) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_owners_aadhar_card" id="hospital_owners_aadhar_card" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_owners_aadhar_card" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_owners_aadhar_card')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Other Documents ">
                        @isset($hospital_document->hospital_other_documents)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_other_documents) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_other_documents"
                            id="hospital_other_documents" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_other_documents"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_other_documents')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="hospital-documents-form">Save/Update Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Hospital Facilities and Infrastructure
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="hospital-fi-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="hospital_fi_form">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="Pharmacy">
                        @isset($hospital_document->pharmacy)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->pharmacy) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="pharmacy"
                            id="hi_pharmacy" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_pharmacy" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('pharmacy')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Lab">
                        @isset($hospital_document->lab)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->lab) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="lab"
                            id="hi_lab" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_lab"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('lab')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Ambulance ">
                        @isset($hospital_document->ambulance)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->ambulance) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="ambulance"
                            id="hi_ambulance" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_ambulance"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('ambulance')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Operation Theatre">
                        @isset($hospital_document->operation_theatre)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->operation_theatre) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="operation_theatre" id="operation_theatre_upload" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="operation_theatre_upload" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('operation_theatre')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="ICU ">
                        @isset($hospital_document->icu)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->icu) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="icu"
                            id="hi_icu" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_icu"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('icu')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="ICCU ">
                        @isset($hospital_document->iccu)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->iccu) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="iccu"
                            id="hi_iccu" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_iccu"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('iccu')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="NICU ">
                        @isset($hospital_document->nicu)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->nicu) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="nicu"
                            id="hi_nicu" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_nicu"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('nicu')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="CSC (Sterilization) ">
                        @isset($hospital_document->csc_sterilization)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->csc_sterilization) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="csc_sterilization"
                            id="hi_csc_sterilization" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_csc_sterilization"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('csc_sterilization')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Centralized-Gas (ONS) ">
                        @isset($hospital_document->centralized_gas_ons)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->centralized_gas_ons) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="centralized_gas_ons"
                            id="hi_centralized_gas_ons" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_centralized_gas_ons"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('centralized_gas_ons')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Centralized-AC ">
                        @isset($hospital_document->centralized_ac)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->centralized_ac) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="centralized_ac"
                            id="hi_centralized_ac" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_centralized_ac"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('centralized_ac')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Kitchen ">
                        @isset($hospital_document->kitchen)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->kitchen) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="kitchen"
                            id="hi_kitchen" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_kitchen"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('kitchen')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="USG Machine ">
                        @isset($hospital_document->usg_machine)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->usg_machine) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="usg_machine"
                            id="hi_usg_machine" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_usg_machine"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('usg_machine')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Digital X-Ray ">
                        @isset($hospital_document->digital_x_ray)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->digital_x_ray) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="digital_x_ray"
                            id="hi_digital_x_ray" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_digital_x_ray"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('digital_x_ray')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="CT ">
                        @isset($hospital_document->ct)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->ct) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="ct"
                            id="hi_ct" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_ct"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('ct')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="MRI ">
                        @isset($hospital_document->mri)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->mri) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="mri"
                            id="hi_mri" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_mri"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('mri')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="PET Scan ">
                        @isset($hospital_document->pet_scan)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->pet_scan) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="pet_scan"
                            id="hi_pet_scan" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_pet_scan"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('pet_scan')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Organ Transplant Unit ">
                        @isset($hospital_document->organ_transplant_unit)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->organ_transplant_unit) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="organ_transplant_unit"
                            id="hi_organ_transplant_unit" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_organ_transplant_unit"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('organ_transplant_unit')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Burn Unit ">
                        @isset($hospital_document->burn_unit)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->burn_unit) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="burn_unit"
                            id="hi_burn_unit" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_burn_unit"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('burn_unit')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Dialysis Unit ">
                        <input type="file" name="dialysis_unit"
                            id="hi_dialysis_unit" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hi_dialysis_unit"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('dialysis_unit')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Blood Bank ">
                        @isset($hospital_document->blood_bank)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->blood_bank) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="blood_bank"
                            id="blood_bank_upload" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="blood_bank_upload"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('blood_bank')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Other ">
                        @isset($hospital_document->other)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->other) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="other"
                            id="other" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="other"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('other')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>



                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="hospital-fi-form">Save/Update Hospital Facilities and Infrastructure Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Hospital Certificates
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="hospital-certificates-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="hospital_certificates">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="Hospital Registration Certificate*">
                        @isset($hospital_document->hospital_registration_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_registration_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_registration_certificate"
                            id="hospital_registration_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_registration_certificate" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_registration_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Rohini Certificate*">
                        @isset($hospital_document->hospital_rohini_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_rohini_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="hospital_rohini_certificate"
                            id="hospital_rohini_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_rohini_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_rohini_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Pollution Clearance Certificate">
                        @isset($hospital_document->hospital_pollution_clearance_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_pollution_clearance_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_pollution_clearance_certificate"
                            id="hospital_pollution_clearance_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_pollution_clearance_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_pollution_clearance_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Fire Safety Clearance Certificate">
                        @isset($hospital_document->hospital_fire_safety_clearance_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_fire_safety_clearance_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_fire_safety_clearance_certificate" id="hospital_fire_safety_clearance_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_fire_safety_clearance_certificate" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_fire_safety_clearance_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital Certificate of Incorporation ">
                        @isset($hospital_document->hospital_certificate_of_incorporation)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_certificate_of_incorporation) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_certificate_of_incorporation"
                            id="hospital_certificate_of_incorporation" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_certificate_of_incorporation"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_certificate_of_incorporation')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital TAN Certificate ">
                        @isset($hospital_document->hospital_tan_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_tan_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_tan_certificate"
                            id="hospital_tan_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_tan_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_tan_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Hospital GST Certificate ">
                        @isset($hospital_document->hospital_gst_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hospital_gst_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hospital_gst_certificate"
                            id="hospital_gst_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hospital_gst_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hospital_gst_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="NABL Certificate ">
                        @isset($hospital_document->nabl_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->nabl_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="nabl_certificate"
                            id="nabl_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="nabl_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('nabl_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="NABH Certificate ">
                        @isset($hospital_document->nabh_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->nabh_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="nabh_certificate"
                            id="nabh_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="nabh_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('nabh_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="JCI Certificate ">
                        @isset($hospital_document->jci_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->jci_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="jci_certificate"
                            id="jci_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="jci_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('jci_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="NQAC/NHSRC Certificate ">
                        @isset($hospital_document->nqac_or_nhsrc_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->nqac_or_nhsrc_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="nqac_or_nhsrc_certificate"
                            id="nqac_or_nhsrc_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="nqac_or_nhsrc_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('nqac_or_nhsrc_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="HIPPA Certificate ">
                        @isset($hospital_document->hippa_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->hippa_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="hippa_certificate"
                            id="hippa_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="hippa_certificate"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('hippa_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="ISO Certificates ">
                        @isset($hospital_document->iso_certificates)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->iso_certificates) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="iso_certificates"
                            id="iso_certificates" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="iso_certificates"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('iso_certificates')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Other Certificates ">
                        @isset($hospital_document->other_certificates)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->other_certificates) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="other_certificates"
                            id="other_certificates" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="other_certificates"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('other_certificates')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="hospital-certificates-form">Save/Update Hospital Certificates</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Doctor Registration Certificate Documents
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="doctor-registration-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="doctor_registration">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="Medical Superintendent's Registration Certificate*">
                        @isset($hospital_document->medical_superintendents_registration_certificate)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->medical_superintendents_registration_certificate) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="medical_superintendents_registration_certificate"
                            id="medical_superintendents_registration_certificate" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="medical_superintendents_registration_certificate" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('medical_superintendents_registration_certificate')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Doctor's Registration Certificate (Other)">
                        @isset($hospital_document->doctors_registration_certificate_other)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->doctors_registration_certificate_other) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="doctors_registration_certificate_other"
                            id="doctors_registration_certificate_other" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="doctors_registration_certificate_other"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('doctors_registration_certificate_other')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="doctor-registration-form">Save/Update Doctor Registration Certificate Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Hospital MoUs (Signed) Documents
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="mous-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="hospital_mous">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="MoU with BHC">
                        @isset($hospital_document->mou_with_bhc)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->mou_with_bhc) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="mou_with_bhc"
                            id="mou_with_bhc" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="mou_with_bhc" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('mou_with_bhc')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="MoUs with NBFCs / Banks (Triparty)">
                        @isset($hospital_document->mous_with_nbfcs_banks_triparty)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->mous_with_nbfcs_banks_triparty) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="mous_with_nbfcs_banks_triparty"
                            id="mous_with_nbfcs_banks_triparty" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="mous_with_nbfcs_banks_triparty"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('mous_with_nbfcs_banks_triparty')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="MoUs (IC/TPA/Govt./PSU/Other Corporates">
                        @isset($hospital_document->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->mous_ic_or_tpa_or_govt_or_psu_or_other_corporates) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="mous_ic_or_tpa_or_govt_or_psu_or_other_corporates"
                            id="mous_ic_or_tpa_or_govt_or_psu_or_other_corporates" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="mous_ic_or_tpa_or_govt_or_psu_or_other_corporates"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('mous_ic_or_tpa_or_govt_or_psu_or_other_corporates')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="mous-form">Save/Update Hospital MoUs (Signed) Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        Agreed Tariff and Packages with ICs / TPAs / Govt/ PSU / Other Corporates Documents
    </div>
    <div class="card-body">
        <form action="{{ route('admin.hospital-documents.update', $hospital->id) }}"
            method="post" id="hospital-package-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="form_type" value="hospital_packages">
            <div class="form-group row">

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" readonly class="form-control"
                            placeholder="Agreed Tariff and Packages">
                        @isset($hospital_document->agreed_tariff_and_packages)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->agreed_tariff_and_packages) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file" name="agreed_tariff_and_packages"
                            id="agreed_tariff_and_packages" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="agreed_tariff_and_packages" class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('agreed_tariff_and_packages')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <input type="text" class="form-control" readonly
                            placeholder="Other Packages">
                        @isset($hospital_document->other_packages)
                            <a href="{{ asset('storage/uploads/hospital/documents/' . $id . '/' . $hospital_document->other_packages) }}"
                                download="" class="btn btn-warning download-label"><i
                                    class="mdi mdi-download"></i></a>
                        @endisset
                        <input type="file"
                            name="other_packages"
                            id="other_packages" hidden
                            onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');" />
                        <label for="other_packages"
                            class="btn btn-primary upload-label"><i
                                class="mdi mdi-upload"></i></label>
                    </div>
                    @error('other_packages')
                        <span id="name-error"
                            class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 text-end mt-3">
                    <button type="submit" class="btn btn-success"
                        form="hospital-package-form">Save/Update Agreed Tariff and Packages with ICs / TPAs / Govt/ PSU / Other Corporates Documents</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
    </script>
@endpush
