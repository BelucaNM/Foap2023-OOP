<?php
//echo 'Creando instancia de tabla de Pedidos <br>';
require "../model/connection.php";
require "../model/pedido.php";

$pedido = new pedido();
$todos= $pedido->getTodos();

if ($todos == 1 ) { // error STMT
        echo "Error al obtener todos los usuarios <br>";
        $num=0;
    };
    ?>