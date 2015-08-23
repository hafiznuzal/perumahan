		<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
				   <h1 class="page-header">Pencarian</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class ="row">
				<div class ="col-lg-11">
					<div class ="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-list"></i> Pencarian
						</div>
						<div class="panel-body">
							<form id="form_pencarian" method="GET" action="<?php echo site_url(); ?>/admin/hasil">
								<div class="form-body">
									<div class="form-group">
										<label>Berdasarkan :</label>
										<div class="controls">
											<select class="form-control" type="text" id="berdasarkan" name="berdasarkan">
												<option value="kecamatan">Kecamatan</option>
												<option value="pengembang">Pengembang</option>
												<option value="perumahan">Perumahan</option>
												<option value="lokasi">Lokasi</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Kata Kunci :</label>
										<div class="input-icon">
											<i class="fa fa-user"></i>
											<input type="text" class="form-control" placeholder="Ex: Sidoarjo" id="kata_kunci" name="kata_kunci">
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn btn-default" id="cancel_pencarian">Reset</button>
									<button type="submit" class="btn btn-success">Cari</button>
								</div>
							</form>
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
			$("#cancel_pencarian").on("click", function(e){
				e.preventDefault();
				$("#kata_kunci").val("");
			});
		});
	</script>