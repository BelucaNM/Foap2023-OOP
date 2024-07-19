<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){

    // recoger datos del formulario
    $idpis = $_GET["idpis"];
    $users_users_uid = $_GET["users_users_uid"];

  //echo $idpis;
  //echo $users_users_uid;

    require "autoload.models.php";
    require "autoload.controlers.php";

    $reservaContr = new reservaContr("","",$idpis,$users_users_uid);
    $reservaContr-> altaReserva();


}
?>