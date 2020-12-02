<?php
$alert = '';

session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 3) {
    header("location: eliminarProducto.php");
}
include 'conexion.php';
if (!empty($_POST)) {
    $id_producto = $_POST['id'];

    $query_delete = mysqli_query($con, "UPDATE producto SET estado = 0 WHERE id_producto = $id_producto");

    if ($query_delete) {
        header("location: reporteProducto.php");
    } else {
        echo "Error al eliminar";
    }
}


if (
    empty($_REQUEST['id'])
) {
    header("location: reporteProducto.php");
    mysqli_close($con);
} else {

    $id_producto = $_REQUEST['id'];

    $query = mysqli_query($con, "SELECT descripcion, proveedor, fecha, cantidad, usuario_id, precio
                FROM producto WHERE id_producto = $id_producto ");
    mysqli_close($con);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $descripcion = $data['descripcion'];
            $proveedor = $data['proveedor'];
            $fecha = $data['fecha'];
            $precio = $data['precio'];
            $cantidad    = $data['cantidad'];
            $usuario_id    = $data['usuario_id'];
        }
    } else {
        header("location: reporteProducto.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Actualización de datos del usuario</title>

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
    <link rel="stylesheet" href="../css/eliminarUsuarioestilo.css">

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
            <div class="html-editor pd-20 card-box p-3 mb-30 bg-danger text-white">
                <h4 class="text-uppercase text-center text-white">¿Está seguro que desea eliminar el Producto?</h4>
            </div>
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="row">
                        <div class="col">
                            <form action="" method="post">
                                <div class="task-title row align-items-center">
                                    <input type="hidden" name="id" value="<?php echo $id_producto; ?>">

                                    <div class="col-md-12">
                                        <label>Nombre: </label>
                                        <input class="form-control" value="<?php echo $descripcion; ?>" readonly>
                                    </div>


                                    <div class="col-md-12">
                                        <label>Proveedor: </label>
                                        <input class="form-control" value="<?php echo $proveedor; ?>" readonly>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Fecha: </label>
                                        <input class="form-control" value="<?php echo $fecha; ?>" readonly>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Precio: </label>
                                        <input class="form-control" value="<?php echo $precio; ?>" readonly>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Cantidad: </label>
                                        <input class="form-control" value="<?php echo $cantidad; ?>" readonly>
                                    </div>

                                    <div class="col-sm-6">
                                        <a href="
                                        reporteProducto.php" class="form-control btn btn-primary">Cancelar</a>
                                    </div>
                                    <div class="col-sm-6 my-2">
                                        <button class="form-control btn btn-danger" type="submit">Eliminar Producto</button>
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