
<?php
class loginContr extends usuario {
        private $username;
        private $password;
        private $recordar;
        

        public function __construct($username, $password,$recordar) {
                $this->username = $username;
                $this->password = $password;
                $this->email = $recordar;
                } 
        public function __destruct() { 
                    echo "Se ha destruido el registro";
                }
        public function getUsername() {
                return $this->username;
                }
        public function getPassword() {
            return $this->password;
            }
        public function getRecordar() {
             return $this->recordar;
            }
        
        public function setUsername($username) {
            $this->username = $username;
            }
        public function setPassword($password) {
            $this->password = $password;
            }
        
        public function setRecordar($recordar) {
            $this->recordar = $recordar;
            }
        
        Public function login(){
            // validaciones

            if ($this->emptyInput() == true){
                header ("location: ../vista/login.html?error=EmptyInput"); 
                exit();}

            //chequea user/password en BD

            if (!$this->checkPassword()) {
                    header ("location: ../vista/registro.html?error=wrongPassword");
                    exit();
                }
            
        }
        
        private function emptyInput(){
            $result = false;
            if (empty($this->username) || empty($this->password) ){
                $result = true;
            }
            return $result;
        }
        private function checkPassword(){
            $result = $this->checkPass($this->username,$this->password);
            return $result;
        }
        private function openSession(){
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

            
        }

    }            
        
?>    