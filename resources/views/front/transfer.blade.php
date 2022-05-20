@section('title', 'Transfer')
@include('layouts.navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <div action="#" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">Terima Masih Sudah Mengorder</h3>
                    <div class="row align-items-end">
                        <div class="col-md-12 text-center">
                            <img class="text-center" style="width:250px" src="{{ asset('images/check.png') }}" />
                        </div>
                        <div class="col-md-12 text-center">
                            <h3>Pesanan Anda Sedang Kami Proses</h3>
                        </div>
                        <div class="col-md-12 d-flex">
                            <a href="/" class="btn btn-primary" style="width:100%;">Kembali Ke Halaman Utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')