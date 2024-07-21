@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><b>List Penerbangan</b></h1>
                <div class="button-container">
                    @if (!Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                    <button onclick="window.location.reload()" class="btn btn-secondary refresh-button">Refresh</button>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary ml-2">Tambah Penerbangan</a>
                    @endif
                  </div>
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penerbangan </th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Owner</th>
                            <th>Description</th>
                            @if (!Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ formatRupiah($item->price) }}</td>

                                <td>{{ $item->is_active == 1 ? 'Active' : 'Tidak Active' }}</td>
                                <td>
                                    {{ $item->Maskapai?->name }}
                                </td>
                                <td>{{ $item->description }}</td>
                                @if (!Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.products.edit', $item->uuid) }}" class="btn btn-primary">Edit
                                        </a>
                                        <button class="btn btn-danger btnDelete" data-uuid="{{ $item->uuid }}">Delete
                                        </button>
                                    </div>
                                </td> @endif
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
                let url = '{{ route('admin.products.destroy', ':id') }}';
                let uuid = $(this).data('uuid');
                url = url.replace(':id', uuid);
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
                                            '{{ route('admin.products.index') }}';
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
