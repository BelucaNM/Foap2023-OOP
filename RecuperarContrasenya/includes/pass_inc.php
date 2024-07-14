
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
    
    print_r($_POST);

    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    $token=$_POST["token"];
    
    echo 'Creando instancia de registro <br>';
    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controllers/usuarioContr.php";

    
    $passContr= new usuarioContr("", $password1,$password2,"",$token);
    $passContr->valUpdatePassword();
              
   
};
?>