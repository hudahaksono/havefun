@section('title', 'Master User')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Master Users</h3>
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <button id="add_button" class="btn btn-primary"><i class="fas fa-plus"></i> Add Data</button>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_user" class="table table-striped table-hover dataTable no-footer" style="width:100%">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <td>Id</td>
                                                <td>No</td>
                                                <td>Email</td>
                                                <td>Name</td>
                                                <td>No Handphone</td>
                                                <td>Jabatan</td>
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
        <div id="add_data" class="row justify-content-center" style="display: none;">
            <div class="col-md-9">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <button id="back_button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back To Data</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="text-center mb-3 text_title">Add Data Users</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <form id="form_input">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" id="sysid" name="sysid" hidden="">
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="name" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_tlp" class="col-sm-3 col-form-label">No Handphone</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="no_tlp" name="no_tlp" placeholder="Nomor Handphone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                        <div class="col-sm-9">
                                            <select id="jabatan" name="jabatan" class="form-control">
                                                <option value="0">
                                                    <== Choice jabatan==>
                                                </option>
                                                <option value="4">Administrator Website</option>
                                                <option value="3">Users Admin</option>
                                                <option value="1">Customer</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="card-body">
                                <button id="save_button" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                                &nbsp; <button id="reset_button" class="btn btn-warning"><i class="fas fa-window-restore"></i> Reset Input</button>
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
    $("#drop-dashboard").removeClass('active');
    $("#drop-banner").removeClass('active');
    $("#drop-master").addClass("active");

    $("#btn-master-user").addClass("font-weight-bold");
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
        // $('#tbl_user').DataTable();
        list_data();

        function list_data() {
            $("#tbl_user").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('master-user.list-data')}}",
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
                        data: "email",
                        name: "email",
                        visible: true
                    }, // 2
                    {
                        data: "nama",
                        name: "nama",
                        visible: true
                    }, // 3
                    {
                        data: "no_tlp",
                        name: "no_tlp",
                        visible: true
                    }, // 4
                    {
                        data: "jabatan",
                        name: "jabatan",
                        visible: true
                    }, // 5
                    {
                        data: "action",
                        name: "action",
                        visible: true
                    }, // 6
                ],
                //      aligment left, right, center row dan coloumn
                order: [
                    ["0", "desc"]
                ],
                columnDefs: [{
                        className: "text-center",
                        targets: [0, 1, 2, 3, 4, 5, 6]
                    },
                    {
                        width: "20%",
                        targets: 5
                    },
                ],
                bAutoWidth: false,
                responsive: true,
            });
            $("#tbl_user").css("cursor", "pointer");
        }

        $('#add_button').click(function(event) {
            $('#email').val('');
            $('#name').val('');
            $('#no_tlp').val('');
            $('#jabatan').val(0);
            $('#sysid').val(0);
            $('#list_data').hide('slow');
            $('#add_data').show('slow');
        });

        $('#back_button').click(function(event) {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $('#save_button').click(function(event) {
            if ($('#sysid').val() == 0) {
                url_save = "{{route('master-user.store')}}";
            } else {
                url_save = "{{route('master-user.update')}}";
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
                        var oTableHdr = $("#tbl_user").dataTable();
                        oTableHdr.fnDraw(false);

                        swal('Success!', message, {
                            icon: 'success',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-success'
                                }
                            }
                        });

                        $('#list_data').show('slow');
                        $('#add_data').hide('slow');

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

        $('#reset_button').click(function(event) {
            $('#email').val('');
            $('#name').val('');
            $('#no_tlp').val('');
            $('#jabatan').val(0);
            $('#sysid').val(0);
        });

        $('body').on('click', '#edit', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_user').DataTable().row($row).data();

            // var table = $('#tbl_user').DataTable();
            // var data = table.row(this).data();
            var id = $(this).data('id');

            id_edit = id;
            nama = data['nama'];
            email = data['email'];
            no_tlp = data['no_tlp'];
            jabatan = data['jabatan'];

            $('#email').val(email);
            $('#name').val(nama);
            $('#no_tlp').val(no_tlp);
            $('#jabatan').val(jabatan);
            $('#sysid').val(id_edit);
            $('.text_title').html('Edit Data Users');
            $('#list_data').hide('slow');
            $('#add_data').show('slow');
        });

        $('body').on('click', '#delete', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_user').DataTable().row($row).data();

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
                        url: "/master-user/destroy/" + id,
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                            }

                            if ($.trim(flag) == "true") {
                                swal({
                                    title: "Berhasil Menghapus Data",
                                    text: "Klik Tombol OK",
                                    icon: "success",
                                    button: "OK",
                                });
                                var oTableHdr = $("#tbl_user").dataTable();
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