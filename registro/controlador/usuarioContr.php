
<?php
class usuarioContr extends usuario {
        private $username;
        private $password1;
        private $password2;
        private $email;

        public function __construct($username, $password1,$password2, $email) {
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
        
        Public function signupUser(){
            // validaciones
          
/*          $error= false;
    
            if (empty ($this->email) || !is_valid_email($this->email) ) { $error = true;};
                        
            if (empty ($this->username) || !is_solo_letras($this->username)) { $error = true;};                  
    
            if (empty ($this->password1) || !is_valid_pwd ($this->password1)){$error = true;};
    
            if (empty ($this->password2) ){$error = true; };
    
            if (($this->password1 !== $this->password2)) {$error = true;};
            if ($error) { header ("location: ../vista/singup.html?error=1"); exit();};
            */

            if ($this->emptyInput() == false){
                header ("location: ../vista/singup.html?error=EmptyInput"); 
                exit();};
       
            //setUser to BD

            if ($this->setUser($this->username, $this->password1, $this->email)) {
                header ("location: ../view/registro.html?error= FailedStmt");
            }


        }
        
        private function emptyInput(){
            $result = true;
            if (empty($this->username) || empty($this->password1) || empty($this->password2) || empty($this->email)){
                $result = false;
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
