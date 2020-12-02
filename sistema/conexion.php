<?php

$host = 'localhost';
$user = 'root';
$password = '';
$bd = 'bd_ferreteria';

$con = @mysqli_connect($host, $user, $password, $bd);
/* comprueba la conexión */
if (!$con) {
    echo ("Error en la conexión");
}

?>