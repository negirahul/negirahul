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
                        <form action="{{ route('admin.hospital-tie-up-authorizations.index') }}">
                            <div class="input-group">
                                <input class="form-control" value="{{ $filter_search }}" name="search" type="search" placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <h4 class="page-title">Pending Hospital Tie-up Authorization</h4>
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
                            @if (count($hospitals_tie_ups) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Hospital ID</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">Date & Time of Tie-up update (Last)</th>
                                            <th scope="col">Linked Admin Name & ID(Assigned Employee's)</th>
                                            <th scope="col">Pending TAT</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hospitals_tie_ups as $hospitals_tie_up)
                                            <tr>
                                                <th scope="row">{{ $hospitals_tie_up->hospital->uid }}</th>
                                                <td>{!! $hospitals_tie_up->hospital->name !!}</td>                  
                                                <td>{{ $hospitals_tie_up->updated_at }}</td>
                                                <td>{{ $hospitals_tie_up->linked_employee_data->firstname}} {{ $hospitals_tie_up->linked_employee_data->lastname}} ({{ $hospitals_tie_up->linked_employee_data->employee_code}})</td>

                                                @php
                                                $startDate = Carbon::parse($hospitals_tie_up->updated_at);
                                                $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                                @endphp
                                                <td>{{ $startDate->diff($endDate)->format('%D : %H:%I'); }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.hospital-tie-up-authorizations.show', $hospitals_tie_up->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                                            <button type="button" title=" Authorize Hospital ID" class="btn btn-danger"  onclick="confirmDelete({{ $hospitals_tie_up->id }})"><i class="uil-shield-check"></i></button>
                                                        <form id='delete-form{{ $hospitals_tie_up->id }}'
                                                            action="{{ route('admin.hospital-tie-up-authorizations.update', $hospitals_tie_up->id) }}"
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
                                <p class="text-center">No Hospital Tie-up found.</p>
                            @endif
                        </div>
                        {{ $hospitals_tie_ups->withQueryString()->links('pagination::bootstrap-4') }}
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
