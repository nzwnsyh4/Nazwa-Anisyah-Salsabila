@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><b>List Maskapai</b></h1>
                @can('maskapai.create')
                    <a href="{{ route('admin.maskapai.create') }}" class="btn btn-primary">Tambah Maskapai</a>
                @endcan
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Maskapai </th>
                            <!--<th>Logo</th>-->
                            <th>Description</th>
                            <th>Owner</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maskapai as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <!--<td>
                                    <a href="{{ asset('storage' . $item->logo) }}" id="linkPreview" class="spotlight"
                                        data-title="Logo">

                                        <img src="{{ asset('storage' . $item->logo) }}" id="previewImage" alt="Preview"
                                            style=" max-width: 50px; max-height: 50px;">
                                    </a>
                                </td>-->
                                <td>
                                    {{ $item->description }}
                                </td>
                                <td>{{ $item->Owner?->name }}</td>
                                <td>
                                    {{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </td>
                                <td>
                                    <div class="d-flex " style="gap:5px;">
                                        @can('maskapai.edit')
                                            <a href="{{ route('admin.maskapai.edit', $item->uuid) }}" class="btn btn-primary"><i
                                                    class="fa fa-pencil-square" aria-hidden="true"></i>
                                            </a>
                                        @endcan
                                        @can('maskapai.delete')
                                            <button class="btn btn-danger btnDelete" data-uuid="{{ $item->uuid }}"><i
                                                    class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        @endcan
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
                let url = '{{ route('admin.maskapai.destroy', ':id') }}';
                let uuid = $(this).data('uuid');
                url = url.replace(':id', uuid);
                console.log(url);
                Swal.fire({
                    title: "Kamu Serius?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Lanjutkan "
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            statusCode: {
                                200: function (response) {
                                    Swal.fire({
                                        title: "Succesfully!",
                                        text: " the page will automatically redirect!.",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        let redirect =
                                            '{{ route('admin.maskapai.index') }}';
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
