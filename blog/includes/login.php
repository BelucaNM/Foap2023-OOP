<?php

session_start();
if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["send"])) {

    echo $_POST["send"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controllers/UserContr.php";

  
    $login = new UserContr($username, $password);
    $login->loginUser();
  
/*     header("Location: ../view/login.html?error=none"); */

}