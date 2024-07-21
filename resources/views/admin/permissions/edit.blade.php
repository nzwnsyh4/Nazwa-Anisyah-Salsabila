@extends('layouts.admin')
@push('style')
    <style>
        .form-check-custom[type=radio] {
            border-radius: 50%;
        }

        .form-check-custom:checked {
            background-color: #1089E2;
            border-color: #1089E2;
        }

        .form-check-custom:checked+.form-check-label {
            color: #1089E2;
        }

        .card-form-buyer label {
            color: 6E84A3 !important;
        }

        .form-check-inline {
            margin-right: 0;
        }

        .form-check {
            padding-left: 1em;
        }

        .form-check .form-check-custom {
            float: left;
            margin-right: 1em;
        }

        .form-check-custom {
            width: 15px;
            height: 15px;
            margin-top: .25em;
            vertical-align: top;
        }

        .form-check-label {
            font: normal normal 600 14px/22px;
        }

        input[type=checkbox] {
            -ms-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -o-transform: scale(1.5);
            transform: scale(1.5);
            padding: 5px;
        }

        small {
            font-size: 16px;
        }
    </style>
@endpush
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-3">
                <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="name" title="Name" default="{{ $permission->name }}" />
                        </div>
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="guard_name" title="Guard Name" default="{{ $permission->guard_name }}" />

                        </div>
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="title" title="Title" default="{{ $permission->title }}" />

                        </div>
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="parent" title="Parent" default="{{ $permission->parent }}" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end" style="gap:10px;">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-dark"> Back </a>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
