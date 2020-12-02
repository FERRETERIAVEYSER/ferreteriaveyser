<?php
session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 3) {
    header("location: ./");
}

include 'conexion.php';

if (!empty($_POST)) {

    $alert = '';
    if (
        empty($_POST['proveedor']) || empty($_POST['precio']) ||
        empty($_POST['cantidad'])
    ) {

        $alert = '<div class="alert alert-warning alert-dismissible fade show">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡ Aviso !</strong> Todos los datos deben ser ingresados </div>';
    } else {

        $id = $_POST['id'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $proveedor = $_POST['proveedor'];
        $cantidad = $_POST['cantidad'];

        $query = mysqli_query($con, "SELECT * FROM producto
							WHERE (descripcion = '$descripcion' AND id_producto != $id ) ");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>¡ Aviso !</strong> El producto ya existe </div>';
        } else {

            $sql_update = mysqli_query($con, "UPDATE producto 
								SET descripcion = '$descripcion', proveedor = '$proveedor' , precio = '$precio', cantidad = '$cantidad' 
								WHERE id_producto = $id ");

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
    mysqli_close($con);
}

//Validar que el Id no esté vacio
if (empty($_GET['id'])) {
    header('location: reporteProducto.php');
}

$id = $_GET['id'];

include 'conexion.php';

$sql = mysqli_query($con, "SELECT id_producto, proveedor, descripcion, precio, cantidad FROM producto
WHERE id_producto = $id and estado = 1");
mysqli_close($con);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header(('Location: reporteProducto.php'));
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id = $data['id_producto'];
        $proveedor = $data['proveedor'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];
        $cantidad = $data['cantidad'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Actualización de Productos</title>

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
        <div class="min-height-100px">
            <div class="html-editor pd-20 card-box p-3 mb-30 bg-info text-white">
                <h4 class="text-uppercase text-center text-white">Actualización de Productos</h4>
            </div>
            <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <div class="tab-content">
                            <div class="container pd-0">
                                <div class="alert alert-dismissible fade show">
                                    <?php echo isset($alert) ?  $alert : ''; ?>
                                </div>

                                <form action="" method="post">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <label>Nombre del producto</label>
                                        <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="number" name="cantidad" class="form-control" value="<?php echo $cantidad; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Precio</label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">S/</div>
                                            <input type="number" name="precio" class="form-control" placeholder="Ingrese monto en Soles" value="<?php echo $precio; ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <?php
                                        include 'conexion.php';
                                        $query_proveedores = mysqli_query($con, "SELECT id_proveedor, proveedor FROM proveedores");
                                        mysqli_close($con);
                                        $result_proveedores = mysqli_num_rows($query_proveedores);
                                        ?>

                                        <label>Proveedores</label>
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
                                                    Confirme si desea actualizar el producto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 my-2">
                                            <button class="form-control btn btn-primary" type="submit">Actualizar Producto</button>
                                        </div>
                                    </div>
                                </form>
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