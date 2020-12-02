<?php
include "conexion.php";
session_start();

    if (!empty($_POST)) {
        //Buscar cliente
        if ($_POST['action'] == 'searchCliente') {
            if (!empty($_POST['cliente'])) {
                $dni = $_POST['cliente'];

                $query = mysqli_query($con, "SELECT * FROM clientes WHERE dni_ruc LIKE '$dni' and estado_cliente = 1 ");

                mysqli_close($con);
                $result = mysqli_num_rows($query);

                $data = '';
                if ($result > 0) {
                    $data = mysqli_fetch_assoc($query);
                } else {
                    $data = 0;
                }
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
            }
            exit;
        }

        //Registrar cliente desde venta
        if ($_POST['action'] == 'addCliente') {

            $dni = $_POST['dni_cliente'];
            $nombre  = $_POST['nom_cliente'];
            $telefono = $_POST['tel_cliente'];
            $direccion = $_POST['dir_cliente'];
            $usuario_id = $_SESSION['id'];

            $query_insert = mysqli_query($con, "INSERT INTO clientes (nombre, dni_ruc, telefono, direccion, usuario_id ) VALUES ('$nombre','$dni','$telefono','$direccion','$usuario_id')");

            if ($query_insert) {
                $codCliente = mysqli_insert_id($con);
                $msg = $codCliente;
            } else {
                $msg = 'error';
            }
            mysqli_close($con);
            echo $msg;
            exit;
        }

        //Obtener información del producto
        if ($_POST['action'] == 'infoProducto') {
            $producto_id = $_POST['producto'];

            $query = mysqli_query($con, "SELECT id_producto, descripcion, cantidad, precio 
                FROM producto WHERE id_producto = $producto_id AND estado = 1");

            mysqli_close($con);

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                exit;
            }
            echo "error";
            exit;
        }

        //Agregar producto al detalle temporal 
        if ($_POST['action'] == 'addProductoDetalle') {
            if (empty($_POST['producto']) || empty($_POST['cantidad'])) {
                echo "Error";
            } else {
                $codproducto = $_POST['producto'];
                $cantidad = $_POST['cantidad'];
                $token = md5($_SESSION['id']);

                $query_igv = mysqli_query($con, "SELECT igv FROM configuracion");
                $result_igv = mysqli_num_rows($query_igv);

                $query_detalle_temp = mysqli_query($con, "CALL add_detalle_temp($codproducto, $cantidad, '$token')");
                $result = mysqli_num_rows($query_detalle_temp);

                $detalleTabla = '';
                $sub_total = 0;
                $igv = 0;
                $total = 0;
                $arrayData = array();

                if ($result > 0) {
                    if ($result_igv > 0) {
                        $info_igv = mysqli_fetch_assoc($query_igv);
                        $igv = $info_igv['igv'];
                    }

                    while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                        $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
                        $sub_total = round($sub_total + $precioTotal, 2);
                        $total = round($total + $precioTotal, 2);

                        $detalleTabla .= '<tr>
                                <td>' . $data['id_producto'] . '</td>
                                <td colspan="2">' . $data['descripcion'] . '</td>
                                <td class="textcenter">' . $data['cantidad'] . '</td>
                                <td class="textright">' . $data['precio_venta'] . '</td>
                                <td class="textright">' . $precioTotal . '</td>
                                <td class="">
                                    <a class="link_delete" href="#" 
                                    onclick="event.preventDefault(); del_producto_detalle(' . $data['correlativo'] . ');">
                                    <i class="far fa-trash-alt"></i></a>
                                </td> </tr>';
                    }

                    $impuesto = round($sub_total * ($igv / 100), 2);
                    $tl_sinigv = round($sub_total - $impuesto, 2);
                    $total = round($tl_sinigv + $impuesto, 2);

                    $detalleTotales = '<tr>
                                                <td colspan="5" class="textright">SubTotal</td>
                                                <td class="textright">' . $tl_sinigv . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">IGV (' . $igv . '%) </td>
                                                <td class="textright">' . $impuesto . '</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">TOTAL</td>
                                                <td class="textright">' . $total . '</td>
                                            </tr>';

                    $arrayData['detalle'] = $detalleTabla;
                    $arrayData['totales'] = $detalleTotales;

                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
                } else {
                    echo "Error";
                }
                mysqli_close($con);
            }
        }

        //Extrae datos del detalle_temp
        if ($_POST['action'] == 'serchForDetalle') {
            if (empty($_POST['user'])) {
                echo "Error";
            } else {

                $token = md5($_SESSION['id']);

                $query = mysqli_query($con, "SELECT tmp.correlativo, tmp.token_user, tmp.cantidad, tmp.precio_venta, p.id_producto, p.descripcion FROM detalletemp tmp INNER JOIN producto p ON tmp.id_producto = p.id_producto WHERE token_user = '$token'");

                $result = mysqli_num_rows($query);

                $query_igv = mysqli_query($con, "SELECT igv FROM configuracion");
                $result_igv = mysqli_num_rows($query_igv);

                $detalleTabla = '';
                $sub_total = 0;
                $igv = 0;
                $total = 0;
                $arrayData = array();

                if ($result > 0) {
                    if ($result_igv > 0) {
                        $info_igv = mysqli_fetch_assoc($query_igv);
                        $igv = $info_igv['igv'];
                    }

                    while ($data = mysqli_fetch_assoc($query)) {
                        $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
                        $sub_total = round($sub_total + $precioTotal, 2);
                        $total = round($total + $precioTotal, 2);

                        $detalleTabla .= '<tr>
                                <td>' .$data['id_producto']. '</td>
                                <td colspan="2">'.$data['descripcion'].'</td>
                                <td class="textcenter">'.$data['cantidad'].'</td>
                                <td class="textright">'.$data['precio_venta'].'</td>
                                <td class="textright">'.$precioTotal.'</td>
                                <td class="">
                                    <a class="link_delete" href="#" 
                                    onclick="event.preventDefault(); del_producto_detalle('.$data['correlativo'].');">
                                    <i class="far fa-trash-alt"></i></a>
                                </td> </tr>';
                    }

                    $impuesto = round($sub_total * ($igv / 100), 2);
                    $tl_sinigv = round($sub_total - $impuesto, 2);
                    $total = round($tl_sinigv + $impuesto, 2);

                    $detalleTotales = '<tr>
                                                <td colspan="5" class="textright">SubTotal</td>
                                                <td class="textright">'.$tl_sinigv.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">IGV (' . $igv . '%) </td>
                                                <td class="textright">'.$impuesto.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">TOTAL</td>
                                                <td class="textright">'.$total.'</td>
                                            </tr>';

                    $arrayData['detalle'] = $detalleTabla;
                    $arrayData['totales'] = $detalleTotales;

                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
                } else {
                    echo "Error";
                }
                mysqli_close($con);
            }
        } 

        //Opcion elimminar en los productos temporales
        if ($_POST['action'] == 'delProductoDetalle') {
            if (empty($_POST['id_detalle'])) {
                echo "Error";
            } else {

                $id_detalle = $_POST['id_detalle'];
                $token = md5($_SESSION['id']);

                $query_igv = mysqli_query($con, "SELECT igv FROM configuracion");
                $result_igv = mysqli_num_rows($query_igv);

                $query_detalle_temp = mysqli_query($con, "CALL del_detalle_temp($id_detalle, '$token')");
                $result =mysqli_num_rows($query_detalle_temp);

                $detalleTabla = '';
                $sub_total = 0;
                $igv = 0;
                $total = 0;
                $arrayData = array();

                if ($result > 0) {
                    if ($result_igv > 0) {
                        $info_igv = mysqli_fetch_assoc($query_igv);
                        $igv = $info_igv['igv'];
                    }

                    while ($data = mysqli_fetch_assoc($query_detalle_temp)) {
                        $precioTotal = round($data['cantidad'] * $data['precio_venta'], 2);
                        $sub_total = round($sub_total + $precioTotal, 2);
                        $total = round($total + $precioTotal, 2);

                        $detalleTabla .= '<tr>
                                <td>' .$data['id_producto']. '</td>
                                <td colspan="2">'.$data['descripcion'].'</td>
                                <td class="textcenter">'.$data['cantidad'].'</td>
                                <td class="textright">'.$data['precio_venta'].'</td>
                                <td class="textright">'.$precioTotal.'</td>
                                <td class="">
                                    <a class="link_delete" href="#" 
                                    onclick="event.preventDefault(); del_producto_detalle('.$data['correlativo'].');">
                                    <i class="far fa-trash-alt"></i></a>
                                </td> </tr>';
                    }

                    $impuesto = round($sub_total * ($igv / 100), 2);
                    $tl_sinigv = round($sub_total - $impuesto, 2);
                    $total = round($tl_sinigv + $impuesto, 2);

                    $detalleTotales = '<tr>
                                                <td colspan="5" class="textright">SubTotal</td>
                                                <td class="textright">'.$tl_sinigv.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">IGV (' . $igv . '%) </td>
                                                <td class="textright">'.$impuesto.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="textright">TOTAL</td>
                                                <td class="textright">'.$total.'</td>
                                            </tr>';

                    $arrayData['detalle'] = $detalleTabla;
                    $arrayData['totales'] = $detalleTotales;

                    echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
                } else {
                    echo "Error";
                }
                mysqli_close($con);
            }
        }

        //Anular venta
        if ($_POST['action'] == 'anularVenta') {
            $token = md5($_SESSION['id']);

            $query_del = mysqli_query($con, "DELETE FROM detalletemp WHERE token_user = '$token' ");
            mysqli_close($con);
            if ($query_del) {
                echo 'ok';
            } else {
                echo 'Errorre';
            }
            exit;
        }

         //Procesar venta
        if ($_POST['action'] == 'procesarVenta') {
            if (empty($_POST['codcliente'])) {
                $codcliente = 1;
            } else {
                $codcliente = $_POST['codcliente'];
            }

            $token = md5($_SESSION['id']);
            $usuario = $_SESSION['id'];

            $query = mysqli_query($con, "SELECT * FROM detalletemp WHERE token_user = '$token' ");
            $result = mysqli_num_rows($query);

            if ($result > 0) 
            {
                $query_procesar = mysqli_query($con, "CALL procesar_venta($usuario, $codcliente, '$token')");
                $result_detalle = mysqli_num_rows($query_procesar);

                if ($result_detalle > 0) {
                    $data = mysqli_fetch_assoc($query_procesar);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                } 
                else {
                    echo "Error";
                } 
            } else {
                echo "Error";
            }
            mysqli_close($con);
            exit;
        }

        //Información de la factura
        if ($_POST['action'] == 'infoFactura') {
            if (!empty($_POST['nofactura'])) {

                $nofactura = $_POST['nofactura'];

                $query = mysqli_query($con, "SELECT * FROM factura WHERE nofactura = '$nofactura' AND estado = 1");
                mysqli_close($con);

                $result = mysqli_num_rows($query);

                if ($result > 0) {
                    $data = mysqli_fetch_assoc($query);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            echo "Error";
            exit;
        }

        //Anular Factura
        if ($_POST['action'] == 'anularFactura') {
            if (!empty($_POST['noFactura'])) {
                $noFactura = $_POST['noFactura'];

                $query_anular = mysqli_query($con, "CALL anular_factura($noFactura)");
                mysqli_close($con);

                $result = mysqli_num_rows($query_anular);
                if ($result > 0) {
                    $data = mysqli_fetch_assoc($query_anular);
                    echo json_encode($data, JSON_UNESCAPED_UNICODE);
                    exit;
                }
            }
            echo "Error";
            exit;
        }
    }
    exit;
?>
