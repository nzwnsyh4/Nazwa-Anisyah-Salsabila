@extends('layouts.auth')
@section('content')
    <!--<div class="wrap">
        <div class="img" style="background-image: url({{ asset('assets/login') }}/images/bg-1.jpg);">
        </div>
        <div class="login-wrap p-4 p-md-5">
            <div class="d-flex">
                <div class="w-100">
                    <h3 class="mb-4">Sign In</h3>
                </div>
            </div>-->

            <form action="{{ route('auth.login.proccess') }}" class="signin-form" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <input type="text" class="form-control form-primary @error('email') is-invalid @enderror" required name="email"
                        value="{{ old('email') }}">
                    <label class="form-control-placeholder text-primary" for="email">Email</label>
                    @error('email')
                        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-field" type="password" class="form-control  @error('password') is-invalid @enderror"
                        required name="password">
                    <label class="form-control-placeholder text-primary" for="password">Password</label>
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    @error('password')
                        <small class="text-danger " style="font-style: italic">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                        In</button>
                </div>
                <!-- <div class="form-group d-md-flex">
                    <div class="w-50 text-left">
                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>-->
                    <div class="w-30 text-md-right">
                        <p class="text-center">Not a account? <a href="{{ route('auth.register') }}"><label class="text-primary">Sign Up</a> | Back To <a href="{{ route('home.index') }}"><label class="text-primary">Home</a></p>
                    </div>
                </div>
            </form>
            <!--<p class="text-center">Not a member? <a href="{{ route('auth.register') }}">Sign Up</a></p>--
        </div>
    </div>
@endsection
