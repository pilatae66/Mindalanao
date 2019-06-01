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
    <div class="az-signup-wrapper">
        <div class="az-column-signup-left">
            <div>
            <img src="{{ asset('images/logo/Minda.jpg') }}" style="height:150px" class="pb-4">
            <h1 class="az-logo">{{ config('app.name', 'Laravel') }}</h1>
            <h5>Responsive Modern Dashboard &amp; Admin Template</h5>
            <p>We are excited to launch our new company and product Azia. After being featured in too many magazines to mention and having created an online stir, we know that BootstrapDash is going to be big. We also hope to win Startup Fictional Business of the Year this year.</p>
            <p>Browse our site and see for yourself why you need Azia.</p>
            <a href="index.html" class="btn btn-outline-success">Learn More</a>
            </div>
        </div><!-- az-column-signup-left -->
        <div class="az-column-signup">
            <h1 class="az-logo">{{ config('app.name', 'Laravel') }}</h1>
            <div class="az-signup-header">
            <h2>Get Started</h2>
            <h4>It's free to signup and only takes a minute.</h4>
    
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                <label>Firstname</label>
                <input type="text" name="firstname" class="form-control @error('firstname') parsley-error @enderror" placeholder="Enter your firstname">
                @error('firstname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Middlename</label>
                <input type="text" name="middlename" class="form-control @error('middlename') parsley-error @enderror" placeholder="Enter your middlename">
                @error('middlename')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control @error('lastname') parsley-error @enderror" placeholder="Enter your lastname">
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control @error('username') parsley-error @enderror" placeholder="Enter your username">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control @error('email') parsley-error @enderror" placeholder="Enter your email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') parsley-error @enderror" placeholder="Enter your password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div><!-- form-group -->
                <div class="form-group">
                <label>Verify Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Verify your password">
                </div><!-- form-group -->
                <button class="btn btn-az-primary btn-block mb-2">Create Account</button>
            </form>
            </div><!-- az-signup-header -->
            <div class="az-signup-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-column-signup -->
        </div><!-- az-signup-wrapper -->
    
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/ionicons.js') }}"></script>
    
        <script src="{{ asset('js/azia.js') }}"></script>
        <script>
        $(function(){
            'use strict'
        });
        </script>
    </body>
</html>
