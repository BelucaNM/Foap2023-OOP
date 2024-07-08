
<?php
class usuario extends connection {


    protected function checkUser($username, $email){
            $error = 0;
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
            $error = 0;
            $stmt = $this->connect()->prepare("SELECT password FROM usuarios WHERE username = ?;");

            if(!$stmt->execute(array($username))){
                $error = 1;
            }else{
                if($stmt->rowCount()>0){
                    $result = $stmt->fetch();
                    print_r($result);
                    $hashedPwd = $result['password'];
                    echo $hashedPwd;
                    if (password_verify($password, $hashedPwd) != 1) {$error = 3;}
                }else{
                    $error = 2;
                }
                
            }
            $stmt = null;
            return $error;
        }
  
    

}  
    
?>
