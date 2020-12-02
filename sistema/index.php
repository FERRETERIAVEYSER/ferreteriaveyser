<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Menú de Usuario</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touchpng">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>

<body>

	<!-- ENTRADA AL INDEX -->
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="src/images/veyserperu.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>1%</div>
			<div class="loading-text">
				Cargando...
			</div>
		</div>
	</div>

	<?php
	require "menu.php";
	?>

	<div class="mobile-menu-overlay"></div>

	<!-- Bienvenida al usuario -->
	<div class="main-container">

	</div>

	<!-- PORCENTAJES CIRCULOS  -->
	<div class="main-container">
		<div class="card-box pd-20 height-100-p mb-30">
			<div class="row align-items-center">
				<div class="col-md-4">
					<img src="vendors/images/banner-img.png" alt="">
				</div>
				<div class="col-md-8">
					<h4 class="font-20 weight-500 mb-10 text-capitalize">
						<div class="weight-600 font-30 text-blue">
							Bienvenido
							<?php
							if ($_SESSION['rol'] == 1) {
								echo "ADMIN : " . $_SESSION['usuario'];
							} elseif ($_SESSION['rol'] == 2) {
								echo "VENDEDOR : " . $_SESSION['usuario'];
							} else {
								echo "GERENTE : " . $_SESSION['usuario'];
							}
							?>
						</div>
						¡Reciba cordiales saludos!
					</h4>
					<p class="font-18 max-width-600">
						<?php
						if ($_SESSION['rol'] == 1) {
							echo "En este sistema podrá editar, agregar, eliminar a un usuario, 
								producto o venta que usted crea necesario, además que puede configurar 
								un poco el diseño del sistema a su agrado";
						} elseif ($_SESSION['rol'] == 2) {
							echo "Por favor utilicé el sistema con la debilidad responsabilidad del trabajo,
								es su responsabilidad guardar la información de su Usuario y Contraseña
								cualquier acción desconocidaz realizada con su cuenta no tendrá justificación";
						} else {
							"Por favor utilicé el sistema con la debilidad responsabilidad del trabajo,
								es su responsabilidad guardar la información de su Usuario y Contraseña
								cualquier acción desconocidaz realizada con su cuenta no tendrá justificación";
						}
						?>
				</div>
			</div>
		</div>

		<div class="xs-pd-20-10 pd-ltr-20">
			<!-- Gráficos -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
							<h5 class="text-light-green padding-top-10 h5">Ventas Completadas</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
							<h5 class="text-light-green padding-top-10 h5">Ventas Completadas</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
							<h5 class="text-light-green padding-top-10 h5">Ventas Completadas</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 mb-30">
					<div class="card-box pd-30 height-100-p">
						<div class="progress-box text-center">
							<input type="text" class="knob dial2" value="70" data-width="120" data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#00e091" data-angleOffset="180" readonly>
							<h5 class="text-light-green padding-top-10 h5">Ventas Completadas</h5>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-12 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<h4 class="mb-30 h4">Compliance Trend</h4>
						<div id="compliance-trend" class="compliance-trend"></div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 mb-30">
					<div class="card-box pd-30 height-100-p">
						<h4 class="mb-30 h4">Records</h4>
						<div id="chart" class="chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
	<script src="src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="vendors/scripts/dashboard2.js"></script>
	<script src="vendors/scripts/jvectormap-setting.js"></script>
</body>

</html>