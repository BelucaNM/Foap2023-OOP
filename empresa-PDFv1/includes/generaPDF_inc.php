<?php
if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['numcomanda']) ){

$numcomanda = $_GET["numcomanda"];
//echo 'Creando instancia de pedido <br>';
require "../model/connection.php";
require "../model/pedido.php";
require "../controllers/pedidoContr.php";

$formatoInvoice_php ="invoice.php";
$pedidoContr= new pedidoContr($numcomanda);
$pedidoContr->setformatoInvoice_php($formatoInvoice_php);
$pedidoContr->creaInvoice();


}
?>