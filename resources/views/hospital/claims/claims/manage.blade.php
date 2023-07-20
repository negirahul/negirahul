@extends('layouts.hospital')
@section('title', 'Manage Claims')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('hospital.claims.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" type="search"placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Manage Claims</h4>
                </div>
            </div>
        </div>
        @include('hospital.sections.flash-message')
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
                                            <th scope="col">Patient UID</th>
                                            <th scope="col">Claim UID</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">State</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Pincode</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($claims as $claim)
                                            <tr>
                                                <th>{{ $claim->patient->uid }}</th>
                                                <th>{{ $claim->uid }}</th>
                                                <td>{{ $claim->patient->title }} {{ $claim->patient->firstname }} {{ $claim->patient->middlename }} {{ $claim->patient->lastname }}</td>
                                                <td>{{ $claim->patient->hospital->name }}</td>
                                                <td>{{ $claim->patient->patient_current_city }}</td>
                                                <td>{{ $claim->patient->patient_current_state }}</td>
                                                <td>{{ $claim->patient->patient_current_pincode }}</td>
                                                <td class="text-center">
                                                   <div class="input-group">
                                                        <button type="button" class="btn btn-primary 
                                                            dropdown-toggle" 
                                                            data-bs-toggle="dropdown">
                                                                Action
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="{{ route('hospital.claims.edit', @$claim->id) }}">
                                                                <i class="mdi mdi-pencil"></i> Edit Claim</a>
                                                            </li>
                                                            @if($claim->claimant && !empty($claim->claimant))
                                                            <li><a class="dropdown-item" @if(!$claim->claimant_status) style="pointer-events: none; display: inline-block;" @endif href="{{ route('hospital.claimants.edit', $claim->claimant) }}">
                                                                <i class="mdi mdi-pencil"></i> Claimant</a></li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.claimants.create', ['claim_id' => $claim->id]) }}">
                                                                 <i class="mdi mdi-plus"></i> Claimant</a></li>
                                                            @endif

                                                            @if($claim->borrower && !empty($claim->borrower))
                                                            <li><a class="dropdown-item" @if(!$claim->borrower_status) style="pointer-events: none; display: inline-block;" @endif  href="{{ route('hospital.borrowers.edit', $claim->id) }}">
                                                                <i class="mdi mdi-pencil"></i> Borrower</a>
                                                            </li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.borrowers.edit', $claim->id) }}">
                                                                <i class="mdi mdi-plus"></i> Borrower</a>
                                                            </li>
                                                            @endif

                                                            @if($claim->assessment && !empty($claim->assessment))
                                                            <li><a class="dropdown-item" href="{{ route('hospital.assessment-status.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-pencil"></i> Assessment Status</a>
                                                            </li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.assessment-status.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-plus"></i> Assessment Status</a>
                                                            </li>
                                                            @endif

                                                            @if($claim->discharge && !empty($claim->discharge))
                                                            <li><a class="dropdown-item" href="{{ route('hospital.discharge-status.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-pencil"></i> Discharge Status</a>
                                                            </li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.discharge-status.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-plus"></i> Discharge Status</a>
                                                            </li>
                                                            @endif

                                                            @if($claim->claim_processing && !empty($claim->claim_processing))
                                                            <li><a class="dropdown-item" href="{{ route('hospital.claim-processing.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-pencil"></i> Claim Processing</a>
                                                            </li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.claim-processing.create', ['claim_id' => $claim->id]) }}">
                                                                <i class="mdi mdi-plus"></i> Claim Processing</a>
                                                            </li>
                                                            @endif

                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No Claims found.</p>
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
{{-- @push('filter')
    @include('hospital.filters.question-filter')
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
