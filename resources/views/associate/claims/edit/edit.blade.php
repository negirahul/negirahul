@extends('layouts.associate')
@section('title', 'Edit Hospitals')
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
                            <li class="breadcrumb-item"><a href="{{ route('associate-partner.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Hospital</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Claims</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->
        
        <!-- start page content -->
        <div class="row">
            <div class="col-12">
                <div class="card no-shadow">
                    <div class="card-body">
                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" style="white-space: nowrap;">
                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0 active">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Patient ID Creation</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#claim_claim" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claim ID Creation/Intimation</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Insurance Policy Details</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claimant Details</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claimant Documents</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Assessment Status</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Bill Entry</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Document Processing</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claim Authorization</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claim Document Status</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Claim Statuss</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#hospital_details" data-bs-toggle="tab" aria-expanded="true"
                                    class="nav-link rounded-0">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Lending Status</span>
                                </a>
                            </li>                           

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="claim">
                                @include('admin.claims.edit.tabs.patient')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.policy')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claiment')
                            </div>                            

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>

                            <div class="tab-pane" id="claim">
                                @include('admin.claims.edit.tabs.claim')
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
