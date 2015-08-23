<div id="page_container">
		<div id="page-wrapper">
					
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h3 class="page-header h3" id="title">Detail Proyek</h3>
				</div>
				<!-- /.col-lg-12 -->
			</div>            
			<div class ="row">
				<div class ="col-lg-12">                   
					<div class ="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-info-circle"></i> Info
						</div>
						<div class="panel-body">
							<div class = "col-md-12">
								<div class ="table">
									<table id="infoTable" class="table borderless"> 
											<tr>
												<td class="col-md-3">Lokasi</td>
												<td> : </td>
												<td><?php echo $info['nama_lokasi'] ?></td>
											</tr>
											<tr>
												<td class="col-md-3">Perusahaan Konstruksi</td>
												<td> : </td>
												<td><?php echo $info['nama_perusahaan'] ?></td>
											</tr>
											<tr>
												<td class="col-md-3">Nama Perumahan</td>
												<td> : </td>
												<td><?php echo $info['nama_perumahan'] ?></td>
											</tr>
									</table>
								<!-- /.table -->
							</div>
							<!--info column-->
						</div>
						<!--panel body-->
					</div>
				</div>

					<!-- /.panelinfo -->
					<div id="addSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Added
					</div>
					 <div id="delSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Deleted
					</div>
					 <div id="editSuccess" class="alert alert-success" style="display:none";>
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Success!</strong> Data has been succesfully Edited
					</div>
					<!-- /.success notification-->
					<div class="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Detil Ijin
							<div class="pull-right">
								<a href="#" id="add_btn_ijin"><i class="fa fa-plus-circle fa-2x" style="color:white;"></i></a>
							</div>
						</div>
						<div class="panel-body scrollable">
							<p id="idPerumahan" class="hidden"><?php echo $info['id_perumahan']?></p>
							<style type="text/css">
								.search-table-outter { overflow-x: scroll; }
								
							</style>
							<table id="ijinTable" class="table table-striped table-bordered"> 
									<thead>
										<tr>
											<th style="min-width: 100px;">Action</th>
											<th style="min-width: 160px;">Tanggal Ijin</th>
											<th style="min-width: 200px;">Nama Kecamatan</th>
											<th style="min-width: 200px;">Nama Perusahaan</th>
											<th style="min-width: 200px;">Nama Perumahan</th>
											<th style="min-width: 200px;">Nama Lokasi</th>
											<th style="min-width: 200px;">Nomor Ijin</th>
											
											<th style="min-width: 200px;">Luas</th>
											<th style="min-width: 200px;">Rencana Tapak</th>
											<th style="min-width: 200px;">Pembebasan</th>
											<th style="min-width: 200px;">Terbangun</th>
											<th style="min-width: 200px;">Belum Terbangun</th>
											<th style="min-width: 200px;">FS Dialokasikan</th>
											<th style="min-width: 200px;">FS Pembebasan</th>
											<th style="min-width: 200px;">FS Sudah dimatangkan</th>
											
											<th style="min-width: 250px;">Aktif Dalam Pembangunan</th>
											<th style="min-width: 200px;">Aktif Berhenti</th>
											<th style="min-width: 200px;">Aktif Sudah Selesai</th>
											<th style="min-width: 200px;">Tidak Aktif</th>
											<th style="min-width: 200px;">Catatan</th>
										</tr>
								</thead>
								<tbody>

									 <?php foreach ($ijin as $i)
									 {

										echo '<tr>';
											
											?>

											<td style="min-width: 100px;">
													<a class ='edit_btn_ijin' href='#' id='<?php echo $i['id_ijin']?>'><i class='fa fa-edit fa-2x'></i></a>
													<a class ='del_btn_ijin' href='#' id='<?php echo $i['id_ijin']?>'><i class='fa fa-trash fa-2x'></i></a>
											</td>
									<?php  
											echo '<td >'.$i['lokasi_tgl'].'</td>';
											echo '<td  id="namaKec">'.$i['nama_kecamatan'].'</td>';
											echo '<td  id="namaPerusahaan">'.$i['nama_perusahaan'].'</td>';
											echo '<td  id="namaPerumahan">'.$i['nama_perumahan'].'</td>';
											echo '<td id="namaLokasi">'.$i['nama_lokasi'].'</td>';
											echo '<td>'.$i['lokasi_no'].'</td>';
											
											echo '<td>'.$i['luas'].'</td>';
											echo '<td>'.$i['rencana_tapak'].'</td>';
											echo '<td>'.$i['pembebasan'].'</td>';
											echo '<td>'.$i['terbangun'].'</td>';
											echo '<td>'.$i['belum_terbangun'].'</td>';
											echo '<td>'.$i['fs_dialokasikan'].'</td>';
											echo '<td>'.$i['fs_pembebasan'].'</td>';
											echo '<td>'.$i['fs_sudah_dimatangkan'].'</td>';
											
											echo '<td>'.$i['aktif_dlm_pembangunan'].'</td>';
											echo '<td>'.$i['aktif_berhenti'].'</td>';
											echo '<td>'.$i['aktif_sdh_selesai'].'</td>';
											echo '<td>'.$i['tidak_aktif'].'</td>';
											echo '<td>'.$i['catatan'].'</td>';
											echo '</tr>';

									 }?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Progress Pembangunan
							<div class="pull-right">
								<a href="#" id="add_btn_pembangunan"><i class="fa fa-plus-circle fa-2x" style="color:white;"></i></a>
							</div>
						</div>
						<div class="panel-body scrollable">
							<table id="pembangunanTable" class="table table-striped table-bordered"> 
								<thead>
									<tr>
										<th style="min-width: 100px;">Action</th>
										<th style="min-width: 100px;" >Tahun</th>
										<th style="min-width: 100px;">Triwulan</th>
										<th style="min-width: 200px;">Nama Kecamatan</th>
										<th style="min-width: 200px;">Nama Perusahaan</th>
										<th style="min-width: 200px;">Nama Perumahan</th>
										<th style="min-width: 200px;">Nama Lokasi</th>
										<th style="min-width: 200px;">Rencana RSS</th>
										<th style="min-width: 200px;">Rencana RS</th>
										<th style="min-width: 200px;">Rencana RM</th>
										<th style="min-width: 200px;">Rencana MW</th>
										<th style="min-width: 200px;">Rencana Ruko</th>
										<th style="min-width: 200px;">Real RSS</th>
										<th style="min-width: 200px;">Real RS</th>
										<th style="min-width: 200px;">Real RM</th>
										<th style="min-width: 200px;">Real MW</th>
										<th style="min-width: 200px;">Real Ruko</th>
										<th style="min-width: 200px;">Catatan</th>
									</tr>
								</thead>
								<tbody>
									 <?php foreach ($pembangunan as $p)
									 {
										echo '<tr>';
										?>
											<td style="min-width: 100px;">
													<a class ='edit_btn_pem' href='#' id='<?php echo $p['id_pembangunan']?>'><i class='fa fa-edit fa-2x'></i></a>
													<a class ='del_btn_pem' href='#' id='<?php echo $p['id_pembangunan']?>'><i class='fa fa-trash fa-2x'></i></a>
											</td>
										<?php  
											echo '<td id="tahunPem">'.$p['tahun'].'</td>';
											echo '<td id="periodePem">'.$p['triwulan'].'</td>';
											echo '<td>'.$p['nama_kecamatan'].'</td>';
											echo '<td>'.$p['nama_perusahaan'].'</td>';
											echo '<td>'.$p['nama_perumahan'].'</td>';
											echo '<td>'.$p['nama_lokasi'].'</td>';
											echo '<td>'.$p['renc_rss'].'</td>';
											echo '<td>'.$p['renc_rs'].'</td>';
											echo '<td>'.$p['renc_rm'].'</td>';
											echo '<td>'.$p['renc_mw'].'</td>';
											echo '<td>'.$p['renc_ruko'].'</td>';
											echo '<td>'.$p['real_rss'].'</td>';
											echo '<td>'.$p['real_rs'].'</td>';
											echo '<td>'.$p['real_rm'].'</td>';
											echo '<td>'.$p['real_mw'].'</td>';
											echo '<td>'.$p['real_ruko'].'</td>';
											echo '<td>'.$p['catatan'].'</td>';

										echo '</tr>';

									 }?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Berkas Terkait
						</div>
						<div class="panel-body">
						 <div id="uploadSuccess" class="alert alert-success hidden">
							<a href="#" class="close" >&times;</a>
							<strong>Sukses!</strong>Data berhasil diupload
						</div>
						 <div id="uploadFailed" class="alert alert-danger hidden">
							<a href="#" class="close" >&times;</a>
							<strong>Gagal!</strong> Data gagal diupload
						</div>
							<table id="pembangunanTable" class="table borderless"> 
								<thead>
									<tr>
										<th>Nama File</th>
									</tr>
								</thead>
								<tbody id="isiBerkas">
									<?php foreach ($files as $i) {?>
									<?php $b = explode("/", $i['alamat_berkas']); ?>
									<tr class="odd gradeX">
										<td><a href="<?php echo $i['alamat_berkas']?>"><?php echo $b[count($b) - 1]?></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<form method="post" action="" id="upload_file">
							<input type="file" name="userfile" size="20" id="userfile"  />
							<br /><br />
							<div id="progress"></div>
							<input type="submit" value="upload" class="btn btn-primary" />
							</form>
						</div>
					</div>
				<!--col-->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->
	</div>

	<div class="modal fade " id="AddModal_ijin" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="AddModalLabel">Tambahkan</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" id="idIjin"/>
							<input type="hidden" id="idPem"/>
							<label >No. Ijin :</label>
							<input type="text" class="form-control" id="addNoIjin">	
							<label >Tanggal Ijin :</label>
							<input type="text" class="form-control TglIjin" data-date-format="YYYY-MM-DD hh:mm:ss" id="addTglIjin" >	
							<label >Luas :</label>
							<input type="text" class="form-control" id="addLuas">
							<label >Rencana Tapak :</label>
							<input type="text" class="form-control" id="addRencTapak">
							<label >Pembebasan :</label>
							<input type="text" class="form-control" id="addPembebasan">
							<label >Terbangun :</label>
							<input type="text" class="form-control" id="addTerbangun">
							<label >Belum terbangun :</label>
							<input type="text" class="form-control" id="addBlmTerbangun">
							<label >FS Dialokasikan :</label>
							<input type="text" class="form-control" id="addFsAlokasi">
							
						</div>
						<div class="col-md-6">
							<label >FS Pembebasan :</label>
							<input type="text" class="form-control" id="addFsPembebasan">
							<label >FS Sudah Dimatangkan :</label>
							<input type="text" class="form-control" id="addFsDimatangkan">
							<label >Catatan :</label>
							<input type="text" class="form-control" id="addCatatan">
							<label >Aktif Dalam Pembangunan:</label>
							<br />
							<input type="radio" name="AktifPembangunan" value="V">Ya</input>
							<input type="radio" name="AktifPembangunan" checked value="-">Tidak</input>
							<br />
							<label >Aktif Berhenti :</label>
							<br />
							<input type="radio" name="AktifBerhenti" value="V">Ya</input>
							<input type="radio" name="AktifBerhenti" checked value="-">Tidak</input>
							<br />						
							<label >Aktif Sudah Selesai :</label>
							<br />
							<input type="radio" name="AktifSelesai" value="V">Ya</input>
							<input type="radio" name="AktifSelesai" checked value="-">Tidak</input>
							<br />
							<label >Tidak Aktif :</label>
							<br />
							<input type="radio" name="tidakAktif" value="V">Ya</input>
							<input type="radio" name="tidakAktif" checked value="-">Tidak</input>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveAdd_ijin" class="btn btn-primary">Tambahkan</button>
				</div>
			</div>
		 </div>
	</div>
</div>
<!-- EDIT MODAL -->
	<div class="modal fade " id="EditModal_ijin" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="EditModalLabel">Sunting</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label >No. Ijin :</label>
						<input type="text" class="form-control" id="editNoIjin">	
						<label >Tanggal Ijin :</label>
						<input type="text" class="form-control TglIjin datepicker" id="editTglIjin" data-date-format="YYYY-MM-DD hh:mm:ss">	
						<label >Luas :</label>
						<input type="text" class="form-control" id="editLuas">
						<label >Rencana Tapak :</label>
						<input type="text" class="form-control" id="editRencTapak">
						<label >Pembebasan :</label>
						<input type="text" class="form-control" id="editPembebasan">
						<label >Terbangun :</label>
						<input type="text" class="form-control" id="editTerbangun">
						<label >Belum terbangun :</label>
						<input type="text" class="form-control" id="editBlmTerbangun">
						<label >FS Dialokasikan :</label>
						<input type="text" class="form-control" id="editFsAlokasi">
						<label >FS Pembebasan :</label>
						<input type="text" class="form-control" id="editFsPembebasan">
						<label >FS Sudah Dimatangkan :</label>
						<input type="text" class="form-control" id="editFsDimatangkan">
						<label >Catatan :</label>
						<input type="text" class="form-control" id="editCatatan">
						<label >Aktif Dalam Pembangunan :</label>
						<input type="radio" name="editAktifPembangunan" id="editAktifPembangunan1" value="V">Ya</input>
						<input type="radio" name="editAktifPembangunan" id="editAktifPembangunan2" value="-">Tidak</input>
						<br />
						<label >Aktif Berhenti :</label>
						<input type="radio" name="editAktifBerhenti" id="editAktifBerhenti1" value="V">Ya</input>
						<input type="radio" name="editAktifBerhenti" id="editAktifBerhenti2" value="-">Tidak</input>
						<br />						
						<label >Aktif Sudah Selesai :</label>
						<input type="radio" name="editAktifSelesai" id="editAktifSelesai1" value="V">Ya</input>
						<input type="radio" name="editAktifSelesai" id="editAktifSelesai2" value="-">Tidak</input>
						<br />
						<label >Tidak Aktif :</label>
						<input type="radio" name="edittidakAktif" id="edittidakAktif1" value="V">Ya</input>
						<input type="radio" name="edittidakAktif" id="edittidakAktif2" value="-">Tidak</input>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveEdit_ijin" class="btn btn-primary">Simpan</button>

					</div>
				</div>
			 </div>
		</div>
	</div>
<!-- Delete MODAL -->
	<div class="modal fade " id="DeleteModal_ijin" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					
				</div>
				<div class="modal-body">
					<h2>Anda yakin akan menghapus ?</h2>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="button" id="Hapus_ijin" class="btn btn-primary">Hapus</button>

					</div>
				</div>
			 </div>
		</div>
	</div>
	<div class="modal fade " id="DeleteModal_pem" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					
				</div>
				<div class="modal-body">
					<h2>Anda yakin akan menghapus ?</h2>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<button type="button" id="Hapus_pem" class="btn btn-primary">Hapus</button>

					</div>
				</div>
			 </div>
		</div>
	</div>
	<div class="modal fade " id="AddModal_pembangunan" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="AddModalLabel">Tambahkan</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label >Rencana RSS :</label>
						<input type="text" class="form-control" id="addRencRSS">	
						<label >Rencana RS :</label>
						<input type="text" class="form-control" id="addRencRS">	
						<label >Rencana RM :</label>
						<input type="text" class="form-control" id="addRencRM">
						<label >Rencana MW :</label>
						<input type="text" class="form-control" id="addRencMW">
						<label >Rencana Ruko :</label>
						<input type="text" class="form-control" id="addRencRuko">
						<label >Real RSS :</label>
						<input type="text" class="form-control" id="addRealRSS">
						<label >Real RS :</label>
						<input type="text" class="form-control" id="addRealRS">
						<label >Real RM :</label>
						<input type="text" class="form-control" id="addRealRM">
						<label >Real MW :</label>
						<input type="text" class="form-control" id="addRealMW">
						<label >Real Ruko :</label>
						<input type="text" class="form-control" id="addRealRuko">
						<label >Catatan :</label>
						<input type="text" class="form-control" id="addCatatanpem">
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveAdd_pembangunan" class="btn btn-primary">Tambahkan</button>
				</div>
			</div>
		 </div>
	</div>
</div>
<div class="modal fade " id="EditModal_pembangunan" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
					<h4 class="modal-title" id="EditModalLabel">Ubah</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label >Rencana RSS :</label>
						<input type="text" class="form-control" id="editRencRSS">	
						<label >Rencana RS :</label>
						<input type="text" class="form-control" id="editRencRS">	
						<label >Rencana RM :</label>
						<input type="text" class="form-control" id="editRencRM">
						<label >Rencana MW :</label>
						<input type="text" class="form-control" id="editRencMW">
						<label >Rencana Ruko :</label>
						<input type="text" class="form-control" id="editRencRuko">
						<label >Real RSS :</label>
						<input type="text" class="form-control" id="editRealRSS">
						<label >Real RS :</label>
						<input type="text" class="form-control" id="editRealRS">
						<label >Real RM :</label>
						<input type="text" class="form-control" id="editRealRM">
						<label >Real MW :</label>
						<input type="text" class="form-control" id="editRealMW">
						<label >Real Ruko :</label>
						<input type="text" class="form-control" id="editRealRuko">
						<label >Catatan :</label>
						<input type="text" class="form-control" id="editCatatanpem">
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					<button type="button" id="saveEdit_pembangunan" class="btn btn-primary">Tambahkan</button>
				</div>
			</div>
		 </div>
	</div>
</div>

		<script>


			$(document).ready(function () {
				var row;	
				//$('#uploadSuccess').hide();
				//$('#uploadFailed').hide();
				$('#pembangunanTable').dataTable( {
						"scrollX": true
					} );				
				$('#ijinTable').dataTable( {
						"scrollX": true
					} );					
					//$('#dataTable').DataTable();

				$('#DescCollapseBtn').click(function(e)
							{
								e.preventDefault();
								$('#Desc').collapse('toggle');
							});


				$('#add_btn_pembangunan').click(function(e)
							{
								e.preventDefault();
								$('#AddModal_pembangunan').modal('show');
							});
				$('#add_btn_ijin').click(function(e)
							{
								e.preventDefault();
								$('#AddModal_ijin').modal('show');
							});
				$("#ijinTable").on("click", ".edit_btn_ijin", function(e) {
				//$('.edit_btn_ijin').click(function(e) {
					e.preventDefault();
					var noijin = $(this).parent().next().next().next().next().next().next().html();
					var tglijin = $(this).parent().next().html();
					var luas = $(this).parent().next().next().next().next().next().next().next().html();
					var tapak = $(this).parent().next().next().next().next().next().next().next().next().html();
					var pembebasan = $(this).parent().next().next().next().next().next().next().next().next().next().html();
					var terbangun = $(this).parent().next().next().next().next().next().next().next().next().next().next().html();
					var blmterbangun=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().html();
					var fsAlokasi=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var fsPembebasan=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var fsDimatangkan=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var catatan=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var aktifpem=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var aktif_berhenti=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var aktif_selesai=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var tidak_aktif=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var id= $(this).attr("id");

					$('#idIjin').val(id);
					$('#editNoIjin').val(noijin);
					$('#editTglIjin').val(tglijin);

					$('#editLuas').val(luas);
					
					$('#editRencTapak').val(tapak);
					$('#editPembebasan').val(pembebasan);
					$('#editTerbangun').val(terbangun);
					$('#editBlmTerbangun').val(blmterbangun);
					$('#editFsAlokasi').val(fsAlokasi);
					$('#editFsPembebasan').val(fsPembebasan);
					$('#editFsDimatangkan').val(fsDimatangkan);
					$('#editCatatan').val(catatan);
					if (aktifpem=="V" || aktifpem=="v") {
						$("#editAktifPembangunan1").prop("checked", true);
					}
					else $('#editAktifPembangunan2').prop("checked", true);
					
					if (aktif_berhenti=="V" || aktif_berhenti=="v") {
						$("#editAktifBerhenti1").prop("checked", true);
					}
					else $('#editAktifBerhenti2').prop("checked", true);

					if (aktif_selesai=="V" || aktif_selesai=="v") {
						$("#editAktifSelesai1").prop("checked", true);
					}
					else $('#editAktifSelesai2').prop("checked", true);

					if (tidak_aktif=="V" || tidak_aktif=="v") {
						$("#edittidakAktif1").prop("checked", true);
					}
					else $('#edittidakAktif2').prop("checked", true);
					row=$(this).parent().parent();
					$('#EditModal_ijin').modal('show');
				});

				$("#ijinTable").on("click", ".del_btn_ijin", function(e) {
				//$('.del_btn_ijin').click(function(e){
					e.preventDefault();
					var id= $(this).attr("id");
					row=$(this).parent().parent();
					$('#idIjin').val(id);
					$('#DeleteModal_ijin').modal('show');

				});

				$('.TglIjin').datetimepicker({
					
				});

				$('#Hapus_ijin').click(function(e){

					$.ajax({
						url: '<?php echo site_url()?>detil_proyek/delete_ijin/'+$("#idPerumahan").text(),
						type:'GET',
						data: {
							"id": $('#idIjin').val()
						},
						dataType: 'html',
						success: function(results) {
							
							//$("#page_container").html(results);
							console.log($('#idIjin').val());
							$("#delSuccess").show();
							row.fadeOut('slow',function(){$(this).remove();});
							$('#DeleteModal_ijin').modal('hide');
							// $('html,body').animate({scrollTop:0},0);
						}
					});
				});

				$('#saveEdit_ijin').click(function(e) {
						var table=$('#ijinTable').DataTable();
						$.ajax({
							url: '<?php echo site_url()?>detil_proyek/edit_ijin/'+$("#idPerumahan").text(),
							type:'GET',
							data: {
								"id_ijin": $('#idIjin').val(),
								"no_ijin" : $('#editNoIjin').val(),
								"tgl_ijin" : $('#editTglIjin').val(),

								"luas" : $('#editLuas').val(),
								
								"tapak" : $('#editRencTapak').val(),
								"pembebasan" :$('#editPembebasan').val(),
								"terbangun" :$('#editTerbangun').val(),
								"belum_terbangun" :$('#editBlmTerbangun').val(),
								"fs_dialokasikan" :$('#editFsAlokasi').val(),
								"fs_pembebasan" :$('#editFsPembebasan').val(),
								"fs_dimatangkan" :$('#editFsDimatangkan').val(),
								"catatan" :$('#editCatatan').val(),
								"AktifPembangunan": $('[name="editAktifPembangunan"]:radio:checked').val(),
								"AktifBerhenti": $('[name="editAktifBerhenti"]:radio:checked').val(),
								"AktifSelesai": $('[name="editAktifSelesai"]:radio:checked').val(),
								"tidak_aktif": $('[name="edittidakAktif"]:radio:checked').val()
							},
							dataType: 'html',
							success: function(results) {
								console.log(JSON.stringify(results));
								$('#EditModal_ijin').modal('hide');
								//$("#page_container").html(results);
								$("#editSuccess").show();
								var Action=	"<a class =\"edit_btn_ijin\" href=\"#\" id=\""+$('#idIjin').val()+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn_ijin\" href=\"#\" id=\""+$('#idIjin').val()+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
								row.fadeOut('fast',function(){$(this).remove();});
								table.row.add([Action,$('#editTglIjin').val(),
									$('#namaKec').text(),$('#namaPerusahaan').text(),
									$('#namaPerumahan').text(),$('#namaLokasi').text(),
								 	 $('#editNoIjin').val(),$('#editLuas').val(),
								 	 $('#editRencTapak').val(),$('#editPembebasan').val(),
								 	$('#editTerbangun').val(),$('#editBlmTerbangun').val(),
								 	$('#editFsAlokasi').val(),$('#editFsPembebasan').val(),
								 	$('#editFsDimatangkan').val(),
								 	$('[name="editAktifPembangunan"]:radio:checked').val(),
								 	$('[name="editAktifBerhenti"]:radio:checked').val(),
								 	 $('[name="editAktifSelesai"]:radio:checked').val(),
								 	  $('[name="edittidakAktif"]:radio:checked').val(),$('#editCatatan').val()]
								 	  ).draw().node();
								
							}
						});
				});
				
				 $(".close").click(function(e)
				 {
					e.preventDefault();
					$(this).parent().addClass("hidden");

				 })

				 $('#upload_file').submit(function(e) {
					e.preventDefault();
					var loading = '<img src="<?php echo base_url()?>assets/img/loading.gif" style="height:75px; width:75px;"></img><br /><p>Sedang mengupload file</p>'
					$("#progress").html(loading);
					$.ajaxFileUpload({
						url 			: '<?php echo site_url()?>upload/do_upload/'+$("#idPerumahan").text(), 
						secureuri		:false,
						fileElementId	:'userfile',
						dataType		: 'json',
						success	: function (data)
						{
							$("#progress").html("");
							$("#isiBerkas").html("");
							$.ajax(
							{
								url 	: '<?php echo site_url()?>detil_proyek/refresh_berkas/'+$("#idPerumahan").text(),
								dataType: 'json',
								success	: function (data)
								{
									for (var i = 0; i < data.length; i++) 
									{
										var row = $("<tr />");
										row.append('<td><a href="'+data[i].alamat_berkas+'">'+data[i].alamat_berkas+'</a></td>');
										$("#isiBerkas").append(row);
									}
								}

							});
							if(data.status == "error")
							{
								$("#uploadFailed").removeClass("hidden");
							}
							else if(data.status == "success")
							{
								$("#uploadSuccess").removeClass("hidden");
							}
						}
					});
					return false;					
				});

			
				$("#saveAdd_ijin").click(function(e){
					var data= {
						"id_perumahan" : <?php echo $info["id_perumahan"]?>,
						"id_kombinasi" : <?php echo $info["id_kombinasi"]?>,
						"lokasi_no": $('#addNoIjin').val(),
						"lokasi_tgl": $('#addTglIjin').val(),
						"luas": $('#addLuas').val(),
						"rencana_tapak": $('#addRencTapak').val(),
						"pembebasan": $('#addPembebasan').val(),
						"terbangun": $('#addTerbangun').val(),
						"belum_terbangun": $('#addBlmTerbangun').val(),
						"fs_dialokasikan": $('#addFsPembebasan').val(),
						"fs_pembebasan": $('#addFsDimatangkan').val(),
						"fs_sudah_dimatangkan": $('#addCatatan').val(),
						"aktif_dlm_pembangunan": $("input:radio[name=AktifPembangunan]:checked").val(),
						"aktif_berhenti": $('input:radio[name=AktifBerhenti]:checked').val(),
						"aktif_sdh_selesai": $('input:radio[name=AktifSelesai]:checked').val(),
						"tidak_aktif": $('input:radio[name=tidakAktif]:checked').val()
					};
					var table=$('#ijinTable').DataTable();
					$.ajax({
						url: '<?php echo site_url(); ?>detil_proyek/tambah_ijin/'+$("#idPerumahan").text(),
						type: 'GET',
						data: data,
						dataType: 'json',
						success: function(results){
							//$("#page_container").html(results);
							$("#addSuccess").show();
							$("#AddModal_ijin").modal('hide');
							console.log(results[0].id_ijin)
							var Action=	"<a class =\"edit_btn_ijin\" href=\"#\" id=\""+results[0].id_ijin+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn_ijin\" href=\"#\" id=\""+results[0].id_ijin+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
							table.row.add([Action,$('#addTglIjin').val(),
								$('#namaKec').text(),$('#namaPerusahaan').text(),
								$('#namaPerumahan').text(),$('#namaLokasi').text(),
							 	 $('#addNoIjin').val(),$('#addLuas').val(),
							 	 $('#addRencTapak').val(),$('#addPembebasan').val(),
							 	$('#addTerbangun').val(),$('#addBlmTerbangun').val(),
							 	$('#addFsAlokasi').val(),$('#addFsPembebasan').val(),
							 	$('#addFsDimatangkan').val(),
							 	$("input:radio[name=AktifPembangunan]:checked").val(),
							 	$('input:radio[name=AktifBerhenti]:checked').val(),
							 	 $('input:radio[name=AktifSelesai]:checked').val(),
							 	  $('input:radio[name=tidakAktif]:checked').val(),$('#editCatatan').val()]
							 	  ).draw().node();
							
						}
					});
				});
				$("#pembangunanTable").on("click", ".del_btn_pem", function(e) {
				//$('.del_btn_pem').click(function(e){
					e.preventDefault();
					var id= $(this).attr("id");
					row=$(this).parent().parent();
					$('#idPem').val(id);
					$('#DeleteModal_pem').modal('show');

				});

				$('#Hapus_pem').click(function(e){

					$.ajax({
						url: '<?php echo site_url()?>detil_proyek/delete_pem/'+$("#idPerumahan").text(),
						type:'GET',
						data: {
							"id": $('#idPem').val()
						},
						dataType: 'html',
						success: function(results) {
							//$("#page_container").html(results);
							row.fadeOut('slow',function(){$(this).remove();});
							$("#delSuccess").show();
							$("#DeleteModal_pem").modal('hide');
						}
					});
				});

				$("#pembangunanTable").on("click", ".edit_btn_pem", function(e) {
				//$('.edit_btn_pem').click(function(e){
					e.preventDefault();
					var id= $(this).attr("id");
					var editRencRSS=$(this).parent().next().next().next().next().next().next().next().html();
					var editRencRS=$(this).parent().next().next().next().next().next().next().next().next().html();
					var editRencRM=$(this).parent().next().next().next().next().next().next().next().next().next().html();
					var editRencMW=$(this).parent().next().next().next().next().next().next().next().next().next().next().html();
					var editRencRuko=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().html();
					var editRealRSS=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var editRealRS=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var editRealRM=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var editRealMW=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var editRealRuko=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					var editCatatan=$(this).parent().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().next().html();
					row=$(this).parent().parent();
					$('#idPem').val(id);
					$('#editRencRSS').val(editRencRSS);
					$('#editRencRS').val(editRencRS);
					$('#editRencRM').val(editRencRM);
					$('#editRencMW').val(editRencMW);
					$('#editRencRuko').val(editRencRuko);
					$('#editRealRSS').val(editRealRSS);
					$('#editRealRS').val(editRealRS);
					$('#editRealRM').val(editRealRM);
					$('#editRealMW').val(editRealMW);
					$('#editRealRuko').val(editRealRuko);
					$('#editCatatanpem').val(editCatatan);
					$('#EditModal_pembangunan').modal('show');
				});
				$('#saveEdit_pembangunan').click(function(e){
					var table=$('#pembangunanTable').DataTable();
					$.ajax({
						url: '<?php echo site_url()?>detil_proyek/edit_pem/'+$("#idPerumahan").text(),
						type:'GET',
						data: {
							"id_pem": $('#idPem').val(),
							"renc_rss" : $('#editRencRSS').val(),
							"renc_rs" : $('#editRencRS').val(),

							"renc_rm" : $('#editRencRM').val(),
							
							"renc_mw" : $('#editRencMW').val(),
							"renc_ruko" :$('#editRencRuko').val(),
							"real_rss" :$('#editRealRSS').val(),
							"real_rs" :$('#editRealRS').val(),
							"real_rm" :$('#editRealRM').val(),
							"real_mw" :$('#editRealMW').val(),
							"real_ruko" :$('#editRealRuko').val(),
							"catatan" :$('#editCatatanpem').val()

						},
						dataType: 'html',
						success: function(results) {
							
							$('#EditModal_pembangunan').modal('hide');
							//$("#page_container").html(results);
							$("#editSuccess").show();
							var Action=	"<a class =\"edit_btn_pem\" href=\"#\" id=\""+$('#idPem').val()+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn_pem\" href=\"#\" id=\""+$('#idPem').val()+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
							row.fadeOut('fast',function(){$(this).remove();});
							table.row.add([Action,$('#tahunPem').text(),$('#periodePem').text(),
								$('#namaKec').text(),$('#namaPerusahaan').text(),
								$('#namaPerumahan').text(),$('#namaLokasi').text(),
							 	 $('#editRencRSS').val(),$('#editRencRS').val(),
							 	 $('#editRencRM').val(),$('#editRencMW').val(),
							 	$('#editRencRuko').val(),$('#editRealRSS').val(),
							 	$('#editRealRS').val(),$('#editRealRM').val(),
							 	$('#editRealMW').val(),
							 	$('#editRealRuko').val(),
							 	$('#editCatatanpem').val()]).draw().node();
							
						}
					});
				});
				$("#saveAdd_pembangunan").click(function(e){
					var data= {
						"id_perumahan" : <?php echo $info["id_perumahan"]?>,
						"id_kombinasi" : <?php echo $info["id_kombinasi"]?>,
						"id_lokasi" : <?php echo $info["id_lokasi"]?>,
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
						"catatan": $('#addCatatanpem').val(),
					};
					var table=$('#pembangunanTable').DataTable();
					$.ajax({
						url: '<?php echo site_url(); ?>detil_proyek/tambah_pembangunan/'+$("#idPerumahan").text(),
						type: 'GET',
						data: data,
						dataType: 'json',
						success: function(results){
							$("#addSuccess").show();
							$("#AddModal_pembangunan").modal('hide');
							var Action=	"<a class =\"edit_btn_pem\" href=\"#\" id=\""+results[0].id_pembangunan+"\"><i class=\"fa fa-edit fa-2x\"></i></a><a class =\"del_btn_pem\" href=\"#\" id=\""+results[0].id_pembangunan+"\"><i class=\"fa fa-trash fa-2x\"></i></a>";
							table.row.add([Action,$('#tahunPem').text(),$('#periodePem').text(),
								$('#namaKec').text(),$('#namaPerusahaan').text(),
								$('#namaPerumahan').text(),$('#namaLokasi').text(),
							 	 $('#addRencRSS').val(),$('#addRencRS').val(),
							 	 $('#addRencRM').val(),$('#addRencMW').val(),
							 	$('#addRencRuko').val(),$('#addRealRSS').val(),
							 	$('#addRealRS').val(),$('#addRealRM').val(),
							 	$('#addRealMW').val(),
							 	$('#addRealRuko').val(),
							 	$('#addCatatanpem').val()]).draw().node();
						}
					});
				});


			});
		</script>

		
