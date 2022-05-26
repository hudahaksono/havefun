@section('title', 'Master Paket')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Daftar Invoice Lunas</h3>
                    <div class="container mb-5">
                        <div class="row">
                            <!-- <div class="col-md-12 mb-3">
                                <button id="tambah_data" class="btn btn-primary"><i class="fas fa-plus"></i> Add Data</button>
                            </div> -->
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_list_hdr" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <td>Id</td>
                                                <td>No.</td>
                                                <td>No. Invoice</td>
                                                <td>Tgl. Invoice</td>
                                                <td>No. Order</td>
                                                <td>Total Tagihan</td>
                                                <td>Total Pembayaran</td>
                                                <td>Outsatnding</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                            </tr>
                                        </tbody>
                                    </table>
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
<script src="{{ asset('js/jquery.form.js') }}"></script>

<script>
    $("#drop-dashboard").removeClass('active');
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
    $("#drop-invoice-ls").addClass("active");
    $("#drop-message").removeClass('active');

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function currencyFormat(num, decimal = 0) {
            //return parseFloat(num).toFixed(decimal).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            return accounting.formatMoney(num, "", decimal, ",", ".");
        }

        function amountToFloat(amount) {
            //return parseFloat(amount.toString().replace(/\s/g, "").replace(",", "."));
            return parseFloat(accounting.unformat(amount));
        }

        function list_data() {
            $("#tbl_list_hdr").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.payment.list.invoice')}}",
                    type: "GET",
                },
                columns: [{
                        data: "id",
                        name: "id",
                        visible: false
                    }, // 0
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    }, // 1
                    // { data: "kode", name: "kode", visible: true }, // 2
                    {
                        data: "no_payment",
                        name: "no_payment",
                        visible: true
                    }, // 3
                    {
                        data: "tgl_payment",
                        name: "tgl_payment",
                        render: function(d) {
                            return moment(d).format("DD-MM-YYYY");
                        },
                    }, // 3
                    {
                        data: "no_order",
                        name: "no_order",
                        visible: true
                    }, // 4
                    {
                        data: "total_payment",
                        name: "total_payment",
                        render: function(d) {
                            return currencyFormat(d);
                        },
                        visible: true
                    }, // 4
                    {
                        data: "actual_payment",
                        name: "actual_payment",
                        render: function(d) {
                            return currencyFormat(d);
                        },
                        visible: false
                    }, // 4
                    {
                        data: "os_payment",
                        name: "os_payment",
                        render: function(d) {
                            return currencyFormat(d);
                        },
                        visible: false
                    }, // 4
                    {
                        data: "action",
                        name: "action",
                        visible: true
                    }, // 5
                ],
                //      aligment left, right, center row dan coloumn
                order: [
                    ["0", "desc"]
                ],
                columnDefs: [{
                        className: "text-center",
                        targets: [0, 1, 2, 3, 4, 8]
                    },
                    {
                        className: "text-right",
                        targets: [5, 6, 7]
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_hdr").css("cursor", "pointer");
        }

        list_data();

        $('body').on('click', '#cetak', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            id = data['id'];
            no_order = data['no_order'];
            no_payment = data['no_payment'];
            tgl_payment = data['tgl_payment'];
            total_payment = data['total_payment'];
            actual_payment = data['actual_payment'];
            os_payment = amountToFloat(total_payment) - amountToFloat(actual_payment);
            window.open("/invoice-lunas/generate?id=" + id, "_blank");
        });
    });
</script>