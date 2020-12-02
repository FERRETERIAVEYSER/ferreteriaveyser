<?php
session_start();
include 'conexion.php';

if (!empty($_POST)) {

    $alert = '';
    if (
        empty($_POST['nombre']) || empty($_POST['apellido']) ||
        empty($_POST['usuario']) || empty($_POST['email']) ||
        empty($_POST['celular']) || empty($_POST['direccion'])
    ) {

        $alert = '<div class="alert alert-warning alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡ Aviso !</strong> Todos los datos deben ser ingresados </div>';
    } else {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $direccion = $_POST['direccion'];

        $query = mysqli_query($con, "SELECT * FROM usuarios
                            WHERE (usuario = '$usuario' AND id != $id ) OR (email = '$email' AND id != $id )");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡ Aviso !</strong> El correo o el usuario ya existe </div>';
        } else {

            if (empty($_POST['contraseña'])) {
                $sql_update = mysqli_query($con, "UPDATE usuarios 
                                SET nombre = '$nombre', apellido = '$apellido' , usuario = '$usuario' , email = '$email' , 
                                celular = '$celular' , direccion = '$direccion' 
                                WHERE id = $id ");
            } else {
                $sql_update = mysqli_query($con, "UPDATE usuarios 
                                SET nombre = '$nombre', apellido = '$apellido' , usuario = '$usuario' , email = '$email' , 
                                celular = '$celular' , direccion = '$direccion' , contraseña = '$contraseña'
                                WHERE id = $id ");
            }

            if ($sql_update) {
                $alert = '<div class="alert alert-primary alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡ Exito !</strong> Sus datos se actualizaron correctamente </div>';
            } else {
                $alert = '<div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>¡ Error !</strong> Error en la actualización de sus datos</div>';
            }
        }
    }
    mysqli_close($con);
}

if (empty($_GET['id'])) {
    header('location: reporteUsuario.php');
}

$id = $_GET['id'];
include 'conexion.php';

$sql = mysqli_query($con, "SELECT u.id, u.nombre, 
    u.apellido, u.usuario, u.email, u.celular, 
    u.direccion FROM usuarios u 
    WHERE id = $id and estado = 1");
mysqli_close($con);
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
    header(('Location: reporteUsuario.php'));
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $usuario = $data['usuario'];
        $email = $data['email'];
        $celular = $data['celular'];
        $direccion = $data['direccion'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Mi Perfil</title>

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
                <div class="html-editor pd-20 card-box p-3 mb-30 bg-info text-white">
                    <h4 class="text-uppercase text-center text-white"><i class="icon-copy fi-torso-business"></i> MI PERFIL </h4>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                        <div class="pd-20 card-box height-100-p">
                            <div class="profile-photo">
                                <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
                                <img src="src/images/logo.png" alt="" class="avatar-photo">
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
                            <h5 class="text-center h5 mb-0">FERRETERIA VEYSER</h5>
                            <p class="text-center text-muted font-14">S.A.C</p>
                            <div class="profile-info">
                                <ul>
                                    <li>
                                        <span>RUC: </span>
                                        10456548750
                                    </li>
                                    <li>
                                        <span>NOMBRE: </span>
                                        FERRETERIA VEYSER S.A.C
                                    </li>
                                    <li>
                                        <span>RAZÓN SOCIAL: </span>
                                        - - -
                                    </li>
                                    <li>
                                        <span>TELÉFONO: </span>
                                        987345098<br>
                                    </li>
                                    <li>
                                        <span>DIRECCIÓN: </span>
                                        CHINCHA, CHINCHA ALTA<br>
                                        CALLE LIMA
                                    </li>
                                    <li>
                                        <span>CORREO: </span>
                                        FERRETERIA.VEYSER@GMAIL.COM
                                    </li>
                                </ul>
                            </div>
                            <div class="profile-social">
                                <h5 class="mb-20 h5 text-blue">ENLACES DE NUESTRA REDES SOCIALES</h5>
                                <ul class="clearfix">
                                    <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
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
                                            <a class="nav-link active" data-toggle="tab" href="#tasks" role="tab">Actualización</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- Tasks Tab start -->
                                        <div class="tab-pane fade show active" id="tasks" role="tabpanel">
                                            <div class="pd-20 profile-task-wrap">
                                                <div class="container pd-0">
                                                    <!-- Open Task start -->
                                                    <div class="profile-task-list pb-30">
                                                        <div class="profile-setting">
                                                            <div class="alert alert-dismissible fade show">
                                                                <?php echo isset($alert) ?  $alert : ''; ?>
                                                            </div>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                                                <div class="form-group">
                                                                    <label>NOMBRE: </label>
                                                                    <input class="form-control form-control-lg" name="nombre" type="text" value="<?php echo $nombre; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>APELLIDO</label>
                                                                    <input class="form-control form-control-lg" name="apellido" type="text" value="<?php echo $apellido; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>USUARIO</label>
                                                                    <input class="form-control form-control-lg" name="usuario" type="text" value="<?php echo $usuario; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>CORREO: </label>
                                                                    <input class="form-control form-control-lg" name="email" type="text" value="<?php echo $email; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>CELULAR: </label>
                                                                    <input class="form-control form-control-lg" name="celular" type="text" value="<?php echo $celular; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>DIRECCIÓN: </label>
                                                                    <input class="form-control form-control-lg" name="direccion" type="text" value="<?php echo $direccion; ?>">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                                            </form>
                                                        </div>
                                                    </div>
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