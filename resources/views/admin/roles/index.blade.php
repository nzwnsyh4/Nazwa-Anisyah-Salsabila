@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1>Roles List</h1>
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Roles <i
                                class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="datatables">
                        <thead>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Guard Name</th>
                            <th>Permissions</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($role as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($item->permissions->sortBy('parent')->groupBy('parent') as $item1)
                                                <li>{{ removeUnderscore($item1->first()->parent) }}</li>
                                                <ul>
                                                    @foreach ($item1 as $item2)
                                                        <li>{{ $item2->title }}</li>
                                                    @endforeach
                                                </ul>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.roles.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $("#datatables").DataTable({});
        })
    </script>
@endpush
