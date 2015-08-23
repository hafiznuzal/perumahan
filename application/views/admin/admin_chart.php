<html>
<head>
	<title>Grafik Pembangunan</title>
	<script src="<?php echo site_url() ?>assets/js/Chart.min.js"></script>
</head>
<body>
	<div id="page_container">
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12" style="color:#446CB3">
				   <h1 class="page-header">Statistik Pembangunan Kabupaten Sidoarjo</h1>
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

					<canvas id="myChart" width="1000%" height="400"></canvas>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script>
// var myLineChart = new Chart(ctx).Line(data, options);

<?php echo "var rawData=".json_encode($mychart); ?>

console.log(rawData);
	
var labelData = []
var nilaiData = []

for(i=0 ;i <rawData.length;i++)
{
	labelData.push("Triwulan"+rawData[i].TRIWULAN+"-"+rawData[i].TAHUN)
	nilaiData.push(rawData[i].JML_LOKASI)
}

var data = {
	labels: labelData,
    datasets: [
        {
            label: "My First dataset",
            fillColor: "#89C4F4",
            strokeColor: "#1F3A93",
            pointColor: "#1E8BC3",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#19B5FE",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: nilaiData
        }
    ]
};
var ctx = document.getElementById("myChart").getContext("2d");
var myLineChart = new Chart(ctx).Line(data);


// console.log(nilaiData);
// console.log(labelData);
</script>

