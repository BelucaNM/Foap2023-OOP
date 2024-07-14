<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controllers/UserContr.php";


    $register = new UserContr($username, $password, $email);

   $register->signupUser();
    /* $register->setUser($username, $password, $email) */;

    /*  header("Location: ../view/home.php"); */

}