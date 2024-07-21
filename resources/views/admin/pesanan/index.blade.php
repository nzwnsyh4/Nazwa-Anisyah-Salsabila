@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><b>List Transaksi</b></h1>
                {{-- <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary">Tambah Maskapai</a> --}}
            </div>
            <div class="card p-3">
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk </th>
                            <th>Nama User</th>
                            <th>Banyak Tiket</th>
                            <th>Metode Pembayaran</th>
                            <th>Status Pembayaran</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($billing as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->Product?->name }}</td>
                                <td>{{ $item->User?->name }}</td>
                                <td>
                                    {{ $item->qty }}
                                </td>
                                <td>
                                    {{ $item->BillingType?->name }}
                                </td>
                                <th>{{ $item->Status?->name }}</th>
                                <td>
                                    <div class="d-flex" style="gap:8px;">
                                      <!--<a href="{{ route('admin.maskapai.edit', $item->uuid) }}" class="btn btn-danger">Edit
                                        </a>-->
                                        <a href="{{ route('tickets.print', $item->uuid) }}" class="btn btn-warning">Print Laporan</a>

                                      @can('confirmation.approve')
                                      @if (Auth::user()->hasRole(1) && Auth::user()->hasRole(2))
                                            <button class="btn btn-success btnConfirm" data-uuid="{{ $item->uuid }}">Approve
                                            </button>@endif
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
            $(".btnConfirm").on('click', function() {
                let url = '{{ route('admin.pesanan.update', ':id') }}';
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
                    confirmButtonText: "Yes, Confirm "
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'PUT',
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
                                            '{{ route('admin.pesanan.index') }}';
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
