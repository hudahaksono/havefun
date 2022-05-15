@section('title', 'Payment')
@include('layouts.navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">DETAIL PEMBAYARAN</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12 d-flex">
                            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                <input type="hidden" value="{{$total = 0}}">
                                @foreach($data as $produk)
                                <p class="d-flex">
                                    @if($produk->status_product==0)
                                        <span>Produk</span>
                                    @else
                                        <span>Tambahan Produk</span>
                                    @endif
                                    
                                    <span>{{$produk->nama}}</span>
                                    <span style="color:green">Rp. {{number_format($produk->qty * $produk->harga,0,",",".")}}</span>
                                    <input type="hidden" value="{{$total = $total + ($produk->qty * $produk->harga)}}">
                                </p>
                                @endforeach
                                <!-- <p class="d-flex">
                                    <span>Tambahan Produk</span>
                                    <span>Bunga 7 Rupa</span>
                                    <span style="color:green">Rp. 100.000</span>
                                </p>
                                <p class="d-flex">
                                    <span>Tambahan Produk</span>
                                    <span>Bangku</span>
                                    <span style="color:green">Rp. 1.000.000</span>
                                </p>
                                <p class="d-flex">
                                    <span>Tambahan Produk</span>
                                    <span>Meja</span>
                                    <span style="color:green">Rp. 500.000</span>
                                </p>
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span>&nbsp;</span>
                                    <span style="color:red">- Rp. 0</span>
                                </p> -->
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Grand Total</span>
                                    <span>&nbsp;</span>
                                    <span style="font-weight:bold">Rp.  {{number_format($total,0,",",".")}}</span>
                                </p>
                                <!-- <p><a href="#" class="btn btn-primary py-3 px-4"><i class="fa-solid fa-dollar-sign"></i> Payment</a></p> -->
                            </div>
                        </div>
                    </div>
                </form><!-- END -->

                <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-12">
                        <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Tempat dan Tanggal Acara</h3>
                            <form class="row" id="add_payment">
                                <input type="hidden" id="sess_nama" name="sess_nama" value="{{Session('sess_nama')}}">
                                <input type="hidden" id="sess_id" name="sess_id" value="{{Session('sess_id')}}">
                                <input type="hidden" id="no_order" name="no_order" value="{{$no_order}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Acara</label>
                                        <!-- <input class="form-control" /> -->
                                        <input id="tgl_acara" name="tgl_acara" class="form-control" type="date" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat Acara</label>
                                        <textarea id="alamat_acara" class="form-control" name="alamat_acara"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <!-- <button class="btn btn-primary" id="konsultasi_wa"><i class="fa-brands fa-whatsapp"></i>&nbsp; Konsultasi Product Dengan Admin
                                        </button> -->
                                        <a href="javascript:void(0)" id="konsultasi_wa" class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i> Lanjut Ke Pembayaran</a>
                                    </div>
                                    <div class="form-group">
                                        <a href="javascript:void(0)" id="lanjut_pembayaran" class="btn btn-primary"><i class="fa-solid fa-dollar-sign"></i> Lanjut Ke Pembayaran</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')
<script>
    var date = new Date();
    var currentDate = date.toISOString().substring(0,10);
    document.getElementById('tgl_acara').value = currentDate;

    function numberWithCommasdetail(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    // gotowhatsapp('NP-2203-0015');
    function gotowhatsapp(no_order) {
        var total = 0;
        var text_send = '';
        $.ajax({
                url: "{{route('api.fr.payment.list')}}",
                type: 'GET',
                data: {no_order:no_order},
                success: function (response) {
                    $.each(response, function (key, value) {
                        if(value.status_product == 0){
                            status_produk = '- Produk'
                        }else{
                            status_produk = '- Tambahan Produk'
                        }
                        nama = value.nama;
                        harga = value.harga * value.qty;
                        total = total + (value.harga*value.qty);
                        text = status_produk + ': ' + nama + ' Rp. ' + numberWithCommasdetail(harga) + "%0a";
                        text_send = text_send + text;
                        no_order = value.no_order;
                        // alert(text_send);
                    });
                    var text_total = 'Grand Total : *Rp. ' + numberWithCommasdetail(total) +',-*';
                    var url = "https://wa.me/+6283874722798?text=" + 'Pesanan Saya No : *' + no_order + '*%0a' + text_send + text_total;
                    window.open(url, '_blank').focus();
                }

            });

        // name = "ludi";
        // phone = "o811";
        // email = "email@gmail.com";
        // service = "tess";
        // var url = "https://wa.me/+6283874722798?text=" 
        // + "Name: " + name + "%0a"
        // + "Phone: " + phone + "%0a"
        // + "Email: " + email  + "%0a"
        // + "Service: " + service; 

        // window.open(url, '_blank').focus();
    }

    $('.total_chart').html('{{$total_chart}}');
    
    $('#konsultasi_wa').click(function(event) {
        if($('#alamat_acara').val().length==0){
            swal('Peringatan!', 'Alamat belum di isi !!! ', {
                                icon: 'warning',
                                buttons: {
                                    confirm: {
                                        className: 'btn btn-info'
                                    }
                                }
                            });
            return false;
        }
        no_order = $('#no_order').val();
        gotowhatsapp(no_order);
    });

    $(document).ready(function() {
        $('#lanjut_pembayaran').click(function(event) {
            if($('#alamat_acara').val().length==0){
                swal('Peringatan!', 'Alamat belum di isi !!! ', {
                                    icon: 'warning',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-info'
                                        }
                                    }
                                });
                return false;
            }
            swal({
                title: 'Lanjutkan Pembayaran ?',
                text: "Setelah pembayaran pesanan akan di proses",
                type: 'info',
                buttons: {
                    confirm: {
                        text: 'Ya, Bayar!',
                        className: 'btn btn-info'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "post",
                        url: "{{route('api.fr.payment.store.payment')}}",
                        data: $("#add_payment").serialize(),
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                                var message = response["message"];
                                var no_order = response["no_order"];
                            }
                            
                            // url = "/payment?no_order=" + no_order;
                            url = "/myorder";
                            if ($.trim(flag) == "true") {
                                window.location = url;
                                swal('Success!', message, {
                                    icon: 'info',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-info'
                                        }
                                    }
                                });
                            }else{
                                swal('Peringatan!', message, {
                                    icon: 'warning',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-info'
                                        }
                                    }
                                });
                            }
                        }
                    });
                } else {
                    swal.close();
                }
            });
            
        });
    });
</script>