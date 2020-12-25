 <div class="col-md-12 col-sm-12 ">
 	<div class="x_panel">
 		<div class="x_content">
 			<div class="row">
 				<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-detail" class="btn m-t-18 btn-info waves-effect waves-light btnTambah">
 					<i class="ti-plus"></i> Tambah Pertanyaan
 				</a>

 				<div class="col-sm-12">
 					<div class="card-box table-responsive">
 						<table id="pertanyaan" class="table table-striped table-bordered" style="width:100%">
 							<thead>
 								<tr>
 									<th>No</th>
 									<th>Pertanyaan</th>
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

 				// $('#modal-detail').modal('show');

 				var bu = '<?= base_url(); ?>';

 				var url_form_tambah = bu + 'admin/tambahPertanyaan';
 				var url_form_ubah = bu + 'admin/ubah_siswa_proses';

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
 					console.log(ask);

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

 				var bu = '<?= base_url(); ?>';
 				var datatable = $('#pertanyaan').DataTable({
 					"paging": true,
 					"order": [
 						[1, "desc"]
 					],
 					'ajax': {
 						url: bu + 'admin/getPertanyaan',
 						type: 'POST',
 						"data": function(d) {
 							return d;
 						}
 					},
 				});
 			});
 		</script>
