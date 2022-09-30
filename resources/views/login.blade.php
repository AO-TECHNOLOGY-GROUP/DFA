{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>@yield('title',''){{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{config('app.name')}}">
    <meta name="author" content="{{config('app.name')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/unaitas_emblem_logo.png') }}">

    <!-- App css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>

    <style>
        .danger {
            color: red;
        }
    </style>
</head>

<body>
<div class="account-pages my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6 p-5">
                                <div class="mx-auto mb-5">
                                    <h2><strong>{{ config('app.name') }} - Portal</strong></h2>
                                </div>

                                @include('partials.alerts')

                                <form action="{{ route('login') }}" method="post" class="authentication-form">
                                    @csrf

                                    <div class="form-group">
                                        <label class="form-control-label">Email Address</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="uil uil-envelope"></i>
                                                </span>
                                            </div>
                                            <input type="email"
                                                   class="form-control @if($errors->has('email')) is-invalid @endif"
                                                   id="
                                                email" placeholder="Username" name="email"
                                                   value="{{ old('email')}}"/>

                                            @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Password</label>
                                        <a href="#" hidden
                                           class="float-right text-muted text-unline-dashed ml-1">Forgot your
                                            password?</a>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="uil uil-lock-alt"></i>
                                                </span>
                                            </div>
                                            <input type="password"
                                                   class="form-control @if($errors->has('password')) is-invalid @endif"
                                                   id="password"
                                                   placeholder="Enter your password" name="password"/>

                                            @if($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" name="remember"
                                                {{ old('remember') ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="checkbox-signin">Remember
                                                me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-6 d-none d-md-inline-block">
                                <br/>     <br/>        <br/>     <br/>
                                <div class="auth-page-sidebar">
                                    <div class="auth-user-testimonial">
                                        <img src="#" alt="">
                                        {{-- <p>- Admin User</p> --}}
                                    {{-- </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>

</html> --}}

<style>
.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('https://images.unsplash.com/photo-1483478550801-ceba5fe50e8e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80');
  background-size: cover;
  background-position: center center;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>




<div class="container-fluid">
    <div class="row no-gutter">
           <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h6 class="display-4">AO DFA PORTAL</h6>
                            <p class="text-muted mb-4">Sign in with your Credentials</p>
                            @include('partials.alerts')
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="Email address" name="email" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password"  name="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>

                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                <br/>  <br/>  <br/>

                                <div class="text-center d-flex justify-content-between mt-4"><p>Powered by <a href="https://bootstrapious.com/snippets" class="font-italic text-muted">
                                        <u>AO Group</u></a></p></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-6 d-none d-md-flex bg-image"></div>
    </div>
</div>
