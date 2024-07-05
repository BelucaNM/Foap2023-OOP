
<?php
class usuario extends connection {
        public function setUser($username, $password, $email) {
            
            $result = true;
            $stmt = $this->connect()->prepare("INSERT INTO usuarios (username, password, email) VALUES (?,?,?)");
            
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            if(!$stmt->execute(array($username, $hashedPwd, $email))){
                $result = false;
            }
            //$stmt = $this->connect()->query("INSERT INTO usuarios (username, password, email) VALUES ($username, $password, $email)");

            /*if(!$stmt){
                $result = false;
                }*/
            $stmt = null;
            return $result;
        }   
        protected function checkUser($username, $email){
            $error = false;
            $stmt = $this->connect()->prepare("SELECT username FROM usuarios WHERE username = ? OR email = ?;");
            if(!$stmt->execute(array($username, $email))){
                $error = 1;
                }
            if($stmt->rowCount()>0){
                $error = 2;
                }
            $stmt = null;
            return $error;
        }

        protected function checkPass($username, $password){
            $error = false;
            $stmt = $this->connect()->prepare("SELECT password FROM usuarios WHERE username = ?;");

            if(!$stmt->execute(array($username))){
                $error = true;
            }else{
                if($stmt->rowCount()>0){
                    $result = $stmt->fetch();
                    $hashedPwd = $result['password'];
                    $error = password_verify($password, $hashedPwd);
                }else{
                    $error = true;
                }
                
            }
            $stmt = null;
            return $error;
        }

       
        public function baja() {
            echo "Se ha dado de baja el usuario";
            }
        public function modificacion() {
            echo "Se ha modificado el usuario"; 
            }
}  
    
?>
