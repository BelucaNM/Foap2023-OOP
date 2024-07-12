
<?php
class emailContr extends usuario {
        private $email;

        public function __construct($email) {
                $this->email = $email;
                
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
            // crear un token 
            $token = bin2hex(random_bytes(16));
           
            //actualiza registro to DB
            if (!$this->updateConToken($this->email,$token)) {
                header("Location: ../views/introducirEmail.html?error=FailedStmt");     
                exit();
            } else {
                $result[2]=$token;

                // si todo esta bien, continua en email_inc
                
                return $result[2]; // es el token
            }
           
        }
        
        private function emptyInput(){
            $result = false;
            if (empty($this->email)){
                $result = true;
            }
            return $result;
        }
                     
    }
        
?>    