<form action="{{ route('associate-partner.hospitals.empanelment-status', $hospital->id) }}" method="post" id="hospital-empanelment-status-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Insurer</th>
                    <th>Type</th>
                    <th>
                        <button type="button" class="btn btn-sm btn-warning  me-1 float-end" onclick="$('.mcer').prop('checked', true);">Select All</button>
                        <button type="button" class="btn btn-sm btn-danger  me-1 float-end" onclick="$('.mcer').prop('checked', false);">Deselect All</button>
                    </th>
                    <th>
                        Upload
                    </th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($insurers as $insurer)
                <tr>
                    <td>{{ $insurer->name }}</td>
                    <td>{{ $insurer->type }}</td>
                    <td style="text-align: center;"><input class="form-check-input mcer" name="insurer[]" type="checkbox"  value="{{ $insurer->name }}"></td>
                    <td>
                        <div class="col-md-1">
                            <input type="file" name="insurer_file" id="insurer_file_upload" hidden />
                            <label for="insurer_file_upload" class="btn btn-primary upload-label">
                                <i class="mdi mdi-cloud-upload"></i>
                            </label>
                            @error('insurer_file')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        

        <div class="col-md-12 text-end mt-3">
            <button type="submit" class="btn btn-success" form="hospital-empanelment-status-form">Update
                Hospital Empanelment Status</button>
        </div>
    </div>
</form>
