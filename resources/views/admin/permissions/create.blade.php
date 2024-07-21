@extends('base')
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
        small{
            font-size: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.permissions.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <x-formInput name="name" title="Name" />
                            </div>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <x-formInput name="guard_name" title="Guard Name" />
    
                            </div>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <x-formInput name="title" title="Title" />
    
                            </div>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                                <x-formInput name="parent" title="Parent" />
                            </div>
                            
                            <x-buttonSubmit routeBack="{{ route('account.permissions.index') }}" />
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
@endsection