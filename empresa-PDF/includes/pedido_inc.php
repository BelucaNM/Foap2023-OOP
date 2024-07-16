
<?php
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){

    $numcomanda = $_GET["numcomanda"];


    //echo 'Creando instancia de lineas de pedido <br>';
    require "../model/connection.php";
    require "../model/lineaPedido.php";
    require "../controllers/lineaPedidoContr.php";

    
    $passContr= new lineaPedidoContr($numcomanda);
    
    $lineas = $passContr->consultaLineas();
    $pedido = $passContr->consultaPedido();
   
    
    };

?>