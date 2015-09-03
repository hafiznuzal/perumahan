		<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Pengembang</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">

					<div id="addSuccess" class="alert alert-success" style="display:none;">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Added
					</div>
					 <div id="delSuccess" class="alert alert-success" style="display:none;">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Deleted
					</div>
					 <div id="editSuccess" class="alert alert-success" style="display:none;">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Edited
					</div>
					<!-- /.success notification-->
				   
					<div class ="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Daftar Pengembang
							<div class="pull-right">
								<a href="#" class="add_btn "><i class="fa fa-plus-circle fa-2x" style="color:white;"></i></a>
							</div>
						</div>
						<div class="panel-body scrollable">
							<div class ="table">
								<table id="dataTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Nama Perusahaan</th>
											<th>Pimpinan</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Fax</th>
											<th style="min-width: 80px;">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($daftar_pengembang as $i) {?>
										<tr class="odd gradeX">
											<td><?php echo $i['nama_perusahaan']?></td>
											<td><?php echo $i['pimpinan']?></td>
											<td><?php echo $i['alamat']?></td>
											<td><?php echo $i['telp']?></td>
											<td><?php echo $i['fax']?></td>
											<td style="min-width: 80px;">
													<a class ="edit_btn" href="#" id="<?php echo $i['id_perusahaan']?>"><i class="fa fa-edit fa-2x"></i></a>
													<a class ="del_btn" href="#" id="<?php echo $i['id_perusahaan']?>"><i class="fa fa-trash fa-2x"></i></a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!-- /.table -->

						</div>
						<!-- /.panel-body -->

					</div>
					<!-- /.panel -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>

	<!-- EDIT MODAL -->
	<div class="modal fade " id="EditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="EditModalLabel">Sunting</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label >Nama Perusahaan :</label>
						<input type="text" class="form-control" id="editPerusahaan">
						<label >Pimpinan :</label>
						<input type="text" class="form-control" id="editPimpinan">
						<label >Alamat :</label>
						<input type="text" class="form-control" id="editAlamat">
						<label >Telepon :</label>
						<input type="text" class="form-control" id="editTelepon">
						<label >Fax :</label>
						<input type="text" class="form-control" id="editFax">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveEdit" class="btn btn-primary">Simpan</button>

				</div>
			</div>
		 </div>
	</div>
</div>

<div class="modal fade " id="AddModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="AddModalLabel">Tambahkan</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="idEditPerusahaan"/>
						<input type="hidden" id="idPerusahaan"/>
						<label >Nama Perusahaan :</label>
						<input type="text" class="form-control" id="addPerusahaan">
						<label >Pimpinan :</label>
						<input type="text" class="form-control" id="addPimpinan">
						<label >Alamat :</label>
						<input type="text" class="form-control" id="addAlamat">
						<label >Telepon :</label>
						<input type="text" class="form-control" id="addTelepon">
						<label >Fax :</label>
						<input type="text" class="form-control" id="addFax">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveAdd" class="btn btn-primary">Tambahkan</button>
				</div>
			</div>
		 </div>
	</div>
</div>
<div class="modal fade " id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					
				</div>
				<div class="modal-body">
					<h2>Anda yakin akan menghapus ?</h2>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="button" id="hapus" class="btn btn-primary">Hapus</button>

					</div>
				</div>
			 </div>
		</div>
	</div>


		<script>

			$(document).ready(function () {
				var row;	

				$('#dataTable').DataTable({
					"scrollx": true
				});

				
				$("#dataTable").on("click", ".edit_btn", function(e) {
				
					e.preventDefault();
					var id = $(this).attr("id");
					var name = $(this).parent().prev().prev().prev().prev().prev().html();
					var pimpinan = $(this).parent().prev().prev().prev().prev().html();
					var alamat = $(this).parent().prev().prev().prev().html();
					var telpon = $(this).parent().prev().prev().html();
					var fax = $(this).parent().prev().html();
					$('#idEditPerusahaan').val(id);
					$('#editPerusahaan').val(name);
					$('#editPimpinan').val(pimpinan);
					$('#editAlamat').val(alamat);
					$('#editTelepon').val(telpon);
					$('#editFax').val(fax);
					row=$(this).parent().parent();
					console.log(row.data())
					$('#EditModal').modal('show');
				});

				$('.add_btn').click(function(e) {
					e.preventDefault();
					row=$(this).parent().parent();
					$('#AddModal').modal('show');
				});
				
				$("#dataTable").on("click", ".del_btn", function(e) {
				// $('.del_btn').click(function(e){
				e.preventDefault();
				row=$(this).parent().parent();
				$('#idPerusahaan').val($(this).attr("id"));
				$('#DeleteModal').modal('show');

			});
			
			$('#hapus').click(function(e){
				e.preventDefault();
					

					$.ajax({
						url: '<?php echo site_url()?>pengembang/delete/',
						type:'GET',
						data: {
							"id": $('#idPerusahaan').val()
						},
						dataType: 'html',
						success: function(results) {
							//$("#page_container").html(results);
							
							$("#delSuccess").show();
							$('#DeleteModal').modal('hide');
							row.fadeOut('slow',function(){$(this).remove();});


						}
				});
			});

			$("#saveAdd").click(function(e){
				
				if ($('#addPerusahaan').val()==''&& $('#addPimpinan').val()==''&& $('#addAlamat').val()==''&& $('#addFax').val() =='') {
						bootbox.alert("Mohon Lengkapi Isian");
					}

				else if ($('#addPerusahaan').val()==''|| $('#addPimpinan').val()==''|| $('#addAlamat').val()==''|| $('#addFax').val() =='') {
						bootbox.alert("Mohon Lengkapi Isian");
					}
					

					else
					{
						var data={
							"nama_perusahaan": $('#addPerusahaan').val(),
							"pimpinan": $('#addPimpinan').val(),
							"alamat": $('#addAlamat').val(),
							"telp": $('#addTelepon').val(),
							"fax": $('#addFax').val()
						};

						var table=$('#dataTable').DataTable();
						$.ajax({
							url: '<?php echo site_url(); ?>pengembang/add/',
							type: 'GET',
							data: data,
							dataType: 'json',
							success: function(results){
								
								
							var Action=	"<a class =\"edit_btn\" href=\"#\" id=\""+results[0].id_perusahaan+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn\" href=\"#\" id=\""+results[0].id_perusahaan+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
								
								//$("#page_container").html(results);

								$("#addSuccess").show();
								$('#AddModal').modal('hide');

								var rowNode = table.row.add([$('#addPerusahaan').val(),
									$('#addPimpinan').val(),$('#addAlamat').val(),
									$('#addTelepon').val(),
									$('#addFax').val(),Action]).draw().node();

								$(rowNode).css('color','red').animate({color:"black"});
								
							}
						});
					}

					// if (data.nama_perusahaan==''&&data.pimpinan==''&&data.telp==''&&data.fax=='') {
					// 	bootbox.alert("Mohon Lengkapi Isian",function())
					// };
				
			});
			
			$('#saveEdit').click(function(e) {
				var table=$('#dataTable').DataTable();
				$.ajax({
					url: '<?php echo site_url()?>pengembang/edit/',
					type:'GET',
					data: {
						"id_perusahaan": $('#idEditPerusahaan').val(),
						"nama_perusahaan": $('#editPerusahaan').val(),
						"pimpinan": $('#editPimpinan').val(),
						"alamat": $('#editAlamat').val(),
						"telp": $('#editTelepon').val(),
						"fax": $('#editFax').val()
					},
					dataType: 'html',
					success: function(results) {
						console.log(JSON.stringify(results));
						//$("#page_container").html(results);
						var Action=	"<a class =\"edit_btn\" href=\"#\" id=\""+$('#idEditPerusahaan').val()+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn\" href=\"#\" id=\""+$('#idEditPerusahaan').val()+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
						row.fadeOut('fast',function(){$(this).remove();});
						table.row.add([$('#editPerusahaan').val(),
						 	$('#editPimpinan').val(),$('#editAlamat').val(),
						 	$('#editTelepon').val(),
						 	$('#editFax').val(),Action]).draw().node();

						$("#editSuccess").show();
						$('#EditModal').modal('hide');
						
						// table.row.(this).data([$('#editPerusahaan').val(),
						// 	$('#editPimpinan').val(),$('#editAlamat').val(),
						// 	$('#editTelepon').val(),
						// 	$('#editFax').val(),Action]).draw();

					}
				});
			});
		});

		</script>

		
