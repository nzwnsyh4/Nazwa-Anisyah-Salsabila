@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Scan Barcode to continue Payment
                </div>
                <div class="card-body">
                    <p class="text-center">{{ route('checkStore', $payment->uuid) }}</p>
                    <div class="d-flex justify-content-center">
                        <div id="barcode"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src='{{ asset('assets/vendor/barcode/qrcode.min.js') }}'></script>
    <script>
        function check() {
            $.ajax({
                url: '{{ route('checkPayment') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    uuid: '{{ $payment->uuid }}',
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
                                '{{ route('checkStore', $payment->uuid) }}';
                            location.href = redirect;
                        });
                    }
                }
            })
        }
        $(document).ready(function() {

            var qrcode = new QRCode("barcode", {
                text: "{{ route('checkStore', $payment->uuid) }}",
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });

        });

        setInterval(() => {
            check()
        }, 2000);
    </script>
@endpush
