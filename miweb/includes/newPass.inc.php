
<?php

// print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
    
    print_r($_POST);

    $password1 = $_POST["pwd"];
    $password2 = $_POST["repeatPwd"];
    $token=$_POST["token"];
    
//    echo 'Creando instancia de registro <br>';
    require "../model/Connection.php";
    require "../model/User.php";
    require "../controllers/userContr.php";

    
    $passContr= new UserContr("", $password1,$password2,"",$token);
    $passContr->valUpdatePassword();
              
   
};
?>