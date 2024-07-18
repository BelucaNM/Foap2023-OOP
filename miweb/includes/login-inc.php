<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // recoger datos del formulario
    $username = $_POST["uid"];
    $password = $_POST["pwd"];


    require "autoload.models.php";
    require "autoload.controlers.php";

    $login = new UserContr($username, $password);
    $login->loginUser();

    session_start();
    $_SESSION["user"] = $username;

    //Volver a la pagina inicial
    header("Location: ../view/pisos.php");

}