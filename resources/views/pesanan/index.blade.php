@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="card-header">
                <h1>Pesanan Anda</h1>
            </div>
            <div class="card">

                <div class="card-body">

                    <table class="table" id="datatables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Id Booking</th>
                                <th>Status Booking</th>
                               <!-- <th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($billings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->uuid }}</td>
                                    <td>{{ $item->Status?->name }}</td>
                                   <!--<td>
                                        <div class="d-flex">
                                            @if ($item->status_id != 4 && $item->status_id != 3)
                                                <a href="{{ route('pesanan.edit', $item->uuid) }}" class="btn btn-primary"><i
                                                        class="fa fa-edit" aria-hidden="true">Edit</i>
                                                </a>
                                                <a href="{{ route('payment.index', $item->uuid) }}" class="btn btn-primary">
                                                    <i class="fas fa-eye"></i></a>
                                                <button class="btn btn-danger btnDelete" data-uuid="{{ $item->uuid }}"><i
                                                        class="fa fa-trash" aria-hidden="true">Delete</i>
                                                </button>
                                            @endif
                                        </div>-->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $("#datatables").DataTable({});
        $(document).ready(function() {
            $(".btnDelete").on('click', function() {
                let url = '{{ route('pesanan.destroy', ':id') }}';
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
                                            '{{ route('pesanan.index') }}';
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
