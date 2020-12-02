<?php
session_start();

include 'conexion.php';

if (!empty($_POST)) {

	$alert = '';
	if (
		empty($_POST['nombre']) || empty($_POST['direccion']) ||
		empty($_POST['telefono'])
	) {

		$alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Todos los datos deben ser ingresados </div>';
	} else {

		$id_cliente = $_POST['id'];
		$nombre = $_POST['nombre'];
		$dni_ruc = $_POST['dni_ruc'];
		$telefono = $_POST['telefono'];
		$direccion = $_POST['direccion'];

		$query = mysqli_query($con, "SELECT * FROM clientes
							WHERE (dni_ruc = '$dni_ruc' AND id_cliente != $id_cliente)");
		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<div class="alert alert-warning alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Aviso !</strong> El DNI o RUC ya existe </div>';
		} else {

				$sql_update = mysqli_query($con, "UPDATE clientes 
				SET nombre = '$nombre', dni_ruc = '$dni_ruc' , telefono = '$telefono' , direccion = '$direccion' 
				WHERE id_cliente = $id_cliente ");

			if ($sql_update) {
				$alert = '<div class="alert alert-primary alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡ Exito !</strong> El Usuario se ha actualizado correctamente </div>';
			} else {
				$alert = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡ Error !</strong> Error en la actualización del usuario </div>';
			}
		}
	}
}

//Validar que el Id no esté vacio
if (empty($_REQUEST['id'])) {
	header('location: reporteCliente.php');
}

$id_cliente = $_REQUEST['id'];

include 'conexion.php';

$sql = mysqli_query($con, "SELECT id_cliente, nombre, direccion, telefono, dni_ruc
FROM clientes WHERE id_cliente = $id_cliente ");
mysqli_close($con);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: reporteCliente.php');
	mysqli_close($con);
} else {
	while ($data = mysqli_fetch_array($sql)) {
		$id_cliente = $data['id_cliente'];
		$nombre = $data['nombre'];
		$direccion = $data['direccion'];
		$dni_ruc = $data['dni_ruc'];
		$telefono = $data['telefono'];
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Actualización de usuario</title>

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
	<link rel="stylesheet" type="text/css" href="src/plugins/cropperjs/dist/cropper.css">
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
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="vendors/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
							<p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										FerdinandMChilds@test.com
									</li>
									<li>
										<span>Phone Number:</span>
										619-229-0054
									</li>
									<li>
										<span>Country:</span>
										America
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#tasks" role="tab">Actualización de Cliente</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Tasks Tab start -->
										<div class="tab-pane fade show active" id="tasks" role="tabpanel">
											<div class="pd-20 profile-task-wrap">
												<div class="container pd-0">
													<div class="alert alert-dismissible fade show">
														<?php echo isset($alert) ?  $alert : ''; ?>
													</div>
													<form action="" method="post">
														<div class="task-title row align-items-center">
															<input type="hidden" name="id" value="<?php echo $id_cliente; ?>">

															<div class="col-md-12">
																<label>Nombre</label>
																<input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
															</div>

															<div class="col-md-12">
																<label>Celular</label>
																<div class="input-group-prepend">
																	<div class="input-group-text">+51</div>
																	<input type="text" name="telefono" class="form-control" placeholder="Perú" value="<?php echo $telefono; ?>">
																</div>
															</div>

															<div class="col-md-12">
																<label for="exampleInputEmail1">DNI / RUC</label>
																<input type="text" name="dni_ruc" class="form-control" value="<?php echo $dni_ruc; ?>">
															</div>

															<div class="col-md-12">
																<label for="exampleInputEmail1">Dirección</label>
																<input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
															</div>
															<div class="col-sm-6 my-2">
																<div class="form-check">
																	<input name="termino" class="form-check-input" type="checkbox" value="" id="defaultCheck1" required>
																	<label class="form-check-label" for="defaultCheck1">
																		Confirme si desea registrar el usuario
																	</label>
																</div>
															</div>
															<div class="col-sm-6 my-2">
																<button class="form-control btn btn-info" type="submit">Actualizar Cliente</button>
															</div>
													</form>
												</div>
											</div>
										</div>
										<!-- Tasks Tab End -->
									</div>
								</div>
							</div>
						</div>
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
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function() {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function() {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function() {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function() {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
</body>

</html>