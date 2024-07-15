
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
            $stmt = $this->connect()->prepare("SELECT password, cuentaActiva  FROM usuarios WHERE username = ?;");

            if(!$stmt->execute(array($username))){
                $error = 1;
            }else{
                if($stmt->rowCount()>0){
                    $result = $stmt->fetch();
                    //print_r($result);
                    $hashedPwd = $result['password'];
                    //echo $hashedPwd;
                    if (password_verify($password, $hashedPwd) != 1) {$error = 3;}
                    if (!$result['cuentaActiva']) {$error = 4;}
                }else{
                    $error = 2;
                }
                
            }
            $stmt = null;
            return $error;
        }

    protected function setUser($username, $password, $email, $token="") {
            
            $result = true;
            $stmt = $this->connect()->prepare("INSERT INTO usuarios (username, password, email, token, deadLine=now()) VALUES (?,?,?,?)");
            
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            if(!$stmt->execute(array($username, $hashedPwd, $email, $token))){
                $result = false;
            }
           
            $stmt = null;
            return $result;
        }
    protected function checkUserByEmail($email){
            echo $email;
            $error = 0;
            $stmt = $this->connect()->prepare("SELECT username FROM usuarios WHERE email = ?;");

            if (!$stmt->execute(array($email))){
                $error = 1;
            }else{
                if( $stmt->rowCount() >0) {
                    $result = $stmt->fetch();
                    print_r($result);
                    $array [1] =$result['username'];
                }else{
                    $error = 2;
                }
            };
            $array [0] =$error;
            $stmt = null;
            return $array;
            }

    protected function updateConToken($email,$token) {
            
        $result = true;
        $stmt = $this->connect()->prepare("UPDATE usuarios SET token = ?, deadLine=now() WHERE email = ?");
               
        if(!$stmt->execute(array($token,$email))){
                    $result = false;
        }
                
        $stmt = null;
        return $result;
        }

    protected function updatePassword($token, $password) {        
        $result = true;
        $stmt = $this->connect()->prepare("UPDATE usuarios SET password = ?, token=null, deadLine=now() WHERE token = ?");
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    
        if(!$stmt->execute(array($hashedPwd, $token))){
            $result = false;
            }
               
        $stmt = null;
        return $result;
        }

    protected function activaCuenta($token) {        
        $result = true;
        $stmt = $this->connect()->prepare("UPDATE usuarios SET cuentaActiva = 1, token=null, deadLine=now() WHERE token = ?");
        if(!$stmt->execute(array($token))){
            $result = false;
            }
             
        $stmt = null;
        return $result;
        }

     protected function checkToken($token){
        echo $token;
        $error = 0;
        $stmt = $this->connect()->prepare("SELECT TIMESTAMPDIFF(minute,deadLine,now()) as diff FROM usuarios WHERE token = ?");
    
        if (!$stmt->execute(array($token))){
            $error = 1;
        }else{
            if( $stmt->rowCount() >0) {
                $tiempo = $stmt->fetch();
                if($tiempo[0]['diff'] > 30){  // diferencia mayor ede 30 minutos que es tiempo de validez del token
                    $error = 3;
                }
            }else{
                $error = 2;
            }
        };
                
        $stmt = null;
        return $error;
        }

    }         
?>