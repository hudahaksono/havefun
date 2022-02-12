<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aplication Monitoring</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-social/bootstrap-social.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/icon.png') }}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="mt-3 text-center">
                                <img style="text-align:center" width="200px" src="{{ asset('assets/img/logo-header.png') }}" />
                            </div>
                            <div class="m-2">
                                @if(\Session::has('alert-noaccess'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas times-circle"></i> &nbsp; {{ Session::get('alert-noaccess') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-success'))
                                <div class="alert alert-success" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-check"></i> &nbsp; {{ Session::get('alert-success') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-nofind'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-nofind') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-confirm'))
                                <div class="alert alert-info" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-confirm') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-wrong'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-nofind') }}
                                </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('postlogin') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="/forgot-password" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="/register">Create Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>