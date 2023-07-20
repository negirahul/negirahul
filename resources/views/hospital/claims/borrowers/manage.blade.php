@extends('layouts.hospital')
@section('title', 'Manage Claimants')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('hospital.borrowers.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" type="search"placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Manage Borrowers</h4>
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
                            @if (count($borrowers) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Patient UID</th>
                                            <th scope="col">Claim UID</th>
                                            <th scope="col">Borrower UID</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">State</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Pincode</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($borrowers as $borrower)
                                            <tr>
                                                <th>{{ $borrower->patient->uid }}</th>
                                                <th scope="row">{{ $borrower->claim->uid }}</th>
                                                <th scope="row">{{ $borrower->uid }}</th>
                                                <td>{{ @$borrower->patient->firstname }} {{ @$borrower->patient->middlename }} {{ @$borrower->patient->lastname }} </td>
                                                <td>{{ @$borrower->hospital->name }}</td>
                                                <td>{{ $borrower->borrower_state }}</td>
                                                <td>{{ $borrower->borrower_city }}</td>
                                                <td>{{ $borrower->borrower_pincode }}</td>
                                                <td class="text-center">
                                                   <div class="input-group">
                                                        <button type="button" class="btn btn-primary 
                                                            dropdown-toggle" 
                                                            data-bs-toggle="dropdown">
                                                                Action &nbsp;
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" @if(!$borrower->status) style="pointer-events: none; display: inline-block;" @endif href="{{ route('hospital.borrowers.edit', @$borrower->claim->id) }}">
                                                                <i class="mdi mdi-pencil"></i> Edit Borrower</a>
                                                            </li>

                                                            @if($borrower->lending_status && !empty($borrower->lending_status))
                                                            <li><a class="dropdown-item" href="{{ route('hospital.lending-status.create', ['borrower_id' => $borrower->id]) }}">
                                                                <i class="mdi mdi-pencil"></i> Lending Status</a></li>
                                                            @else
                                                            <li><a class="dropdown-item" href="{{ route('hospital.lending-status.create', ['borrower_id' => $borrower->id]) }}">
                                                                 <i class="mdi mdi-plus"></i> Lending Status</a></li>
                                                            @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center mt-5 mb-5">No Borrower found.</p>
                            @endif
                        </div>
                        {{ $borrowers->withQueryString()->links('pagination::bootstrap-4') }}
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
