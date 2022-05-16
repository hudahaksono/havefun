@section('title', 'Home')
@include('layouts.navbar')
<section class="home-slider owl-carousel">
    <!-- <div class="slider-item" style="background-image: url(images/savana/savana1.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">SAVANNA DECORATION</h1>
                    <p class="mb-4 mb-md-5">Ganti Kata Kata Lu bays</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Product</a></p>
                </div>

            </div>
        </div>
    </div> -->
    @foreach ($banner as $bann)
    <div class="slider-item" style="background-image: url(banner/{{ $bann->file_name }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">SAVANNA DECORATION</h1>
                    <p class="mb-4 mb-md-5">Ganti Kata Kata Lu bays</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Product</a></p>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    <!-- <div class="slider-item" style="background-image: url(images/savana/savana2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">SAVANNA DECORATION</h1>
                    <p class="mb-4 mb-md-5">Ganti Kata Kata Lu bays</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Product</a></p>
                </div>

            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url(images/savana/savana3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                <div class="col-md-8 col-sm-12 text-center ftco-animate">
                    <span class="subheading">Welcome</span>
                    <h1 class="mb-4">SAVANNA DECORATION</h1>
                    <p class="mb-4 mb-md-5">Ganti Kata Kata Lu bays</p>
                    <p><a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Order Now</a> <a href="#" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Product</a></p>
                </div>

            </div>
        </div>
    </div> -->
</section>

<section class="ftco-intro">
    <div class="container-wrap">
        <div class="wrap d-md-flex align-items-xl-end">
            <div class="info">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-phone"></span></div>
                        <div class="text">
                            <h3>Kontak Person</h3>
                            <p>+6285866167659</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-my_location"></span></div>
                        <div class="text">
                            <h3>Savanna Decoration</h3>
                            <p> Jl. H. Rijin No.143 A, Tugu, Kec. Cimanggis, Kota Depok, Jawa Barat 16451</p>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex ftco-animate">
                        <div class="icon"><span class="icon-clock-o"></span></div>
                        <div class="text">
                            <h3>Open Senin-Jumat</h3>
                            <p>08:00- 21:00</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="book p-4">
                <h3>Masih Mau Konsep Dekorasi Seperti Apa ?<br>Yuk Konsultasi Dulu</h3>
                <form id="form_input" action="#" class="appointment-form">
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group ml-md-4">
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input id="tanggal" name="tanggal" type="text" class="form-control appointment_date" placeholder="Tanggal Acara">
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <input id="no_tlp" name="no_tlp" type="text" class="form-control" placeholder="No Handphone">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <textarea id="pesan" name="pesan" cols="50" rows="2" class="form-control" placeholder="Pesan"></textarea>
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <button id="submit" type="button" class="btn btn-white py-3 px-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pr-md-5">
                <div class="heading-section text-md-right ftco-animate">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Product Kami</h2>
                    <p class="mb-4">-- Tulislah Kterangan Product Disini -- .</p>
                    <p><a href="/product" class="btn btn-primary btn-outline-primary px-4 py-3">Lihat Semua Product</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a class="img" style="background-image: url(images/savana/savana1.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a class="img" style="background-image: url(images/savana/savana2.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry">
                            <a class="img" style="background-image: url(images/savana/savana3.jpg);"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="menu-entry mt-lg-4">
                            <a class="img" style="background-image: url(images/savana/savana4.jpg);"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-services">
    <div class="container">
        <div class="row">
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <span class="flaticon-choices"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Mudah Untuk Order</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <i class="fas fa-mobile-alt fa-3x"></i>
                        <!-- <span class="flaticon-phone"></span> -->
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Fast Respon</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ftco-animate">
                <div class="media d-block text-center block-6 services">
                    <div class="icon d-flex justify-content-center align-items-center mb-5">
                        <i class="fas fa-newspaper fa-3x"></i>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Terpercaya</h3>
                        <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Best Sellers</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/savana/savana1.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>Rp. 2.300.000</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/savana/savana1.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>Rp. 2.300.000</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/savana/savana1.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>Rp. 2.300.000</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="menu-entry">
                    <a href="#" class="img" style="background-image: url(images/savana/savana1.jpg);"></a>
                    <div class="text text-center pt-4">
                        <h3><a href="#">Coffee Capuccino</a></h3>
                        <p>A small river named Duden flows by their place and supplies</p>
                        <p class="price"><span>Rp. 2.300.000</span></p>
                        <p><a href="#" class="btn btn-primary btn-outline-primary">Add to Cart</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-gallery">
    <div class="container-wrap">
        <div class="row no-gutters">
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-1.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-2.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-3.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
            <div class="col-md-3 ftco-animate">
                <a href="gallery.html" class="gallery img d-flex align-items-center" style="background-image: url(images/gallery-4.jpg);">
                    <div class="icon mb-4 d-flex align-items-center justify-content-center">
                        <span class="icon-search"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section img" id="ftco-testimony" style="background-image: url(images/savana/savana2.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Testimony</span>
                <h2 class="mb-4">Customers Says</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
    </div>
    <div class="container-wrap">
        <div class="row d-flex no-gutters">
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="images/person_1.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end">
                <div class="testimony overlay">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="images/person_2.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name. &rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="images/person_3.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end">
                <div class="testimony overlay">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however.&rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="images/person_2.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg align-self-sm-end ftco-animate">
                <div class="testimony">
                    <blockquote>
                        <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name. &rdquo;</p>
                    </blockquote>
                    <div class="author d-flex mt-4">
                        <div class="image mr-3 align-self-center">
                            <img src="images/person_3.jpg" alt="">
                        </div>
                        <div class="name align-self-center">Louise Kelly <span class="position">Illustrator Designer</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-appointment">
    <div class="overlay"></div>
    <div class="container-wrap">
        <div class="row no-gutters d-md-flex align-items-center">
            <div class="col-md-6 d-flex align-self-stretch">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2111365104406!2d106.84140181408124!3d-6.366716164051715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed4d9cbff79d%3A0x942acf5544c32efa!2sSavanna%20decoration!5e0!3m2!1sen!2sid!4v1645866616119!5m2!1sen!2sid" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-md-6 appointment ftco-animate">
                <h3 class="mb-3">Masih Mau Konsep Dekorasi Seperti Apa ?<br>Yuk Konsultasi Dulu</h3>
                <form id="form_input2" action="#" class="appointment-form">
                    <div class="d-md-flex">
                        <div class="form-group">
                            <input name="nama2" id="nama2" type="text" class="form-control" placeholder="Nama">
                        </div>
                        <div class="form-group ml-md-4">
                            <input name="email2" id="email2" type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <div class="input-wrap">
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input name="tanggal2" id="tanggal2" type="text" class="form-control appointment_date" placeholder="Tanggal Acara">
                            </div>
                        </div>
                        <div class="form-group ml-md-4">
                            <input name="no_tlp2" id="no_tlp2" type="text" class="form-control" placeholder="No Handphone">
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <textarea name="pesan2" id="pesan2" name="" id="" cols="50" rows="2" class="form-control" placeholder="Pesan"></textarea>
                        </div>
                    </div>
                    <div class="d-md-flex">
                        <div class="form-group">
                            <button name="submit2" id="submit2" type="button" class="btn btn-white py-3 px-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')
<script>
    $('.total_chart').html('{{$total_chart}}');
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function reset_input() {
            $('#nama').val('');
            $('#email').val('');
            $('#tanggal').val(0);
            $('#no_tlp').val('');
            $('#pesan').val('');
        }

        function reset_input2() {
            $('#nama2').val('');
            $('#email2').val('');
            $('#tanggal2').val(0);
            $('#no_tlp2').val('');
            $('#pesan2').val('');
        }

        $('#submit').click(function() {
            var nama = document.getElementById("nama").value;
            var email = document.getElementById("email").value;
            var tanggal = document.getElementById("tanggal").value;
            var no_tlp = document.getElementById("no_tlp").value;
            var pesan = document.getElementById("pesan").value;
            if (nama == "") {
                swal("Peringatan!", "Nama tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (tanggal == "") {
                swal("Peringatan!", "Tanggal tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (no_tlp == "") {
                swal("Peringatan!", "No Handphone tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (pesan == "") {
                swal("Peringatan!", "Pesan tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else {
                $.ajax({
                    type: "post",
                    url: "/store-message",
                    data: $("#form_input").serialize(),
                    success: function(response) {
                        for (var key in response) {
                            var flag = response["success"];
                            var message = response["message"];
                        }

                        if ($.trim(flag) == "true") {
                            swal('Success!', message, {
                                icon: 'success',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                            reset_input();
                        } else if ($.trim(message) == "true") {
                            swal('Warning!', message, {
                                icon: 'warning',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-warning'
                                    }
                                }
                            });
                        } else {
                            swal('Peringatan!', message, {
                                icon: 'info',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-info'
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ": " + xhr.statusText;
                        swal('Error!', errorMessage, {
                            icon: 'danger',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            }
                        });
                    },
                });
            }
        });

        $('#submit2').click(function() {
            var nama2 = document.getElementById("nama2").value;
            var email2 = document.getElementById("email2").value;
            var tanggal2 = document.getElementById("tanggal2").value;
            var no_tlp2 = document.getElementById("no_tlp2").value;
            var pesan2 = document.getElementById("pesan2").value;
            if (nama2 == "") {
                swal("Peringatan!", "Nama tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (tanggal2 == "") {
                swal("Peringatan!", "Tanggal tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (no_tlp2 == "") {
                swal("Peringatan!", "No Handphone tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else if (pesan2 == "") {
                swal("Peringatan!", "Pesan tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else {
                $.ajax({
                    type: "post",
                    url: "/store-message2",
                    data: $("#form_input2").serialize(),
                    success: function(response) {
                        for (var key in response) {
                            var flag = response["success"];
                            var message = response["message"];
                        }

                        if ($.trim(flag) == "true") {
                            swal('Success!', message, {
                                icon: 'success',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-success'
                                    }
                                }
                            });
                            reset_input2();
                        } else if ($.trim(message) == "true") {
                            swal('Warning!', message, {
                                icon: 'warning',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-warning'
                                    }
                                }
                            });
                        } else {
                            swal('Peringatan!', message, {
                                icon: 'info',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-info'
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ": " + xhr.statusText;
                        swal('Error!', errorMessage, {
                            icon: 'danger',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-danger'
                                }
                            }
                        });
                    },
                });
            }
        });

    });
</script>