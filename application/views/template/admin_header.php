<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Pengelolaan Perumahan</title>


	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css')?>" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?php echo base_url('assets/css/plugins/timeline.css')?>" rel="stylesheet">


	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/sb-admin-2.css')?>" rel="stylesheet">


	<!-- Morris Charts CSS -->
	<link href="<?php echo base_url('assets/css/plugins/morris.css')?>" rel="stylesheet">


	<!-- Custom Fonts -->
	<link href="<?php echo base_url('assets/font-awesome-4.2.0/css/font-awesome.min.css')?>" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>

	<script src="<?php echo base_url('assets/js/moment.js')?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-datetimepicker.min.js')?>"></script>
	<link href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">

	<!-- <link href="<?php echo base_url('assets/css/jquery-ui.theme.min.css')?>" rel="stylesheet"></script> -->
	<!-- <link href="<?php echo base_url('assets/css/jquery-ui.structure.min.css')?>" rel="stylesheet"></script> -->

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/js/ajaxfileupload.js')?>"></script>


	<!--LEAFLET-->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/leaflet.css')?>" />
	<script src="<?php echo base_url('assets/js/leaflet.js')?>"></script>


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header" >

			<img class="nav navbar-top-links navbar-left" style="padding-top:3px;padding-left:3px;" height="42" widtth="42" src="<?php  echo site_url()?>assets/img/sidoarjo.png"> 
			
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" style="margin-bottom: ">Pengelolaan Perumahan </a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					<form method="POST" action="<?php echo site_url() ?>admin/updatePeriode" id="formact">
						<input type="hidden" id="actmenu" name="actmenu">
						<input type="hidden" id="uri" name="uri" value="<?php echo base_url(uri_string()); ?>">
						Tahun: <select id="tahun" name="tahun">
						    
						    <?php  for ($i=$tahun-3; $i <$tahun ; $i++) { ?> 
						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php } ?>	
						    
						    <option value="<?php echo $tahun; ?>" selected><?php echo $tahun; ?></option>
						    <?php  for ($i=$tahun+1; $i <$tahun+3; $i++) { ?> 
						    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php } ?>	
						    
						</select>
						Triwulan: <select id="periode" name="periode">
						    <option value="1" <?php if($bulan==1) echo "selected";?>>1</option>
						    <option value="2" <?php if($bulan==2) echo "selected";?>>2</option>
						    <option value="3" <?php if($bulan==3) echo "selected";?>>3</option>
						    <option value="4" <?php if($bulan==4) echo "selected";?>>4</option>
						</select>
					</form>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
						</li>
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
						</li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url()?>admin/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li>
							<a href="<?php echo site_url('/admin/index');?>"><i class="fa fa-home fa-fw"></i> Muka</a>
						</li>
						<!-- <li>
							<a href="<?php echo site_url('/admin/pencarian');?>"><i class="fa fa-home fa-fw"></i> Pencarian</a>
						</li> -->
						<li>
							<a href="<?php echo site_url('/admin/pengembang');?>"><i class="fa fa-male fa-fw"></i> Pengembang</a>
						</li>
						<li>
							<a href="<?php echo site_url('/admin/perumahan')?>"><i class="fa fa-building fa-fw"></i> Perumahan</a>
						</li>
						<li>
							<a href="<?php echo site_url('/admin/lokasi')?>"><i class="fa fa-map-marker fa-fw"></i> Lokasi</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-file-text fa-fw"></i> Report Lahan<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
										<a href="<?php echo site_url('/report/report_lahan').'/'.$tahun?>" ><i class="fa fa-file-text-o fa-fw"></i> Report Lahan Sidoarjo</a>
									</li>
									
	                                <li>
	                                	<a href="<?php echo site_url('/report/report_lahan_perkecamatan').'/'.'1'.'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Report Lahan Perkecamatan Sidoarjo</a>
									</li>

									<li>
	                                	<a href="<?php echo site_url('/report/rekapitulasi_lahan_kecamatan').'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Rekapitulasi Lahan Kecamatan Se Kabupaten Sidoardjo</a>
									</li>
	                            </ul>
                        </li>
						<li>
							<a href="#"><i class="fa fa-file-text fa-fw"></i> Report Pembangunan<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
										<a href="<?php echo site_url('/report/report_pembangunan').'/'.$tahun?>" ><i class="fa fa-file-text-o fa-fw"></i> Report Pembangunan Sidoarjo</a>
									</li>
									
	                                <li>
	                                	<a href="<?php echo site_url('/report/report_pembangunan_perkecamatan').'/'.'1'.'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Report Pembangunan Perkecamatan Sidoarjo</a>
									</li>

									<li>
	                                	<a href="<?php echo site_url('/report/rekapitulasi_Pembangunan_kecamatan').'/'.$tahun.'/'.$bulan?>" ><i class="fa fa-file-text-o fa-fw"></i> Rekapitulasi Pembangunan Kecamatan Se Sidoardjo</a>
									</li>
	                            </ul>
                        </li>

                        <li>
							<a href="<?php echo site_url('/report/laporan_chart')?>"><i class="fa fa-line-chart fa-fw"></i> Statistik Pembangunan</a>
						</li>

						<li>
							<a href="<?php echo site_url()?>admin/logout"><i class ="fa fa-power-off fa-fw"></i>Logout</a>
							
						</li>
					</ul>
				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#tahun").change(function(){
						$("#actmenu").val="changeTahun";
						$("#formact").submit();
					});
					$("#periode").change(function(){
						$("#actmenu").val="changePeriode";
						$("#formact").submit();
					});
				});
			</script>
		</nav>



	
