<!DOCTYPE html>
<html lang="en">

<head>
    <title>Savanna Decoration - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <section class="ftco-section contact-section">
        <div class="container mt-1">
            <div class="row block-9">

                <div class="col-md-12 ftco-animate">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <img style="width:300px" src="{{ asset('images/savana/logo.jpg') }}" />
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <h2>Register</h2>
                            </div>
                        </div>
                    </div>
                    <div class="m-2">
                        @if(\Session::has('alert-name'))
                        <div class="alert alert-danger" style="padding:10px;color: black;" role="alert">
                            <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-name') }}
                        </div>
                        @endif
                        @if(\Session::has('alert-email'))
                        <div class="alert alert-danger" style="padding:10px;color: black;" role="alert">
                            <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-email') }}
                        </div>
                        @endif
                        @if(\Session::has('alert-password'))
                        <div class="alert alert-danger" style="padding:10px;color: black;" role="alert">
                            <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-password') }}
                        </div>
                        @endif
                        @if(\Session::has('alert-password2'))
                        <div class="alert alert-danger" style="padding:10px;color: black;" role="alert">
                            <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-password2') }}
                        </div>
                        @endif
                        @if(\Session::has('alert-salah'))
                        <div class="alert alert-danger" style="padding:10px;color: black;" role="alert">
                            <i class="fas fa-times-circle"></i> &nbsp; {{ Session::get('alert-salah') }}
                        </div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('postregistercustomer') }}" class="contact-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="nama" id="nama" type="text" class="form-control" placeholder="Masukan Nama Anda">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" id="email" type="email" class="form-control" placeholder="Masukan Email Anda">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No Handphone</label>
                                    <input name="no_tlp" id="no_tlp" type="text" class="form-control" placeholder="Masukan No Handphone Anda">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" id="password" type="password" class="form-control" placeholder="Masukan Password Anda">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input name="repassword" id="repassword" type="password" class="form-control" placeholder="Ulangi Password Anda">
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    <button style="color:white;width:250px" type="submit" class="btn btn-primary">REGISTER</button>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="form-group">
                                    Sudah Memiliki Akun ? Silahkan<a style="color:white;width:100px" href="/login-customer" class="btn">LOGIN</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>