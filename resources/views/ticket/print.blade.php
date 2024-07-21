@extends('layouts.print')
@push('title')
    Tickets {{ $billing->uuid }}
@endpush
@push('css')
    @push('css')
        <style>
            .fl-left {
                float: left
            }

            .fl-right {
                float: right
            }

            h1 {
                text-transform: uppercase;
                font-weight: 900;
                border-left: 10px solid #fec500;
                padding-left: 10px;
                margin-bottom: 30px
            }

            .row {
                overflow: hidden
            }

            .card {
                display: table-row;
                width: 100%;
                background-color: #fff;
                color: #989898;
                margin-bottom: 10px;
                font-family: 'Oswald', sans-serif;
                text-transform: uppercase;
                border-radius: 4px;
                position: relative
            }

            .card+.card {
                margin-left: 2%
            }

            .date {
                display: table-cell;
                width: 25%;
                position: relative;
                text-align: center;
                border-right: 2px dashed #dadde6
            }

            .date:before,
            .date:after {
                content: "";
                display: block;
                width: 30px;
                height: 30px;
                background-color: #DADDE6;
                position: absolute;
                top: -15px;
                right: -15px;
                z-index: 1;
                border-radius: 50%
            }

            .date:after {
                top: auto;
                bottom: -15px
            }

            .date time {
                display: block;
                position: absolute;
                top: 50%;
                left: 50%;
                -webkit-transform: translate(-50%, -50%);
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%)
            }

            .date time span {
                display: block
            }

            .date time span:first-child {
                color: #2b2b2b;
                font-weight: 600;
                font-size: 250%
            }

            .date time span:last-child {
                text-transform: uppercase;
                font-weight: 600;
                margin-top: -10px
            }

            .card-cont {
                display: table-cell;
                width: 75%;
                font-size: 85%;
                padding: 10px 10px 30px 50px
            }

            .card-cont h3 {
                color: #3C3C3C;
                font-size: 130%
            }

            .row:last-child .card:last-of-type .card-cont h3 {
                /* text-decoration: line-through */
            }

            .card-cont>div {
                display: table-row
            }

            .card-cont .even-date i,
            .card-cont .even-info i,
            .card-cont .even-date time,
            .card-cont .even-info p {
                display: table-cell
            }

            .card-cont .even-date i,
            .card-cont .even-info i {
                padding: 5% 5% 0 0
            }

            .card-cont .even-info p {
                padding: 30px 50px 0 0
            }

            .card-cont .even-date time span {
                display: block
            }

            .card-cont a {
                display: block;
                text-decoration: none;
                width: 80px;
                height: 30px;
                background-color: #D8DDE0;
                color: #fff;
                text-align: center;
                line-height: 30px;
                border-radius: 2px;
                position: absolute;
                right: 10px;
                bottom: 10px
            }

            .row:last-child .card:first-child .card-cont a {
                background-color: #037FDD
            }

            .row:last-child .card:last-child .card-cont a {
                background-color: #F8504C
            }

            @media screen and (max-width: 860px) {
                .card {
                    display: block;
                    float: none;
                    width: 100%;
                    margin-bottom: 10px
                }

                .card+.card {
                    margin-left: 0
                }

                .card-cont .even-date,
                .card-cont .even-info {
                    font-size: 75%
                }
            }

            .reset-section {
                padding-top: 10px !important;
            }
        </style>
    @endpush
@endpush
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">

            <h3>Kode Booking : {{ $billing->uuid }}</h3>
        </div>
        <div class="row">
            @foreach ($billing->Detail as $item)
                <div class="col-md-6">
                    <article class="card fl-left">
                        <section class="date reset-section">
                            <time datetime="23th feb">
                                <span>{{ formatTime($billing->Product?->Detail?->estimated_fly, '%d') }}</span><span>{{ formatTime($item->value?->Detail?->estimated_fly, '%b') }}</span><span
                                    style="color:#2b2b2b;font-weight:600;font-size:250%">{{ formatTime($item->value?->Detail?->estimated_fly, '%Y') }}</span>
                            </time>
                        </section>
                        <section class="card-cont reset-section">
                            <div class="d-flex justify-content-center">

                                <div id="barcode-{{ $item->uuid }}" class="text-center"></div>
                            </div>
                            <small>{{ $item->name }}</small>
                            <h3>{{ $billing->Product?->Detail?->FromAirport?->name }},
                                {{ $billing->Product?->Detail?->FromAirport?->city }}
                                ({{ $billing->Product?->Detail?->FromAirport?->country }})
                            </h3>
                            <div class="even-date">
                                <i class="fa fa-calendar"></i>
                                <time>
                                    <span>{{ formatTime($billing->Product?->Detail?->estimated_fly) }}</span>
                                    <span>{{ formatTime($billing->Product?->Detail?->estimated_fly, '%H:%I') }} to
                                        {{ formatTime($billing->Product?->Detail?->estimated_arrival, '%H:%I') }}</span>
                                </time>
                            </div>
                            <div class="even-info">
                                <i class="fa fa-map-marker"></i>
                                <p>
                                    {{ $billing->Product?->Detail?->DestinationAirport?->name }},
                                    {{ $billing->Product?->Detail?->DestinationAirport?->city }}
                                    ({{ $billing->Product?->Detail?->DestinationAirport?->country }})
                                </p>
                            </div>
                            {{-- <a href="#" class="mt-2">tickets</a> --}}
                        </section>
                    </article>
                </div>
            @endforeach


        </div>
    </div>
@endsection
@push('js')
    <script src='{{ asset('assets/vendor/barcode/qrcode.min.js') }}'></script>
    @foreach ($billing->Detail as $item)
        <script>
            $(document).ready(function() {
                var qrcode = new QRCode("barcode-{{ $item->uuid }}", {
                    text: "{{ route('tickets.detail', $item->uuid) }}",
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            });
        </script>
    @endforeach
    <script>
        window.onafterprint = function() {
            setTimeout(function() {
                window.location.href = document.referrer;
            }, 0);
        };


        window.print();
    </script>

@endpush
