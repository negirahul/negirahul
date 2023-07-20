@extends('layouts.user')
@section('title', 'Associate Partners')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('user.associate-partners.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" type="search"placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Manage Associate Partner</h4>
                </div>
            </div>
        </div>
        @include('user.sections.flash-message')
        <!-- end page title -->

        <!-- start page content -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card no-shadow">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            @if (count($associates) > 0)
                                <table id="basics-datatable" class="table table-hover table-striped">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">UID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($associates as $associate)
                                            <tr>
                                                <th scope="row">{{ $associate->associate_partner_id }}</th>
                                                <td>{!! $associate->name !!}</td>
                                                <td><span
                                                        class="badge badge-outline-secondary">{{ ucfirst($associate->type) }}</span>
                                                </td>
                                                <td>{{ $associate->email }}</td>
                                                <td>{{ $associate->phone }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if(auth()->check() && auth()->user()->hasDirectPermission('Associate Partner Updation/Editing Rights'))
                                                        <a href="{{ route('user.associate-partners.edit', $associate->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                        @endif
                                                        <a href="{{ route('user.associate-partners.show', $associate->id) }}"
                                                            class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $associate->id }})"><i
                                                                class="uil uil-trash-alt"></i></button>
                                                        <form id='delete-form{{ $associate->id }}'
                                                            action='{{ route('user.associate-partners.destroy', $associate->id) }}'
                                                            method='POST'>
                                                            <input type='hidden' name='_token'
                                                                value='{{ csrf_token() }}'>
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No Associate Partner found.</p>
                            @endif
                        </div>
                        {{ $associates->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->
@endsection
{{-- @push('filter')
    @include('user.filters.question-filter')
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
