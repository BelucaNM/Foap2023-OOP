
<?php


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
   

    $email = $_POST['email'];

    echo 'Creando instancia de registro <br>';
    require "../model/connection.php";
    require "../model/usuario.php";
    print_r($_POST);
    require "../controllers/emailContr.php";
    
    $emailContr= new emailContr($email);
    $emailContr->forgotPassword();

    
};
    
?>