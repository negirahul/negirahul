@extends('layouts.super-admin')
@section('title', 'Import Export Hospital')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Claim Stack</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super-admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Hospital</a></li>
                            <li class="breadcrumb-item active">Import Export</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Import Export</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                        <form action="{{ route('super-admin.hospitals.import') }}" method="POST" id="submit-form" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-4">
                                <div class="col-3">
                                    <div class="input-group">
                                        <input type="file" name="file" id="file_hospital_import" hidden="" onchange="$('label[for=' + $(this).attr('id') + ']').removeClass('btn-primary');$('label[for=' + $(this).attr('id') + ']').addClass('btn-warning');">
                                        
                                        <label for="file_hospital_import" class="btn btn-primary upload-label"><i class="mdi mdi-upload"></i> <br> <span style="font-size: 18px;">Import Hospitals</span></label>
                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="input-group">
                                        <a href="{{ route('super-admin.hospitals.export') }}" download="" class="btn btn-danger download-label"><i class="mdi mdi-download"></i> <br><span style="font-size: 18px;">Export Hospitals</span> </a>

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $('#file_hospital_import').change(function() {
      $('#submit-form').submit();
  });
</script>
@endpush
