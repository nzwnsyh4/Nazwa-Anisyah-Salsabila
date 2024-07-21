@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0" style="margin-top: 100px !important;">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">

                                <h4>Informasi Penerbangan - {{ $product->Maskapai?->name }}</h4>
                                <a href="{{ url('/') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Bandara Keberangkatan:</label>
                                    <h4>{{ $product?->Detail?->FromAirport?->name }}
                                        ({{ $product?->Detail?->FromAirport?->city }})
                                        ({{ $product?->Detail?->FromAirport?->country }})</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Bandara Tujuan:</label>
                                    <h4>{{ $product?->Detail?->DestinationAirport?->name }}
                                        ({{ $product?->Detail?->DestinationAirport?->city }})
                                        ({{ $product?->Detail?->DestinationAirport?->country }})</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal Berangkat:</label>
                                    <h4>{{ formatTime($product->Detail?->estimated_fly) }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Lama Penerbangan:</label>
                                    <h4>{{ counting($product->Detail?->estimated_fly, $product->Detail?->estimated_arrival) }}
                                        +-</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Kursi Tersedia:</label>
                                    <h4>{{ $product->Detail?->qty }} Kursi</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Harga:</label>
                                    <h4>{{ formatRupiah($product->price) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Pemesanan</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cart.store', $product->uuid) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Payment Method: </label>
                                        <select name="payment" id="payment"
                                            class="select2 form-control @error('payment')
                                        is-invalid
                                    @enderror">
                                            <option value="">Select Payment Method</option>
                                            @foreach ($billingType as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('payment') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <x-partials.form name="jumlah_tiket" title="Jumlah tiket yang ingin di pesan :" />
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <button class="btn btn-primary btn-block" style="width: 100%">Buat Pesanan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
