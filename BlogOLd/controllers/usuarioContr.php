
<?php
class usuarioContr extends usuario {
 
    private function emptyInput(){
        $result = false;
        if (empty($this->username) || empty($this->password)) {
            $result = true;
        }
        return $result;
        }     
    

    public function login(){
        // validaciones

        if ($this->emptyInput() == true){
            echo " la entrada es vacia";    
            header ("location: ../vista/login.html?error=EmptyInput"); 
            exit();
        }
        // chequea user/password en BD
        $result = $this->checkPass($this->username,$this->password);
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

    
        
        if ($result == 0 ) { 
            // si no hay error abro la session
            session_start([
                    'use_only_cookies'=> 1,
                    'cookie_lifetime'=> 0,
                    'cookie_secure'=> 1,
                    'cookie_httponly'=> 1
                ]);
                
            $_SESSION["usuario"] = $this->username; // inicia session
                
            echo " Creada Sesion ";
            header("Location: ../vista/login.html?error=none");
            }
        }

         
        
?>    
