
<?php
class usuarioContr extends usuario {
    private $username;
    private $password1;
    private $password2;
    private $email;
    private $recordar;
    private $token;

    public function __construct($username="", $password1,$password2="",$email="",$token="") {
                $this->username = $username;
                $this->password1 = $password1;
                $this->password2 = $password2;
                $this->email = $email;
                $this->token = $token;
                } 
    public function __destruct() { 
            echo "Se ha destruido el registro";
            }
    public function getUsername() {
            return $this->username;
            }
    public function getPassword1() {
            return $this->password1;
            }
    public function getPassword2() {
             return $this->password2;
            }
    public function getEmail() {
            return $this->email;
            }
    public function getToken() {
                return $this->token;
                }
    public function getRecordar() {
            return $this->recordar;
            }
    public function setUsername($username) {
            $this->username = $username;
            }
    public function setPassword1($password1) {
            $this->password1 = $password1;
            }
    public function setPassword2($password2) {
            $this->password2 = $password2;
            }
    public function setEmail($email) {
            $this->email = $email;
            }
    public function setRecordar($recordar) {
            $this->recordar = $recordar;
            }
     public function setToken($token) {
                $this->token = $token;
                }

    private function emptyInput(){
        $result = false;
        if (empty($this->username) || empty($this->password1) || empty($this->password2) || empty($this->email)){
            $result = true;
            }
        return $result;
        }
            
    Public function signupUser(){
            // validaciones
          
/*          $error= false; // revisar
    
            if (empty ($this->email) || !is_valid_email($this->email) ) { $error = true;};
                        
            if (empty ($this->username) || !is_solo_letras($this->username)) { $error = true;};                  
    
            if (empty ($this->password1) || !is_valid_pwd ($this->password1)){$error = true;};
    
            if (empty ($this->password2) ){$error = true; };
    
            if (($this->password1 !== $this->password2)) {$error = true;};
            if ($error) { header ("location: ../vista/signup.html?error=1"); exit();};
*/

            if ($this->emptyInput() == true){
                echo " la entrada está vacia";
                header ("location: ../views/signup.html?error=EmptyInput"); 
                exit();
                }

                
            $result = $this->checkUser($this->username,$this->email); // en usuario.php
            if ($result == 2) {
                    echo " el username ya existe";
                    header ("location: ../views/signup.html?error=UsernameTaken");
                    exit();
                } else  {if ($result == 1) {
                    echo " el stmt es incorrecto";
                    header ("location: ../views/signup.html?error=FailedStmt");
                    exit();
                    }
                }
            
       
            //setUser to BD
            $this->generateToken();

            if (!$this->setUser($this->username, $this->password1, $this->email, $this->token)) { // en usuario.php
                echo " el stmt es incorrecto";
                header ("location: ../views/signup.html?error=FailedStmt");
                exit();
                }

            // si todo esta bien, envia email de activación
            $err= $this->enviaEmail('activacion'); 

            //check for errors  
            if (!$err) {
                header("Location: ../views/signup.html?error=RegisterDone");
                exit();
            } else {
                header("Location: ../views/signup.html?error=FailedSendEmail");
                exit();
            }
        }
    
