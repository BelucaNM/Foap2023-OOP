<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

    // recoger datos del formulario
    $uidpis = $_GET["uidpis"];
 
    require "autoload.models.php";
    require "autoload.controlers.php";

    $pisoContr = new pisoContr($uidpis);
    $pisoContr->borraPiso();


}
?>