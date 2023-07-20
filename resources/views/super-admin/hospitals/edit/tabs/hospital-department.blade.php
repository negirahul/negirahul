<form action="{{ route('super-admin.hospitals.department', $hospital->id) }}" method="post" id="hospital-department-form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group row ">
      
    <div class="col-md-12">
                <a href="{{ route('super-admin.hospitals.edit', $hospital->id) }}?show_doctor=1"> <button style="float:right;" type="button" class="btn btn-danger show-empanelment"> <i class="mdi mdi-plus"></i> Add Doctor </button></a>
    </div>
        <input type="hidden" name="doctor_id" id="doctor_id" value="{{ isset($hospital_doctor->id) ? $hospital_doctor->id : '' }}">
        <div class="col-md-6 mt-3 show-hide">
            <label for="specialization">Specialization<span class="text-danger">*</span></label>
            <select class="form-select" id="specialization" name="specialization" >
                <option value="">Select Specialization</option>
                <option value="ENT"              {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'ENT' ? 'selected' : '' }} >ENT</option>
                <option value="Dental"           {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Dental' ? 'selected' : '' }} >Dental</option>
                <option value="Ophthalmology"    {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Ophthalmology' ? 'selected' : '' }}>Ophthalmology</option>
                <option value="Orthopaedic"      {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Orthopaedic' ? 'selected' : '' }}>Orthopaedic</option>
                <option value="Gyne"             {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Gyne' ? 'selected' : '' }}>Gyne</option>
                <option value="Paediatric"       {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Paediatric' ? 'selected' : '' }}>Paediatric</option>
                <option value="Neonatology"      {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Neonatology' ? 'selected' : '' }}>Neonatology</option>
                <option value="Perinatology"     {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Perinatology' ? 'selected' : '' }} >Perinatology</option>1111
                <option value="Nephrology"       {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Nephrology' ? 'selected' : '' }} >Nephrology</option>
                <option value="Hepatology"       {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Hepatology' ? 'selected' : '' }}>Hepatology</option>
                <option value="Neurology"        {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Neurology' ? 'selected' : '' }}>Neurology</option>
                <option value="Cardiac"          {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Cardiac' ? 'selected' : '' }}>Cardiac</option>
                <option value="Oncology"         {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Oncology' ? 'selected' : '' }}>Oncology</option>
                <option value="Gastroenterolog"  {{ old('specialization',isset($hospital_doctor->specialization) ? $hospital_doctor->specialization : '')  == 'Gastroenterolog' ? 'selected' : '' }}>Gastroenterolog</option>
            </select>
            @error('specialization')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 show-hide mt-3">
            <label for="doctors_firstname">Doctors Name <span class="text-danger">*</span></label>
            <div class="input-group">
            <input type="text" maxlength="15" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="doctors_firstname" name="doctors_firstname"
                placeholder="Firstname" value="{{old('doctors_firstname',isset($hospital_doctor->doctors_firstname) ? $hospital_doctor->doctors_firstname : '')}}">


            <input type="text" maxlength="30" style="margin-left:10px;" onkeydown="return /[a-z, ]/i.test(event.key)" class="form-control" id="doctors_lastname" name="doctors_lastname"
                placeholder="Lastname" value="{{old('doctors_lastname', isset($hospital_doctor->doctors_lastname) ? $hospital_doctor->doctors_lastname : '' )}}" >

            </div>
            @error('doctors_firstname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
            @error('doctors_lastname')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <input type="hidden" name="show_doctor" id="show-doctor" value="1">

        <div class="col-md-6 show-hide mt-3">
            <label for="registration_no">Registration No.  <span class="text-danger">*</span></label>
            <input type="text" maxlength="20"  class="form-control" id="registration_no" name="registration_no"
                placeholder="Enter Registration No." value="{{old('registration_no',isset($hospital_doctor->registration_no) ? $hospital_doctor->registration_no : '')}}" >
            @error('registration_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 show-hide mt-3">
            <label for="email_id">Email ID <span class="text-danger">*</span></label>
            <input type="email" maxlength="45"  class="form-control" id="email_id" name="email_id"
                placeholder="Enter Email ID" value="{{old('email_id',isset($hospital_doctor->email_id) ? $hospital_doctor->email_id : '')}}" >
            @error('email_id')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>


        <div class="col-md-6 show-hide mt-3">
            <label for="phone">Doctor's Mobile No. <span
                    class="text-danger">*</span></label>
                    <div class="input-group">
                        <label class="input-group-text" for="phone">+91</label>
                            <input type="number" class="form-control" id="phone" name="doctors_mobile_no"  pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"  placeholder="Enter Doctor's Mobile No." value="{{old('doctors_mobile_no',isset($hospital_doctor->doctors_mobile_no) ? $hospital_doctor->doctors_mobile_no : '')}}">
                    </div>
            @error('doctors_mobile_no')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-md-6 show-hide mt-3">

            <label for="email_id">Upload Doctor's Registration Certificate <span class="text-danger">*</span></label>
            <br>
            @isset($hospital_doctor->upload)
                    <a href="{{ asset('storage/uploads/hospital/department/'.$hospital_doctor->hospital_id.'/'.$hospital_doctor->upload) }}" download="" class="btn btn-warning download-label"><i class="mdi mdi-download"></i></a>
                @endisset
            <input type="file" name="upload" id="dofsupload" hidden onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');"/>
            <label for="dofsupload" class="btn btn-primary upload-label">
                 <i class="mdi mdi-upload"></i></label>
                @error('upload')
                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
        </div>

        <div class="col-md-12 text-end mt-3 show-hide">
            <button type="submit" class="btn btn-success" form="hospital-department-form">Add/update Hospital Department</button>
        </div>
    </div>
</form>

<div class="table-responsive mt-3">
   <table id="basics-datatable" class="table table-hover table-striped">
      <thead class="thead-grey">
         <tr>
            <th scope="col">Doctors Name</th>
            <th scope="col">Registration No.</th>
            <th scope="col">Specialization</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
        @if(!empty($hospital_department))
        @foreach($hospital_department as $hod)
         <tr>
            <td scope="row">{{ $hod->doctors_firstname." ".$hod->doctors_lastname}}</td>
            <td scope="row">{{ $hod->registration_no }}</td>
            <td scope="row">{{ $hod->specialization }}</td>
            <td scope="row">
               <a href="{{ url('super-admin/hospitals/'.$hod->hospital_id.'/edit?show_doctor=1&doctor_id=').$hod->id }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
               <button type="button" class="btn btn-danger" onclick="confirmDeleteDoctor({{$hod->id}})"><i class="uil uil-trash-alt"></i></button>
               <form id="delete-form{{ $hod->id }}" action="{{ route('super-admin.hospitals.doctor-delete', $hod->id ) }}" method="POST">
                @csrf  
               </form>
            </td>
         </tr>
         @endforeach
         @endif
      </tbody>
   </table>
</div>


@push('scripts')
    <script>
$(document).ready(function() {
  var sd = "{{ isset($_GET['show_doctor']) ? $_GET['show_doctor'] : ''  }}";
  if(sd == 1)
  $(".show-hide").show();
  else
  $(".show-hide").hide();

    $("#show-doctor").val(0);
  $('.show-doctors').click(function() {
    $(".show-hide").toggle('fast');
    $("#show-doctor").val(1);
  });
});
    </script>
     <script type="text/javascript">
        function confirmDeleteDoctor(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
@endpush
