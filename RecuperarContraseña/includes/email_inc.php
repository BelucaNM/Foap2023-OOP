
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
    
    $email = $_POST["email"];
    

    echo 'Creando instancia de registro <br>';
    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controlers/emailContr.php";

    
    $emailContr= new emailContr($email);
    $emailContr->forgotPassword();
              
   
};
    
?>
