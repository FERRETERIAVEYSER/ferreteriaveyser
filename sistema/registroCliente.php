<?php

session_start();

include 'conexion.php';
if (!empty($_POST)) {
	if (
		empty($_POST['nombre'])  || empty($_POST['dni_ruc'])
	) {

		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> El campo nombre, DNI, usuario y contraseña son necesarios </div>';
	} else {

		$nombre = $_POST['nombre'];
		$dni_ruc = $_POST['dni_ruc'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$id = $_SESSION['id'];

		$query = mysqli_query($con, "SELECT * FROM clientes WHERE dni_ruc = '$dni_ruc' ");

		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<div class="alert alert-warning alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Aviso !</strong> El Documento de Identidad ya existe </div>';
		} else {
			$sql = mysqli_query($con, "INSERT INTO clientes (nombre, dni_ruc, telefono, direccion, usuario_id)
			VALUES('$nombre','$dni_ruc','$telefono','$direccion','$id')");

			if ($sql) {
				$alert = '<div class="alert alert-primary alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡ Exito !</strong> El cliente se registro correctamente </div>';
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡ Error !</strong> El cliente no ha sido registrado </div>';
			}
		}
	}
	mysqli_close($con);
}

?>



<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Registrar Cliente</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
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

	<?php
	include "menu.php";
	?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="html-editor pd-20 card-box p-3 mb-30 bg-primary text-white">
					<h4 class="text-uppercase text-center text-white">registro de un nuevo cliente </h4>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="alert alert-dismissible fade show">
						<?php echo isset($alert) ?  $alert : '';
						?>

					</div>
					<form action="" method="post">
						<div class="row">
							<div class="col">
								<label>Nombres y Apellidos</label>
								<input type="text" name="nombre" class="form-control">
							</div>
							<div class="col">
								<label>Celular</label>
								<div class="input-group-prepend">
									<div class="input-group-text">+51</div>
									<input type="text" name="telefono" class="form-control" placeholder="Perú">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="exampleInputEmail1">DNI / RUC</label>
								<input type="text" name="dni_ruc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="exampleInputEmail1">Dirección</label>
								<input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
							</div>
						</div>

						<!-- <div class="form-group">
						<label for="exampleFormControlFile1">Subir Foto</label>
						<input type="file" class="form-control-file" id="exampleFormControlFile1">
						</div> -->
						<div class="row">
							<div class="col-sm-6 my-2">
								<div class="form-check">
									<input name="termino" class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
									<label class="form-check-label" for="defaultCheck1">
										Confirme si desea registrar el usuario
									</label>
								</div>
							</div>
							<div class="col-sm-6 my-2">
								<button class="form-control btn btn-info" type="submit">Agregar Usuario</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>

</html>