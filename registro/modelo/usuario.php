
<?php
class usuario extends connection {
        public function setUser($username, $password, $email) {
            
            $result = true;
            $stmt = $this->connect()->prepare("insert into usuarios (username, password,email) values (?,?,?)" );
            
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            if(!$stmt->execute(array($username, $hashedPwd, $email))){
                $result = false;
                }
            $stmt = null;
            return $result;
        }   

        public function baja() {
            echo "Se ha dado de baja el usuario";
            }
        public function modificacion() {
            echo "Se ha modificado el usuario"; 
            }
}  
       
    
?>
