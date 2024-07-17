
<?php
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){

    $numcomanda = $_GET["numcomanda"];


    //echo 'Creando instancia de pedido <br>';
//    require "../model/connection.php";
//    require "../model/lineaPedido.php";
//    require "../controllers/lineaPedidoContr.php";

    
    $nuevoContr= new lineaPedidoContr($numcomanda);
    
    $lineas = $nuevoContr->consultaLineas();
    $pedido = $nuevoContr->consultaPedido();
   
    
    };

?>