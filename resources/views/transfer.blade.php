@section('title', 'Transfer')
@include('navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form action="#" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">BUKTI PEMBAYARAN</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12 text-center">
                            <img class="text-center" style="width:250px" src="{{ asset('images/transfer/bca.png') }}" />
                        </div>
                        <div class="col-md-12 text-center">
                            <h3>Payment ID : 124235</h3>
                        </div>
                        <div class="col-md-12 d-flex">
                            <div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
                                <p class="d-flex total-price">
                                    <span>Grand Total</span>
                                    <span>&nbsp;</span>
                                    <span style="font-weight:bold">Rp. 16.600.000</span>
                                </p>
                                <hr>
                                <p><a href="#" class="btn btn-primary py-3 px-4"><i class="fa-brands fa-whatsapp"></i> Kirim Bukti Transfer</a></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('footbar')