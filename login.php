<?php

$alert = '';
session_start();

if (!empty($_SESSION['active'])) {
	header("location: sistema/");
} else {

	if (!empty($_POST)) {
		if (empty($_POST['usuario']) || empty($_POST['contraseña'])) {
			$alert = "Debe ingresar un usuario y una contraseña";
			session_destroy();
		} else {

			include "sistema/conexion.php";

			$user = mysqli_real_escape_string($con, $_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($con, $_POST['contraseña']));

			$query = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario = '$user' 
		AND contraseña = '$pass'");
			mysqli_close($con);
			$result = mysqli_num_rows($query);

			if ($result > 0) {
				$data = mysqli_fetch_array($query);

				$_SESSION['active'] = true;
				$_SESSION['id'] = $data['id'];
				$_SESSION['usuario'] = $data['usuario'];
				$_SESSION['contraseña'] = $data['contraseña'];
				$_SESSION['rol'] = $data['rol'];
				$_SESSION['nombre'] = $data['nombre'];

				header("location: sistema/");
			} else {
				$alert = "El usuario o la contraseña son incorrectas";
				session_destroy();
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Ferreteria</title>
	<link rel="stylesheet" type="text/css" href="sistema/src/styles/css_login.css">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<img class="wave" src="sistema/src/images/img-login.png">
	<div class="container">
		<div class="img">
			<img src="sistema/src/images/logo.png">
		</div>
		<div class="login-content">

			<form action="login.php" method="POST">
				<img src="sistema/src/images/user.png">
				<h2 class="title">Inicio Sesión</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div class="div">
						<h5>Usuario</h5>
						<input type="text" class="input" name="usuario" >
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div class="div">
						<h5>Contraseña</h5>
						<input type="password" class="input" name="contraseña">
					</div>
				</div>
				<a href="#">¿Olvidaste tu contraseña?</a>
				<input type="submit" class="btn" value="Login">
				<div class="alert"><?php echo (isset($alert) ? $alert : ''); ?> </div>
			</form>

		</div>
	</div>
	<script src="sistema/src/scripts/jquery.min.js"></script>
	<script src="sistema/src/scripts/login.js"></script>
</body>

</html>