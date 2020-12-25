 <div class="col-md-12 col-sm-12 ">
 	<div class="x_panel">
 		<div class="x_content">
 			<div class="row">
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

 <script>
 	document.addEventListener("DOMContentLoaded", function(event) {

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
