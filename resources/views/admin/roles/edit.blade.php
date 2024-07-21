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
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="name" title="Role Name" default="{{ $role->name }}" />
                        </div>
                        <div class="col-md-6 col-xs-6 col-sm-6">
                            <x-partials.form name="guard_name" title="Guard Name" default="{{ $role->guard_name }}" />

                        </div>
                        <div class="col-md-12 mt-3">
                            <h2 class="fw-bold fst-italic">Permission</h2>
                            @error('permissions')
                                <small class="fst-italic text-danger">{{ $message }}</small>
                            @enderror
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="row">
                                    @foreach ($groupPermission as $item)
                                        <div class="col-md-6 col-xs-6 col-sm-6 mt-4">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header"
                                                    id="panelsStayOpen-heading{{ $loop->iteration }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapse{{ $loop->iteration }}"
                                                        aria-expanded="false"
                                                        aria-controls="panelsStayOpen-collapse{{ $loop->iteration }}">
                                                        <div class="form-check ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="{{ $loop->iteration }}">
                                                            <label class="form-check-label mt-1"
                                                                for="{{ $loop->iteration }}">
                                                                {{ ucFirst($item) }}
                                                            </label>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapse{{ $loop->iteration }}"
                                                    class="accordion-collapse collapse "
                                                    aria-labelledby="panelsStayOpen-heading{{ $loop->iteration }}">
                                                    <div class="accordion-body">
                                                        @foreach ($permissions as $item1)
                                                            @if ($item == $item1->parent)
                                                                <div class="mt-3 form-control ">
                                                                    <input class="form-check-input mx-2" type="checkbox"
                                                                        value="{{ (int) $item1->id }}"
                                                                        id="per{{ $item1->id }}"
                                                                        name="permissions[{{ $item1->id }}]"
                                                                        {{ in_array($item1->id, $rolePermissions) ? 'checked' : '' }}>

                                                                    {{-- {{ old('permissions.' . $item1->id) == $item1->id ? 'checked' : '' }}> --}}
                                                                    <label class="form-check-label"
                                                                        for="per{{ $item1->id }}">
                                                                        {{ $item1->title }}
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div>
                        </div>
                        <div class="d-flex justify-content-end" style="gap:10px;">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-dark"> Back </a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
