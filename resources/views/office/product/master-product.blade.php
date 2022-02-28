@section('title', 'Master Product')
@include('office.layouts.header')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div id="list_data" class="row">
			<div class="col-12 col-sm-12 col-lg-12">
				<div class="card">
					<h3 class="text-center mt-3 mb-3">Master Product</h3>
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
												<th style="color: white;">ID</th>
												<th style="color: white;">NO</th>
												<th style="color: white;">NAMA</th>
												<th style="color: white;">SATUAN</th>
												<th style="color: white;">ID PAKET</th>
												<th style="color: white;">PAKET</th>
												<th style="color: white;">ID KATEGORI</th>
												<th style="color: white;">KATEGORI</th>
												<th style="color: white;">ID UKURAN</th>
												<th style="color: white;">UKURAN</th>
												<th style="color: white;">FILE GAMBAR</th>
												<th style="color: white;">KETERANGAN</th>
												<th style="color: white;">HARGA</th>
												<th style="color: white;">ACTION</th>
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
							<form class="row" id="form_input" action="{{route('api.product.store')}}" method="post" enctype="multipart/form-data">
								<div class="col-md-12 text-left">
									<div class="form-group">
										<a id="back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
									</div>
								</div>
								<input type="hidden" name="state" id="state">
								<input type="hidden" id="sysid" name="sysid">
								<div class="col-md-12">
									<div class="form-group">
										<h2 class="alert-info font-weight-bold text-center" id="title_input">Tambah Data Barang</h2>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="nama">Nama Barang<span style="color: red;">*</span></label>
										<input id="nama" name="nama" class="form-control" type="text" />
									</div>
								</div>
								<div class="col-md-4" hidden="">
									<div class="form-group">
										<label for="paket">Paket <span style="color: red;">*</span></label>
										<select id="paket" name="paket" class="form-control" type="email">

										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="kategori">Kategori <span style="color: red;">*</span></label>
										<select id="kategori" name="kategori" class="form-control" type="email">

										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="harga">Harga <span style="color: red;">*</span></label>
										<input id="harga" name="harga" class="form-control" type="text" />
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
											<input type="file" name="filename[]" class="form-control" required>
											<div class="input-group-append">
												<button class="btn btn-tambah btn-success" type="button"><i class="fas fa-plus"></i></button>
											</div>
										</div>
										<div class="clone hide">
											<div class="control-group input-group" style="margin-top:10px">
												<input type="file" name="filename[]" class="form-control">
												<div class="input-group-append">
													<button class="btn btn-kurang btn-danger" type="button"><i class="fas fa-minus"></i></button>
												</div>
											</div>
										</div>
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
		<div id="edit_data" class="page-inner mt--5">
			<div class="row mt--2">
				<div class="col-md-12">
					<div id="" class="card full-height">
						<div class="card-body">
							<form class="row" id="form_input" action="{{route('api.product.update')}}" method="post" enctype="multipart/form-data">
								<div class="col-md-12 text-left">
									<div class="form-group">
										<a id="e_back" name="back" style="color:white" class="btn btn-primary "><i class="fas fa-arrow-left"></i> &nbsp; Kembali</a>
									</div>
								</div>
								<input type="hidden" name="state" id="state">
								<input type="hidden" id="e_sysid" name="e_sysid">
								<div class="col-md-12">
									<div class="form-group">
										<h2 class="alert-info font-weight-bold text-center" id="title_input">Edit Data Barang</h2>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="e_nama">Nama Barang<span style="color: red;">*</span></label>
										<input id="e_nama" name="e_nama" class="form-control" type="text" />
									</div>
								</div>
								<div class="col-md-4" hidden="">
									<div class="form-group">
										<label for="e_paket">Paket <span style="color: red;">*</span></label>
										<select id="e_paket" name="e_paket" class="form-control" type="email">

										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="e_kategori">Kategori <span style="color: red;">*</span></label>
										<select id="e_kategori" name="e_kategori" class="form-control" type="email">

										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="e_harga">Harga <span style="color: red;">*</span></label>
										<input id="e_harga" name="e_harga" class="form-control" type="text" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="e_keterangan">Keterangan <span style="color: red;">*</span></label>
										<textarea id="e_keterangan" name="e_keterangan" class="form-control" type="text" cols="2"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="input-file-now">Upload Gambar </label>
										<div class="input-group control-group increment">
											<input type="file" name="e_filename[]" class="form-control" required>
											<div class="input-group-append">
												<button class="btn btn-tambah btn-success" type="button"><i class="fas fa-plus"></i></button>
											</div>
										</div>
										<div class="clone hide">
											<div class="control-group input-group" style="margin-top:10px">
												<input type="file" name="e_filename[]" class="form-control">
												<div class="input-group-append">
													<button class="btn btn-kurang btn-danger" type="button"><i class="fas fa-minus"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12 text-right">
									<div class="form-group">
										<button style="color:white" type="submit" class="btn btn-info waves-effect waves-dark e_btn-upload" data-toggle="tooltip" title="Save">
											<span class="btn-label">
												<i class="fas fa-save"></i>
											</span> Simpan
										</button>
										<a id="e_batal" name="batal" style="color:white" class="btn btn-danger "><i class="fa fa-times-circle"></i> &nbsp; Batal</a>
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
	$("#drop-master").addClass("active");

	$(".btn-tambah").click(function() {
		var html = $(".clone").html();
		$(".increment").after(html);
	});

	$("body").on("click", ".btn-kurang", function() {
		$(this).parents(".control-group").remove();
	});

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

		function reset_input() {
			$('#sysid').val('');
			$('#nama').val('');
			// $('#satuan').val('M');
			$('#keterangan').val('');
			$('#harga').val(0);
		}

		function form_state(state) {
			switch (state) {
				case 'LOAD':
					$('#add_data').hide();
					$('#edit_data').hide();
					$('#list_data').show();
					list_data();
					break;
				case 'ADD_HDR':
					reset_input();
					list_data_kategori('', 'ADD');
					list_data_paket('', 'ADD');
					$("#state").val("ADD");
					$('#title_input').html('Tambah Master Barang');
					$('#add_data').show('slow');
					$('#edit_data').hide();
					$('#list_data').hide('slow');
					break;
				case 'SAVE_HDR':
					break;
				case 'EDIT_HDR':
					$("#state").val("EDIT");
					$('#title_input').html('Edit Master Barang');
					$('#add_data').hide();
					$('#edit_data').show('slow');
					$('#list_data').hide('slow');
					break;
				case 'REVISI_HDR':
					break;
			}
		}

		function list_data() {
			$("#tbl_list_hdr").DataTable({
				destroy: true,
				processing: true,
				serverSide: true,
				ajax: {
					url: "{{route('api.product.list')}}",
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
						data: "satuan",
						name: "satuan",
						visible: false
					}, // 3
					{
						data: "id_paket",
						name: "id_paket",
						visible: false
					}, // 4
					{
						data: "nama_paket",
						name: "nama_paket",
						visible: false
					}, // 5
					{
						data: "id_kategori",
						name: "id_kategori",
						visible: false
					}, // 4
					{
						data: "nama_kategori",
						name: "nama_kategori",
						visible: true
					}, // 5
					{
						data: "id_ukuran",
						name: "id_ukuran",
						visible: false
					}, // 6
					{
						data: "ukuran",
						name: "ukuran",
						visible: false
					}, // 7                         
					{
						data: "file_name",
						name: "file_name",
						visible: true
					}, // 8
					{
						data: "keterangan",
						name: "keterangan",
						visible: true
					}, // 9
					{
                        data: "harga",
                        name: "harga", render: function (d) {
                            return currencyFormat(d);
                        },
                    }, // 9
					{
						data: "action",
						name: "action",
						visible: true
					}, // 10
				],
				//		aligment left, right, center row dan coloumn
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
				rowCallback: function(row, data) {
					$('td:eq(5)', row).addClass('font_biru');
				},
			});
			$("#tbl_list_hdr").css("cursor", "pointer");
		}

		function list_data_kategori(id_kategori, state) {
			$.ajax({
				url: "{{route('api.product.list.kategori')}}",
				type: 'GET',
				success: function(response) {
					// $("#breeds").attr('disabled', false);
					if (state == 'ADD') {
						$('#kategori').empty();
						$("#kategori").append('<option value=0>Pilih Kategori</option>');
						$.each(response, function(key, value) {
							$("#kategori").append('<option value=' + value.id + '>' + value.nama + '</option>');
						});
						if (id_kategori != '') {
							$('#kategori').val(id_kategori);
						}
					} else {
						$('#e_kategori').empty();
						$("#e_kategori").append('<option value=0>Pilih Kategori</option>');
						$.each(response, function(key, value) {
							$("#e_kategori").append('<option value=' + value.id + '>' + value.nama + '</option>');
						});
						if (id_kategori != '') {
							$('#e_kategori').val(id_kategori);
						}
					}

				}
			});
		}

		function list_data_paket(id_paket, state) {
			$.ajax({
				url: "{{route('api.product.list.paket')}}",
				type: 'GET',
				success: function(response) {
					// $("#breeds").attr('disabled', false);
					if (state == 'ADD') {
						$('#paket').empty();
						$("#paket").append('<option value=0>Pilih Paket</option>');
						$.each(response, function(key, value) {
							$("#paket").append('<option value=' + value.id + '>' + value.nama + '</option>');
						});
						if (id_paket != '') {
							$('#paket').val(id_paket);
						}
					} else {
						$('#e_paket').empty();
						$("#e_paket").append('<option value=0>Pilih Paket</option>');
						$.each(response, function(key, value) {
							$("#e_paket").append('<option value=' + value.id + '>' + value.nama + '</option>');
						});
						if (id_paket != '') {
							$('#e_paket').val(id_paket);
						}
					}

				}
			});
		}

		form_state('LOAD');

		$("body").on("click", ".btn-upload", function(e) {
			$(this).parents("form").ajaxForm(options);
		});

		var options = {
			complete: function(response) {
				if ($.isEmptyObject(response.responseJSON.error)) {
					form_state('LOAD');
					swal({
						type: "success",
						title: "Success!",
						text: "Successfully Saved.",
						timer: 4000,
						showConfirmButton: true
					});
					// reset_input_dtl_attach();
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

		$('#tambah_data').click(function() {
			form_state('ADD_HDR');
		});

		$('#back, #e_back').click(function() {
			$('#list_data').show('slow');
			$('#add_data').hide('slow');
			$('#edit_data').hide('slow');
		});

		$('#batal, #e_batal').click(function() {
			$('#list_data').show('slow');
			$('#add_data').hide('slow');
			$('#edit_data').hide('slow');
		});

		$('body').on('click', '#edit_data_hdr', function(e) {
			var $row = $(this).closest("tr");
			var data = $('#tbl_list_hdr').DataTable().row($row).data();

			form_state('EDIT_HDR');

			id = data['id'];
			nama = data['nama'];
			satuan = data['satuan'];
			id_paket = data['id_paket'];
			id_kategori = data['id_kategori'];
			id_ukuran = data['id_ukuran'];
			keterangan = data['keterangan'];
			file_name = data['file_name'];
			harga = data['harga'];

			$('#e_sysid').val(id);
			$('#e_nama').val(nama);
			$('#e_satuan').val(satuan);
			$('#e_keterangan').val(keterangan);
			$('#e_harga').val(harga);

			list_data_kategori(id_kategori, 'EDIT');
			list_data_paket(id_paket, 'EDIT')
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
						url: "{{route('api.product.destroy')}}",
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

		$("#tbl_list_hdr tbody").on("click", "td:nth-child(4)", function() {
			var $row = $(this).closest("tr");
			var data = $("#tbl_list_hdr").DataTable().row($row).data();
			file_name = data["file_name"];
			// alert(file_name);
			window.open("/master-product/view_file/" + file_name, "_blank");
		});

		$("body").on("click", ".e_btn-upload", function(e) {
			$(this).parents("form").ajaxForm(options);
		});

		var options = {
			complete: function(response) {
				if ($.isEmptyObject(response.responseJSON.error)) {
					form_state('LOAD');
					swal({
						type: "success",
						title: "Success!",
						text: "Successfully Saved.",
						timer: 4000,
						showConfirmButton: true
					});
				} else {
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
	});
</script>