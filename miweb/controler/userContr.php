<?php 

class UserContr extends User{
    private $username;
    private $password;
    private $repeatPwd;
    private $email;
    private $token;

    public function __construct($username, $password, $repeatPwd=null, $email=null, $token=null){
        $this->username = $username;
        $this->password = $password;
        $this->repeatPwd = $repeatPwd;
        $this->email = $email;
        $this->token = $token;
    }

    /**Setters and getters */
    public function setUsername($username){
         $this->username = $username;
    }
    public function getUsername(){
        return $this->username;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }
   
    public function setRepeatPwd($repeatPwd){
        $this->repeatPwd = $repeatPwd;
    }
    public function getRepeatPwd(){
        return $this->repeatPwd;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
       return $this->email;
    }
    /*** */

    public function signupUser(){

        //validation
        if($this->emptyInput($this->username) == false || $this->emptyInput($this->password) == false || $this->emptyInput($this->repeatPwd) == false || $this->emptyInput($this->email) == false){
            header("Location: ../view/signup.php?error=emptyInput");
            exit();
        }
        if($this->invalidUsername() == false){
        header("Location: ../view/signup.php?error=invaliduid");
        exit();
        }
        if($this->invalidEmail() == false){
            header("Location: ../view/signup.php?error=invalidemail");
            exit();
        }
        if($this->pwdMatch() == false){
            header("Location: ../view/signup.php?error=pwdmatch");
            exit();
        }
        if($this->usernameTakenChec() == false){
            header("Location: ../view/signup.php?error=usermailtaken");
            exit();
        }

        //setUser to DB
        if($this->setUser($this->username, $this->password, $this->email)){
            header("Location: ../view/signup.php?error=FailedStmt");
        }
    }


    public function loginUser(){

        //validation
        if($this->emptyInput($this->username) == false|| $this->emptyInput($this->password) == false){
            header("Location: ../index.php?error=emptyInput");
            exit();
        }

        //verifyUser in DB
        $res = $this->verifyLoginUser($this->username, $this->password);
        if($res==1){
            header("Location: ../index.php?error=FailedStmt");
        }
        if($res==2){
            header("Location: ../index.php?error=invalidPassUser");
        }
    }
    private function emptyInput($input){
        $result = true;

        if(empty($input)){
            $result = false;
        }
        return $result;
    }

    private function invalidUsername(){
        $result = true;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->username)){
            $result = false;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = true;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        }
        return $result;
    }

    private function pwdMatch(){
        $result = true;
        if($this->password !== $this->repeatPwd){
            $result = false;
        }
        return $result;
    }

    private function usernameTakenChec(){
        $result = true;
        if($this->checkUser($this->username, $this->email)){
            $result = false;
        }
        return $result;
    }

    // codigo Añadido

    public function valUpdatePassword(){
        // validaciones

       if ($this->emptyInputTres() == true){
           echo " la entrada está vacia";
            header ('location: ../view/newpassword.php?error=EmptyInput&token='.$this->token); 
            exit();
            }
            
        if ($this->password != $this->repeatPwd){
            echo " las contraseñas no coinciden";
            header ("location: ../view/newpassword.php?error=PasswordsDontMatch&token=".$this->token); 
            exit();
            }
        
        // COMPROBAR QUE EL TOKEN EXISTE Y NO ESTA CADUCADO
        // checkToken
        // devuelve 1 si error en statement
        // devuelve 2 si token no existe
        // devuelve 3 si token esta caducado
        $result = $this->checkToken($this->token);
        if ($result == 1) {
            echo " el stmt es incorrecto";
            header ("location: ../view/newpassword.php?error=FailedStmt");
        exit();
        }
        if ($result == 2) { 
            echo " el token  no existe";
            header ("location: ../view/newpassword.php?error=tokenNotExist"); 
            exit();
        }
        if ($result == 3) {
            echo " el token está caducado";
            header ("location: ../view/newpassword.php?error=tokenExpired"); 
            exit();
        }



        $result = $this->updatePassword($this->token,$this->password); // en usuario.php
        echo $this->token;
        echo $this->password;
        if (!$result) {
                echo " no se ha podido hacer la actualización";
                header ("location: ../view/index.php?error=FailedStmt");
                exit();
        } else {
                echo " actualización realizada con éxito";
                header ("location: ../view/index.php?error=NewPassSaved");
                exit();
            }
        //setUser to BD

    }
    private function emptyInputTres(){
        $result = false;
        if ( empty($this->password) || empty($this->passwordRep) || empty($this->token)){
            $result = true;
        }
        return $result;

    
        } 

    protected function updatePassword($token, $password) {        
            $result = true;
            $stmt = $this->connect()->prepare("UPDATE users SET users_pwd = ?, token=null, deadLine=now() WHERE token = ?");
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        
            if(!$stmt->execute(array($hashedPwd, $token))){
                $result = false;
                }
                   
            $stmt = null;
            return $result;
            }

