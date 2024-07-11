
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

            $error = $this->checkUserByEmail($this->email);
            if ($error = 1) { header("Location: ../views//introducirEmail.html?error=FailedStmt");
                            exit();}
            if ($error = 2) { header("Location: ../views//introducirEmail.html?error=EmailDoesNotExist");
                            exit();}
                   
                           
             // si todo esta bien, se llama a NewPassword.html
                    
            header("Location: ../views/users_register.php?error=FailedStmt");
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