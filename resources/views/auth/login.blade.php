<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="shortcut icon" href="{{ asset('/images/logo/Minda.jpg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/azia.css') }}" rel="stylesheet">
</head>
<body class="az-body">
    <div class="az-signin-wrapper">
        <div class="az-card-signin">
        <h1 class="az-logo">{{ config('app.name', 'Laravel') }}</h1>
        <div class="az-signin-header">
            <h2>Welcome back!</h2>
            <h4>Please sign in to continue</h4>

            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div><!-- form-group -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div><!-- form-group -->

            <div class="form-group pl-3 pb-0 mb-0">
                <div class="">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

             <button type="submit" class="btn btn-block btn-success">
                {{ __('Login') }}
            </button>
            </form>
        </div><!-- az-signin-header -->
        <div class="az-signin-footer pt-3">
            @if (Route::has('password.request'))
            <p><a class="" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a></p>
            @endif
            <p>Don't have an account? <a href="{{ route('register') }}">Create an Account</a></p>
        </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->
    </div><!-- az-signin-wrapper -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/ionicons.js') }}"></script>

    <script src="../js/azia.js"></script>
    <script>
        $(function(){
            'use strict'
        });
    </script>
    </body>
</html>
