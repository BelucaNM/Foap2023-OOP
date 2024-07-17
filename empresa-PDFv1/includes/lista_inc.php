<?php
//echo 'Creando instancia de tabla de Pedidos <br>';
require "../model/connection.php";
require "../model/lineaPedido.php";

$lineaPedido = new lineaPedido();
$todos= $lineaPedido->getTodos();

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los usuarios <br>";
        $num=0;
    };
    ?>