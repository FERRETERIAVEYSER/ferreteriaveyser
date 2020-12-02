<?php
session_start();

if (!empty($_POST)) {
	if (
		empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['cantidad']) || empty($_POST['proveedor'])
	) {

		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Debe rellenar todos los campos </div>';
	} else {

		include 'conexion.php';

		$producto = $_POST['descripcion'];
		$pre = $_POST['precio'];
		$can = $_POST['cantidad'];
		$usuario_id = $_SESSION['id'];

		$sql = mysqli_query($con, "INSERT INTO producto (descripcion, precio, cantidad, proveedor, usuario_id)
    values('" . $producto . "','" . $pre . "', ' " . $can . "','" . $proveedor . "','".$usuario_id."')");

		if ($sql) {
			$alert = '<div class="alert alert-primary alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Exito !</strong> El producto se registro correctamente </div>';
		} else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Error !</strong> El producto no ha sido registrado </div>';
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Registro de producto</title>

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
				<div class="html-editor pd-20 card-box p-3 mb-30 bg-dark text-white">
					<h4 class="text-uppercase text-center text-white">registro de un nuevo producto </h4>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">

					<div class="alert alert-dismissible fade show">
						<?php echo isset($alert) ?  $alert : ''; ?>
					</div>
					<form action="" method="post">
						<div class="form-group">
							<label>Nombre del producto</label>
							<input type="text" name="descripcion" class="form-control">
						</div>
						<div class="form-group">
							<label>Cantidad</label>
							<input type="number" name="cantidad" class="form-control">
						</div>
						<div class="form-group">
							<label>Precio</label>
							<div class="input-group-prepend">
								<div class="input-group-text">S/</div>
								<input type="number" name="precio" class="form-control" placeholder="Ingrese monto en Soles">
							</div>
						</div>
						<div class="col">
							<?php
							include '../conexion.php';
							$query_proveedores = mysqli_query($con, "SELECT id_proveedor, proveedor FROM proveedores");
							mysqli_close($con);
							$result_proveedores = mysqli_num_rows($query_proveedores);
							?>

							<label >Proveedores</label>
							<select name="proveedor" class="form-control">
								<?php
								if ($result_proveedores > 0) {
									while ($proveedor = mysqli_fetch_array($query_proveedores)) {
								?>
										<option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['proveedor'] ?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<div class="row">
							<div class="col-sm-6 my-2">
								<div class="form-check">
									<input name="termino" class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
									<label class="form-check-label" for="defaultCheck1">
										Confirme si desea registrar el producto
									</label>
								</div>
							</div>
							<div class="col-sm-12 my-2">
								<button class="form-control btn btn-info" type="submit">Agregar Producto</button>
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