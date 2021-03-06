<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitoring Aplication | @yield('title')</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
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
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                            <span style="margin-left:15px;position:absolute;background:red;border-radius:50%;width:20px;height:20px">
                                <p style="position:absolute;padding-left:7px;bottom:-21px;font-weight:bold;color:white">1</p>
                            </span>
                            <i data-feather="bell" class="bell">
                            </i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                            <div class="dropdown-header">
                                Notifications
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <!-- <a href="#" class="dropdown-item dropdown-item-unread"> 
                                    <span class="dropdown-item-icon bg-primary text-white"> 
                                        <i class="fas fa-code"></i>
                                    </span> 
                                    <span class="dropdown-item-desc"> 
                                        Template update is available now! 
                                        <span class="time">2 Min Ago</span>
                                    </span>
                                </a>  -->
                                @foreach ($user_baru as $user)
                                <a href="#" class="dropdown-item">
                                    <span class="dropdown-item-icon bg-info text-white"> <i class="far fa-user"></i>
                                    </span>
                                    <span class="dropdown-item-desc"> User baru di tambahkan <b>{{ $user->nama }}</b>
                                        <span class="time">
                                            @if(date("H",strtotime($user->selisih))>0)
                                            {{date("H",strtotime($user->selisih))}} Hours Ago
                                            @else
                                            {{date("i",strtotime($user->selisih))}} Min Ago
                                            @endif
                                        </span>
                                    </span>
                                </a>
                                @endforeach
                                @foreach ($order_baru as $order)
                                <a href="#" class="dropdown-item">
                                    <span class="dropdown-item-icon bg-info text-white"> <i class="fas fa-shopping-cart"></i>
                                    </span>
                                    <span class="dropdown-item-desc"> Order baru di tambahkan <b>{{ $order->no_order }}</b>
                                        <span class="time">
                                            @if(date("H",strtotime($order->selisih))>0)
                                            {{date("H",strtotime($order->selisih))}} Hours Ago
                                            @else
                                            {{date("i",strtotime($order->selisih))}} Min Ago
                                            @endif
                                        </span>
                                    </span>
                                </a>
                                @endforeach
                                @foreach ($pembayaran as $bayar)
                                <a href="#" class="dropdown-item">
                                    <span class="dropdown-item-icon bg-success text-white"> <i class="fas fa-check"></i>
                                    </span>
                                    <span class="dropdown-item-desc"> Payment baru di tambahkan <b>{{ $bayar->no_payment }}</b>
                                        <span class="time">
                                            @if(date("H",strtotime($bayar->selisih))>0)
                                            {{date("H",strtotime($bayar->selisih))}} Hours Ago
                                            @else
                                            {{date("i",strtotime($bayar->selisih))}} Min Ago
                                            @endif
                                        </span>
                                    </span>
                                </a>
                                @endforeach
                                <!-- <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-success text-white"> <i class="fas
												fa-check"></i>
                                    </span> <span class="dropdown-item-desc"> <b>Kusnaedi</b> has
                                        moved task <b>Fix bug header</b> to <b>Done</b> <span class="time">12
                                            Hours
                                            Ago</span>
                                    </span>
                                </a> 
                                <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-danger text-white"> <i class="fas fa-exclamation-triangle"></i>
                                    </span> <span class="dropdown-item-desc"> Low disk space. Let's
                                        clean it! <span class="time">17 Hours Ago</span>
                                    </span>
                                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-icon bg-info text-white"> <i class="fas
												fa-bell"></i>
                                    </span> <span class="dropdown-item-desc"> Welcome to Otika
                                        template! <span class="time">Yesterday</span>
                                    </span>
                                </a> -->
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a style="color: black;" href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"><i class="far fa-user"></i> &nbsp;{{ Session::get('sess_nama') }}<span class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello {{ Session::get('sess_nama') }}</div>
                            <a href="profile" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/menu"> <img alt="image" src="{{ asset('assets/img/logo-header.png') }}" class="header-logo" /></a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Main</li>
                        <li class="dropdown active" id="drop-dashboard">
                            <a href="/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        <li class="dropdown" id="drop-banner">
                            <a href="/master-banner" class="nav-link"><i data-feather="star"></i><span>Banner</span></a>
                        </li>
                        <li class="dropdown" id="drop-master">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="database"></i><span>Master Data</span></a>
                            <ul class="dropdown-menu">
                                <li id="master-user"><a id="btn-master-user" class="nav-link" href="/master-user">Master User</a></li>
                                <li id="master-access"><a id="btn-master-access" class="nav-link" href="/master-akses">Master Access</a></li>
                                <li id="master-kategori"><a id="btn-master-kategori" class="nav-link" href="/master-kategori">Master Kategori</a></li>
                                <li id="master-kategori-paket"><a id="btn-master-kategori-paket" class="nav-link" href="/master-kategori-paket">Master Kategori Paket</a></li>
                                <li id="master-product"><a id="btn-master-product" class="nav-link" href="/master-product">Master Product</a></li>
                                <li id="master-paket"><a id="btn-master-paket" class="nav-link" href="/master-paket">Master Paket</a></li>
                                <!-- <li id="master-banner"><a class="nav-link" href="/master-banner">Master Banner</a></li> -->
                            </ul>
                        </li>
                        <li class="menu-header">Transaction</li>
                        <li class="dropdown" id="drop-order">
                            <a href="/tr-order" class="nav-link"><i data-feather="shopping-cart"></i><span>Customer Order</span></a>
                        </li>
                        <li class="dropdown" id="drop-schedule">
                            <a href="/tr-schedule" class="nav-link"><i data-feather="calendar"></i><span>Customer Schedule</span></a>
                        </li>
                        <li class="dropdown" id="drop-payment">
                            <a href="/tr-payment" class="nav-link"><i data-feather="credit-card"></i><span>Payment Order</span></a>
                        </li>
                        <!-- <li class="dropdown">
                            <a href="/tr-payment-done" class="nav-link"><i data-feather="dollar-sign"></i><span>Payment Done (Lunas)</span></a>
                        </li> -->
                        <li class="menu-header">Reporting</li>
                        <li class="dropdown" id="drop-invoice-os">
                            <a href="/invoice-outstanding" class="nav-link"><i data-feather="file-text"></i><span>Invoice Outstanding</span></a>
                        </li>
                        <li class="dropdown" id="drop-invoice-ls">
                            <a href="/invoice-lunas" class="nav-link"><i data-feather="check-circle"></i><span>Invoice Lunas</span></a>
                        </li>
                        <li class="dropdown" id="drop-message">
                            <a href="/rpt-message" class="nav-link"><i data-feather="message-square"></i><span>Message Website</span></a>
                        </li>
                    </ul>
                </aside>
            </div>