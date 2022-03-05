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
                    <h3 class="text-center mt-3 mb-3">Master Paket</h3>
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <button id="tambah_data" class="btn btn-primary"><i class="fas fa-plus"></i> Add Data</button>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_list_hdr" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <th style="color: white;">Id</th>
                                                <th style="color: white;">No</th>
                                                <th style="color: white;">Nama</th>
                                                <th style="color: white;">Id Kategori</th>
                                                <th style="color: white;">Kategori</th>
                                                <th style="color: white;">File Gambar</th>
                                                <th style="color: white;">Keterangan</th>
                                                <th style="color: white;">Harga</th>
                                                <th style="color: white;">Action</th>
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

        <div id="add_data" class="page-inner mt--5" style="display: none;">
            <div class="row mt--2">
                <div class="col-md-12">
                    <div id="" class="card full-height">
                        <div class="card-body">
                            <ul class="nav customtab2 nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab_header" role="tab" id="nav_header"><span><i class="ti-layers"></i></span> Header</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab_detail" role="tab" id="nav_detail"><span><i class="ti-menu-alt"></i></span> Detail</a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane" id="tab_header" role="tabpanel">
                                    <div class="col-md-12 text-left">
                                        <div class="form-group">
                                            <a id="back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
                                        </div>
                                    </div>
                                    <form class="row" id="form_input" action="{{route('api.paket.store')}}" method="post" enctype="multipart/form-data">
                                        
                                        <input type="hidden" name="state" id="state">
                                        <input type="hidden" id="sysid" name="sysid">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Data Paket</h2>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama Paket<span style="color: red;">*</span></label>
                                                <input id="nama" name="nama" class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="kategori">Kategori <span style="color: red;">*</span></label>
                                                <select id="kategori" name="kategori" class="form-control" >
                                                    <option value=0>Pilih Kategori</option>
                                                    <option value=1>Paket Lite</option>
                                                    <option value=2>Paket Medium</option>
                                                    <option value=3>Paket Stepa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="harga">Harga <span style="color: red;">*</span></label>
                                                <input id="harga" name="harga" class="form-control" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="keterangan">Keterangan <span style="color: red;">*</span></label>
                                                <textarea id="keterangan" name="keterangan" class="form-control" type="text" cols="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="input-file-now">Upload Gambar </label>
                                                <div class="input-group control-group increment">
                                                    <input type="file" name="filename[]" class="form-control">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-tambah btn-success" type="button"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="clone hide">
                                                    <div class="control-group input-group" style="margin-top:10px">
                                                        <input type="file" name="filename[]" class="form-control">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-kurang btn-danger" type="button"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <div class="form-group">
                                                <button style="color:white" type="submit" class="btn btn-info waves-effect waves-dark btn-upload" data-toggle="tooltip" title="Save">
                                                    <span class="btn-label">
                                                        <i class="fas fa-save"></i>
                                                    </span> Simpan
                                                </button>
                                                <a id="batal" name="batal" style="color:white" class="btn btn-danger "><i class="fa fa-times-circle"></i> &nbsp; Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="tab_detail" role="tabpanel">
                                    <!-- <div class="col-md-12 text-left">
                                        <div class="form-group">
                                            <a id="back_dtl" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
                                        </div>
                                    </div> -->
                                    <form id="form_input_dtl">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h2 class="alert-info font-weight-bold text-center" id="title_input_dtl">Tambah Detail Product</h2>
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
                                                <a id="simpan_dtl" style="color:white" class="btn btn-info "><i class="fa fa-save"></i> &nbsp; Simpan</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="tbl_list_dtl" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                                    <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                                        <tr>
                                                            <th style="color: white;">Id</th>
                                                            <th style="color: white;">No</th>
                                                            <th style="color: white;">Nama</th>
                                                            <th style="color: white;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <div class="form-group">
                                                <a id="selesai" style="color:white" class="btn btn-info "><i class="fa fa-check"></i> &nbsp; Selesai</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
<script src="{{ asset('js/jquery.form.js') }}"></script>

