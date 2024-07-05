
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['signIn']) ){// Validaciones
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $recordar = "";
    if(isset($_POST["recordar"])) {$recordar = $_POST["recordar"];};
    

    echo 'Creando instancia de registro <br>';
    require "../modelo/connection.php";
    require "../modelo/usuario.php";
//    require "../controlador/loginContr.php"; lo hacemos sobre el usuario
    require "../controlador/usuarioContr.php";

//    require "../controlador/autoload_controlador.php"; no lo usamos
    
    $loginContr= new usuarioContr($username, $password);
    $loginContr->setRecordar($recordar);
    $loginContr->login();
              
   
};
    
?>
