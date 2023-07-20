<div class="row">
    <div class="col-xl-12">
        <div class="card no-shadow">
            <div class="card-body p-0">
                <div class="table-responsive">
                    @if (count($associate->sub_associate_partners) > 0)
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
                                @foreach ($associate->sub_associate_partners as $sub_associate_partner)
                                    <tr>
                                        <th scope="row">{{ $sub_associate_partner->associate_partner_id }}</th>
                                        <td>{!! $sub_associate_partner->name !!}</td>
                                        <td><span
                                                class="badge badge-outline-secondary">{{ ucfirst($sub_associate_partner->type) }}</span>
                                        </td>
                                        <td>{{ $sub_associate_partner->email }}</td>
                                        <td>{{ $sub_associate_partner->phone }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('associate-partner.associate-partners.edit', $sub_associate_partner->id) }}"
                                                    class="btn btn-primary"><i class="mdi mdi-pencil"></i></a>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $sub_associate_partner->id }})"><i
                                                        class="uil uil-trash-alt"></i></button>
                                                <form id='delete-form{{ $sub_associate_partner->id }}'
                                                    action='{{ route('associate-partner.associate-partners.destroy', $sub_associate_partner->id) }}'
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
                        <p class="text-center pt-5 pb-5">No Sub Associate Partner found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
