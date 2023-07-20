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
                        <form action="{{ route('admin.hospital-authorizations.index') }}">
                            <div class="input-group">
                                <input class="form-control" value="{{ $filter_search }}" name="search" type="search" placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                    <h4 class="page-title">Pending Hospital IDs Authorization</h4>
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
                            @if (count($hospitals) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Associate Hospital ID</th>
                                            <th scope="col">Hospital Name</th>
                                            <th scope="col">Date & Time of ID Creation</th>
                                            <th scope="col">Linked Admin Name & ID(Assigned Employee's)</th>
                                            <th scope="col">Pending TAT</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hospitals as $hospital)
                                            <tr>
                                                <th scope="row">{{ $hospital->uid }}</th>
                                                <td>{!! $hospital->name !!}</td>                  
                                                <td>{{ $hospital->created_at }}</td>
                                                <td>{{ $hospital->linked_employee_data->firstname}} {{ $hospital->linked_employee_data->lastname}} ({{ $hospital->linked_employee_data->employee_code}})</td>

                                                @php
                                                $startDate = Carbon::parse($hospital->created_at);
                                                $endDate = Carbon::parse(Carbon::now()->toDateTimeString());
                                                @endphp
                                                <td>{{ $startDate->diff($endDate)->format('%D : %H:%I'); }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.hospital-authorizations.show', $hospital->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-eye"></i></a>
                                                            <button type="button" title=" Authorize Hospital ID" class="btn btn-danger"  onclick="confirmDelete({{ $hospital->id }})"><i class="uil-shield-check"></i></button>
                                                        <form id='delete-form{{ $hospital->id }}'
                                                            action="{{ route('admin.hospital-authorizations.update', $hospital->id) }}"
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
                                <p class="text-center">No Hospital found.</p>
                            @endif
                        </div>
                        {{ $hospitals->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->
    <div id="modal-password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-passwordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <p class="modal-title text-center" id="primary-header-modalLabel"><strong>Want to Change Password of UMP-</strong><span id="uid">{{ old('uid') }}</span></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="changePasswordForm" action="{{ route('admin.hospitals.change-password') }}">
                        @csrf
                        <input type="hidden" value="{{ old('id') }}" name="id" id="id">
                        <input type="hidden" value="{{ old('uid') }}" name="uid" id="employee_code">
                        <div class="form-group mb-2 {{ $errors->has('new_password') ? 'has-error' : '' }}">
                            <label for="new_password">New password *</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Enter new password" class="form-control">
                            @error('new_password')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-2 {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                            <label for="new_password_confirmation">Confirm password *</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="form-control" placeholder="Re-enter new password">                           
                        </div>
                    </form>
                </div>
                <div class="text-center mb-3">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="changePasswordForm" class="btn btn-sm btn-success">Confirm</button>
                </div>
            </div>
        </div>
    </div>
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
