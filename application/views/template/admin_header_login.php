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
	<link href="<?php echo base_url('assets/css/signin.css')?>" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url('assets/font-awesome-4.2.0/css/font-awesome.min.css')?>" rel="stylesheet">

	<!-- jQuery -->
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/js/ajaxfileupload.js')?>"></script>


	<!--LEAFLET-->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>


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
			<div class="navbar-header">
				<img style="padding-top:3px;padding-left:3px;" class="nav navbar-top-links navbar-left" height="42" widtth="42" src="<?php  echo site_url()?>assets/img/sidoarjo.png"> 
			
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Pengelolaan Perumahan</a>
			</div>
			<!-- /.navbar-header -->

			<ul class="nav navbar-top-links navbar-right">
				<li>
					<form method="POST" action="root" id="formact">
						<input type="hidden" id="actmenu" name="actmenu">
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
						    <option value="1" <?php if($bulan<4) echo "selected";?>>1</option>
						    <option value="2" <?php if($bulan>3 && $bulan<7) echo "selected";?>>2</option>
						    <option value="3" <?php if($bulan>7 && $bulan<9) echo "selected";?>>3</option>
						    <option value="4" <?php if($bulan>10) echo "selected";?>>4</option>
						</select>
					</form>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> Login</a>
						</li>
						
					</ul>
					<!-- /.dropdown-user -->
				</li>
				<!-- /.dropdown -->
			</ul>
			<!-- /.navbar-top-links -->

		
			<!-- /.navbar-static-side -->
			
		</nav>



	
