<?php
if (!empty($_POST)) 
{
	if (
		empty($_POST['asunto'])
	) {
	
		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Debe rellenar el campo asunto </div>';
	} else {

		include 'conexion.php';

		$asunto = $_POST['asunto'];
		$descripcion = $_POST['descripcion'];
	
		// $adjunto = $_FILES['archivo'];
		// $nombrefile = $adjunto['name'];
		// $type = $adjunto['type'];
		// $url_temp = $adjunto['tmp_name'];

		// $archivoProducto = 'img_producto.png';

		// if ($nombrefile != '') {
		// 	$destino = '../img/adjunto';
		// 	$adjunto_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
		// 	$adjuntoProducto = $adjunto_nombre;
		// 	$src = $destino.$adjuntoProducto;
		// }

		$sql = mysqli_query($con, "INSERT INTO notificaciones (asunto, descripcion)
			values('" . $asunto . "','" . $descripcion . "')");
		if ($sql) {
			$alert = '<div class="alert alert-primary alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Exito !</strong> El comunicado se registro correctamente </div>';
		} else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Error !</strong> El comunicado no ha sido registrado </div>';
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Creación de anuncios y notificaciones</title>

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
	<link rel="stylesheet" type="text/css" href="src/plugins/jquery-asColorPicker/dist/css/asColorPicker.css">
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
					<h4 class="text-uppercase text-center text-white">registro de un nuevo comunicado </h4>
				</div>
				<div class="alert alert-dismissible fade show">
					<?php echo isset($alert) ?  $alert : ''; ?>
				</div>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="html-editor pd-20 card-box mb-30">
						<div class="form-group">
							<label for="exampleInputEmail1">Asunto : </label>
							<input type="text" name="asunto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
						</div>
						<br>
						<textarea class="textarea_editor form-control border-radius-0" placeholder="Escriba el texto con formatos, agregué link de páginas web y de imágenes ...." name="descripcion"></textarea>
						<br>
					</div>
					<div class="form-group">
						<button class="form-control btn btn-info" type="submit">Agregar Comunicado</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/jquery-asColor/dist/jquery-asColor.js"></script>
	<script src="src/plugins/jquery-asGradient/dist/jquery-asGradient.js"></script>
	<script src="src/plugins/jquery-asColorPicker/jquery-asColorPicker.js"></script>
	<script src="vendors/scripts/colorpicker.js"></script>
</body>

</html>