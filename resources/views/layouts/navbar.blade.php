<!DOCTYPE html>
<html lang="en">

<head>
    <title>Savanna Decoration - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('images/savana/logo.png') }}">
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
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img style="width:150px" src="{{ asset('images/savana/logo.jpg') }}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="/about" class="nav-link">Tentang Kami</a></li>
                    <li class="nav-item"><a href="/product" class="nav-link">Produk</a></li>
                    <li class="nav-item"><a href="/vendor" class="nav-link">Paket Dekorasi</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                    @if(Session('sess_email')=='')
                    <li class="nav-item"><a href="/register-customer" class="nav-link btn btn-primary">Register</a></li>
                    <li class="nav-item"><a href="/login-customer" class="nav-link btn btn-info">Login</a></li>
                    @endif
                    @if(Session('sess_email')!='')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="room.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> {{ Session::get('sess_nama') }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="/profile">Profile</a>
                            <a class="dropdown-item" href="/myorder">My Order</a>
                            <a style="color:red" class="dropdown-item" href="/logoutcustomer">Logout</a>
                        </div>
                    </li>
                    <li class="nav-item cart"><a href="/cart" class="nav-link"><span class="icon icon-shopping_cart"></span><span class="bag d-flex justify-content-center align-items-center"><small>1</small></span></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->