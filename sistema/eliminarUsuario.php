<?php
$alert = '';
session_start();
if ($_SESSION['rol'] != 1) {
	header("location: ./");
}

include 'conexion.php';

if (!empty($_POST)) {
    if ($_POST['id'] == 1) {
        header("location: reporteUsuario.php");
        mysqli_close($con);
        exit;
    }


    $id = $_POST['id'];

    //$query_delete = mysqli_query($con, "DELETE FROM usuarios WHERE id = $id");
    $query_delete = mysqli_query($con, "UPDATE usuarios SET estado = 0 WHERE id = $id");

    if ($query_delete) {
        header("location: reporteUsuario.php");
    } else {
        echo "Error al eliminar";
    }
}

if (
    empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
    header("location: reporteUsuario.php");
    mysqli_close($con);
} else {

    $id = $_REQUEST['id'];

    $query = mysqli_query($con, "SELECT u.nombre, u.apellido, u.usuario, u.rol, u.email, u.celular, u.direccion
                FROM usuarios u INNER JOIN rol r ON u.rol = r.idrol WHERE u.id = $id ");
    mysqli_close($con);
    $result = mysqli_num_rows($query);
    
    if ($result > 0) {
        while ($data = mysqli_fetch_array($query)) {
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $email = $data['email'];
            $usuario = $data['usuario'];
            $rol    = $data['rol'];
            $celular    = $data['celular'];
            $direccion    = $data['direccion'];
        }
    } else {
        header("location: reporteUsuario.php");
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
                <h4 class="text-uppercase text-center text-white">¿Está seguro que desea eliminar el Usuario?</h4>
            </div>
            <div class="min-height-200px">
                <div class="pd-20 card-box mb-30">
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST">
                                <section id="container-eliminar">
                                    <div class="dato-eliminar">
                                        <div class="form-group">
                                            <div class="col-sm-11 my-1">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"> NOMBRES : </div>
                                                    <input type="text" name="nombre" class="form-control"value="<?php echo $nombre; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-11 my-1">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">APELLIDO :</div>
                                                    <input type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-11 my-1">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">USUARIO_ :</div>
                                                    <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-11 my-1">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">CORREO E:</div>
                                                    <input type="text" name="correo" class="form-control" id="inlineFormInputGroupUsername" value="<?php echo $email; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-11 my-1">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">CELULAR : </div>
                                                    <input type="text" name="celular" class="form-control" id="inlineFormInputGroupUsername" value="<?php echo $celular; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <a href="reporteUsuario.php" class="btn-cancelar">Cancelar</a>
                                        <input type="submit" value="Aceptar" class="btn-aceptar">

                                    </div>
                                </section>
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