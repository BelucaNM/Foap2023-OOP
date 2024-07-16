
<?php
class emailContr extends usuario {
        private $email;
        private $token;
        private $activo;

        public function __construct($email="",$token="") {
                $this->email = $email;
                $this->token = $token;
                } 
        public function __destruct() { 
                    echo "Se ha destruido el registro";
                }
        public function getEmail() {
            return $this->email;
            }
        public function setEmail($email) {
            $this->email = $email;
            }
        
        public function getToken() {
            return $this->token;
            }
        
        public function setToken($token) {
            $this->token = $token;
            }
      
        private function emptyInput(){
            $result = false;
            if (empty($this->email)){
                $result = true;
            }
            return $result;
            }

        Public function forgotPassword(){
            // validaciones

            if ($this->emptyInput()){
                header ("location: ../views/introducirEmail.html?error=EmptyEmail"); 
                exit();}

            //chequea email existe en BD
            echo "forgotPassword";
            $result = $this->checkUserByEmail($this->email);
            print_r($result);
            if ($result[0] == 1) { header("Location: ../views/introducirEmail.html?error=FailedStmt");
                            exit();}
            if ($result[0] == 2) { header("Location: ../views/introducirEmail.html?error=EmailDoesNotExist");
                            exit();}
            
            // $result[1]  es el username           
         
        //  $this->setToken(bin2hex(random_bytes(16))); //  crear un token
            $this->generateToken();
           
            //actualiza registro to DB
            if (!$this->updateConToken($this->email,$this->token)) {
                header("Location: ../views/introducirEmail.html?error=FailedUpdateToken");     
                exit();} 
                
            // si todo esta bien, envia email
            $err= $this->enviaEmail('forgotPassword'); 

            //check for errors  
            if (!$err) {
                header("Location: ../views/login.html?error=Message sent! Please check your email.");
                exit();
            } else {
                header("Location: ../views/login.html?error=FailedSendEmail");
                exit();}                            
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

            
            
        //  Para enviar texto plano     
            $mail->Body = "Hola,\n\nPara recuperar tu contraseña,
            haz click en el enlace siguiente. Si no has solicitado este
            correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
            if ($issue == 'forgotPassword'){
                $link= 'http://localhost/Foap2023-OOP/RecuperarContrasenya/views/introducirPass.php?token='.$this->token; // aqui hay que enviar el token
                $mail->msgHTML("<a href='".$link."'> Link para crear nueva contraseña</a>"); 
                };
            if ($issue == 'activacion'){
                $link= 'http://localhost/Foap2023-OOP/RecuperarContrasenya/includes/activacion_inc.php?token='.$this->token; // aqui hay que enviar el token
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

        private function generateToken(){
            $this->token = bin2hex(random_bytes(16));

        }
        public function activateAccount(){

            $result = $this->checkToken($this->token);

            if ($result == 1) {
                echo " el stmt es incorrecto";
                header ("location: ../includes/activacion_inc.php?error=FailedStmt");
            exit();
            }
            if ($result == 2) { 
                echo " el token  no existe";
                header ("location: ../includes/activacion_inc.php?error=tokenNotExist"); 
                exit();
            }
            if ($result == 3) {
                echo " el token está caducado";
                header ("location: ../includes/activacion_inc.php?error=tokenExpired"); 
                exit();
            }
    
            if(!$this->activaCuenta($this->token)){
                header("Location: ../includes/activacion_inc.php?error=failedStmt&token=$this->token");
                exit();
            }
            header("Location: ../views/login.html?error=none");

        }   
    }            
?>