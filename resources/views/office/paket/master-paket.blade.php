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
                                                <th style="color: white;">Keterangan</th>
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
                            <form class="row" id="form_input">
                                <div class="col-md-12 text-left">
                                    <div class="form-group">
                                        <a id="back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
                                    </div>
                                </div>
                                <input type="hidden" name="state" id="state">
                                <input type="hidden" id="sysid" name="sysid">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Data Kategori Barang</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Paket <span style="color: red;">*</span></label>
                                        <input id="nama" name="nama" class="form-control" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan <span style="color: red;">*</span></label>
                                        <textarea id="keterangan" name="keterangan" class="form-control" type="text" cols="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <div class="form-group">
                                        <a id="save" name="save" style="color:white" class="btn btn-info "><i class="fas fa-save"></i> &nbsp; Simpan</a>
                                        <a id="batal" name="batal" style="color:white" class="btn btn-danger "><i class="fa fa-times-circle"></i> &nbsp; Batal</a>
                                    </div>
                                </div>
                            </form>
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
    $("#drop-dashboard").removeClass('active');
    $("#drop-master").addClass("active");

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        function form_state(state) {
            switch (state) {
                case 'LOAD':
                    $('#add_data').hide();
                    $('#list_data').show();
                    break;
                case 'ADD_HDR':
                    reset_input();
                    $("#state").val("ADD");
                    $('#title_input').html('Tambah Data Kategori Barang');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    break;
                case 'SAVE_HDR':
                    break;
                case 'EDIT_HDR':
                    $("#state").val("EDIT");
                    $('#title_input').html('Edit Data Kategori Barang');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    break;
                case 'REVISI_HDR':
                    break;
            }
        }

        function reset_input() {
            $('#sysid').val('');
            $('#nama').val('');
            $('#keterangan').val('');
        }

        function list_data() {
            $("#tbl_list_hdr").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.kategori.list')}}",
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
                        data: "nama",
                        name: "nama",
                        visible: true
                    }, // 2
                    {
                        data: "keterangan",
                        name: "keterangan",
                        visible: true
                    }, // 3
                    {
                        data: "action",
                        name: "action",
                        visible: true
                    }, // 4
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

        $('#save').click(function(event) {
            state = $('#state').val();
            save_data(state);
        });

        $('body').on('click', '#edit_data_hdr', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            form_state('EDIT_HDR');

            id = data['id'];
            nama_kategori_barang = data['nama'];
            keterangan_kategori_barang = data['keterangan'];

            $('#sysid').val(id);
            $('#nama').val(nama_kategori_barang);
            $('#keterangan').val(keterangan_kategori_barang);
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
                        url: "{{route('api.kategori.destroy')}}",
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
    });
</script>