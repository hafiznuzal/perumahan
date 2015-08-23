		<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Lokasi</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">

					<div id="addSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data berhasil ditambahkan
					</div>
					 <div id="delSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data berhasil dihapus
					</div>
					 <div id="editSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data berhasil disunting
					</div>
					<!-- /.success notification-->
				   
					<div class ="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Daftar Lokasi
							<div class="pull-right">
								<a href="#" class="add_btn " style = "color:white"><i class="fa fa-plus-circle fa-2x"></i></a>
							</div>
						</div>
						<div class="panel-body">
							<div class ="table">
								<table id="dataTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Nama Lokasi</th>
											<th>Nama Kecamatan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($daftar_lokasi as $i) {?>
										<tr class="odd gradeX">
											<td longitude="<?php echo $i['longitude'];?>" latitude="<?php echo $i['latitude'];?>"><?php echo $i['nama_lokasi']?></td>
											<td><?php echo $i['nama_kecamatan']?></td>    
											<td>
												<a class ="edit_btn" href="#" id="<?php echo $i['id_lokasi']?>" id-kecamatan="<?php echo $i['id_kecamatan']?>"><i class="fa fa-edit fa-2x"></i></a>
												<!--<a class ="del_btn" href="#" id="<?php echo $i['id_lokasi']?>" id-kecamatan="<?php echo $i['id_kecamatan']?>"><i class="fa fa-trash fa-2x"></i></a>-->
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
						<label >Nama Lokasi :</label>
						<input type="text" class="form-control" id="editLokasi">
						<input type="hidden" id="editIdLokasi">
						<label >Nama Kecamatan :</label>
						<select class="form-control" id="editIdkecamatan">
							<?php
								foreach ($daftar_kecamatan as $kecamatan)
								{
									echo "<option value='". $kecamatan['id_kecamatan']. "'>" . $kecamatan['nama_kecamatan'] . "</option>";
								}
							?>
						</select>
						<label>Pilih Lokasi</label>
						<div id="mapedit" style="height:300px !important"></div>
						<label >Latitude :</label>
						<p id="latitudeedit">Klik pada peta untuk menentukan lokasi</p>
						 <label >Longitude :</label>
						<p id="longitudeedit">Klik pada peta untuk menentukan lokasi</p>
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
						<label >Nama Lokasi :</label>
						<input type="text" class="form-control" id="addLokasi">
						<label >Nama Kecamatan :</label>
						<select class="form-control" id="addIdkecamatan">
							<?php
								foreach ($daftar_kecamatan as $kecamatan)
								{
									echo "<option value='". $kecamatan['id_kecamatan']. "'>" . $kecamatan['nama_kecamatan'] . "</option>";
								}
							?>
						</select>
						<label>Pilih Lokasi</label>
						<div id="mapadd" style="height:300px !important"></div>
						<label >Latitude :</label>
						<p id="latitudeadd">Klik pada peta untuk menentukan lokasi</p>
						 <label >Longitude :</label>
						<p id="longitudeadd">Klik pada peta untuk menentukan lokasi</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveAdd" class="btn btn-primary">Tambahkan</button>
				</div>
			</div>
		 </div>
	</div>
</div>

		<script>             

			$(document).ready(function () {
				var mapadd = L.map('mapadd').setView([-7.275862, 112.791744], 13);
				L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
					maxZoom: 18
				}).addTo(mapadd);


				mapadd.on('click', function(e) {
					var coord = e.latlng;
					$("#latitudeadd").html(coord.lat);
					$("#longitudeadd").html(coord.lng);
				});

				var mapedit = L.map('mapedit').setView([-7.275862, 112.791744], 13);
				L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
					maxZoom: 18
				}).addTo(mapedit);


				mapedit.on('click', function(e) {
					var coord = e.latlng;
					$("#latitudeedit").html(coord.lat);
					$("#longitudeedit").html(coord.lng);
				});

				$("#delSuccess").hide();
				$("#addSuccess").hide();
				$("#editSuccess").hide();
				$('#dataTable').DataTable();
				$("#dataTable").on("click", ".edit_btn", function(e) {
					e.preventDefault();
					var name = $(this).parent().prev().prev().html();
					$('#editLokasi').val(name);
					$('#editIdLokasi').val($(this).attr("id"));
					$("#editIdkecamatan").val($(this).attr("id-kecamatan"));
					$('#EditModal').modal('show');
					$("#latitudeedit").html($(this).parent().prev().prev().attr("longitude"));
					$("#longitudeedit").html($(this).parent().prev().prev().attr("latitude"));
					mapedit.setView([$("#latitudeedit").text(), $("#longitudeedit").text()]);
				});
				$('.add_btn').click(function(e) {
					e.preventDefault();
					$('#editLokasi').val('');
					$('#AddModal').modal('show');
				});

				$("#saveAdd").click(function(e){
					var data= {
						"nama_lokasi": $('#addLokasi').val(),
						"latitude": $('#longitudeadd').text(),
						"longitude": $('#latitudeadd').text(),
						"id_kecamatan": $('#addIdkecamatan').val(),
					};
					$.ajax({
						url: '<?php echo site_url(); ?>lokasi/add/',
						type: 'GET',
						data: data,
						dataType: 'html',
						success: function(results){
							$("#addSuccess").show();
							$("#AddModal").modal('hide');
							window.setTimeout(window.location.reload(true),2000);
						}
					});
				});

				$("#saveEdit").click(function(e){
					var data= {
						"id": $('#editIdLokasi').val(),
						"nama_lokasi": $('#editLokasi').val(),
						"latitude": $('#longitudeedit').text(),
						"longitude": $('#latitudeedit').text(),
						"id_kecamatan": $('#editIdkecamatan').val(),
					};
					$.ajax({
						url: '<?php echo site_url(); ?>lokasi/edit/',
						type: 'GET',
						data: data,
						dataType: 'html',
						success: function(result){
							$("#editSuccess").show();
							$("#EditModal").modal('hide');
							window.setTimeout(window.location.reload(true),2000);
						}
					});
				});
			});

		</script>

		
