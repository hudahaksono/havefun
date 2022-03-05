@section('title', 'Customer Order')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('calendar/main.css') }}" /> -->
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Costumer Order</h3>
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_list_hdr" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <td>Id</td>
                                                <td>No.</td>
                                                <td>No Order</td>
                                                <td>Tanggal Order</td>
                                                <td>Nama</td>
                                                <td>No. Telp</td>
                                                <td>Email</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                                <td>-</td>
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
        <div id="lanjut" class="row justify-content-center" style="display: none;">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <button id="back_button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Data</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="text-center mb-3 text_title">Order No : </h3>
                        </div>
                        <div class="col-md-12" hidden="">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table style="width:100%" border="1">
                                            <tr>
                                                <td style="width: 15%;">Nama</td>
                                                <td style="width: 15%;"><font id="txt_nama"></font></td>
                                                <td style="width: 40%;"></td>
                                                <td style="width: 10%;">Tanggal Order</td>
                                                <td style="width: 20%;"><font id="txt_tgl"></font></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 15%;">No HP</td>
                                                <td style="width: 15%;"><font id="txt_nohp"></font></td>
                                                <td style="width: 40%;"></td>
                                                <td style="width: 10%;">Product</td>
                                                <td style="width: 20%;"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 text-right">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-input" />
                            </div>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="card-body">
                            <input type="hidden" id="f_status" name="f_status">
                            <input type="hidden" id="no_order" name="no_order">
                            <div class="col-md-12 mb-3">
                                <button id="tambah_data" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Produk</button>
                            </div>
                            <div class="col-md-12">
                            <!-- <div class="card-body">
                                
                                <div class="col-md-12"> -->
                                <table id="tbl_list_dtl" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                    <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                        <tr>
                                            <td>Id</td>
                                            <td>No</td>
                                            <td>No Order</td>
                                            <td>Tanggal Order</td>
                                            <td>Id Product</td>
                                            <td>Nama Product</td>
                                            <td>Harga</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- <td>1</td>
                                            <td>123-NP-123</td>
                                            <td>12-03-2022</td>
                                            <td>3</td>
                                            <td>Lite Uhuy</td>
                                            <td><span class="badge badge-success">New Order</span></td>
                                            <td><a style="color:white" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Tindak Lanjut</a><a style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td> -->
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- </div>
                            </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-right">
                        <div class="card-body">
                            <button id="save_button" class="btn btn-success"><i class="fas fa-save"></i> Proses PO</button>
                            &nbsp; <button id="schedule_button" class="btn btn-warning"><i class="fas fa-edit"></i> Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="add_data" class="page-inner mt--5" style="display: none;">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div id="" class="card full-height">
                        <div class="card-body">
                            <form class="row" id="form_input">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <a id="back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
                                    </div>
                                </div>
                                <input type="hidden" id="sysid" name="sysid">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Data Barang</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga">No. Order <span style="color: red;">*</span></label>
                                        <input id="no_order_input" name="no_order_input" class="form-control" type="text" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="harga">Tgl. Order <span style="color: red;">*</span></label>
                                        <input id="tgl_order_input" name="tgl_order_input" class="form-control" type="text" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="barang">Nama Produk <span style="color: red;">*</span></label>
                                        <div class="input-group">
                                            <input type="hidden" id="barang_id" name="barang_id">
                                            <input id="barang" name="barang" class="form-control" type="text" readonly>
                                            <div class="input-group-append">
                                                <a href="javascript:void(0)" class="btn btn-success browse_barang" id="browse_barang" data-toggle="tooltip" title="Browse"><span class="fas fa-search"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <div class="form-group">
                                        <!-- <button style="color:white" type="submit" class="btn btn-info waves-effect waves-dark btn-upload" data-toggle="tooltip" title="Save">
                                            <span class="btn-label">
                                                <i class="fas fa-save"></i>
                                            </span> Simpan
                                        </button> -->
                                        <a id="simpan" style="color:white" class="btn btn-info "><i class="fa fa-save"></i> &nbsp; Simpan</a>
                                        <a id="batal" name="batal" style="color:white" class="btn btn-danger "><i class="fa fa-times-circle"></i> &nbsp; Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="add_data_schedule" class="row" style="display: none;">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <!-- <h3 class="text-center mt-3 mb-3">Schedule Customers</h3> -->
                    <div class="container mb-5 mt-5">
                        <form class="row" id="form_input_schedule">
                            <div class="col-md-12 text-left">
                                <div class="form-group">
                                    <a id="back_schedule" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
                                </div>
                            </div>
                            <input type="hidden" name="state" id="state">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Schedule</h2>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_order">No. Order <span style="color: red;">*</span></label>
                                    <input type="hidden" name="id_order" id="id_order_s">
                                    <input id="no_order_s" name="no_order" class="form-control" type="text" readonly="" />
                                    <!-- <div class="input-group">
                                        
                                        <div class="input-group-append">
                                            <a href="javascript:void(0)" class="btn btn-success" id="browse_order" data-toggle="tooltip" title="Browse"><span class="fas fa-search"></span>
                                            </a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat">Tempat <span style="color: red;">*</span></label>
                                    <input id="tempat" name="tempat" class="form-control" type="text" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_dari">Tgl. Dari <span style="color: red;">*</span></label>
                                    <input id="tgl_dari" name="tgl_dari" class="form-control" type="date" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_sampai">Tgl. Sampai <span style="color: red;">*</span></label>
                                    <input id="tgl_sampai" name="tgl_sampai" class="form-control" type="date" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="keterangan_s">Keterangan <span style="color: red;">*</span></label>
                                    <textarea id="keterangan_s" name="keterangan" class="form-control" type="text" cols="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <div class="form-group">
                                    <a id="save" name="save" style="color:white" class="btn btn-info "><i class="fas fa-save"></i> &nbsp; Simpan</a>
                                    <a id="batal_schedule" style="color:white" class="btn btn-danger "><i class="fa fa-times-circle"></i> &nbsp; Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal_browse_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-weight:bold;color:#407290;text-shadow: 1px grey;" class="modal-title">Browse Barang Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        <div class="table-responsive">
                            <table id="datatable_list_barang" class="table text-nowrap table-bordered">
                                <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                    <tr>
                                        <th class="align-middle text-uppercase">ID</th>
                                        <th class="align-middle text-uppercase">No.</th>
                                        <th class="align-middle text-uppercase">Nama</th>
                                        <th class="align-middle text-uppercase">Harga</th>
                                        <th class="align-middle text-uppercase">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn_select_barang" data-dismiss="modal">
                            <span class="btn-label"><i class="ti-save"></i></span> Select
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <span class="btn-label"><i class="ti-close"></i></span> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@include('office.layouts.footer')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('calendar/main.js') }}"></script> -->
<script>
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

        function form_state(state) {
            switch (state) {
                case 'LOAD':
                    $('#lanjut').hide();
                    $('#list_data').show();
                    break;
                case 'ADD_HDR':
                    reset_input();
                    $("#state").val("ADD");
                    $('#title_input').html('Tambah Data Barang');
                    $('#lanjut').show('slow');
                    $('#list_data').hide('slow');
                    break;
                case 'SAVE_HDR':
                    break;
                case 'EDIT_HDR':
                    $("#state").val("EDIT");
                    $('#title_input').html('Tambah Data Barang');
                    $('#lanjut').show('slow');
                    $('#list_data').hide('slow');
                    break;
                case 'REVISI_HDR':
                    break;
            }
        }

        function list_data() {
            $("#tbl_list_hdr").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.order.list')}}",
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
                        data: "no_order",
                        name: "no_order",
                        visible: true
                    }, // 3
                    {
                        data: "tgl_order",
                        name: "tgl_order", render: function (d) {
                            return moment(d).format("DD-MM-YYYY");
                        },
                    }, // 3
                    {
                        data: "nama",
                        name: "nama",
                        visible: true
                    }, // 4
                    {
                        data: "no_tlp",
                        name: "no_tlp",
                        visible: true
                    }, // 4
                    {
                        data: "email",
                        name: "email",
                        visible: true
                    }, // 4
                    {
                        data: "status_order",
                        name: "status_order",
                        visible: true
                    }, // 4
                    {
                        data: "action",
                        name: "action",
                        visible: true
                    }, // 5
                    {
                        data: "f_status",
                        name: "f_status",
                        visible: false
                    }, // 5
                ],
                //      aligment left, right, center row dan coloumn
                order: [
                    ["0", "desc"]
                ],
                columnDefs: [{
                        className: "text-center",
                        targets: [0, 1, 2, 3, 4, 5]
                    },
                    {
                        width: "20%",
                        targets: 5
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_hdr").css("cursor", "pointer");
        }

        function list_data_dtl(no_order) {
            $("#tbl_list_dtl").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.order.listdtl')}}",
                    type: "GET",
                    data: {no_order:no_order},
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
                        data: "no_order",
                        name: "no_order",
                        visible: true
                    }, // 3
                    {
                        data: "tgl_order",
                        name: "tgl_order", render: function (d) {
                            return moment(d).format("DD-MM-YYYY");
                        },
                    }, // 3
                    {
                        data: "id_product",
                        name: "id_product",
                        visible: false
                    }, // 4
                    {
                        data: "product_name",
                        name: "product_name",
                        visible: true
                    }, // 4
                    {
                        data: "harga",
                        name: "harga", render: function (d) {
                            return currencyFormat(d);
                        },
                    }, // 3
                    {
                        data: "status_order",
                        name: "status_order",
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
                        targets: [0, 1, 2, 3, 4, 5]
                    },
                    {
                        width: "20%",
                        targets: 5
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_dtl").css("cursor", "pointer");
        }

        function list_data_barang() {
            $("#datatable_list_barang").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.order.list.barang')}}",
                    type: "GET",
                },
                columns: [
                    { data: "id", name: "id", visible: false }, // 0
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false }, // 1
                    // { data: "kode", name: "kode", visible: true }, // 2
                    { data: "nama", name: "nama", visible: true }, // 3
                    { data: "harga", name: "harga", render: function (d) {
                            return currencyFormat(d);
                        },
                    }, // 3
                    { data: "keterangan", name: "keterangan", visible: true }, // 4                
                ],
                //      aligment left, right, center row dan coloumn
                order: [["0", "desc"]],
                columnDefs: [
                    { className: "text-center", targets: [0, 1, 2, 3] },                
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#datatable_list_barang").css("cursor", "pointer");
        }

        function proses_po(no_order,f_status) {
            $.ajax({
                type: "post",
                url: "{{route('api.order.proses')}}",
                data: {no_order:no_order, f_status:f_status},
                success: function(response) {
                    for (var key in response) {
                        var flag = response["success"];
                        var message = response["message"];
                    }

                    if ($.trim(flag) == "true") {
                        var oTableHdr = $("#tbl_list_hdr").dataTable();
                        oTableHdr.fnDraw(false);

                        swal('Success!', message, {
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });

                        form_state('LOAD');
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

        form_state('LOAD');
        list_data();

        $('body').on('click', '#tindak_lanjut', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            form_state('EDIT_HDR');

            id = data['id'];
            no_order = data['no_order'];
            tgl_order = data['tgl_order'];
            nama = data['nama'];
            no_tlp = data['no_tlp'];
            email = data['email'];
            f_status = data['f_status'];

            if(f_status>1){
                $('#tambah_data').attr("hidden",true);
            }
            // $('#sysid').val(id);
            $('.text_title').html('Order No : '+no_order);
            $('#txt_nama').html(nama);
            $('#txt_tgl').html(tgl_order);
            $('#txt_nohp').html(no_tlp);
            $('#no_order').val(no_order);
            $('#f_status').val(f_status);

            $('#no_order_s').val(no_order);
            $('#id_order_s').val(id);

            $('#tgl_order_input').val(tgl_order);
            $('#no_order_input').val(no_order);
            list_data_dtl(no_order);
        });

        $('#save_button').click(function() {
            proses_po($('#no_order').val(),$('#f_status').val());
        });

        $('#back_button').click(function() {
            $('#list_data').show('slow');
            $('#lanjut').hide('slow');
        });

        // ADD DETAIL BARANG
        $('#tambah_data').click(function() {
            $('#barang_id').val(0);
            $('#barang').val('');
            $('#lanjut').hide('slow');
            $('#add_data').show('slow');
        });

        $('#back,#batal').click(function() {
            $('#list_data').hide('slow');
            $('#lanjut').show('slow');
            $('#add_data').hide('slow');
        });

        $('#browse_barang').click(function(event) {
            list_data_barang();
            $('#modal_browse_barang').modal();
            $('#modal_browse_barang').appendTo("body"); //Agar posisi modal paling awal
        });

        $("#datatable_list_barang tbody").on("click", "tr", function () {
            var table = $("#datatable_list_barang").DataTable();
            var data = table.row(this).data();
            var row = $(this).closest("tr");

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }        
        });

        $('.btn_select_barang').click(function(event) {
            var table = $("#datatable_list_barang").DataTable();
            var idx = table.cell(".selected", 0).index();
            var data = table.row(idx.row).data();

            var id_barang = data["id"];
            var nama_barang = data["nama"];
            $('#barang_id').val(id_barang);
            $('#barang').val(nama_barang);
        });

        $('#simpan').click(function(event) {
            $.ajax({
                type: "post",
                url: "{{route('api.order.store')}}",
                data: $("#form_input").serialize(),
                success: function(response) {
                    for (var key in response) {
                        var flag = response["success"];
                        var message = response["message"];
                    }

                    if ($.trim(flag) == "true") {
                        var oTableHdr = $("#tbl_list_dtl").dataTable();
                        oTableHdr.fnDraw(false);

                        swal('Success!', message, {
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });

                        $('#lanjut').show('slow');
                        $('#add_data').hide('slow');
                        // form_state('LOAD');
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
        });

        $('body').on('click', '#delete_data_hdr', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            no_order = data['no_order'];
            swal({
                title: 'Yakin Menghapus Data Ini ?',
                text: "Jika Dihapus Data Akan Hilang Pada Table Ini",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Hapus!',
                        className: 'btn btn-danger'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-dark'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "post",
                        url: "{{route('api.order.destroyhdr')}}",
                        data: {
                            no_order: no_order
                        },
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                            }

                            if ($.trim(flag) == "true") {
                                swal({
                                    title: 'Berhasil Menghapus Data',
                                    type: 'success',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-info'
                                        }
                                    }
                                });
                                var oTableHdr = $("#tbl_list_hdr").dataTable();
                                oTableHdr.fnDraw(false);
                            } else {
                                swal('Error!', 'Kesalahan proses', {
                                    icon: 'warning',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-warning'
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
                } else {
                    swal.close();
                }
            });
        });

        $('body').on('click', '#delete_data_dtl', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_dtl').DataTable().row($row).data();

            id = data['id'];
            swal({
                title: 'Yakin Menghapus Data Ini ?',
                text: "Jika Dihapus Data Akan Hilang Pada Table Ini",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Hapus!',
                        className: 'btn btn-danger'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-dark'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "post",
                        url: "{{route('api.order.destroydtl')}}",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                            }

                            if ($.trim(flag) == "true") {
                                swal({
                                    title: 'Berhasil Menghapus Data',
                                    type: 'success',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-info'
                                        }
                                    }
                                });
                                var oTableHdr = $("#tbl_list_dtl").dataTable();
                                oTableHdr.fnDraw(false);
                            } else {
                                swal('Error!', 'Kesalahan proses', {
                                    icon: 'warning',
                                    buttons: {
                                        confirm: {
                                            className: 'btn btn-warning'
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
                } else {
                    swal.close();
                }
            });
        });

        $('#schedule_button').click(function(event) {
            var date = new Date();
            var currentDate = date.toISOString().substring(0,10);
            document.getElementById('tgl_dari').value = currentDate;
            document.getElementById('tgl_sampai').value = currentDate;
            // no_order = $('#no_order').val();
            
            // $('#no_order_s').val(no_order);
            $('#tempat').val('');
            // $('#id_order').val(0);
            $('#keterangan').val('');

            $('#lanjut').hide('slow');
            $('#add_data_schedule').show('slow');
        });

        $('#back_schedule,#batal_schedule').click(function(event) {
            $('#lanjut').show('slow');
            $('#add_data_schedule').hide('slow');
        });

        $('#save').click(function(event) {
            $.ajax({
                type: "post",
                url: "{{route('api.schedule.store')}}",
                data: $("#form_input_schedule").serialize(),
                success: function(response) {
                    for (var key in response) {
                        var flag = response["success"];
                        var message = response["message"];
                    }

                    if ($.trim(flag) == "true") {
                        
                        list_data();
                        swal('Success!', message, {
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });

                        $('#lanjut').show('slow');
                        $('#add_data_schedule').hide('slow');
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
        });

    });
</script>