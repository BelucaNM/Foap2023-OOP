
<?php
    $token = $_GET["token"];

    //instanciar las classes
    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controllers/usuarioContr.php";

    $newUsuario = new usuarioContr("","","","",$token);
   
    //ejecutar gestor de errores i crear nuevo password
    $newUsuario->activateAccount();

    //rederigir a la pagina de login
    
?>