<script>
    $("#drop-dashboard").removeClass('active');
    $("#drop-master").addClass("active");

    $(".btn-tambah").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
    });

    $("body").on("click", ".btn-kurang", function() {
        $(this).parents(".control-group").remove();
    });

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
                    $('#add_data').hide();
                    $('#list_data').show();
                    $('#nav_header').removeClass('active');
                    $('#tab_header').removeClass('active');
                    $('#nav_header').hide();
                    $('#nav_detail').removeClass('active');
                    $('#tab_detail').removeClass('active');
                    $('#nav_detail').hide();
                    break;
                case 'ADD_HDR':
                    reset_input();
                    // list_data_kategori('', 'ADD');
                    $("#state").val("ADD");
                    $('#title_input').html('Tambah Data Paket');
                    $('#title_input_dtl').html('Tambah Detail Produk');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    $("#nav_header").addClass("active");
                    $("#tab_header").addClass("active");
                    $("#nav_header").show();
                    $("#nav_detail").removeClass("active");
                    $("#tab_detail").removeClass("active");
                    $("#nav_detail").hide();
                    break;
                case 'SAVE_HDR':
                    $("#state").val("EDIT");
                    $("#state_hdr").val("EDIT_HDR");
                    $("#state_dtl").val("ADD_DTL");
                    $('#list_data').hide();
                    $('#nav_header').removeClass('active');
                    $('#tab_header').removeClass('active');
                    $('#nav_header').show();
                    $('#nav_detail').addClass('active');
                    $('#tab_detail').addClass('active');
                    $('#nav_detail').show();
                    break;
                case 'EDIT_HDR':
                    $("#state").val("EDIT");
                    $('#title_input').html('Edit Data Paket');
                    $('#title_input_dtl').html('Edit Detail Produk');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    $('#nav_header').addClass('active');
                    $('#tab_header').addClass('active');
                    $('#nav_header').show();
                    $('#nav_detail').removeClass('active');
                    $('#tab_detail').removeClass('active');
                    $('#nav_detail').show();
                    break;
                case 'REVISI_HDR':
                    break;
            }
        }

        function reset_input() {
            $('#sysid').val('');
            $('#nama').val('');
            $('#keterangan').val('');
            $('#harga').val(0);
        }

        function list_data() {
            $("#tbl_list_hdr").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.paket.list')}}",
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
                    {
                        data: "nama",
                        name: "nama",
                        visible: true
                    }, 
                    {
                        data: "id_kategori",
                        name: "id_kategori",
                        visible: false
                    }, // 4
                    {
                        data: "nama_kategori",
                        name: "nama_kategori",
                        visible: true
                    },                       
                    {
                        data: "file_name",
                        name: "file_name",
                        visible: true
                    }, // 8
                    {
                        data: "keterangan",
                        name: "keterangan",
                        visible: true
                    }, // 9
                    {
                        data: "harga",
                        name: "harga", render: function (d) {
                            return currencyFormat(d);
                        },
                    }, // 9
                    {
                        data: "action",
                        name: "action",
                        visible: true
                    }, // 10
                ],
                //      aligment left, right, center row dan coloumn
                order: [
                    ["0", "desc"]
                ],
                columnDefs: [{
                        className: "text-center",
                        targets: [0, 1, 2, 3, 4]
                    },
                    {
                        width: "20%",
                        targets: 4
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_hdr").css("cursor", "pointer");
        }

        function list_data_dtl(id_hdr) {
            $("#tbl_list_dtl").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.paket.list.dtl')}}",
                    type: "GET",
                    data: {id_hdr:id_hdr},
                },
                columns: [
                    { data: "id", name: "id", visible: false }, // 0
                    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false }, // 1
                    // { data: "kode", name: "kode", visible: true }, // 2
                    { data: "nama", name: "nama", visible: true }, // 3              
                    { data: "action", name: "action", visible: true }, // 4
                ],
                //      aligment left, right, center row dan coloumn
                order: [["0", "desc"]],
                columnDefs: [
                    { className: "text-center", targets: [0, 1, 2, 3] },                
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_dtl").css("cursor", "pointer");
        }

        function list_data_kategori(id_kategori, state) {
            $.ajax({
                url: "{{route('api.product.list.kategori')}}",
                type: 'GET',
                success: function(response) {
                    // $("#breeds").attr('disabled', false);
                    if (state == 'ADD') {
                        $('#kategori').empty();
                        $("#kategori").append('<option value=0>Pilih Kategori</option>');
                        $.each(response, function(key, value) {
                            $("#kategori").append('<option value=' + value.id + '>' + value.nama + '</option>');
                        });
                        if (id_kategori != '') {
                            $('#kategori').val(id_kategori);
                        }
                    } else {
                        $('#e_kategori').empty();
                        $("#e_kategori").append('<option value=0>Pilih Kategori</option>');
                        $.each(response, function(key, value) {
                            $("#e_kategori").append('<option value=' + value.id + '>' + value.nama + '</option>');
                        });
                        if (id_kategori != '') {
                            $('#e_kategori').val(id_kategori);
                        }
                    }

                }
            });
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

        function save_data(state) {
            // var kode_kategori = document.getElementById("kode").value;
            var nama = document.getElementById("nama").value;
            if (nama == "") {
                swal("Peringatan!", "Data tidak boleh kosong!", {
                    icon: "info",
                    buttons: {
                        confirm: {
                            className: 'btn btn-info'
                        }
                    },
                });
            } else {
                if (state == 'ADD') {
                    url_save = "{{route('api.paket.store')}}";
                } else {
                    url_save = "{{route('api.paket.update')}}";
                }

                $.ajax({
                    type: "post",
                    url: url_save,
                    data: $("#form_input").serialize(),
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
        }

        form_state('LOAD');
        list_data();

        $('#tambah_data').click(function() {
            form_state('ADD_HDR');
        });

        $('#back').click(function() {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $('#batal').click(function() {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $("body").on("click", ".btn-upload", function(e) {
            $(this).parents("form").ajaxForm(options);
        });

        var options = {
            complete: function(response) {
                if ($.isEmptyObject(response.responseJSON.error)) {
                    form_state('SAVE_HDR');
                    id = response.responseJSON.id_hdr;
                    // alert(id);
                    $('#sysid').val(id);
                    $('#barang').val('');
                    $('#barang_id').val('');
                    list_data_dtl(id);
                    $('#form_input').attr('action', "{{route('api.paket.update')}}");
                    swal({
                        type: "success",
                        title: "Success!",
                        text: "Successfully Saved.",
                        timer: 4000,
                        showConfirmButton: true
                    });
                    // reset_input_dtl_attach();
                } else {
                    // printErrorMsg(response.responseJSON.error);
                    swal({
                        type: "warning",
                        title: "Warning!",
                        text: "Please select file attachment first.",
                        timer: 4000,
                        showConfirmButton: true
                    });
                }
            }
        };

        $('#save').click(function(event) {
            state = $('#state').val();
            save_data(state);
        });

        $('body').on('click', '#edit_data_hdr', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            form_state('EDIT_HDR');
            $('#form_input').attr('action', "{{route('api.paket.update')}}");

            id = data['id'];
            nama = data['nama'];
            keterangan = data['keterangan'];
            id_kategori = data['id_kategori'];
            harga = data['harga'];

            $('#sysid').val(id);
            $('#nama').val(nama);
            $('#keterangan').val(keterangan);
            $('#kategori').val(id_kategori).change();
            // list_data_kategori(id_kategori, 'ADD');
            $('#harga').val(harga);

            list_data_dtl(id);
        });

        $('body').on('click', '#delete_data_hdr', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

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
                        url: "{{route('api.paket.destroy')}}",
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

        $('#simpan_dtl').click(function(event) {
            id_hdr = $('#sysid').val();
            $.ajax({
                type: "post",
                url: "{{route('api.paket.store.dtl')}}",
                data: $("#form_input_dtl").serialize() + "&id_hdr=" + id_hdr,
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

                        // form_state('LOAD');
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
                        url: "{{route('api.paket.destroy.dtl')}}",
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

        $('#selesai').click(function(event) {
            swal({
                title: 'Paket berhasil disimpan',
                type: 'success',
                buttons: {
                    confirm: {
                        className: 'btn btn-info'
                    }
                }
            });
            form_state('LOAD');
            list_data();
        });
    });
</script>