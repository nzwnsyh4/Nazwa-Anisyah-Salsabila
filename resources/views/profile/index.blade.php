@extends('layouts.home')
@section('content')
    <section class="mt-7 py-0">
        <div class="container">
            <div class="card-header">
                <h1>Profile</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <x-partials.form name="name" title="Nama"
                                    default="{{ old('name', Auth::user()->name) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-partials.form name="phone" title="Phone"
                                    default="{{ old('phone', Auth::user()->phone) }}" />
                            </div>
                            <div class="col-md-6">
                                <x-partials.form name="password"
                                    title="Password <span class='text-danger'>* kosongkan jika tidak di ubah</span>" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ url('/') }}" class="btn btn-primary">Back</a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
