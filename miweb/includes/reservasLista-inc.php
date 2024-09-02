<?php
//echo 'Creando instancia de tabla de pisos <br>';
require "../model/connection.php";
require "../model/reserva.php";
require "../controler/reservaContr.php";

$user='admin';

$reservaContr = new reservaContr("","","",$user);
$todos= $reservaContr->getReservas();

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los pisos <br>";
        $num=0;
} else {
//     print_r($todos);
//      echo " Hay ".$num." registros.<br>";
} 
?>