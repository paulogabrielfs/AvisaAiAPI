<!DOCTYPE html>

<?php

include("conection.php");

$qtdTotal = 0;
$qtdManu = 0;
$qtdSegu = 0;
$qtdSaud = 0;

$sql = mysqli_query($conection, " SELECT  tipoocorrencia.SETOR ,
											COUNT(IDOCORRENCIA) AS QTD FROM ocorrencia 
									LEFT JOIN tipoocorrencia ON tipoocorrencia.IDTIPOOCORRENCIA = ocorrencia.IDTIPOOCORRENCIA
									WHERE FECHADO = 0
									GROUP BY tipoocorrencia.SETOR ");

while($aux = mysqli_fetch_assoc($sql)) {
	
	IF($aux["SETOR"] == "MANUTENÇÃO"){
		$qtdManu = $aux["QTD"];	
	}
	
	IF($aux["SETOR"] == "SEGURANÇA"){
		$qtdSegu = $aux["QTD"];	
	}
	
	IF($aux["SETOR"] == "SAÚDE"){
		$qtdSaud = $aux["QTD"];	
	}
	
	$qtdTotal += $aux["QTD"];
}

$qtdAlta = 0;
$qtdMedia = 0;
$qtdBaixa = 0;
$qtdPriTotal = 0;

$sql = mysqli_query($conection, " SELECT  tipoocorrencia.PRIORIDADE ,
											COUNT(IDOCORRENCIA) AS QTD FROM ocorrencia 
									LEFT JOIN tipoocorrencia ON tipoocorrencia.IDTIPOOCORRENCIA = ocorrencia.IDTIPOOCORRENCIA
									WHERE FECHADO = 0
									GROUP BY tipoocorrencia.PRIORIDADE ");

while($aux = mysqli_fetch_assoc($sql)) {
	
	IF($aux["PRIORIDADE"] == 1){
		$qtdAlta = $aux["QTD"];	
	}
	
	IF($aux["PRIORIDADE"] == 2){
		$qtdMedia = $aux["QTD"];	
	}
	
	IF($aux["PRIORIDADE"] == 3){
		$qtdBaixa = $aux["QTD"];	
	}
	
	$qtdPriTotal += $aux["QTD"];
}

$qtdJan = 0;
$qtdFev = 0;
$qtdMar = 0;
$qtdAbr = 0;
$qtdMai = 0;
$qtdJun = 0;
$qtdJul = 0;
$qtdAgo = 0;
$qtdSet = 0;
$qtdOut = 0;
$qtdNov = 0;
$qtdDez = 0;

$sql = mysqli_query($conection, " SELECT  MONTH(ocorrencia.DATA) AS MES ,
											COUNT(IDOCORRENCIA) AS QTD FROM ocorrencia 
									LEFT JOIN tipoocorrencia ON tipoocorrencia.IDTIPOOCORRENCIA = ocorrencia.IDTIPOOCORRENCIA
									WHERE YEAR(ocorrencia.DATA) = 2017
									GROUP BY MONTH(ocorrencia.DATA)
									ORDER BY MONTH(ocorrencia.DATA) ");

while($aux = mysqli_fetch_assoc($sql)) {
	
	IF($aux["MES"] == 1){
		$qtdJan = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 2){
		$qtdFev = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 3){
		$qtdMar = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 4){
		$qtdAbr = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 5){
		$qtdMai = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 6){
		$qtdJun = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 7){
		$qtdJul = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 8){
		$qtdAgo = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 9){
		$qtdSet = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 10){
		$qtdOut = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 11){
		$qtdNov = $aux["QTD"];	
	}
	
	IF($aux["MES"] == 12){
		$qtdDez = $aux["QTD"];	
	}
	
	
}



mysqli_close($conection);

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AvisaAi - Dashboard</title>
<link rel="icon" href="images/logo.png">

<link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img class="logo-img" src="images/logo.png"> <span>AvisaAi</span></a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Perfil</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Configurações</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Sair </a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">

		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg>Dashboard</a></li>
			
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Registros</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<a href="tables.php">	
					<div class="panel panel-blue panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left" href="#">
								<svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $qtdTotal; ?></div>
								<div class="text-muted">Recentes</div>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<a href="tables_manu.php">
					<div class="panel panel-orange panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked gear" ><use xlink:href="#stroked-gear"/></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $qtdManu; ?></div>
								<div class="text-muted">Manutenção</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<a href="tables_saud.php">
					<div class="panel panel-red panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked heart"><use xlink:href="#stroked-heart"/></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $qtdSaud; ?></div>
								<div class="text-muted">Saúde</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<a href="tables_segu.php">
					<div class="panel panel-teal panel-widget">
						<div class="row no-padding">
							<div class="col-sm-3 col-lg-5 widget-left">
								<svg class="glyph stroked lock"><use xlink:href="#stroked-lock"/></svg>
							</div>
							<div class="col-sm-9 col-lg-7 widget-right">
								<div class="large"><?php echo $qtdSegu; ?></div>
								<div class="text-muted">Segurança</div>
							</div>
						</div>
					</div>
				</a>
			</div>
			
		</div><!--/.row-->
		<h2 class="page-header">Incidentes</h2>

		
		<div class="row">
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Leve</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo FLOOR(($qtdBaixa/$qtdPriTotal)*100); ?>" ><span class="percent"><?php echo FLOOR(($qtdBaixa/$qtdPriTotal)*100); ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Moderados</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo FLOOR(($qtdMedia/$qtdPriTotal)*100); ?>" ><span class="percent"><?php echo FLOOR(($qtdMedia/$qtdPriTotal)*100); ?>%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-4">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Graves</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?php echo FLOOR(($qtdAlta/$qtdPriTotal)*100); ?>" ><span class="percent"><?php echo FLOOR(($qtdAlta/$qtdPriTotal)*100); ?>%</span>
						</div>
					</div>
				</div>
			</div>

		</div><!--/.row-->
						
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Frequência de registros</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="1200"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			
		</div><!--/.row-->
	</div>	<!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
	<script> 
	
		var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
		
		var lineChartData = {
				labels : ["Janeiro","Fevereiro","Março","Abril","Maio"],
				datasets : [
					{
						label: "Chamados",
						fillColor : "rgba(48, 164, 255, 0.2)",
						strokeColor : "rgba(48, 164, 255, 1)",
						pointColor : "rgba(48, 164, 255, 1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(48, 164, 255, 1)",
						data : [<?php echo $qtdJan . "," . $qtdFev . "," . $qtdMar  . "," . $qtdAbr . "," . $qtdMai ?>]
					}
				]

			}
			
		var barChartData = {
				labels : ["January","February","March","April","May","June","July"],
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
					},
					{
						fillColor : "rgba(48, 164, 255, 0.2)",
						strokeColor : "rgba(48, 164, 255, 0.8)",
						highlightFill : "rgba(48, 164, 255, 0.75)",
						highlightStroke : "rgba(48, 164, 255, 1)",
						data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
					}
				]
		
			}

		var pieData = [
					{
						value: 300,
						color:"#30a5ff",
						highlight: "#62b9fb",
						label: "Blue"
					},
					{
						value: 50,
						color: "#ffb53e",
						highlight: "#fac878",
						label: "Orange"
					},
					{
						value: 100,
						color: "#1ebfae",
						highlight: "#3cdfce",
						label: "Teal"
					},
					{
						value: 120,
						color: "#f9243f",
						highlight: "#f6495f",
						label: "Red"
					}

				];
				
		var doughnutData = [
						{
							value: 300,
							color:"#30a5ff",
							highlight: "#62b9fb",
							label: "Blue"
						},
						{
							value: 50,
							color: "#ffb53e",
							highlight: "#fac878",
							label: "Orange"
						},
						{
							value: 100,
							color: "#1ebfae",
							highlight: "#3cdfce",
							label: "Teal"
						},
						{
							value: 120,
							color: "#f9243f",
							highlight: "#f6495f",
							label: "Red"
						}
		
					];

	window.onload = function(){
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive: true
		});
		var chart2 = document.getElementById("bar-chart").getContext("2d");
		window.myBar = new Chart(chart2).Bar(barChartData, {
			responsive : true
		});
		var chart3 = document.getElementById("doughnut-chart").getContext("2d");
		window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {responsive : true
		});
		var chart4 = document.getElementById("pie-chart").getContext("2d");
		window.myPie = new Chart(chart4).Pie(pieData, {responsive : true
		});
		
	};
function timer(){
window.location.reload();
}
setTimeout("timer()",5000);
</script>
	
</body>

</html>
