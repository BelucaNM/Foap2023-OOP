
<?php
class usuario extends connection {


    protected function checkUser($username, $email){
            $error = 0;
            $stmt = $this->connect()->prepare("SELECT username FROM usuarios WHERE username = ? OR email = ?");
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
                    //print_r($result);
                    $hashedPwd = $result['password'];
                    //echo $hashedPwd;
                    if (password_verify($password, $hashedPwd) != 1) {$error = 3;}
                }else{
                    $error = 2;
                }
                
            }
            $stmt = null;
            return $error;
        }

    public function setUser($username, $password, $email) {
            
            $result = true;
            $stmt = $this->connect()->prepare("INSERT INTO usuarios (username, password, email) VALUES (?,?,?)");
            
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            if(!$stmt->execute(array($username, $hashedPwd, $email))){
                $result = false;
            }
           
            $stmt = null;
            return $result;
        }
    protected function checkUserByEmail($email){
            
            $stmt = $this->connect()->prepare("SELECT username FROM usuarios WHERE email = ?");
            $result = $stmt->execute(array($email));
            if(!$result){
                $error = 1;
            }else{
                if($stmt->rowCount()= 0){
                $error = 2;}
            };
            $array [0] =$error;
            $array [1] =$result;
            $stmt = null;
            return $array;
            }

    public function updatePassword($email, $password) {
            
                $result = true;
                $stmt = $this->connect()->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    
                if(!$stmt->execute(array($hashedPwd, $email))){
                    $result = false;
                }
               
                $stmt = null;
                return $result;
            }


    }      


    
?>
