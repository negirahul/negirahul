@php
use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('title', 'Manage Hospital')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('admin.hospital-empstatus-authorizations.index') }}">
                            <div class="input-group">
                                <input class="form-control" value="{{ $filter_search }}" name="search" type="search" placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <h4 class="page-title">Pending Hospital Emanelment Status Authorization</h4>
                </div>
            </div>
        </div>
        @include('admin.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card no-shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if (count($hospital_empanelments) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Hospital ID</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">Date & Time of ID Creation</th>
                                            <th scope="col">Linked Admin Name & ID(Assigned Employee's)</th>
                                            <th scope="col">Pending TAT</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hospital_empanelments as $hospital_empanelment)
                                            <tr>
                                                <th scope="row">{{ $hospital_empanelment->hospital->uid }}</th>
                                                <td>{!! $hospital_empanelment->hospital->name !!}</td>                  
                                                <td>{{ $hospital_empanelment->created_at }}</td>
                                                <td>{{ $hospital_empanelment->linked_employee_data->firstname}} {{ $hospital_empanelment->linked_employee_data->lastname}} ({{ $hospital_empanelment->linked_employee_data->employee_code}})</td>

                                                @php
                                                $startDate = Carbon::parse($hospital_empanelment->created_at);
                                                $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                                @endphp
                                                <td>{{ $startDate->diff($endDate)->format('%D : %H:%I'); }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.hospital-empstatus-authorizations.show', $hospital_empanelment->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                                            <button type="button" title=" Authorize Hospital ID" class="btn btn-danger"  onclick="confirmDelete({{ $hospital_empanelment->id }})"><i class="uil-shield-check"></i></button>
                                                        <form id='delete-form{{ $hospital_empanelment->id }}'
                                                            action="{{ route('admin.hospital-empstatus-authorizations.update', $hospital_empanelment->id) }}"
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                            value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='PUT'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No Hospital Emanelment Status found.</p>
                            @endif
                        </div>
                        {{ $hospital_empanelments->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->

@endsection
{{-- @push('filter')
    @include('admin.filters.question-filter')
@endpush --}}
@push('scripts')
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
