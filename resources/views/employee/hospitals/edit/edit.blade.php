@extends('layouts.employee')
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
                            <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Hospital</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Hospital</h4>
                </div>
            </div>
        </div>
        @include('employee.sections.flash-message')
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
                                    <span class="d-none d-md-block">Hospital Details</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_tie_up_details" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Hospital Tie-Ups</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_facilities" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Hospital Facilities</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_infrastructures" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Hospital Infrastructure</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#hospital_department" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Hospital Department</span>
                                </a>
                            </li>

                            <li class="nav-item" style="display: none;">
                                <a href="#empanelment_status" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Empanelment Status</span>
                                </a>
                            </li>

                            <li class="nav-item" style="display: none;">
                                <a href="#negative_isting" data-bs-toggle="tab" aria-expanded="false"
                                    class="nav-link rounded-0 ">
                                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                    <span class="d-none d-md-block">Negative Listing</span>
                                </a>
                            </li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="hospital_details">
                                @include('employee.hospitals.edit.tabs.hospital-details')
                            </div>
                            <div class="tab-pane" id="hospital_tie_up_details">
                                @include('employee.hospitals.edit.tabs.hospital-tie-up-details')
                            </div>
                            <div class="tab-pane" id="hospital_facilities">
                                @include('employee.hospitals.edit.tabs.hospital-facilities')
                            </div>
                            <div class="tab-pane" id="hospital_infrastructures">
                                @include('employee.hospitals.edit.tabs.hospital-infrastructures')
                            </div>
                            <div class="tab-pane" id="hospital_department">
                                @include('employee.hospitals.edit.tabs.hospital-department')
                            </div>
                            <div class="tab-pane" id="empanelment_status">
                                @include('employee.hospitals.edit.tabs.hospital-empanelment-status')
                            </div>
                            <div class="tab-pane" id="negative_isting">
                                @include('employee.hospitals.edit.tabs.hospital-negative-listing-status')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
