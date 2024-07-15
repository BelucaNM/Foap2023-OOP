
<?php
    $token = $_GET["token"];

    //instanciar las classes
    require "../model/connection.php";
    require "../model/usario.php";
    require "../controler/emailContr.php";

    $newEmail = new emailContr($token);
   
    //ejecutar gestor de errores i crear nuevo password
    $newEmail->activateAccount();

    //rederigir a la pagina de login
    
?>