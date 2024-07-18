<?php
//echo 'Creando instancia de tabla de pisos <br>';
require "../model/connection.php";
require "../model/piso.php";
require "../controler/pisoContr.php";

$pisoContr = new pisoContr();
$todos= $pisoContr->getTodos();

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los pisos <br>";
        $num=0;
} else {
//        print_r($todos);
        $num = $pisoContr->tablaNumReg;
//        echo " Hay ".$num." registros.<br>";
} 
?>