		<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
				   <h1 class="page-header">Hasil Pencarian</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">
					<div class ="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Hasil Pencarian
						</div>
						<div class="panel-body">
							<div class ="table">
								<table id="dataTable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Kecamatan</th>
											<th>Perusahaan</th>
											<th>Perumahan</th>
											<th>Lokasi</th>
											<th>Detail</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($hasil_pencarian as $i) {?>
										<tr class="odd gradeX">
											<td><?php echo $i['nama_kecamatan']?></td>
											<td><?php echo $i['nama_perusahaan']?></td>
											<td><?php echo $i['nama_perumahan']?></td>
											<td><?php echo $i['nama_lokasi']?></td>
											<td><a href="<?php echo site_url('/detil_proyek/index/' . $i['id_proyek']); ?>" class="btn btn-info">Detail</a></td>
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
			$('#dataTable').DataTable();
		});
	</script>