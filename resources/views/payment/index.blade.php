@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">

                        <h1>Konfirmasi Payment</h1>
                        <button class="btn btn-primary">Cancel and return to website</button>
                    </div>
                </div>
                @php
                    $total_tiket = $billing->Product?->price * $billing->qty;
                    $tax = ($total_tiket / 100) * 10;
                @endphp

                <div class="card-body">
                    <div class="row d-flex justify-content-center pb-5">
                        <div class="col-sm-5 col-md-5 ml-1">
                            <div class="py-4 d-flex flex-row">
                                <h5><span class="fa fa-check-square"></span><b>ELIGIBLE</b> | </h5><span
                                    class="pl-2">Pay</span>
                            </div>
                            <h4 class="green">{{ formatRupiah($total_tiket + $tax) }}</h4>
                            <h4>Detail Tiket</h4>
                            @foreach ($billing->Detail as $item)
                                <div class="d-flex pt-2">
                                    <div>
                                        <p><b>{{ $item->name }}</b><span
                                                class="green mx-2">({{ formatRupiah($item->Billing?->Product?->price) }})</span>
                                        </p>
                                    </div>

                                </div>

                                <div class="rounded bg-light d-flex align-items-center">
                                    <div class="p-2">{{ $item->Billing?->Product?->Detail?->FromAirport?->name }}</div>
                                    <div>
                                        <h2>-</h2>
                                    </div>
                                    <div class=" p-2" style="text-align: right">
                                        {{ $item->Billing?->Product?->Detail?->DestinationAirport?->name }}
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                        </div>
                        <div class="col-sm-3 col-md-4 offset-md-1 mobile">
                            <div class="py-4 d-flex justify-content-end">
                                <h3 class="rounded  px-3 py-2 text-white bg-primary">{{ $billing->BillingType?->name }}</h3>
                            </div>
                            <div class="bg-light rounded d-flex flex-column">
                                <div class="p-2 ml-3">
                                    <h4>Order Recap</h4>
                                </div>
                                <div class="p-2 d-flex">
                                    <div class="col-8">Pemesanan Tiket <span
                                            class="badge bg-danger">{{ $billing->Detail->count() }}</span> </div>

                                    <div class="ml-auto">{{ formatRupiah($total_tiket) }}</div>
                                </div>

                                <div class="border-top px-4 mx-3"></div>
                                <div class="p-2 d-flex pt-3">
                                    <div class="col-8"><b>Tax (10%)</b></div>

                                    <div class="ml-auto"><b>{{ formatRupiah($tax) }}</b></div>
                                </div>


                                <div class="border-top px-4 mx-3"></div>
                                <div class="p-2 d-flex pt-3">
                                    <div class="col-8"><b>Total</b></div>
                                    <div class="ml-auto"><b class="green">{{ formatRupiah($total_tiket + $tax) }}</b></div>
                                </div>
                                <div class="d-flex mt-5">
                                    <button class="btn btn-primary" id="btnPayment" style="width: 100%">Proceed to
                                        payment</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#btnPayment").on('click', function() {
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
                            url: '{{ route('payment.store', $billing->uuid) }}',
                            type: 'POST',
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
                                        let url =
                                            '{{ route('check', ':id') }}';
                                        url = url.replace(':id', e.data);
                                        location.href = url;
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
