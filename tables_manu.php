<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AvisaAi - Ocorrências</title>
<link rel="icon" href="images/logo.png">

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
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
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Configurações </a></li>
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
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Lista de Registros</h1>
			</div>
		</div><!--/.row-->
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="SETOR" data-sortable="true">SETOR</th>
						        <th data-field="TIPO" data-sortable="true">TIPO</th>
						        <th data-field="PROBLEMA"  data-sortable="true">PROBLEMA</th>
						        <th data-field="DATA" data-sortable="true">DATA</th>
								<th data-field="PRIORIDADE" data-sortable="true">PRIORIDADE</th>
								<th data-field="NOME" data-sortable="true">NOME</th>
						    </tr>
						    </thead>
							
							<?php

								include("conection.php");

								$sql = mysqli_query($conection, " SELECT ocorrencia.IDOCORRENCIA 
																		,tipoocorrencia.SETOR 
																		, tipoocorrencia.TIPO 
																		, tipoocorrencia.PROBLEMA 
																		, DATE_FORMAT(ocorrencia.DATA, '%d/%m/%Y %h:%m') as 'DATA'
																		, tipoocorrencia.PRIORIDADE 
																		, usuario.NOME
																FROM ocorrencia
																LEFT JOIN tipoocorrencia ON tipoocorrencia.IDTIPOOCORRENCIA = ocorrencia.IDTIPOOCORRENCIA
																LEFT JOIN usuario ON usuario.IDUSUARIO = ocorrencia.IDUSUARIO
																WHERE FECHADO = 0 AND tipoocorrencia.SETOR = 'MANUTENÇÃO'
																ORDER BY tipoocorrencia.PRIORIDADE , ocorrencia.DATA ");

								while($aux = mysqli_fetch_assoc($sql)) {
									
									echo "<TR><TD>".$aux["SETOR"]."</TD>";
									echo "<TD>".$aux["TIPO"]."</TD>";
									echo "<TD><a href='detalhes.php?id=".$aux["IDOCORRENCIA"]."'>".$aux["PROBLEMA"]."</a></TD>";
									echo "<TD>".$aux["DATA"]."</TD>";
									echo "<TD>".$aux["PRIORIDADE"]."</TD>";
									echo "<TD>".$aux["NOME"]."</TD></TR>";
								}

								mysqli_close($conection);

								?>
							
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
		
	</div><!--/.main-->

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-table.js"></script>
	
</body>

</html>
