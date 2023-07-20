@extends('layouts.claimant')
@section('title', 'Dashboard')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('claimant.dashboard') }}">Claim Stack</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        {{-- <div class="row">
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="mdi mdi-account-group float-end"></i>
                        <h6 class="text-uppercase mt-0">Total Associate Partners</h6>
                        <h2 class="my-2" id="active-users-count">{{ $total_associates }}</h2>
                    </div> <!-- end card-body-->
                </div>
                <!--end card-->
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="mdi mdi-account-group float-end"></i>
                        <h6 class="text-uppercase mt-0">Vendor Associate Partners</h6>
                        <h2 class="my-2" id="active-users-count">{{ $vendor_associates }}</h2>
                    </div> <!-- end card-body-->
                </div>
                <!--end card-->
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="mdi mdi-account-group float-end"></i>
                        <h6 class="text-uppercase mt-0">Sales Associate Partners</h6>
                        <h2 class="my-2" id="active-users-count">{{ $sales_associates }}</h2>
                    </div> <!-- end card-body-->
                </div>
                <!--end card-->
            </div>
        </div> --}}
        <div class="row">
            <div class="col-xl-6">
                <h4 class="header-title">Monthly</h4>
                <div dir="ltr">
                    <div id="line-chart-realtime" class="apex-charts" data-colors="#39afd1"></div>
                </div>
            </div>
            <div class="col-xl-6">
                <h4 class="header-title mb-4">Week</h4>
                <div dir="ltr">
                    <div id="simple-pie" class="apex-charts" data-colors="#727cf5,#6c757d,#0acf97,#fa5c7c,#e3eaef">

                    </div>
                </div>
            </div>
            <div class="com-xl-12">
                <h4 class="header-title mb-4">Year</h4>

                <div dir="ltr">
                    <div class="mt-3 chartjs-chart" style="height: 320px;">
                        <canvas id="bar-chart-example" data-colors="#fa5c7c,#727cf5"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/vendor/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/demo.chartjs.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/demo.apex-pie.js') }}"></script>

    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
    <script src="{{ asset('assets/js/pages/demo.apex-line.js') }}"></script>
@endpush
