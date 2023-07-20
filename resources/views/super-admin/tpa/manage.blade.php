@extends('layouts.super-admin')
@section('title', 'Company')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <form action="{{ route('super-admin.tpa.index') }}">
                            <div class="input-group">
                                <input class="form-control" name="search" type="search"placeholder="Type here to Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                  <a href="{{ route('super-admin.tpa.create') }}"
                                    class="btn btn-primary"><i class="mdi mdi-plus"></i> Company</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h4 class="page-title">Manage Company</h4>
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
                            @if (count($tpas) > 0)
                                <table id="basics-datatable" class="table table-striped table-hover">
                                    <thead class="thead-grey">
                                        <tr>
                                            <th scope="col">Company</th>
                                            <th scope="col">Company Type</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tpas as $tpa)
                                            <tr>
                                                <th scope="row">{{ $tpa->company }}</th>
                                                <th scope="row">{{ $tpa->company_type }}</th>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('super-admin.tpa.edit', $tpa->id) }}"
                                                            class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                        <button type="button" class="btn btn-danger"
                                                            onclick="confirmDelete({{ $tpa->id }})"><i
                                                                class="uil uil-trash-alt"></i></button>

                                                        <form id='delete-form{{ $tpa->id }}'
                                                            action='{{ route('super-admin.tpa.destroy', $tpa->id) }}'
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
                                <p class="text-center">No TPA found.</p>
                            @endif
                        </div>
                        {{ $tpas->withQueryString()->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- end page content -->

    </div> <!-- container -->


@endsection
{{-- @push('filter')
    @include('employee.filters.question-filter')
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
