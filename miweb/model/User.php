<?php
class User extends Connection{

    protected function setUser($username, $password, $email){
        $error = false;
        $stmt = $this->connect()->prepare("INSERT INTO users (users_uid, users_pwd, users_email) VALUES (?,?,?)");

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($username, $hashedPwd, $email))){
            $error = true;
        }
        $stmt = null;
        return $error;

    }

    protected function checkUser($username, $email){
        $stmt = $this->connect()->prepare("SELECT users_uid FROM users WHERE users_uid = ? OR users_email = ?;");
        if(!$stmt->execute(array($username, $email))){
            $stmt = null;
            header("Location: .../view/signup.html?error=stmtfailed");
            exit();
        }
        $resultCheck = false;
        if($stmt->rowCount()>0){
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function verifyLoginUser($username, $password){
        $error = 0;
        $stmt = $this->connect()->prepare("SELECT users_pwd from users WHERE users_uid = ?");
        $status = 1;
        if(!$stmt->execute(array($username))){
            $error = 1;
        }

        if($stmt->rowCount()>0){
            $res = $stmt->fetchAll();
            $hashedPwd = $res[0]['users_pwd'];
            if(password_verify($password, $hashedPwd)==false){
                $error = 2;
            }else{
                $_SESSION["username"] = $username;
            }
        }else{
            $error = 2;
        }
        $stmt = null;
        return $error;

        

    }
    protected function checkToken($token){
        echo $token;
        $error = 0;
        $stmt = $this->connect()->prepare("SELECT TIMESTAMPDIFF(minute,deadLine,now()) as diff FROM users WHERE token = ?");
    
        if (!$stmt->execute(array($token))){
            $error = 1;
        }else{
            if( $stmt->rowCount() >0) {
                $tiempo = $stmt->fetch();
                if($tiempo[0]['diff'] > 30){  // diferencia mayor de 30 minutos que es tiempo de validez del token
                    $error = 3;
                }
            }else{
                $error = 2;
            }
        };
                
        $stmt = null;
        return $error;
        }

    protected function checkUserByEmail($email){
            echo $email;
            $error = 0;
            $stmt = $this->connect()->prepare("SELECT users_uid FROM users WHERE users_email = ?;");

            if (!$stmt->execute(array($email))){
                $error = 1;
            }else{
                if( $stmt->rowCount() >0) {
                    $result = $stmt->fetch();
                    print_r($result);
                    $array [1] =$result['users_uid'];
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
                $stmt = $this->connect()->prepare("UPDATE users SET token = ?, deadLine=now() WHERE users_email = ?");
                       
                if(!$stmt->execute(array($token,$email))){
                            $result = false;
                }
                        
                $stmt = null;
                return $result;
                }
}
