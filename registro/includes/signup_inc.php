
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    echo 'Creando instancia de registro <br>';
    require "../modelo/connection.php";
    require "../modelo/usuario.php";
    require "../controlador/usuarioContr.php";

//    require "../controlador/autoload_controlador.php";
    $usuarioContr= new usuarioContr($username, $password1, $password2, $email);
    $usuarioContr->signupUser();

    //Volver a la pagina inicial--- 
//    header("Location: ../vista/signup.html?error=none");
    header("Location: ../vista/listaUsuarios.php");
               
    
};
    
?>