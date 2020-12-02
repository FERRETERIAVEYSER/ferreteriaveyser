<?php
include '../conexion.php';

if (
	isset($_POST['nomproducto']) || isset($_POST['fecha']) ||
	isset($_POST['precio']) || isset($_POST['estado'])
) {

	$producto = $_POST['nomproducto'];
	$fecha = $_POST['fecha'];
	$precio = $_POST['precio'];
	$estado = $_POST['estado'];
	$sql = mysqli_query($con, "insert into producto (nomproducto, fecha, estado, precio)
    values('" . $producto . "','" . $fecha . "','" . $precio . "','" . $estado."')");
	if ($producto = 1) {
		header("location:index.php");
	}
}
?>



<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Registrar nuevo producto</title>

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
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Registro de un nuevo Producto</h4>
							</div>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Ingrese los datos del producto</h4>
						</div>
					</div>

					<form id="login-form" action="form-basic-producto.php" method="post">

						<div class="row">
							<div class="col">
								<label for="exampleInputEmail1">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
							</div>
							<div class="col">
								<label for="exampleInputEmail1">Apellidos</label>
								<input type="text" name="apellido" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="exampleInputEmail1">Usuario</label>
								<input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
							</div>
							<div class="col">
								<label for="exampleInputPassword1">E-mail</label>
								<input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="user@example" required>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="exampleInputEmail1">Dirección</label>
								<input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
							</div>
							<div class="col">
								<label for="exampleFormControlFile1">Subir Foto</label>
								<div class="custom-file">
									<input type="file" name="foto" class="custom-file-input" id="validatedCustomFile" required>
									<label class="custom-file-label" for="validatedCustomFile">Subir archivo...</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label for="exampleFormControlFile1">Contraseña</label>
								<input type="password" name="contraseña" class="form-control" id="inlineFormInputName" required>
							</div>
							<div class="col">
								<label for="exampleFormControlFile1">Confirmar Contraseña</label>
								<input type="password" name="confirmarcontraseña" class="form-control" id="inlineFormInputGroupUsername" required>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 my-1">
								<label for="exampleFormControlSelect1">Rol</label>
								<select name="rol" class="form-control" id="exampleFormControlSelect1">
									<option>Admin</option>
									<option>Cliente</option>
									<option>Vendedor</option>
								</select>
							</div>
							<div class="col-sm-6 my-1">
								<label for="exampleFormControlFile1">Celular</label>
								<div class="input-group-prepend">
									<div class="input-group-text">+51</div>
									<input type="text" name="celular" class="form-control" id="inlineFormInputGroupUsername" placeholder="Perú" required>
								</div>
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
								<button class="btn btn-info" type="submit">Regsitrarme</button>
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