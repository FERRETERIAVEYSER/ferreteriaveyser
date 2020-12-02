<?php
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}

include 'conexion.php';

if (!empty($_POST)) {
	if (
		empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['usuario'])
		|| empty($_POST['contraseña']) || empty($_POST['rol']) || empty($_POST['email'])
		|| empty($_POST['celular']) || empty($_POST['direccion'])
	) {

		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Todos los campos son obligatorios </div>';
	} else {


		$nom = $_POST['nombre'];
		$ape = $_POST['apellido'];
		$user = $_POST['usuario'];
		$passwoard = md5($_POST['contraseña']);
		$cargo = $_POST['rol'];
		$correo = $_POST['email'];
		$telefono = $_POST['celular'];
		$dir = $_POST['direccion'];

		$query = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario = '$user' 
		OR email = '$correo' ");

		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<div class="alert alert-warning alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Aviso !</strong> El usuario o el correo ya existe </div>';
		} else {
			$sql = mysqli_query($con, "INSERT INTO usuarios (nombre, apellido, usuario, contraseña, rol, email, celular, direccion)
			VALUES('" . $nom . "','" . $ape . "','" . $user . "','" . $passwoard . "','" . $cargo . "','" . $correo . "','"
				. $telefono . "','" . $dir . "')");

			if ($sql) {
				$alert = '<div class="alert alert-primary alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Exito !</strong> El usuario se registro correctamente </div>';
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Error !</strong> El usuario no ha sido registrado </div>';
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
	<title>Registrar nuevo Usuario</title>

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
					<h4 class="text-uppercase text-center text-white">registro de un nuevo usuario </h4>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="alert alert-dismissible fade show">
						<?php echo isset($alert) ?  $alert : ''; ?>
					</div>
					<form action="" method="post">
						<div class="row">
							<div class="col">
								<label>Nombre</label>
								<input type="text" name="nombre" class="form-control" >
							</div>
							<div class="col">
								<label>Apellidos</label>
								<input type="text" name="apellido" class="form-control" >
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label >Usuario</label>
								<input type="text" name="usuario" class="form-control"  >
							</div>
							<div class="col">
								<label >E-mail</label>
								<input type="email" name="email" class="form-control"  placeholder="user@example">
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label>Dirección</label>
								<input type="text" name="direccion" class="form-control" >
							</div>
							<div class="col">
								<label>Subir Foto</label>
								<div class="custom-file">
									<input type="file" name="foto" class="custom-file-input">
									<label class="custom-file-label">Subir Foto...</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col">
								<label >Contraseña</label>
								<input type="password" name="contraseña" class="form-control" >
							</div>
							<div class="col">

								<?php 
									include 'conexion.php';
									$query_rol = mysqli_query($con, "SELECT * FROM rol");
									mysqli_close($con);
									$result_rol = mysqli_num_rows($query_rol);
								?>

								<label>Rol</label>
								<select name="rol" class="form-control">
									<?php
										if ($result_rol > 0) {
											while($rol = mysqli_fetch_array($query_rol)) {
									?>
										<option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol'] ?></option>
									<?php
											} 
										}	
									?>
								</select>
							</div>
						</div>

						<div class="form-group">			
							<div class="col-sm-12 my-1">
								<label>Celular</label>
								<div class="input-group-prepend">
									<div class="input-group-text">+51</div>
									<input type="text" name="celular" class="form-control" placeholder="Perú">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 my-2">
								<div class="form-check">
									<input name="termino" class="form-check-input" type="checkbox" value="" 
									id="defaultCheck1" required>
									<label for="defaultCheck1">
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