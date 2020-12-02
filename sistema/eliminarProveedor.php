<?php
$alert = '';

session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 3) {
    header("location: eliminarProveedor.php");
}
include 'conexion.php';
if (!empty($_POST)) {
    $id_proveedor = $_POST['id'];

    $query_delete = mysqli_query($con, "UPDATE proveedores SET estado = 0 WHERE id_proveedor = $id_proveedor");

    if ($query_delete) {
        header("location: reporteProveedor.php");
    } else {
        echo "Error al eliminar";
    }
}


if (
    empty($_REQUEST['id'])
) {
    header("location: reporteProveedor.php");
    mysqli_close($con);
} else {

    $id_proveedor = $_REQUEST['id'];

    $query = mysqli_query($con, "SELECT proveedor, telefono, direccion
                FROM proveedores WHERE id_proveedor = $id_proveedor ");
    mysqli_close($con);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $proveedor = $data['proveedor'];
            $telefono = $data['telefono'];
            $direccion = $data['direccion'];
        }
    } else {
        header("location: reporteProveedor.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Actualización de datos del Proveedor</title>

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
            <div class="html-editor pd-20 card-box p-3 mb-30 bg-danger text-white">
                <h4 class="text-uppercase text-center text-white">¿Está seguro que desea eliminar el Usuario?</h4>
            </div>
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="row">
                        <div class="col">
                            <form action="" method="post">
                                <div class="task-title row align-items-center">
                                    <input type="hidden" name="id" value="<?php echo $id_proveedor; ?>">

                                    <div class="col-sm-12 my-1">
                                        <label>Proveedor : </label>
                                        <input type="text" name="proveedor" class="form-control" value="<?php echo $proveedor; ?>">
                                    </div>

                                    <div class="col-sm-12 my-1">
                                        <label>Telefono : </label>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">(056)</div>
                                            <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 my-1">
                                        <label>Dirección</label>
                                        <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">
                                    </div>
                                </div>


                                <div class="col-sm-12 my-2">
                                    <button class="form-control btn btn-danger" type="submit">Eliminar Proveedor</button>
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