
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['signIn']) ){// Validaciones
    
    $username = $_POST["username"];
    $password = $_POST["password"];
/*    $recordar = "";
    if(isset($_POST["recordar"])) {$recordar = $_POST["recordar"];}; */
    

    echo 'Creando instancia de registro <br>';
    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controllers/usuarioContr.php";

    
    $loginContr= new usuarioContr($username, $password);
//    $loginContr->setRecordar($recordar);
    $loginContr->login();
              
   
};
    
?>
