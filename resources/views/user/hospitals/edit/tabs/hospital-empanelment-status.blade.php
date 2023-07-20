<div class="card-body">
    <form action="{{ route('user.hospitals.empanelment-status', $hospital->id) }}" method="post" id="hospital-empanelment-form"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="empanelment_status">
        <div class="form-group row">
            <div class="col-md-12">
                <button style="float:right;" type="button" class="btn btn-danger show-empanelment"> <i class="mdi mdi-plus"></i> Add Insurance Co. / TPA / Other </button>
            </div>


            <div class="col-md-12 show-hide-empanelment mt-3">
                <label for="company_name">Company Name<span class="text-danger">*</span></label>
                <select class="form-select" id="company_name" name="company_name">
                    <option value="">Select Company Name</option>
                    @foreach ($insurers as $insurer)
                    <option value="{{ $insurer->id }}" {{ old('company_name', $empanelment_status->company_name ?? '') == $insurer->id ? 'selected' : '' }}>{{ $insurer->name }}</option>
                    @endforeach
                </select>
                @error('company_name')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="card-header bg-dark text-white mt-3 show-hide-empanelment"> Hospital Documents </div>

            <div class="col-md-6 show-hide-empanelment mt-3">
                <label for="empanelled">Empanelled<span class="text-danger">*</span></label>
                <div class="input-group">
                <select onchange="enableDisable()" class="form-select" id="empanelled" name="empanelled">
                    <option value="">Select Company Name</option>
                    <option value="Yes" {{ old('empanelled', $empanelment_status->empanelled ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('empanelled', $empanelment_status->empanelled ?? '') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @isset($empanelment_status->empanelled_file)
                    <a href="{{ asset('storage/uploads/hospital/empanelment_status/'.$empanelment_status->hospital_id.'/'.$empanelment_status->empanelled_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
                <input type="file" name="empanelled_file" id="empanelled_file_id" hidden />
                    <label for="empanelled_file_id" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
                    </div>
                @error('empanelled')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('empanelled_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-6 show-hide-empanelment mt-3">
                <label for="hospital_id_as_per_the_selected_company">Hospital ID (as per the selected company) <span class="text-danger">*</span></label>
                <input type="text" maxlength="25" readonly class="form-control" id="hospital_id_as_per_the_selected_company" name="hospital_id_as_per_the_selected_company"
                placeholder="Enter Hospital ID" value="{{ old('hospital_id_as_per_the_selected_company', $empanelment_status->hospital_id_as_per_the_selected_company ?? '') }}">
                @error('hospital_id_as_per_the_selected_company')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 show-hide-empanelment mt-3">
                <label for="signed_mou">Signed MoU<span class="text-danger">*</span></label>
                <div class="input-group">
                <select disabled class="form-select" id="signed_mou" name="signed_mou">
                    <option value="">Select Signed MoU</option>
                    <option value="Yes" {{ old('signed_mou', $empanelment_status->signed_mou ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('signed_mou', $empanelment_status->signed_mou ?? '') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @isset($empanelment_status->signed_mou_file)
                    <a href="{{ asset('storage/uploads/hospital/empanelment_status/'.$empanelment_status->hospital_id.'/'.$empanelment_status->signed_mou_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
                <input type="file" name="signed_mou_file" id="signed_mou_file_id" hidden />
                    <label for="signed_mou_file_id" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
                    </div>
                @error('signed_mou')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('signed_mou_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-6 show-hide-empanelment mt-3">
                <label for="agreed_packages_and_tariff_pdf_other_images">Agreed Packages and Tariff (PDF & Other Images)<span class="text-danger">*</span></label>
                <div class="input-group">
                <select disabled class="form-select" id="agreed_packages_and_tariff_pdf_other_images" name="agreed_packages_and_tariff_pdf_other_images">
                    <option value="">Select Agreed Packages and Tariff</option>
                    <option value="Yes" {{ old('agreed_packages_and_tariff_pdf_other_images', $empanelment_status->agreed_packages_and_tariff_pdf_other_images ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="As Per Hospital Tariff" {{ old('agreed_packages_and_tariff_pdf_other_images', $empanelment_status->agreed_packages_and_tariff_pdf_other_images ?? '') == 'As Per Hospital Tariff' ? 'selected' : '' }}>As Per Hospital Tariff</option>
                </select>
                @isset($empanelment_status->agreed_packages_and_tariff_pdf_other_images_file)
                    <a href="{{ asset('storage/uploads/hospital/empanelment_status/'.$empanelment_status->hospital_id.'/'.$empanelment_status->agreed_packages_and_tariff_pdf_other_images_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
                <input type="file" name="agreed_packages_and_tariff_pdf_other_images_file" id="agreed_packages_and_tariff_pdf_other_images_file_id" hidden />
                    <label for="agreed_packages_and_tariff_pdf_other_images_file_id" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
                    </div>
                @error('agreed_packages_and_tariff_pdf_other_images')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('agreed_packages_and_tariff_pdf_other_images_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-12 show-hide-empanelment mt-3">
                <label for="upload_packages_and_tariff_excel_or_csv">Upload - Packages and Tariff (Excel / CSV)<span class="text-danger">*</span></label>
                <div class="input-group">
                <select class="form-select" id="upload_packages_and_tariff_excel_or_csv" name="upload_packages_and_tariff_excel_or_csv">
                    <option value="">Select Upload - Packages and Tariff</option>
                    <option value="Yes" {{ old('upload_packages_and_tariff_excel_or_csv', $empanelment_status->upload_packages_and_tariff_excel_or_csv ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('upload_packages_and_tariff_excel_or_csv', $empanelment_status->upload_packages_and_tariff_excel_or_csv ?? '') == 'No' ? 'selected' : '' }}>No</option>
                </select>
                @isset($empanelment_status->upload_packages_and_tariff_excel_or_csv_file)
                    <a href="{{ asset('storage/uploads/hospital/empanelment_status/'.$empanelment_status->hospital_id.'/'.$empanelment_status->upload_packages_and_tariff_excel_or_csv_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
                <input type="file" name="upload_packages_and_tariff_excel_or_csv_file" @if($empanelment_status->upload_packages_and_tariff_excel_or_csv ?? '' == 'No') disabled @endif id="upload_packages_and_tariff_excel_or_csv_file" hidden />
                    <label for="upload_packages_and_tariff_excel_or_csv_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
                    </div>
                @error('upload_packages_and_tariff_excel_or_csv')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
                @error('upload_packages_and_tariff_excel_or_csv_file')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <input type="hidden" name="show_doctor" id="show-doctor-empanelment" value="0">

            <div class="col-md-12 show-hide-empanelment text-end mt-3">
                <button type="submit" class="btn btn-success" form="hospital-empanelment-form">Edit/Update - Packages and Tariff</button>
            </div>

            </div>
        </form>

    <form action="{{ route('user.hospitals.empanelment-status', $hospital->id) }}" method="post" id="hospital-empanelment-status-form"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="form_type" value="empanelment_status_update">
        <div class="form-group row">
            
            <div class="card-header bg-dark text-white mt-3 show-hide-empanelment"> Claim Form for Reimbursement </div>


            <div class="card-header bg-dark text-white mt-3 show-hide-empanelment"> Cashless Pre - Authorization Request Form</div>


            <div class="col-md-12 show-hide-empanelment mt-3">
                <label for="negative_listing_status">Negative Listing Status<span class="text-danger">*</span></label>
                <div class="input-group">
                    <select class="form-select" id="negative_listing_status" name="negative_listing_status">
                        <option value="">Select Negative Listing Status</option>
                        <option value="Yes" {{ old('negative_listing_status', $empanelment_status->negative_listing_status ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ old('negative_listing_status', $empanelment_status->negative_listing_status ?? '') == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                    @isset($empanelment_status->negative_listing_status_file)
                        <a href="{{ asset('storage/uploads/hospital/empanelment_status/'.$empanelment_status->hospital_id.'/'.$empanelment_status->negative_listing_status_file) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                    @endisset
                    <input type="file" name="negative_listing_status_file" @if($empanelment_status->negative_listing_status == 'No') disabled @endif id="negative_listing_status_file" hidden />
                    <label for="negative_listing_status_file" class="btn btn-primary upload-label"><i
                        class="mdi mdi-upload"></i></label>
                    </div>
                    @error('negative_listing_status')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror

                    @error('negative_listing_status_file')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-12 show-hide-empanelment mt-3">
                    <label for="hospital_empanelment_status_comments">Hospital Empanelment Status Comments </label>
                    <textarea class="form-control" id="hospital_empanelment_status_comments" name="hospital_empanelment_status_comments" maxlength="250" placeholder="Comments" rows="4">{{ old('hospital_empanelment_status_comments', $empanelment_status->hospital_empanelment_status_comments??'') }}</textarea>
                    @error('hospital_empanelment_status_comments')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-md-12 show-hide-empanelment text-end mt-3">
                <button type="submit" class="btn btn-success" form="hospital-empanelment-status-form">Save / Update </button>
            </div>


            </div>
        </form>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            enableDisable();
            $(".show-hide-empanelment").hide();
            $("#show-doctor-empanelment").val(0);

            $('.show-empanelment').click(function() {
                $(".show-hide-empanelment").toggle('fast');
                $("#show-doctor-empanelment").val(1);
            });
        });


        function enableDisable() {
            if($("#empanelled").val() == 'Yes'){
                $("#hospital_id_as_per_the_selected_company").removeAttr('readonly');
                $("#signed_mou").removeAttr('disabled');
                $("#agreed_packages_and_tariff_pdf_other_images").removeAttr('disabled');
            }else{
                $("#hospital_id_as_per_the_selected_company").attr('readonly', true);
                $("#signed_mou").attr('disabled', true)
                $("#agreed_packages_and_tariff_pdf_other_images").attr('disabled', true)
            }
        }

        $('select').on('change', function(){
            var id = $(this).attr('id');
            if($(this).val() == 'No'){
                $("#"+id+"_file").attr('disabled',true);
            }else{
                $("#"+id+"_file").attr('disabled',false);
            }
        });
        $(".show-hide-empanelment").toggle('fast');

        $(document).ready(function() {
            var shsh = "{{ old('empanelled', $empanelment_status->empanelled) }}";

            if(shsh == 'Yes' || shsh == 'No'){
                $(".show-hide-empanelment").toggle('fast');
            }
        });

    </script>
    @endpush
