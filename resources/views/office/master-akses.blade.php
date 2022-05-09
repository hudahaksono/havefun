@section('title', 'Master Akses')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Master Akses</h3>
                    <div class="container mb-5">
                        <div class="row">
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        list_data();

        function list_data() {
            $("#tbl_user").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('master-akses.list-data')}}",
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
            $("#tbl_user").css("cursor", "pointer");
        }

        $('body').on('click', '#accept', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_user').DataTable().row($row).data();

            id = data['id'];

            swal({
                title: 'Yakin Mengkonfirmasi Pengguna Ini ?',
                text: "Data Tidak Dapat Dikembalikan Seperti Semula",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Konfirmasi!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "post",
                        url: "/master-akses/accept/" + id,
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                            }

                            if ($.trim(flag) == "true") {
                                swal({
                                    title: "Berhasil Menambahkan User Tersebut",
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

        $('body').on('click', '#reject', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_user').DataTable().row($row).data();

            id = data['id'];

            swal({
                title: 'Yakin Mereject Pengguna Ini ?',
                text: "Data Tidak Dapat Dikembalikan Seperti Semula",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, Konfirmasi!',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        text: 'Batal',
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $.ajax({
                        type: "post",
                        url: "/master-akses/reject/" + id,
                        success: function(response) {
                            for (var key in response) {
                                var flag = response["success"];
                            }

                            if ($.trim(flag) == "true") {
                                swal({
                                    title: "Berhasil Mereject User Tersebut",
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