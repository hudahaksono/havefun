<!DOCTYPE html>
<html lang="en">


<!-- auth-register.html  21 Nov 2019 04:05:01 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href="{{ asset('assets/img/favicon.ico') }}" />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="card card-primary">
                            <h2 class="text-center mt-3">Register</h2>
                            <div class="m-2">
                                @if(\Session::has('alert-name'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-name') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-email'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-email') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-password'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-password') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-password2'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-password2') }}
                                </div>
                                @endif
                                @if(\Session::has('alert-salah'))
                                <div class="alert alert-danger" style="padding:10px;color: white;" role="alert">
                                    <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-salah') }}
                                </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('postregister') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" class="form-control" name="name" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="no_tlp">No Handphone</label>
                                        <input id="no_tlp" type="text" class="form-control" name="no_tlp">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control" name="password2">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="mb-4 text-muted text-center">
                                Already Registered? <a href="/login">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>