<?php


session_start();
if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 3) {
    header("location: ./");
}

include 'conexion.php';
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Reporte de Productos</title>

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
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
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
                    <h4 class="text-uppercase text-center text-white">REPORTE DE LOS PRODUCTOS</h4>
                </div>
                <!-- Simple Datatable start -->
                <div class="card-box mb-30">
                    <!-- Export Datatable start -->
                    <div class="card-box mb-30">
                        <div class="pd-20">

                        </div>
                        <div class="pb-20 table-responsive">
                            <table class="table hover multiple-select-row data-table-export nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PRODUCTO</th>
                                        <th>PROVEEDOR</th>
                                        <th>PRECIO</th>
                                        <th>CANTIDAD</th>
                                        <th>FECHA</th>
                                        <th>REGISTRADO POR</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT p.id_producto, p.descripcion, p.precio, p.cantidad,
									p.fecha, u.usuario, r.proveedor 
									FROM producto p INNER JOIN usuarios u ON p.usuario_id = u.id INNER JOIN proveedores r ON p.proveedor = r.id_proveedor  WHERE p.estado = 1 ");

                                    $resultado = mysqli_num_rows($sql);

                                    if ($resultado > 0) {
                                        while ($dato = mysqli_fetch_array($sql)) {

                                    ?>
                                            <tr class="row<?php echo $dato['id_producto'] ?>">
                                                <td> <?php echo $dato['id_producto'] ?> </td>
                                                <td> <?php echo $dato['descripcion'] ?> </td>
                                                <td> <?php echo $dato['proveedor'] ?> </td>
                                                <td class="celPrecio"> <?php echo $dato['precio'] ?> </td>
                                                <td class="celCantidad"> <?php echo $dato['cantidad'] ?> </td>
                                                <td> <?php echo $dato['fecha'] ?> </td>
                                                <td> <?php echo $dato['usuario'] ?> </td>
                                                <td>
                                                    <a class="btn btn-success" href="editarProducto.php?id=<?php echo $dato['id_producto'] ?>">Editar</a>
                                                    <a class="btn btn-danger" href="eliminarProducto.php?id=<?php echo $dato['id_producto'] ?>">Eliminar</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Export Datatable End -->
                </div>
            </div>
        </div>
        <!-- js -->

        <!-- <script src="src/scripts/functions.js"></script>
        <script src="src/scripts/jquery.min.js"></script> -->
        <script src="vendors/scripts/core.js"></script>
        <script src="vendors/scripts/script.min.js"></script>
        <script src="vendors/scripts/process.js"></script>
        <script src="vendors/scripts/layout-settings.js"></script>
        <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
        <!-- buttons for Export datatable -->
        <script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.print.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
        <script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
        <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
        <script src="src/plugins/datatables/js/vfs_fonts.js"></script>
        <!-- Datatable Setting js -->
        <script src="vendors/scripts/datatable-setting.js"></script>

</body>

</html>