@php
use Carbon\Carbon;
@endphp
@extends('layouts.super-admin')
@section('title', 'Manage Hospital')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">Assigning Status for Final-Assessment / Claim Authorization</h4>
                </div>
            </div>

            <div class="container">
            <form action="{{ route('super-admin.assigning-final-assessment.index') }}">
               
                <div class="row pb-4">

                    <div class="col-sm-3">
                        <input class="form-control" value="{{ $filter_claim_id }}" name="claim_id" type="search" placeholder="Enter Claim ID">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="date_from_to" placeholder="Select Date from to Date to" class="form-control" value="{{ $filter_date_from_to}}"   >
                    </div>
                    <div class="col-sm-4">

                        <select class="form-select" name="status">
                            <option value="">Select Status</option>
                            <option value="All" @if($filter_status == 'All') selected @endif> All </option>
                            <option value="Waiting for Assigning for Final-Assessment" @if($filter_status == 'Waiting for Assigning for Final-Assessment') selected @endif> Waiting for Assigning for Final-Assessment </option>
                            <option value="Waiting for Final Assessment" @if($filter_status == 'Waiting for Final Assessment') selected @endif> Waiting for Final Assessment</option>
                            <option value="Query Raised by BHC Team" @if($filter_status == 'Query Raised by BHC Team') selected @endif> Query Raised by BHC Team</option>
                            <option value="Non Admissible as per the Policy TC" @if($filter_status == 'Non Admissible as per the Policy TC') selected @endif> Non Admissible as per the Policy TC</option>
                            <option value="Non Admissible as per the Treatment Received" @if($filter_status == 'Non Admissible as per the Treatment Received') selected @endif> Non Admissible as per the Treatment Received</option>
                            <option value="Admissible" @if($filter_status == 'Admissible') selected @endif > Admissible </option>
                        </select>
                    </div> 

                    <div class="col-sm-2">
                        <button class="btn btn-primary" type="submit">Filter</button>
                        <a class="btn btn-warning" href='./assigning-pre-assessment' >Reset</a>
                    </div>
                   
                </div>
                
             </form>
            

           
            </div>
        </div>
        @include('super-admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card no-shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if (count($claims) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Claim ID</th>
                                            <th scope="col">Patient Name(Id)</th>
                                            <th scope="col">Hospital Name(Id)</th>
                                            <th scope="col">Date & Time of Claim Creation</th>
                                            <th scope="col">Pending TAT</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($claims as $claim)
                                            <tr>
                                                <th scope="row">{{ $claim->uid }}</th>
                                                <td>{{ $claim->patient->firstname }} {{ $claim->patient->lastname }} ({{ $claim->patient->uid }})</td>                  
                                                <td>{{ $claim->hospital->name }} ({{ $claim->hospital->uid }})</td>
                                                <td>{{ Carbon::parse($claim->created_at)->format('d-m-Y H:i:s'); }}</td>

                                                @php
                                                $startDate = Carbon::parse($claim->created_at);
                                                $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                                @endphp
                                                <td>{{ $startDate->diff($endDate)->format('%D : %H:%I'); }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('super-admin.assigning-final-assessment.edit', $claim->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No Data found.</p>
                            @endif
                        </div>
                        {{ $claims->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->

@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

    $(function() {

        $('input[name="date_from_to"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="date_from_to"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });

        $('input[name="date_from_to"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });

</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        localStorage.setItem('activeTab', '');
        function confirmDelete(no) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Authorize it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
     <script>
        $(".change-password").click(function () {
                var id = $(this).data('id');
                var uid = $(this).data('uid');
                $('#uid').text(uid);
                $('#employee_code').val(uid);                
                $('#id').val(id);
            });
    </script>
    @error('new_password')
    <script>
        $(document).ready(function () {
            $('#modal-password').modal('show');
        });       
    </script>
    @enderror
@endpush
