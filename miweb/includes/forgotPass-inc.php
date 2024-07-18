
<?php

echo $_POST['email'] ;
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
   

    $email = $_POST['email'];

    echo 'Creando instancia de registro <br>';
    require "../model/Connection.php";
    require "../model/User.php";
    print_r($_POST);
    require "../controler/userContr.php";
    
    $emailContr= new userContr("","","",$email);
    $emailContr->forgotPassword();
    
};
    
?>
