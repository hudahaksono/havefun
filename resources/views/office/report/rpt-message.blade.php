@section('title', 'Report Message')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <h3 class="text-center mt-3 mb-3">Message Report</h3>
                    <div class="container mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_message" class="table table-striped table-hover dataTable no-footer" style="width:100%">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <td>Id</td>
                                                <td>No</td>
                                                <td>Nama</td>
                                                <td>Email</td>
                                                <td>No Handphone</td>
                                                <td>Tanggal</td>
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
                            <h3 class="text-center mb-3 text_title">Detail Pesan</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="card-body">
                                <form id="form_input">
                                    {{ csrf_field() }}
                                    <input type="text" class="form-control" id="sysid" name="sysid" hidden="">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="nama" class="form-control" id="nama" name="nama" placeholder="Nama" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="email" name="email" placeholder="Name" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_tlp" class="col-sm-3 col-form-label">No Handphone</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="no_tlp" name="no_tlp" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal Acara</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="tanggal" name="tanggal" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pesan" class="col-sm-3 col-form-label">Pesan</label>
                                        <div class="col-sm-9">
                                            <textarea row="15" class="form-control" id="pesan" name="pesan" readonly></textarea>
                                        </div>
                                    </div>
                                </form>
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
    $("#drop-message").addClass('active');

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        // $('#tbl_message').DataTable();
        list_data();

        function list_data() {
            $("#tbl_message").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('rpt-message.list-data')}}",
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
                        data: "email",
                        name: "email",
                        visible: true
                    }, // 3
                    {
                        data: "no_tlp",
                        name: "no_tlp",
                        visible: true
                    }, // 4
                    {
                        data: "tanggal",
                        name: "tanggal",
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
            $("#tbl_message").css("cursor", "pointer");
        }

        $('#back_button').click(function(event) {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $('body').on('click', '#detail', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_message').DataTable().row($row).data();

            // var table = $('#tbl_message').DataTable();
            // var data = table.row(this).data();
            var id = $(this).data('id');

            id_edit = id;
            nama = data['nama'];
            email = data['email'];
            no_tlp = data['no_tlp'];
            tanggal = data['tanggal'];
            pesan = data['pesan'];

            $('#email').val(email);
            $('#name').val(nama);
            $('#no_tlp').val(no_tlp);
            $('#tanggal').val(tanggal);
            $('#pesan').val(pesan);
            $('#sysid').val(id_edit);
            $('#list_data').hide('slow');
            $('#add_data').show('slow');
        });
    });
</script>