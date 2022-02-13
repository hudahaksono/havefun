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
                            <div class="col-md-12 mb-3">
                                <button id="add_button" class="btn btn-primary"><i class="fas fa-plus"></i> Add Data</button>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_user" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                        <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                            <tr>
                                                <td>Id</td>
                                                <td>No Order</td>
                                                <td>Tanggal Order</td>
                                                <td>Id User</td>
                                                <td>Nama User</td>
                                                <td>Id Product</td>
                                                <td>Nama Product</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>123-NP-123</td>
                                                <td>12-03-2022</td>
                                                <td>2</td>
                                                <td>Ludiono</td>
                                                <td>3</td>
                                                <td>Lite Uhuy</td>
                                                <td><span class="badge badge-success">New Order</span></td>
                                                <td><a style="color:white" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Tindak Lanjut</a><a style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>123-NP-123</td>
                                                <td>12-03-2022</td>
                                                <td>2</td>
                                                <td>Ludiono</td>
                                                <td>3</td>
                                                <td>Lite Uhuy</td>
                                                <td><span class="badge badge-warning">Menunggu Pembayaran</span></td>
                                                <td><a style="color:white" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Tindak Lanjut</a><a style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>123-NP-123</td>
                                                <td>12-03-2022</td>
                                                <td>2</td>
                                                <td>Ludiono</td>
                                                <td>3</td>
                                                <td>Lite Uhuy</td>
                                                <td><span class="badge badge-primary">Tindak Lanjut</span></td>
                                                <td><a style="color:white" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Tindak Lanjut</a><a style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
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
        <div id="lanjut" class="row justify-content-center">
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
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table style="width:100%" border="1">
                                            <tr>
                                                <td style="width: 15%;">Nama</td>
                                                <td style="width: 15%;"></td>
                                                <td style="width: 40%;"></td>
                                                <td style="width: 10%;">Tanggal Order</td>
                                                <td style="width: 20%;"></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 15%;">No HP</td>
                                                <td style="width: 15%;"></td>
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
                    <div class="col-md-12 text-right">
                        <div class="card-body">
                            <div class="form-group">
                                <input class="form-input" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body">
                            <table id="tbl_user" class="table table-striped table-hover dataTable no-footer" style="width:100%" role="grid">
                                <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                    <tr>
                                        <td>Id</td>
                                        <td>No Order</td>
                                        <td>Tanggal Order</td>
                                        <td>Id User</td>
                                        <td>Nama User</td>
                                        <td>Id Product</td>
                                        <td>Nama Product</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>123-NP-123</td>
                                        <td>12-03-2022</td>
                                        <td>2</td>
                                        <td>Ludiono</td>
                                        <td>3</td>
                                        <td>Lite Uhuy</td>
                                        <td><span class="badge badge-success">New Order</span></td>
                                        <td><a style="color:white" class="btn btn-primary"><i class="fa fa-location-arrow"></i> Tindak Lanjut</a><a style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
                                    </tr>
                                </tbody>
                            </table>
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
    </section>
</div>
@include('office.layouts.footer')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- <script src="{{ asset('calendar/main.js') }}"></script> -->
<script>

</script>