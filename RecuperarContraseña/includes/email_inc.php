
<?php

print_r($_POST);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) ){// Validaciones
    
    $email = $_POST["email"];
    

    echo 'Creando instancia de registro <br>';
    require "../model/connection.php";
    require "../model/usuario.php";
    require "../controlers/emailContr.php";

    
    $emailContr= new emailContr($email);
    $user = $emailContr->forgotPassword();


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'foap408@gmail.com';
    $mail->Password = 'dyrv alyq ojiq acyd';
//    $mail->addAddress('$this->email', 'Usuario Blog');
    $mail->addAddress('beluca.navarrina@gmail.com', 'Beluca');
    $mail->Subject = "Recuperar Contraseña Foap2023-OOP/blog";

//Replace the plain text body with one created manually
    $mail->Body = "Hola $user,\n\nPara recuperar tu contraseña,
    haz click en el siguiente enlace:\n\n$link\n\nSi no has solicitado este
    correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
    $link= "C:\xampp\htdocs\Foap2023-OOP\RecuperarContraseña\views\pass_inc.php?user=$user;"; // aqui tendria que poner el token?


//send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo 'Message sent!';
    }
// vuelve a login
    header("Location: ../views/login.html");
              
   
};
    
?>
