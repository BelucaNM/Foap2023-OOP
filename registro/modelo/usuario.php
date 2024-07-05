
<?php
class usuario extends connection {
        public function setUser($username, $password, $email) {
            
            $result = true;
//            $stmt = $this->connect()->prepare("INSERT INTO usuarios (username, password, email) VALUES (?,?,?)");
            
//           $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

//            if(!$stmt->execute(array($username, $hashedPwd, $email))){


//                $result = false;
//                }
            $stmt = $this->connect()->query("INSERT INTO usuarios (username, password, email) VALUES ($username, $password, $email)");

            if(!$stmt){
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
