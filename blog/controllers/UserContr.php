<?php

class UserContr extends usuario
{
    private $username;
    private $password;
    private $repeatPwd;
    private $email;
    private $rememberme;

    public function __construct($username, $password, $email = "", $repeatPwd = "")
    {
        $this->username = $username;
        $this->password = $password;
        $this->repeatPwd = $repeatPwd;
        $this->email = $email;
    }

    /**Setters and getters */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setRepeatPwd($repeatPwd)
    {
        $this->repeatPwd = $repeatPwd;
    }
    public function getRepeatPwd()
    {
        return $this->repeatPwd;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function setRememberme($rememberme)
    {
        $this->rememberme = $rememberme;
    }
    public function getRememberme()
    {
        return $this->rememberme;
    }
    /*** */

    public function signupUser()
    {

        //validation
        if ($this->emptyInput($this->username) == false || $this->emptyInput($this->password) == false || $this->emptyInput($this->email) == false) {
            header("Location: ../views/users_register.php?error=camposvacios");
            exit();
        }
        if ($this->usernameTakenCheck() == 2) {
            header("Location: ../views/users_register.php?error=El Usuario ya existe");
            exit();
        }
        if ($this->usernameTakenCheck() == 1) {
            header("Location: ../views/users_register.php?error=Fallo en la conexión");
            exit();
        }

        //setUser to DB
        if ($this->setUser($this->username, $this->password, $this->email)) {
            header("Location: ../views/home.php");
        } else {

            header("Location: ../views/users_register.php?error=Fallo en el alta");
        }

    }

    public function loginUser()
    {

        //validation
        if ($this->emptyInput($this->username) == false || $this->emptyInput($this->password) == false) {
            header("Location: ../views/users_login.php?error=Rellena los campos");
            exit();
        }

        //verifyUser in DB
        $res = $this->checkPass($this->username, $this->password);
        if ($res == 1) {
            header("Location: ../views/users_login.php?error=Fallo en la  verificación");
        }
        if ($res == 2) {
            header("Location: ../views/users_login.php?error=El Usuario no existe");
        }
        if ($res == 3) {
            header("Location: ../views/users_login.php?error=Contraseña incorrecta");
        }
        if ($res == 0) {
            header("Location: ../views/home_isabel.php");
//            header("Location: ../views/home.php");
        }
    }

    public function registerUser()
    {

        //validation
        if ($this->emptyInput($this->username) == false || $this->emptyInput($this->password) == false || $this->emptyInput($this->repeatPwd) == false || $this->emptyInput($this->email) == false) {
            header("Location: ../views/users_register.php?error=emptyInput");
            exit();
        }
        if ($this->usernameTakenCheck() == 2) {
            header("Location: ../views/users_register.php?error=UsernameTaken");
            exit();
        }
        if ($this->usernameTakenCheck() == 1) {
            header("Location: ../views/users_register.php?error=FailedStmt");
            exit();
        }

        //setUser to DB
        if ($this->setUser($this->username, $this->password, $this->email)) {
            header("Location: ../views/users_register.php?error=FailedStmt");
        }
    }

    private function emptyInput($input)
    {
        $result = true;

        if (empty($input)) {
            $result = false;
        }
        return $result;
    }

    private function usernameTakenCheck()
    {
        $result = $this->checkUser($this->username, $this->email);

        return $result;
    }
}