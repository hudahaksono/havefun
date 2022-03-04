@section('title', 'Schedule Customer')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('calendar/main.css') }}" />
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div id="list_data" class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <!-- <h3 class="text-center mt-3 mb-3">Schedule Customers</h3> -->
                    <div class="container mb-5 mt-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a id="btn_add_data" style="color:white" class="btn btn-primary"><i class="fas fa-plus"></i> Add Schedule</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="add_data" class="row" style="display: none;">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <!-- <h3 class="text-center mt-3 mb-3">Schedule Customers</h3> -->
                    <div class="container mb-5 mt-5">
                        <form class="row" id="form_input">
                            <div class="col-md-12 text-left">
                                <div class="form-group">
                                    <a id="back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
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
                                    <div class="input-group">
                                        <input type="hidden" name="id_order" id="id_order">
                                        <input id="no_order" name="no_order" class="form-control" type="text" />
                                        <div class="input-group-append">
                                            <a href="javascript:void(0)" class="btn btn-success" id="browse_order" data-toggle="tooltip" title="Browse"><span class="fas fa-search"></span>
                                            </a>
                                        </div>
                                    </div>
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

        <div id="modal_browse_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-weight:bold;color:#407290;text-shadow: 1px grey;" class="modal-title">Browse Barang Produk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        <div class="table-responsive">
                            <table id="datatable_list_order" class="table text-nowrap table-bordered">
                                <thead style="color:white;font-weight:bold" class="bg-primary text-center">
                                    <tr>
                                        <th class="align-middle text-uppercase">ID</th>
                                        <th class="align-middle text-uppercase">No.</th>
                                        <th class="align-middle text-uppercase">No. Order</th>
                                        <th class="align-middle text-uppercase">Tgl. Order</th>
                                        <th class="align-middle text-uppercase">Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn_select_order" data-dismiss="modal">
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
<script src="{{ asset('calendar/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        

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
                    $('#title_input').html('Tambah Schedule');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    break;
                case 'EDIT_HDR':
                    $("#state").val("EDIT");
                    $('#title_input').html('Edit Schedule');
                    $('#add_data').show('slow');
                    $('#list_data').hide('slow');
                    break;
            }
        }

        function reset_input() {
            var date = new Date();
            var currentDate = date.toISOString().substring(0,10);
            document.getElementById('tgl_dari').value = currentDate;
            document.getElementById('tgl_sampai').value = currentDate;
            
            $('#no_order').val('');
            $('#tempat').val('');
            $('#id_order').val(0);
            // $('#tgl_sampai').val(moment().format('DD/MM/YYYY'));
            $('#keterangan').val('');
        }

        function list_data(){
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    // initialDate: '2020-09-12',
                    navLinks: true, // can click day/week names to navigate views
                    businessHours: true, // display business hours
                    editable: true,
                    selectable: true,
                    events: "{{route('api.schedule.list')}}"
                });

                calendar.render();
            });
        }

        function list_data_order() {
            $.ajax({
                type: "get",
                url: "{{route('api.schedule.listorder')}}",
                dataType:'JSON',
                success: function(response) {
                    // console.log(response.data);
                    $.each(response.data, function (key, value) {
                        console.log(value[0]);

                    });
                    // alert(response[2]);
                    // for (var key in response) {
                    //     // alert(response["draw"]);
                    //     // var flag = response["success"];
                    //     // var message = response["message"];
                    // }
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
            // $("#datatable_list_order").DataTable({
            //     destroy: true,
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: "{{route('api.schedule.listorder')}}",
            //         type: "GET",
            //     },
            //     columns: [
            //         { data: "id", name: "id", visible: false }, // 0
            //         { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false }, // 1
            //         // { data: "kode", name: "kode", visible: true }, // 2
            //         { data: "no_order", name: "no_order", visible: true }, // 3
            //         { data: "tgl_order", name: "tgl_order", render: function (d) {
            //                 return moment(d).format('DD-MM-YYYY');
            //             },
            //         }, // 3
            //         { data: "nama", name: "nama", visible: true }, // 4                
            //     ],
            //     //      aligment left, right, center row dan coloumn
            //     order: [["0", "desc"]],
            //     columnDefs: [
            //         { className: "text-center", targets: [0, 1, 2, 3] },                
            //     ],
            //     bAutoWidth: false,
            //     responsive: true,
            // });
            // $("#datatable_list_order").css("cursor", "pointer");
        }

        form_state('LOAD');
        list_data();
        list_data_order();

        $('#btn_add_data').click(function(event) {
            form_state('ADD_HDR');
        });

        $('#back,#batal').click(function() {
            $('#list_data').show('slow');
            $('#add_data').hide('slow');
        });

        $('#browse_order').click(function(event) {
            list_data_order();
            $('#modal_browse_order').modal();
            $('#modal_browse_order').appendTo("body"); 
        });

        $("#datatable_list_order tbody").on("click", "tr", function () {
            var table = $("#datatable_list_order").DataTable();
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

        $('.btn_select_order').click(function(event) {
            var table = $("#datatable_list_order").DataTable();
            var idx = table.cell(".selected", 0).index();
            var data = table.row(idx.row).data();

            var id_order = data["id"];
            var no_order = data["no_order"];
            $('#id_order').val(id_order);
            $('#no_order').val(no_order);
        });

        $('#save').click(function(event) {
            $.ajax({
                type: "post",
                url: "{{route('api.schedule.store')}}",
                data: $("#form_input").serialize(),
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
    
    // document.addEventListener('DOMContentLoaded', function() {
    //     var calendarEl = document.getElementById('calendar');

    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         headerToolbar: {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
    //         },
    //         initialDate: '2020-09-12',
    //         navLinks: true, // can click day/week names to navigate views
    //         businessHours: true, // display business hours
    //         editable: true,
    //         selectable: true,
    //         events: [{
    //                 title: 'Business Lunch',
    //                 start: '2020-09-03T13:00:00',
    //                 constraint: 'businessHours'
    //             },
    //             {
    //                 title: 'Meeting',
    //                 start: '2020-09-13T11:00:00',
    //                 constraint: 'availableForMeeting', // defined below
    //                 color: '#257e4a'
    //             },
    //             {
    //                 title: 'Conference',
    //                 start: '2020-09-18',
    //                 end: '2020-09-20'
    //             },
    //             {
    //                 title: 'Conference1',
    //                 start: '2020-09-18',
    //                 end: '2020-09-20'
    //             },
    //             {
    //                 title: 'Party',
    //                 start: '2020-09-29T20:00:00'
    //             },

    //             // areas where "Meeting" must be dropped
    //             {
    //                 groupId: 'availableForMeeting',
    //                 start: '2020-09-11',
    //                 end: '2020-09-11',
    //                 display: 'background'
    //             },
    //             {
    //                 groupId: 'availableForMeeting',
    //                 start: '2020-09-18',
    //                 end: '2020-09-20',
    //                 display: 'background'
    //             },

    //             // red areas where no events can be dropped
    //             {
    //                 start: '2020-09-24',
    //                 end: '2020-09-28',
    //                 overlap: false,
    //                 display: 'background',
    //                 color: '#ff9f89'
    //             },
    //             {
    //                 start: '2020-09-06',
    //                 end: '2020-09-09',
    //                 overlap: false,
    //                 display: 'background',
    //                 color: '#ff9f89'
    //             }
    //         ]
    //     });

    //     calendar.render();
    // });
</script>