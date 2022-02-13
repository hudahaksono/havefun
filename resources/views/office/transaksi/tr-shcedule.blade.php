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
                                    <a id="add_data" style="color:white" class="btn btn-primary"><i class="fas fa-plus"></i> Add Schedule</a>
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
    </section>
</div>
@include('office.layouts.footer')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('calendar/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: '2020-09-12',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            selectable: true,
            events: [{
                    title: 'Business Lunch',
                    start: '2020-09-03T13:00:00',
                    constraint: 'businessHours'
                },
                {
                    title: 'Meeting',
                    start: '2020-09-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#257e4a'
                },
                {
                    title: 'Conference',
                    start: '2020-09-18',
                    end: '2020-09-20'
                },
                {
                    title: 'Party',
                    start: '2020-09-29T20:00:00'
                },

                // areas where "Meeting" must be dropped
                {
                    groupId: 'availableForMeeting',
                    start: '2020-09-11T10:00:00',
                    end: '2020-09-11T16:00:00',
                    display: 'background'
                },
                {
                    groupId: 'availableForMeeting',
                    start: '2020-09-13T10:00:00',
                    end: '2020-09-13T16:00:00',
                    display: 'background'
                },

                // red areas where no events can be dropped
                {
                    start: '2020-09-24',
                    end: '2020-09-28',
                    overlap: false,
                    display: 'background',
                    color: '#ff9f89'
                },
                {
                    start: '2020-09-06',
                    end: '2020-09-08',
                    overlap: false,
                    display: 'background',
                    color: '#ff9f89'
                }
            ]
        });

        calendar.render();
    });
</script>