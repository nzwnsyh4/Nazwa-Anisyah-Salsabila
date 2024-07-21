@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1>Permissions List</h1>
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Create Permissions <i
                                class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="datatables">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Title</th>
                            <th>Parent</th>
                            <th></th>

                        </thead>
                        <tbody>
                            @foreach ($permissions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->parent }}</td>
                                    <td><a href="{{ route('admin.permissions.edit', $item->id) }}"
                                            class="btn btn-primary"><i class="fas fa-edit"></i></a></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#datatables").DataTable({});
        })
    </script>
@endpush
