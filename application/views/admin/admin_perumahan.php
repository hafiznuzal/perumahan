	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Manajemen Perumahan</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">

					<div id="addSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert" >&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil ditambahkan
					</div>
					 <div id="delSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil dihapus
					</div>
					 <div id="editSuccess" class="alert alert-success"style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Berhasil!</strong> Data telah berhasil disunting
					</div>
					<!-- /.success notification-->

					<div class ="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Daftar Perumahan
							<div class="pull-right"><a href="#" class="add_btn"><i class="fa fa-plus-circle fa-2x" style="color:white;"></i></a></div>
						</div>
						<div class="panel-body">
							<div class ="table">
								<table id="dataTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Nama Perumahan</th>
											<th>Pengembang</th>
											<th>Lokasi</th>
											<th>Aksi</th>
											<th>Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($daftar_perumahan as $i) {?>
										<tr class="odd gradeX">
											<td><?php echo $i['nama_perumahan']?></td>
											<td><?php echo $i['nama_perusahaan']?></td>
											<td><?php echo $i['nama_lokasi']?></td>
											<td>
												<a class ="edit_btn" href="#" id="<?php echo $i['id_perumahan']?>"><i class="fa fa-edit fa-2x"></i></a>
												<!-- <a class ="del_btn" href="#" id="<?php echo $i['id_perumahan']?>"><i class="fa fa-trash fa-2x"></i></a> -->
											</td>
											<td>
												<a class="btn btn-info" href="<?php echo site_url(); ?>detil_proyek/index/<?php echo $i['id_perumahan']?>">Detail</a>
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
	<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="EditModalLabel">Sunting Perumahan</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" id="perumahanID" />
						<label >Nama Perumahan :</label>
						<input type="text" class="form-control" id="editNamaPerumahan">
						<label >Nama Pengembang :</label>
						<input type="text" class="form-control" id="editNamaPengembang">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="button" id="saveEdit" class="btn btn-primary">Simpan Perubahan</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ADD MODAL -->
	<div class="modal fade " id="AddModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="AddModalLabel">Tambah Perumahan</h4>
				</div>
			<div class="modal-body">
				<!-- <div class="row"> -->
					<div class="form-group">
						<label >Nama Perumahan :</label>
						<input type="text" class="form-control" id="addNamaPerumahan">
					</div>
					<div class="form-group">
						<label >Nama Pengembang :</label>
						<select class="form-control" id="addNamaPengembang">
							<?php
								foreach ($daftar_pengembang as $pengembang)
								{
									echo "<option value='". $pengembang['id_perusahaan']. "'>" . $pengembang['nama_perusahaan'] . "</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label >Daftar Lokasi :</label>
						<select id="addNamaLokasi" class="form-control form-inline">
							<?php foreach ($daftar_lokasi as $lokasi)
								{
									echo'<option value="'.$lokasi['id_lokasi'].'">'.$lokasi['nama_lokasi'].'</option>';
								}
							?>
						</select>
						<a href="#" id="importBtn"><i class="fa fa-plus"></i> import</a><hr/>
						<!-- <a href="#" id="addgenreBtn"><i class="fa fa-plus"></i>Tambah Lokasi</a><hr/> -->
						<!-- <div><ul id="lokasis" class="list-group"></ul></div> -->
						<div class="row">
							<div class="col-md-4">
								<select id="tahunOpt" class="form-control form-inline" style="display:none";></select>
							</div>
							<div class="col-md-4">
								<select id="periodeOpt" class="form-control form-inline" style="display:none";></select>
							</div>
							<div class="col-md-4">
								<select id="perumahanOpt" class="form-control form-inline" style="display:none";></select>
							</div>
						</div>
					</div>

				

				<!-- </div> -->
				<div class="row">
					<div class="col-md-6">
						<label >Nomor Ijin :</label>
						<input type="text" class="form-control" id="addNoIjin">
						<label >Tanggal Ijin :</label>
						<input type="text" class="form-control" data-date-format="YYYY-MM-DD hh:mm:ss" id="addTglIjin">
						<label >Luas :</label>
						<input type="text" class="form-control" id="addLuasIjin">
						<label >Rencana Tapak :</label>
						<input type="text" class="form-control" id="addRencanaTapakIjin">
						<label >Pembebasan :</label>
						<input type="text" class="form-control" id="addPembebasanIjin">
						<label >Terbangun :</label>
						<input type="text" class="form-control" id="addTerbangunIjin">
						<label >Belum Terbangun :</label>
						<input type="text" class="form-control" id="addBelumTerbangunIjin">
						<label >FS Dialokasikan :</label>
						<input type="text" class="form-control" id="addFSAlokasiIjin">
					</div>
					<div class="col-md-6">
						<label >FS Pembebasan :</label>
						<input type="text" class="form-control" id="addFSPembebasanIjin">
						<label >FS Sudah Dimatangkan :</label>
						<input type="text" class="form-control" id="addFSSudahMatangIjin">
						<label >Catatan :</label>
						<input type="text" class="form-control" id="addCatatanIjin">
						
						<label >Aktif Dlm Pembangunan :</label>
						<div >
						<input type="radio"  value="V" id="addAktifPembangunanIjin1" name="addAktifPembangunanIjin">Yes
						<input type="radio"  value="-" checked id="addAktifPembangunanIjin2" name="addAktifPembangunanIjin">No
						</div>
						
						<label >Aktif Berhenti :</label>
						<div>
						<input type="radio" value="V" id="addAktifBerhentiIjin1" name="addAktifBerhentiIjin">Yes
						<input type="radio"  value="-" checked id="addAktifBerhentiIjin2" name="addAktifBerhentiIjin">No
						</div>

						<label >Aktif Sudah Selesai :</label>
						<div>
						<input type="radio"  value="V" id="addAktifSelesaiIjin1"  name="addAktifSelesaiIjin">Yes
						<input type="radio"  value="-" checked id="addAktifSelesaiIjin2" name="addAktifSelesaiIjin">No
						</div>

						<label >Tidak Aktif :</label>
						<div>
						<input type="radio" value="V"  id="addTidakAktifIjin1" name="addTidakAktifIjin">Yes
						<input type="radio" value="-"  checked id="addTidakAktifIjin2" name="addTidakAktifIjin">No
						
						</div>

					</div>
				</div>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveAdd" class="btn btn-primary">Tambah Perumahan</button>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="form-group" style="display:none";>
		
		<input type="text" class="form-control" id="addRencRSS">		
		<input type="text" class="form-control" id="addRencRS">	
		<input type="text" class="form-control" id="addRencRM">
		<input type="text" class="form-control" id="addRencMW">
		<input type="text" class="form-control" id="addRencRuko">
		<input type="text" class="form-control" id="addRealRSS">
		<input type="text" class="form-control" id="addRealRS">
		<input type="text" class="form-control" id="addRealRM">
		<input type="text" class="form-control" id="addRealMW">
		<input type="text" class="form-control" id="addRealRuko">
		<input type="text" class="form-control" id="addCatatan">
		<input type="text" class="form-control" id="addLokasi">
		<input type="text" class="form-control" id="addKombinasi">
	</div>
	
	
	
	<script>
		$(document).ready(function () {
			$("#delSuccess").hide();
			$("#addSuccess").hide();
			$("#editSuccess").hide();

			$('#dataTable').DataTable({
				"scrollx": true
			});

			$('#addgenreBtn').click(function(e) {
				var row="<li class='list-group-item text-danger' id='"+$("#addNamaLokasi option:selected").val()+"''>\
													"+$("#addNamaLokasi option:selected").text()+"\
													<a href='#' class='pull-right hapusLokasi'>\
														<i class='fa fa-times'></i>\
													</a>\
											</li>";
				if($("li#"+$("#addNamaLokasi option:selected").val()).length==0)
					$("#lokasis").append(row);
			});

			

			

			$('#importBtn').click(function(e) {
				

				
				$('#tahunOpt')
			    .find('option')
			    .remove()
			    .end();
			    $('#periodeOpt')
			    .find('option')
			    .remove()
			    .end();
			    $('#perumahanOpt')
			    .find('option')
			    .remove()
			    .end();


				var htmlTahun= '<option disabled selected>Tahun</option>';
				var htmlPeriode= '<option disabled selected>Periode</option>';
				var htmlPerumahan= '<option disabled selected>Perumahan</option>';
				var tahun="<?php echo $this->session->userdata('logged_in')['tahun']; ?>";
				
				for (var i =tahun-5;i<tahun;i++) {
				    htmlTahun += '<option value="' + i + '">' + i + '</option>';
				} 
				for(var i=1;i<5;i++)
				{
					htmlPeriode += '<option value="' + i + '">' + i + '</option>';
				}

				                  
				$('#tahunOpt').append(htmlTahun);
				$('#tahunOpt').toggle();
				$('#periodeOpt').append(htmlPeriode);
				$('#periodeOpt').toggle();
				$('#perumahanOpt').append(htmlPerumahan);
				$('#perumahanOpt').toggle();
			});

			var dataresult;
			function get_json()
			{
				var htmlPerumahan= '<option disabled selected>Perumahan</option>';
				$.ajax({
					dataType: "json",
					type:'GET',
					data:{
						"tahun": $('#tahunOpt').val(),
						"periode": $('#periodeOpt').val()
					},
					url: "<?php echo site_url() ?>perumahan/get_json",
					
					success: function(results) {
						//console.log(JSON.stringify(results));
						dataresult=results;
						

						for(var i = 0; i < dataresult.length; i++) {
						    var obj = dataresult[i];
						    htmlPerumahan += '<option value="' + obj.id_perumahan + '">' + obj.nama_perumahan + '</option>';


						}
						$('#perumahanOpt').append(htmlPerumahan);

					}
				});
			}
			$('#tahunOpt').change(function(){
				
				$('#perumahanOpt')
			    .find('option')
			    .remove()
			    .end();
			    
			    
			    get_json();
				
				
			});
		


			$('#periodeOpt').change(function(){
				$('#perumahanOpt')
			    .find('option')
			    .remove()
			    .end();
			    get_json();
			});


			$('#addTglIjin').datetimepicker({
				
			});
			
			
			
			function resetInput(){
				$('#addNamaPerumahan').val("");
			    $('#addNamaPengembang').val("");
			    $('#addNamaLokasi').val("");
			    $('#addNoIjin').val("");
			    $('#addTglIjin').val("");
			    $('#addRencanaTapakIjin').val("");
			    $('#addPembebasanIjin').val("");
			    $('#addTerbangunIjin').val("");
			    $('#addBelumTerbangunIjin').val("");
			    $('#addFSAlokasiIjin').val("");
			    $('#addFSPembebasanIjin').val("");
			    $('#addPembebasanIjin').val("");
			    $('#addFSSudahMatangIjin').val("");
			    $('#addCatatanIjin').val("");
			    $('#addAktifPembangunanIjin').val("");
			    $('#addAktifBerhentiIjin').val("");
			    $('#addAktifSelesaiIjin').val("");
			    $('#addTidakAktifIjin').val("");
			    $('#addLuasIjin').val("");
			}

			$('#perumahanOpt').change(function(){
				resetInput();
				$.ajax({
					dataType: "json",
					type:'GET',
					data:{
						"tahun": $('#tahunOpt').val(),
						"periode": $('#periodeOpt').val(),
						"id_perumahan": $('#perumahanOpt').val()
					},
					url: "<?php echo site_url() ?>perumahan/get_ijin",
					
					success: function(results) {
						//console.log(JSON.stringify(results));
						var dataresult=results;
						for(var i = 0; i < dataresult.length; i++) {
						    var obj = dataresult[i];
						    //htmlPerumahan += '<option value="' + obj.id_perumahan + '">' + obj.nama_perumahan + '</option>';
						    $('#addNamaPerumahan').val(obj.nama_perumahan);
						    $('#addNamaPengembang').val(obj.id_perusahaan);
						    $('#addNamaLokasi').val(obj.id_lokasi);
						    $('#addNoIjin').val(obj.lokasi_no);
						    $('#addTglIjin').val(obj.lokasi_tgl);
						    $('#addRencanaTapakIjin').val(obj.rencana_tapak);
						    $('#addPembebasanIjin').val(obj.Pembebasan);
						    $('#addTerbangunIjin').val(obj.terbangun);
						    $('#addBelumTerbangunIjin').val(obj.belum_terbangun);
						    $('#addFSAlokasiIjin').val(obj.fs_dialokasikan);
						    $('#addFSPembebasanIjin').val(obj.fs_pembebasan);
						    $('#addPembebasanIjin').val(obj.pembebasan);
						    $('#addFSSudahMatangIjin').val(obj.fs_sudah_dimatangkan);
						    $('#addCatatanIjin').val(obj.catatan);
						    if((obj.aktif_dlm_pembangunan=="V" || obj.aktif_dlm_pembangunan=="v")){

						    	
						    	$("#addAktifPembangunanIjin1").prop("checked", true);
						    }
						    else $('#addAktifPembangunanIjin2').prop("checked", true);

						    if((obj.aktif_berhenti=="V" || obj.aktif_berhenti=="v")){

						    	
						    	$("#addAktifBerhentiIjin1").prop("checked", true);
						    }
						    else $('#addAktifBerhentiIjin2').prop("checked", true);

							if((obj.aktif_sdh_selesai=="V" || obj.aktif_sdh_selesai=="v")){

						    	
						    	$("#addAktifSelesaiIjin1").prop("checked", true);
						    }
						    else $('#addAktifSelesaiIjin2').prop("checked", true);

						    if((obj.tidak_aktif=="V" || obj.tidak_aktif=="v")){

						    	
						    	$("#addTidakAktifIjin1").prop("checked", true);
						    }
						    else $('#addTidakAktifIjin2').prop("checked", true);
				
						  
						    $('#addLuasIjin').val(obj.luas);
							
							$('#addKombinasi').val(obj.id_kombinasi);
							$('#addLokasi').val(obj.id_lokasi);
							$('#addRencRSS').val(obj.renc_rss);
							$('#addRencRS').val(obj.renc_rs);
							$('#addRencRM').val(obj.renc_rm);
							$('#addRencMW').val(obj.renc_mw);
							$('#addRencRuko').val(obj.renc_ruko);
							$('#addRealRSS').val(obj.real_rss);
							$('#addRealRS').val(obj.real_rs);
							$('#addRealRM').val(obj.real_rm);
							$('#addRealMW').val(obj.real_mw);
							$('#addRealRuko').val(obj.real_ruko);
							$('#addCatatan').val(obj.catatan);

						}
						//$('#perumahanOpt').append(htmlPerumahan);

					}
				});

			});


			$('#lokasis').on('click', '.hapusLokasi',function(e) {
				$(this).parent().remove();
			});
			
			$("#dataTable").on("click", ".del_btn", function(e) {
				e.preventDefault();
				$.ajax({
					url: '<?php echo site_url()?>perumahan/delete/',
					type:'GET',
					data: {
						"id": $(this)[0].id
					},
					dataType: 'html',
					success: function(results) {
						console.log(JSON.stringify(results));
						$("#page_container").html(results);
						$("#delSuccess").show();
					}
				});
			});

			$('.add_btn').click(function(e) {
				e.preventDefault();
				var temp = $(".hapusLokasi");
				for (var i = 0; i < temp.length; i++) $(temp[i]).click();
				$("#AddModal").modal("show");
			});

			$("#dataTable").on("click", ".edit_btn", function(e) {
				e.preventDefault();
				var name = $(this).parent().prev().prev().prev().html();
				var id = $(this).attr('id');
				var pengembang = $(this).parent().prev().prev().html();

				$('#editNamaPerumahan').val(name);
				$('#editNamaPengembang').val(pengembang);
				$('#perumahanID').val(id);
				$('#EditModal').modal('show');
			});

			$("#saveAdd").click(function(e){
				// var temp = $("#lokasis").children();
				// var id_lokasis = "";
				// for (var i = 0; i < temp.length; i++) id_lokasis += ($(temp[i]).attr("id") + " ");
				// id_lokasis = id_lokasis.slice(0, -1);

				if($('#tahunOpt').val()!=null && $('#periodeOpt').val()!=null && $('#perumahanOpt').val()!=null)
				{
					var datas = {
						"nama_perumahan": $("#addNamaPerumahan").val(),
						"lokasi": $("#addNamaLokasi").val(),
						"id_pengembang": $("#addNamaPengembang").val(),
						"addNoIjin": $("#addNoIjin").val(),
						"addTglIjin": $("#addTglIjin").val(),
						"addLuasIjin": $("#addLuasIjin").val(),
						"addRencanaTapakIjin": $("#addRencanaTapakIjin").val(),
						"addPembebasanIjin": $("#addPembebasanIjin").val(),
						"addTerbangunIjin": $("#addTerbangunIjin").val(),
						"addBelumTerbangunIjin": $("#addBelumTerbangunIjin").val(),
						"addFSAlokasiIjin": $("#addFSAlokasiIjin").val(),
						"addFSPembebasanIjin": $("#addFSPembebasanIjin").val(),
						"addFSSudahMatangIjin": $("#addFSSudahMatangIjin").val(),
						"addCatatanIjin": $("#addCatatanIjin").val(),
						"addAktifPembangunanIjin": $('[name="addAktifPembangunanIjin"]:radio:checked').val(),
						"addAktifBerhentiIjin": $('[name="addAktifBerhentiIjin"]:radio:checked').val(),
						"addAktifSelesaiIjin": $('[name="addAktifSelesaiIjin"]:radio:checked').val(),
						"addTidakAktifIjin": $('[name="addTidakAktifIjin"]:radio:checked').val(),
						

						
						"id_perumahan" : $('#perumahanOpt').val(),
						"id_kombinasi" : $('#addKombinasi').val(),
						"id_lokasi" : $('#addLokasi').val(),
						"renc_rss": $('#addRencRSS').val(),
						"renc_rs": $('#addRencRS').val(),
						"renc_rm": $('#addRencRM').val(),
						"renc_mw": $('#addRencMW').val(),
						"renc_ruko": $('#addRencRuko').val(),
						"real_rss": $('#addRealRSS').val(),
						"real_rs": $('#addRealRS').val(),
						"real_rm": $('#addRealRM').val(),
						"real_mw": $('#addRealMW').val(),
						"real_ruko": $('#addRealRuko').val(),
						"catatan": $('#addCatatan').val()
					};
					$.ajax({
						url: '<?php echo site_url(); ?>perumahan/add/?mode=import',
						type: 'GET',
						data: datas,
						dataType: 'html',
						success: function(results){
							$("#AddModal").modal('hide');
							$("#page_container").html(results);
							$("#addSuccess").show();
						}
					});		
				}
				else
				{
					var datas = {
						"nama_perumahan": $("#addNamaPerumahan").val(),
						"lokasi": $("#addNamaLokasi").val(),
						"id_pengembang": $("#addNamaPengembang").val(),
						"addNoIjin": $("#addNoIjin").val(),
						"addTglIjin": $("#addTglIjin").val(),
						"addLuasIjin": $("#addLuasIjin").val(),
						"addRencanaTapakIjin": $("#addRencanaTapakIjin").val(),
						"addPembebasanIjin": $("#addPembebasanIjin").val(),
						"addTerbangunIjin": $("#addTerbangunIjin").val(),
						"addBelumTerbangunIjin": $("#addBelumTerbangunIjin").val(),
						"addFSAlokasiIjin": $("#addFSAlokasiIjin").val(),
						"addFSPembebasanIjin": $("#addFSPembebasanIjin").val(),
						"addFSSudahMatangIjin": $("#addFSSudahMatangIjin").val(),
						"addCatatanIjin": $("#addCatatanIjin").val(),
						"addAktifPembangunanIjin": $('[name="addAktifPembangunanIjin"]:radio:checked').val(),
						"addAktifBerhentiIjin": $('[name="addAktifBerhentiIjin"]:radio:checked').val(),
						"addAktifSelesaiIjin": $('[name="addAktifSelesaiIjin"]:radio:checked').val(),
						"addTidakAktifIjin": $('[name="addTidakAktifIjin"]:radio:checked').val(),
					};
					$.ajax({
						url: '<?php echo site_url(); ?>perumahan/add/',
						type: 'GET',
						data: datas,
						dataType: 'html',
						success: function(results){
							$("#AddModal").modal('hide');
							$("#page_container").html(results);
							$("#addSuccess").show();
						}
					});	
				}
				
			});
				
			$('#saveEdit').click(function(e) {
				e.preventDefault();
				$.ajax({
					url: '<?php echo site_url()?>perumahan/edit/',
					type:'GET',
					data: {
						"id": $('#perumahanID').val(),
						"nama_perumahan": $("#editNamaPerumahan").val()
					},
					dataType: 'html',
					success: function(results) {
						console.log(JSON.stringify(results));
						$('#EditModal').modal('hide');
						$("#page_container").html(results);
						$("#editSuccess").show();
					}
				});
			});
		});
	</script>

		
