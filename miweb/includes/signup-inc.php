<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){

    // recoger datos del formulario
    $username = $_POST["uid"];
    $password = $_POST["pwd"];
    $repeatPassword = $_POST["repeatPwd"];
    $email = $_POST["email"];

    //instanciar las classes
    require "autoload.models.php";
    require "autoload.controlers.php";

    $signup = new UserContr($username, $password, $repeatPassword, $email);
    $signup->signupUser();

    //Volver a la pagina inicial
    header("Location: ../index.php");

}