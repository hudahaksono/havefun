@section('title', 'Profile')
@include('layouts.navbar')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 ftco-animate">
                <form action="#" class="billing-form ftco-bg-dark p-3 p-md-5">
                    <h3 class="mb-4 billing-heading text-center">PROFILE</h3>
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label>Nama</label>
                            <input id="nama" name="nama" class="form-control" value="{{ Session::get('sess_nama') }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <label>Email</label>
                            <input id="email" name="email" class="form-control" value="{{ Session::get('sess_email') }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <label>No Handphone</label>
                            <input id="no_tlp" name="no_tlp" class="form-control" value="{{ Session::get('sess_no_tlp') }}" readonly />
                        </div>
                        <div class="col-md-12 text-center pt-4">
                            <button type="button" class="btn btn-primary" id="btn_password" name="btn_password"><i class="fas fa-key"></i> Ubah Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include('layouts.footbar')