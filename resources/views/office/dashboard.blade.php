@section('title', 'Master User')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Pengguna</h5>
                                        <h2 style="color:blue" id="pengguna" class="mb-3 font-18"></h2>
                                        <!-- <p class="mb-0"><span class="col-green">+ 20</span> Bulan ini</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15"> Customers</h5>
                                        <h2 style="color:blue" id="customer" class="mb-3 font-18"></h2>
                                        <!-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Pembayaran Outstanding</h5>
                                        <h2 style="color:blue" id="jumlah_outstanding" class="mb-3 font-18">3</h2>
                                        <!-- <p class="mb-0"><span class="col-green">18%</span>
                                            Increase</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Pembayaran Lunas</h5>
                                        <h2 style="color:blue" id="jumlah_lunas" class="mb-3 font-18"></h2>
                                        <!-- <p class="mb-0"><span class="col-green">42%</span> Increase</p> -->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <!-- <h3 class="text-center mt-3 mb-3">Dashboard</h3> -->
                    <div class="container mb-5">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h4 class="text-center">Penjualan Tahun 2022</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <canvas id="batang" width="100%"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <!-- <h3 class="text-center mt-3 mb-3">Dashboard</h3> -->
                    <div class="container mb-5">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="text-center">TOP 4 Product Terjual</h4>
                                        <div class="table-responsive">
                                            <table id="tbl_product" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                                <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama Product</td>
                                                        <td>Jumlah Terjual</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodyproduct">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="text-center">TOP 4 Paket Terjual</h4>
                                        <div class="table-responsive">
                                            <table id="tbl_paket" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                                <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama Paket</td>
                                                        <td>Jumlah Terjual</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="bodypaket">
                                                </tbody>
                                            </table>
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
</div>
@include('office.layouts.footer')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $("#drop-dashboard").addClass('active');
    $("#drop-banner").removeClass('active');
    $("#drop-master").removeClass("active");

    $("#btn-master-user").removeClass("font-weight-bold");
    $("#btn-master-access").removeClass("font-weight-bold");
    $("#btn-master-kategori").removeClass("font-weight-bold");
    $("#btn-master-kategori-paket").removeClass("font-weight-bold");
    $("#btn-master-product").removeClass("font-weight-bold");
    $("#btn-master-paket").removeClass("font-weight-bold");

    $("#drop-order").removeClass("active");
    $("#drop-schedule").removeClass('active');
    $("#drop-payment").removeClass("active");
    $("#drop-invoice-os").removeClass('active');
    $("#drop-invoice-ls").removeClass("active");
    $("#drop-message").removeClass('active');
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            type: "GET",
            url: "/dashboard/list-data",
            success: function(response) {
                for (var key in response) {
                    var user = response.user;
                    var customer = response.customer;
                    var jumlah_outstanding = response.jumlah_outstanding;
                    var jumlah_lunas = response.jumlah_lunas;

                    // 4 Card Pengguna
                    $('#pengguna').text(user + " Orang");
                    $('#customer').text(customer + " Orang");
                    $('#jumlah_outstanding').text(jumlah_outstanding + " Transaksi");
                    $('#jumlah_lunas').text(jumlah_lunas + " Transaksi");
                }

                var januari = [];
                var februari = [];
                var maret = [];
                var april = [];
                var mei = [];
                var juni = [];
                var juli = [];
                var agustus = [];
                var september = [];
                var oktober = [];
                var november = [];
                var desember = [];

                $.each(response.jumlah_pembelian, function(key, value) {
                    januari.push(value.januari);
                    februari.push(value.februari);
                    maret.push(value.maret);
                    april.push(value.april);
                    mei.push(value.mei);
                    juni.push(value.juni);
                    juli.push(value.juli);
                    agustus.push(value.agustus);
                    september.push(value.september);
                    oktober.push(value.oktober);
                    november.push(value.november);
                    desember.push(value.desember);

                });

                // Diagram Jumlah Pembelian
                const ctx = document.getElementById('batang').getContext('2d');
                const batang = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: 'Total Order Tahun 2022',
                            data: [
                                januari,
                                februari,
                                maret,
                                april,
                                mei,
                                juni,
                                juli,
                                agustus,
                                september,
                                oktober,
                                november,
                                desember
                            ],
                            backgroundColor: '#0004ff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });


                if (response.top_product != "") {
                    var n = 1;
                    for (res of response.top_product) {
                        $("#bodyproduct").append(`
                        <tr>
                            <td style="text-align:center">
                                ${[n]}
                            </td>
                            <td style="text-align:left">
                                ${res["namaproduct"]}
                            </td>
                            <td style="text-align:center">
                                ${res["jumlah"]}
                            </td>
                        </tr>
                    `)
                        n++;
                    }

                } else {
                    $("#bodyproduct").append(`
                        <tr>
                            <td style="text-align:center;font-weight:bold" colspan="3">
                               Tidak Ada Data
                            </td>
                        </tr>
                    `)
                }

                if (response.top_paket != "") {
                    var n = 1;
                    for (res of response.top_paket) {
                        $("#bodypaket").append(`
                        <tr>
                            <td style="text-align:center">
                                ${[n]}
                            </td>
                            <td style="text-align:left">
                                ${res["namapaket"]}
                            </td>
                            <td style="text-align:center">
                                ${res["jumlah"]}
                            </td>
                        </tr>
                    `)
                        n++;
                    }

                } else {
                    $("#bodypaket").append(`
                        <tr>
                            <td style="text-align:center;font-weight:bold" colspan="3">
                               Tidak Ada Data
                            </td>
                        </tr>
                    `)
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
</script>