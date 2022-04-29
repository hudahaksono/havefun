@section('title', 'Paket')
@include('layouts.navbar')
<section class="ftco-menu">
    <div id="product" class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Discover</span>
                <h2 class="mb-4">Paket Dekorasi</h2>
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
                            <!-- <a class="nav-link active" id="tab-1" data-toggle="pill" href="#1" role="tab" aria-controls="v-pills-1" aria-selected="true">Paket Lite</a>
                            <a class="nav-link" id="tab-2" data-toggle="pill" href="#2" role="tab" aria-controls="v-pills-2" aria-selected="false">Paket Medium</a>
                            <a class="nav-link" id="tab-3" data-toggle="pill" href="#3" role="tab" aria-controls="v-pills-3" aria-selected="false">Paket Stepa</a> -->
                            
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="1" role="tabpanel" aria-labelledby="tab-1">
                                <div class="row" id="list-1">

                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="2" role="tabpanel" aria-labelledby="tab-2">
                                <div class="row" id="list-2">

                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="3" role="tabpanel" aria-labelledby="tab-3">
                                <div class="row" id="list-3">

                                </div>
                            </div>
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
    <div id="product_detail" class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <div class="row" id="list_gambar">

                </div>
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
                        <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
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

<!-- <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <h2 class="mb-4">Tambahan Paket</h2>
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
                        <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
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
                        <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
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
                        <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
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
                        <p><a href="#" class="btn btn-primary btn-outline-primary">View Detail</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>
@include('layouts.footbar')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    $('.nav-item').removeClass('active');
    $('#nav-paket').addClass('active');
    // $('#product_detail').hide();
    $('#btn_detail').click(function() {
        $('#product').hide('slow');
        $('#product_detail').show('slow');
    });

    $(document).ready(function() {
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function produk(id_kategori)
        {
            $.ajax({
                url: "{{route('api.fr.paket.list')}}",
                type: 'GET',
                data: {id_kategori:id_kategori},
                success: function (response) {
                    id_kategori = '#list-'+id_kategori;
                    $(id_kategori).empty();
                    $.each(response, function (key, value) {
                        btn_id = 'btn_'+value.id;
                        $(id_kategori).append('<div class="col-md-4 text-center"><div class="menu-wrap"><a href="#" class="menu-img img mb-4" style="background-image: url(produk/'+value.file_name+');"></a><div class="text"><h3><a href="#">'+value.nama+'</a></h3><p>'+value.keterangan+'</p><p class="price"><span>Rp. '+numberWithCommas(value.harga)+'</span></p><p><a href="javascript:void(0)" class="btn btn-primary btn-outline-primary" onclick="show_detail('+value.id+')">View Detail</a></p></div></div></div>');
                    });
                }
            });
        }

        var kategorti_first = '#tab-1';
        var tab_first = '#1';
        // alert(kategorti_first);
        produk(1); 

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href") // activated tab
            id = target.replace('#', '');
            table_id = id;
            produk(table_id);
        });

        var quantitiy=0;
        $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
                
                $('#quantity').val(quantity + 1);

              
                // Increment
            
        });

        $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
          
                // Increment
                if(quantity>0){
                $('#quantity').val(quantity - 1);
                }
        });

        $('#btn_chart').click(function(event) {
            id_product = $('#detail_id').val();
            qty_product = $('#quantity').val();
            session_nama = $('#detail_sess_nama').val();
            $.ajax({
                type: "post",
                url: "{{route('api.fr.paket.store.chart')}}",
                data: {id:id_product,qty:qty_product,session_nama:session_nama},
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
                        window.location ="{{route('f-chart')}}";
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
        });

        $('#btn_order').click(function(event) {
            session_id = $('#detail_sess_id').val();
            session_nama = $('#detail_sess_nama').val();
            id_product = $('#detail_id').val();
            qty_product = $('#quantity').val();
            
            if($('#detail_sess_nama').val().length==0){
                window.location ="{{route('login-customer')}}";
            }else{
                $.ajax({
                    type: "post",
                    url: "{{route('api.fr.produk.store.paket')}}",
                    data: {id_product:id_product,qty_product:qty_product,session_nama:session_nama,session_id:session_id},
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
                            window.location ="/payment?no_order=" + no_order;
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

    function show_detail(id)
    {
        $.ajax({
                url: "{{route('api.fr.paket.detail')}}",
                type: 'GET',
                data: {id:id},
                success: function (response) {
                    $('#detail_id').val(response.id);
                    if(response.id_kategori==1){
                        $('#detail_title').html('Paket Lite');
                    }else if(response.id_kategori==2){
                        $('#detail_title').html('Paket Medium');
                    }else{
                        $('#detail_title').html('Paket Stepa');
                    }
                    
                    $('#detail_harga').html('Rp. '+numberWithCommasdetail(response.harga));
                    $('#detail_nama').html(response.nama);
                    $('#detail_keterangan').html(response.keterangan);

                    var id_hdr = response.id;
                    $.ajax({
                        url: "{{route('api.fr.paket.detail.produk')}}",
                        type: 'GET',
                        data: {id_hdr:id_hdr},
                        success: function (response) {
                            $('#list_gambar').empty();
                            $.each(response, function (key, value) {
                                $('#list_gambar').append('<div class="col-md-6"><a href="images/savana/savana1.jpg" class="image-popup"><img src="produk/'+value.file_name+'" class="img-fluid" alt="Colorlib Template"></a></div>');
                            });
                        }
                    });
                    // gambar = response.file_name_multi;
                    // gambar_array = gambar.split(",");
                    // gambar_length = gambar_array.length;
                    // $('#list_gambar').empty();
                    // for (var i = 0; i < gambar_length; i++) {
                    //     $('#list_gambar').append('<div class="col-md-6"><a href="images/savana/savana1.jpg" class="image-popup"><img src="produk/'+gambar_array[i]+'" class="img-fluid" alt="Colorlib Template"></a></div>');
                    // }
                }
            });
        $('#product').hide('slow');
        $('#product_detail').show('slow');
    }
</script>