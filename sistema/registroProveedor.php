<?php
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}

include 'conexion.php';

if (!empty($_POST)) {
	if (
		empty($_POST['proveedor']) || empty($_POST['telefono']) || empty($_POST['direccion'])
	) {

		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Todos los campos son obligatorios </div>';
	} else {


		$proveedor = $_POST['proveedor'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];
		$usuario_id = $_SESSION['id'];

		$query = mysqli_query($con, "SELECT * FROM proveedores WHERE proveedor = '$proveedor' ");

		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<div class="alert alert-warning alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Aviso !</strong> El proveedor ya existe </div>';
		} else {
			$sql = mysqli_query($con, "INSERT INTO proveedores (proveedor, telefono, direccion, usuario_id)
			VALUES('" . $proveedor . "','" . $telefono . "','" . $direccion . "','" . $usuario_id . "')");

			if ($sql) {
				$alert = '<div class="alert alert-primary alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Exito !</strong> El proveedor se registro correctamente </div>';
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Error !</strong> El proveedor no ha sido registrado </div>';
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
	<title>Registrar nuevo Proveedor</title>

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
	require "menu.php";
	?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="html-editor pd-20 card-box p-3 mb-30 bg-primary text-white">
					<h4 class="text-uppercase text-center text-white">registro de un nuevo proveedor </h4>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="alert alert-dismissible fade show">
						<?php echo isset($alert) ?  $alert : ''; ?>
					</div>
					<form action="" method="post">
						<div class="row">
							<div class="col">
								<label >Proveedor : </label>
								<input type="text" name="proveedor" class="form-control" >
							</div>
							<div class="col-sm-12 my-1">
								<label >Telefono : </label>
								<div class="input-group-prepend">
									<div class="input-group-text">(056)</div>
									<input type="text" name="telefono" class="form-control" placeholder="Perú">
								</div>
							</div>
						</div>

						<div class="col">
							<label >Dirección</label>
							<input type="text" name="direccion" class="form-control" >
						</div>

						<div class="row">
							<div class="col-sm-6 my-2">
								<div class="form-check">
									<input name="termino" class="form-check-input" type="checkbox" value="" required>
									<label class="form-check-label">
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