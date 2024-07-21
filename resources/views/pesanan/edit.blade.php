@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1>Edit Pesanan - {{ $billing->uuid }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 " style="border-right: 1px solid;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Bandara Keberangkatan:</label>
                                    <h4>{{ $billing->Product?->Detail?->FromAirport?->name }}
                                        ({{ $billing->Product?->Detail?->FromAirport?->city }})
                                        ({{ $billing->Product?->Detail?->FromAirport?->country }})</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Bandara Tujuan:</label>
                                    <h4>{{ $billing->Product?->Detail?->DestinationAirport?->name }}
                                        ({{ $billing->Product?->Detail?->DestinationAirport?->city }})
                                        ({{ $billing->Product?->Detail?->DestinationAirport?->country }})</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Tanggal Berangkat:</label>
                                    <h4>{{ formatTime($billing->Product?->Detail?->estimated_fly) }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Lama Penerbangan:</label>
                                    <h4>{{ counting($billing->Product?->Detail?->estimated_fly, $billing->Product?->Detail?->estimated_arrival) }}
                                        +-</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Untuk:</label>
                                    <h4>{{ $billing->qty }} Kursi</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Harga:</label>
                                    <h4>{{ formatRupiah($billing->Product?->price) }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Total:</label>
                                    <h4>{{ formatRupiah($billing->Product?->price * $billing->qty) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('pesanan.update', $billing->uuid) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    @foreach ($billing->Detail as $item)
                                        <h6>Informasi Pelanggan ke-{{ $loop->iteration }}</h6>
                                        <div class="col-md-6">
                                            <x-partials.form name="data[{{ $item->uuid }}][name]" title="Nama"
                                                default="{{ old('name', $item->name) }}" />

                                        </div>
                                        <div class="col-md-6">
                                            <x-partials.form name="data[{{ $item->uuid }}][email]" title="Email"
                                                default="{{ old('email', $item->email) }}" />
                                        </div>
                                    @endforeach
                                    <div class="d-flex mt-3">
                                        <button class="btn btn-primary btn-block" style="width: 100%">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
