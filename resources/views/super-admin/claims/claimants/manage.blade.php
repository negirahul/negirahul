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
                        <form action="{{ route('super-admin.claimants.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" type="search"placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Manage Claimants</h4>
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
                                            <th scope="col">Patient UID</th>
                                            <th scope="col">Claim UID</th>
                                            <th scope="col">Claimant UID</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">State</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Pincode</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($claimants as $claimant)
                                            <tr>
                                                <th>{{ $claimant->patient->uid }}</th>
                                                <th scope="row">{{ $claimant->claim->uid }}</th>
                                                <th scope="row">{{ $claimant->uid }}</th>
                                                <td>{{ @$claimant->patient->firstname }} {{ @$claimant->patient->middlename }} {{ @$claimant->patient->lastname }}</td>
                                                <td>{{ @$claimant->patient->hospital->name }}</td>
                                                <td>{{ $claimant->state }}</td>
                                                <td>{{ $claimant->city }}</td>
                                                <td>{{ $claimant->pincode }}</td>
                                                <td class="text-center">

                                                    <div class="input-group">

                                                        <button type="button" class="btn btn-primary 
                                                            dropdown-toggle" 
                                                            data-bs-toggle="dropdown">
                                                                Action
                                                        </button>
                                                        
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('super-admin.claimants.edit', @$claimant->id) }}">
                                                                <i class="mdi mdi-pencil"></i> Edit Claimant</a>
                                                            </li>

                                                            @if(@$claimant->icclaim_status && !empty(@$claimant->icclaim_status))
                                                            <li><a class="dropdown-item" href="{{ route('super-admin.icclaim-status.create', ['claimant_id' => $claimant->id]) }}">
                                                                <i class="mdi mdi-pencil"></i> Insurance Company Claim Status</a></li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('super-admin.icclaim-status.create', ['claimant_id' => $claimant->id]) }}">
                                                                 <i class="mdi mdi-plus"></i> Insurance Company Claim Status</a></li>
                                                            @endif
                                                            
                                                        </ul>
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
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form' + no).submit();
                }
            })
        };
    </script>
@endpush
