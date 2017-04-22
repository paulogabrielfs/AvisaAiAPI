<!DOCTYPE html>

<?php
include("conection.php");

$sql = mysqli_query($conection, " SELECT ocorrencia.IDOCORRENCIA
																		,tipoocorrencia.SETOR 
																		, tipoocorrencia.TIPO 
																		, tipoocorrencia.PROBLEMA 
																		, DATE_FORMAT(ocorrencia.DATA, '%d/%m/%Y %h:%m') as 'DATA'
																		, tipoocorrencia.PRIORIDADE 
																		, ocorrencia.latitude 
																		, ocorrencia.longitude 
																		, usuario.NOME
																FROM ocorrencia
																LEFT JOIN tipoocorrencia ON tipoocorrencia.IDTIPOOCORRENCIA = ocorrencia.IDTIPOOCORRENCIA
																LEFT JOIN usuario ON usuario.IDUSUARIO = ocorrencia.IDUSUARIO
																WHERE ocorrencia.IDOCORRENCIA = ".$_GET["id"]."
																ORDER BY tipoocorrencia.PRIORIDADE , ocorrencia.DATA ");

while($aux = mysqli_fetch_assoc($sql)) {
	
	$problema = $aux["SETOR"]." / ".$aux["TIPO"]." / ".$aux["PROBLEMA"];
	$nome = $aux["NOME"];
	$localizacao =  $aux["latitude"] . ",". $aux["longitude"] ;
	
	$geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?sensor=false&latlng='.$aux["latitude"].','.$aux["longitude"]	);
	
	$output= json_decode($geocode);

	$endereco = $output->results[0]->formatted_address;
	
	$data = $aux["DATA"];
}
?>
								
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AvisaAi - Dashboard</title>
<link rel="icon" href="images/logo.png">

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
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
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
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
		</ul>
	</div><!--/.sidebar-->	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Detalhes</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-md-12">
							<form action="gravarDados.php" method = "POST">
								<div class="form-group">
									<input type="hidden" name= "id" value="<?php echo $_GET["id"]; ?>">
									<label>NOME</label>
									<input class="form-control" name= "NOME" readonly="true" value="<?php echo $nome; ?>">
									<br>
									<label>LOCALIZAÇÂO</label>
									<input class="form-control" name= "LOCALIZACAO" readonly="true" value="<?php echo $localizacao; ?>">
									<br>
									<label>ENDEREÇO</label>
									<input class="form-control" name= "ENDERECO" readonly="true" value = "<?php echo strtoupper($endereco); ?>">
									<br>
									<label>SECRETARIA/TIPO/PROBLEMA</label>
									<input class="form-control" name= "PROBLEMA" readonly="true" value="<?php echo $problema; ?>">
									<br>
									<label>RESPOSTA</label>
									<textarea class="form-control" rows="3" name="RESPOSTA"></textarea>
								</div>
								<input type="submit" value="submeter" />
							</form>
						</div>
					</div>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script language = "javascript">
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