Public function forgotPassword(){
                // validaciones
        
    if (!$this->is_valid_email($this->email)){
                header ("location: ../view/forgotpassword.html?error=InvalidEmail"); 
                exit();}
        
    //chequea email existe en BD
    echo "forgotPassword";
        
    $result = $this->checkUserByEmail($this->email);
        print_r($result);
        if ($result[0] == 1) { header("Location: ../view/forgotpassword.html?error=FailedStmt");
                                    exit();}
        if ($result[0] == 2) { header("Location: ../view/forgotpassword.html?error=EmailDoesNotExist");
                                    exit();}
                    
        // $result[1]  es el username           
                 
     //  $this->setToken(bin2hex(random_bytes(16))); //  crear un token
                $this->generateToken();
                   
                //actualiza registro to DB
                if (!$this->updateConToken($this->email,$this->token)) {
                        header("Location: ../view/forgotpassword.html?error=FailedUpdateToken");     
                        exit();} 
                        
                    // si todo esta bien, envia email
                $err= $this->enviaEmail('forgotPassword'); 
        
                    //check for errors  
                if (!$err) {
                        header("Location: ../index.php?error=emailForgotPassword");
                        exit();
                    } else {
                        header("Location: ../index.php?error=FailedSendEmail");
                        exit();}                            
                }
        
public function is_valid_email($str)
                {
                    return filter_var($str, FILTER_VALIDATE_EMAIL);
                }   
Private function generateToken(){
        $this->token = bin2hex(random_bytes(16));
        } 

Private function enviaEmail($issue){
            /*use PHPMailer\PHPMailer\PHPMailer;
              use PHPMailer\PHPMailer\Exception;
              use PHPMailer\PHPMailer\SMTP;*/

            require '../../PHPMailer/src/Exception.php';
            require '../../PHPMailer/src/PHPMailer.php';
            require '../../PHPMailer/src/SMTP.php';
            
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Username = 'foap408@gmail.com';
            $mail->Password = 'dyrv alyq ojiq acyd';
        //    $mail->addAddress('$this->email', 'Usuario Blog');
            $mail->addAddress('beluca.navarrina@gmail.com', 'Beluca');
            $mail->Subject = "Recuperar Contraseña Foap2023-OOP/blog";

        //Replace the plain text body with one created manually
        //Para enviar texto plano     
            
            if ($issue == 'forgotPassword'){
                $link= 'http://localhost/Foap2023-OOP/miweb/view/newpassword.php?token='.$this->token; // aqui hay que enviar el token
                $mail->Body = "Hola,\n\nPara recuperar tu contraseña, haz click en el enlace siguiente. Si no has solicitado este
                    correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
                $mail->msgHTML("<a href='".$link."'> Link para crear nueva contraseña</a>"); 
                };
            if ($issue == 'activacion'){
                $link= 'http://localhost/Foap2023-OOP/miweb/includes/activacion_inc.php?token='.$this->token; // aqui hay que enviar el token
                $mail->Body = "Hola,\n\nPara activar tu cuenta, haz click en el enlace siguiente. Si no has solicitado este
                    correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
                $mail->msgHTML("<a href='".$link."'> Link para activar su cuenta </a>"); 
                };


            $err = 0;
            if (!$mail->send()) {
                echo 'Mailing Error: ' . $mail->ErrorInfo;
                $err = 1;
            } else {
                echo 'Message sent!';
            }
            return $err;
        } 

}