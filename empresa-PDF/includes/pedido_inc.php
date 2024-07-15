
<?php


if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){// Validaciones
    
    $numcomanda = $_GET["numcomanda"];
    
    echo 'Creando instancia de lineas de pedido <br>';
    require "../model/connection.php";
    require "../model/lineaPedido.php";
    require "../controllers/lineaPedidoContr.php";

    
    $passContr= new lineaPedidoContr($numcomanda);
    echo "paso 1";
    $lineas = $passContr->consultaLineas();
    echo "paso 2";
    $pedido = $passContr->consultaPedido();
   

   
};
?>