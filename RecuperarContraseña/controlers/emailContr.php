
<?php
class emailContr extends usuario {
        private $email;

        public function __construct($email) {
                $this->username = $email;
                
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

            if (!$this->emptyInput()){
                header ("location: ../views/introducirEmail.html?error=EmptyEmail"); 
                exit();}

            //chequea email existe en BD

            $result = $this->checkUserByEmail($this->email);
            if ($result[0] = 1) { header("Location: ../views/introducirEmail.html?error=FailedStmt");
                            exit();}
            if ($error[0] = 2) { header("Location: ../views/introducirEmail.html?error=EmailDoesNotExist");
                            exit();}
                   
            // aqui tendria que crar un token en BD 
            
                        
            // si todo esta bien, continua en email_inc
            // 
            return $error[1]; // es el user
            
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