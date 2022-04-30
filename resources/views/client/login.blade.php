@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
    <form action="{{ route('post_login') }}" method="POST" class="login100-form validate-form">
        @csrf
        <span class="login100-form-logo">
            <i class="zmdi zmdi-landscape"></i>
        </span>

        <span class="login100-form-title p-b-34 p-t-27">
            Log in
        </span>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Session('error'))
            <div class="alert alert-success">{{ Session('error') }}</div>
        @endif

        <div class="wrap-input100 validate-input" data-validate="Enter email">
            <input class="input100" type="email" name="email" placeholder="Email">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
        </div>

        <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
                Remember me
            </label>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
                Login
            </button>
        </div>

        <div class="text-center p-t-90">
            <a class="txt1" href="#">
                Forgot Password?
            </a>
        </div>

        <div class="text-center p-t-20">
            <a class="txt1" href="{{ route('register') }}">
                Do you have a account?Register
            </a>
        </div>
    </form>
@endsection
