@section('title', 'Payment')
@include('layouts.navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form action="#" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">DETAIL PEMBAYARAN</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12 d-flex">
                            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                <p class="d-flex">
                                    <span>Produk</span>
                                    <span>Engagement - Stepa</span>
                                    <span style="color:green">Rp. 15.000.000</span>
                                </p>
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
                                    <span style="font-weight:bold">Rp. 16.600.000</span>
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
                            <form class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Acara</label>
                                        <input class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat Acara</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
                                        <input class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota/Kabupaten</label>
                                        <input class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota/Kabupaten</label>
                                        <input class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota/Kabupaten</label>
                                        <input class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <button class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i>&nbsp; Konsultasi Product Dengan Admin
                                        </button>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary"><i class="fa-solid fa-dollar-sign"></i>&nbsp; Lanjut Ke Pembayaran
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- <div class="row mt-5 pt-3 d-flex">
                    <div class="col-md-12">
                        <div class="cart-detail ftco-bg-dark p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Metode Transfer</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"><img style="width:75px" src="{{ asset('images/transfer/bca.png') }}" /></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"><img style="width:75px" src="{{ asset('images/transfer/mandiri.png') }}" /></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" class="mr-2"> <img style="width:75px" src="{{ asset('images/transfer/bni.png') }}" /></label>
                                    </div>
                                </div>
                            </div>
                            <p><a href="#" class="btn btn-primary py-3 px-4">Lanjutkan Ke Transfer</a></p>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')