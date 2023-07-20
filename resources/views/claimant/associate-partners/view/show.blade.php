@extends('layouts.admin')
@section('title', 'Create Associate Partners')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Associate Partner</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Associate Partner</h4>
                </div>
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body p-0" >
                        <div class="" style="background:#3E4097">
                            <div class="d-flex align-items-center mb-2" >
                                <div class="flex-shrink-0">
                                    <div class="avatar-md" style="margin-top: 10px;margin-left:20px ;">
                                        <span class="avatar-title bg-success  rounded-circle"style="background: white;">
                                            AP
                                        </span>
                                    </div>

                                </div>
                                <div class="d-flex flex-row align-items-center m-2 text-white">
                                    <p class="mb-0 me-2">{{$associate->name }}<br> Associate Partner Status | UID</p>
                                </div>
                            </div>
                            <div class="col-12 nav nav-tabs" id="myTab" >
                                <a class="text-white px-2 active" href="#home" c data-bs-toggle="tab">Documents</a>
                                <a class="text-white px-2" href="#profile" data-bs-toggle="tab">MOU</a>
                            </div>
                        </div>
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="home">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a oncontextmenu="return false;" @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) target="_blank"  href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->panfile) }}" @else href="javascript:void(0)" @endif>Associate Partner Pan Number</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->panfile) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>
                                                </tr>

                                                @if($associate_files && (count($associate_files) > 0) && isset($associate_files['panfile']) && $associate_files['panfile'])
                                                @foreach($associate_files['panfile'] as $moufile1)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}">Associate Partner Pan Number{{ $moufile1->file_id }}</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                                <tr>
                                                    <td><a oncontextmenu="return false;" @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) target="_blank" href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->cancel_cheque_file) }}" @else href="javascript:void(0)" @endif>Cancel Cheque</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->cancel_cheque_file) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>
                                                </tr>

                                                @if($associate_files && (count($associate_files) > 0) && isset($associate_files['cancel_cheque_file']) && $associate_files['cancel_cheque_file'])
                                                @foreach($associate_files['cancel_cheque_file'] as $moufile1)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}">Cancel Cheque{{ $moufile1->file_id }}</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="profile">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><a oncontextmenu="return false;" @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) target="_blank" href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->moufile) }}" @else href="javascript:void(0)" @endif>MOU</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$associate->moufile) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>
                                                </tr>

                                                @if($associate_files && (count($associate_files) > 0) && isset($associate_files['moufile']) && $associate_files['moufile'])
                                                @foreach($associate_files['moufile'] as $moufile1)
                                                <tr>
                                                    <td><a target="_blank" href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}">MOU{{ $moufile1->file_id }}</a></td>
                                                    <td><a @if(auth()->check() && auth()->user()->hasDirectPermission('Downloading Rights')) href="{{ asset('storage/uploads/associate-partners/'.$associate->id.'/'.$moufile1->file_path) }}" download @endif class=" download-label"><i class="mdi mdi-download"></i></a></td>

                                                </tr> 
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

