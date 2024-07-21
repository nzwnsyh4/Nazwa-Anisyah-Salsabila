@extends('layouts.auth')
@section('content')
    <!--<div class="wrap">
        <div class="img" style="background-image: url({{ asset('assets/login') }}/images/bg-1.jpg);">
        </div>
        <div class="login-wrap p-4 p-md-5">
            <div class="d-flex">
                <div class="w-100">
                    <h3 class="mb-4">Sign Up</h3>
                </div>
            </div>-->
            <form action="{{ route('auth.register.proccess') }}" class="signin-form" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" required name="name"
                        value="{{ old('name') }}">
                    <label class="form-control-placeholder" for="fullname">Fullname</label>
                    @error('name')
                        <small class="text-primary " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" required name="email"
                        value="{{ old('email') }}">
                    <label class="form-control-placeholder" for="email">Email</label>
                    @error('email')
                        <small class="text-primary " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-field" type="password" class="form-control @error('password') is-invalid @enderror"
                        required name="password">
                    <label class="form-control-placeholder" for="password">Password</label>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    @error('password')
                        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                        Up</button>
                </div>

            </form>
            <p class="text-center text-secondary">Have a account? <a href="{{ route('auth.login') }}"><label class="text-primary">Sign In</a></p>
        </div>
    </div>
@endsection
