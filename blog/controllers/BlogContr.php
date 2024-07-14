<?php

class BlogContr extends blog {

    private $titulo;
    private $cuerpo;
    private $fotoURL;
    private $fotoALT;
    private $fecha;
    private $idUsuario;


    public function __construct($titulo="", $cuerpo="", $fotoURL="", $fotoALT="", $fecha="", $idUsuario="")
    {

        $this->titulo = $titulo;
        $this->cuerpo = $cuerpo;
        $this->fotoURL = $fotoURL;
        $this->fotoALT = $fotoALT;
        $this->fecha = $fecha;
        $this->idUsuario = $idUsuario;
    }

    /**Setters and getters */
    public function setTitulo($titulo)
        {
            $this->titulo = $titulo;
        }
    public function getTitulo()
        {
            return $this->titulo;
        }

    public function setCuerpo($cuerpo)
        {
            $this->cuerpo = $cuerpo;
        }
    public function getCuerpo()
        {
            return $this->cuerpo;
        }

    public function setFotoURL($fotoURL)
        {
            $this->fotoURL = $fotoURL;
        }
    public function getFotoURL()
        {
            return $this->fotoURL;
        }

    public function setFotoALT($fotoALT)
        {
            $this->fotoALT = $fotoALT;
        }
    public function getFotoALT()
        {
        return $this->fotoALT;
        }
    public function setFecha($fecha)
        {
        $this->fecha = $fecha;
        }
    public function getfecha()
        {
        return $this->fecha;
        }
    public function setIdUsuario($idUsuario)
        {
        $this->idUsuario = $idUsuario;
        }
    public function getIdUsuario()
        {
        return $this->idUsuario;
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
    public function newpost() {

        // validacion campos vacios
        echo $this->titulo." ". $this->idUsuario." ". $this->fotoURL ." ". $this->cuerpo;
        if ($this->emptyInput($this->titulo) == false || $this->emptyInput($this->cuerpo) == false || $this->emptyInput($this->fotoURL) == false || $this->emptyInput($this->idUsuario) == false) {
            header("Location: ../views/nuevaEntrada.php?error=camposvacios");
            exit();
        }

        //set Blog to DB
        $res =$this->setBlog($this->titulo, $this->cuerpo, $this->fotoURL, $this->fotoALT, $this->fecha, $this->idUsuario);
        if ($res == 1) {
            header("Location: ../views/nuevaEntrada.php?error=FalloConexion");
            }
        if ($res == 2) {
            header("Location: ../views/nuevaEntrada.php?error=ErrorAltaBlog");
            }
        
        header("Location: ../views/home.php?error=none");
        }

    }

