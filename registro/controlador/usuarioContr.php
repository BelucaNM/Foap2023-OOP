
<?php
class usuarioContr extends usuario {
    private $username;
    private $password1;
    private $password2;
    private $email;
    private $recordar;

    public function __construct($username, $password1,$password2="",$email="") {
                $this->username = $username;
                $this->password1 = $password1;
                $this->password2 = $password2;
                $this->email = $email;
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

    private function emptyInput(){
            $result = false;
            if (empty($this->username) || empty($this->password1) || empty($this->password2) || empty($this->email)){
                $result = true;
            }
            return $result;
            }
            
    Public function signupUser(){
            // validaciones
          
/*          $error= false;
    
            if (empty ($this->email) || !is_valid_email($this->email) ) { $error = true;};
                        
            if (empty ($this->username) || !is_solo_letras($this->username)) { $error = true;};                  
    
            if (empty ($this->password1) || !is_valid_pwd ($this->password1)){$error = true;};
    
            if (empty ($this->password2) ){$error = true; };
    
            if (($this->password1 !== $this->password2)) {$error = true;};
            if ($error) { header ("location: ../vista/signup.html?error=1"); exit();};
*/

            if ($this->emptyInput() == true){
                echo " la entrada es vacia";
                header ("location: ../vista/signup.html?error=EmptyInput"); 
                exit();
                }

                
            $result = $this->checkUser($this->username,$this->email); // en usuario.php
            if ($result == 2) {
                    echo " el username ya existe";
                    header ("location: ../vista/signup.html?error=UsernameTaken");
                    exit();
                } else  {if ($result == 1) {
                    echo " el stmt es incorrecto";
                    header ("location: ../vista/signup.html?error=FailedStmt");
                    exit();
                }
            
       
            //setUser to BD

            if (!$this->setUser($this->username, $this->password1, $this->email)) { // en usuario.php
                echo " el stmt es incorrecto";
                header ("location: ../vista/signup.html?error=FailedStmt");
                exit();
            }
            
        }
    }
        
    private function emptyInputDos(){
        $result = false;
        if (empty($this->username) || empty($this->password1)){
            $result = true;
        }
        return $result;
    }    

    public function login(){
        // validaciones

        if ($this->emptyInputDos() == true){
            echo " la entrada es vacia";    
            header ("location: ../vista/login.html?error=EmptyInput"); 
            exit();
        }
        // chequea user/password en BD
        $result = $this->checkPass($this->username,$this->password1);
             // ver errores diferentes
        if ($result == 1) {
            echo " el stmt es incorrecto";
            header ("location: ../vista/login.html?error=FailedStmt");
        exit();
        }
        if ($result == 2) { 
            echo " el username no existe";
            header ("location: ../vista/login.html?error=UsernameNotExist"); 
            exit();
        }
        if ($result == 3) {
            echo " el password no coincide";
            header ("location: ../vista/login.html?error=WrongPassword"); 
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
            header("Location: ../vista/login.html?error=none");
            }
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

    }            
        
?>    
