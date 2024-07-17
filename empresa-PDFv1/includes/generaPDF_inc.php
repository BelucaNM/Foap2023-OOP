<?php
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){

$numcomanda = $_GET["numcomanda"];
//echo 'Creando instancia de pedido <br>';
require "../model/connection.php";
require "../model/pedido.php";
require "../controllers/pedidoContr.php";

$formatoInvoice ="invoice.php";
$pedidoContr= new pedidoContr($numcomanda,$formatoInvoice);
$pedidoContr->leerPedido();
$pedidoContr->leerLineas();
$pedidoContr->crearInvoice();
}
?>