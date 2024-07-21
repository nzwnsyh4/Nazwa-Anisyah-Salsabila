@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h4>Informasi Penumpang</h4>
                                <a href="{{ url('/') }}" class="btn btn-primary 7px">Kembali</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                @for ($i = 0; $i < $billing->qty; $i++)
                                    <h4 class="mt-3">Informasi Pelanggan ke-{{ $i + 1 }}</h4>
                                    <hr>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <x-partials.form name="details[nama_penumpang][]" title="Nama Penumpang" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-partials.form name="details[email][]" title="Email Penumpang" />
                                        </div>
                                    </div>
                                @endfor
                                <div class="d-flex mt-3 justify-content-end">
                                    <button class="btn btn-primary">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
