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
                    <h3 class="text-center mt-3 mb-3">Payment Order</h3>
                    <div class="container mb-5">
                        <div class="row">
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
                                                <td>Tagihan</td>
                                                <td>Diskon</td>
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

        <div id="modal_input_payment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-weight:bold;color:#407290;text-shadow: 1px grey;" class="modal-title">Input Actual Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id="no_order">
                                    <input type="hidden" id="id_payment" name="id_payment">
                                    <label for="harga">No. Payment <span style="color: red;">*</span></label>
                                    <input id="no_payment" name="no_payment" class="form-control" type="text" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Tgl. Payment <span style="color: red;">*</span></label>
                                    <input id="tgl_payment" name="tgl_payment" class="form-control" type="text" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Total Payment <span style="color: red;">*</span></label>
                                    <input id="total_payment" name="total_payment" class="form-control" type="text" readonly="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="harga">Input Payment <span style="color: red;">*</span></label>
                                    <input id="actual_payment" name="actual_payment" class="form-control" type="text">
                                    <input type="hidden" class="os_payment">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 id="os_payment">Outstanding Payment:</h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn_save" data-dismiss="modal">
                            <span class="btn-label"><i class="ti-save"></i></span> Save
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

        function list_data() {
            $("#tbl_list_hdr").DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('api.payment.list')}}",
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
                        name: "tgl_payment", render: function (d) {
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
                        name: "total_payment", render: function (d) {
                            return currencyFormat(d);
                        },
                        visible: true
                    }, // 4
                    {
                        data: "total_diskon",
                        name: "total_diskon", render: function (d) {
                            return currencyFormat(d);
                        },
                        visible: true
                    }, // 4
                    {
                        data: "total_tagihan",
                        name: "total_tagihan", render: function (d) {
                            return currencyFormat(d);
                        },
                        visible: true
                    }, // 4
                    {
                        data: "actual_payment",
                        name: "actual_payment", render: function (d) {
                            return currencyFormat(d);
                        },
                        visible: true
                    }, // 4
                    {
                        data: "os_payment",
                        name: "os_payment", render: function (d) {
                            return currencyFormat(d);
                        },
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

        $('body').on('click', '#tindak_lanjut', function(e) {
            var $row = $(this).closest("tr");
            var data = $('#tbl_list_hdr').DataTable().row($row).data();

            id = data['id'];
            no_order = data['no_order'];
            no_payment = data['no_payment'];
            tgl_payment = data['tgl_payment'];
            total_payment = data['total_payment'];
            total_tagihan = data['total_tagihan'];
            actual_payment = data['actual_payment'];
            os_payment = amountToFloat(total_tagihan) - amountToFloat(actual_payment);

            $('#id_payment').val(id);
            $('#no_order').val(no_order);
            $('#no_payment').val(no_payment);
            $('#tgl_payment').val(moment(tgl_payment).format("DD-MM-YYYY"));
            $('#total_payment').val(currencyFormat(total_tagihan));
            $('#actual_payment').val(0);
            $('.os_payment').val(os_payment);
            $('#os_payment').html('Outstanding Payment : '+currencyFormat(os_payment));

            $('#modal_input_payment').modal();
            $('#modal_input_payment').appendTo("body");
        });

        $('body').on('change', '#actual_payment', function(e) {
            os_payment = $('.os_payment').val();
            payment = $(this).val();
            total_os = parseFloat(os_payment) - parseFloat(payment);
            $('#os_payment').html('Outstanding Payment : '+currencyFormat(total_os));
        });

        $('.btn_save').click(function(event) {
            id_payment = $('#id_payment').val();
            actual_payment = parseFloat($('#actual_payment').val());
            os_payment = parseFloat($('.os_payment').val());
            no_order = $('#no_order').val();
            
            if(actual_payment > os_payment){
                swal('Peringatan!', 'Input payment lebih besar dari outstanding payment', {
                            icon: 'info',
                            buttons: {
                                confirm: {
                                    className: 'btn btn-info'
                                }
                            }
                        });
                return false;
            }
            $.ajax({
                type: "post",
                url: "{{route('api.payment.store')}}",
                data: {id_payment:id_payment, actual_payment:actual_payment,no_order:no_order},
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

                        // $('#lanjut').show('slow');
                        // $('#add_data').hide('slow');
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

        });
    });
</script>