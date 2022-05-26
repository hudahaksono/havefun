@section('title', 'Master Paket')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Master Banner</h3>
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
                                                <th style="color: white;">File Gambar</th>
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
                            <form class="row" id="form_input" action="{{route('api.banner.store')}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="state" id="state">
                                <input type="hidden" id="sysid" name="sysid">
                                <input type="hidden" id="sess_nama" name="sess_nama" value="{{Session('sess_nama')}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Data Banner</h2>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama Banner<span style="color: red;">*</span></label>
                                        <input id="nama" name="nama" class="form-control" type="text" />
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
                                        <!-- <div class="clone hide">
                                            <div class="control-group input-group" style="margin-top:10px">
                                                <input type="file" name="filename[]" class="form-control">
                                                <div class="input-group-append">
                                                    <button class="btn btn-kurang btn-danger" type="button"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                        </div> -->
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
    $("#drop-banner").addClass('active');
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

    // $(".btn-tambah").click(function() {
    //     var html = $(".clone").html();
    //     $(".increment").after(html);
    // });

    // $("body").on("click", ".btn-kurang", function() {
    //     $(this).parents(".control-group").remove();
    // });

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
                    url: "{{route('api.banner.list')}}",
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
                    }, // 2                  
                    {
                        data: "file_name",
                        name: "file_name",
                        visible: true
                    }, // 3
                    {
                        data: "keterangan",
                        name: "keterangan",
                        visible: true
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
                        targets: 4
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_list_hdr").css("cursor", "pointer");
        }

        list_data();
        $('#tambah_data').click(function() {
            $('#sysid').val('');
            $('#nama').val('');
            $('#keterangan').val('');

            $('#title_input').html('Tambah Data Banner');
            $('#add_data').show('slow');
            $('#list_data').hide('slow');
        });

        $('#batal').click(function() {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $("#tbl_list_hdr tbody").on("click", "td:nth-child(3)", function() {
            var $row = $(this).closest("tr");
            var data = $("#tbl_list_hdr").DataTable().row($row).data();
            file_name = data["file_name"];
            // alert(file_name);
            window.open("/master-banner/view_file/" + file_name, "_blank");
        });

        $("body").on("click", ".btn-upload", function(e) {
            $(this).parents("form").ajaxForm(options);
        });

        var options = {
            complete: function(response) {
                if ($.isEmptyObject(response.responseJSON.error)) {
                    swal({
                        type: "success",
                        title: "Success!",
                        text: "Successfully Saved.",
                        timer: 4000,
                        showConfirmButton: true
                    });
                    window.location = "{{route('master-banner')}}";
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

        $('body').on('click', '#edit_data_hdr', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            $('#form_input').attr('action', "{{route('api.banner.update')}}");

            id = data['id'];
            nama = data['nama'];
            keterangan = data['keterangan'];

            $('#sysid').val(id);
            $('#nama').val(nama);
            $('#keterangan').val(keterangan);

            $('#title_input').html('Ubah Data Banner');
            $('#add_data').show('slow');
            $('#list_data').hide('slow');
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
                        url: "{{route('api.banner.destroy')}}",
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