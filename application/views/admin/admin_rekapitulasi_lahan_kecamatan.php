	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Rekapitulasi Lahan Perkecamatan se-Kabupaten Sidoarjo</h1>
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

							<i class="fa fa-list"></i> Rekapitulasi Lahan Perkecamatan se-Kabupaten Sidoarjo
						</div>
				
						
							
						
						<div class="panel-body">
							<div class="form-group panel-default">
								<div class="row">
									<div class="col-md-2">
									

									<label>Tahun:</label> 
									<select class="form-control form-inline" id="tahunOpt" name="tahun">
							    		<option disabled selected>Tahun</option>
									    <?php  for ($i=$tahun-3; $i <$tahun ; $i++) { ?> 
									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>	
									    
									 <option value="<?php echo $tahun; ?>" selected><?php echo $tahun; ?></option>
									    <?php  for ($i=$tahun+1; $i <$tahun+3; $i++) { ?> 
									    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									    <?php } ?>

									</select>
									</div> 
									
									<div class="col-md-2"> 
									<label>Triwulan:</label> 
									<select class="form-control form-inline" id="periodeOpt" name="periode">
									 	<option disabled selected>Periode</option>
									    <option value="1" <?php if($bulan==1) echo "selected";?>>1</option>
									    <option value="2" <?php if($bulan==2) echo "selected";?>>2</option>
									    <option value="3" <?php if($bulan==3) echo "selected";?>>3</option>
									    <option value="4" <?php if($bulan==4) echo "selected";?>>4</option>
									</select>
									</div>									


									<div class="col-md-3 pull-right"> 
										<a href="#" class="pull-right" id="excelPemDownload">Download Excel <img src="<?php  echo site_url()?>assets/img/excel.png"></a>
										<br>
										<a href="#" class="pull-right" id="pdfPemDownload">Download PDF <img src="<?php  echo site_url()?>assets/img/pdf.png"></a>


									</div>
								</div>
							</div>
							<div class ="table">
								<table id="lahanAll" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th style="min-width: 50px;">No</th>
											<th style="min-width: 200px;">Kecamatan</th>
											<th style="min-width: 160px;">Jumlah Lokasi Perumahan</th>
											
											<th style="min-width: 200px;">Ijin Lokasi</th>
											
											
											<th style="min-width: 200px;">Luas(Ha)</th>
											<th style="min-width: 200px;">Rencana Tapak(Ha)</th>
											<th style="min-width: 200px;">Pembebasan(Ha)</th>
											<th style="min-width: 200px;">Terbangun(Ha)</th>
											<th style="min-width: 200px;">Belum Terbangun</th>
											<th style="min-width: 200px;">FS Dialokasikan</th>
											<th style="min-width: 200px;">FS Pembebasan</th>
											<th style="min-width: 200px;">FS Sudah dimatangkan</th>
											
											<th style="min-width: 250px;">Aktif Dalam Pembangunan</th>
											<th style="min-width: 200px;">Aktif Berhenti</th>
											<th style="min-width: 200px;">Aktif Sudah Selesai</th>
											<th style="min-width: 200px;">Tidak Aktif</th>
										</tr>
											
										</tr>
									</thead>
									<tbody>
										<?php for($c=1;$c<$jumlah;$c++){?>
											
											<tr class="odd gradeX">

											<?php foreach ($lah_kec[$c] as $i) {?>
										
											<td><?php echo $c?></td>
											
											<td><?php echo $i['NAMA_KECAMATAN']?></td>

											<td><?php echo " "?></td>
											
											
											<td><?php echo $i['JML_IJIN_LOKASI']?></td>
										
											<td><?php echo $i['LUAS']?></td>
											<td><?php echo $i['RENCANA_TAPAK']?></td>
											<td><?php echo $i['PEMBEBASAN']?></td>
											<td><?php echo $i['TERBANGUN']?></td>
											<td><?php echo $i['BELUM_TERBANGUN']?></td>
											<td><?php echo $i['DIALOKASIKAN']?></td>
											<td><?php echo $i['PEMBEBASAN']?></td>
											<td><?php echo $i['DIMATANGKAN']?></td>
											<?php }?>

											<?php foreach ($aktifpemb[$c] as $i) {?>
												<td><?php echo $i['AKTIF_DLM_PEMBANGUNAN']?></td>
											<?php }?>

											<?php foreach ($aktifber[$c] as $i) {?>
												<td><?php echo $i['AKTIF_BERHENTI']?></td>
											<?php }?>

											<?php foreach ($aktifsel[$c] as $i) {?>
												<td><?php echo $i['AKTIF_SDH_SELESAI']?></td>
											<?php }?>
											
											<?php foreach ($tdkaktif[$c] as $i) {?>
												<td><?php echo $i['TIDAK_AKTIF']?></td>	
											<?php }?>					
											
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


<script type="text/javascript">

$(document).ready(function(){
	$('#lahanAll').DataTable( {
			"scrollX": true,
			"scrollY": "400px"
	});			

	$('#excelPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>report/rekapitulasi_lahan_kecamatan_excel/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})

	$('#pdfPemDownload').click(function(){
		window.location="<?php echo site_url(); ?>create_pdf/rekapitulasi_lahan_kecamatan_pdf/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
	})
	
	function changeDataPem()
	{
		
		window.location="<?php echo site_url() ?>report/rekapitulasi_lahan_kecamatan/"+$('#tahunOpt').val()+"/"+$('#periodeOpt').val();
		
	}
	$('#tahunOpt').change(function(){
		
		changeDataPem()
	});
	$('#periodeOpt').change(function(){
		
		changeDataPem()
	});
	$('#kecamatanOpt').change(function(){
		
		changeDataPem()
	});



});
	
</script>