@section('title', 'Ubah Password')
@include('layouts.navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form id="form_control" action="#" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">PROFILE</h3>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <label>Password Lama <span style="color:red">*</span></label>
                            <input id="password" name="password" class="form-control" />
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <label>Password Baru <span style="color:red">*</span></label>
                            <input id="newpassword" name="newpassword" class="form-control" />
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <label>Ulangi Password <span style="color:red">*</span></label>
                            <input id="repassword" name="repassword" class="form-control" />
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-12 text-center pt-4">
                            <button type="button" class="btn btn-info" id="btn_submit" name="btn_submit"><i class="fas fa-check"></i> SUBMIT</button>
                            <a href="/front-profile" class="btn btn-danger"><i class="fas fa-ban"></i> CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')
<script>
    $('.nav-item').removeClass('active');
    $('.total_chart').html('{{$total_chart}}');

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        alert('test');

        $('#btn_submit').click(function() {
            var password = $('#password').val();
            var newpassword = $('#newpassword').val();
            var repassword = $('#repassword').val();

            if (password == null) {
                swal('Warning!', 'Kolom Password Tidak Boleh Kosong', {
                    icon: 'warning',
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    }
                });
            } else if (newpassword == null) {
                swal('Warning!', 'Kolom Password Baru Tidak Boleh Kosong', {
                    icon: 'warning',
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    }
                });
            } else if (repassword == null) {
                swal('Warning!', 'Kolom Ulangi Password Tidak Boleh Kosong', {
                    icon: 'warning',
                    buttons: {
                        confirm: {
                            className: 'btn btn-warning'
                        }
                    }
                });
            }
        });
    });
</script>