    private function emptyInputDos(){
        $result = false;
        if (empty($this->username) || empty($this->password1)){
            echo "vacios";
            $result = true;
        }
        return $result;
    }
    public function login(){
        // validaciones

        if ($this->emptyInputDos() == true){
            echo " la entrada es vacia";    
            header ("location: ../views/login.html?error=EmptyInput"); 
            exit();
        }
        // chequea user/password en BD
        $result = $this->checkPass($this->username,$this->password1);
             // ver errores diferentes
        if ($result == 1) {
            echo " el stmt es incorrecto";
            header ("location: ../views/login.html?error=FailedStmt");
            exit();
        }
        if ($result == 2) { 
            echo " el username no existe";
            header ("location: ../views/login.html?error=UsernameNotExist"); 
            exit();
        }
        if ($result == 3) {
            echo " el password no coincide";
            header ("location: ../views/login.html?error=WrongPassword"); 
            exit();
        }
        
        if ($result == 0 ) { 
            // si no hay error abro la session
            session_start([
                    'use_only_cookies'=> 1,
                    'cookie_lifetime'=> 0,
                    'cookie_secure'=> 1,
                    'cookie_httponly'=> 1
                ]);
                
            $_SESSION["usuario"] = $this->username; // inicia session
            $cookie_name ="remember_me[0]";
            $cookie_value = $this->username;
            $cookie_expiry_time = time() + (24*3600); // un dia
            setcookie($cookie_name,$cookie_value,$cookie_expiry_time,"/","",true,true);
            echo " Creada Sesion ";
            header("Location: ../views/login.html?error=none");
            }
        }
    public function valUpdatePassword(){
        // validaciones

       if ($this->emptyInputTres() == true){
           echo " la entrada está vacia";
            header ('location: ../views/introducirPass.php?error=EmptyInput&token='.$this->token); 
            exit();
            }
            
        if ($this->password1 != $this->password2){
            echo " las contraseñas no coinciden";
            header ("location: ../views/introducirPass.php?error=PasswordsDontMatch&token=".$this->token); 
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
            header ("location: ../views/introducirPass.html?error=FailedStmt");
        exit();
        }
        if ($result == 2) { 
            echo " el token  no existe";
            header ("location: ../views/introducirPass.html?error=tokenNotExist"); 
            exit();
        }
        if ($result == 3) {
            echo " el token está caducado";
            header ("location: ../views/introducirPass.html?error=tokenExpired"); 
            exit();
        }



        $result = $this->updatePassword($this->token,$this->password1); // en usuario.php
        echo $this->token;
        echo $this->password1;
        if (!$result) {
                echo " no se ha podido hacer la actualización";
                header ("location: ../views/login.html?error=FailedStmt");
                exit();
        } else {
                echo " actualización realizada con éxito";
                header ("location: ../views/login.html?error=errorNone");
                exit();
            }
        //setUser to BD

    }

    private function emptyInputTres(){
        $result = false;
        if ( empty($this->password1) || empty($this->password2) || empty($this->token)){
            $result = true;
        }
        return $result;
        }    

    public function validate_input($input)
            { // sanear datos
                $input = trim($input);
                $input = htmlspecialchars($input);
                $input = stripslashes($input);
                return $input;

            }

    public function is_valid_email($str)
            {
                return filter_var($str, FILTER_VALIDATE_EMAIL);
            }

    public function is_solo_letras($str)
            {
                return ctype_alpha($str);
            }

    public function is_valid_pwd($str)
        { // comprueba que la palabra tenga al menos un caracter especial, una mayuscula, una minuscula y entre 6 y 8 caracteres 
            $is_valid = 1;

            if ((strLen($str) < 6) || (strLen($str) > 8)) {
                $is_valid = 0;
            }
            ;

            $pattern = "/[a-z]/";
            if (preg_match_all($pattern, $str) < 1) {
                $is_valid = 0;
            }
            ;

            $pattern = "/[A-Z]/";
            if (preg_match_all($pattern, $str) < 1) {
                $is_valid = 0;
            }
            ;

            $pattern = "/[_?¿=&$#@|]/";
            if (preg_match_all($pattern, $str) < 1) {
                $is_valid = 0;
            }
            ;

            return $is_valid;
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

            
            
        //  Para enviar texto plano     
            
            if ($issue == 'forgotPassword'){
                $mail->Body = "Hola,\n\nPara recuperar tu contraseña, haz click en el enlace siguiente. Si no has solicitado este
                    correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
                $link= 'http://localhost/Foap2023-OOP/RecuperarContrasenya/views/introducirPass.php?token='.$this->token; // aqui hay que enviar el token
                $mail->msgHTML("<a href='".$link."'> Link para crear nueva contraseña</a>"); 
                };
            if ($issue == 'activacion'){
                $mail->Body = "Hola,\n\nPara activar tu cuenta, haz click en el enlace siguiente. Si no has solicitado este
                    correo, puedes ignorarlo.\n\nSaludos,\n\nFoap2023-OOP";
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

    
    

    }            
        
?>    
