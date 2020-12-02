<?php

    date_default_timezone_set('America/Lima');

    function fecha()
    {
        $mes = array("","Enero",
        "Febrero", 
        "Marzo", 
        "Abril",
        "Mayo", 
        "Junio", 
        "Julio", 
        "Agosto",
        "Setiembre",
        "Octubre",
        "Noviembre",
        "Diciembre");

        $dia = array("",
        "Lunes",
        "Martes", 
        "Miercoles", 
        "Jueves", 
        "Viernes", 
        "Sábado",
        "Domingo");

    return $dia[date('N')]." ". date('d')." de "
    .$mes[date('n')] . " del ". date('Y') . " / " 
    . date('h') . " : " . date('i') . " : " . " " . date('A');
    }

?>