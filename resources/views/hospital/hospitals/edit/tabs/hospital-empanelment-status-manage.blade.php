<div class="table-responsive mt-3">
    @if (count($empanelments) > 0)
        <table id="basics-datatable" class="table table-hover table-striped">
            <thead class="thead-grey">
                <tr>
                    <th scope="col">Company</th>
                    <th scope="col">Company Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empanelments as $empanelment)
                    <tr>
                        <td scope="row">{{ @$empanelment->company->company }}</td>
                        <td scope="row">{{ $empanelment->company_type }}</td>
                        <td scope="row">
                            <a href="{{ route('hospital.hospitals.edit', $hospital->id) }}?company_id={{ $empanelment->id }}" class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                            <button type="button" class="btn btn-danger"
                            onclick="confirmDelete({{ $empanelment->id }})"><i
                            class="uil uil-trash-alt"></i></button>

                            <form id='delete-form{{ $empanelment->id }}'
                                action='{{ route('hospital.hospitals.hospital-delete', ['id' => $hospital->id, 'eid' => $empanelment->id]) }}'
                                method='POST'>
                                <input type='hidden' name='_token'
                                value='{{ csrf_token() }}'>
                                <input type='hidden' name='_method' value='DELETE'>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No Company found.</p>
    @endif
</div>
{{ $empanelments->withQueryString()->links('pagination::bootstrap-4') }}
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