@section('title', 'Product')
@include('layouts.navbar')
<section class="ftco-menu">
    <div id="product" class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Produk Kami</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach ($kategori as $kat)
                            <a class="nav-link" id="tab-{{ $kat->id }}" data-toggle="pill" href="#{{ $kat->id }}" role="tab" aria-controls="v-pills-1" aria-selected="true">{{ $kat->nama }}</a>
                            @endforeach
                            <!-- <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Engagement</a>
                            <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Intimate Akad</a>
                            <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Wedding Outdoor</a>
                            <a class="nav-link" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">Wedding Hall</a>
                            <a class="nav-link" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">Wedding Home</a>
                            <a class="nav-link" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">Custom Wedding Decoration</a> -->
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            @foreach ($kategori as $kat)
                            <div class="tab-pane fade show" id="{{ $kat->id }}" role="tabpanel" aria-labelledby="tab-{{ $kat->id }}">
                                <div class="row" id="list-{{ $kat->id }}">

                                </div>
                            </div>
                            @endforeach
                            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/savana/savana1.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Lite</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>Rp. 5.000.000</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/savana/savana2.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Medium</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>Rp. 7.500.000</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url(images/savana/savana3.jpg);"></a>
                                            <div class="text">
                                                <h3><a href="#">Stepa</a></h3>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                                                <p class="price"><span>Rp. 10.000.000</span></p>
                                                <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div id="product_detail" class="container" style="display: none;">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <div class="row" id="list_gambar">

                </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <a href="images/savana/savana1.jpg" class="image-popup"><img src="images/savana/savana1.jpg" class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                    <div class="col-md-6">
                        <a href="images/savana/savana2.jpg" class="image-popup"><img src="images/savana/savana2.jpg" class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-md-6">
                        <a href="images/savana/savana3.jpg" class="image-popup"><img src="images/savana/savana3.jpg" class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                    <div class="col-md-6">
                        <a href="images/savana/savana4.jpg" class="image-popup"><img src="images/savana/savana4.jpg" class="img-fluid" alt="Colorlib Template"></a>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <input type="hidden" id="detail_id">
                <input type="hidden" id="detail_sess_id" name="detail_sess_id" value="{{Session('sess_id')}}">
                <input type="hidden" id="detail_sess_nama" value="{{Session('sess_nama')}}">
                <h3 id="detail_title">Engagement - Lite</h3>
                <p class="price"><span id="detail_harga">Rp. 5.000.000</span></p>
                <p id="detail_nama">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                <p id="detail_keterangan">On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.
                </p>
                <div class="input-group col-md-6 d-flex mb-3">
                    <span class="input-group-btn mr-2">
                        <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                            <i class="icon-minus"></i>
                        </button>
                    </span>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                    <span class="input-group-btn ml-2">
                        <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                            <i class="icon-plus"></i>
                        </button>
                    </span>
                </div>
                <p>
                    <a href="javascript:void(0)" id="btn_chart" class="btn btn-primary py-3 px-5"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</a>
                    <a href="javascript:void(0)" id="btn_order" class="btn btn-primary py-3 px-5"><i class="fa-solid fa-dollar-sign"></i> Order</a>
                </p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    // $('#product_detail').hide();
    $('.nav-item').removeClass('active');
    $('#nav-produk').addClass('active');

    $('#btn_detail').click(function() {
        $('#product').hide('slow');
        $('#product_detail').show('slow');
    });

    $('.total_chart').html('{{$total_chart}}');

    $(document).ready(function() {
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function produk(id_kategori) {
            $.ajax({
                url: "{{route('api.fr.produk.list')}}",
                type: 'GET',
                data: {
                    id_kategori: id_kategori
                },
                success: function(response) {
                    id_kategori = '#list-' + id_kategori;
                    $(id_kategori).empty();
                    $.each(response, function(key, value) {
                        btn_id = 'btn_' + value.id;
                        $(id_kategori).append('<div class="col-md-4 text-center"><div class="menu-wrap"><a href="#" class="menu-img img mb-4" style="background-image: url(produk/' + value.file_name + ');"></a><div class="text"><h3><a href="#">' + value.nama + '</a></h3><p>' + value.keterangan + '</p><p class="price"><span>Rp. ' + numberWithCommas(value.harga) + '</span></p><p><a href="javascript:void(0)" class="btn btn-primary btn-outline-primary" onclick="show_detail(' + value.id + ')">View Detail</a></p></div></div></div>');
                    });
                }
            });
        }
        var kategorti_first = '#tab-{{$id_kategori_first}}';
        var tab_first = '#{{$id_kategori_first}}';
        // alert(kategorti_first);
        produk('{{$id_kategori_first}}');
        $(kategorti_first).addClass('active');
        $(kategorti_first).addClass('show');
        $(tab_first).addClass('active');
        // $(tab_firt).addClass('show');

        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            var target = $(e.target).attr("href") // activated tab
            id = target.replace('#', '');
            table_id = id;
            produk(table_id);
        });

        var quantitiy = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });

        $('#btn_chart').click(function(event) {
            if ($('#detail_sess_nama').val().length == 0) {
                window.location = "{{route('login-customer')}}";
            } else {
                id_product = $('#detail_id').val();
                qty_product = $('#quantity').val();
                session_nama = $('#detail_sess_nama').val();
                $.ajax({
                    type: "post",
                    url: "{{route('api.fr.produk.store.chart')}}",
                    data: {
                        id: id_product,
                        qty: qty_product,
                        session_nama: session_nama
                    },
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
                            window.location = "{{route('f-chart')}}";
                        } else {
                            swal('Peringatan!', message, {
                                icon: 'warning',
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

        $('#btn_order').click(function(event) {
            session_id = $('#detail_sess_id').val();
            session_nama = $('#detail_sess_nama').val();
            id_product = $('#detail_id').val();
            qty_product = $('#quantity').val();

            if ($('#detail_sess_nama').val().length == 0) {
                window.location = "{{route('login-customer')}}";
            } else {
                $.ajax({
                    type: "post",
                    url: "{{route('api.fr.produk.store.barang')}}",
                    data: {
                        id_product: id_product,
                        qty_product: qty_product,
                        session_nama: session_nama,
                        session_id: session_id
                    },
                    success: function(response) {
                        for (var key in response) {
                            var flag = response["success"];
                            var message = response["message"];
                            var no_order = response["no_order"];
                        }

                        if ($.trim(flag) == "true") {
                            // swal('Success!', message, {
                            //     icon: 'success',
                            //     buttons: {
                            //         confirm: {
                            //             className: 'btn btn-success'
                            //         }
                            //     }
                            // });
                            window.location = "/payment?no_order=" + no_order;
                        } else {
                            swal('Peringatan!', message, {
                                icon: 'warning',
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

    function numberWithCommasdetail(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function show_detail(id) {
        $.ajax({
            url: "{{route('api.fr.produk.detail')}}",
            type: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                $('#detail_id').val(response.id);
                $('#detail_title').html(response.nama_kategori);
                $('#detail_harga').html('Rp. ' + numberWithCommasdetail(response.harga));
                $('#detail_nama').html(response.nama);
                $('#detail_keterangan').html(response.keterangan);
                gambar = response.file_name_multi;
                gambar_array = gambar.split(",");
                gambar_length = gambar_array.length;
                $('#list_gambar').empty();
                for (var i = 0; i < gambar_length; i++) {
                    $('#list_gambar').append('<div class="col-md-6"><a href="images/savana/savana1.jpg" class="image-popup"><img src="produk/' + gambar_array[i] + '" class="img-fluid" alt="Colorlib Template"></a></div>');
                }
            }
        });
        $('#product').hide('slow');
        $('#product_detail').show('slow');
    }
</script>