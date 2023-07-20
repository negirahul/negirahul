<div class="row">
    <div class="col-xl-12">
        <div class="card no-shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @if (count($associate->hospitals) > 0)
                        <table id="basics-datatable" class="table table-hover table-striped">
                            <thead class="thead-grey">
                                <tr>
                                    <th scope="col">Hospital UID</th>
                                    <th scope="col">Hospital Start Date</th>
                                    <th scope="col">Hospital name</th>
                                    <th scope="col">City</th>
                                    <th scope="col">State</th>
                                    <th scope="col">Onboarding</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($associate->hospitals as $hospital)
                                    <tr>
                                        <th scope="row">{{ $hospital->uid }}</th>
                                        <td>{{ \Carbon\Carbon::parse($hospital->created_at)->format('Y-m-d') }}</td>
                                        <td>{!! $hospital->name !!}</td>
                                        <td>{{ ucfirst($hospital->city) }}</td>
                                        <td>{{ $hospital->state }}</td>
                                        <td>{{ $hospital->onboarding }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('associate-partner.hospitals.edit', $hospital->id) }}"
                                                    class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $hospital->id }})"><i
                                                        class="uil uil-trash-alt"></i></button>
                                                <form id='delete-form{{ $hospital->id }}'
                                                    action='{{ route('associate-partner.hospitals.destroy', $hospital->id) }}'
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
                        <p class="text-center pt-5 pb-5">No Hospital found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
