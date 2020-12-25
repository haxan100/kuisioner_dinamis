 <div class="col-md-12 col-sm-12 ">
 	<div class="x_panel">
 		<div class="x_content">
 			<div class="row">
 				<input class="form-control" type="hidden" name="id_pertanyaan" id="id_pertanyaan" value="<?= $id?>">
 				<div class="x_panel">
 					<div class="x_title">
 						<h2>Judul Pertanyaan</h2>
 						<ul class="nav navbar-right panel_toolbox">
 							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
 							</li>
 							<li><a class="close-link"><i class="fa fa-close"></i></a>
 							</li>
 						</ul>
 						<div class="clearfix"></div>
 					</div>
 					<div class="x_content">
 						<h4>
 							<?= $pertanyaan ?></h4>
 					</div>
 				</div>


 				<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-detail" class="btn m-t-18 btn-info waves-effect waves-light btnTambah">
 					<i class="ti-plus"></i> Tambah Pertanyaan
 				</a>
 				<div class="col-sm-12">
 					<div class="card-box table-responsive">
 						<table id="pertanyaan" class="table table-striped table-bordered" style="width:100%">
 							<thead>
 								<tr>
 									<th>No</th>
 									<th>Jawaban</th>
 									<th>Aksi</th>
 								</tr>
 							</thead>
 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>

 <div class="modal fade bs-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
 	<div class="modal-dialog modal-lg">
 		<form id="form">
 			<div class="modal-content">

 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
 					</button>
 				</div>
 				<div class="modal-body">
 					<h4>Tambah Pertanyaan</h4>

 					<div class="clearfix"></div>

 					<div class="row">
 						<!-- form input mask -->
 						<div class="col-md-12 col-sm-12  ">
 							<div class="x_panel">
 								<div class="x_title">
 									<div class="clearfix"></div>
 								</div>
 								<div class="x_content">
 									<br />
 									<div class="form-group row">
 										<input class="form-control" type="hidden" name="id" id="id">
 										<label class="control-label col-md-3 col-sm-3 col-xs-3">Pertanyaan</label>
 										<div class="col-md-9 col-sm-9 col-xs-9">
 											<input id="ask" name="ask" class="form-control " placeholder="Isikan pertanyaan" type="text" class="form-control">

 											<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
 										</div>
 									</div>
 									<div class="ln_solid"></div>
 								</div>
 							</div>
 						</div>
 						<!-- /form input mask -->
 					</div>
 					<div class="modal-footer">
 						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 						<button type="button" class="btn btn-primary" id="Edit">Save changes</button>

 						<button type="button" class="btn btn-success" id="tambah_act">Tambah</button>
 					</div>
 				</div>
 		</form>

 		<script>
 			document.addEventListener("DOMContentLoaded", function(event) {
 				var bu = '<?= base_url(); ?>';
 				var url_form_tambah = bu + 'admin/tambahPertanyaan';
 				var url_form_ubah = bu + 'admin/ubahPertanyaan';

 				function validasi(id, valid, message = '') {
 					if (valid) {
 						$(id)
 							// .addClass('is-valid')
 							.removeClass('is-invalid')
 							.parent()
 							.find('small')
 							// .addClass('valid-feedback')
 							.removeClass('invalid-feedback')
 							.html(message);
 					} else {
 						$(id)
 							// .removeClass('is-valid')
 							.addClass('is-invalid')
 							.parent()
 							.find('small')
 							// .removeClass('valid-feedback')
 							.addClass('invalid-feedback')
 							.html(message);
 					}
 				}

 				function notifikasiModal(modal, sel, msg, err) {
 					var alert_type = 'alert-success ';
 					if (err) alert_type = 'alert-danger ';
 					var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
 					$(sel).html(html);
 					$(modal).animate({
 						scrollTop: $(sel).offset().top - 75
 					}, 500);
 				}
 				$('#tambah_act').on('click', function() {

 					var ask = $('#ask').val();

 					if (
 						pertanyaan
 					) {
 						$("#form").submit();
 					}
 					// return false;
 				});

 				function notifikasi(sel, msg, err) {
 					var alert_type = 'alert-success ';
 					if (err) alert_type = 'alert-danger ';
 					var html = '<div class="alert ' + alert_type + ' alert-dismissible show p-4">' + msg + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
 					$(sel).html(html);
 					$('html, body').animate({
 						// scrollTop: $(sel).offset().top - 75
 					}, 500);
 				}

 				$('.btnTambah').on('click', function() {
 					url_form = url_form_tambah;
 					// url_form = url_form_tambah;
 					// console.log(url_form);
 					$('#Edit').hide();
 					$("#nisn").removeAttr('readonly');
 					$('.modalProdukTitleTambah').show();
 					$('.modalProdukTitleUbah').hide();

 					$('#btnTambah').show();
 					$('#btnUbah').hide();
 					$('#btnCopy').hide();
 					$('#btnTampil').hide();
 					$('.modalFotoUbah').hide();
 					$('#listFoto').html('');
 					$('#foto_wrappers').html('');
 				});

 				$("#form").submit(function(e) {
 					console.log('form submitted');
 					// return false;
 					$.ajax({
 						url: url_form,
 						method: 'post',
 						dataType: 'json',
 						data: new FormData(this),
 						processData: false,
 						contentType: false,
 						cache: false,
 						async: false,
 					}).done(function(e) {
 						console.log(e);
 						// return false
 						if (e.status) {
 							notifikasi('#alertNotif', e.message, false);
 							$('#modal-detail').modal('hide');
 							datatable.ajax.reload();
 							Swal.fire(
 								':)',
 								e.message,
 								'success'
 							);
 						} else {
 							notifikasiModal('#modalProduk', '#alertNotifModal', e.message, true);
 							Swal.fire({
 								icon: 'error',
 								title: 'Oops...',
 								text: 'terjadi kesalahan!',

 							})

 						}
 					}).fail(function(e) {
 						// console.log(e);
 						notifikasi('#alertNotif', 'Terjadi kesalahan!', true);
 					});
 					return false;
 				});
 				$('body').on('click', '.btnHapus', function() {
 					var id_siswa = $(this).data('id_pertanyaan');
 					var nama = $(this).data('pertanyaan');
 					Swal.fire({
 						title: 'Apakah Anda Yakin ?',
 						text: "Anda akan Menghapus Data: " + nama,
 						icon: 'warning',
 						showCancelButton: true,
 						confirmButtonColor: '#3085d6',
 						cancelButtonColor: '#d33',
 						confirmButtonText: 'Yes, delete it!'
 					}).then((result) => {

 						if (result.value) {
 							$.ajax({
 								url: bu + 'admin/hapusPertanyaan',
 								dataType: 'json',
 								method: 'POST',
 								data: {
 									id: id_siswa
 								}
 							}).done(function(e) {
 								Swal.fire(
 									'Deleted!',
 									e.message,
 									'success'
 								)
 								$('#modal-detail').modal('hide');
 								datatable.ajax.reload();
 							}).fail(function(e) {
 								var message = 'Terjadi Kesalahan. #JSMP01';
 							});
 						}
 					})

 				});
 				$('body').on('click', '.btnDetail', function() {
 					var id = $(this).data('id_pertanyaan');
 					console.log(id)

 					var url = bu + 'Admin/Jawaban/' + id;
 					window.location = url;

 				});
 				var bu = '<?= base_url(); ?>';
 				var datatable = $('#pertanyaan').DataTable({
 					"pagingType": "full_numbers",
 					"processing": true,
 					"serverSide": true,
 					"paging": true,
 					"order": [
 						[1, "desc"]
 					],
 					'ajax': {
 						url: bu + 'admin/getJawaban',
 						type: 'POST',
 						"data": function(d) {
 							d.id = $('#id_pertanyaan').val();
 							return d;
 						}
 					},
 				});

 				$('body').on('click', '.btnUbah', function() {
 					url_form = url_form_ubah;
 					$('#tambah_act').hide();

 					var id = $(this).data('id_pertanyaan');
 					var pertanyaan = $(this).data('pertanyaan');
 					$('#modal-detail').modal('show');

 					$('#id').val(id);
 					$('#ask').val(pertanyaan);


 				});

 				$('#Edit').on('click', function() {

 					var id = $('#id').val();
 					var ask = $('#ask').val();

 					if (
 						id && ask
 					) {
 						$("#form").submit();

 					}


 				});


 			});
 		</script>
