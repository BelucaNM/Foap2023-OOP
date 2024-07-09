<?php

class PostContr extends blog
{

    private $titulo;
    private $cuerpo;
    private $fotoURL;
    private $fotoALT;
    private $fecha;
    private $idUsuariol;


    public function __construct($titulo, $cuerpo, $fotoURL, $fotoALT, $fecha, $idUsuariol)
    {

        $this->titulo = $titulo;
        $this->cuerpo = $cuerpo;
        $this->fotoURL = $fotoURL;
        $this->fotoALT = $fotoALT;
        $this->fecha = $fecha;
        $this->idUsuariol = $idUsuariol;
    }

    /**Setters and getters */
    /*     public function setUsername($idBlog)
        {
            $this->idBlog = $idBlog;
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
    private function emptyInput($input)
    {
        $result = true;

        if (empty($input)) {
            $result = false;
        }
        return $result;
    }
    public function newpost()
    {

        // convertir en php newDatatime en string ?
        echo $this->titulo . $this->idUsuariol . $this->fotoURL . $this->cuerpo;
        if ($this->emptyInput($this->titulo) == false || $this->emptyInput($this->cuerpo) == false || $this->emptyInput($this->fotoURL) == false || $this->emptyInput($this->idUsuariol) == false) {
            //   header("Location: ../views/users_register.php?error=camposvacios");


            exit();
        }
        ;



        //setUser to DB
        if ($this->setBlog($this->titulo, $this->cuerpo, $this->fotoURL, $this->fotoALT, $this->fecha, $this->idUsuariol)) {
            header("Location: ../views/home.php");
        } else {

            header("Location: ../views/users_register.php?error=Fallo en el alta");
        }

    }

}