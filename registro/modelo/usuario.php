
<?php
class usuario extends connection {
        
        
            
        public function setUser($username, $password, $email) {
            $error = false;
            $stmt = $this -> connect()->prepare("insert into usuarios (username, password,email) values (?,?,?)" );
            
            $stmt->bind_param("sss", $username, $password, $email);

            if (!$stmt -> execute(array ($username, $password,$email))){
                $stmt = null;
                header ("location: ../view/registro.html? error= failedStmt");
            }
        
        }   

        public function baja() {
            echo "Se ha dado de baja el usuario";
            }
        public function modificacion() {
            echo "Se ha modificado el usuario"; 
            }
}  
       
    
?>
