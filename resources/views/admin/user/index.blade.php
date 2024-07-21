@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
               <h1> <b>List User</b></h1>
                 <div class="button-container">
                    <button onclick="window.location.reload()" class="btn btn-secondary refresh-button">Refresh</button>
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Tambah User</a>
                </div>
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama </th>
                            <th>Email</th>
                            <!--<th>Is Owner</th>-->
                            <!--<th>Status</th>-->
                            <!--<th>Role</th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <!--<td>
                                    {{ $item->Maskapai?->name }}
                                </td>-->
                                <!--<td>
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </td>-->
                               <!-- <th>{{ $item->getRoleNames() }}</th>-->
                                <td>
                                    <div class="d-flex " style="gap:5px;">
                                        <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-primary">Edit
                                        </a>
                                        <button class="btn btn-danger btnDelete" data-id="{{ $item->id }}">Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
@push('js')
    <script>
        $("#datatables").DataTable({});
        $(document).ready(function() {
            $(".btnDelete").on('click', function() {
                let url = '{{ route('admin.user.destroy', ':id') }}';
                let id = $(this).data('id');
                url = url.replace(':id', id);
                console.log(url);
                Swal.fire({
                    title: "Are you sure?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Continue "
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(e) {
                                if (e.status == 200) {
                                    Swal.fire({
                                        title: "Succesfully!",
                                        text: " the page will automatically redirect!.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        let redirect =
                                            '{{ route('admin.user.index') }}';
                                        location.href = redirect;
                                    });
                                }
                            }
                        })

                    }
                });
            });
        });
    </script>
@endpush
