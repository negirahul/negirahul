@php
use Carbon\Carbon;
@endphp
@extends('layouts.super-admin')
@section('title', 'Manage Claimants')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('super-admin.claimant-authorizations.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" value="{{ $filter_search }}" type="search" placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Pending Claimant IDs Authorization</h4>
                </div>
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
                            @if (count($claimants) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Claimant ID</th>
                                            <th scope="col">Claimant Name</th>
                                            <th scope="col">Date & Time of ID Creation</th>
                                            <th scope="col">Linked Admin Name & ID(Assigned Employee's)</th>
                                            <th scope="col">Pending TAT</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($claimants as $claimant)
                                        <tr>
                                            <th scope="row">{{ $claimant->uid }}</th>
                                            <td>{{ $claimant->firstname }} {{ $claimant->middlename }} {{ $claimant->lastname }}</td>
                                            <td>{{ $claimant->created_at }}</td>
                                            <td>{{ @$claimant->linked_employee_data->firstname}} {{ @$claimant->linked_employee_data->lastname}} ({{ @$claimant->linked_employee_data->employee_code}})</td>
                                            @php
                                            $startDate = Carbon::parse($claimant->created_at);
                                            $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                            @endphp
                                            <td>{{ $startDate->diff($endDate)->format('%D : %H:%I'); }}</td>
                                            <td>

                                                <div class="btn-group">

                                                    <a class="btn btn-primary" href="{{ route('super-admin.claimant-authorizations.show', $claimant->id) }}">
                                                        <i class="mdi mdi-eye"></i>
                                                    </a>

                                                    <button type="button" title=" Authorize Hospital ID" class="btn btn-danger"  onclick="confirmDelete({{ $claimant->id }})"><i class="uil-shield-check"></i></button>
                                                    <form id='delete-form{{ $claimant->id }}'
                                                        action="{{ route('super-admin.claimant-authorizations.update', $claimant->id) }}"
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
                                <p class="text-center mt-5 mb-5">No Claimants found.</p>
                            @endif
                        </div>
                        {{ $claimants->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->

@endsection
{{-- @push('filter')
    @include('super-admin.filters.question-filter')
@endpush --}}
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
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
@endpush
